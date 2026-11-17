<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('data_services', function (Blueprint $table) {
            $table->id();
            $table->string('id_servis_pelanggan', 20);
            $table->text('keluhan_kendaraan');
            $table->string('estimasi_service', 100);
            $table->string('nama_mekanik', 100);
            $table->text('sparepart_pengganti');
            $table->string('status_pengerjaan', 60)->default('Menunggu Antrean');
            $table->timestamps();

            $table->foreign('id_servis_pelanggan')->references('id_servis_pelanggan')->on('daftar_services')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('data_services'); }
};
