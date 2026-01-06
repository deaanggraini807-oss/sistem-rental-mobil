<?php
include "koneksi.php";

if(isset($_GET['kembali'])){
    $id = $_GET['kembali'];

    mysqli_query($conn,"UPDATE transaksi_sewa SET status='Selesai' WHERE id_sewa='$id'");
    mysqli_query($conn,"UPDATE mobil SET status='Tersedia' 
        WHERE id_mobil=(SELECT id_mobil FROM transaksi_sewa WHERE id_sewa='$id')");

    header("location:pengembalian.php");
}
?>

<h2>Pengembalian Mobil</h2>
<a href="dashboard.php">Kembali</a>

<table border="1" cellpadding="8">
<tr>
<th>No</th><th>Mobil</th><th>Pelanggan</th>
<th>Tgl Sewa</th><th>Tgl Kembali</th>
<th>Total Bayar</th><th>Status</th><th>Aksi</th>
</tr>

<?php
$no=1;
$q=mysqli_query($conn,"
SELECT ts.*, m.merk, p.nama
FROM transaksi_sewa ts
JOIN mobil m ON ts.id_mobil=m.id_mobil
JOIN pelanggan p ON ts.id_pelanggan=p.id_pelanggan");

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['merk'] ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['tgl_sewa'] ?></td>
<td><?= $d['tgl_kembali'] ?></td>
<td><?= $d['total_bayar'] ?></td>
<td><?= $d['status'] ?></td>
<td>
<?php if($d['status']=="Disewa"){ ?>
<a href="?kembali=<?= $d['id_sewa'] ?>">Kembalikan</a>
<?php } ?>
</td>
</tr>
<?php } ?>
</table>
