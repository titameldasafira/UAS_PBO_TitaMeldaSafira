<?php
require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    protected $uangSakuBulanan;
    protected $sertifikasiKampusMerdeka;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari, $uangSakuBulanan, $sertifikasiKampusMerdeka) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikasiKampusMerdeka = $sertifikasiKampusMerdeka;
    }

    // METHOD OVERRIDING
    // Gaji Bersih = (hariKerjaMasuk * gajiDasarPerHari) * 0.80
    public function hitungGajiBersih() {
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari) * 0.80;
    }

    public function tampilkanProfilKaryawan() {
        return "ID: {$this->id_karyawan} | Nama: {$this->nama_karyawan} | Status: Magang | Gaji Bersih: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.');
    }

    public static function ambilDataKaryawanMagang($conn) {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'magang'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $kumpulan_karyawan = [];
        while ($row = $stmt->fetch()) {
            $kumpulan_karyawan[] = new KaryawanMagang(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'],
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                $row['uang_saku_bulanan'], $row['sertifikat_kampus_merdeka']
            );
        }
        return $kumpulan_karyawan;
    }
}
?>