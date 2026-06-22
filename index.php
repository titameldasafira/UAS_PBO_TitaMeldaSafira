<?php
require_once 'koneksi/database.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanMagang.php';

$db = new Database();
$conn = $db->connect();

// Mengambil semua data dari masing-masing subclass
$dataTetap = KaryawanTetap::ambilDataKaryawanTetap($conn);
$dataKontrak = KaryawanKontrak::ambilDataKaryawanKontrak($conn);
$dataMagang = KaryawanMagang::ambilDataKaryawanMagang($conn);

// MENGGABUNGKAN SEMUA OBJEK KE DALAM SATU ARRAY (POLIMORFISME)
$semuaKaryawan = array_merge($dataTetap, $dataKontrak, $dataMagang);

echo "<h2>Daftar Penggajian Karyawan (Implementasi Polimorfisme)</h2>";
echo "<ul>";

// Melakukan perulangan (looping). 
// PHP akan otomatis memanggil method hitungGajiBersih() dan tampilkanProfilKaryawan() 
// sesuai dengan class asal objeknya masing-masing.
foreach ($semuaKaryawan as $karyawan) {
    echo "<li>" . $karyawan->tampilkanProfilKaryawan() . "</li>";
}

echo "</ul>";
?>