<?php
session_start();
include "koneksi.php";

$admin = $_SESSION['username'] ?? 'Admin';

/* ===== DATA STATISTIK ===== */
$mobil      = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM mobil"));
$pelanggan  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM pelanggan"));
$transaksi  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM transaksi_sewa"));
$pendapatan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total_bayar) AS total FROM transaksi_sewa"));


$dataGrafik = mysqli_query($conn,"
    SELECT MONTH(tanggal) AS bulan, SUM(total_bayar) AS total
    FROM transaksi_sewa
    GROUP BY MONTH(tanggal)
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Rental Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <div class="sidebar">
        <h2>🚗 RENTAL MOBIL</h2>
        <a href="mobil.php">Data Mobil</a>
        <a href="pelanggan.php">Data Pelanggan</a>
        <a href="peminjaman.php">Peminjaman</a>
        <a href="pengembalian.php">Pengembalian</a>
        <a href="pembayaran.php">Pembayaran</a>
        <a href="laporan.php">Laporan</a>
        <a class="logout" href="logout.php">Logout</a>
    </div>

    <div class="content">
        <div class="header">
            <h1>Dashboard</h1>
            <p>Selamat datang, <b><?= $admin ?></b> 👋</p>
        </div>

        <div class="cards">
            <div class="card">
                <h3>🚙 Total Mobil</h3>
                <h2><?= $mobil['total'] ?></h2>
            </div>

            <div class="card">
                <h3>👤 Total Pelanggan</h3>
                <h2><?= $pelanggan['total'] ?></h2>
            </div>

            <div class="card">
                <h3>📄 Total Transaksi</h3>
                <h2><?= $transaksi['total'] ?></h2>
            </div>

            <div class="card">
                <h3>💰 Pendapatan</h3>
                <h2>Rp <?= number_format($pendapatan['total']) ?></h2>
            </div>
        </div>

        <canvas id="grafik" style="margin-top:40px;"></canvas>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('grafik');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            <?php while($d = mysqli_fetch_assoc($dataGrafik)){ ?>
                'Bulan <?= $d['bulan'] ?>',
            <?php } ?>
        ],
        datasets: [{
            label: 'Pendapatan',
            data: [
                <?php
                mysqli_data_seek($dataGrafik,0);
                while($d = mysqli_fetch_assoc($dataGrafik)){
                    echo $d['total'].',';
                }
                ?>
            ]
        }]
    }
});
</script>

</body>
</html>
