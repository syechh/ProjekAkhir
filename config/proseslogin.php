<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['login'] = true;

        switch ($user['role']) {
            case 'admin':
                header('Location: ../dashboard.php');
                break;
            case 'penjaga gudang':
                header('Location: ../dashboard.php');
                break;
            case 'owner':
                header('Location: ../dashboard.php');
                break;
            default:
                header('Location: ../index.php?error=1');
                break;
        }
        exit();
    } else {
        header('Location: ../index.php?error=1');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>