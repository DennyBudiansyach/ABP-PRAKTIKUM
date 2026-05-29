# Penjelasan Singkat Tiap Widget (Kamera & Notifikasi)

Berikut adalah penjelasan mengenai widget UI dan pustaka API utama yang diimplementasikan pada tugas ini:

### 1. Widget Antarmuka (UI)
* **SingleChildScrollView**: Membungkus seluruh elemen antarmuka agar layar dapat digulir (*scrollable*). Ini sangat penting untuk mencegah *error bottom overflow* pada perangkat dengan layar kecil.
* **Container & ClipRRect**: `Container` digunakan untuk mendesain kotak bingkai (*border*) abu-abu tempat foto diletakkan. Di dalamnya terdapat widget `ClipRRect` yang berfungsi untuk memotong ujung sudut foto agar melengkung rapi (*rounded corners*) menyesuaikan bingkai.
* **Image.file**: Berbeda dengan `Image.network` atau `Image.asset`, widget ini secara khusus bertugas merender dan menampilkan file gambar yang ditarik langsung dari penyimpanan lokal direktori perangkat.
* **ElevatedButton.icon**: Widget tombol dengan desain *Material* yang mendukung penyisipan ikon di sebelah teks. Digunakan sebagai *trigger* interaktif agar pengguna dapat memanggil fungsi `_getImage`.

### 2. Pustaka API (Packages)
* **image_picker**: Pustaka yang berfungsi sebagai jembatan (*bridge*) antara aplikasi Flutter dengan API perangkat keras Android. Digunakan untuk memanggil antarmuka kamera (`ImageSource.camera`) dan sistem galeri foto bawaan (`ImageSource.gallery`).
* **flutter_local_notifications**: Pustaka untuk memicu *push notification* secara lokal (tanpa server). Dikonfigurasi menggunakan *channel* prioritas tinggi (`Importance.max`) agar notifikasi berhasil ditangkap muncul sebagai *pop-up* mengambang dari atas layar sesaat setelah gambar selesai di-render.