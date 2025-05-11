<h1 align="center">Sistem Pemesana Jasa Laundry</h1>

<hr/>

<p align="center">
  <img src="https://github.com/user-attachments/assets/36f5b8ce-b59d-4c5d-892f-31a6f36b31b5" alt="Logo Unsulbar" width="200"/>
</p>

<p align="center">
  <strong>Yulia Sagita Putri</strong><br/><br/>
  <strong>D0223022</strong><br/><br/>
  <strong>Framework Web Based</strong><br/><br/>
  <strong>2025</strong>
</p>

---

## 👥 Role dan Fitur-fiturnya

### Admin
*Fitur utama:*
a. Menghapus akun pengguna jika ditemukan pelanggaran
b. Melihat daftar layanan laundry
c. Melihat laporan transaksi
d. Melihat daftar semua pengguna (customer dan petugas)
e. Admin bisa melihat profil user

### Petugas

*Fitur utama:*
a.	Mengelola status pesanan laundry, seperti Mengubah status pesanan (Dikemas, Dalam proses, Dikirim, Selesai)
b.	Melakukan update status transaksi, contohnya (Pembayaran berhasil dan menandai transaksi lunas)
c.	Menambah Layanan baru
d.	Petugas bisa melihat profil custumer 

### Customer

*Fitur utama:*
a.	Melakukan pemesanan layanan laundry: Memilih layanan (contoh: Cuci Kering, Kiloan, Setrika). Menentukan alamat penjemputan/pengantaran. Mengisi catatan tambahan (misalnya: "pakai pelembut").
b.	Melihat status pesanan Menunggu (Dijemput, Dikemas, Dalam Proses, Dikirim, Selesai)
c.	Melihat riwayat transaksi dan status pembayaran 
d.	Mengatur profil akun
e.	Customer bisa melihat profil petugas

---

## 🗄 Tabel-Tabel Database

### 1. users

| Nama Field  | Tipe Data     | Keterangan                        |
| ----------- | ------------- | --------------------------------- |
| id          | bigIncrements | Primary Key                       |
| name        | string        | Nama pengguna                     |
| email       | string        | Email unik                        |
| password    | string        | Password terenkripsi              |
| role        | enum          | ['admin', 'petugas', 'customer'] |
| created_at | timestamps    | Waktu dibuat                      |
| updated_at | timestamps    | Waktu diupdate                    |

### 2. Tabel services

| Nama Field  | Tipe Data     | Keterangan                                    |
| ----------- | ------------- | --------------------------------------------- |
| id          | bigIncrements | ID unik untuk layanan (Primary Key, auto)     |
| name        | string        | Nama layanan laundry (misal: Cuci Kering)     |
| description | text          | Deskripsi layanan                             |
| price       | decimal(10,2) | Harga layanan dengan 2 angka di belakang koma |
| tersedia    | integer       | Jumlah stok layanan yang tersedia             |
| created_at | timestamps    | Waktu dibuat                                  |
| updated_at | timestamps    | Waktu diupdate                                |


### 3. Tabel  Orders

| Nama Field   | Tipe Data     | Keterangan                                          |
| ------------ | ------------- | --------------------------------------------------- |
| id           | bigIncrements | ID unik untuk layanan (Primary Key, auto)           |
| user_id     | foreignId     | ID pengguna (relasi dengan tabel pengguna)          |
| order_date  | date          | Tanggal pemesanan layanan                           |
| total_price | decimal(10,2) | Harga total layanan dengan 2 angka di belakang koma |
| status       | string        | Status pemesanan, default = "Menunggu Konfirmasi"   |
| created_at  | timestamps    | Waktu dibuat                                        |
| updated_at  | timestamps    | Waktu diupdate                                      |

### 4. Tabel order_service

| Nama Field  | Tipe Data     | Keterangan                                         |
| ----------- | ------------- | -------------------------------------------------- |
| id          | bigIncrements | ID unik untuk relasi layanan-pesanan (Primary Key) |
| order_id   | foreignId     | Menghubungkan ke tabel orders                      |
| service_id | foreignId     | Menghubungkan ke tabel services                    |
| quantity    | integer       | Jumlah layanan yang dipesan                        |
| subtotal    | decimal(10,2) | Total harga (harga layanan \* quantity)            |
| created_at | timestamps    | Waktu dibuat                                       |
| updated_at | timestamps    | Waktu diupdate                                     |


### 5. Tabel transactions

| Nama Field        | Tipe Data     | Keterangan                                    |
| ----------------- | ------------- | --------------------------------------------- |
| id                | bigIncrements | Primary Key                                   |
| order_id         | foreignId     | Relasi ke tabel orders                        |
| payment_method   | string        | Metode pembayaran, default = 'Cash'           |
| amount_paid      | decimal(10,2) | Jumlah uang yang dibayar                      |
| transaction_date | timestamp     | Waktu transaksi (otomatis diisi dengan now()) |
| created_at       | timestamps    | Waktu dibuat                                  |
| updated_at       | timestamps    | Waktu diupdate                                |


### 6. Tabel order_status

| Nama Field  | Tipe Data     | Keterangan                                                   |
| ----------- | ------------- | ------------------------------------------------------------ |
| id          | bigIncrements | Primary Key                                                  |
| order\_id   | foreignId     | Relasi ke tabel orders, menghubungkan status ke pesanan      |
| status      | string        | Menyimpan status pesanan (contoh: Dipesan, Dikemas, Dikirim) |
| created\_at | timestamps    | Waktu dibuat                                                 |
| updated\_at | timestamps    | Waktu diupdate                                               |


### 7. Tabel profil

| Nama Field        | Tipe Data       | Keterangan                              |
| ----------------- | --------------- | --------------------------------------- |
| id                | bigIncrements   | Primary Key                             |
| user_id           | foreignId       | Relasi ke tabel users, cascade delete   |
| address           | string          | Alamat pengguna, nullable               |
| phone_number      | string          | Nomor telepon pengguna, nullable        |
| profile_picture   | string          | URL foto profil pengguna, nullable      |
| created_at        | timestamps      | Waktu dibuat                            |
| updated_at        | timestamps      | Waktu diupdate                          |



---

## 🔗 Relasi Antar Tabel

| Tabel 1         | Tabel 2         | Jenis Relasi      | Penjelasan                                                                                                          |
|-----------------|-----------------|-------------------|--------------------------------------------------------------------------------------------------------------------|
| users           | orders          | One to Many       | Setiap user (pelanggan) bisa memiliki banyak orders (pesanan).                                                     |
|                 |                 |                   | Dan setiap order (pesanan) hanya terkait dengan satu user.                                                         |
| orders          | order_service  | One to Many       | Setiap order bisa memiliki banyak order_service yang menyimpan layanan yang dipesan.                                |
|                 |                 |                   | Dan setiap order_service hanya terkait dengan satu order.                                                           
| services        | order_service | One to Many         | Setiap service (layanan) bisa ada dalam banyak order_service (melalui banyak pesanan).                             |
|                 |                 |                   | Dan setiap order_service menyimpan rincian tentang layanan yang dipesan dalam sebuah pesanan.                      |
| orders          | transactions    | One to One / One to Many | Setiap order memiliki satu transaction (pembayaran) terkait.                                                 
|                 |                 |                   | Namun, satu order bisa punya lebih dari satu transaksi jika sistem mendukung beberapa pembayaran.                  |
| orders          | order_status    | One to Many       | Setiap order bisa memiliki banyak status perubahan dalam tabel order_status.                                       |
|                 |                 |                   | Dan setiap status perubahan hanya terkait dengan satu order.                                                      |

