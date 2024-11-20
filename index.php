<?php
session_start();
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: url('background gelang.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
    }

    .container {
        max-width: 500px;
        margin: 100px auto;
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h1 {
        margin-top: 200px;
        text-align: center;
        color: #444;
        font-size: 24px;
    }

    .brand {
        position: absolute;
        top: 150px; 
        left: 726px; 
        font-size: 90px;
        font-family: 'Dancing Script', cursive;
        color: red;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    nav {
        margin-top: 50px;
        text-align: center;
    }

    nav ul {
        list-style-type: none;
        padding: 0;
    }

    nav ul li {
        display: inline-block;
        margin: 0 10px;
    }

    nav ul li a {
        text-decoration: none;
        color: #007BFF;
        font-weight: bold;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    nav ul li a:hover {
        background-color: #007BFF;
        color: #fff;
    }
</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="brand">Gelang Dimas</div>
    <div class="container">
        <h1>Selamat Datang di Toko Gelang Dimas</h1>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="register.php">Daftar</a></li>
                <?php else: ?>
                    <li><a href="register.php">Daftar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>
</html>