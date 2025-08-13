<?php
require_once 'storeFunctions.php';
require_once 'userShoppingFunction.php';
   
$products = $store->getProducts();
$userShoppingFunction->goToOrdersAndCart($_POST);

    
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendirecta</title>
</head>
<body>
    <h1>Vendirecta</h1>
    <form method="post">
        <button type="submit" name="goto_orders">Orders</button>

        <button type="submit" name="goto_cart">Cart</button>

    <h2>Products:</h2>
    
        <?php foreach ($products as $product): ?>
          
          <h4><a href="<?php echo '/Vendirecta/itemShowUser.php?id=' . urlencode($product['product_id']); ?>">
                <?php echo htmlspecialchars($product['product_name']); ?>
            </a></h4>

            <p>Product ID: <?php echo htmlspecialchars($product['product_id']); ?></p>
            <p>Category: <?php echo htmlspecialchars($product['product_type']); ?></p>
            <p>Price: ₱ <?php echo htmlspecialchars($product['price']. " per ". $product['quantity_type']); ?></p>
            <p>Stocks: <?php echo htmlspecialchars($product['stock_num']); ?></p>

        
            <hr>
           
        <?php endforeach; ?>
    


</body>
</html>