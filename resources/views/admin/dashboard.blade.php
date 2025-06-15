<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booksy</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">

  <style>
 
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
    }

    body, html {
    height: 100%;
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
    padding: 30px 50px;
    position: relative
    }

    .logo {
    height: 40px;
    }

    .hero-content {
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    }

    .hero-content h1 {
    font-size: 70px;
    font-weight: 800;
    }

    .hero-content p {
    margin-top: 10px;
    font-size: 20px;
    line-height: 1.5;
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

        .search-bar {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.364);
            width: 300px;
            outline: none;
            color: white;
            font-weight: 500;
            font-family: 'Montserrat', sans-serif;
        }

        .logo-img {
            height: 40px;
            width: auto;
        }

    </style>

</head>
<body>
  <div class="hero">
    <header class="header">
        <img src="images/booksyyy.png" alt="Booksy Logo" class="logo-img" />
        <div class="nav-container">
            <nav class="nav-links">
                <a href="#">Home</a>
                <a href="#collection">Update</a>
                <a href="profile.php" class="profile-icon">👤</a>
            </nav>
        </div>
    </header>

    <div class="hero-content">
      <h1>Hello, Booksy's Admin</h1>
      <p>The best place to discover a wide collection of books, journals, and quality references<br>to support your learning and research needs.</p>
    </div>
  </div>
</body>
</html>
