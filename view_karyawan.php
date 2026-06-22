<?php
// File: view_karyawan.php

// Memanggil koneksi dan class persis sesuai referensi Tahap 1-5 Anda
require_once 'koneksi/database.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanMagang.php';

// Inisialisasi Koneksi Database
$db = new Database();
$conn = $db->connect();

// Mengambil data menggunakan method spesifik subclass (Tahap 4)
$semuaTetap = KaryawanTetap::ambilDataKaryawanTetap($conn);
$semuaKontrak = KaryawanKontrak::ambilDataKaryawanKontrak($conn);
$semuaMagang = KaryawanMagang::ambilDataKaryawanMagang($conn);

// MEMBATASI DATA: Menampilkan maksimal 3 karyawan per kategori sesuai instruksi
$karyawanTetapList = array_slice($semuaTetap, 0, 3);
$karyawanKontrakList = array_slice($semuaKontrak, 0, 3);
$karyawanMagangList = array_slice($semuaMagang, 0, 3);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Kepegawaian Kampus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Desain Kustom: Tema Formal Kampus (Navy & Gold) */
        :root {
            --campus-navy: #0A192F;
            --campus-gold: #D4AF37;
            --campus-bg: #F8F9FA;
        }
        body {
            background-color: var(--campus-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-custom {
            background-color: var(--campus-navy);
            border-bottom: 4px solid var(--campus-gold);
            padding: 15px 0;
        }
        .navbar-brand {
            color: #ffffff !important;
            font-family: 'Georgia', serif;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .page-title {
            color: var(--campus-navy);
            font-family: 'Georgia', serif;
            border-bottom: 2px solid var(--campus-gold);
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        /* Styling Nav Tabs Bootstrap */
        .nav-tabs .nav-link {
            color: var(--campus-navy);
            font-weight: 600;
            border: none;
            padding: 12px 25px;
            border-bottom: 3px solid transparent;
        }
        .nav-tabs .nav-link:hover {
            border-color: #e9ecef;
        }
        .nav-tabs .nav-link.active {
            color: var(--campus-navy);
            background-color: transparent;
            border-color: transparent;
            border-bottom: 3px solid var(--campus-gold);
        }
        /* Styling Kartu Slip Gaji */
        .slip-card {
            border: none;
            border-top: 4px solid var(--campus-navy);
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            height: 100%;
        }
        .slip-card:hover {
            transform: translateY(-5px);
            border-top: 4px solid var(--campus-gold);
        }
        .card-header-custom {
            background-color: transparent;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            color: var(--campus-navy);
        }
        .info-box {
            background-color: #eef2f7;
            padding: 15px;
            border-radius: 6px;
            font-family: monospace;
            font-size: 0.95rem;
            color: #333;
        }
        .salary-highlight {
            font-size: 1.25rem;
            font-weight: bold;
            color: #198754;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-custom">
        <div class="container">
            <span class="navbar-brand h1 mb-0">UNIVERSITAS NUSANTARA - PORTAL SDM</span>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <h2 class="page-title">Sistem Penggajian Karyawan & Akademik</h2>

        <ul class="nav nav-tabs mb-4" id="sdmTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tetap-tab" data-bs-toggle="tab" data-bs-target="#tetap" type="button" role="tab">Dosen & Staf Tetap</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kontrak-tab" data-bs-toggle="tab" data-bs-target="#kontrak" type="button" role="tab">Tenaga Kontrak</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="magang-tab" data-bs-toggle="tab" data-bs-target="#magang" type="button" role="tab">Peserta Magang</button>
            </li>
        </ul>

        <div class="tab-content" id="sdmTabsContent">
            
            <div class="tab-pane fade show active" id="tetap" role="tabpanel">
                <div class="row g-4">
                    <?php foreach ($karyawanTetapList as $karyawan): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card slip-card p-3">
                                <div class="card-header-custom">Slip Gaji - Karyawan Tetap</div>
                                <div class="card-body p-0 d-flex flex-column">
                                    <div class="info-box mb-3">
                                        <?php 
                                            // Eksekusi Polimorfisme (Tahap 5)
                                            echo $karyawan->tampilkanProfilKaryawan(); 
                                        ?>
                                    </div>
                                    <div class="text-end border-top pt-2 mt-auto">
                                        <small class="text-muted">Total Diterima (Termasuk Tunjangan):</small><br>
                                        <span class="salary-highlight">Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="kontrak" role="tabpanel">
                <div class="row g-4">
                    <?php foreach ($karyawanKontrakList as $karyawan): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card slip-card p-3">
                                <div class="card-header-custom">Slip Gaji - Tenaga Kontrak</div>
                                <div class="card-body p-0 d-flex flex-column">
                                    <div class="info-box mb-3">
                                        <?php 
                                            // Eksekusi Polimorfisme (Tahap 5)
                                            echo $karyawan->tampilkanProfilKaryawan(); 
                                        ?>
                                    </div>
                                    <div class="text-end border-top pt-2 mt-auto">
                                        <small class="text-muted">Total Diterima (Harian):</small><br>
                                        <span class="salary-highlight">Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="magang" role="tabpanel">
                <div class="row g-4">
                    <?php foreach ($karyawanMagangList as $karyawan): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card slip-card p-3">
                                <div class="card-header-custom">Slip Gaji - Peserta Magang</div>
                                <div class="card-body p-0 d-flex flex-column">
                                    <div class="info-box mb-3">
                                        <?php 
                                            // Eksekusi Polimorfisme (Tahap 5)
                                            echo $karyawan->tampilkanProfilKaryawan(); 
                                        ?>
                                    </div>
                                    <div class="text-end border-top pt-2 mt-auto">
                                        <small class="text-muted">Total Diterima (Potongan 20%):</small><br>
                                        <span class="salary-highlight">Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>