<?php
    require_once 'storeFunctions.php';
   
    $products = $store->getProducts();

    
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendirecta</title>
</head>
<body>
    <h1>Your Shop Name</h1>
    <h2>Products:</h2>
    
        <?php foreach ($products as $product): ?>
          
            <h4><a href="/Vendirecta/productDetails.php?id=<?= $product['product_id']; ?>"><?= $product['product_name']; ?></a></h4>
            <p>Product ID: <?php echo htmlspecialchars($product['product_id']); ?></p>
            <p>Category: <?php echo htmlspecialchars($product['product_type']); ?></p>
            <p>Price: <?php echo htmlspecialchars($product['price']. " per ". $product['quantity_type']); ?></p>
            <p>Stock: <?php echo htmlspecialchars($product['stock_num']); ?></p>
        
            <hr>
           
        <?php endforeach; ?>
    


</body>
</html>