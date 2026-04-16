<?php
// data.php — File Server

// Header agar browser tahu ini JSON
header('Content-Type: application/json');

// Izinkan CORS (opsional)
header('Access-Control-Allow-Origin: *');

//  DATA
$profil = [
    ['nama' => 'Budi',    'pekerjaan' => 'Web Developer',   'lokasi' => 'Jakarta'],
    ['nama' => 'Putri',    'pekerjaan' => 'UI/UX Designer',  'lokasi' => 'Bandung'],
    ['nama' => 'Putra',   'pekerjaan' => 'Data Analyst',    'lokasi' => 'Surabaya'],
    ['nama' => 'Dewi',    'pekerjaan' => 'Backend Engineer', 'lokasi' => 'Yogyakarta'],
    ['nama' => 'Kiki',    'pekerjaan' => 'DevOps Engineer', 'lokasi' => 'Bali'],
];

// Ubah array PHP -> JSON lalu tampilkan
echo json_encode($profil, JSON_PRETTY_PRINT);
?>
