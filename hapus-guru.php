<?php
session_start();
require_once 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admins'])) {
    header('Location: login.php');
    exit;
}

// Check if id_guru is provided
if (!isset($_GET['id_guru']) || empty($_GET['id_guru'])) {
    echo "<script>alert('ID Guru tidak valid.'); window.location='dashboard.php';</script>";
    exit;
}

try {
    // Fetch image filename to delete it
    $stmt = $pdo->prepare("SELECT gambar FROM profil_guru WHERE id_guru = ?");
    $stmt->execute([$_GET['id_guru']]);
    $guru = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($guru) {
        // Delete image file if it exists
        $image_path = 'Uploads/' . $guru['gambar'];
        if (!empty($guru['gambar']) && file_exists($image_path) && is_writable($image_path)) {
            unlink($image_path);
        } elseif (!empty($guru['gambar']) && file_exists($image_path)) {
            echo "<script>alert('Data dihapus, tetapi gambar tidak dapat dihapus karena izin file.'); window.location='dashboard.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Data guru tidak ditemukan.'); window.location='dashboard.php';</script>";
        exit;
    }

    // Delete record from database
    $stmt = $pdo->prepare("DELETE FROM profil_guru WHERE id_guru = ?");
    $stmt->execute([$_GET['id_guru']]);

    echo "<script>alert('Data guru berhasil dihapus!'); window.location='dashboard.php';</script>";
} catch (PDOException $e) {
    echo "<script>alert('Gagal menghapus data: " . htmlspecialchars($e->getMessage()) . "'); window.location='dashboard.php';</script>";
}
?>
