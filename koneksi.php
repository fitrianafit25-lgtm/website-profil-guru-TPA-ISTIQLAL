<?php
$host = "sql211.infinityfree.com";
$username = "if0_39608226";
$password = "SkP9jIjmgjpqBBR";
$database = "if0_39608226_tpa";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>