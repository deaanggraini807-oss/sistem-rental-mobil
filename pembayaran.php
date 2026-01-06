<?php
include "koneksi.php";
?>

<h2>Data Pembayaran</h2>
<a href="pembayaran_tambah.php">+ Pembayaran</a> |
<a href="dashboard.php">Kembali</a>

<table border="1" cellpadding="8">
<tr>
<th>No</th><th>Pelanggan</th><th>Mobil</th>
<th>Tgl Bayar</th><th>Jumlah</th><th>Metode</th>
</tr>

<?php
$no=1;
$q=mysqli_query($conn,"
SELECT pb.*, p.nama, m.merk
FROM pembayaran pb
JOIN transaksi_sewa ts ON pb.id_sewa=ts.id_sewa
JOIN pelanggan p ON ts.id_pelanggan=p.id_pelanggan
JOIN mobil m ON ts.id_mobil=m.id_mobil");

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['merk'] ?></td>
<td><?= $d['tgl_bayar'] ?></td>
<td><?= $d['jumlah_bayar'] ?></td>
<td><?= $d['metode'] ?></td>
</tr>
<?php } ?>
</table>
