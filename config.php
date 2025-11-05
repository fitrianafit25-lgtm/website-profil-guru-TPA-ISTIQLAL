<?php

$host = 'sql211.infinityfree.com';
$dbname = 'if0_39608226_tpa';
$username = 'if0_39608226'; 
$password = 'SkP9jIjmgjpqBBR'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>