<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YZZA'S LPG GAS SHOP - Login</title>
    <link href="loginstyles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <img class="logo" src="pexels-thatguycraig000-1563356.jpg" alt="YZZA'S LPG GAS SHOP logo">
            <h1>YZZA'S LPG GAS SHOP</h1>
        </header>
        
        <main class="main-content">
            <div class="hero-image">
                <img src="pexels-thatguycraig000-1563356.jpg" alt="LPG Gas Shop">
            </div>
            
            <div class="login-container">
                <form class="login-form" action="login_process.php" method="POST">
    
                    <h2>Welcome Back</h2>
                    <?php
                        if (isset($_GET['error'])) {
    echo '<p class="message error-message">' . htmlspecialchars($_GET['error']) . '</p>';
}
if (isset($_GET['registration']) && $_GET['registration'] === 'success') {
    echo '<p class="message success-message">Registration successful! Please log in.</p>';
}
                    ?>
                    <div class="form-image">
                        <img src="pexels-thatguycraig000-1563356.jpg" alt="Login illustration">
                    </div>
                    
                    <div class="form-group">
    <label for="email">Email</label>
    <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
    </div>
</div>

<div class="form-group">
    <label for="password">Password</label>
    <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>
</div>

<button type="submit" class="btn btn-primary">Log In</button>
<a href="forgot-password.html"><button type="button" class="btn btn-secondary">Forgot Password?</button></a>
<div class="register-link">
    <p>Don't have an account? <a href="signup.php">Register here</a></p>
</div>
<div class="social-login-block">
    <div class="or-text">or</div>
    <div class="social-login-inline">
        <button type="button" class="btn social-btn gmail-btn"><i class="fab fa-google"></i> Log in with Google</button>
        <button type="button" class="btn social-btn facebook-btn"><i class="fab fa-facebook-f"></i> Log in with Facebook</button>
    </div>
</div>
</form>
            </div>
        </main>
    </div>
</body>
</html>