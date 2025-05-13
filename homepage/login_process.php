<?php
session_start(); // Start the session at the beginning

$conn = new mysqli("localhost", "root", "", "login_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($email === '' || $password === '') {
        $error_message = 'Email and password are required.';
    } else {
        $stmt = $conn->prepare("SELECT id, fullname, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $fullname, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_fullname'] = $fullname;
                header('Location: /homepage/index.php');
                exit;
            } else {
                $error_message = 'Incorrect password.';
            }
        } else {
            $error_message = 'Email not found. Please sign up first.';
        }
        $stmt->close();
    }
    $conn->close();
}

if (!empty($error_message)) {
    header('Location: login.php?error=' . urlencode($error_message));
    exit;
}
?>
