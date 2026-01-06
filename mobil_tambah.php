<?php
include "koneksi.php";
if(isset($_POST['simpan'])){
    mysqli_query($conn,"INSERT INTO mobil VALUES(
    NULL,'$_POST[no_plat]','$_POST[merk]','$_POST[tipe]',
    '$_POST[tahun]','$_POST[harga]','Tersedia')");
    header("location:mobil.php");
}
?>

<h2>Tambah Mobil</h2>
<form method="post">
No Plat: <input name="no_plat"><br>
Merk: <input name="merk"><br>
Tipe: <input name="tipe"><br>
Tahun: <input type="number" name="tahun"><br>
Harga: <input type="number" name="harga"><br>
<button name="simpan">Simpan</button>
</form>
