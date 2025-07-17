<?php
require_once 'storeFunctions.php';
$id = $_GET['id'];
$product = $store->getSingleProduct($id);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Product Details</h1
    <?php
        print_r($product);
    ?>
