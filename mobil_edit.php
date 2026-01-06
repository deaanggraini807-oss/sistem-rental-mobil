<?php
include "koneksi.php";
$id=$_GET['id'];
$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM mobil WHERE id_mobil='$id'"));

if(isset($_POST['update'])){
    mysqli_query($conn,"UPDATE mobil SET
        no_plat='$_POST[no_plat]',
        merk='$_POST[merk]',
        tipe='$_POST[tipe]',
        tahun='$_POST[tahun]',
        harga_sewa='$_POST[harga]'
        WHERE id_mobil='$id'");
    header("location:mobil.php");
}
?>

<h2>Edit Mobil</h2>
<form method="post">
No Plat: <input name="no_plat" value="<?= $data['no_plat'] ?>"><br>
Merk: <input name="merk" value="<?= $data['merk'] ?>"><br>
Tipe: <input name="tipe" value="<?= $data['tipe'] ?>"><br>
Tahun: <input name="tahun" value="<?= $data['tahun'] ?>"><br>
Harga: <input name="harga" value="<?= $data['harga_sewa'] ?>"><br>
<button name="update">Update</button>
</form>
