<?php
session_start();
require("../sistem/koneksi.php");
$hub = open_connection();
$usr = isset($_POST['usr']) ? mysqli_real_escape_string($hub, $_POST['usr']) : '';
$psw = isset($_POST['psw']) ? mysqli_real_escape_string($hub, $_POST['psw']) : '';
$op = isset($_GET['op']) ? $_GET['op'] : '';

if ($op == "in" && !empty($usr) && !empty($psw)) {
    $cek = mysqli_query($hub, "SELECT * FROM user WHERE username='$usr' AND password='$psw' ");

    if (mysqli_num_rows($cek) == 1) {
        $c = mysqli_fetch_array($cek);
        $_SESSION['username'] = $c['username'];
        $_SESSION['jenisuser'] = $c['jenisuser'];
        header("location:index.php");
        exit; // Stop script execution after redirection
    } else {
        die("Username/password salah <a href=\"javascript:history.back()\">kembali</a>");
    }

    mysqli_close($hub);
    
} elseif ($op == "out") {
    unset($_SESSION['username']);
    unset($_SESSION['jenisuser']);
    header("location:index.php");
    exit; // Stop script execution after redirection
}  else {
    die("Invalid operation. <a href=\"index.php\">Go back</a>");
}

?>
