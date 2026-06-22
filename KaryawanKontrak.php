<?php
// File: KaryawanKontrak.php
require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    protected $durasiKontrakBulan;
    protected $agensiPenyalur;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari, $durasiKontrakBulan, $agensiPenyalur) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->agensiPenyalur = $agensiPenyalur;
    }

    // Gaji bersih karyawan kontrak biasanya hanya hari kerja x gaji dasar
    public function hitungGajiBersih() {
        return $this->hariKerjaMasuk * $this->gajiDasarPerHari;
    }

    public function tampilkanProfilKaryawan() {
        return "ID: {$this->id_karyawan} | Nama: {$this->nama_karyawan} | Status: Kontrak ({$this->durasiKontrakBulan} bulan) | Agensi: {$this->agensiPenyalur} | Gaji: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.');
    }

    // Metode KHUSUS Query SQL Bersyarat (WHERE)
    public static function ambilDataKaryawanKontrak($conn) {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'kontrak'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $kumpulan_karyawan = [];
        while ($row = $stmt->fetch()) {
            $kumpulan_karyawan[] = new KaryawanKontrak(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'],
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                $row['durasi_kontrak_bulan'], $row['agen_penyalur'] // Perhatikan nama kolom db "agen_penyalur"
            );
        }
        return $kumpulan_karyawan;
    }
}
?>