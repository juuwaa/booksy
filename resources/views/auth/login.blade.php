<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booksy Login</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Montserrat', sans-serif;
    }

    body {
      background: linear-gradient(to right bottom, #896040, #3A1F08);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background-image: url('images/containewr.png');
      background-size: cover;
      background-position: center;
      padding: 60px;
      border-radius: 25px;
      box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.3);
      width: 1000px;
      max-width: 100%;
    }

    .logo {
      display: block;
      margin: 0 auto 40px auto;
      max-width: 250px;
      height: auto;
      filter: drop-shadow(3px 3px 6px rgba(0, 0, 0, 0.4));
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.05);
    }

    .login-card {
      background-color: #F8EEE1;
      padding: 40px 50px;
      border-radius: 25px;
      max-width: 400px;
      margin: 0 auto;
      box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
    }

    form label {
      font-size: 15px;
      font-weight: 600;
      display: block;
      margin-bottom: 8px;
      margin-top: 18px;
      color: #4a3b2e;
    }

    form input {
      width: 100%;
      padding: 12px 15px;
      border-radius: 12px;
      border: 1px solid #ccc;
      background-color: #fefcf9;
      font-size: 16px;
    }

    form input:focus {
      outline: none;
      border-color: #a17c5f;
      box-shadow: 0 0 5px rgba(161, 124, 95, 0.5);
    }

    button {
      width: 200px;
      padding: 14px;
      border-radius: 30px;
      border: none;
      background-color: #5C4033;
      color: white;
      font-weight: 700;
      font-size: 15px;
      margin-top: 25px;
      cursor: pointer;
      display: block;
      margin-left: auto;
      margin-right: auto;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #3a1f08;
      transform: scale(1.05);
    }

    .error-message {
      color: #b43737;
      font-weight: 700;
      font-size: 15px;
      text-align: center;
      margin-bottom: 20px;
    }
  </style>

</head>
<body>
  <div class="container">
    <img src="images/booksyyy.png" alt="Booksy Logo" class="logo" />
    <div class="login-card">

      <form method="POST" action="">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required />

        <button type="submit">LOG IN</button>
      </form>
    </div>
  </div>
</body>
</html>
