<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$totalHarga = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalHarga += $item['total'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $itemIndex = $_POST['item_index'];
    if (isset($_SESSION['cart'][$itemIndex])) {
        if ($_SESSION['cart'][$itemIndex]['quantity'] > 1) {
            $_SESSION['cart'][$itemIndex]['quantity']--;
            $_SESSION['cart'][$itemIndex]['total'] = $_SESSION['cart'][$itemIndex]['price'] * $_SESSION['cart'][$itemIndex]['quantity'];
        } else {
            unset($_SESSION['cart'][$itemIndex]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); 
        }
    }
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
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
            margin-top: 50px;
            padding: 20px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            text-align: center;
        }

        .cart-table {
            width: 100%;
            background-color: white;
            color: #333;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #f8f9fa;
        }

        .cart-table button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .cart-table button:hover {
            background-color: #b02a37;
        }

        .checkout {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .checkout:hover {
            background-color: #1e7e34;
        }

        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="brand">Gelang Dimas</div>    
    <nav>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="cart.php" class="active">Keranjang</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    </nav>
    <div class="container">
        <h2>Keranjang Belanja</h2>
        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                      <tr>
                        <td><?= htmlspecialchars($item['name']); ?></td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td>Rp <?= number_format($item['total'], 0, ',', '.'); ?></td>
                        <td>
                         <form method="post">
                           <input type="hidden" name="item_index" value="<?= $index; ?>"> <!-- Kirimkan indeks item -->
                           <button type="submit" name="remove">Hapus</button>
                <        </form>
                        </td>
                      </tr>
                     <?php endforeach; ?>
                    </tbody>
                </table>
                <p style="text-align: right; font-weight: bold;">Total Harga: Rp <?= number_format($totalHarga, 0, ',', '.'); ?></p>
            </div>
            <a href="checkout.php" class="checkout">Checkout</a>
        <?php else: ?>
            <p class="empty-cart">Keranjang Anda kosong.</p>
        <?php endif; ?>
    </div>
</body>
</html>
