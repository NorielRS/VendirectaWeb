<?php
require_once 'userShoppingFunction.php';
require_once 'addToCartFunctions.php';
$id = $_GET['id'];
$singleProduct = $store->getSingleProduct($id);
$result = $userShoppingFunction->buyNow($_POST);
$userShoppingFunction->buyNowWithDetails($_POST);
$addToCartWithDetails = $addToCartFunctions->addToCartWithDetails($_POST);
$userId = $userSession->getUserId();

// print_r($singleProduct);
echo '<br>';
print_r($addToCartWithDetails);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add To Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Add To Cart</h1>
    <form method="post">

        <h3><?php echo htmlspecialchars($singleProduct['product_name']); ?> </h3> 
       

        <!-- <p>Product ID: <?php echo htmlspecialchars($singleProduct['product_id']); ?></p> -->
        <input type="hidden" name="productId" id="productId" value="<?php echo htmlspecialchars($singleProduct['product_id']); ?>" >

        <input type="hidden" name="userId" id="userId" value="<?php echo htmlspecialchars($userId); ?>" >

        <!-- <p>Category: <?php echo htmlspecialchars($singleProduct['product_type']); ?></p> -->

        <p>Quantity Type: <?php echo htmlspecialchars($singleProduct['quantity_type']); ?></p>

        <p>Price: ₱ <?php echo htmlspecialchars($singleProduct['price']); ?></p>

        <p>Stocks: <?php echo htmlspecialchars($singleProduct['stock_num']); ?></p>

        <label for="stockNum">Stock Number:</label>
        <input type="number" name="stocks_added" id="stocks_added" min="1" value="1" required><br>
       
        
     

        <button type="submit" name="add_to_cart_detailed">Add to Cart</button>

         
