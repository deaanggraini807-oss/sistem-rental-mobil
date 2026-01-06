<?php
include "koneksi.php";
?>

<h2>Laporan Rental Mobil</h2>

<table border="1" cellpadding="8">
<tr>
<th>No</th>
<th>Pelanggan</th>
<th>Mobil</th>
<th>Tgl Sewa</th>
<th>Tgl Kembali</th>
<th>Total Bayar</th>
</tr>

<?php
$no=1;
$q=mysqli_query($conn,"
SELECT ts.*, p.nama, m.merk,
IFNULL(SUM(pb.jumlah_bayar),0) as total_bayar
FROM transaksi_sewa ts
JOIN pelanggan p ON ts.id_pelanggan=p.id_pelanggan
JOIN mobil m ON ts.id_mobil=m.id_mobil
LEFT JOIN pembayaran pb ON ts.id_sewa=pb.id_sewa
GROUP BY ts.id_sewa
");

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['merk'] ?></td>
<td><?= $d['tgl_sewa'] ?></td>
<td><?= $d['tgl_kembali'] ?></td>
<td>Rp <?= number_format($d['total_bayar']) ?></td>
</tr>
<?php } ?>
</table>

<br>
<b>Total Pendapatan:</b> Rp 
<?php
$q2=mysqli_query($conn,"SELECT SUM(jumlah_bayar) as total FROM pembayaran");
$d2=mysqli_fetch_assoc($q2);
echo number_format($d2['total']);
?>
