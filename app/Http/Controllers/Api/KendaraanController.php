<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index() {
        return response()->json(['status' => 'success', 'data' => Kendaraan::latest()->get()]);
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'no_plat_kendaraan' => 'required|unique:kendaraans,no_plat_kendaraan',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transimisi',
            'no_stnk' => 'required',
            'tahun_pembuatan' => 'required|digits:4',
            'nama_pemilik' => 'required',
            'warna_kendaraan' => 'required',
        ]);
        $data = Kendaraan::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Kendaraan berhasil ditambahkan', 'data' => $data], 201);
    }
    public function show($id) {
        return response()->json(['status' => 'success', 'data' => Kendaraan::findOrFail($id)]);
    }
    public function update(Request $request, $id) {
        $data = Kendaraan::findOrFail($id);
        $data->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Kendaraan diperbarui', 'data' => $data]);
    }
    public function destroy($id) {
        Kendaraan::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Kendaraan dihapus']);
    }
}
