<?php
// =====================================================
// PROGRAM PHP: SISTEM REKAP NILAI MAHASISWA
// =====================================================

// 1. Data mahasiswa (simulasi database)
$mahasiswa = [
    ["nim" => "2311001", "nama" => "Angga", "nilai" => 85],
    ["nim" => "2311002", "nama" => "Budi",  "nilai" => 72],
    ["nim" => "2311003", "nama" => "Siti",  "nilai" => 90],
    ["nim" => "2311004", "nama" => "Rina",  "nilai" => 65],
    ["nim" => "2311005", "nama" => "Doni",  "nilai" => 55]
];

// 2. Fungsi validasi nilai
function validasiNilai($nilai) {
    return is_numeric($nilai) && $nilai >= 0 && $nilai <= 100;
}

// 3. Fungsi menentukan grade
function hitungGrade($nilai) {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 70) {
        return "B";
    } elseif ($nilai >= 60) {
        return "C";
    } else {
        return "D";
    } else {
        return "F";
    }
}

// 4. Fungsi status kelulusan
function statusKelulusan($nilai) {
    return $nilai >= 70 ? "LULUS" : "TIDAK LULUS";
}

// 5. Fungsi menghitung rata-rata kelas
function hitungRataRata($data) {
    $total = 0;
    foreach ($data as $item) {
        $total += $item["nilai"];
    }
    return $total / count($data);
}

// 6. Fungsi menghitung nilai tertinggi
function nilaiTertinggi($data) {
    $max = $data[0]["nilai"];
    foreach ($data as $item) {
        if ($item["nilai"] > $max) {
            $max = $item["nilai"];
        }
    }
    return $max;
}

// 7. Fungsi menghitung nilai terendah
function nilaiTerendah($data) {
    $min = $data[0]["nilai"];
    foreach ($data as $item) {
        if ($item["nilai"] < $min) {
            $min = $item["nilai"];
        }
    }
    return $min;
}

// 8. Proses sortir berdasarkan nilai (descending)
usort($mahasiswa, function ($a, $b) {
    return $b["nilai"] <=> $a["nilai"];
});

// 9. Output judul
echo "<h2>Rekap Nilai Mahasiswa</h2>";

// 10. Membuat tabel
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Nilai</th>
        <th>Grade</th>
        <th>Status</th>
      </tr>";

// 11. Loop data mahasiswa
$no = 1;
foreach ($mahasiswa as $mhs) {

    // Validasi nilai
    if (!validasiNilai($mhs["nilai"])) {
        continue;
    }

    $grade  = hitungGrade($mhs["nilai"]);
    $status = statusKelulusan($mhs["nilai"]);

    echo "<tr>";
    echo "<td>$no</td>";
    echo "<td>{$mhs['nim']}</td>";
    echo "<td>{$mhs['nama']}</td>";
    echo "<td>{$mhs['nilai']}</td>";
    echo "<td>$grade</td>";
    echo "<td>$status</td>";
    echo "</tr>";
    echo "</tr>";$_FILES['nilai']

    $no++;
}

// 12. Menutup tabel
echo "</table>";

// 13. Rekap statistik kelas
$rataRata = hitungRataRata($mahasiswa);
$nilaiMax = nilaiTertinggi($mahasiswa);
$nilaiMin = nilaiTerendah($mahasiswa);

// 14. Output statistik
echo "<h3>Statistik Kelas</h3>";
echo "<ul>";
echo "<li>Rata-rata Nilai: " . number_format($rataRata, 2) . "</li>";
echo "<li>Nilai Tertinggi: $nilaiMax</li>";
echo "<li>Nilai Terendah: $nilaiMin</li>";
echo "</ul>";
?>
