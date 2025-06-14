<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booksy - Your Reading Companion</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="header.css">
    <style>
        /* CSS Dimulai Di Sini */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('images/landinggg.png');
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            /* overflow-x: hidden; / / Menghindari scroll horizontal yang tidak perlu */
            /* overflow-y: auto; / / Mengizinkan scroll vertikal */
        }

        html, body {
            scroll-behavior: smooth;
        }

        .hero {
            background-image: url('images/landinggg.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 50px 100px;
            position: relative
        }

        .hero-content {
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .hero-content h1 {
            font-size: 70px;
            font-weight: 800;
            width: 100%;
        }

        .hero-content p {
            margin-top: 10px;
            font-size: 20px;
            line-height: 1.5;
            width: 100%;
        }

        .hero .container { /* Targetkan kontainer secara spesifik di dalam hero */
            display: flex;
            /* Hapus lebar tetap untuk memungkinkan fleksibilitas */
            height: 550px;
            align-items: center; /* Pusatkan secara vertikal */
            justify-content: center; /* Pusatkan secara horizontal */
            max-width: 100%; /* Pastikan tidak meluap pada layar yang lebih kecil */
            margin: 0 auto; /* Pusatkan kontainer itu sendiri secara horizontal */
        }



        .collection-section {
            padding: 80px 40px;
            text-align: center;
            /* Tambahkan margin-top agar tidak tumpang tindih dengan hero saat hero full-height */
            /* Ini akan membuat collection-section dimulai tepat setelah hero selesai */
            margin-top: -1px; /* Sedikit overlap untuk menghindari celah 1px pada beberapa browser */
            background: linear-gradient(to right bottom, #896040, #896040, #3A1F08); Pertahankan background body */
            position: relative; /* Agar z-index bekerja jika ada overlay */
            z-index: 50; /* Di bawah header tapi di atas body utama */
        }

        .collection-section2 {
            padding: 80px 40px;
            text-align: center;
            /* Tambahkan margin-top agar tidak tumpang tindih dengan hero saat hero full-height */
            /* Ini akan membuat collection-section dimulai tepat setelah hero selesai */
            margin-top: -1px; /* Sedikit overlap untuk menghindari celah 1px pada beberapa browser */
            position: relative; /* Agar z-index bekerja jika ada overlay */
            z-index: 50; /* Di bawah header tapi di atas body utama */
        }

        .collection-title {
            font-size: 2.5rem;
            color: #F8EEE1;
            margin-bottom: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .star {
            color:rgb(255, 215, 115);
            font-size: 2rem;
        }

        .books-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .book-item {
            width: 250px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .book-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .book-cover {
            margin: 0 auto 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 160px;
        }

        .book-cover img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 250px;
            object-fit: contain;
            display: block;
        }

        .book-info h3 {
            font-size: 1.1rem;
            color: #f8eee1;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .book-info p {
            color: #e4c59e;
            font-size: 0.9rem;
        }

        .logo-img {
            height: 40px;
            width: auto;
        }

        /* CSS untuk Dropdown */
        /* CSS untuk Dropdown yang Dipercantik */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* CSS untuk Dropdown yang Dipercantik & Transparan */
        .dropdown-content {
            display: none; /* Sembunyikan secara default */
            position: absolute;
            /* Ganti ini untuk efek transparan dengan blur */
            background-color: rgba(58, 31, 8, 0.4); /* Warna dasar coklat gelap dengan transparansi 40% */
            backdrop-filter: blur(10px); /* Efek blur untuk latar belakang di belakang dropdown */
            -webkit-backdrop-filter: blur(10px); /* Dukungan untuk browser Webkit (Safari) */

            border: 1px solid rgba(228, 197, 158, 0.3); /* Sedikit border tipis untuk kesan mewah */
            min-width: 180px; /* Sedikit lebih lebar */
            box-shadow: 0px 10px 25px 0px rgba(0,0,0,0.4); /* Bayangan lebih halus dan menyebar */
            z-index: 100;
            top: 120%; /* Sedikit lebih dekat ke tombol utama, atur sesuai preferensi */
            left: 50%; /* Pusatkan dropdown di bawah tombol */
            transform: translateX(-50%); /* Penyesuaian untuk pemusatan */
            border-radius: 8px; /* Sudut lebih lembut */
            overflow: hidden; /* Penting untuk rounded corner dan transisi */
            opacity: 0; /* Mulai dengan transisi opacity 0 */
            visibility: hidden; /* Sembunyikan sepenuhnya */
            transition: opacity 0.3s ease, top 0.3s ease, visibility 0.3s; /* Transisi untuk munculnya dropdown */
        }

        .dropdown-content a {
            color: #e4c59e; /* Warna teks link di dropdown */
            padding: 12px 20px; /* Padding sedikit lebih besar */
            text-decoration: none;
            display: block;
            text-align: left;
            font-size: 0.95rem; /* Ukuran font sedikit lebih kecil agar terlihat profesional */
            font-weight: 500; /* Memberikan ketebalan sedang */
            transition: background-color 0.3s ease, color 0.3s ease; /* Transisi halus saat hover */
        }

        .dropdown-content a:hover {
            background-color: #896040; /* Warna latar belakang saat di-hover */
            color: white; /* Warna teks saat di-hover */
        }

        /* Tampilkan dropdown saat mengarahkan kursor ke "dropdown" induk */
        .dropdown:hover .dropdown-content {
            display: block;
            opacity: 1; /* Transisi muncul dengan opacity 1 */
            visibility: visible; /* Jadikan terlihat */
            top: 100%; /* Kembali ke posisi semula saat muncul */
        }

        /* Gaya untuk ikon dropdown (panah bawah) */
        .dropdown-icon {
            font-size: 0.7em; /* Ukuran ikon lebih kecil */
            margin-left: 8px; /* Jarak dari teks */
            vertical-align: middle; /* Rata tengah vertikal */
            transition: transform 0.3s ease; /* Transisi untuk rotasi ikon */
        }

        /* Putar ikon saat hover pada dropdown */
        .dropdown:hover .dropdown-icon {
            transform: rotate(180deg); /* Putar 180 derajat (menunjuk ke atas) */
        }

        /* Sesuaikan gaya untuk dropbtn agar konsisten dengan link navbar lainnya */
        .nav-links .dropbtn {
            color: white; /* Warna teks tombol utama */
            text-decoration: none;
            padding: 10px 15px; /* Sesuaikan dengan padding link navbar lain */
            display: block; /* Agar padding dan hover area lebih baik */
            white-space: nowrap; /* Mencegah teks dan ikon terpecah baris */
        }

        .nav-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: transparent;
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: 80px;
        }

        .search-bar {
    padding: 10px 20px;
    border: none;
    border-radius: 25px;
    background: rgba(255, 255, 255, 0.364);
    width: 300px;
    outline: none;
    color: white; /* Warna teks putih */
    font-weight: 500; /* Tambahan untuk ketebalan font */
    font-family: 'Montserrat';
}

/* Styling untuk placeholder text agar juga putih */
.search-bar::placeholder {
    color: rgba(255, 255, 255, 0.8);
    opacity: 1; /* Untuk Firefox */
}

/* Untuk browser yang membutuhkan vendor prefix */
.search-bar::-webkit-input-placeholder {
    color: rgba(255, 255, 255, 0.8);
}

.search-bar::-moz-placeholder {
    color: rgba(255, 255, 255, 0.8);
    opacity: 1;
}

.search-bar:-ms-input-placeholder {
    color: rgba(255, 255, 255, 0.8);
}

.search-bar:-moz-placeholder {
    color: rgba(255, 255, 255, 0.8);
    opacity: 1;
}

.nav-links {
    display: flex;
    gap: 20px;
    align-items: center;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 20px;
    transition: background 0.3s;
}

.nav-links a:hover {
    background: rgba(255, 255, 255, 0.2);
}

.profile-icon {
    width: 35px;
    height: 35px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #8B4513;
    font-weight: bold;
}

.logo-img {
    height: 40px;
    width: auto;
}

/* Media Queries for Responsiveness (from dashboard.php, simplified for header) */
@media (max-width: 768px) {
    .header {
        flex-direction: column;
        gap: 20px;
        padding: 20px;
        position: relative; /* Changed to relative for mobile to allow content to flow */
        z-index: auto;
        height: auto;
    }

    .search-bar {
        width: 100%;
    }
}
                
    </style>
</head>
<body>
    <header class="header">
        <img src="images/booksyyy.png" alt="Booksy Logo" class="logo-img" />
        <div class="nav-container">
            <input type="text" class="search-bar" placeholder="Find your favorite books...">
            <nav class="nav-links">
                <a href="#">Home</a>
                <div class="dropdown">
                    <a href="#collection" class="dropbtn">Collection <span class="dropdown-icon">▾</span></a>
                    <div class="dropdown-content">
                        <a href="#collection">New Arrivals</a>
                        <a href="#collection2">Top Picks</a>
                    </div>
                </div>
                <a href="form.php">Get a Book</a>
                <a href="profile.php" class="profile-icon">👤</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Hello, Booksy Readers!</h1>
                <p>The best place to discover a wide collection of books, journals, and quality references<br>to support your learning and research needs.</p>
            </div>
        </div>
    </section>

    <section class="collection-section" id="collection">

        <h2 class="collection-title">
            <span class="star">★</span>
            New Arrivals
            <span class="star">★</span>
        </h2>

        <div class="books-grid">
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/atomic habits.jpg" alt="Atomic Habits">
                </div>
                <div class="book-info">
                    <h3>Atomic Habits</h3>
                    <p>by James Clear</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/1984.jpg" alt="1984">
                </div>
                <div class="book-info">
                    <h3>1984</h3>
                    <p>by George Orwell</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/hello.jpg" alt="Hello">
                </div>
                <div class="book-info">
                    <h3>Hello</h3>
                    <p>by Tere Liye</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/dunia sophie.jpg" alt="Dunia Sophie">
                </div>
                <div class="book-info">
                    <h3>Dunia Sophie</h3>
                    <p>by Jonstein Gaarder</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/aroma karsa.jpg" alt="Aroma Karsa">
                </div>
                <div class="book-info">
                    <h3>Aroma Karsa</h3>
                    <p>by Dee Lestari</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/detektif conan.jpg" alt="Detektif Conan Vol.1">
                </div>
                <div class="book-info">
                    <h3>Detektif Conan Vol. 1</h3>
                    <p>by Gosho Ayoama</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/aldebaran.jpg" alt="Aldebaran">
                </div>
                <div class="book-info">
                    <h3>Aldebaran</h3>
                    <p>by Tere Liye</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/lumiere blanche.jpg" alt="Lumiere Blanche">
                </div>
                <div class="book-info">
                    <h3>Lumiere Blanche</h3>
                    <p>by Cecillia Wang</p>
                </div>
            </div>
        </div>

     <section class="collection-section2" id="collection2">

        <h2 class="collection-title">
            <span class="star">★</span>
            Reader's Top Picks
            <span class="star">★</span>
        </h2>

        <div class="books-grid">
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/homesweetloan.jpg" alt="Home Sweet Loan">
                </div>
                <div class="book-info">
                    <h3>Home Sweet Loan</h3>
                    <p>by Almira Bastari</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/sagaras.jpeg" alt="Sagaras">
                </div>
                <div class="book-info">
                    <h3>Sagaras</h3>
                    <p>by Tere Liye</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/laut bercerita.jpg" alt="Laut Bercerita">
                </div>
                <div class="book-info">
                    <h3>Laut Bercerita</h3>
                    <p>by Leila S. Chudori</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/brianna dan bottomwise.jpeg" alt="Brianna dan Bottomwise">
                </div>
                <div class="book-info">
                    <h3>Brianna dan Bottomwise</h3>
                    <p>by Andrea Hirata</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/pulang pergi.jpeg" alt="Pulang Pergi">
                </div>
                <div class="book-info">
                    <h3>Pulang Pergi</h3>
                    <p>by Tere Liye</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/nadira.jpg" alt="Nadira">
                </div>
                <div class="book-info">
                    <h3>Nadira</h3>
                    <p>by Leila S. Chudori</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/anak rantau.jpg" alt="Anak Rantau">
                </div>
                <div class="book-info">
                    <h3>Anak Rantau</h3>
                    <p>by A. Fuadi</p>
                </div>
            </div>
            <div class="book-item">
                <div class="book-cover">
                    <img src="jpg/perempuan laut.jpg" alt="Perempuan Laut">
                </div>
                <div class="book-info">
                    <h3>Perempuan Laut</h3>
                    <p>by Usma Arrumy</p>
                </div>
            </div>
        </div>

    </section>

</body>
</html>