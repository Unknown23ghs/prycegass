<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YZZA'S LPG GAS SHOP - Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            <form class="login-form" action="signup_process.php" method="POST">
    
                    <h2>Create Account</h2>
                    <?php
                        if (isset($_GET['error'])) {
    echo '<p class="message error-message">' . htmlspecialchars($_GET['error']) . '</p>';
}
                    ?>
                    <div class="form-image">
                        <img src="pexels-thatguycraig000-1563356.jpg" alt="Sign Up illustration">
                    </div>
                    
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                        </div>
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
                            <input type="password" id="password" name="password" placeholder="Create a password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <div class="input-group">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                    <div class="register-link">
                        <p>Already have an account? <a href="login.php">Log in here</a></p>
                    </div>
                    <div class="social-login-block">
    <div class="or-text">or</div>
    <div class="social-login-inline">
        <button type="button" class="btn social-btn gmail-btn"><i class="fab fa-google"></i> Sign up with Google</button>
        <button type="button" class="btn social-btn facebook-btn"><i class="fab fa-facebook-f"></i> Sign up with Facebook</button>
    </div>
</div>
</form>
            </div>
        </main>
    </div>
</body>
</html>