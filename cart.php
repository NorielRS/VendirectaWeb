<?php
require_once 'userShoppingFunction.php';
require_once 'addToCartFunctions.php';

 $products = $store->getProducts();

$userId = $userSession->getUserId(); // Assuming you have a way to get the user ID, replace this with actual user ID retrieval logic

$cart_items = $userShoppingFunction->getOrders($userId);

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
    
        <?php foreach ($cart_items as $cart_item): ?>
            <div class="cart_item-item">
            <h4><a href="<?php echo '/Vendirecta/itemShowUser.php?id=' . urlencode($cart_item['product_id'] ?? ''); ?>">
                <?php echo htmlspecialchars($cart_item['product_name'] ?? ''); ?>
            </a></h4>

            <p><?php htmlspecialchars($cart_item['product_id'] ?? ''); ?></p>
            <p>Order ID: <?php echo htmlspecialchars($cart_item['order_id'] ?? ''); ?></p>
            <p>Order Date: <?php echo htmlspecialchars($cart_item['created_at'] ?? ''); ?></p>
            <p>Order Status: <?php echo htmlspecialchars($cart_item['order_status'] ?? ''); ?></p>
            <p>Order Quantity: <?php echo htmlspecialchars($cart_item['order_quantity'] ?? ''); ?></p>
            <p>Total Amount: ₱ <?php echo htmlspecialchars($cart_item['total_amount'] ?? ''); ?></p>

            <hr>
            </div>
        <?php endforeach; ?>
</body>
</html>