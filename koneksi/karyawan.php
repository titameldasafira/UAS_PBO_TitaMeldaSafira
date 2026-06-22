<?php
// File: Karyawan.php

abstract class Karyawan {
    // Properti terenkapsulasi dengan hak akses 'protected'
    // agar bisa diakses oleh class turunannya (child class)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hariKerjaMasuk;
    protected $gajiDasarPerHari;

    // Constructor untuk memetakan nilai dari kolom tabel database (Tahap 1) ke properti objek
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari) {
        $this->id_karyawan      = $id_karyawan;
        $this->nama_karyawan    = $nama_karyawan;
        $this->departemen       = $departemen;
        $this->hariKerjaMasuk   = $hariKerjaMasuk;     // Memetakan dari kolom 'hari_kerja_masuk'
        $this->gajiDasarPerHari = $gajiDasarPerHari;   // Memetakan dari kolom 'gaji_dasar_per_hari'
    }

    // Mendeklarasikan Abstract Method (wajib diimplementasikan di class anak)
    abstract public function hitungGajiBersih();
    abstract public function tampilkanProfilKaryawan();
}
?>