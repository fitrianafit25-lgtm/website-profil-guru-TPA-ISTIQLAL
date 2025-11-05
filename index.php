<?php

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil Guru TPA Istiqlal</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<header style="
  position: relative;
  background: url('background1.jpg') no-repeat center center;
  background-size: cover;
  color: white;
  padding: 40px 20px;
  text-align: center;
">
  
  <div style="
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5);
    z-index: 0;
  "></div>
  <div style="position: relative; z-index: 1;">
    <h1 style="margin: 0; text-shadow: 1px 1px 5px rgba(0,0,0,0.8);">TPA Istiqlal</h1>
    <nav>
      <ul style="list-style: none; padding: 0; display: flex; justify-content: center; gap: 20px; margin-top: 10px;">
        <li><a href="index.php" style="color: white; text-decoration: none; font-weight: bold; text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">Beranda</a></li>
        <li><a href="login.php" style="color: white; text-decoration: none; font-weight: bold; text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">Login</a></li>
      </ul>
    </nav>
  </div>
</header>

  <main>
  
    <section class="hero">
      <h2>Selamat Datang di Website TPA Istiqlal</h2>
    </section>



    <section class="guru">
      <h2>Profil Guru</h2>
      <div class="card-container">    
       
    <iframe src="guru.php" style="width: 100%; height: 600px; border: none;" title="profil_guru"></iframe>
     </div>
      </div>
    </section>   
    </section>

    <section class="foto-murid">
      <h2>Galeri Foto Murid</h2>
      <div class="murid-container">
        <div class="murid-card">
          <img src="/murid/6.jpg" alt="Murid 1">
        </div>
        <div class="murid-card">
          <img src="/murid/7.jpg" alt="Murid 2">
        </div>
        <div class="murid-card">
          <img src="/murid/8.jpg" alt="Murid 3">
        </div>
      </div>
    </section>

    <section class="kegiatan-tpa">
      <h2>Kegiatan di TPA Istiqlal</h2>
      <ul>
        <li>Belajar membaca Al-Qur'an dengan metode Tilawati</li>
        <li>Menghafal surat-surat pendek dan doa sehari-hari</li>
        <li>Kegiatan shalat berjamaah dan praktek wudhu</li>
        <li>Pembelajaran akhlak dan adab sehari-hari</li>
        <li>Games islami dan kegiatan edukatif</li>
        <li>Peringatan hari besar Islam (PHBI)</li>
        <li>Latihan pidato atau ceramah singkat (mimbar anak)</li>
      </ul>
    </section>

    
    <section class="kontak" id="kontak">
      <div class="container">
        <h2 class="section-title">Hubungi Kami</h2>
        <div class="kontak-content">
          <div class="contact-info">
            
            <p>silakan menghubungi guru TPA melalui WhatsApp:</p>
            <div class="whatsapp-contact">
              <div class="contact-card">
                <div class="contact-icon">
                  <i class="fab fa-whatsapp"></i>
                </div>
                <div class="contact-details">
                  <h4>Guru TPA</h4>
                  <p class="phone-number">‪‪+62 822-5463-8669</p>
                  <a href="http://wa.me/6282254638669/?text=Assalamualaikum,%20saya%20ingin%20menanyakan%20informasi%20pendaftaran%20TPA%20ISTIQLAL‬" 
                     target="_blank" class="whatsapp-btn">
                    <i class="fab fa-whatsapp"></i> Chat WhatsApp
                  </a>
                </div>   
    </section>
</section>
</main>
<section class="lokasi-tpa" style="padding: 20px; text-align: center;">
    <h3 class="section-title">Lokasi TPA Istiqlal Penajam Paser Utara</h3>
    
    <p>
        Alamat: QJV9+PVQ, Sotek, Penajam, Kabupaten Penajam Paser Utara, Kalimantan Timur 76144
    </p>

    <a 
        href="https://www.google.com/maps/place/Mesjid+Istiqlal+Sotek/@-1.2056619,116.619747,16z"
        target="_blank"
        style="
            
            display: inline-block; 
            margin-top: 20px;
            padding: 15px 30px;
            
           
            background-color: #4CAF50; /* Warna Hijau yang Cerah */
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            font-size: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;

            /* Ini PENTING: Mengubah kursor menjadi tangan saat diarahkan */
            cursor: pointer; 
        "
        onmouseover="this.style.backgroundColor='#45a049'" 
        onmouseout="this.style.backgroundColor='#4CAF50'"
    >
        <i class="fas fa-map-marker-alt"></i> 📍ALAMAT TPA ISTIQLAL
    </a>
    <p style="margin-top: 20px; color: #666; font-size: 14px;">(Klik tombol di atas untuk membuka Google Maps secara langsung)</p>

</section>  