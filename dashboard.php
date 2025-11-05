<?php
session_start();
if (!isset($_SESSION['admins'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Query ambil semua data dari tabel profil_guru
$result = mysqli_query($conn, "SELECT * FROM profil_guru");

// Cek jika query gagal
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Profil Guru</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: rgb(116, 157, 84); }
        a { text-decoration: none; }
        .btn { display: inline-block; padding: 10px 20px; color: white; border-radius: 5px; margin: 5px 0; width: 150px; text-align: center; }
        .btn-tambah { background-color: #28a745; }
        .btn-back { background-color: #007bff; }
        .btn-logout { background-color: #dc3545; }
        .btn-edit { color: #28a745; }
        .btn-hapus { color: #dc3545; }
        .container { display: flex; justify-content: flex-start; align-items: flex-start; margin-top: 20px; gap: 20px; }
        .table-container { flex: 1; max-width: 75%; }
        .button-container { display: flex; flex-direction: column; align-items: flex-start; min-width: 160px; }
    </style>
</head>
<body>
    <h2>Selamat datang, Admin!</h2>
    <div class="container">
        <div class="button-container">
            <a href="logout.php" class="btn btn-logout">Logout</a>
            <a href="index.php" class="btn btn-back">Kembali ke Website</a>
            <a href="tambah-guru.php" class="btn btn-tambah">+ Tambah Guru</a>
        </div>
        <div class="table-container">
            <h3>Daftar Guru</h3>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>Alamat</th>
                    <th>Pengajar</th>
                    <th>Pengalaman Mengajar (Tahun)</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_guru']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['pengajar']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['pengalaman_mengajar']) . "</td>";
                    echo "<td><img src='Uploads/" . htmlspecialchars($row['gambar']) . "' width='100' alt='Gambar Guru'></td>";
                    echo "<td>
                            <a href='edit-guru.php?id_guru=" . $row['id_guru'] . "' class='btn-edit'>Edit</a> |
                            <a href='hapus-guru.php?id_guru=" . $row['id_guru'] . "' class='btn-hapus' onclick=\"return confirm('Yakin ingin hapus?')\">Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
                ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>