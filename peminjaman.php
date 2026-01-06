<?php
session_start();
include "koneksi.php";
?>

<h2>Data Peminjaman</h2>
<a href="peminjaman_tambah.php">+ Transaksi Baru</a> |
<a href="dashboard.php">Kembali</a>

<table border="1" cellpadding="8">
<tr>
<th>No</th>
<th>Mobil</th>
<th>Pelanggan</th>
<th>Tgl Sewa</th>
<th>Tgl Kembali</th>
<th>Total Hari</th>
<th>Total Bayar</th>
<th>Status</th>
</tr>

<?php
$q = mysqli_query($conn,"
SELECT ts.*, 
IFNULL(m.merk,'-') AS merk, 
IFNULL(p.nama,'-') AS nama
FROM transaksi_sewa ts
LEFT JOIN mobil m ON ts.id_mobil = m.id_mobil
LEFT JOIN pelanggan p ON ts.id_pelanggan = p.id_pelanggan
");

$no = 1;

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['merk'] ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['tgl_sewa'] ?></td>
<td><?= $d['tgl_kembali'] ?></td>
<td><?= $d['total_hari'] ?></td>
<td><?= $d['total_bayar'] ?></td>
<td><?= $d['status'] ?></td>
</tr>
<?php } ?>
</table>
