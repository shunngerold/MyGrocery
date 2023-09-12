<?php

class Products extends DbHandler
{
    // Insert product info to the database
    protected function setProducts(
        $prod_title,
        $stock_number,
        $exp_date,
        $price, 
        $kilo_pcs_pack,
        $category, 
        $description,
        $img_upload_path
    ) {
        // Check query
        $sql = "SELECT * FROM `product` ORDER BY `product_id` DESC LIMIT 1";
        $stmt = $this->connect()->query($sql);

        // Check if the product table is greater than 0
        if ($stmt->rowcount() > 0) {
            if ($product = $stmt->fetchAll()) {
                // Generate user ID
                $prod_id = $product[0]['product_id']; // Declaring variable for product id
                // get number in existing id
                $get_numbers = str_replace("P", "", $prod_id);
                // Auto Increament for custom id = P-01 + 1 
                $id_increase = $get_numbers + 1;
                // Setting format of a custom id = P0001
                $get_string = str_pad($id_increase, 5, 0, STR_PAD_LEFT);
                // Variable for custom id
                $id = "P" . $get_string;

                // SQL statement for inserting data
                $sql = "INSERT INTO `product` (`product_id`, 
                                               `product_title`, 
                                               `stock_number`, 
                                               `expiry_date`, 
                                               `price`, 
                                               `kilo_pcs_pack`, 
                                               `category`, 
                                               `description`, 
                                               `images`) 

                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $this->connect()->prepare($sql);

                if (!$stmt->execute(array(
                    $id,
                    $prod_title,
                    $stock_number,
                    $exp_date,
                    $price, 
                    $kilo_pcs_pack, 
                    $category, 
                    $description,
                    $img_upload_path
                ))) {
                    $stmt = null;
                    header("location: ../admin_side/home.php?error=statementfailed");
                    exit();
                }
                // reset the statement
                $stmt = null;
            }
        } else { // if product_id = 0
            // Generate custom ID
            $id = "P00001";

            // SQL statement for inserting data
            $sql = "INSERT INTO `product` (`product_id`, 
                                           `product_title`, 
                                           `stock_number`, 
                                           `expiry_date`, 
                                           `price`, 
                                           `kilo_pcs_pack`, 
                                           `category`, 
                                           `description`, 
                                           `images`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute(array(
                                    $id,
                                    $prod_title,
                                    $stock_number,
                                    $exp_date,
                                    $price, 
                                    $kilo_pcs_pack, 
                                    $category, 
                                    $description,
                                    $img_upload_path
                                ))) {
            $stmt = null;
            header("location: ../admin_side/home.php?error=statementfailed");
            exit();
            }
            // reset the statement
            $stmt = null;
        }
    }

    protected function checkIfProductExists($prod_title) {
        $sql = "SELECT * FROM `product` WHERE `product_title` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($prod_title))) {
            $stmt = null;
            header("location: ../admin_side/home.php?error=statementfailed");
            exit();
        }
        
        return $stmt->rowCount();
    }

    // ###############################################################################
    // Update Products

    protected function updateProductDetails(
        $prod_id,
        $prod_title,
        $stock_number,
        $exp_date,
        $price, 
        $kilo_pcs_pack,
        $category, 
        $description,
        $img_upload_path
    ) {

        // If product image is null
        if ($_FILES['image']['error'] == 4) {

            $sql = "UPDATE `product` SET `product_title` = ?,
                                     `stock_number` = ?,
                                     `expiry_date` = ?,
                                     `price` = ?,
                                     `kilo_pcs_pack` = ?,
                                     `category` = ?,
                                     `description` = ?
                WHERE `product_id` = ?";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute(array
            (
                $prod_title,
                $stock_number,
                $exp_date,
                $price, 
                $kilo_pcs_pack, 
                $category, 
                $description, 
                $prod_id
            ))) 
            {
                $stmt = null;
                header("location: ../admin_side/home.php?error=statementfailed");
                exit();
            }

        } else {
            $sql = "UPDATE `product` SET `product_title` = ?,
                                     `stock_number` = ?,
                                     `expiry_date` = ?,
                                     `price` = ?,
                                     `kilo_pcs_pack` = ?,
                                     `category` = ?,
                                     `description` = ?, 
                                     `images` = ?
                WHERE `product_id` = ?";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute(array
            (
                $prod_title,
                $stock_number,
                $exp_date,
                $price, 
                $kilo_pcs_pack, 
                $category, 
                $description,
                $img_upload_path, 
                $prod_id
            ))) 
            {
                $stmt = null;
                header("location: ../admin_side/home.php?error=statementfailed");
                exit();
            }
        }
    }

    // ####################################################################################
    // Delete Product
    protected function deleteProduct($prod_id) {
        $sql = "DELETE FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($prod_id))) {
            $stmt = null;
            header("location: ../admin_side/home.php?error=statementfailed");
            exit();
        }
    }

    // #####################################################################################
    // Excel File
    protected function insertExcelFile() {
        // require composer autoload
        require './vendor/autoload.php';

        // get tmp file
        $inputFileName =  $_FILES['excel']['tmp_name'];
        
        // initiate PHPSpreadsheet
        $spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $sheet = $spreadsheet->getActiveSheet()->toArray();
        
        // fetch data
        $count = 0;
        $sum_items = 0;
        $excel_items = 0;
        foreach($sheet as $data) {
           
            if(strpos($data[0], "id") != false ||
               strpos($data[0], "ID") != false || 
               strpos($data[0], "iD") != false || 
               strpos($data[0], "Id") != false) 
            {
                echo "<script> window.history.go(-1); </script>";
                $_SESSION['error'] = "The Product ID should not be included in the excel file you enter!";
                exit();

            } else {
                // remove excel headers
                if($count > 0) {
                    // check if product exists
                    if($this->excelProductExist($data[0]) == 0) {
                        // // print_r($data[0]. "<br/>");
                        $sql_check = "SELECT * FROM `product` ORDER BY `product_id` DESC LIMIT 1";
                        $stmt_check = $this->connect()->query($sql_check);

                        if($stmt_check->rowCount() > 0) {
                            // Fetch ID
                            $product = $stmt_check->fetchAll();
                            // Generate user ID
                            $prod_id = $product[0]['product_id']; // Declaring variable for product id
                            // get number in existing id
                            $get_numbers = str_replace("P", "", $prod_id);
                            // Auto Increament for custom id = P-01 + 1 
                            $id_increase = $get_numbers + 1;
                            // Setting format of a custom id = P0001
                            $get_string = str_pad($id_increase, 5, 0, STR_PAD_LEFT);
                            // Variable for custom id
                            $id = "P" . $get_string;

                            // Get excel data
                            $prod_title = $data[0];
                            $stock_number = $data[1];
                            $exp_date = $data[2];
                            $price = $data[3];
                            $kilo_pcs_pack = $data[4];
                            $category = $data[5];
                            $description = $data[6];
                            $image_default = "./assets/images/uploads/default-product-image.png";

                            // SQL statement for inserting data
                            $sql = "INSERT INTO `product` (`product_id`, 
                                                        `product_title`, 
                                                        `stock_number`, 
                                                        `expiry_date`, 
                                                        `price`, 
                                                        `kilo_pcs_pack`, 
                                                        `category`, 
                                                        `description`, 
                                                        `images`) 
                                    VALUES ('".$id."', 
                                            '".$prod_title."', 
                                            '".$stock_number."', 
                                            '".$exp_date."', 
                                            '".$price."', 
                                            '".$kilo_pcs_pack."', 
                                            '".$category."', 
                                            '".$description."', 
                                            '".$image_default."')";
                            $stmt = $this->connect()->query($sql);

                            if(!$stmt) {
                                $stmt = null;
                                header("location: ../admin_side/home.php?error=statementfailed");
                                exit();
                            }
                        }
                        // sum items inserted in database
                        $sum_items += $this->excelProductExist($data[0]);
                    } 
                    // sum excel total items
                    $excel_items += 1;

                } else {
                    $count = 1;
                }
            }
        }
        // message
        if($sum_items == 0) {
            $stmt = null;
            echo "<script> window.history.go(-1); </script>";
            $_SESSION['error'] = "All Items are available in product list";
            exit();
        } else {
            // // back to home page - error: none
            echo "<script> window.history.go(-1); </script>";
            $_SESSION['excel'] = $sum_items . " out of " . $excel_items . " items, successfully inserted!";
        }
    }
    // Check if excel datas is already available in product lists
    protected function excelProductExist($product_title) {
        $sql = "SELECT * FROM `product` WHERE `product_title` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($product_title))) {
            // file type
            $stmt = null;
            $_SESSION['error'] = "Database Failed";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }

        // return data
        return $stmt->rowcount();
    }

    // for product view (All Products)
    protected function getAvailProducts()
    {
        // get all data from database
        $sql = "SELECT * FROM `product`";
        $stmt = $this->connect()->query($sql);

        // fetch all data
        $result = $stmt->rowcount();
        // return data
        return $result;
    }

    protected function getAllProducts($start_from, $cont_limit)
    {
        // get limited data from database
        $sql = "SELECT * FROM `product` LIMIT $start_from, $cont_limit";
        $stmt = $this->connect()->query($sql);

        // fetch all data
        $result = $stmt->fetchAll();
        // return data
        return $result;
    }

    protected function getAvailSpecificCategory($category)
    {
        // get all data from database
        $sql = "SELECT * FROM product WHERE `category` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($category))) {
            $stmt = null;
            $err = "Statement failed!";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }

        // count all data
        $product = $stmt->rowcount();
        // return data
        return $product;
    }

    protected function getSpecificCategory($start_from, $cont_limit, $category)
    {
        // get limited data from database
        $sql = "SELECT * FROM product WHERE `category` = ? LIMIT $start_from, $cont_limit";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($category))) {
            $stmt = null;
            $err = "Statement failed!";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }

        // fetch all data
        $product = $stmt->fetchAll();
        // return data
        return $product;
    }

    protected function getAvailSearchedProduct()
    {
        // get data from database
        $sql = "SELECT 
                    * 
                FROM product 
                WHERE CONCAT(`product_title`, `price`, `category`, `description`) 
                LIKE '%" . $_GET['search'] . "%'";

        $stmt = $this->connect()->query($sql);

        // count all data
        $product = $stmt->rowcount();
        // return data
        return $product;
    }

    protected function getSearchedProduct($start_from, $cont_limit)
    {
        // get data from database
        $sql = "SELECT 
                    * 
                FROM product 
                WHERE CONCAT(`product_title`, `price`, `category`, `description`) 
                LIKE '%" . $_GET['search'] . "%' LIMIT " . $start_from . "," . $cont_limit . "";

        $stmt = $this->connect()->query($sql);

        // fetch all data
        $product = $stmt->fetchAll();
        // return data
        return $product;
    }

    // For product edit view
    protected function getAllProductsByID($product_id) {
        $sql = "SELECT * FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($product_id))) {
            $stmt = null;
            $err = "Statement failed!";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }

        return $stmt->fetchObject();
    }

    // get all delivery info
    protected function getDelivery($start_from, $cont_limit) {
        // get limited data from database
        $sql = "SELECT * FROM `delivery` ORDER BY `delivery_id` DESC LIMIT $start_from, $cont_limit";
        $stmt = $this->connect()->query($sql);

        // fetch all data
        $result = $stmt->fetchAll();
        // return data
        return $result;
    }

    // count all delivery info
    protected function getAvailDelivery() {
        // get limited data from database
        $sql = "SELECT * FROM `delivery`";
        $stmt = $this->connect()->query($sql);

        // count all data
        $result = $stmt->rowCount();
        // return data
        return $result;
    }

    protected function getSearchedDelivery($start_from, $cont_limit)
    {
        // get data from database
        $sql = "SELECT 
                    * 
                FROM `delivery`
                WHERE CONCAT(`delivery_id`, `cart_number`, `username`, `postal`, `sub_total`, `delivery_id`, `total_price`, `order_date`, `delivery_status`) 
                LIKE '%" . $_GET['search'] . "%' LIMIT " . $start_from . "," . $cont_limit . "";

        $stmt = $this->connect()->query($sql);

        // return data
        return $stmt;
    }

    // get all Canceled Orders
    protected function getAllCancel($start_from, $cont_limit) {
        // get limited data from database
        $sql = "SELECT * FROM `canceled_order` ORDER BY `cancel_id` DESC LIMIT $start_from, $cont_limit";
        $stmt = $this->connect()->query($sql);

        // fetch all data
        $result = $stmt->fetchAll();
        // return data
        return $result;
    }

    // count all Canceled Orders
    protected function getAvailCancel() {
        // get limited data from database
        $sql = "SELECT * FROM `canceled_order`";
        $stmt = $this->connect()->query($sql);

        // count all data
        $result = $stmt->rowCount();
        // return data
        return $result;
    }

    // Get searched cancel orders
    protected function getSearchedCancel($start_from, $cont_limit)
    {
        // get data from database
        $sql = "SELECT 
                    * 
                FROM `canceled_order`
                WHERE CONCAT(`cancel_id`, `delivery_id`, `cart_number`, `username`, `postal`, `sub_total`, `delivery_id`, `total_price`, `date_canceled`) 
                LIKE '%" . $_GET['search'] . "%' LIMIT " . $start_from . "," . $cont_limit . "";

        $stmt = $this->connect()->query($sql);

        // return data
        return $stmt;
    }

    // Delete Canceled Orders
    protected function CanceledOrder($delivery_id) {
        $sql = "DELETE FROM `canceled_order` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        // Statement 1: Delete order from canceled_order table
        if(!$stmt->execute(array($delivery_id))) {
            $stmt = null;
            header("location: ../admin_side/canceled_order.php?error=statementfailed");
            exit();

        } else {
            // Statement 2: Delete products under this order from cart_history table
            $sql2 = "DELETE FROM `cart_history` WHERE `delivery_id` = ?";
            $stmt2 = $this->connect()->prepare($sql2);

            if(!$stmt2->execute(array($delivery_id))) {
                $stmt2 = null;
                header("location: ../admin_side/canceled_order.php?error=statementfailed");
                exit();
            }
        }
    }

    // View specific product / item
    protected function specificItem($prod_id) {
        $sql = "SELECT * FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($prod_id))) {
            $stmt = null;
            header("location: ../items.php?error=statementfailed");
            exit();
        }

        return $stmt->fetchAll();
    }
} 