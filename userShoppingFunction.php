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

    }  

    $userShoppingFunction = new UserShoppingFunction();
?>