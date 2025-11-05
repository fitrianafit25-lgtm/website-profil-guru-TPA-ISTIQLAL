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
    // Fetch existing data
    $stmt = $pdo->prepare("SELECT * FROM profil_guru WHERE id_guru = ?");
    $stmt->execute([$_GET['id_guru']]);
    $guru = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$guru) {
        echo "<script>alert('Data guru tidak ditemukan.'); window.location='dashboard.php';</script>";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        // Initialize variables
        $nama_guru = isset($_POST['nama_guru']) ? $_POST['nama_guru'] : '';
        $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
        $pengajar = isset($_POST['pengajar']) ? $_POST['pengajar'] : '';
        $pengalaman_mengajar = isset($_POST['pengalaman_mengajar']) ? intval($_POST['pengalaman_mengajar']) : 0;
        $gambar = $guru['gambar']; // Keep existing image by default

        // Handle file upload if a new image is provided
        $uploadOk = 1;
        $target_dir = "Uploads/";
        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Generate a unique filename to avoid conflicts
            $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
            $gambar = uniqid('guru_') . '.' . $imageFileType;
            $target_file = $target_dir . $gambar;
            
            // Check if file is an image
            if (!empty($_FILES["gambar"]["tmp_name"])) {
                $check = getimagesize($_FILES["gambar"]["tmp_name"]);
                if ($check === false) {
                    echo "<script>alert('File bukan gambar.'); window.location='edit-guru.php?id_guru=" . $_GET['id_guru'] . "';</script>";
                    $uploadOk = 0;
                }
            } else {
                echo "<script>alert('Tidak ada file yang diunggah.'); window.location='edit-guru.php?id_guru=" . $_GET['id_guru'] . "';</script>";
                $uploadOk = 0;
            }
            
            // Check file size (limit to 5MB)
            if ($_FILES["gambar"]["size"] > 5000000) {
                echo "<script>alert('File terlalu besar. Maksimum 5MB.'); window.location='edit-guru.php?id_guru=" . $_GET['id_guru'] . "';</script>";
                $uploadOk = 0;
            }
            
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "<script>alert('Hanya file JPG, JPEG, & PNG yang diperbolehkan.'); window.location='edit-guru.php?id_guru=" . $_GET['id_guru'] . "';</script>";
                $uploadOk = 0;
            }
            
            if ($uploadOk == 1) {
                // Delete old image if it exists
                $old_image = $target_dir . $guru['gambar'];
                if (!empty($guru['gambar']) && file_exists($old_image) && is_writable($old_image)) {
                    unlink($old_image);
                } elseif (!empty($guru['gambar']) && file_exists($old_image)) {
                    echo "<script>alert('Gambar lama tidak dapat dihapus karena izin file.'); window.location='edit-guru.php?id_guru=" . $_GET['id_guru'] . "';</script>";
                    $uploadOk = 0;
                }
                // Upload new image
                if ($uploadOk == 1 && !move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    echo "<script>alert('Gagal mengunggah gambar baru.'); window.location='edit-guru.php?id_guru=" . $_GET['id_guru'] . "';</script>";
                    $uploadOk = 0;
                }
            }
        }
        
        if ($uploadOk == 1) {
            // Update database
            $stmt = $pdo->prepare("UPDATE profil_guru SET 
                                   nama_guru = ?, 
                                   alamat = ?, 
                                   pengajar = ?, 
                                   pengalaman_mengajar = ?, 
                                   gambar = ? 
                                   WHERE id_guru = ?");
            $stmt->execute([$nama_guru, $alamat, $pengajar, $pengalaman_mengajar, $gambar, $_GET['id_guru']]);
            
            echo "<script>alert('Data guru berhasil diperbarui!'); window.location='dashboard.php';</script>";
        }
    }
} catch (PDOException $e) {
    echo "<script>alert('Gagal memperbarui data: " . htmlspecialchars($e->getMessage()) . "'); window.location='edit-guru.php?id_guru=" . $_GET['id_guru'] . "';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Guru</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 600px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; margin-bottom: 10px; }
        .btn { display: inline-block; padding: 10px 20px; color: white; border-radius: 5px; text-decoration: none; }
        .btn-submit { background-color: #28a745; }
        .btn-back { background-color: #007bff; }
        .btn-logout { background-color: #dc3545; }
        img { max-width: 100px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Data Guru</h2>
        <a href="logout.php" class="btn btn-logout">Logout</a>
        <a href="dashboard.php" class="btn btn-back">Kembali ke Dashboard</a>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_guru">Nama Guru</label>
                <input type="text" name="nama_guru" id="nama_guru" value="<?php echo htmlspecialchars($guru['nama_guru']); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="<?php echo htmlspecialchars($guru['alamat']); ?>" required>
            </div>
            <div class="form-group">
                <label for="pengajar">Pengajar</label>
                <input type="text" name="pengajar" id="pengajar" value="<?php echo htmlspecialchars($guru['pengajar']); ?>" required>
            </div>
            <div class="form-group">
                <label for="pengalaman_mengajar">Pengalaman Mengajar (Tahun)</label>
                <input type="number" name="pengalaman_mengajar" id="pengalaman_mengajar" value="<?php echo htmlspecialchars($guru['pengalaman_mengajar']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar Saat Ini</label>
                <img src="Uploads/<?php echo htmlspecialchars($guru['gambar']); ?>" alt="Gambar Guru">
                <label for="gambar">Ganti Gambar (opsional)</label>
                <input type="file" name="gambar" id="gambar" accept="image/*">
            </div>
            <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>