<?php
require_once 'userShoppingFunction.php';
$id = $_GET['id'];
$singleProduct = $store->getSingleProduct($id);

// Example product data (replace with your database query)
$price = $singleProduct['price']; // price per product
// $stocks_bought = $_GET['stocks_bought'];   // number of stocks available

// $totalCost = $price * $stocks_bought;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Order</title>
</head>
<body>
    <h2>Order Confirmed</h2>
   
    <h3>Your Product <?php echo $singleProduct['product_name'];; ?> has been ordered</h3>

</body>
</html>