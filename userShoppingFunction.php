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
                $totalPrice = $_POST['totalAmount'];
                $price_at_purchase = $_POST['price_at_purchase'];
                $stocks_bought = $_POST['stocks_bought'];
                $userId = '404010';                       // Assuming you have a way to get the user ID, replace this with actual user ID retrieval logic
                $orderStatus = 'Pending'; // Default order status
                // $product = $this->getSingleProduct($productId);
                
                // if ($product) {
                    try{
                        // Add the order to the orders table
                        $orderId = $this->addCheckoutToOrders($userId, $totalPrice,$orderStatus);    
                        
                        // If order creation was successful, add the order items
                        // Assuming addCheckoutToOrdersItems is a method that adds items to the order_items table
                        if ($orderId) {
                            $this->addCheckoutToOrdersItems($orderId, $productId, $stocks_bought, $price_at_purchase);
                            echo "Checkout successful! Order ID: " . $orderId;

                            header("Location: /Vendirecta/orders.php?");
                            exit;
                        } else {
                            echo "Error processing checkout.";
                        }
                    

                    }catch (PDOException $e) {
                        return "Error: " . $e->getMessage();
                    }

                // } else {
                //     return $this->show404();
                // }

            }
        } 

        public function addCheckoutToOrders($userId, $totalPrice, $orderStatus) {
            $pdo = $this->openConnection();
            if (!$pdo) return false;

            $stmt = $this->connection->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?,?)");
            $stmt->execute([$userId, $totalPrice, $orderStatus]);
            $returnid = $pdo->lastInsertId();
            return $returnid;
        }

         public function addCheckoutToOrdersItems($orderId, $productId, $stocks_bought, $price_at_purchase) {
           
            $stmt = $this->connection->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)");
            $stmt->execute([$orderId, $productId, $stocks_bought, $price_at_purchase]);       
        }

        public function getOrders($userId) {
            $stmt = $this->connection->prepare("SELECT 
                o.id AS order_id,
                p.product_name AS product_name,
                oi.product_id,
                oi.quantity AS order_quantity,
                o.total_price AS total_amount,
                o.created_at,
                o.status AS order_status
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            JOIN products p ON oi.product_id = p.product_id
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC");
            $stmt->execute([$userId]);
            $orders = $stmt->fetchAll();
            $orderCount = $stmt->rowCount();
            if ($orderCount > 0) {
                return $orders;
            } else {
                return [];
            }
        }




        
    }

    $userShoppingFunction = new UserShoppingFunction();
?>