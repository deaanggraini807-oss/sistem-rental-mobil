<?php
include "koneksi.php";

if(isset($_POST['simpan'])){
    mysqli_query($conn,"INSERT INTO pembayaran VALUES(
    NULL,'$_POST[id_sewa]','$_POST[tgl]','$_POST[jumlah]','$_POST[metode]')");
    header("location:pembayaran.php");
}
?>

<h2>Input Pembayaran</h2>

<form method="post">
Transaksi:
<select name="id_sewa">
<?php
$q=mysqli_query($conn,"SELECT ts.id_sewa, p.nama FROM transaksi_sewa ts 
JOIN pelanggan p ON ts.id_pelanggan=p.id_pelanggan WHERE ts.status='Selesai'");
while($d=mysqli_fetch_assoc($q)){
echo "<option value='$d[id_sewa]'>Transaksi #$d[id_sewa] - $d[nama]</option>";
}
?>
</select><br>

Tanggal: <input type="date" name="tgl"><br>
Jumlah Bayar: <input type="number" name="jumlah"><br>
Metode:
<select name="metode">
<option>Cash</option>
<option>Transfer</option>
</select><br>

<button name="simpan">Simpan</button>
</form>
