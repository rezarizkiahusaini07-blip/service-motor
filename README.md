# BE bike engine - Sistem Informasi Service Motor (Laravel + MySQL XAMPP + API Postman + Git)

## Cara Pasang di XAMPP (`htdocs`)
1. Ekstrak folder `service-motor_laravel` ke dalam `C:\xampp\htdocs\`.
2. Buka **XAMPP Control Panel**, klik **Start** pada **Apache** dan **MySQL**.
3. Buka browser dan akses:
   `http://localhost/service-motor_laravel/public`


## Fitur inovasi BE bike engine
- **Live status pengerjaan:** status antrean, sedang dikerjakan, menunggu sparepart, dan selesai dapat diubah langsung dari tabel Data Service.
- **Member & diskon otomatis:** tandai pelanggan sebagai member ketika mendaftar; pembayaran member mendapat diskon 10%.
- **Nota servis thermal:** tombol Cetak Nota membuka nota ukuran 80mm dan memanggil dialog cetak browser.
- **Garansi servis:** setiap pembayaran menyimpan garansi standar 7 hari dan tanggal akhir garansi.

### Pembaruan database
- **Instalasi baru:** impor `db_service_motor.sql` yang sudah mencakup kolom inovasi.
- **Database lama:** buka phpMyAdmin, pilih database `db_service_motor`, lalu impor file `upgrade_inovasi.sql` satu kali. Jangan jalankan file upgrade ini pada database yang kolom inovasinya sudah tersedia.
