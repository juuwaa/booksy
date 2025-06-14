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

    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    }

    .logo {
    height: 40px;
    }

    .login-btn {
    background-color: #e4c59e;
    color: black;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    font-weight: 700;
    cursor: pointer;
    font-size: 15px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .login-btn:hover {
      background-color: #F8EEE1;
      transform: scale(1.05);
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

    </style>

</head>
<body>
  <div class="hero">
    <header>
      <img src="images/booksyyy.png" alt="Booksy Logo" class="logo">
      <a href='index.php'><button class="login-btn">LOG IN</button></a>
    </header>

    <div class="hero-content">
      <h1>Welcome to Booksy</h1>
      <p>The best place to discover a wide collection of books, journals, and quality references<br>to support your learning and research needs.</p>
    </div>
  </div>
</body>
</html>
