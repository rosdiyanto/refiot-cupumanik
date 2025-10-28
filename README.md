# REFIOT


REFIOT adalah inovasi Smart Card ASN Digital yang mengintegrasikan teknologi **RFID (Radio Frequency Identification)** dan **IoT (Internet of Things)** untuk meningkatkan efisiensi pelayanan kepegawaian.  
Sistem ini memungkinkan setiap ASN memiliki **kartu pintar multifungsi** sebagai identitas digital, absensi otomatis, akses fasilitas kantor, dan pemantauan aktivitas pegawai secara real-time.  
Dengan menggabungkan RFID dan IoT, REFIOT menciptakan ekosistem digital yang **efisien, aman, dan transparan**, mendukung transformasi menuju **data-driven governance** di sektor aparatur sipil negara.

---

##  Instalasi Awal

1. Clone repository ini:
   ```bash
   git clone https://github.com/rosdiyanto/refiot-cupumanik.git
   cd refiot-cupumanik
   ```

2. Install dependensi menggunakan Composer:
   ```bash
   composer install
   ```

---

##  Konfigurasi Aplikasi

1. Salin file `.env.example` menjadi `.env`:
   ```bash
   cp env .env
   ```

2. Atur konfigurasi dasar aplikasi di file `.env`:
   ```dotenv
   app.baseURL = 'http://localhost:8080/'
   app.indexPage = ''
   ```

3. Sesuaikan koneksi database:
   ```dotenv
   database.default.hostname = localhost
   database.default.database = ''
   database.default.username = ''
   database.default.password = ''
   database.default.DBDriver = MySQLi
   database.default.DBPrefix =
   database.default.port = 3306
   ```

---

##  Generate Key Aplikasi

Jalankan perintah berikut untuk membuat enkripsi key:
```bash
php spark key:generate
```

---

## Jalankan semua migrasi:
```bash
php spark migrate -all
```

---

## Jalankan semua seeder:
```bash
php spark db:seedall
```

---

##  Menjalankan Server Lokal

Untuk menjalankan server bawaan CodeIgniter:
```bash
php spark serve
```

Server akan berjalan di:
 **http://localhost:8080/**

---

##  Catatan Tambahan

- Pastikan PHP versi minimal **8.1**
- Ekstensi PHP yang disarankan:
  - `dotenv`
  - `intl`
  - `json`
  - `mbstring`
  - `curl`
  - `openssl`
  - `pdo`
  - `pdo_mysql`
  - `fileinfo`

---