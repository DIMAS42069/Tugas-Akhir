<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            background: #0e3f82; /* Warna hover */
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
        <h2>Register</h2>
        <form method="post" action="process_register.php">
            <input type="text" name="fullname" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <input type="submit" value="Register">
        </form>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>