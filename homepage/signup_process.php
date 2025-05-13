<?php
session_start();
// Database connection
$conn = new mysqli("localhost", "root", "", "login_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

    if ($fullname === '' || $email === '' || $password === '' || $confirm_password === '' || $phone === '') {
        $error_message = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email format.';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Passwords do not match.';
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error_message = 'Email already registered.';
        } else {
            // Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, phone) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fullname, $email, $hashed_password, $phone);
            if ($stmt->execute()) {
                header('Location: login.php?registration=success');
                exit;
            } else {
                $error_message = 'Error saving user. Please try again.';
            }
        }
        $stmt->close();
    }
    $conn->close();
}

// If there was an error, redirect back to signup form with error message
if (!empty($error_message)) {
    // Pass error message via query parameter (simple way for this example)
    // A more robust way would be to use sessions for flash messages
    header('Location: signup.php?error=' . urlencode($error_message));
    exit;
}
?>
