<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DaftarServiceController extends Controller
{
    public function index() {
        return response()->json(['status' => 'success', 'data' => DaftarService::latest()->get()]);
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|unique:daftar_services,id_servis_pelanggan',
            'no_plat_kendaraan' => 'required|exists:kendaraans,no_plat_kendaraan',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'nama_pelanggan' => 'required',
            'keluhan_kendaraan' => 'required',
            'tanggal_servis' => 'required|date',
        ]);
        $data = DaftarService::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Pendaftaran servis berhasil', 'data' => $data], 201);
    }
    public function show($id) {
        return response()->json(['status' => 'success', 'data' => DaftarService::findOrFail($id)]);
    }
    public function update(Request $request, $id) {
        $data = DaftarService::findOrFail($id);
        $data->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Daftar servis diperbarui', 'data' => $data]);
    }
    public function destroy($id) {
        DaftarService::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Daftar servis dihapus']);
    }
}
