<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\DataService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    public function index() {
        return response()->json(['status' => 'success', 'data' => DataService::latest()->get()]);
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'id_servis_pelanggan' => 'required|exists:daftar_services,id_servis_pelanggan',
            'keluhan_kendaraan' => 'required',
            'estimasi_service' => 'required',
            'nama_mekanik' => 'required',
            'sparepart_pengganti' => 'required',
            'status_pengerjaan' => 'sometimes|in:Menunggu Antrean,Sedang Dikerjakan oleh Mekanik,Menunggu Konfirmasi Sparepart,Selesai & Siap Diambil',
        ]);
        $validated['status_pengerjaan'] = $validated['status_pengerjaan'] ?? 'Menunggu Antrean';
        $data = DataService::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Data pengerjaan servis disimpan', 'data' => $data], 201);
    }
    public function show($id) {
        return response()->json(['status' => 'success', 'data' => DataService::findOrFail($id)]);
    }
    public function update(Request $request, $id) {
        $data = DataService::findOrFail($id);
        $validated = $request->validate([
            'status_pengerjaan' => 'sometimes|in:Menunggu Antrean,Sedang Dikerjakan oleh Mekanik,Menunggu Konfirmasi Sparepart,Selesai & Siap Diambil',
            'estimasi_service' => 'sometimes|string|max:100',
            'nama_mekanik' => 'sometimes|string|max:100',
            'sparepart_pengganti' => 'sometimes|string',
        ]);
        $data->update($validated);
        return response()->json(['status' => 'success', 'message' => 'Data servis diperbarui', 'data' => $data]);
    }
    public function destroy($id) {
        DataService::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Data servis dihapus']);
    }
}
