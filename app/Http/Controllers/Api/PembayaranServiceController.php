<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PembayaranService;
use App\Models\DaftarService;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PembayaranServiceController extends Controller
{
    public function index() {
        return response()->json(['status' => 'success', 'data' => PembayaranService::latest()->get()]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_services,id_servis_pelanggan',
            'jumlah_biaya_servis' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);

        $daftar = DaftarService::findOrFail($validated['id_servis_pelanggan']);
        $pelanggan = Pelanggan::find($daftar->id_pelanggan);
        $isMember = (bool) ($pelanggan->is_member ?? false);
        $diskonPersen = $isMember ? 10 : 0;
        $diskonNominal = round(((float) $validated['jumlah_biaya_servis']) * $diskonPersen / 100, 2);
        $totalBayar = max(0, (float) $validated['jumlah_biaya_servis'] - $diskonNominal);
        $garansiHari = 7;

        $data = PembayaranService::create([
            ...$validated,
            'diskon_persen' => $diskonPersen,
            'diskon_nominal' => $diskonNominal,
            'total_bayar' => $totalBayar,
            'garansi_hari' => $garansiHari,
            'garansi_sampai' => Carbon::parse($daftar->tanggal_servis)->addDays($garansiHari)->toDateString(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $isMember ? 'Pembayaran berhasil. Diskon member 10% diterapkan.' : 'Pembayaran berhasil dicatat.',
            'data' => $data,
        ], 201);
    }

    public function show($id) {
        return response()->json(['status' => 'success', 'data' => PembayaranService::findOrFail($id)]);
    }

    public function update(Request $request, $id) {
        $data = PembayaranService::findOrFail($id);
        $validated = $request->validate([
            'jenis_pembayaran' => 'sometimes|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);
        $data->update($validated);
        return response()->json(['status' => 'success', 'message' => 'Pembayaran diperbarui', 'data' => $data]);
    }

    public function destroy($id) {
        PembayaranService::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Pembayaran dihapus']);
    }
}
