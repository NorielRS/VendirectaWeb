<?php
require_once 'storeFunctions.php';

    class UserShoppingFunction extends StoreFunctions {

        public function __construct() {
            $this->openConnection();
        }

        

        

        public function getSingleProduct($id) {
            $stmt = $this->connection->prepare("SELECT * FROM products WHERE product_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        }

        public function buyNow($productId) {

            if (isset($_POST['buy_now'])) {

                $productId = $_POST['productId'];
                $product = $this->getSingleProduct($productId);
                
                if ($product) {
                    // return 'Buying: '.$product['product_name'];
                    $encoded_id = urlencode($productId);
                    // Redirect the user to the product details page
                    header("Location: /Vendirecta/buyNow.php?id=$encoded_id");
                    exit;

                } else {
                    return $this->show404();
                }

            }

            if (isset($_POST['add_to_cart'])) {

               $productId = $_POST['productId'];
                $product = $this->getSingleProduct($productId);
                
                if ($product) {
                    // return 'Adding to Cart: '.$product['product_name'];
                    $encoded_id = urlencode($productId);
                    // Redirect the user to the product details page
                    header("Location: /Vendirecta/addToCart.php?id=$encoded_id");
                    exit;
                } else {
                    return $this->show404();
                }
            }
        }
         public function buyNowWithDetails($productId) {

            if (isset($_POST['buy_now_detailed'])) {

                $productId = $_POST['productId'];
                $product = $this->getSingleProduct($productId);
                
                if ($product) {
                    
                    $encoded_id = urlencode($productId);
                    $encoded_stocks_bought = urlencode($_POST['stocks_bought']);                   
                    header("Location: /Vendirecta/Checkout.php?id=$encoded_id,&stocks_bought=$encoded_stocks_bought");
                    exit;

                } else {
                    return $this->show404();
                }

            }
        } 
        
        public function checkout($productId) {

            if (isset($_POST['checkout'])) {

                $productId = $_POST['productId'];
                $totalPrice = $_POST['totalCost'];
                $userId = 404010;
                $product = $this->getSingleProduct($productId);
                
                if ($product) {
                    try{
                        echo $this->addCheckoutToOrders($pdo, $userId, $totalPrice);

                    }catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }



                    // $encoded_id = urlencode($productId);                  
                    // header("Location: /Vendirecta/ordersPage.php?id=$encoded_id");
                    // exit;

                } else {
                    return $this->show404();
                }

            }
        } 

        public function addCheckoutToOrders(PDO $pdo, $userId, $totalPrice) {
            $stmt = $this->connection->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
            $stmt->execute([$userId, $totalPrice]);
            $returnid = $pdo->lastInsertId();// ERROR
            return $returnid;
        }
    }

    $userShoppingFunction = new UserShoppingFunction();
?>