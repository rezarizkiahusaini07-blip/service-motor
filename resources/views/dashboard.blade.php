<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BE bike engine - Sistem Informasi Service Motor (Laravel + MySQL)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #090d0a; color: #ecfdf5; font-family: system-ui, sans-serif; }
        .stabilo-card { background: #0f1711; border: 1px solid #166534; }
        .stabilo-input { background: #052e16; border: 1px solid #15803d; color: #f0fdf4; }
        .stabilo-input:focus { border-color: #4ade80; outline: none; box-shadow: 0 0 0 2px rgba(74, 222, 128, 0.2); }
    </style>
</head>
<body class="min-h-screen flex flex-col md:flex-row">

    <!-- Sidebar Hijau Stabilo -->
    <aside class="w-full md:w-64 bg-zinc-950 border-r border-green-900/50 text-white flex flex-col shrink-0">
        <div class="p-5 border-b border-green-900/40 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-green-400 text-zinc-950 flex items-center justify-center font-black text-xl shadow-[0_0_15px_rgba(74,222,128,0.5)]">
                <i class="fas fa-motorcycle"></i>
            </div>
            <div>
                <h1 class="font-extrabold text-base tracking-wider text-green-400 leading-tight">BE bike engine</h1>
                <span class="text-xs text-green-500 flex items-center gap-1 font-mono">
                    <span class="w-2 h-2 rounded-full bg-green-400 inline-block animate-pulse"></span> MySQL Connected
                </span>
            </div>
        </div>

        <nav class="p-3 space-y-1.5 flex-1">
            <button onclick="switchTab('pelanggan')" id="nav-pelanggan" class="nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold bg-green-400 text-zinc-950 shadow-[0_0_10px_rgba(74,222,128,0.3)] transition">
                <i class="fas fa-users w-5"></i> 1. Data Pelanggan
            </button>
            <button onclick="switchTab('kendaraan')" id="nav-kendaraan" class="nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-zinc-400 hover:text-green-300 hover:bg-green-950/40 transition">
                <i class="fas fa-motorcycle w-5"></i> 2. Data Kendaraan
            </button>
            <button onclick="switchTab('daftar')" id="nav-daftar" class="nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-zinc-400 hover:text-green-300 hover:bg-green-950/40 transition">
                <i class="fas fa-clipboard-list w-5"></i> 3. Daftar Service
            </button>
            <button onclick="switchTab('data')" id="nav-data" class="nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-zinc-400 hover:text-green-300 hover:bg-green-950/40 transition">
                <i class="fas fa-wrench w-5"></i> 4. Data Service
            </button>
            <button onclick="switchTab('pembayaran')" id="nav-pembayaran" class="nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-zinc-400 hover:text-green-300 hover:bg-green-950/40 transition">
                <i class="fas fa-cash-register w-5"></i> 5. Pembayaran Service
            </button>
            <div class="pt-4 mt-4 border-t border-green-900/40">
                <button onclick="switchTab('postman')" id="nav-postman" class="nav-btn w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-green-400 hover:bg-green-950/40 transition">
                    <i class="fas fa-paper-plane w-5"></i> Info API Postman & Git
                </button>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto bg-zinc-900/50">
        <div id="alert-box" class="hidden mb-4 p-4 rounded-lg text-sm font-medium"></div>

        <!-- 1. DATA PELANGGAN -->
        <section id="tab-pelanggan" class="tab-section space-y-6">
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50">
                <h2 class="text-xl font-bold text-green-400 mb-4 border-b border-green-900/60 pb-2">1. Form Data Pelanggan</h2>
                <form onsubmit="submitForm(event, 'pelanggan')" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Id Pelanggan</label>
                        <input type="text" name="id_pelanggan" placeholder="Contoh: PLG-001" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" placeholder="Nama lengkap pelanggan" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">No HP</label>
                        <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Pekerjaan</label>
                        <input type="text" name="pekerjaan" placeholder="Contoh: Karyawan Swasta" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold mb-1 text-green-300">Alamat Pelanggan</label>
                        <textarea name="alamat_pelanggan" rows="2" placeholder="Alamat lengkap" required class="stabilo-input w-full rounded-lg px-3 py-2"></textarea>
                    </div>
                    <div class="md:col-span-2 flex items-center gap-3 text-green-300">
                        <input type="checkbox" name="is_member" value="1" class="w-4 h-4 accent-green-400">
                        <label class="text-sm font-semibold">Daftarkan sebagai Member (diskon servis 10%)</label>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="bg-green-400 hover:bg-green-500 text-zinc-950 font-bold px-5 py-2.5 rounded-lg shadow-[0_0_15px_rgba(74,222,128,0.4)] transition">
                            <i class="fas fa-save mr-1"></i> Simpan Data Pelanggan
                        </button>
                    </div>
                </form>
            </div>
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50 overflow-x-auto">
                <h3 class="font-bold mb-3 text-green-300">Tabel Data Pelanggan (MySQL)</h3>
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-green-950 text-green-300 border-b border-green-800">
                        <tr>
                            <th class="p-3">Id Pelanggan</th>
                            <th class="p-3">Nama Lengkap</th>
                            <th class="p-3">No HP</th>
                            <th class="p-3">Alamat</th>
                            <th class="p-3">Pekerjaan</th>
                            <th class="p-3">Keanggotaan</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-pelanggan" class="divide-y divide-green-900/30"></tbody>
                </table>
            </div>
        </section>

        <!-- 2. DATA KENDARAAN -->
        <section id="tab-kendaraan" class="tab-section hidden space-y-6">
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50">
                <h2 class="text-xl font-bold text-green-400 mb-4 border-b border-green-900/60 pb-2">2. Form Data Kendaraan</h2>
                <form onsubmit="submitForm(event, 'kendaraan')" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">No Plat Kendaraan</label>
                        <input type="text" name="no_plat_kendaraan" placeholder="Contoh: BL 4512 KAB" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Jenis Kendaraan</label>
                        <div class="flex gap-6 pt-2">
                            <label class="flex items-center gap-2 cursor-pointer text-zinc-300">
                                <input type="radio" name="jenis_kendaraan" value="Matic" checked class="w-4 h-4 accent-green-400">
                                <span>Matic</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer text-zinc-300">
                                <input type="radio" name="jenis_kendaraan" value="Manual Transimisi" class="w-4 h-4 accent-green-400">
                                <span>Manual Transimisi</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">No STNK</label>
                        <input type="text" name="no_stnk" placeholder="Nomor STNK" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Tahun Pembuatan Kendaraan</label>
                        <input type="number" name="tahun_pembuatan" placeholder="2023" min="1990" max="2026" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" placeholder="Nama pemilik sesuai STNK" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Warna Kendaraan</label>
                        <input type="text" name="warna_kendaraan" placeholder="Contoh: Hitam Doff" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="bg-green-400 hover:bg-green-500 text-zinc-950 font-bold px-5 py-2.5 rounded-lg shadow-[0_0_15px_rgba(74,222,128,0.4)] transition">
                            <i class="fas fa-save mr-1"></i> Simpan Data Kendaraan
                        </button>
                    </div>
                </form>
            </div>
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50 overflow-x-auto">
                <h3 class="font-bold mb-3 text-green-300">Tabel Data Kendaraan (MySQL)</h3>
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-green-950 text-green-300 border-b border-green-800">
                        <tr>
                            <th class="p-3">No Plat</th>
                            <th class="p-3">Jenis</th>
                            <th class="p-3">No STNK</th>
                            <th class="p-3">Tahun</th>
                            <th class="p-3">Nama Pemilik</th>
                            <th class="p-3">Warna</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-kendaraan" class="divide-y divide-green-900/30"></tbody>
                </table>
            </div>
        </section>

        <!-- 3. DAFTAR SERVICE -->
        <section id="tab-daftar" class="tab-section hidden space-y-6">
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50">
                <h2 class="text-xl font-bold text-green-400 mb-4 border-b border-green-900/60 pb-2">3. Form Daftar Service</h2>
                <form onsubmit="submitForm(event, 'daftar-service')" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Id Servis Pelanggan</label>
                        <input type="text" name="id_servis_pelanggan" placeholder="Contoh: SRV-001" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">No Plat Kendaraan (Drop Down)</label>
                        <select name="no_plat_kendaraan" id="select-plat" required class="stabilo-input w-full rounded-lg px-3 py-2">
                            <option value="">-- Pilih No Plat Kendaraan --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Id Pelanggan (Drop Down)</label>
                        <select name="id_pelanggan" id="select-pelanggan" onchange="autoFillPelanggan()" required class="stabilo-input w-full rounded-lg px-3 py-2">
                            <option value="">-- Pilih Id Pelanggan --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Nama Pelanggan (Otomatis)</label>
                        <input type="text" name="nama_pelanggan" id="auto-nama-pelanggan" readonly placeholder="Muncul otomatis setelah Id Pelanggan dipilih" required class="stabilo-input w-full rounded-lg px-3 py-2 bg-green-950/60 font-semibold text-green-200">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Tanggal Servis</label>
                        <input type="date" name="tanggal_servis" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold mb-1 text-green-300">Keluhan Kendaraan</label>
                        <textarea name="keluhan_kendaraan" rows="2" placeholder="Tuliskan keluhan motor..." required class="stabilo-input w-full rounded-lg px-3 py-2"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="bg-green-400 hover:bg-green-500 text-zinc-950 font-bold px-5 py-2.5 rounded-lg shadow-[0_0_15px_rgba(74,222,128,0.4)] transition">
                            <i class="fas fa-save mr-1"></i> Simpan Daftar Service
                        </button>
                    </div>
                </form>
            </div>
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50 overflow-x-auto">
                <h3 class="font-bold mb-3 text-green-300">Tabel Daftar Service (MySQL)</h3>
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-green-950 text-green-300 border-b border-green-800">
                        <tr>
                            <th class="p-3">Id Servis</th>
                            <th class="p-3">No Plat</th>
                            <th class="p-3">Id Pelanggan</th>
                            <th class="p-3">Nama Pelanggan</th>
                            <th class="p-3">Keluhan</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-daftar" class="divide-y divide-green-900/30"></tbody>
                </table>
            </div>
        </section>

        <!-- 4. DATA SERVICE -->
        <section id="tab-data" class="tab-section hidden space-y-6">
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50">
                <h2 class="text-xl font-bold text-green-400 mb-4 border-b border-green-900/60 pb-2">4. Form Data Service</h2>
                <form onsubmit="submitForm(event, 'data-service')" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Id Servis Pelanggan (Drop Down)</label>
                        <select name="id_servis_pelanggan" id="select-servis-data" onchange="autoFillKeluhan()" required class="stabilo-input w-full rounded-lg px-3 py-2">
                            <option value="">-- Pilih Id Servis Pelanggan --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Estimasi Service</label>
                        <input type="text" name="estimasi_service" placeholder="Contoh: 2 Jam" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold mb-1 text-green-300">Keluhan Kendaraan (Otomatis)</label>
                        <input type="text" name="keluhan_kendaraan" id="auto-keluhan" readonly placeholder="Muncul otomatis setelah Id Servis dipilih" required class="stabilo-input w-full rounded-lg px-3 py-2 bg-green-950/60 font-semibold text-green-200">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Nama Mekanik</label>
                        <input type="text" name="nama_mekanik" placeholder="Nama mekanik yang mengerjakan" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Sparepart Pengganti</label>
                        <input type="text" name="sparepart_pengganti" placeholder="Contoh: Oli Mesin, Busi, Kampas Rem" required class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Status Pengerjaan</label>
                        <select name="status_pengerjaan" class="stabilo-input w-full rounded-lg px-3 py-2">
                            <option>Menunggu Antrean</option>
                            <option>Sedang Dikerjakan oleh Mekanik</option>
                            <option>Menunggu Konfirmasi Sparepart</option>
                            <option>Selesai &amp; Siap Diambil</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="bg-green-400 hover:bg-green-500 text-zinc-950 font-bold px-5 py-2.5 rounded-lg shadow-[0_0_15px_rgba(74,222,128,0.4)] transition">
                            <i class="fas fa-save mr-1"></i> Simpan Data Service
                        </button>
                    </div>
                </form>
            </div>
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50 overflow-x-auto">
                <h3 class="font-bold mb-3 text-green-300">Tabel Data Service (MySQL)</h3>
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-green-950 text-green-300 border-b border-green-800">
                        <tr>
                            <th class="p-3">Id Servis</th>
                            <th class="p-3">Keluhan</th>
                            <th class="p-3">Estimasi</th>
                            <th class="p-3">Mekanik</th>
                            <th class="p-3">Sparepart Pengganti</th>
                            <th class="p-3">Status Pengerjaan</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-data" class="divide-y divide-green-900/30"></tbody>
                </table>
            </div>
        </section>

        <!-- 5. PEMBAYARAN SERVICE -->
        <section id="tab-pembayaran" class="tab-section hidden space-y-6">
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50">
                <h2 class="text-xl font-bold text-green-400 mb-4 border-b border-green-900/60 pb-2">5. Form Pembayaran Service</h2>
                <form onsubmit="submitForm(event, 'pembayaran-service')" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Id Servis Pelanggan (Drop Down)</label>
                        <select name="id_servis_pelanggan" id="select-servis-bayar" required class="stabilo-input w-full rounded-lg px-3 py-2">
                            <option value="">-- Pilih Id Servis Pelanggan --</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Jumlah Biaya Servis (Rp)</label>
                        <input type="number" id="input-biaya" name="jumlah_biaya_servis" placeholder="Contoh: 250000" min="0" required oninput="previewPayment()" class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Jenis Pembayaran</label>
                        <div class="flex gap-6 pt-2">
                            <label class="flex items-center gap-2 cursor-pointer text-zinc-300">
                                <input type="radio" name="jenis_pembayaran" value="Cash / Tunai" checked class="w-4 h-4 accent-green-400">
                                <span>Cash / Tunai</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer text-zinc-300">
                                <input type="radio" name="jenis_pembayaran" value="Non Tunai" class="w-4 h-4 accent-green-400">
                                <span>Non Tunai</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-green-300">Keterangan</label>
                        <input type="text" name="keterangan" placeholder="Contoh: Lunas" class="stabilo-input w-full rounded-lg px-3 py-2">
                    </div>
                    <div class="md:col-span-2 rounded-lg border border-green-800 bg-green-950/40 p-4 text-sm text-green-200">
                        <div id="payment-preview">Pilih servis dan masukkan biaya untuk melihat estimasi diskon member.</div>
                        <p class="text-xs text-green-400 mt-1">Member mendapat diskon otomatis 10%. Garansi servis standar 7 hari.</p>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="bg-green-400 hover:bg-green-500 text-zinc-950 font-bold px-5 py-2.5 rounded-lg shadow-[0_0_15px_rgba(74,222,128,0.4)] transition">
                            <i class="fas fa-check-circle mr-1"></i> Proses Pembayaran
                        </button>
                    </div>
                </form>
            </div>
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50 overflow-x-auto">
                <h3 class="font-bold mb-3 text-green-300">Tabel Pembayaran Service (MySQL)</h3>
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-green-950 text-green-300 border-b border-green-800">
                        <tr>
                            <th class="p-3">Id Servis</th>
                            <th class="p-3">Biaya Awal</th>
                            <th class="p-3">Diskon</th>
                            <th class="p-3">Total Bayar</th>
                            <th class="p-3">Pembayaran</th>
                            <th class="p-3">Garansi</th>
                            <th class="p-3">Keterangan</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-pembayaran" class="divide-y divide-green-900/30"></tbody>
                </table>
            </div>
        </section>

        <!-- POSTMAN & GIT GUIDE -->
        <section id="tab-postman" class="tab-section hidden space-y-6">
            <div class="stabilo-card p-6 rounded-xl shadow-lg border-green-800/50 space-y-4">
                <h2 class="text-xl font-bold text-green-400 border-b border-green-900/60 pb-2">Endpoint API untuk Pengujian Postman</h2>
                <p class="text-sm text-zinc-300">Gunakan URL berikut di aplikasi <strong>Postman</strong> (Metode <code>GET</code>, <code>POST</code>, <code>PUT</code>, <code>DELETE</code> dengan Body <code>raw -> JSON</code>):</p>
                <div class="bg-zinc-950 text-green-400 p-4 rounded-lg font-mono text-xs space-y-2 overflow-x-auto border border-green-900/40">
                    <div>GET / POST : http://localhost/service_motor_laravel/public/api/pelanggan</div>
                    <div>GET / POST : http://localhost/service_motor_laravel/public/api/kendaraan</div>
                    <div>GET / POST : http://localhost/service_motor_laravel/public/api/daftar-service</div>
                    <div>GET / POST : http://localhost/service_motor_laravel/public/api/data-service</div>
                    <div>GET / POST : http://localhost/service_motor_laravel/public/api/pembayaran-service</div>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
const API_BASE = window.location.pathname.replace(/\/$/, '') + '/api';
let cache = { pelanggan: [], kendaraan: [], daftar: [], data: [], pembayaran: [] };

function switchTab(name) {
    document.querySelectorAll('.tab-section').forEach(el => el.classList.add('hidden'));
    document.getElementById('tab-' + name).classList.remove('hidden');
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.classList.remove('bg-green-400', 'text-zinc-950', 'shadow-[0_0_10px_rgba(74,222,128,0.3)]');
        btn.classList.add('text-zinc-400');
    });
    const active = document.getElementById('nav-' + name);
    active.classList.remove('text-zinc-400');
    active.classList.add('bg-green-400', 'text-zinc-950', 'shadow-[0_0_10px_rgba(74,222,128,0.3)]');
}

function showAlert(msg, isError = false) {
    const box = document.getElementById('alert-box');
    box.textContent = msg;
    box.className = 'mb-4 p-4 rounded-lg text-sm font-medium ' + (isError ? 'bg-red-950 text-red-300 border border-red-800' : 'bg-green-950 text-green-300 border border-green-800');
    box.classList.remove('hidden');
    setTimeout(() => box.classList.add('hidden'), 4000);
}


const STATUS_LIST = ['Menunggu Antrean','Sedang Dikerjakan oleh Mekanik','Menunggu Konfirmasi Sparepart','Selesai & Siap Diambil'];
function statusOptions(current) {
    return STATUS_LIST.map(s => `<option value="${s}" ${s === current ? 'selected' : ''}>${s}</option>`).join('');
}
async function updateServiceStatus(id, status) {
    const res = await fetch(API_BASE + '/data-service/' + id, {
        method: 'PUT', headers: {'Content-Type':'application/json','Accept':'application/json'},
        body: JSON.stringify({status_pengerjaan: status})
    });
    const json = await res.json();
    showAlert(res.ok ? 'Status pengerjaan berhasil diperbarui.' : (json.message || 'Gagal memperbarui status.'), !res.ok);
    if (res.ok) fetchAll();
}
function previewPayment() {
    const id = document.getElementById('select-servis-bayar')?.value;
    const amount = Number(document.getElementById('input-biaya')?.value || 0);
    const service = cache.daftar.find(x => x.id_servis_pelanggan === id);
    const customer = service && cache.pelanggan.find(x => x.id_pelanggan === service.id_pelanggan);
    const member = customer && Number(customer.is_member) === 1;
    const discount = member ? amount * .10 : 0;
    const target = document.getElementById('payment-preview');
    if (target) target.innerHTML = `Status: <b>${member ? 'MEMBER - diskon 10%' : 'UMUM - tanpa diskon'}</b> · Total estimasi: <b>Rp ${(amount-discount).toLocaleString('id-ID')}</b>`;
}
function printReceipt(id) {
    const payment = cache.pembayaran.find(x => Number(x.id) === Number(id));
    if (!payment) return showAlert('Data pembayaran tidak ditemukan.', true);
    const service = cache.daftar.find(x => x.id_servis_pelanggan === payment.id_servis_pelanggan) || {};
    const detail = cache.data.find(x => x.id_servis_pelanggan === payment.id_servis_pelanggan) || {};
    const money = n => 'Rp ' + Number(n || 0).toLocaleString('id-ID');
    const w = window.open('', '_blank', 'width=420,height=700');
    if (!w) return showAlert('Izinkan pop-up browser untuk mencetak nota.', true);
    w.document.write(`<!doctype html><html><head><title>Nota BE bike engine</title><style>
      @page{size:80mm auto;margin:4mm}body{font:12px Arial,sans-serif;color:#111;width:72mm;margin:auto}
      h2,p{text-align:center;margin:4px 0}hr{border:0;border-top:1px dashed #333;margin:9px 0}
      .line{display:flex;justify-content:space-between;gap:8px;margin:5px 0}.total{font-weight:bold;font-size:15px}
      @media screen{body{padding:12px}}
    </style></head><body>
      <h2>BE BIKE ENGINE</h2><p>Bukti Pembayaran Servis Motor</p><hr>
      <div class="line"><span>No. Servis</span><b>${payment.id_servis_pelanggan}</b></div>
      <div class="line"><span>Tanggal</span><span>${service.tanggal_servis || '-'}</span></div>
      <div class="line"><span>Pelanggan</span><span>${service.nama_pelanggan || '-'}</span></div>
      <div class="line"><span>No. Polisi</span><span>${service.no_plat_kendaraan || '-'}</span></div>
      <div class="line"><span>Mekanik</span><span>${detail.nama_mekanik || '-'}</span></div>
      <div class="line"><span>Sparepart</span><span>${detail.sparepart_pengganti || '-'}</span></div><hr>
      <div class="line"><span>Biaya awal</span><span>${money(payment.jumlah_biaya_servis)}</span></div>
      <div class="line"><span>Diskon (${payment.diskon_persen || 0}%)</span><span>- ${money(payment.diskon_nominal)}</span></div>
      <div class="line total"><span>Total bayar</span><span>${money(payment.total_bayar || payment.jumlah_biaya_servis)}</span></div>
      <div class="line"><span>Metode</span><span>${payment.jenis_pembayaran}</span></div>
      <div class="line"><span>Garansi</span><span>${payment.garansi_hari || 7} hari s.d. ${payment.garansi_sampai || '-'}</span></div>
      <hr><p>Terima kasih telah menggunakan layanan kami.</p><p>BE bike engine</p>
      <script>window.onload=()=>window.print();<\/script></body></html>`);
    w.document.close();
}

async function fetchAll() {
    try {
        const [resPlg, resKnd, resDft, resDat, resByr] = await Promise.all([
            fetch(API_BASE + '/pelanggan').then(r => r.json()),
            fetch(API_BASE + '/kendaraan').then(r => r.json()),
            fetch(API_BASE + '/daftar-service').then(r => r.json()),
            fetch(API_BASE + '/data-service').then(r => r.json()),
            fetch(API_BASE + '/pembayaran-service').then(r => r.json())
        ]);

        cache.pelanggan = resPlg.data || [];
        cache.kendaraan = resKnd.data || [];
        cache.daftar = resDft.data || [];
        cache.data = resDat.data || [];
        cache.pembayaran = resByr.data || [];

        renderTables(cache.pelanggan, cache.kendaraan, cache.daftar, resDat.data || [], resByr.data || []);
        populateDropdowns();
        previewPayment();
    } catch (e) {
        showAlert('Pastikan Apache & MySQL di XAMPP sudah Start!', true);
    }
}

function renderTables(plg, knd, dft, dat, byr) {
    document.getElementById('tbody-pelanggan').innerHTML = plg.map(r => `
        <tr class="hover:bg-green-950/20">
            <td class="p-3 font-semibold text-green-300">${r.id_pelanggan}</td>
            <td class="p-3">${r.nama_lengkap}</td>
            <td class="p-3">${r.no_hp}</td>
            <td class="p-3">${r.alamat_pelanggan}</td>
            <td class="p-3">${r.pekerjaan}</td>
            <td class="p-3">${Number(r.is_member) ? '<span class="text-green-300 font-bold">MEMBER</span>' : 'Umum'}</td>
            <td class="p-3"><button onclick="deleteRow('pelanggan', '${r.id_pelanggan}')" class="text-red-400 hover:underline">Hapus</button></td>
        </tr>`).join('');

    document.getElementById('tbody-kendaraan').innerHTML = knd.map(r => `
        <tr class="hover:bg-green-950/20">
            <td class="p-3 font-semibold text-green-300">${r.no_plat_kendaraan}</td>
            <td class="p-3"><span class="px-2 py-1 rounded text-xs font-bold ${r.jenis_kendaraan === 'Matic' ? 'bg-green-950 text-green-300 border border-green-800' : 'bg-emerald-950 text-emerald-300 border border-emerald-800'}">${r.jenis_kendaraan}</span></td>
            <td class="p-3">${r.no_stnk}</td>
            <td class="p-3">${r.tahun_pembuatan}</td>
            <td class="p-3">${r.nama_pemilik}</td>
            <td class="p-3">${r.warna_kendaraan}</td>
            <td class="p-3"><button onclick="deleteRow('kendaraan', '${r.no_plat_kendaraan}')" class="text-red-400 hover:underline">Hapus</button></td>
        </tr>`).join('');

    document.getElementById('tbody-daftar').innerHTML = dft.map(r => `
        <tr class="hover:bg-green-950/20">
            <td class="p-3 font-semibold text-green-300">${r.id_servis_pelanggan}</td>
            <td class="p-3">${r.no_plat_kendaraan}</td>
            <td class="p-3">${r.id_pelanggan}</td>
            <td class="p-3">${r.nama_pelanggan}</td>
            <td class="p-3">${r.keluhan_kendaraan}</td>
            <td class="p-3">${r.tanggal_servis}</td>
            <td class="p-3"><button onclick="deleteRow('daftar-service', '${r.id_servis_pelanggan}')" class="text-red-400 hover:underline">Hapus</button></td>
        </tr>`).join('');

    document.getElementById('tbody-data').innerHTML = dat.map(r => `
        <tr class="hover:bg-green-950/20">
            <td class="p-3 font-semibold text-green-300">${r.id_servis_pelanggan}</td>
            <td class="p-3">${r.keluhan_kendaraan}</td>
            <td class="p-3">${r.estimasi_service}</td>
            <td class="p-3">${r.nama_mekanik}</td>
            <td class="p-3">${r.sparepart_pengganti}</td>
            <td class="p-3 min-w-[230px]"><select onchange="updateServiceStatus(${r.id}, this.value)" class="stabilo-input rounded px-2 py-1 text-xs">${statusOptions(r.status_pengerjaan)}</select></td>
            <td class="p-3"><button onclick="deleteRow('data-service', '${r.id}')" class="text-red-400 hover:underline">Hapus</button></td>
        </tr>`).join('');

    document.getElementById('tbody-pembayaran').innerHTML = byr.map(r => `
        <tr class="hover:bg-green-950/20">
            <td class="p-3 font-semibold text-green-300">${r.id_servis_pelanggan}</td>
            <td class="p-3">Rp ${Number(r.jumlah_biaya_servis).toLocaleString('id-ID')}</td>
            <td class="p-3 text-green-300">${Number(r.diskon_persen || 0)}% (Rp ${Number(r.diskon_nominal || 0).toLocaleString('id-ID')})</td>
            <td class="p-3 font-bold text-green-400">Rp ${Number(r.total_bayar || r.jumlah_biaya_servis).toLocaleString('id-ID')}</td>
            <td class="p-3">${r.jenis_pembayaran}</td>
            <td class="p-3">${r.garansi_hari || 7} hari<br><span class="text-xs text-green-300">s.d. ${r.garansi_sampai || '-'}</span></td>
            <td class="p-3">${r.keterangan || '-'}</td>
            <td class="p-3 space-y-1"><button onclick="printReceipt(${r.id})" class="text-green-300 hover:underline block"><i class="fas fa-print"></i> Cetak Nota</button><button onclick="deleteRow('pembayaran-service', '${r.id}')" class="text-red-400 hover:underline">Hapus</button></td>
        </tr>`).join('');
}

function populateDropdowns() {
    document.getElementById('select-plat').innerHTML = '<option value="">-- Pilih No Plat Kendaraan --</option>' +
        cache.kendaraan.map(k => `<option value="${k.no_plat_kendaraan}">${k.no_plat_kendaraan} - ${k.nama_pemilik} (${k.jenis_kendaraan})</option>`).join('');

    document.getElementById('select-pelanggan').innerHTML = '<option value="">-- Pilih Id Pelanggan --</option>' +
        cache.pelanggan.map(p => `<option value="${p.id_pelanggan}">${p.id_pelanggan} - ${p.nama_lengkap}</option>`).join('');

    const srvOpts = '<option value="">-- Pilih Id Servis Pelanggan --</option>' +
        cache.daftar.map(s => `<option value="${s.id_servis_pelanggan}">${s.id_servis_pelanggan} (${s.no_plat_kendaraan} - ${s.nama_pelanggan})</option>`).join('');
    document.getElementById('select-servis-data').innerHTML = srvOpts;
    document.getElementById('select-servis-bayar').innerHTML = srvOpts;
}

function autoFillPelanggan() {
    const id = document.getElementById('select-pelanggan').value;
    const found = cache.pelanggan.find(p => p.id_pelanggan === id);
    document.getElementById('auto-nama-pelanggan').value = found ? found.nama_lengkap : '';
}

function autoFillKeluhan() {
    const id = document.getElementById('select-servis-data').value;
    const found = cache.daftar.find(s => s.id_servis_pelanggan === id);
    document.getElementById('auto-keluhan').value = found ? found.keluhan_kendaraan : '';
}

async function submitForm(e, endpoint) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const payload = Object.fromEntries(formData.entries());
    if (endpoint === 'pelanggan') payload.is_member = e.target.querySelector('[name=is_member]').checked ? 1 : 0;

    const res = await fetch(API_BASE + '/' + endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload)
    });
    const json = await res.json();
    if (res.ok) {
        showAlert(json.message || 'Data berhasil disimpan!');
        e.target.reset();
        previewPayment();
        fetchAll();
    } else {
        showAlert('Gagal menyimpan: ' + (json.message || 'Periksa kembali input Anda'), true);
    }
}

async function deleteRow(endpoint, id) {
    if (!confirm('Hapus data ini dari database MySQL?')) return;
    const res = await fetch(API_BASE + '/' + endpoint + '/' + encodeURIComponent(id), { method: 'DELETE' });
    if (res.ok) {
        showAlert('Data berhasil dihapus!');
        fetchAll();
    }
}

document.getElementById('select-servis-bayar')?.addEventListener('change', previewPayment);
document.getElementById('input-biaya')?.addEventListener('input', previewPayment);
fetchAll();
</script>
</body>
</html>
