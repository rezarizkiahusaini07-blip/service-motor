-- Jalankan sekali pada database db_service_motor yang sudah ada sebelum versi inovasi.
USE `db_service_motor`;

ALTER TABLE `pelanggans`
  ADD COLUMN `is_member` TINYINT(1) NOT NULL DEFAULT 0;

ALTER TABLE `data_services`
  ADD COLUMN `status_pengerjaan` VARCHAR(60) NOT NULL DEFAULT 'Menunggu Antrean';

ALTER TABLE `pembayaran_services`
  ADD COLUMN `diskon_persen` DECIMAL(5,2) NOT NULL DEFAULT 0,
  ADD COLUMN `diskon_nominal` DECIMAL(12,2) NOT NULL DEFAULT 0,
  ADD COLUMN `total_bayar` DECIMAL(12,2) NOT NULL DEFAULT 0,
  ADD COLUMN `garansi_hari` INT UNSIGNED NOT NULL DEFAULT 7,
  ADD COLUMN `garansi_sampai` DATE NULL;

-- Samakan total_bayar untuk pembayaran lama agar struk menampilkan nominal yang benar.
UPDATE `pembayaran_services`
SET `total_bayar` = `jumlah_biaya_servis`
WHERE `total_bayar` = 0;
