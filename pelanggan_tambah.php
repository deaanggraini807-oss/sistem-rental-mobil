<?php
include "koneksi.php";
if(isset($_POST['simpan'])){
    mysqli_query($conn,"INSERT INTO pelanggan VALUES(
    NULL,'$_POST[nama]','$_POST[alamat]','$_POST[telp]','$_POST[ktp]')");
    header("location:pelanggan.php");
}
?>

<h2>Tambah Pelanggan</h2>
<form method="post">
Nama: <input name="nama"><br>
Alamat: <textarea name="alamat"></textarea><br>
Telp: <input name="telp"><br>
No KTP: <input name="ktp"><br>
<button name="simpan">Simpan</button>
</form>
