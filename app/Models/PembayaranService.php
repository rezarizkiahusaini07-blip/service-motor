<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PembayaranService extends Model
{
    protected $table = 'pembayaran_services';
    protected $fillable = [
        'id_servis_pelanggan', 'jumlah_biaya_servis', 'jenis_pembayaran', 'keterangan', 'diskon_persen', 'diskon_nominal', 'total_bayar', 'garansi_hari', 'garansi_sampai'
    ];
}
