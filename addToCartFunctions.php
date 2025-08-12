<?php

    $_SESSION['user_id'] = '404010'; // Example user ID, replace with actual session management
    class AddToCartFunctions extends UserShoppingFunction {

        public function __construct() {
        parent::__construct(); // Calls ParentClass constructor
        // Child initialization
    }

        public function addToCartWithDetails($productId) {

        // echo 'add_to_cart_detailed run';

            if (isset($_POST['add_to_cart_detailed'])) {
                // echo 'add_to_cart_detailed run';

                $productId = $_POST['productId'];
                $stocks_added = $_POST['stocks_added'];
                $userId = '404010';                       //$_SESSION['user_id'];                  // Assuming you have a way to get the user ID, replace this with actual user ID retrieval logic
                $orderStatus = 'Pending';
                $product = $this->getSingleProduct($productId);
                
                if ($product) {
                
                    $encoded_stocks_added = urlencode($_POST['stocks_added']);  
                    try{
                        $cart_item_id = $this->addToCart($userId, 'active');
                        $this->addToCartItems($cart_item_id, $productId, $stocks_added);
                        // header("Location: /Vendirecta/cart.php?cart_id=$cart_item_id&stocks_added=$encoded_stocks_added");
                        // exit;
                        return "Added to Cart: ".$product['product_name']." with quantity: ".$stocks_added;

                    }catch (PDOException $e) {
                        return "Error: " . $e->getMessage();
                    }

                } else {
                    return $this->show404();
                }

              }
            }

        public function addToCart($userId, $cart_status) {
            $pdo = $this->openConnection();
            if (!$pdo) return false;

            $stmt = $this->connection->prepare("INSERT INTO cart (user_id, cart_status) VALUES (?, ?)");
            $stmt->execute([$userId, $cart_status]);
            $returnid = $pdo->lastInsertId();
            return $returnid;
        }

        public function addToCartItems($cart_item_id, $product_id, $stocks_added) {
           
            $stmt = $this->connection->prepare("INSERT INTO cart_items (cart_item_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$cart_item_id, $product_id, $stocks_added]);       
        }

    }
    $addToCartFunctions = new AddToCartFunctions();
?>