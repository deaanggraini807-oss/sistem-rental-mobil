<?php
include "koneksi.php";
$id=$_GET['id'];
$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM pelanggan WHERE id_pelanggan='$id'"));

if(isset($_POST['update'])){
    mysqli_query($conn,"UPDATE pelanggan SET
        nama='$_POST[nama]',
        alamat='$_POST[alamat]',
        telp='$_POST[telp]',
        no_ktp='$_POST[ktp]'
        WHERE id_pelanggan='$id'");
    header("location:pelanggan.php");
}
?>

<h2>Edit Pelanggan</h2>
<form method="post">
Nama: <input name="nama" value="<?= $data['nama'] ?>"><br>
Alamat: <textarea name="alamat"><?= $data['alamat'] ?></textarea><br>
Telp: <input name="telp" value="<?= $data['telp'] ?>"><br>
No KTP: <input name="ktp" value="<?= $data['no_ktp'] ?>"><br>
<button name="update">Update</button>
</form>
