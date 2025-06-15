<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booksy</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin-top: 60px;
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #D4A574, #C09858);
            min-height: 100vh;
            background: linear-gradient(to right bottom, #896040, #896040, #3A1F08);
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

        .logo {
            font-size: 1.8rem;
            font-weight: 600;
            color: #8B4513;
            text-decoration: none;
        }

        .logo-img {
            height: 40px;
            width: auto;
        }

        .nav-container {
            display: flex;
            align-items: center;
            gap: 30px;
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

        .search-container {
            display: flex;
            align-items: center;
            gap: 20px;
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
            font-family: 'Montserrat';
        }

        .search-bar::placeholder {
            color: rgba(139, 69, 19, 0.6);
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

        .main-content {
            padding: 60px 40px;
            text-align: center;
        }

        .search-title {
            font-size: 2.5rem;
            color: #F8EEE1;
            margin-bottom: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .search-query {
            color: #F8EEE1;
        }

        .star {
            color: rgb(255, 215, 115);
            margin: 0 10px;
        }

        .books-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .book-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 25px;
            width: 220px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-cover {
            width: 140px;
            height: 200px;
            margin: 0 auto 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #90EE90, #32CD32);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .book-title {
            font-size: 1.1rem;
            color: #f8eee1;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .book-author {
            font-size: 0.9rem;
            color: #e4c59e;
            margin-bottom: 10px;
        }

        .book-stock {
            font-size: 0.8rem;
            color: #e4c59e;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 20px;
                padding: 20px;
            }

            .nav-container {
                flex-direction: column;
                gap: 15px;
                width: 100%;
            }

            .search-container {
                width: 100%;
                justify-content: center;
            }

            .search-bar {
                width: 100%;
                max-width: 300px;
            }

            .main-content {
                padding: 40px 20px;
            }

            .search-title {
                font-size: 1.5rem;
            }

            .books-container {
                gap: 20px;
            }

            .book-card {
                width: 180px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="images/booksyyy.png" alt="Booksy Logo" class="logo-img" />
        <div class="nav-container">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="hello" value="hello">
            </div>
            <nav class="nav-links">
                <a href="#">Home</a>
                <a href="#">Collection</a>
            </nav>
            <a href="#" class="profile-icon">👤</a>
        </div>
    </header>

    <main class="main-content">
        <h1 class="search-title">
            <span class="star">★</span>
            Search results for "<span class="search-query">hello</span>"
            <span class="star">★</span>
        </h1>
        
        <div class="books-container">
            <div class="book-card">
                <div class="book-cover">HELLO</div>
                <div class="book-title">Hello</div>
                <div class="book-author">by Tere Liye</div>
                <div class="book-stock">Stok 20</div>
            </div>
        </div>
    </main>
</body>
</html>