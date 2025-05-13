<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$conn = new mysqli("localhost", "root", "", "lpgshop");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get cart count
$cart_count = 0;
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $cart_sql = $conn->prepare("SELECT SUM(quantity) FROM cart WHERE user_id = ?");
    $cart_sql->bind_param("i", $uid);
    $cart_sql->execute();
    $cart_sql->bind_result($cart_count);
    $cart_sql->fetch();
    $cart_sql->close();
}

// Get notification count (example: unread notifications)
$notif_count = 0;
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $notif_sql = $conn->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
    $notif_sql->bind_param("i", $uid);
    $notif_sql->execute();
    $notif_sql->bind_result($notif_count);
    $notif_sql->fetch();
    $notif_sql->close();
}

// Handle search
$search_query = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search_query = trim($_POST['search']);
    header('Location: index.php?search=' . urlencode($search_query));
    exit;
}
?>
<nav class="main-nav enhanced-nav">
    <div class="nav-left">
        <button type="button" class="back-btn" onclick="window.history.back();">&#8592;</button>
    </div>
    <div class="nav-center">
        <form class="search-form" method="POST" action="">
            <input type="text" name="search" class="searchbox" placeholder="Search" value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" class="search-btn">🔍</button>
        </form>
    </div>
    <div class="nav-right">
        <a href="cart.php" class="icon-link" title="Cart">
            🛒
            <?php if($cart_count > 0): ?>
                <span class="icon-badge"><?php echo $cart_count; ?></span>
            <?php endif; ?>
        </a>
        <a href="notifications.php" class="icon-link" title="Notifications">
            🔔
            <?php if($notif_count > 0): ?>
                <span class="icon-badge"><?php echo $notif_count; ?></span>
            <?php endif; ?>
        </a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="logout-btn">Log out</a>
        <?php endif; ?>
    </div>
</nav>
<style>
.main-nav.enhanced-nav {
    background: #f5f7fa;
    border-radius: 18px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    padding: 6px 20px;
    margin: 20px auto 30px auto;
    display: flex;
    align-items: center;
    gap: 0;
    max-width: 1100px;
    min-height: 40px;
    justify-content: space-between;
}
.nav-left, .nav-center, .nav-right {
    display: flex;
    align-items: center;
}
.nav-left {
    flex: 0 0 auto;
}
.nav-center {
    flex: 1 1 100%;
    justify-content: center;
}
.nav-right {
    flex: 0 0 auto;
    gap: 6px;
}
.search-form {
    display: flex;
    align-items: center;
    background: #f7f8fa;
    border-radius: 18px;
    border: 1px solid #eee;
    width: 100%;
    max-width: 900px;
    padding: 2px 16px;
}
.searchbox {
    width: 100%;
    min-width: 140px;
    max-width: 700px;
    height: 36px;
    font-size: 15px;
    border: none;
    background: transparent;
    outline: none;
    margin-right: 8px;
}
.search-btn {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #333;
    margin-right: 0;
}
.back-btn {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #333;
    margin-right: 8px;
    padding: 0 8px;
}
.icon-link {
    position: relative;
    font-size: 22px;
    color: #222;
    text-decoration: none;
    margin-right: 8px;
    padding: 5px 8px;
    border-radius: 6px;
    transition: background 0.1s;
}
.icon-link:hover {
    background: #f0f0f0;
}
.icon-badge {
    position: absolute;
    top: -8px;
    right: -6px;
    background: #e74c3c;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    border-radius: 50%;
    padding: 2px 7px;
    min-width: 20px;
    text-align: center;
}
.logout-btn {
    background: #e74c3c;
    color: #fff;
    border: none;
    padding: 7px 16px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: background 0.18s;
    text-decoration: none;
    margin-left: 8px;
}
.logout-btn:hover {
    background: #c0392b;
}
@media (max-width: 600px) {
    .main-nav.enhanced-nav { flex-direction: column; padding: 10px 10px; gap: 10px; }
    .searchbox { width: 120px; font-size: 13px; }
    .search-form { max-width: 200px; }
}
</style>
