<?php
require_once 'userShoppingFunction.php';
require_once 'storeFunctions.php';
$id = $_GET['id'];
$singleProduct = $store->getSingleProduct($id);
$userShoppingFunction->checkout($_POST);
$userShoppingFunction->buyNowWithDetails($_POST);

// Example product data (replace with your database query)
$price = $singleProduct['price']; // price per product
$stocks_bought = $_GET['stocks_bought'];   // number of stocks available

$totalCost = $price * $stocks_bought;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Order</title>
</head>
<body>
    <h2>Product Cost Summary</h2>
    <p>Price per product: ₱ <?php echo number_format($price, 2); ?></p>
    <p>Number of stocks: <?php echo $stocks_bought; ?></p>
    <hr>
    <h3>Total Cost: ₱ <?php echo number_format($totalCost, 2); ?></h3>
    
    <form method="post" action="">
        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($singleProduct['product_id']); ?>">
         <input type="hidden" name="totalCost" value="<?php echo htmlspecialchars($totalCost); ?>">
      
        <button type="submit" name="checkout">CHECKOUT</button>
    </form>

    
</body>
</html>