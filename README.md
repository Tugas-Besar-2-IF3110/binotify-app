# Tugas Besar 1 IF3110 - HaBeDe
## Deskripsi Aplikasi Web

Aplikasi web yang dibuat merupakan sebuah aplikasi yang menyerupai sebuah *streaming service* berbasis web. Aplikasi akan memuat album serta lagu yang dapat didengar oleh penggunanya. Pengguna dibagi menjadi 2, *user* dan *admin*. *User* dapat melakukan hal-hal seperti melihat daftar dan detail album, melihat detail lagu, mencari lagu, mendengarkan lagu, melakukan *subscribe* kepada penyanyi yang telah mendaftar ke Binotify Premium App, dan mendengarkan lagu dari penyanyi yang telah di-*subscribe*. *Admin* dapat melakukan hal-hal yang dilakukan oleh *user* dengan tambahan seperti menghapus dan menambahkan album, menghapus dan menambahkan lagu, mendengarkan lagu, melihat daftar *user* yang ada.

## Daftar *Requirement*

- XAMPP
- MySQL
- Docker (Optional)

## Cara Instalasi

- Instalasi XAMPP dapat dilakukan melalui situs berikut. https://www.apachefriends.org/download.html
- Instalasi MySQL dapat dilakukan melalui situs berikut. https://dev.mysql.com/downloads/installer/
- Instalasi Docker dapat dilakukan melalui situs berikut. https://docs.docker.com/engine/install/

## Cara Menjalankan *Server*

- Siapkan file `.env` dengan menyalin template dari file `.env.example`. (Apabila ingin menjalankan website tanpa menggunakan database Docker, silahkan mengganti value yang sesuai untuk setiap key).

- Jika menjalankan server menggunakan Docker, jalankan perintah berikut pada terminal.

Untuk membuat dan menjalankan container di foreground

`docker compose up`

Untuk membuat dan menjalankan container di background

`docker compose up -d`

Untuk menghentikan container

`docker compose stop`

Untuk menghentikan dan menghapus container

`docker compose down`

- Jika menjalankan server tanpa menggunakan Docker, dapat dilakukan dengan menyalin atau memindahkan folder ini (`tugas-besar-1`) ke dalam folder `htdocs` dalam folder `XAMPP`. Kemudian, nyalakan server `Apache` XAMPP dan server dapat dijalankan pada `localhost/tugas-besar-1/public`.

## *Sreenshot* Tampilan Aplikasi

### Login
<img src="screenshots/login.png" /><br>

### Register
<img src="screenshots/register.png" /><br>

### Home
<img src="screenshots/home.png" /><br>

### Daftar Album
<img src="screenshots/daftaralbum.png" /><br>

### Search, Sort, Filter
<img src="screenshots/search.png" /><br>

### Detail Lagu
<img src="screenshots/detaillagu.png" /><br>

### Detail Album
<img src="screenshots/detailalbum.png" /><br>

### Tambah Album
<img src="screenshots/addalbum.png" /><br>

### Tambah Lagu
<img src="screenshots/addsong.png" /><br>

### Edit Album
<img src="screenshots/editalbum.png" /><br>

### Edit Lagu
<img src="screenshots/editsong.png" /><br>

### Daftar User
<img src="screenshots/daftaruser.png" /><br>

### Daftar Penyanyi Premium
<img src="screenshots/daftarpenyanyi.png" /><br>

### Daftar Lagu Premium
<img src="screenshots/daftarpremium.png" /><br>

## Pembagian Tugas
*Client-Side*
* Login: `13520160`<br>
* Register: `13520160`<br>
* Home: `13520133`<br>
* Daftar Album: `13520133`<br>
* Search, Sort, Filter: `13520133`, `13520154`<br>
* Detail Lagu: `13520154`<br>
* Detail Album: `13520154`<br>
* Tambah Album/Lagu: `13520154`, `13520160`<br>
* Daftar User: `13520160`<br><br>
* Daftar Penyanyi Premium: `13520133`, `13520160`<br>
* Daftar Lagu Premium: `13520133`, `13520160`<br>

*Server-Side*
* Login: `13520160`<br>
* Register: `13520160`<br>
* Home: `13520133`, `13520160`<br>
* Daftar Album: `13520133`<br>
* Search, Sort, Filter: `13520133`, `13520154`, `13520160`<br>
* Detail Lagu: `13520154`<br>
* Detail Album: `13520154`<br>
* Tambah Album/Lagu: `13520154`, `13520160`<br>
* Daftar User: `13520160`<br><br>
* Daftar Penyanyi Premium: `13520133`, `13520154`<br>
* Daftar Lagu Premium: `13520133`, `13520154`<br>