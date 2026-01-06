<?php
session_start();
include "koneksi.php";
?>

<h2>Data Pelanggan</h2>
<a href="pelanggan_tambah.php">+ Tambah Pelanggan</a> |
<a href="dashboard.php">Kembali</a>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Telp</th>
    <th>No KTP</th>
    <th>Aksi</th>
</tr>

<?php
$no=1;
$data=mysqli_query($conn,"SELECT * FROM pelanggan");
while($p=mysqli_fetch_assoc($data)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $p['nama'] ?></td>
<td><?= $p['alamat'] ?></td>
<td><?= $p['telp'] ?></td>
<td><?= $p['no_ktp'] ?></td>
<td>
<a href="pelanggan_edit.php?id=<?= $p['id_pelanggan'] ?>">Edit</a> |
<a href="pelanggan_hapus.php?id=<?= $p['id_pelanggan'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
</td>
</tr>
<?php } ?>
</table>
