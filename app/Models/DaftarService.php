<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DaftarService extends Model
{
    protected $table = 'daftar_services';
    protected $primaryKey = 'id_servis_pelanggan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_servis_pelanggan', 'no_plat_kendaraan', 'id_pelanggan',
        'nama_pelanggan', 'keluhan_kendaraan', 'tanggal_servis'
    ];
}
