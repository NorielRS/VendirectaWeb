<?php
    require_once 'storeFunctions.php';
     $vendorId = $store->getVendor();
    $store->addProduct($_POST);

    
    print_r($vendorId);
   
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendirecta</title>
</head>
<body>
    <h1>Create new Product</h1>
    <form action="addNewProduct.php" method="post">

        <input type="hidden" name="vendorId" id="vendorId" value="<?php echo htmlspecialchars($vendorId); ?>" required><br>

        <label for="productName">Product Name:</label>
        <input type="text" name="productName" id="productName" required><br>

        <label for="productType">Product Type:</label>
        <select name="productType" id="productType" required>
            <option value="Vegetables">Vegetable</option>
            <option value="Fruits">Fruit</option>
            <option value="Handicrafts">Handicrafts</option>
            <option value="Other">Other</option>
        </select><br>

         <label for="productQuantity">Quantity/Unit:</label>
        <select name="productQuantity" id="productQuantity" required>
            <option value="Kilo">Kilo</option>
            <option value="Tali">Tali</option>
            <option value="Piraso">Piraso</option>
        </select><br>

        <label for="price">Price:</label>
        <input type="number" step="1" name="price" id="price" min="0" value="0" required><br>

        <label for="stockNum">Stock Number:</label>
        <input type="number" name="stockNum" id="stockNum" min="1" value="1" required><br>

        <button type="submit" name="addProduct">Add Product</button>


</body>
</html>