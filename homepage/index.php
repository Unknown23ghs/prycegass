<?php
session_start();

$conn = new mysqli("localhost", "root", "", "lpgshop");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>YZZA's LPG Online Shop</title>
</head>

<body>
    <nav class="main-nav enhanced-nav">
    <a href="index.php"><span class="nav-icon">&#8962;</span> Home</a>
    <a href="membership.html"><span class="nav-icon">&#128081;</span> Subscription</a>
    <a href="cart.php"><span class="nav-icon">&#128722;</span> Cart</a>
    <a href="support.php"><span class="nav-icon">&#9742;</span> Customer Support</a>
    <a href="index.php"><span class="nav-icon">&#8592;</span> Return</a>
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="logout-btn"><span class="nav-icon">⎋</span> Logout</a>
    <?php endif; ?>
</nav>
<style>
.enhanced-nav {
    background: linear-gradient(90deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    padding: 10px 30px;
    margin: 20px auto 30px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 18px;
    max-width: 900px;
    min-height: 60px;
}
.enhanced-nav a {
    color: #222;
    font-weight: 600;
    text-decoration: none;
    padding: 8px 18px;
    border-radius: 6px;
    transition: background 0.18s, color 0.18s;
    display: flex;
    align-items: center;
    font-size: 1.07rem;
}
.enhanced-nav a:hover {
    background: #e0e7ef;
    color: #0a5a8e;
}
.logout-btn {
    background: #e74c3c;
    color: #fff !important;
    border: none;
    padding: 8px 18px;
    border-radius: 6px;
    font-weight: 700;
    margin-left: 18px;
    transition: background 0.18s, color 0.18s;
    display: flex;
    align-items: center;
    height: 40px;
    box-sizing: border-box;
}
.logout-btn:hover {
    background: #c0392b;
    color: #fff;
}
.nav-icon {
    margin-right: 6px;
    font-size: 1.2em;
}
</style>

    <!-- Rest of your code remains the same -->
    <!-- HERO/BANNER (same as before) -->
    <section class="hero">
        <div class="LPGbordersign">
            <div class="banner-grid">
                <div class="banner-social-card">
                    <div class="banner-social-title">Follow us on</div>
                    <div class="banner-social-links">
                        <div class="banner-social-link">Facebook.com@JonelCuartoCruz</div>
                        <div class="banner-social-link">Instagram.com@Zntsuma.com</div>
                        <div class="banner-social-link">Tiktok.com@Daddy.tyga</div>
                    </div>
                </div>
                <div class="banner-title">
                    <h1>YZZA's LPG<br>Online Shop</h1>
                </div>
                <div class="banner-cylinder">
                    <img src="gas-bottle-vector-clipart.png" class="cylinderlogo" alt="LPG Cylinder">
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCTS SECTION (dynamic with PHP) -->
    <section class="products-section">
        <div class="products-section-title">Shop Products</div>
        <div class="products-grid">
            <?php while($row = $products->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="product-img">
                    <div class="product-info">
                        <h2 class="product-title"><?= htmlspecialchars($row['name']) ?></h2>
                        <p class="item-price">₱<?= htmlspecialchars($row['price']) ?></p>
                        <form method="post" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            <input type="number" name="quantity" value="1" min="1" style="width:50px;">
                            <button type="submit" class="add-to-cart">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- FOOTER (same as before) -->
    <footer>
        <hr>
        <h2 class="followuson">Follow us on:</h2>
        <div class="allpicture">
            <a href="#"><img src="facebook-6338509_1280.webp" class="logo1" alt="Facebook"></a>
            <a href="#"><img src="Instagram-Logo-2016.png" class="logo2" alt="Instagram"></a>
            <a href="https://youtu.be/dQw4w9WgXcQ?si=YFzAYU-_4RK75q6D"><img src="yt-6273367_960_720.webp" class="logo3" alt="YouTube"></a>
        </div>
        <a href="/CustomerServicehtml/CustomerService.html"><h2 class="message">Message us</h2></a>
        <a href="#"><h2 class="FAQ">FAQs</h2></a>
        <a href="#"><h2 class="about">About us</h2></a>
    </footer>

</body>
</html>