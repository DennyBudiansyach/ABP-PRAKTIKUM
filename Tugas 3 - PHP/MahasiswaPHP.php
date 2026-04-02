<?php
// SISTEM PENILAIAN MAHASISWA
$mahasiswa = [
    [
        "nama"        => "Rio",
        "nim"         => "2311102001",
        "nilai_tugas" => 85,
        "nilai_uts"   => 78,
        "nilai_uas"   => 82,
    ],
    [
        "nama"        => "Putra",
        "nim"         => "2311102002",
        "nilai_tugas" => 70,
        "nilai_uts"   => 65,
        "nilai_uas"   => 60,
    ],
    [
        "nama"        => "Putri",
        "nim"         => "2311102003",
        "nilai_tugas" => 90,
        "nilai_uts"   => 88,
        "nilai_uas"   => 92,
    ],
    [
        "nama"        => "Yuli",
        "nim"         => "2311102004",
        "nilai_tugas" => 55,
        "nilai_uts"   => 50,
        "nilai_uas"   => 48,
    ],
    [
        "nama"        => "Eka", 
        "nim"         => "2311102005",
        "nilai_tugas" => 78,
        "nilai_uts"   => 80,
        "nilai_uas"   => 75,
    ],
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35); // Bobot: Tugas 30%, UTS 35%, UAS 35%
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 75) {
        return "B";
    } elseif ($nilai >= 65) {
        return "C";
    } elseif ($nilai >= 55) {
        return "D";
    } else {
        return "E";
    }
}

function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "LULUS" : "TIDAK LULUS";
}

$totalNilai   = 0;
$nilaiTertinggi = 0;
$namaTertinggi  = "";

foreach ($mahasiswa as &$mhs) {
    $akhir = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
    $mhs["nilai_akhir"] = round($akhir, 2);
    $mhs["grade"]       = tentukanGrade($mhs["nilai_akhir"]);
    $mhs["status"]      = tentukanStatus($mhs["nilai_akhir"]);

    $totalNilai += $mhs["nilai_akhir"];

    if ($mhs["nilai_akhir"] > $nilaiTertinggi) {
        $nilaiTertinggi = $mhs["nilai_akhir"];
        $namaTertinggi  = $mhs["nama"];
    }
}
unset($mhs);

$rataRata = round($totalNilai / count($mahasiswa), 2);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 30px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 6px;
            color: #2c3e50;
        }

        p.subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 24px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        thead tr {
            background: #2c3e50;
            color: #fff;
        }

        th, td {
            padding: 12px 14px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tbody tr:hover { background: #f8f9fa; }
        tbody tr:last-child td { border-bottom: none; }

        /* color Grade */
        .grade-A { color: #16a34a; font-weight: bold; }
        .grade-B { color: #2563eb; font-weight: bold; }
        .grade-C { color: #d97706; font-weight: bold; }
        .grade-D { color: #ea580c; font-weight: bold; }
        .grade-E { color: #dc2626; font-weight: bold; }

        /* Status */
        .lulus {
            background: #dcfce7; color: #16a34a;
            padding: 3px 10px; border-radius: 12px;
            font-size: 12px; font-weight: bold;
        }
        .tidak-lulus {
            background: #fee2e2; color: #dc2626;
            padding: 3px 10px; border-radius: 12px;
            font-size: 12px; font-weight: bold;
        }

        .summary {
            display: flex;
            gap: 16px;
            margin-top: 20px;
        }

        .card {
            flex: 1;
            background: #fff;
            border-radius: 8px;
            padding: 16px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-align: center;
        }

        .card .label {
            font-size: 13px;
            color: #888;
            margin-bottom: 6px;
        }

        .card .value {
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
        }

        .card .sub {
            font-size: 12px;
            color: #aaa;
            margin-top: 4px;
        }

        .bobot {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2>Sistem Penilaian Mahasiswa</h2>
    <p class="subtitle">Tugas Pertemuan 3 &mdash; PHP</p>

    <p class="bobot">Bobot Nilai: Tugas 30% &nbsp;|&nbsp; UTS 35% &nbsp;|&nbsp; UAS 35%</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($mahasiswa as $mhs): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td style="text-align:left"><?= htmlspecialchars($mhs["nama"]) ?></td>
                <td><?= htmlspecialchars($mhs["nim"]) ?></td>
                <td><?= $mhs["nilai_tugas"] ?></td>
                <td><?= $mhs["nilai_uts"] ?></td>
                <td><?= $mhs["nilai_uas"] ?></td>
                <td><strong><?= $mhs["nilai_akhir"] ?></strong></td>
                <td>
                    <span class="grade-<?= $mhs['grade'] ?>">
                        <?= $mhs["grade"] ?>
                    </span>
                </td>
                <td>
                    <?php if ($mhs["status"] === "LULUS"): ?>
                        <span class="lulus">LULUS</span>
                    <?php else: ?>
                        <span class="tidak-lulus">TIDAK LULUS</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary">
        <div class="card">
            <div class="label">Jumlah Mahasiswa</div>
            <div class="value"><?= count($mahasiswa) ?></div>
        </div>
        <div class="card">
            <div class="label">Rata-rata Kelas</div>
            <div class="value"><?= $rataRata ?></div>
            <div class="sub">Grade: <?= tentukanGrade($rataRata) ?></div>
        </div>
        <div class="card">
            <div class="label">Nilai Tertinggi</div>
            <div class="value"><?= $nilaiTertinggi ?></div>
            <div class="sub"><?= htmlspecialchars($namaTertinggi) ?></div>
        </div>
    </div>

</body>
</html>