<?php
// File: KaryawanTetap.php
require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    protected $tunjanganKesehatan;
    protected $opsiSahamId;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari, $tunjanganKesehatan, $opsiSahamId) {
        // Memanggil constructor induk
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    // Implementasi abstract method: Rumus Gaji Karyawan Tetap
    public function hitungGajiBersih() {
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari) + $this->tunjanganKesehatan;
    }

    // Implementasi abstract method: Cetak Profil
    public function tampilkanProfilKaryawan() {
        return "ID: {$this->id_karyawan} | Nama: {$this->nama_karyawan} | Status: Tetap | Saham: {$this->opsiSahamId} | Gaji: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.');
    }

    // Metode KHUSUS Query SQL Bersyarat (WHERE)
    public static function ambilDataKaryawanTetap($conn) {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'tetap'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $kumpulan_karyawan = [];
        while ($row = $stmt->fetch()) {
            // Memasukkan data ke dalam objek KaryawanTetap
            $kumpulan_karyawan[] = new KaryawanTetap(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'],
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                $row['tunjangan_kesehatan'], $row['opsi_saham_id']
            );
        }
        return $kumpulan_karyawan;
    }
}
?>