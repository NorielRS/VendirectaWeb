<?php

require_once 'userShoppingFunction.php';


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
                $userId = $_POST['userId'];                     //$_SESSION['user_id'];                  // Assuming you have a way to get the user ID, replace this with actual user ID retrieval logic
                $orderStatus = 'Pending';
                $product = $this->getSingleProduct($productId);
                
                if ($product) {
                
                    $encoded_stocks_added = urlencode($_POST['stocks_added']); 

                    try{
                       $this->openCart();
                        $cart_id = $_SESSION['cart_id'];
                        $this->addToCartItems($cart_id, $productId, $stocks_added);
                        
                        return "Added to Cart: ".$product['product_name']." with quantity: ".$stocks_added;

                    }catch (PDOException $e) {
                        return "Error: " . $e->getMessage();
                    }

                } else {
                    return $this->show404();
                }

              }
            }

        // public function addToCart($userId, $cart_status) {
        //     $pdo = $this->openConnection();
        //     if (!$pdo) return false;

        //     $stmt = $this->connection->prepare("INSERT INTO cart (user_id, cart_status) VALUES (?, ?)");
        //     $stmt->execute([$userId, $cart_status]);
        //     $returnid = $pdo->lastInsertId();
        //     return $returnid;
        // }

        public function addToCartItems($cart_id, $product_id, $stocks_added) {
           
            $stmt = $this->connection->prepare("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$cart_id, $product_id, $stocks_added]);       
        }

        public function openCart(){
             $pdo = $this->openConnection();
            if (!isset($_SESSION['cart'])) {
                $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND cart_status = 'active' LIMIT 1");
                $stmt->execute([$_SESSION['user_id']]);
                $cart = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($cart) {
                    $_SESSION['cart_id'] = $cart['id'];
                }else {
                    $this->createCart();
                }
 
            }
        }

         public function createCart() {
            $pdo = $this->openConnection();
            if (!$pdo) return false;

            $stmt = $this->connection->prepare("INSERT INTO cart (user_id, cart_status) VALUES (?, 'active')");
            $stmt->execute([$_SESSION['user_id']]);
            $_SESSION['cart_id'] = $pdo->lastInsertId();
            return $_SESSION['cart_id'];
        }

        public function getCartItems($cart_id) {
            $stmt = $this->connection->prepare("SELECT 
                p.product_name AS product_name,
                p.product_id AS product_id,
                ci.quantity AS quantity,
                p.price AS price,
                ci.id AS cart_id 
                FROM cart c 
                JOIN cart_items ci ON c.id = ci.cart_id
                JOIN products p ON ci.product_id = p.product_id
                WHERE c.id = ?");
                
            $stmt->execute([$cart_id]);
            $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $cartItems;
        }
        

    }
    $addToCartFunctions = new AddToCartFunctions();
?>