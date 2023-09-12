<?php

class Cart extends DbHandler
{
    // Set Cart Items
    protected function setCart($product_id, $qty)
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $check = "SELECT * FROM `cart` ORDER BY `cart_id` DESC LIMIT 1";
        $stmt_check = $this->connect()->query($check);

        // check if database greater than 0
        if ($stmt_check->rowcount() > 0) {
            if ($row = $stmt_check->fetchAll()) {
                // Generate cart number
                $uid = $row[0]['cart_id']; // Declaring variable for cart number
                // get number in existing id
                $get_numbers = str_replace("CID", "", $uid);
                // Auto Increament for custom cart number = CRT-01 + 1 
                $id_increase = $get_numbers + 1;
                // Setting format of a custom cart number = CRT0001
                $get_string = str_pad($id_increase, 4, 0, STR_PAD_LEFT);
                // Variable for custom id
                $cart_id = "CID" . $get_string;

                // check if qty is greater than stocks
                if($this->getProdStock($product_id) < $qty) {
                    $_SESSION['less_stock'] = "Please decrease your quantity according to our stocks, thank you!";
                    header("location: ../items.php?product_id=". $product_id);

                } else {
                    // check if result is 0
                    if ($this->productExist($product_id) == false) {
                        // check if product id is exist
                        $sql = "INSERT INTO `cart` (`cart_id`,
                                                    `cart_number`,
                                                    `username`,
                                                    `product_id`, 
                                                    `product_image`, 
                                                    `product_title`, 
                                                    `product_price`, 
                                                    `quantity`,
                                                    `cart_price`)
                                VALUES (?,?,?,?,?,?,?,?,?)";

                        $stmt = $this->connect()->prepare($sql);

                        // get cart price 
                        $cart_price = ($this->getProdPrice($product_id) * $qty);

                        if (!$stmt->execute(array($cart_id,
                                                $this->getCartNum(),
                                                $_SESSION['user_id'],
                                                $product_id,
                                                $this->getImg($product_id),
                                                $this->getTitle($product_id), 
                                                $this->getProdPrice($product_id), 
                                                $qty,
                                                $cart_price))) {
                            $stmt = null;
                            $error = "Statement Failed!";
                            header("location: ../index.php?error=" . $error . "");
                            exit();
                        }

                        $stmt = null;
                    } else {
                        // update existing quantity
                        $sql = "UPDATE `cart` 
                                    SET `quantity` = ? 
                                WHERE `username` = ? AND `product_id` = ?";

                        $stmt = $this->connect()->prepare($sql);

                        // set variable for quantity
                        $add_qty = $this->getQty($product_id) + $qty;

                        if (!$stmt->execute(array($add_qty, $_SESSION['user_id'], $product_id))) {
                            $stmt = null;
                            $error = "Statement Failed!";
                            header("location: ../index.php?error=" . $error . "");
                            exit();

                        } else {
                            // update existing price
                            $sql2 = "UPDATE `cart` 
                                        SET `cart_price` = ? 
                                WHERE `username` = ? AND `product_id` = ?";

                            $stmt2 = $this->connect()->prepare($sql2);

                            // set variable for price
                            $add_price =  $this->getProdPrice($product_id) * $this->getQty($product_id);

                            if (!$stmt2->execute(array($add_price, $_SESSION['user_id'], $product_id))) {
                                $stmt = null;
                                $error = "Statement Failed!";
                                header("location: ../index.php?error=" . $error . "");
                                exit();
        
                            }
                        }

                    }
                }
            }

