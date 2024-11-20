<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function addToCart($itemName, $price) {
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $itemName) {
            $item['quantity']++;
            $item['total'] = $item['quantity'] * $price;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $itemName,
            'price' => $price,
            'quantity' => 1,
            'total' => $price
        ];
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    $itemName = $_POST['item_name'];
    $price = (float) $_POST['price'];
    addToCart($itemName, $price);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand {
        position: absolute;
        top: 0px; 
        left: 30px; 
        font-size: 36px;
        font-family: 'Dancing Script', cursive;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        }


        nav {
            background-color: #145ab5; 
            padding: 10px 20px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        nav ul {
            list-style-type: none; 
            margin: 0;
            padding: 0;
            display: flex; 
            justify-content: center; 
        }

        nav ul li {
            margin: 0 15px; 
        }

        nav ul li a {
            text-decoration: none; 
            color: #fff; 
            font-weight: bold; 
            padding: 8px 16px;
            border-radius: 5px; 
            transition: background-color 0.3s ease; 
        }

        nav ul li a:hover {
            background-color: #0e3f82; 
        }

        nav ul li a.active {
            background-color: #0e3f82;
        }

        .container {
            margin-top: 70px;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            text-align: center;
        }

        h2, h3 {
            margin: 10px 0;
        }

        .store {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }

        .product {
            width: 100%;
            max-width: 300px;
            background-color: white;
            color: #333;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product h4 {
            margin: 10px 0 5px;
        }

        .product p {
            margin: 5px 0;
            color: #555;
        }

        .product button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product button:hover {
            background-color: #0056b3;
        }

        @media (min-width: 600px) {
            .store {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="brand">Gelang Dimas</div>
    <nav>
        <ul>
            <li><a href="home.php" class="active">Home</a></li>
            <li><a href="cart.php">Keranjang</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
        
    <div class="container">
        <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['fullname']); ?></h2>
        <h3>Daftar Produk</h3>
        <div class="store">
            <div class="product">
                <img src="Gelang 1.jpg" alt="Gelang 1">
                <h4>Gelang Murah Meriah</h4>
                <p>Model Aksesoris Gelang</p>
                <p>Bahan Kayu</p>
                <p>Berat 0.5gr</p>
                <p>Harga: Rp 50.000</p>
                <form method="post" action="">
                    <input type="hidden" name="item_name" value="Gelang 1">
                    <input type="hidden" name="price" value="50000">
                    <button type="submit" name="buy">Beli</button>
                </form>
            </div>
            <div class="product">
                <img src="Gelang 2.webp" alt="Gelang 2">
                <h4>Gelang Tali Liontin</h4>
                <p>Model Aksesoris Gelang</p>
                <p>Bahan Emas asli dengan kadar 700</p>
                <p>Berat 0.65gr</p>
                <p>Harga: Rp 150.000</p>
                <form method="post" action="">
                    <input type="hidden" name="item_name" value="Gelang 2">
                    <input type="hidden" name="price" value="150000">
                    <button type="submit" name="buy">Beli</button>
                </form>
            </div>
            <div class="product">
                <img src="Gelang 3.jpg" alt="Gelang 3">
                <h4>Gelang Bola Lapis Emas</h4>
                <p>Model Aksesoris Gelang</p>
                <p>Bahan Emas asli 24K</p>
                <p>Berat 1gr</p>
                <p>Harga: Rp 200.000</p>
                <form method="post" action="">
                    <input type="hidden" name="item_name" value="Gelang 3">
                    <input type="hidden" name="price" value="200000">
                    <button type="submit" name="buy">Beli</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
