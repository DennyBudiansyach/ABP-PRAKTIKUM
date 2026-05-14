# 2311102022 - Denny Budiansyach
# Penjelasan Singkat Widget UI Flutter

1. **Container** Merupakan widget dasar yang digunakan untuk membungkus widget lain guna mengatur *styling* (seperti padding, margin, border, dan warna latar). Pada kode ini, `Container` digunakan untuk membuat kotak berwarna amber dengan sudut yang melengkung (*border radius*).

2. **GridView** Widget yang digunakan untuk menampilkan sekumpulan item dalam tata letak grid dua dimensi (baris dan kolom) yang bisa di-scroll. Di kode ini, menggunakan `GridView.count` dengan pengaturan 3 kolom (`crossAxisCount: 3`) untuk merender 6 kotak berwarna secara berurutan.

3. **ListView** Widget dasar untuk menampilkan daftar item secara linier (vertikal atau horizontal) yang mendukung fitur *scrolling*. Pada kode ini, `ListView` standar digunakan untuk menyusun 3 item statis (A, B, dan C) secara *hardcoded* menggunakan widget `ListTile`.

4. **ListView.builder** Varian dari ListView yang dirancang khusus untuk merender daftar item yang panjang atau dinamis secara lebih efisien memori (*lazy loading*). Widget ini mengambil data dari sebuah *array* (`dataArray`) dan hanya merender item saat akan muncul di layar.

5. **ListView.separated** Memiliki fungsi dan efisiensi yang sama dengan `ListView.builder`, namun memiliki keunggulan: parameter `separatorBuilder`. Fitur ini memungkinkan kita untuk menyisipkan widget pemisah secara otomatis di antara setiap item. Pada kode ini, pemisahnya berupa garis horizontal berwarna merah (`Divider`).

6. **Stack** Widget layout memungkinkan penempatan beberapa widget saling bertumpuk satu sama lain pada sumbu Z (kedalaman). Konsep *layer*. Widget yang dideklarasikan pertama kali pada *array children* akan berada di tumpukan paling bawah. Pada kode ini, `Stack` menumpuk kotak berwarna indigo (paling bawah), kotak oranye (tengah), dan teks putih (paling atas).