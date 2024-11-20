<?php
session_start();

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$cartItems = $_SESSION['cart'];
$totalHarga = 0;
foreach ($cartItems as $item) {
    $totalHarga += $item['total'];
}

$tanggal = date('Y-m-d');
$waktu = date('H:i:s');
$namaKasir = "Dimas"; 
$noPesanan = "No. " . rand(100, 999);

$_SESSION['cart'] = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f4f4f4;
        }

        .receipt {
            width: 300px;
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .receipt h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .receipt p {
            margin: 2px 0;
            font-size: 14px;
        }

        .receipt .line {
            border-top: 1px dashed #333;
            margin: 10px 0;
        }

        .receipt table {
            width: 100%;
            margin-bottom: 10px;
            font-size: 14px;
            border-collapse: collapse;
        }

        .receipt table th,
        .receipt table td {
            padding: 5px;
            text-align: left;
        }

        .receipt table td:last-child {
            text-align: right;
        }

        .receipt .footer {
            font-size: 12px;
            margin-top: 10px;
        }

        .receipt .footer a {
            color: blue;
            text-decoration: none;
        }

        .receipt .footer a:hover {
            text-decoration: underline;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Toko Gelang Dimas</h1>
        <p>Jl. Gondang Timur, Semmarang</p>
        <p>081529620220414</p>
        <div class="line"></div>
        <p><?= $tanggal ?> - <?= $waktu ?></p>
        <p>Kasir: <?= $namaKasir ?></p>
        <p><?= $noPesanan ?></p>
        <div class="line"></div>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']); ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td>Rp <?= number_format($item['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="line"></div>
        <p><strong>Sub Total:</strong> Rp <?= number_format($totalHarga, 0, ',', '.'); ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($totalHarga, 0, ',', '.'); ?></p>
        <p><strong>Bayar (Cash):</strong> Rp <?= number_format($totalHarga, 0, ',', '.'); ?></p>
        <p><strong>Kembali:</strong> Rp 0</p>
        <div class="line"></div>
        <div class="footer">
            <p>Link Kritik dan Saran:</p>
            <a href="https://olshopin.com/f/748488" target="_blank">olshopin.com/f/748488</a>
        </div>
        <button onclick="window.print()">Cetak Struk</button>
    </div>
</body>
</html>
