<?php
session_start();
$conn = new mysqli("localhost", "root", "", "lpgshop");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$session_id = session_id();
$payment_method = $_POST['payment_method'] ?? '';
$address = $_POST['address'] ?? '';

// Fetch cart items
$sql = "SELECT c.product_id, c.quantity, p.price
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$items = [];
while ($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
    $items[] = $row;
}

if ($total > 0 && $payment_method) {
    // Insert order
    $stmt = $conn->prepare("INSERT INTO orders (session_id, total, payment_method, address, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("sdss", $session_id, $total, $payment_method, $address);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items
    $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($items as $item) {
        $stmt2->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
        $stmt2->execute();
    }

    // Clear cart
    $stmt3 = $conn->prepare("DELETE FROM cart WHERE session_id = ?");
    $stmt3->bind_param("s", $session_id);
    $stmt3->execute();

    // Store order ID in session
    $_SESSION['last_order_id'] = $order_id;

    // Redirect to success page
    header("Location: success.php");
    exit;
} else {
    header("Location: payment.php");
    exit;
}