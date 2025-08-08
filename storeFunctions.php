

<?php
    session_start();
    class StoreFunctions {

        private $server = "mysql:host=localhost;port=3307;dbname=vendirecta-db";
        private $user = "root";
        private $password = "";
        private $port = "3307";
        private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

        protected $connection;
        protected $vendorId = "104040"; // Default vendorId

        public function openConnection() {
            try {
                $this->connection = new PDO($this->server, $this->user, $this->password, $this->options);
                return $this->connection;

            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public function closeConnection() {
            $this->connection = null;
        }   

        public function getProducts() {
            $connection = $this->openConnection();
            $stmt = $this->connection->prepare("SELECT * FROM products");
            $stmt->execute();
            $products = $stmt->fetchAll();
            $userCount = $stmt->rowCount();
            // $this->closeConnection();
            // return $products;

            if ($userCount > 0) {
                return $products;
            } else {
                return [];

            }
        }

        public function check_product_exists($productName) {
            $connection = $this->openConnection();
            $stmt = $this->connection->prepare("SELECT LOWER('product_name') FROM products WHERE product_name = ?");
            $stmt->execute([strtolower($productName)]);
            $result = $stmt->rowCount();
            
            return $result;
        }

        public function addProduct(){ 
            if (isset($_POST['addProduct'])) {
                
                $vendorId = $_POST['vendorId'];
                $productName = $_POST['productName'];
                $productType = $_POST['productType']; 
                $stockNum = $_POST['stockNum'];
                $productQuantity = $_POST['productQuantity'];
                $price = $_POST['price'];
                // $description = $_POST['description'];

               if ($this->check_product_exists($productName) > 0) {
                    echo "Product already exists.";
                } else {
                    $connection = $this->openConnection();
                    $stmt = $this->connection->prepare("INSERT INTO products (vendor_id, product_name, product_type, stock_num, quantity_type, price) 
                                                        VALUES (?,?,?,?,?,?)");
                
                    $stmt->execute([ 
                        $vendorId,
                        $productName,
                        $productType,
                        $stockNum,
                        $productQuantity,
                        $price
                    ]);

                    $result = $stmt->rowCount();

                    if ($result > 0) {
                        echo "Product added successfully!";
                    } else {
                        echo "Error adding product.";
                    }

                    $this->closeConnection();
                }
            }

        }

        public function show404(){
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
            die();

        }

        public function getSingleProduct($id) {
            $connection = $this->openConnection();
            $stmt = $this->connection->prepare("SELECT * FROM products WHERE product_id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch();
            $total = $stmt->rowCount();

            if ($total > 0) {
                return $product;
            } else {
                return $this->show404(); 
            }
        }


        public function editProduct(){ 

            if (isset($_POST['editProduct'])) {

                $productId = $_POST['productId'];
                $stockNum = $_POST['stockNum'];
                $price = $_POST['price'];
                // $description = $_POST['description'];

                try{
                    $connection = $this->openConnection();
                    $stmt = $this->connection->prepare("UPDATE products SET stock_num = :stock_num, price = :price WHERE product_id = :product_id");
                                                    
                    $stmt->execute([
                        ':stock_num' => $stockNum,
                        ':price' => $price,
                        ':product_id' => $productId
                    ]);

                    $result = $stmt->rowCount();

                    if ($result > 0) {
                        echo "Product edited successfully!";
                    } else {
                        echo "Error editing product.";
                    }

                    $this->closeConnection();

                }catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                echo '<br>';
                echo 'PRODUCT ID: '.$productId;
                echo '<br>';
                echo 'STOCK: '.$stockNum;
                echo '<br>';
                echo 'PRICE: '.$price;

            }
                
               
                
            }

        }


//This functionS DOING NOTHING CURRENTLY
        public function deleteProduct($id) {
            $connection = $this->openConnection();
            $stmt = $this->connection->prepare("DELETE FROM products WHERE product_id = ?");
            $stmt->execute([$id]);
            $result = $stmt->rowCount();

            if ($result > 0) {
                echo "Product deleted successfully!";
            } else {
                echo "Error deleting product.";
            }

            $this->closeConnection();
        }
         
        public function getVendor() {
            return $this->vendorId;
        }
    }

    $store = new StoreFunctions();
   
?>
