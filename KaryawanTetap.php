<?php
require_once 'karyawan.php';

class KaryawanTetap extends karyawan {
    protected $tunjanganKesehatan;
    protected $opsiSahamId;

    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari, $tunjanganKesehatan, $opsiSahamId) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    // METHOD OVERRIDING
    // Gaji Bersih = (hariKerjaMasuk * gajDasarPerHari) + tunjanganKesehatan
    public function hitungGajiBersih() {
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari) + $this->tunjanganKesehatan;
    }

    public function tampilkanProfilKaryawan() {
        return "ID: {$this->id_karyawan} | Nama: {$this->nama_karyawan} | Status: Tetap | Gaji Bersih: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.');
    }

    public static function ambilDataKaryawanTetap($conn) {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'tetap'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        $kumpulan_karyawan = [];
        while ($row = $stmt->fetch()) {
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