<?php
session_start();

$data_file = 'users.json'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $users = [];
        if (file_exists($data_file)) {
            $users = json_decode(file_get_contents($data_file), true);
        }

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $error = "Email sudah terdaftar!";
                include 'register.php';
                exit();
            }
        }

        $users[] = [
            'fullname' => $fullname,
            'email' => $email,
            'password' => $hashed_password,
        ];

        file_put_contents($data_file, json_encode($users, JSON_PRETTY_PRINT));

        header("Location: login.php");
        exit();
    } else {
        $error = "Password dan Konfirmasi Password tidak cocok!";
    }
}
?>