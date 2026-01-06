<?php
include "koneksi.php";
mysqli_query($conn,"DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
header("location:pelanggan.php");
