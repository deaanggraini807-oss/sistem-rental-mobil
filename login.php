<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = md5($_POST['password']);

    $q = mysqli_query($conn,"SELECT * FROM user WHERE username='$u' AND password='$p'");
    $data = mysqli_fetch_assoc($q);

    if($data){
        $_SESSION['user'] = $data;
        header("location:dashboard.php");
    }else{
        echo "<script>alert('Login gagal');</script>";
    }
}
?>

<form method="post">
    <h2>Login Rental Mobil</h2>
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button name="login">Login</button>
</form>
