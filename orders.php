<?php
    require_once 'userShoppingFunction.php';
   
    $products = $store->getProducts();

    $userId = $userSession->getUserId(); // Assuming you have a way to get the user ID, replace this with actual user ID retrieval logic

    $orders = $userShoppingFunction->getOrders($userId);
    
    print_r('Current UserID: '.$userId);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>
</head>
<body>
    <h1>Your Orders</h1>
    <h2>Orders:</h2>
    
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