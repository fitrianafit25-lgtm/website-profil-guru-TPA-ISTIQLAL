<?php
session_start();
if (!isset($_SESSION['admins'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // Initialize variables with default values to avoid undefined errors
    $nama_guru = isset($_POST['nama_guru']) ? mysqli_real_escape_string($conn, $_POST['nama_guru']) : '';
    $alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($conn, $_POST['alamat']) : '';
    $pengajar = isset($_POST['pengajar']) ? mysqli_real_escape_string($conn, $_POST['pengajar']) : '';
    $pengalaman_mengajar = isset($_POST['pengalaman_mengajar']) ? intval($_POST['pengalaman_mengajar']) : 0;
    
    // Handle file upload
    $gambar = '';
    $uploadOk = 1;
    $target_dir = "Uploads/";
    
    // Ensure Uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $gambar = basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if file is an actual image
        if (!empty($_FILES["gambar"]["tmp_name"])) {
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check === false) {
                echo "<script>alert('File bukan gambar.');</script>";
                $uploadOk = 0;
            }
        } else {
            echo "<script>alert('Tidak ada file yang diunggah.');</script>";
            $uploadOk = 0;
        }
        
        // Check file size (limit to 5MB)
        if ($_FILES["gambar"]["size"] > 5000000) {
            echo "<script>alert('File terlalu besar.');</script>";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<script>alert('Hanya file JPG, JPEG, & PNG yang diperbolehkan.');</script>";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                // Insert data into database
                $query = "INSERT INTO profil_guru (nama_guru, alamat, pengajar, pengalaman_mengajar, gambar) 
                          VALUES ('$nama_guru', '$alamat', '$pengajar', $pengalaman_mengajar, '$gambar')";
                
                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('Data guru berhasil ditambahkan!'); window.location='index.php';</script>";
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('Gagal mengunggah gambar.');</script>";
            }
        }
    } else {
        echo "<script>alert('Gambar harus diunggah.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Guru</title>
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Data Guru</h2>
        <a href="logout.php" class="btn btn-logout">Logout</a>
        <a href="dashboard.php" class="btn btn-back">Kembali ke Dashboard</a>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_guru">Nama Guru</label>
                <input type="text" name="nama_guru" id="nama_guru" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" required>
            </div>
            <div class="form-group"> 
                <label for="pengajar">Pengajar</label>
                <input type="text" name="pengajar" id="pengajar" required>
            </div>
            <div class="form-group">
                <label for="pengalaman_mengajar">Pengalaman Mengajar (Tahun)</label>
                <input type="number" name="pengalaman_mengajar" id="pengalaman_mengajar" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-submit">Simpan</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>