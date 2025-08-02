<?php
require_once 'userShoppingFunction.php';
require_once 'storeFunctions.php';
$id = $_GET['id'];
$singleProduct = $store->getSingleProduct($id);
$result = $userShoppingFunction->buyNow($_POST);
$userShoppingFunction->buyNowWithDetails($_POST);

// print_r($singleProduct);
echo '<br>';
print_r($result);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Now</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Buy Now</h1>
    <form method="post">

        <h3><?php echo htmlspecialchars($singleProduct['product_name']); ?> </h3> 
       

        <!-- <p>Product ID: <?php echo htmlspecialchars($singleProduct['product_id']); ?></p> -->
        <input type="hidden" name="productId" id="productId" value="<?php echo htmlspecialchars($singleProduct['product_id']); ?>" >

        <!-- <p>Category: <?php echo htmlspecialchars($singleProduct['product_type']); ?></p> -->

        <p>Quantity Type: <?php echo htmlspecialchars($singleProduct['quantity_type']); ?></p>

        <p>Price: ₱ <?php echo htmlspecialchars($singleProduct['price']); ?></p>

        <p>Stocks: <?php echo htmlspecialchars($singleProduct['stock_num']); ?></p>

        <label for="stockNum">Stock Number:</label>
        <input type="number" name="stocks_bought" id="stocks_bought" min="1" value="1" required><br>
       
        
     

        <button type="submit" name="buy_now_detailed">Buy Now</button>

         
