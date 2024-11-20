<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$error = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data_file = 'users.json';

    if (file_exists($data_file)) {
        $users = json_decode(file_get_contents($data_file), true);

        $is_authenticated = false; 

        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $email;
                $_SESSION['fullname'] = $user['fullname'];
                $is_authenticated = true;
                header("Location: home.php");
                exit();
            }
        }

        if (!$is_authenticated) {
            $error = "Email atau password salah!";
        }
    } else {
        $error = "Data pengguna tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4a90e2, #145ab5); 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #145ab5; 
        }

        form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
        }

        form input:focus {
            border: 1px solid #145ab5;
            outline: none;
            box-shadow: 0 0 6px rgba(20, 90, 181, 0.4);
        }

        form input[type="submit"] {
            background: #145ab5;
            color: #fff;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form input[type="submit"]:hover {
            background: #0e3f82; 
        }

        a {
            color: #145ab5;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            font-size: 14px;
            margin-top: 15px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
        <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html