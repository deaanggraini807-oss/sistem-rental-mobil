<?php
include "koneksi.php";

if(isset($_POST['simpan'])){
    $mobil = $_POST['mobil'];
    $pelanggan = $_POST['pelanggan'];
    $tgl1 = $_POST['tgl_sewa'];
    $tgl2 = $_POST['tgl_kembali'];

    $hari = (strtotime($tgl2)-strtotime($tgl1))/(60*60*24);
    $harga = mysqli_fetch_assoc(mysqli_query($conn,"SELECT harga_sewa FROM mobil WHERE id_mobil='$mobil'"))['harga_sewa'];
    $total = $hari * $harga;

    mysqli_query($conn,"INSERT INTO transaksi_sewa VALUES(NULL,'$mobil','$pelanggan','$tgl1','$tgl2','$hari','$total','Disewa')");
    mysqli_query($conn,"UPDATE mobil SET status='Disewa' WHERE id_mobil='$mobil'");

    header("location:peminjaman.php");
}
?>

<h2>Transaksi Peminjaman</h2>

<form method="post">
Mobil:
<select name="mobil">
<?php
$q=mysqli_query($conn,"SELECT * FROM mobil WHERE status='Tersedia'");
while($m=mysqli_fetch_assoc($q)){
echo "<option value='$m[id_mobil]'>$m[merk] - $m[no_plat]</option>";
}
?>
</select><br>

Pelanggan:
<select name="pelanggan">
<?php
$q=mysqli_query($conn,"SELECT * FROM pelanggan");
while($p=mysqli_fetch_assoc($q)){
echo "<option value='$p[id_pelanggan]'>$p[nama]</option>";
}
?>
</select><br>

Tgl Sewa: <input type="date" name="tgl_sewa"><br>
Tgl Kembali: <input type="date" name="tgl_kembali"><br>
<button name="simpan">Simpan</button>
</form>
