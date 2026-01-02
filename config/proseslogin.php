<?php
session_start();
include 'koneksi.php'; // File koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan username dan password
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Set session
        $_SESSION['username'] = $user['username'];

        // Redirect berdasarkan role
        switch ($user['username']) {
            case 'syech':
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