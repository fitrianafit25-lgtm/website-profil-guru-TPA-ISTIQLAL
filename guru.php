<?php
include 'koneksi.php'; 
?>


<section id="profil_guru" style="padding: 40px; font-family: Arial, sans-serif; background-color: #ffffff; color: #333;">
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; justify-items: center; align-items: start; max-width: 700px; margin: 0 auto;">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM profil_guru");
    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $gambar = $row['gambar'] ?? '';
        echo '<div style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); background-color: #fff; width: 100%; max-width: 320px; display: flex; flex-direction: column; align-items: center;">';
        echo '<img src="Uploads/' . htmlspecialchars($gambar) . '" alt="' . htmlspecialchars($row['nama_guru']) . '" style="width: 100%; height: 400px; object-fit: cover; border-radius: 10px 10px 0 0;" ';
        echo 'onerror="this.src=\'https://via.placeholder.com/300x400\'; console.log(\'Image failed: ' . addslashes($gambar) . '\');"';
        echo '>';
        echo '<div style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">';
        echo '<h3 style="margin: 10px 0 5px; color: #00695c; font-size: 1.2em; font-weight: bold; text-align: center;">' . htmlspecialchars($row['nama_guru']) . '</h3>';
        echo '<p style="margin: 5px 0; text-align: center;"><strong style="color: #00695c;">Alamat:</strong> ' . htmlspecialchars($row['alamat']) . '</p>';
        echo '<p style="margin: 5px 0; text-align: center;"><strong style="color: #00695c;">Pengajar:</strong> ' . htmlspecialchars($row['pengajar']) . '</p>';
        echo '<p style="margin: 5px 0; text-align: center;"><strong style="color: #00695c;">Pengalaman Mengajar:</strong> ' . htmlspecialchars($row['pengalaman_mengajar']) . ' tahun</p>';
        echo '</div></div>';

        
        $full_path = $gambar ? realpath('Uploads/' . $gambar) : '';
        if (!$full_path || !file_exists($full_path)) {
            echo '<script>console.log("Image not found: ' . addslashes($gambar) . ' - Full path: ' . addslashes($full_path) . '");</script>';
        }
    }
    ?>
  </div>
</section>