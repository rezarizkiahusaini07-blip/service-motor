<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pembayaran_services', function (Blueprint $table) {
            $table->id();
            $table->string('id_servis_pelanggan', 20);
            $table->decimal('jumlah_biaya_servis', 12, 2);
            $table->enum('jenis_pembayaran', ['Cash / Tunai', 'Non Tunai']);
            $table->text('keterangan')->nullable();
            $table->decimal('diskon_persen', 5, 2)->default(0);
            $table->decimal('diskon_nominal', 12, 2)->default(0);
            $table->decimal('total_bayar', 12, 2)->default(0);
            $table->unsignedInteger('garansi_hari')->default(7);
            $table->date('garansi_sampai')->nullable();
            $table->timestamps();

            $table->foreign('id_servis_pelanggan')->references('id_servis_pelanggan')->on('daftar_services')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('pembayaran_services'); }
};
