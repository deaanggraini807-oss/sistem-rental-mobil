<?php
include "koneksi.php";
mysqli_query($conn,"DELETE FROM mobil WHERE id_mobil='$_GET[id]'");
header("location:mobil.php");
