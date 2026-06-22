<?php
// File: KaryawanMagang.php
require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    protected $uangSakuBulanan;
    protected $sertifikasiKampusMerdeka;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari, $uangSakuBulanan, $sertifikasiKampusMerdeka) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikasiKampusMerdeka = $sertifikasiKampusMerdeka;
    }

    // Gaji bersih magang ditambah uang saku
    public function hitungGajiBersih() {
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari) + $this->uangSakuBulanan;
    }

    public function tampilkanProfilKaryawan() {
        return "ID: {$this->id_karyawan} | Nama: {$this->nama_karyawan} | Status: Magang | Sertifikat: {$this->sertifikasiKampusMerdeka} | Gaji: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.');
    }

    // Metode KHUSUS Query SQL Bersyarat (WHERE)
    public static function ambilDataKaryawanMagang($conn) {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'magang'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $kumpulan_karyawan = [];
        while ($row = $stmt->fetch()) {
            $kumpulan_karyawan[] = new KaryawanMagang(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'],
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                $row['uang_saku_bulanan'], $row['sertifikat_kampus_merdeka'] // Nama kolom db "sertifikat_kampus_merdeka"
            );
        }
        return $kumpulan_karyawan;
    }
}
?>