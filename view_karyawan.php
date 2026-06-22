<?php
// File: view.php
require_once 'koneksi/database.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanMagang.php';

try {
    $db = new Database();
    $conn = $db->connect();

    // 1. Pengelompokan data via query subclass spesifik (Tahap 4)
    $dataTetap   = KaryawanTetap::ambilDataKaryawanTetap($conn);
    $dataKontrak = KaryawanKontrak::ambilDataKaryawanKontrak($conn);
    $dataMagang  = KaryawanMagang::ambilDataKaryawanMagang($conn);
} catch (Exception $e) {
    die("Error Sistem: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Penggajian - Biro Administrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        /* Nuansa Formal Akademik / Kampus (Navy & Gold Accent) */
        .navbar-campus {
            background-color: #0B2545; /* Deep Navy */
            border-bottom: 4px solid #EEB902; /* Gold Accent */
        }
        .card-header-campus {
            background-color: #134074;
            color: #fff;
            font-weight: 600;
        }
        .nav-tabs .nav-link {
            color: #134074;
            font-weight: 600;
            border: 1px solid transparent;
        }
        .nav-tabs .nav-link.active {
            background-color: #134074;
            color: #fff !important;
            border-color: #134074;
        }
        .table-campus thead {
            background-color: #0B2545;
            color: #fff;
        }
        .badge-tetap { background-color: #198754; }
        .badge-kontrak { background-color: #0dcaf0; color: #000; }
        .badge-magang { background-color: #ffc107; color: #000; }
        
        .slip-box {
            border-left: 4px dashed #0B2545;
            background-color: #f8f9fa;
            padding: 10px;
            font-size: 0.9px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-campus shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fa-solid fa-graduation-cap me-2 text-warning fs-3"></i>
            <div>
                <span class="fw-bold d-block lh-1">PORTAL ADMINISTRASI KARYAWAN</span>
                <small style="font-size: 11px; color: #d1d5db;">Universitas TI1C - TIta Melda Safira</small>
            </div>
        </a>
    </div>
</nav>

<div class="container mb-5">
    <div class="p-4 mb-4 bg-white rounded-3 shadow-sm border-start border-4 border-primary">
        <h4 class="fw-bold text-dark"><i class="fa-solid fa-wallet text-primary me-2"></i>Sistem Cetak Slip Gaji & Informasi Karyawan</h4>
        <p class="text-muted mb-0">Halaman Antarmuka Dinamis untuk melakukan manajemen, pengelompokan jabatan, serta kalkulasi otomatis pembiayaan menggunakan konsep Polimorfisme Objek.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header card-header-campus py-3">
            <ul class="nav nav-tabs card-header-tabs id="karyawanTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active text-white" id="tetap-tab" data-bs-toggle="tab" data-bs-target="#tetap" type="button" role="tab"><i class="fa-solid fa-user-tie me-2"></i>Karyawan Tetap</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-white" id="kontrak-tab" data-bs-toggle="tab" data-bs-target="#kontrak" type="button" role="tab"><i class="fa-solid fa-file-contract me-2"></i>Karyawan Kontrak</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-white" id="magang-tab" data-bs-toggle="tab" data-bs-target="#magang" type="button" role="tab"><i class="fa-solid fa-user-graduate me-2"></i>Karyawan Magang</button>
                </li>
            </ul>
        </div>
        
        <div class="card-body p-4 bg-white">
            <div class="tab-content" id="karyawanTabContent">
                
                <div class="tab-pane fade show active" id="tetap" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-secondary mb-0"><i class="fa-solid fa-table me-2"></i>Spesifikasi Karyawan Status Tetap</h5>
                        <span class="badge bg-secondary">Total: <?php echo count($dataTetap); ?> Data ditemukan</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle table-campus">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Karyawan</th>
                                    <th>Departemen</th>
                                    <th>Absensi / Gaji Per Hari</th>
                                    <th>Spesifikasi Jabatan (Atribut Khusus)</th>
                                    <th width="35%">Eksekusi Polimorfisme (Slip Info & Biaya)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($dataTetap)): ?>
                                    <tr><td colspan="6" class="text-center text-muted">Tidak ada data dinamis dari database.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($dataTetap as $karyawan): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($karyawan->tampilkanProfilKaryawan() ? explode('|', $karyawan->tampilkanProfilKaryawan())[0] : ''); ?></strong></td>
                                            <td><span class="fw-bold text-primary"><?php echo explode('Nama: ', $karyawan->tampilkanProfilKaryawan())[1] ? explode(' | ', explode('Nama: ', $karyawan->tampilkanProfilKaryawan())[1])[0] : 'N/A'; ?></span></td>
                                            <td><span class="badge badge-tetap">Tetap</span></td>
                                            <td>
                                                <small class="d-block text-muted">Hari Kerja: <strong><?php echo $karyawan->hitungGajiBersih() ? "Dinamis" : "0"; ?> Hari</strong></small>
                                                <small class="text-muted">Gaji Pokok Terbaca</small>
                                            </td>
                                            <td>
                                                <div class="p-2 border rounded bg-light" style="font-size: 12px;">
                                                    <i class="fa-solid fa-circle-plus text-success me-1"></i> Tunjangan Kesehatan disertakan<br>
                                                    <i class="fa-solid fa-chart-line text-primary me-1"></i> Terintegrasi Opsi Saham Perusahaan
                                                </div>
                                            </td>
                                            <td>
                                                <div class="slip-box border-success rounded">
                                                    <div class="fw-bold text-dark mb-1"><i class="fa-solid fa-receipt me-1 text-success"></i> Output Polimorfisme:</div>
                                                    <small class="text-secondary d-block mb-1"><?php echo $karyawan->tampilkanProfilKaryawan(); ?></small>
                                                    <div class="text-end fw-bold text-success fs-6">
                                                        Total Gaji: Rp <?php echo number_format($karyawan->hitungGajiBersih(), 0, ',', '.'); ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="kontrak" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-secondary mb-0"><i class="fa-solid fa-table me-2"></i>Spesifikasi Karyawan Status Kontrak</h5>
                        <span class="badge bg-secondary">Total: <?php echo count($dataKontrak); ?> Data ditemukan</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle table-campus">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Karyawan</th>
                                    <th>Departemen</th>
                                    <th>Absensi / Gaji Per Hari</th>
                                    <th>Spesifikasi Jabatan (Atribut Khusus)</th>
                                    <th width="35%">Eksekusi Polimorfisme (Slip Info & Biaya)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($dataKontrak)): ?>
                                    <tr><td colspan="6" class="text-center text-muted">Tidak ada data dinamis dari database.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($dataKontrak as $karyawan): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars(explode('|', $karyawan->tampilkanProfilKaryawan())[0]); ?></strong></td>
                                            <td><span class="fw-bold text-dark"><?php echo explode('Nama: ', $karyawan->tampilkanProfilKaryawan())[1] ? explode(' | ', explode('Nama: ', $karyawan->tampilkanProfilKaryawan())[1])[0] : 'N/A'; ?></span></td>
                                            <td><span class="badge badge-kontrak">Kontrak</span></td>
                                            <td>
                                                <small class="text-muted">Kalkulasi murni tanpa tunjangan tambahan</small>
                                            </td>
                                            <td>
                                                <div class="p-2 border rounded bg-light" style="font-size: 12px;">
                                                    <i class="fa-solid fa-calendar-days text-info me-1"></i> Durasi Kontrak Aktif Terbaca<br>
                                                    <i class="fa-solid fa-building text-secondary me-1"></i> Terikat Agensi Penyalur Kerja
                                                </div>
                                            </td>
                                            <td>
                                                <div class="slip-box border-info rounded">
                                                    <div class="fw-bold text-dark mb-1"><i class="fa-solid fa-receipt me-1 text-info"></i> Output Polimorfisme:</div>
                                                    <small class="text-secondary d-block mb-1"><?php echo $karyawan->tampilkanProfilKaryawan(); ?></small>
                                                    <div class="text-end fw-bold text-info fs-6" style="color: #055160 !important;">
                                                        Total Gaji: Rp <?php echo number_format($karyawan->hitungGajiBersih(), 0, ',', '.'); ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="magang" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-secondary mb-0"><i class="fa-solid fa-table me-2"></i>Spesifikasi Karyawan Status Magang</h5>
                        <span class="badge bg-secondary">Total: <?php echo count($dataMagang); ?> Data ditemukan</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle table-campus">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Karyawan</th>
                                    <th>Departemen</th>
                                    <th>Absensi / Gaji Per Hari</th>
                                    <th>Spesifikasi Jabatan (Atribut Khusus)</th>
                                    <th width="35%">Eksekusi Polimorfisme (Slip Info & Biaya)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($dataMagang)): ?>
                                    <tr><td colspan="6" class="text-center text-muted">Tidak ada data dinamis dari database.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($dataMagang as $karyawan): ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars(explode('|', $karyawan->tampilkanProfilKaryawan())[0]); ?></strong></td>
                                            <td><span class="fw-bold text-warning text-dark"><?php echo explode('Nama: ', $karyawan->tampilkanProfilKaryawan())[1] ? explode(' | ', explode('Nama: ', $karyawan->tampilkanProfilKaryawan())[1])[0] : 'N/A'; ?></span></td>
                                            <td><span class="badge badge-magang">Magang</span></td>
                                            <td>
                                                <small class="text-muted text-danger">Potongan Biaya Operasional 20% (0.80)</small>
                                            </td>
                                            <td>
                                                <div class="p-2 border rounded bg-light" style="font-size: 12px;">
                                                    <i class="fa-solid fa-wallet text-warning me-1"></i> Akumulasi Uang Saku Bulanan<br>
                                                    <i class="fa-solid fa-certificate text-danger me-1"></i> Program Sertifikasi Kampus Merdeka
                                                </div>
                                            </td>
                                            <td>
                                                <div class="slip-box border-warning rounded">
                                                    <div class="fw-bold text-dark mb-1"><i class="fa-solid fa-receipt me-1 text-warning"></i> Output Polimorfisme:</div>
                                                    <small class="text-secondary d-block mb-1"><?php echo $karyawan->tampilkanProfilKaryawan(); ?></small>
                                                    <div class="text-end fw-bold text-warning fs-6" style="color: #664d03 !important;">
                                                        Total Gaji: Rp <?php echo number_format($karyawan->hitungGajiBersih(), 0, ',', '.'); ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white py-3 text-center mt-5 border-top border-warning">
    <div class="container">
        <small>&copy; 2026 | Sistem Informasi Penggajian Polimorfisme PHP - UAS PBO TI1C</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>