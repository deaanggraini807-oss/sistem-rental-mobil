<?php
session_start();
include "koneksi.php";
?>

<h2>Data Mobil</h2>
<a href="mobil_tambah.php">+ Tambah Mobil</a> |
<a href="dashboard.php">Kembali</a>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>No Plat</th>
    <th>Merk</th>
    <th>Tipe</th>
    <th>Tahun</th>
    <th>Harga</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php
$no=1;
$data=mysqli_query($conn,"SELECT * FROM mobil");
while($m=mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $m['no_plat'] ?></td>
<td><?= $m['merk'] ?></td>
<td><?= $m['tipe'] ?></td>
<td><?= $m['tahun'] ?></td>
<td><?= $m['harga_sewa'] ?></td>
<td><?= $m['status'] ?></td>
<td>
<a href="mobil_edit.php?id=<?= $m['id_mobil'] ?>">Edit</a> |
<a href="mobil_hapus.php?id=<?= $m['id_mobil'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