            // check if databse = 0
        } else {
            $cart_id = "CID0001";

            if($this->getProdStock($product_id) < $qty) {
                $_SESSION['less_stock'] = "Please decrease your quantity according to our stocks, thank you!";
                header("location: ../items.php?product_id=". $product_id);

            } else {
                // check if product id is exist
                $sql = "INSERT INTO `cart` (`cart_id`,
                                            `cart_number`,
                                            `username`,
                                            `product_id`, 
                                            `product_image`, 
                                            `product_title`, 
                                            `product_price`, 
                                            `quantity`,
                                            `cart_price`)
                        VALUES (?,?,?,?,?,?,?,?,?)";

                $stmt = $this->connect()->prepare($sql);

                // get cart price 
                $cart_price = ($this->getProdPrice($product_id) * $qty);

                if (!$stmt->execute(array($cart_id,
                                        $this->getCartNum(),
                                        $_SESSION['user_id'],
                                        $product_id,
                                        $this->getImg($product_id),
                                        $this->getTitle($product_id), 
                                        $this->getProdPrice($product_id), 
                                        $qty,
                                        $cart_price))) {
                    $stmt = null;
                    $error = "Statement Failed!";
                    header("location: ../index.php?error=" . $error . "");
                    exit();
                }

            }
            $stmt = null;
        }
    }

    // Remove (Qty) Cart 
    protected function deleteQtyCart($product_id)
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        // set variable for price and quantity
        $remove_price = $this->getCartPrice($product_id) - $this->getProdPrice($product_id);
        $remove_qty = $this->getQty($product_id) - 1;

        if ($remove_qty < 1) {
            $sql = "DELETE FROM `cart` WHERE `product_id` = ? AND `username` = ?";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute(array($product_id, $_SESSION['user_id']))) {
                $stmt = null;
                $error = "Statement Failed!";
                header("location: ../index.php?error=" . $error . "");
                exit();
            }

            $stmt = null;
        } else {
            $sql = "UPDATE `cart` 
                        SET `quantity` = ?, 
                            `cart_price` = ? 
                WHERE `username` = ? AND `product_id` = ?";

            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute(array($remove_qty, $remove_price, $_SESSION['user_id'], $product_id))) {
                $stmt = null;
                $error = "Statement Failed!";
                header("location: ../index.php?error=" . $error . "");
                exit();
            }

            $stmt = null;
        }
    }

    // Remove (Qty) Cart 
    protected function deleteItemCart($product_id)
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }
        
        $sql = "DELETE FROM `cart` WHERE `product_id` = ? AND `username` = ?";
        $stmt = $this->connect()->prepare($sql);
    
        if (!$stmt->execute(array($product_id, $_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }
    
        $stmt = null;
    }

    // get product price
    protected function getProdPrice($product_id)
    {
        $sql = "SELECT `price` FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if ($stmt->rowcount() == 0) {
            // if price is = 0, back to index page
            $stmt = null;
            $err = "Database is null: getProdPRice";
            header("location: ../index.php?error=". $err);
            exit();
        } else {
            $result = $stmt->fetchAll();
        }

        return $result[0]['price'];
    }

    // get product price
    protected function getProdStock($product_id)
    {
        $sql = "SELECT * FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if ($stmt->rowcount() == 0) {
            // if price is = 0, back to index page
            $stmt = null;
            $err = "Database is null: getProdStock";
            header("location: ../index.php?error=". $err);
            exit();
        } else {
            $result = $stmt->fetchAll();
        }

        return $result[0]['stock_number'];
    }

    // get current price of specific product in cart
    protected function getCartPrice($product_id)
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT `cart_price` FROM `cart` WHERE `username` = ? AND `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id'], $product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if ($stmt->rowcount() == 0) {
            // if price is = 0, back to index page
            $stmt = null;
            header("location: ../index.php");
            exit();
        } else {
            $result = $stmt->fetchAll();
        }

        return $result[0]['cart_price'];
    }

    // get product title 
    protected function getTitle($product_id)
    {
        $sql = "SELECT `product_title` FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        $title = $stmt->fetchAll();
        return $title[0]['product_title'];
    }

    // Get user's cart number
    protected function getCartNum()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT `cart_number` FROM `customers` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        $cnum = $stmt->fetchAll();

        return $cnum[0]['cart_number'];
    }

    // get current quantity of specific product
    protected function getQty($product_id)
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }
        
        $sql = "SELECT `quantity` FROM `cart` WHERE username = ? AND `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id'], $product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if ($stmt->rowcount() == 0) {
            // if quantuty is = 0, back to index page
            $stmt = null;
            header("location: ../index.php");
            exit();
        } else {
            $result = $stmt->fetchAll();
        }

        return $result[0]['quantity'];
    }

    // get image from product table
    protected function getImg($product_id)
    {
        $sql = "SELECT `images` FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        $productImg = $stmt->fetchAll();
        return $productImg[0]['images'];
    }

    // check if product is exist
    protected function productExist($product_id)
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT `product_id` FROM `cart` WHERE `username` = ? AND `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id'], $product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if ($stmt->rowcount() == 0) {
            // product does not exist
            $result = false;
        } else {
            // product exist
            $result = true;
        }

        return $result;
    }

    // count the specific items in cart
    protected function countCart()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `cart` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if ($stmt->rowcount() == 0) {
            $result = false;
        } else {
            $result = $stmt->rowcount();
        }

        return $result;
    }
    
    // #################################################################################
    // get notification data
    protected function getNotif() {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `notification` WHERE `msg_to` = ? OR `msg_to` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($_SESSION['user_id'], "customers"))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        return $stmt;
    }

    // get users - > ADMIN SIDE =======================>
    protected function getUsers() {
        $sql = "SELECT * FROM `users` WHERE `role` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array("user"))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        return $stmt;
    }

    // get items in cart
    protected function getCart()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `cart` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        return $stmt->fetchAll();
    }

    // get location and rate the delivery fee
    protected function getdeliveryfee()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT
                    `distance_km`
                FROM
                    `location`
                INNER JOIN `customers` ON `location`.`city_municipal` = `customers`.`city_municipal`
                WHERE
                    `customers`.`username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        return $stmt->fetchAll()[0]['distance_km'];
    }

    // get row value of location: distance_km
    protected function getValuedeliveryfee()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT
                    `distance_km`
                FROM
                    `location`
                INNER JOIN `customers` ON `location`.`city_municipal` = `customers`.`city_municipal`
                WHERE
                    `customers`.`username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        return $stmt->rowcount();
    }

    // sum cart_price
    protected function sumCart()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT
                    `cart_price`
                FROM
                    `cart`
                WHERE
                    `username` = '" . $_SESSION['user_id'] . "'";

        $stmt = $this->connect()->query($sql);

        if (!$stmt) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        $sum = $stmt->fetchAll();

        return $sum;
    }

    // ###########################################################################################
    // DELIVERY OPTIONS

    // get shipping delivery -> TO PAY
    protected function getShippingDetailPay()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `delivery` WHERE `username` = ? AND `delivery_status` = 'to_pay' ORDER BY `delivery_id`";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $getShipping = false;
        }

        $getShipping = $stmt->fetchAll();

        return $getShipping;
    }

    // count shipping delivery -> TO PAY
    protected function countShippingDetailPay()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `delivery` WHERE `username` = ? AND `delivery_status` = 'to_pay' ORDER BY `delivery_id`";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowcount() == 0) {
            $countShipping = false;
        } else {
            $countShipping = true;
        }

        return $countShipping;
    }

    // get shipping delivery -> TO SHIP
    protected function getShippingDetailShip()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `delivery` WHERE `username` = ? AND `delivery_status` = 'to_ship' ORDER BY `delivery_id`";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $getShipping = false;
        }

        $getShipping = $stmt->fetchAll();

        return $getShipping;
    }

    // count shipping delivery -> TO SHIP
    protected function countShippingDetailShip()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `delivery` WHERE `username` = ? AND `delivery_status` = 'to_ship' ORDER BY `delivery_id`";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowcount() == 0) {
            $countShipping = false;
        } else {
            $countShipping = true;
        }

        return $countShipping;
    }

    // get shipping delivery -> TO RECIEVE
    protected function getShippingDetailRecieve()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `delivery` WHERE `username` = ? AND `delivery_status` = 'to_recieve' ORDER BY `delivery_id`";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $getShipping = false;
        }

        $getShipping = $stmt->fetchAll();

        return $getShipping;
    }

    // count shipping delivery -> TO RECIEVE
    protected function countShippingDetailRecieve()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `delivery` WHERE `username` = ? AND `delivery_status` = 'to_recieve' ORDER BY `delivery_id`";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowcount() == 0) {
            $countShipping = false;
        } else {
            $countShipping = true;
        }

        return $countShipping;
    }

    // get shipping delivery -> TO COMPLETE
    protected function getShippingDetailComplete()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "SELECT * FROM `delivery` WHERE `username` = ? AND `delivery_status` = 'to_complete' ORDER BY `delivery_id`";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $getShipping = false;
        }

        $getShipping = $stmt->fetchAll();

        return $getShipping;
    }

    // count shipping delivery -> TO COMPLETE
    protected function countShippingDetailComplete()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }
        
        $sql = "SELECT * FROM `delivery` WHERE `username` = ? AND `delivery_status` = 'to_complete' ORDER BY `delivery_id`";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowcount() == 0) {
            $countShipping = false;
        } else {
            $countShipping = true;
        }

        return $countShipping;
    }

    // count shipping delivery
    protected function getstockNum($product_id)
    {
        $sql = "SELECT `stock_number` FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowcount() == 0) {
            $countShipping = false;
        } 

        $countShipping = $stmt->fetchAll();

        return $countShipping[0]['stock_number'];
    }

    // get stock and exp date number Cart
    protected function getStockstoCart($product_id) {
        $sql = "SELECT * FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($product_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        return $stmt;
    }

    protected function setQtyData($product_id, $qty) {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "UPDATE `cart` SET `quantity` = ? WHERE `product_id` = ? AND `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($qty, $product_id, $_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();

        } else {
            $sql2 = "UPDATE `cart` SET `cart_price` = ? WHERE `product_id` = ? AND `username` = ?";
            $stmt2 = $this->connect()->prepare($sql2);

            $updated_price = $this->getProdPrice($product_id) * $this->getQty($product_id);

            if(!$stmt2->execute(array($updated_price, $product_id, $_SESSION['user_id']))) {
                $stmt2 = null;
                $error = "Statement Failed!";
                header("location: ../index.php?error=" . $error . "");
                exit();
    
            }
        }
    }

    protected function setQtyDataBtn($product_id, $qty) {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        if($this->getQty($product_id) < 2) {
            $sql_delete = "DELETE FROM `cart` WHERE `product_id` = ? AND `username` = ?";
            $stmt_delete = $this->connect()->prepare($sql_delete);

            if(!$stmt_delete->execute(array($product_id, $_SESSION['user_id']))) {
                $stmt = null;
                $error = "Statement Failed!";
                header("location: ../index.php?error=" . $error . "");
                exit();
    
            }
        } else {
            $sql = "UPDATE `cart` SET `quantity` = ? WHERE `product_id` = ? AND `username` = ?";
            $stmt = $this->connect()->prepare($sql);

            $added_qty = $this->getQty($product_id) - $qty;

            if(!$stmt->execute(array($added_qty, $product_id, $_SESSION['user_id']))) {
                $stmt = null;
                $error = "Statement Failed!";
                header("location: ../index.php?error=" . $error . "");
                exit();

            } else {
                $sql2 = "UPDATE `cart` SET `cart_price` = ? WHERE `product_id` = ? AND `username` = ?";
                $stmt2 = $this->connect()->prepare($sql2);

                $updated_price = $this->getProdPrice($product_id) * $this->getQty($product_id);

                if(!$stmt2->execute(array($updated_price, $product_id, $_SESSION['user_id']))) {
                    $stmt2 = null;
                    $error = "Statement Failed!";
                    header("location: ../index.php?error=" . $error . "");
                    exit();
        
                }
            }
        }
    }

    protected function setQtyDataBtn2($product_id, $qty) {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $sql = "UPDATE `cart` SET `quantity` = ? WHERE `product_id` = ? AND `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        $minus_qty = $this->getQty($product_id) + $qty;

        if(!$stmt->execute(array($minus_qty, $product_id, $_SESSION['user_id']))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();

        } else {
            $sql2 = "UPDATE `cart` SET `cart_price` = ? WHERE `product_id` = ? AND `username` = ?";
            $stmt2 = $this->connect()->prepare($sql2);

            $updated_price = $this->getProdPrice($product_id) * $this->getQty($product_id);

            if(!$stmt2->execute(array($updated_price, $product_id, $_SESSION['user_id']))) {
                $stmt2 = null;
                $error = "Statement Failed!";
                header("location: ../index.php?error=" . $error . "");
                exit();
    
            }
        }
    }
}
