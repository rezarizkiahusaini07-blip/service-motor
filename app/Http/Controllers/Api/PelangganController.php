<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index() {
        return response()->json(['status' => 'success', 'data' => Pelanggan::latest()->get()]);
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'alamat_pelanggan' => 'required',
            'pekerjaan' => 'required',
            'is_member' => 'sometimes|boolean',
        ]);
        $data = Pelanggan::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Pelanggan berhasil ditambahkan', 'data' => $data], 201);
    }
    public function show($id) {
        $data = Pelanggan::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $data]);
    }
    public function update(Request $request, $id) {
        $data = Pelanggan::findOrFail($id);
        $data->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Pelanggan diperbarui', 'data' => $data]);
    }
    public function destroy($id) {
        Pelanggan::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Pelanggan dihapus']);
    }
}
