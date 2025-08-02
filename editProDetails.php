<?php
require_once 'storeFunctions.php';
$id = $_GET['id'];
$singleProduct = $store->getSingleProduct($id);
$store->editProduct($_POST);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Edit Product Details</h1>
    <form method="post">

        <h3><?php echo htmlspecialchars($singleProduct['product_name']); ?> </h3> 
       

        <p>Product ID: <?php echo htmlspecialchars($singleProduct['product_id']); ?></p>
        <input type="hidden" name="productId" id="productId" value="<?php echo htmlspecialchars($singleProduct['product_id']); ?>" >

        <p>Category: <?php echo htmlspecialchars($singleProduct['product_type']); ?></p>
       

        <p>Quantity Type: <?php echo htmlspecialchars($singleProduct['quantity_type']); ?></p>
       
        
        <label for="price">Price: ₱</label>
        <input type="number" step="1" name="price" id="price" min="0" value="<?php echo htmlspecialchars($singleProduct['price']); ?>" required><br>

        <label for="stockNum">Stock Number:</label>
        <input type="number" name="stockNum" id="stockNum" min="1" value="<?php echo htmlspecialchars($singleProduct['stock_num']); ?>" required><br>

        <button type="submit" name="editProduct">Save Edit</button>
