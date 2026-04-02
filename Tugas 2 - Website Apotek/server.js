//  server.js  –  Backend Node.js + Express
const express = require('express');
const path    = require('path');
const fs      = require('fs');           
const app     = express();
const PORT    = 3000;

// Path file JSON database
const DB_PATH = path.join(__dirname, 'data', 'obat.json');

// ── Middleware 
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

// ── Helper: baca data JSON 
function bacaDB() {
  const isi = fs.readFileSync(DB_PATH, 'utf-8'); 
  return JSON.parse(isi);                         
}

// ── Helper: simpan data ke JSON 
function simpanDB(db) {
  const teks = JSON.stringify(db, null, 2);        
  fs.writeFileSync(DB_PATH, teks, 'utf-8');
}

// ── ROUTES 

// GET semua obat  →  /api/obat
app.get('/api/obat', (req, res) => {
  const db = bacaDB();
  res.json(db.obat);
});

// GET satu obat berdasarkan ID  →  /api/obat/:id
app.get('/api/obat/:id', (req, res) => {
  const db   = bacaDB();
  const obat = db.obat.find(o => o.id === parseInt(req.params.id));
  if (!obat) return res.status(404).json({ pesan: 'Obat tidak ditemukan' });
  res.json(obat);
});

// POST tambah obat baru  →  /api/obat
app.post('/api/obat', (req, res) => {
  const { nama, kategori, stok, harga, kadaluarsa } = req.body;
  if (!nama || !kategori || !stok || !harga || !kadaluarsa) {
    return res.status(400).json({ pesan: 'Semua field wajib diisi' });
  }

  const db = bacaDB();

  // Buat objek obat baru dengan ID unik
  const obatBaru = {
    id         : db.nextId,
    nama,
    kategori,
    stok       : parseInt(stok),
    harga      : parseInt(harga),
    kadaluarsa,
  };

  db.obat.push(obatBaru);   // tambah ke array
  db.nextId++;              // increment ID untuk obat berikutnya
  simpanDB(db); 

  res.status(201).json({ pesan: 'Obat berhasil ditambahkan', data: obatBaru });
});

// PUT update obat  →  /api/obat/:id
app.put('/api/obat/:id', (req, res) => {
  const db    = bacaDB();
  const index = db.obat.findIndex(o => o.id === parseInt(req.params.id));
  if (index === -1) return res.status(404).json({ pesan: 'Obat tidak ditemukan' });

  const { nama, kategori, stok, harga, kadaluarsa } = req.body;

  // Timpa data lama dengan data baru
  db.obat[index] = {
    ...db.obat[index],
    nama,
    kategori,
    stok       : parseInt(stok),
    harga      : parseInt(harga),
    kadaluarsa,
  };

  simpanDB(db);         

  res.json({ pesan: 'Obat berhasil diperbarui', data: db.obat[index] });
});

// DELETE hapus obat  →  /api/obat/:id
app.delete('/api/obat/:id', (req, res) => {
  const db    = bacaDB();
  const index = db.obat.findIndex(o => o.id === parseInt(req.params.id));
  if (index === -1) return res.status(404).json({ pesan: 'Obat tidak ditemukan' });

  db.obat.splice(index, 1); // hapus 1 elemen pada posisi index
  simpanDB(db);            

  res.json({ pesan: 'Obat berhasil dihapus' });
});

// ── Run Server 
app.listen(PORT, () => {
  console.log(`Server berjalan di http://localhost:${PORT}`);
  console.log(`Connect Data : ${DB_PATH}`);
});