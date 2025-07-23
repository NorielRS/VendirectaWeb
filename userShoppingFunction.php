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

            if (isset($_POST['buyNow'])) {

                $productId = $_POST['productId'];
                $product = $this->getSingleProduct($productId);
                
                if ($product) {
                    return 'Buying: '.$product['product_name'];
                } else {
                    return $this->show404();
                }

            }

            if (isset($_POST['addToCart'])) {

               $productId = $_POST['productId'];
                $product = $this->getSingleProduct($productId);
                
                if ($product) {
                    return 'Adding to Cart: '.$product['product_name'];
                } else {
                    return $this->show404();
                }
            }
        }

    }  

    $userShoppingFunction = new UserShoppingFunction();
?>