<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booksy Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(to right bottom, #896040, #896040, #3A1F08);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Decorative stars */
        .star {
            position: absolute;
            color: rgba(139, 69, 19, 0.3);
            font-size: 24px;
            animation: twinkle 3s ease-in-out infinite alternate;
        }

        .star:nth-child(1) { top: 15%; left: 12%; animation-delay: 0s; }
        .star:nth-child(2) { top: 25%; left: 8%; animation-delay: 1s; font-size: 18px; }
        .star:nth-child(3) { top: 45%; left: 5%; animation-delay: 2s; font-size: 20px; }
        .star:nth-child(4) { top: 65%; left: 10%; animation-delay: 0.5s; }
        .star:nth-child(5) { top: 15%; right: 12%; animation-delay: 1.5s; }
        .star:nth-child(6) { top: 35%; right: 8%; animation-delay: 2.5s; font-size: 18px; }
        .star:nth-child(7) { top: 55%; right: 6%; animation-delay: 1s; font-size: 22px; }
        .star:nth-child(8) { bottom: 20%; right: 15%; animation-delay: 0.3s; }

        @keyframes twinkle {
            0% { opacity: 0.3; transform: scale(1); }
            100% { opacity: 0.8; transform: scale(1.1); }
        }

        /* Flowing lines decoration */
        .flowing-lines {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.2;
            overflow: hidden;
        }

        .line {
            position: absolute;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(139, 69, 19, 0.4), transparent);
            animation: flow 8s linear infinite;
        }

        .line:nth-child(1) {
            top: 20%;
            width: 300px;
            animation-delay: 0s;
        }

        .line:nth-child(2) {
            top: 40%;
            width: 250px;
            animation-delay: 2s;
        }

        .line:nth-child(3) {
            bottom: 30%;
            width: 280px;
            animation-delay: 4s;
        }

        @keyframes flow {
            0% { left: -300px; }
            100% { left: 100%; }
        }

        .profile-container {
            background: rgba(245, 245, 220, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: relative;
            border: 2px solid rgba(139, 69, 19, 0.1);
        }

         .logo {
            max-width: 200px;
            height: auto;
            filter: drop-shadow(3px 3px 6px rgba(0, 0, 0, 0.4));
            margin-bottom: 20px;
        }


        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #CD5C5C, #F4A460);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border: 4px solid rgba(255, 255, 255, 0.8);
        }

        .profile-avatar .avatar-text {
            color: white;
            font-size: 48px;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .profile-info {
            margin-bottom: 40px;
        }

        .profile-name {
            font-size: 32px;
            font-weight: bold;
            color: #654321;
            margin-bottom: 5px;
        }

        .profile-email {
            font-size: 18px;
            color: #8B7355;
            padding: 5px 20px;
        }

        .logout-btn {
            background: linear-gradient(135deg, #8B4513, #A0522D);
            color: white;
            border: none;
            padding: 16px 40px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
            background: linear-gradient(135deg, #A0522D, #8B4513);
        }

        .logout-btn:active {
            transform: translateY(0);
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
    <!-- Decorative stars -->
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>
    <div class="star">★</div>

    <!-- Flowing lines -->
    <div class="flowing-lines">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <header class="header">
        <img src="images/booksyyy.png" alt="Booksy Logo" class="logo-img" />
        <div class="nav-container">
            <input type="text" class="search-bar" placeholder="Find your favorite books...">
            <nav class="nav-links">
                <a href="#">Home</a>
                <a href="#collection">Collection</a>
                <a href="profile.php" class="profile-icon">👤</a>
            </nav>
        </div>
    </header>

    <div class="profile-container">
        <div class="profile-avatar">
            <span class="avatar-text">AS</span>
        </div>

        <div class="profile-info">
            <div class="profile-name">Arya Sativa</div>
            <div class="profile-email">arya.sativa@email.com</div>
        </div>

        <button class="logout-btn" onclick="handleLogout()">Logout</button>
    </div>

    <script>
        function handleLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // Add logout animation
                document.querySelector('.profile-container').style.transform = 'scale(0.8)';
                document.querySelector('.profile-container').style.opacity = '0';
                
                setTimeout(() => {
                    alert('You have been logged out successfully!');
                    // In a real app, you would redirect to login page
                    // window.location.href = '/login';
                }, 300);
            }
        }

        // Add some interactive effects
        document.addEventListener('mousemove', (e) => {
            const stars = document.querySelectorAll('.star');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            stars.forEach((star, index) => {
                const speed = (index + 1) * 0.5;
                const x = mouseX * speed;
                const y = mouseY * speed;
                star.style.transform += ` translate(${x}px, ${y}px)`;
            });
        });
    </script>
</body>
</html>