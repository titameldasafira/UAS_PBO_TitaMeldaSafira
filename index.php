<?php
// File: index.php
require_once 'koneksi/database.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanMagang.php';

// Inisialisasi Database
$db = new Database();
$conn = $db->connect();

echo "<h3>Data Karyawan Tetap</h3>";
$karyawanTetapList = KaryawanTetap::ambilDataKaryawanTetap($conn);
foreach ($karyawanTetapList as $kt) {
    echo $kt->tampilkanProfilKaryawan() . "<br>";
}

echo "<h3>Data Karyawan Kontrak</h3>";
$karyawanKontrakList = KaryawanKontrak::ambilDataKaryawanKontrak($conn);
foreach ($karyawanKontrakList as $kk) {
    echo $kk->tampilkanProfilKaryawan() . "<br>";
}

echo "<h3>Data Karyawan Magang</h3>";
$karyawanMagangList = KaryawanMagang::ambilDataKaryawanMagang($conn);
foreach ($karyawanMagangList as $km) {
    echo $km->tampilkanProfilKaryawan() . "<br>";
}
?>