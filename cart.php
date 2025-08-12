<?php
require_once 'userShoppingFunction.php';
require_once 'addToCartFunctions.php';
$id = $_GET['id'];
$singleProduct = $store->getSingleProduct($id);
 $userId = '404010';

$price = $singleProduct['price']; // price per product

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
</head>
<body>
    <h1>Cart</h1>
   <h2>Cart:</h2>
    
        <?php foreach ($orders as $order): ?>
            <div class="order-item">
            <h4><a href="<?php echo '/Vendirecta/itemShowUser.php?id=' . urlencode($order['product_id'] ?? ''); ?>">
                <?php echo htmlspecialchars($order['product_name'] ?? ''); ?>
            </a></h4>

            <p><?php htmlspecialchars($order['product_id'] ?? ''); ?></p>
            <p>Order ID: <?php echo htmlspecialchars($order['order_id'] ?? ''); ?></p>
            <p>Order Date: <?php echo htmlspecialchars($order['created_at'] ?? ''); ?></p>
            <p>Order Status: <?php echo htmlspecialchars($order['order_status'] ?? ''); ?></p>
            <p>Order Quantity: <?php echo htmlspecialchars($order['order_quantity'] ?? ''); ?></p>
            <p>Total Amount: ₱ <?php echo htmlspecialchars($order['total_amount'] ?? ''); ?></p>

            <hr>
            </div>
        <?php endforeach; ?>
</body>
</html>