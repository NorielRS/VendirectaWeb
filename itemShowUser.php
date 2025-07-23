<?php
require_once 'userShoppingFunction.php';
require_once 'storeFunctions.php';
$id = $_GET['id'];
$singleProduct = $store->getSingleProduct($id);
$result = $userShoppingFunction->buyNow($_POST);

// print_r($singleProduct);
echo '<br>';
print_r($result);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Product Details</h1>
    <form method="post">

        <h3><?php echo htmlspecialchars($singleProduct['product_name']); ?> </h3> 
       

        <p>Product ID: <?php echo htmlspecialchars($singleProduct['product_id']); ?></p>
        <input type="hidden" name="productId" id="productId" value="<?php echo htmlspecialchars($singleProduct['product_id']); ?>" >

        <p>Category: <?php echo htmlspecialchars($singleProduct['product_type']); ?></p>

        <p>Quantity Type: <?php echo htmlspecialchars($singleProduct['quantity_type']); ?></p>

        <p>Price: <?php echo htmlspecialchars($singleProduct['price']); ?></p>

        <p>Stocks: <?php echo htmlspecialchars($singleProduct['stock_num']); ?></p>
       
        
     

        <button type="submit" name="buyNow">Buy Now</button>

         <button type="submit" name="addToCart">Add to Cart</button>
