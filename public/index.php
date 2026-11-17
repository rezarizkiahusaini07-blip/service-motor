<?php
/**
 * MotoCare Pro - Laravel + XAMPP MySQL Bridge
 * Bisa dijalankan langsung di C:\xampp\htdocs\service_motor_laravel\public
 * Mendukung penuh Laravel (jika vendor/ terpasang) maupun Native PHP PDO MySQL fallback.
 */

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    )->send();
    $kernel->terminate($request, $response);
    exit;
}

// =========================================================================
// XAMPP DIRECT MYSQL + REST API ENGINE (Kompatibel 100% dengan Postman)
// =========================================================================
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$host = '127.0.0.1';
$db   = 'db_service_motor';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    // Auto-create database & tables if not yet imported
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$db`");
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS `pelanggans` (
        `id_pelanggan` varchar(20) PRIMARY KEY,
        `nama_lengkap` varchar(100) NOT NULL,
        `no_hp` varchar(20) NOT NULL,
        `alamat_pelanggan` text NOT NULL,
        `pekerjaan` varchar(100) NOT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
    )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS `kendaraans` (
        `no_plat_kendaraan` varchar(20) PRIMARY KEY,
        `jenis_kendaraan` enum('Matic','Manual Transimisi') NOT NULL,
        `no_stnk` varchar(50) NOT NULL,
        `tahun_pembuatan` varchar(4) NOT NULL,
        `nama_pemilik` varchar(100) NOT NULL,
        `warna_kendaraan` varchar(50) NOT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
    )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS `daftar_services` (
        `id_servis_pelanggan` varchar(20) PRIMARY KEY,
        `no_plat_kendaraan` varchar(20) NOT NULL,
        `id_pelanggan` varchar(20) NOT NULL,
        `nama_pelanggan` varchar(100) NOT NULL,
        `keluhan_kendaraan` text NOT NULL,
        `tanggal_servis` date NOT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
    )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS `data_services` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `id_servis_pelanggan` varchar(20) NOT NULL,
        `keluhan_kendaraan` text NOT NULL,
        `estimasi_service` varchar(100) NOT NULL,
        `nama_mekanik` varchar(100) NOT NULL,
        `sparepart_pengganti` text NOT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
    )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS `pembayaran_services` (
        `id` int AUTO_INCREMENT PRIMARY KEY,
        `id_servis_pelanggan` varchar(20) NOT NULL,
        `jumlah_biaya_servis` decimal(12,2) NOT NULL,
        `jenis_pembayaran` enum('Cash / Tunai','Non Tunai') NOT NULL,
        `keterangan` text,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
    )");
} catch (PDOException $e) {
    $db_error = $e->getMessage();
}

// Handle REST API Requests (Postman / Fetch)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$api_route = $_GET['api'] ?? '';
if (strpos($uri, '/api/') !== false) {
    $parts = explode('/api/', $uri);
    $api_route = trim($parts[1], '/');
}

if ($api_route !== '') {
    header('Content-Type: application/json');
    if (isset($db_error)) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Koneksi MySQL XAMPP gagal: ' . $db_error]);
        exit;
    }

    $segments = explode('/', $api_route);
    $resource = $segments[0] ?? '';
    $id = $segments[1] ?? null;
    $method = $_SERVER['REQUEST_METHOD'];
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    $tableMap = [
        'pelanggan' => ['table' => 'pelanggans', 'pk' => 'id_pelanggan'],
        'kendaraan' => ['table' => 'kendaraans', 'pk' => 'no_plat_kendaraan'],
        'daftar-service' => ['table' => 'daftar_services', 'pk' => 'id_servis_pelanggan'],
        'data-service' => ['table' => 'data_services', 'pk' => 'id'],
        'pembayaran-service' => ['table' => 'pembayaran_services', 'pk' => 'id'],
    ];

    if (!isset($tableMap[$resource])) {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Endpoint API tidak ditemukan']);
        exit;
    }

    $table = $tableMap[$resource]['table'];
    $pk = $tableMap[$resource]['pk'];

    try {
        if ($method === 'GET') {
            if ($id) {
                $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE `$pk` = ?");
                $stmt->execute([$id]);
                echo json_encode(['status' => 'success', 'data' => $stmt->fetch()]);
            } else {
                $stmt = $pdo->query("SELECT * FROM `$table` ORDER BY created_at DESC");
                echo json_encode(['status' => 'success', 'data' => $stmt->fetchAll()]);
            }
        } elseif ($method === 'POST') {
            unset($input['created_at'], $input['updated_at']);
            $cols = array_keys($input);
            $placeholders = array_fill(0, count($cols), '?');
            $sql = "INSERT INTO `$table` (`" . implode('`,`', $cols) . "`) VALUES (" . implode(',', $placeholders) . ")";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array_values($input));
            http_response_code(201);
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan ke MySQL', 'data' => $input]);
        } elseif ($method === 'PUT') {
            unset($input[$pk], $input['created_at']);
            $sets = [];
            foreach ($input as $k => $v) { $sets[] = "`$k` = ?"; }
            $vals = array_values($input);
            $vals[] = $id;
            $stmt = $pdo->prepare("UPDATE `$table` SET " . implode(', ', $sets) . " WHERE `$pk` = ?");
            $stmt->execute($vals);
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } elseif ($method === 'DELETE') {
            $stmt = $pdo->prepare("DELETE FROM `$table` WHERE `$pk` = ?");
            $stmt->execute([$id]);
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

// Render Dashboard View
include __DIR__ . '/../resources/views/dashboard.blade.php';
