<?php 

// check if session is set
if(isset($_SESSION)) {
    session_write_close();
} else {
    session_start();
}

class Checkout extends DbHandler {
    // insert all of data in delivery table
    protected function setDeliveryInfo() {
        // check column 'delivery_id' 
        $check = "SELECT * FROM `delivery` ORDER BY `delivery_id` DESC LIMIT 1";
        $stmt_check = $this->connect()->query($check);

        if($stmt_check->rowcount() > 0) {
            // FetchAll stmt_check
            $row = $stmt_check->fetchAll();
            // Generate cart number
            $uid = $row[0]['delivery_id']; // Declaring variable for delivery_id
            // get number in existing id
            $get_numbers = str_replace("SHP","",$uid);
            // Auto Increament for custom delivery_id = SHP-01 + 1 
            $id_increase = $get_numbers + 1; 
            // Setting format of a custom delivery_id = SHP0001
            $get_string = str_pad($id_increase, 4, 0, STR_PAD_LEFT);
            // Variable for custom id
            $delivery_id = "SHP" . $get_string;
            
            // * Statement 1: Delivery Table
            $sql = "INSERT INTO 
                    `delivery` (`delivery_id`,
                                `cart_number`, 
                                `username`,
                                `full_address`, 
                                `postal`, 
                                `sub_total`, 
                                `delivery_fee`, 
                                `total_price`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
            $stmt = $this->connect()->prepare($sql);

            // Full address
            $full_address = $this->getUserInfo()[0]['street'] . ', ' . 
                            $this->getUserInfo()[0]['city_municipal'] . ', ' .
                            $this->getUserInfo()[0]['province'];

            if($stmt->execute(array($delivery_id, 
                                    $this->getUserInfo()[0]['cart_number'], 
                                    $this->getUserInfo()[0]['username'], 
                                    $full_address,
                                    $this->getUserInfo()[0]['postal'], 
                                    $_SESSION['sum_cart'], 
                                    $_SESSION['delivery_fee'], 
                                    $_SESSION['total']))) {

                // Get all items in cart
                foreach($this->getCartItems() as $cartItems) {
                    // Stock Validation ----------------------------->
                    if(!$this->getProductStock($cartItems['product_id']) <= 0) {
                        // * Statement 2: Update Stocks
                        $sql2 = "UPDATE `product` SET `stock_number` = ? WHERE `product_id` = ?";
                        $stmt2 = $this->connect()->prepare($sql2);
                        
                        $updated_stock = $this->getProductStock($cartItems['product_id']) - $cartItems['quantity'];

                        if(!$stmt2->execute(array($updated_stock, $cartItems['product_id']))) {
                            $stmt2 = null;
                            $err = "Database Error: Update Stocks";
                            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                            exit();

                        } else {
                            // * Statement 3: Insert Cart Items to History Table
                            $sql3 = "INSERT INTO `cart_history` (`cart_number`, 
                                                                `username`, 
                                                                `product_id`, 
                                                                `product_image`, 
                                                                `product_title`, 
                                                                `product_price`, 
                                                                `quantity`, 
                                                                `cart_price`, 
                                                                `date_added`, 
                                                                `delivery_id`)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt3 = $this->connect()->prepare($sql3);

                            if(!$stmt3->execute(array($cartItems['cart_number'], 
                                                    $cartItems['username'], 
                                                    $cartItems['product_id'], 
                                                    $cartItems['product_image'], 
                                                    $cartItems['product_title'], 
                                                    $cartItems['product_price'], 
                                                    $cartItems['quantity'], 
                                                    $cartItems['cart_price'], 
                                                    $cartItems['date_added'], 
                                                    $delivery_id))) {
                                $stmt3 = null;
                                $err = "Database Error: Insert Cart History";
                                header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                                exit();

                            } else {
                                // * Statement 4: Delete Cart Items
                                $sql4 = "DELETE FROM `cart` WHERE `cart_id` = ?";
                                $stmt4 = $this->connect()->prepare($sql4);

                                if(!$stmt4->execute(array($cartItems['cart_id']))) {
                                    $stmt4 = null;
                                    $err = "Database Error: Delete Cart Items";
                                    header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                                    exit();
                                }
                            }
                        }
                    }
                }
            } else {
                $stmt = null;
                $err = "Database Error: Delivery Table";
                header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                exit();
            }  
        
        // If database is = null
        } else {
            $delivery_id = "SHP0001";

            // * Statement 1: Delivery Table
            $sql = "INSERT INTO 
                    `delivery` (`delivery_id`,
                                `cart_number`, 
                                `username`,
                                `full_address`, 
                                `postal`, 
                                `sub_total`, 
                                `delivery_fee`, 
                                `total_price`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
            $stmt = $this->connect()->prepare($sql);

            // Full address
            $full_address = $this->getUserInfo()[0]['street'] . ', ' . 
                            $this->getUserInfo()[0]['city_municipal'] . ', ' .
                            $this->getUserInfo()[0]['province'];

            if($stmt->execute(array($delivery_id, 
                                    $this->getUserInfo()[0]['cart_number'], 
                                    $this->getUserInfo()[0]['username'], 
                                    $full_address,
                                    $this->getUserInfo()[0]['postal'], 
                                    $_SESSION['sum_cart'], 
                                    $_SESSION['delivery_fee'], 
                                    $_SESSION['total']))) {

                // Get all items in cart
                foreach($this->getCartItems() as $cartItems) {
                    // Stock Validation ----------------------------->
                    if(!$this->getProductStock($cartItems['product_id']) <= 0) {
                        // * Statement 2: Update Stocks
                        $sql2 = "UPDATE `product` SET `stock_number` = ? WHERE `product_id` = ?";
                        $stmt2 = $this->connect()->prepare($sql2);
                        
                        $updated_stock = $this->getProductStock($cartItems['product_id']) - $cartItems['quantity'];

                        if(!$stmt2->execute(array($updated_stock, $cartItems['product_id']))) {
                            $stmt2 = null;
                            $err = "Database Error: Update Stocks";
                            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                            exit();

                        } else {
                            // * Statement 3: Insert Cart Items to History Table
                            $sql3 = "INSERT INTO `cart_history` (`cart_number`, 
                                                                `username`, 
                                                                `product_id`, 
                                                                `product_image`, 
                                                                `product_title`, 
                                                                `product_price`, 
                                                                `quantity`, 
                                                                `cart_price`, 
                                                                `date_added`, 
                                                                `delivery_id`)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt3 = $this->connect()->prepare($sql3);

                            if(!$stmt3->execute(array($cartItems['cart_number'], 
                                                    $cartItems['username'], 
                                                    $cartItems['product_id'], 
                                                    $cartItems['product_image'], 
                                                    $cartItems['product_title'], 
                                                    $cartItems['product_price'], 
                                                    $cartItems['quantity'], 
                                                    $cartItems['cart_price'], 
                                                    $cartItems['date_added'], 
                                                    $delivery_id))) {
                                $stmt3 = null;
                                $err = "Database Error: Insert Cart History";
                                header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                                exit();

                            } else {
                                // * Statement 4: Delete Cart Items
                                $sql4 = "DELETE FROM `cart` WHERE `cart_id` = ?";
                                $stmt4 = $this->connect()->prepare($sql4);

                                if(!$stmt4->execute(array($cartItems['cart_id']))) {
                                    $stmt4 = null;
                                    $err = "Database Error: Delete Cart Items";
                                    header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                                    exit();
                                }
                            }
                        }
                    }
                }
            } else {
                $stmt = null;
                $err = "Database Error: Delivery Table";
                header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                exit();
            }  
        }
    } 

    // get user info / data
    protected function getUserInfo() {
        $sql = "SELECT * FROM `customers` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $err = "Database Error!";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        // if the database is = 0
        if($stmt->rowcount() == 0) {
            $stmt = null;
            $err = "Database is Null: Get User Info";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        return $stmt->fetchAll();
    }

    // get cart items
    protected function getCartItems() {
        $sql = "SELECT * FROM `cart` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $err = "Database Error!";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        // if the database is = 0
        if($stmt->rowcount() == 0) {
            $stmt = null;
            $err = "Database is Null: Get Cart Items";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        return $stmt->fetchAll();
    }

    // get cart items
    protected function getProductStock($product_id) {
        $sql = "SELECT `stock_number` FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($product_id))) {
            $stmt = null;
            $err = "Database Error: Get Product Stock";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        // if the database is = 0
        if($stmt->rowcount() == 0) {
            $stmt = null;
            $err = "Database is Null: Get Product Stock";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        return $stmt->fetchAll()[0]['stock_number'];
    }

    // ############################################################################################
    // CANCEL ORDER

    protected function cancelOrder($delivery_id, $radio) {
        // check column 'cancel_id' 
        $check = "SELECT * FROM `canceled_order` ORDER BY `cancel_id` DESC LIMIT 1";
        $stmt_check = $this->connect()->query($check);

        if($stmt_check->rowCount() > 0) {

            // FetchAll stmt_check
            $row = $stmt_check->fetchAll();
            // Generate cart number
            $uid = $row[0]['cancel_id']; // Declaring variable for delivery_id
            // get number in existing id
            $get_numbers = str_replace("CNL","",$uid);
            // Auto Increament for custom delivery_id = SHP-01 + 1 
            $id_increase = $get_numbers + 1; 
            // Setting format of a custom delivery_id = SHP0001
            $get_string = str_pad($id_increase, 4, 0, STR_PAD_LEFT);
            // Variable for custom id
            $cancel_id = "CNL" . $get_string;

            // Statement 1: Insert canceled_order table
            $sql = "INSERT INTO `canceled_order` (`cancel_id`, 
                                                  `delivery_id`, 
                                                  `cart_number`, 
                                                  `username`, 
                                                  `full_address`, 
                                                  `postal`,
                                                  `sub_total`, 
                                                  `delivery_fee`, 
                                                  `total_price`, 
                                                  `reason`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);

            if(!$stmt->execute(array($cancel_id, 
                                     $delivery_id, 
                                     $this->getCartNum($delivery_id)[0]['cart_number'], 
                                     $this->getCartNum($delivery_id)[0]['username'], 
                                     $this->getCartNum($delivery_id)[0]['full_address'], 
                                     $this->getCartNum($delivery_id)[0]['postal'], 
                                     $this->getCartNum($delivery_id)[0]['sub_total'],
                                     $this->getCartNum($delivery_id)[0]['delivery_fee'],
                                     $this->getCartNum($delivery_id)[0]['total_price'],
                                     $radio))) {
                $stmt = null;
                $err = "Database Error: Insert Cancel Order";
                header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                exit();

            } else {
                // Statement 2: Update / Add stocks
                foreach($this->getProductId($delivery_id) as $row) {

                    $updated_stock = $this->getProductStock($row['product_id']) + $row['quantity'];

                    $sql2 = "UPDATE `product` SET `stock_number` = ? WHERE `product_id` = ?";
                    $stmt2 = $this->connect()->prepare($sql2);

                    if(!$stmt2->execute(array($updated_stock, $row['product_id']))) {
                        $stmt2 = null;
                        $err = "Database Error: Cancel Order, Add Stocks";
                        header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                        exit();

                    } else {
                        // Statement 3: Delete delivery
                        $sql3 = "DELETE FROM `delivery` WHERE `delivery_id` = ?";
                        $stmt3 = $this->connect()->prepare($sql3);

                        if(!$stmt3->execute(array($delivery_id))) {
                            $stmt3 = null;
                            $err = "Database Error: Cancel Order, Delete delivery";
                            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                            exit();
                        }
                    }
                }
            }


        // if database is = 0
        } else {
            $cancel_id = "CNL0001";

            // Statement 1: Insert canceled_order table
            $sql = "INSERT INTO `canceled_order` (`cancel_id`, 
                                                  `delivery_id`, 
                                                  `cart_number`, 
                                                  `username`, 
                                                  `full_address`, 
                                                  `postal`,
                                                  `sub_total`, 
                                                  `delivery_fee`, 
                                                  `total_price`, 
                                                  `reason`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);

            if(!$stmt->execute(array($cancel_id, 
                                     $delivery_id, 
                                     $this->getCartNum($delivery_id)[0]['cart_number'], 
                                     $this->getCartNum($delivery_id)[0]['username'], 
                                     $this->getCartNum($delivery_id)[0]['full_address'], 
                                     $this->getCartNum($delivery_id)[0]['postal'], 
                                     $this->getCartNum($delivery_id)[0]['sub_total'],
                                     $this->getCartNum($delivery_id)[0]['delivery_fee'],
                                     $this->getCartNum($delivery_id)[0]['total_price'],
                                     $radio))) {
                $stmt = null;
                $err = "Database Error: Insert Cancel Order";
                header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                exit();

            } else {
                // Statement 2: Update / Add stocks
                foreach($this->getProductId($delivery_id) as $row) {

                    $updated_stock = $this->getProductStock($row['product_id']) + $row['quantity'];

                    $sql2 = "UPDATE `product` SET `stock_number` = ? WHERE `product_id` = ?";
                    $stmt2 = $this->connect()->prepare($sql2);

                    if(!$stmt2->execute(array($updated_stock, $row['product_id']))) {
                        $stmt2 = null;
                        $err = "Database Error: Cancel Order, Add Stocks";
                        header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                        exit();

                    } else {
                        // Statement 3: Delete delivery
                        $sql3 = "DELETE FROM `delivery` WHERE `delivery_id` = ?";
                        $stmt3 = $this->connect()->prepare($sql3);

                        if(!$stmt3->execute(array($delivery_id))) {
                            $stmt3 = null;
                            $err = "Database Error: Cancel Order, Delete delivery";
                            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                            exit();
                        }
                    }
                }
            }
        }   
    }

    // get delivery info
    protected function getCartNum($delivery_id) {
        $sql = "SELECT * FROM `delivery` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($delivery_id))) {
            $stmt = null;
            $err = "Database Error: Get Cart Number (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            $err = "Get Cart Number (Cancel) is null";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        return $stmt->fetchAll();
    }

    // get cart_history
    protected function getProductId($delivery_id) {
        $sql = "SELECT * FROM `cart_history` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($delivery_id))) {
            $stmt = null;
            $err = "Database Error: Get Product ID (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            $err = "Get Product ID (Cancel) is null";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        return $stmt->fetchAll();
    }

    // get ordered items
    protected function getOrderedItems($delivery_id)
    {
        $sql = "SELECT * FROM `cart_history` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($delivery_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowcount() == 0) {
            $stmt = null;
            $error = "Statement Failed null";
            header("location: ../index.php?error=" . $error . "");
            exit();
        } 

        // View delivery Items
        $output = '';
        foreach($stmt->fetchAll() as $row) {
        $image = $row['product_image'];
        $quantity = $row['quantity'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $cart_price = $row['cart_price'];

        $output .= '<li class="list-group-item d-flex lh-condensed">
            <a href="#" class="btn position-relative">
                <img src=".'.$image.'" width="30" height="30">
                <span
                    class="position-absolute mt-3 top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    '.$quantity.'
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>
            <div class="container">
                <h6 class="my-0">'.$product_title.'</h6>
                <p class="text-muted"> Price: ₱ '.$product_price.'</p>
            </div>
            <div class="justify-content-end">
                <span style="margin-right: 10px;"
                    class="text-muted">'.$cart_price.'</span>
            </div>
        </li>';
        }

        // show
        echo $output;
    }

    // get canceled_order
    protected function getCanceledOrder() {
        $sql = "SELECT * FROM `canceled_order` WHERE `username` = ? ORDER BY `cancel_id` DESC";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $err = "Database Error: Get Product ID (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        $result = $stmt->fetchAll();

        return $result;
    }

    // #############################################################################################
    // View buy again details - Canceled
    protected function getbuyagainDetail($Buy_id) {
        // Set Updated price
        $sub = 0;
        // get product Id in each items
        foreach ($this->getItemsBuyagain($Buy_id) as $items) {
            // get price of every items
            foreach($this->getProductIdBuyagain($items['product_id']) as $product_price) {
                $sub_total = $product_price['price'] * $items['quantity'];
                $sub += $sub_total;
                $tots = $sub + $this->getCanceledOrderDetail($Buy_id)[0]['delivery_fee'];

                $sql = "UPDATE `cart_history` SET `product_price` = ?, `cart_price` = ? WHERE `delivery_id` = ? AND `product_id` = ?";
                $stmt = $this->connect()->prepare($sql);

                if(!$stmt->execute(array($product_price['price'], $sub_total, $Buy_id, $items['product_id']))) {
                    $stmt = null;
                    $err = "Database Error: Order Again";
                    header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                    exit();

                } 
            }
        }
        $sql = "SELECT * FROM `cart_history` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($Buy_id))) {
            $stmt = null;
            $err = "Database Error: View Buy Again (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }
        
        $output = "";
        $output .= "<table class='table'>
        <thead>
            <tr>
                <th class='fw-bolder text-dark' scope='col'>Product ID</th>
                <th class='fw-bolder text-dark' scope='col'>Name</th>
                <th class='fw-bolder text-dark' scope='col'>Product Price</th>
                <th style='text-align: center' class='fw-bolder text-dark' scope='col'>Quantity</th>
                <th class='fw-bolder text-dark' scope='col'>Price</th>
            </tr>
        </thead>
        <tbody>";
            foreach($stmt->fetchAll() as $row) {
            $subtots = $row['product_price'] * $row['quantity']; 
            $output .="<tr>
                <td>".$row['product_id']."</td>
                <td>".ucwords($row['product_title'])."</td>
                <td>₱".$row['product_price']."</td>
                <td style='text-align: center'>".$row['quantity']."</td>
                <td>₱".$subtots. "</td>
            </tr>";
            }
        $output .= "<tr>
                    <th style='text-align: right' class='fw-bolder text-dark' colspan='4' scope='col'>DELIVERY FEE:</th>
                    <th class='fw-bolder text-dark' scope='col'>₱".$this->getCanceledOrderDetail($Buy_id)[0]['delivery_fee']."</th>
                </tr>
                <tr>
                    <th style='text-align: right' class='fw-bolder text-dark' colspan='4' scope='col'>TOTAL:</th>
                    <th class='fw-bolder text-dark' scope='col'>₱".$tots."</th>
                </tr>
            </tbody>
        </table>";

        echo $output;
    }

    // #############################################################################################
    // View buy again details - Complete
    protected function getbuyagainCompleteDetail($Buy_id) {
        // Set Updated price
        $sub = 0;
        // get product Id in each items
        foreach ($this->getItemsBuyagain($Buy_id) as $items) {
            // get price of every items
            foreach($this->getProductIdBuyagain($items['product_id']) as $product_price) {
                $sub_total = $product_price['price'] * $items['quantity'];
                $sub += $sub_total;
                $tots = $sub + $this->getCompletedOrder($Buy_id)[0]['delivery_fee'];

                $sql = "UPDATE `cart_history` SET `product_price` = ?, `cart_price` = ? WHERE `delivery_id` = ? AND `product_id` = ?";
                $stmt = $this->connect()->prepare($sql);

                if(!$stmt->execute(array($product_price['price'], $sub_total, $Buy_id, $items['product_id']))) {
                    $stmt = null;
                    $err = "Database Error: Order Again";
                    header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                    exit();

                } 
            }
        }
        $sql = "SELECT * FROM `cart_history` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($Buy_id))) {
            $stmt = null;
            $err = "Database Error: View Buy Again (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }
        
        $output = "";
        $output .= "<table class='table'>
        <thead>
            <tr>
                <th class='fw-bolder text-dark' scope='col'>Product ID</th>
                <th class='fw-bolder text-dark' scope='col'>Name</th>
                <th class='fw-bolder text-dark' scope='col'>Product Price</th>
                <th style='text-align: center' class='fw-bolder text-dark' scope='col'>Quantity</th>
                <th class='fw-bolder text-dark' scope='col'>Price</th>
            </tr>
        </thead>
        <tbody>";
            foreach($stmt->fetchAll() as $row) {
            $subtots = $row['product_price'] * $row['quantity']; 
            $output .="<tr>
                <td>".$row['product_id']."</td>
                <td>".ucwords($row['product_title'])."</td>
                <td>₱".$row['product_price']."</td>
                <td style='text-align: center'>".$row['quantity']."</td>
                <td>₱".$subtots. "</td>
            </tr>";
            }
        $output .= "<tr>
                    <th style='text-align: right' class='fw-bolder text-dark' colspan='4' scope='col'>DELIVERY FEE:</th>
                    <th class='fw-bolder text-dark' scope='col'>₱".$this->getCompletedOrder($Buy_id)[0]['delivery_fee']."</th>
                </tr>
                <tr>
                    <th style='text-align: right' class='fw-bolder text-dark' colspan='4' scope='col'>TOTAL:</th>
                    <th class='fw-bolder text-dark' scope='col'>₱".$tots."</th>
                </tr>
            </tbody>
        </table>";

        echo $output;
    }

    // Get complete orders detail
    protected function getCompletedOrder($Buy_id) {
        $sql = "SELECT * FROM `delivery` WHERE `delivery_id` = ? AND `username` = ? AND `delivery_status` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($Buy_id, $_SESSION['user_id'], "to_complete"))) {
            $stmt = null;
            $err = "Database Error: Get Product ID (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        return $stmt->fetchAll();
    }

    // #############################################################################
    // Order Again - canceled
    protected function setBuyAgain($Buy_id) {
        // check column 'cancel_id' 
        $check = "SELECT * FROM `delivery` ORDER BY `delivery_id` DESC LIMIT 1";
        $stmt_check = $this->connect()->query($check);

        if($stmt_check->rowCount() > 0) {
            // FetchAll stmt_check
            $row = $stmt_check->fetchAll();
            // Generate cart number
            $uid = $row[0]['delivery_id']; // Declaring variable for delivery_id
            // get number in existing id
            $get_numbers = str_replace("SHP","",$uid);
            // Auto Increament for custom delivery_id = SHP-01 + 1 
            $id_increase = $get_numbers + 1; 
            // Setting format of a custom delivery_id = SHP0001
            $get_string = str_pad($id_increase, 4, 0, STR_PAD_LEFT);
            // Variable for custom id
            $delivery_id = "SHP" . $get_string;
            
            // Set Updated price
            $sub = 0;
            // get product Id in each items
            foreach ($this->getItemsBuyagain($Buy_id) as $items) {
                // get price of every items
                foreach($this->getProductIdBuyagain($items['product_id']) as $product_price) {
                    $sub_total = $product_price['price'] * $items['quantity'];
                    $sub += $sub_total;
                    $tots = $sub + $this->getCanceledOrderDetail($Buy_id)[0]['delivery_fee'];

                    $sql = "UPDATE `cart_history` SET `product_price` = ?, `cart_price` = ? WHERE `delivery_id` = ? AND `product_id` = ?";
                    $stmt = $this->connect()->prepare($sql);

                    if(!$stmt->execute(array($product_price['price'], $sub_total, $delivery_id, $items['product_id']))) {
                        $stmt = null;
                        $err = "Database Error: Order Again";
                        header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                        exit();
                    }
                }
            }

            // Statement 1: Insert canceled order to delivery table
            $sql = "INSERT INTO `delivery`(`delivery_id`, 
                                            `cart_number`, 
                                            `username`, 
                                            `full_address`, 
                                            `postal`, 
                                            `sub_total`, 
                                            `delivery_fee`, 
                                            `total_price`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);

            if(!$stmt->execute(array($delivery_id, 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['cart_number'], 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['username'], 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['full_address'], 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['postal'], 
                                     $sub, 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['delivery_fee'], 
                                     $tots))) {
                $stmt = null;
                $err = "Database Error: Order Again";
                header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                exit();
            } else {
                // Statement 2: Delete canceled order
                $sql = "DELETE FROM `canceled_order` WHERE `delivery_id` = ?";
                $stmt = $this->connect()->prepare($sql);

                if(!$stmt->execute(array($Buy_id))) {
                    $stmt = null;
                    $err = "Database Error: Delete Order Again";
                    header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                    exit();

                } else {
                    // Statement 3: Update Cart History
                    $sql = "UPDATE `cart_history` SET `delivery_id` = ? WHERE `delivery_id` = ?";
                    $stmt = $this->connect()->prepare($sql);

                    if(!$stmt->execute(array($delivery_id, $Buy_id))) {
                        $stmt = null;
                        $err = "Database Error: Update Order Again";
                        header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                        exit();
                    }
                }
            }

        } else {
            $delivery_id = "SHP0001";


            // Set Updated price
            $sub = 0;
            // get product Id in each items
            foreach ($this->getItemsBuyagain($Buy_id) as $items) {
                // get price of every items
                foreach($this->getProductIdBuyagain($items['product_id']) as $product_price) {
                    $sub_total = $product_price['price'] * $items['quantity'];
                    $sub += $sub_total;
                    $tots = $sub + $this->getCanceledOrderDetail($Buy_id)[0]['delivery_fee'];
                    

                    $sql = "UPDATE `cart_history` SET `product_price` = ?, `cart_price` = ? WHERE `delivery_id` = ? AND `product_id` = ?";
                    $stmt = $this->connect()->prepare($sql);

                    if(!$stmt->execute(array($product_price['price'], $sub_total, $delivery_id, $items['product_id']))) {
                        $stmt = null;
                        $err = "Database Error: Order Again";
                        header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                        exit();
                    }
                }
            }
              
            // Statement 1: Insert canceled order to delivery table
            $sql = "INSERT INTO `delivery`(`delivery_id`, 
                                            `cart_number`, 
                                            `username`, 
                                            `full_address`, 
                                            `postal`, 
                                            `sub_total`, 
                                            `delivery_fee`, 
                                            `total_price`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);

            if(!$stmt->execute(array($delivery_id, 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['cart_number'], 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['username'], 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['full_address'], 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['postal'], 
                                     $sub, 
                                     $this->getCanceledOrderDetail($Buy_id)[0]['delivery_fee'], 
                                     $tots))) {
                $stmt = null;
                $err = "Database Error: Order Again";
                header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                exit();
            } else {
                // Statement 2: Delete canceled order
                $sql = "DELETE FROM `canceled_order` WHERE `delivery_id` = ?";
                $stmt = $this->connect()->prepare($sql);

                if(!$stmt->execute(array($Buy_id))) {
                    $stmt = null;
                    $err = "Database Error: Delete Order Again";
                    header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                    exit();
                    
                }  else {
                    // Statement 3: Update Cart History
                    $sql = "UPDATE `cart_history` SET `delivery_id` = ? WHERE `delivery_id` = ?";
                    $stmt = $this->connect()->prepare($sql);

                    if(!$stmt->execute(array($delivery_id, $Buy_id))) {
                        $stmt = null;
                        $err = "Database Error: Update Order Again";
                        header('location: ../includes/c_checkout.inc.php?error='.$err.'');
                        exit();
                    }
                }
            }
        }
    }

    // get canceled orders details
    protected function getCanceledOrderDetail($Buy_id) {
        $sql = "SELECT * FROM `canceled_order` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($Buy_id))) {
            $stmt = null;
            $err = "Database Error: Get Product ID (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        return $stmt->fetchAll();
    }

    // get updated product price
    protected function getItemsBuyagain($delivery_id) {
        $sql = "SELECT * FROM `cart_history` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($delivery_id))) {
            $stmt = null;
            $err = "Database Error: Get Items (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
        }

        if($stmt->rowCount() == 0) {
            return false;
        }

        return $stmt->fetchAll();
    }

    // get updated product price
    protected function getProductIdBuyagain($product_id) {
        $sql = "SELECT * FROM `product` WHERE `product_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($product_id))) {
            $stmt = null;
            $err = "Database Error: Get Product Price (Cancel)";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
        }

        if($stmt->rowCount() == 0) {
            return false;
        }

        return $stmt->fetchAll();
    }

    // ##################################################################################
    // Order Again Complete
    protected function SetBuyAgainComplete($delivery_id) {
        $sql = "UPDATE `delivery` SET `delivery_status` = ? WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array("to_pay", $delivery_id))) {
            $stmt = null;
            $err = "Database Error: Complete Order Again";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }
    }

    // ADMIN SIDE
    // ######################################################################################
    // Manage Delivery -> Admin
    protected function getDeliveryDetails($delivery_id) {
        $sql = "SELECT * FROM `delivery` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($delivery_id))) {
            $stmt = null;
            $err = "Database Error: Manage Delivery -> Admin";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }

        echo json_encode($stmt->fetchObject());
    }

    // Set Delivery Status
    protected function setDeliveryStat($delivery_options, $delivery_id) {
        $sql = "UPDATE `delivery` SET `delivery_status` = ? WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($delivery_options, $delivery_id))) {
            $stmt = null;
            $err = "Database Error: Manage Delivery -> Admin";
            header('location: ../includes/c_checkout.inc.php?error='.$err.'');
            exit();
        }
    }

    // View Ordered Items -> Admin
    protected function ViewOrderedItems($delivery_id) {
        $sql = "SELECT * FROM `cart_history` WHERE `delivery_id` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($delivery_id))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../index.php?error=" . $error . "");
            exit();
        }

        if($stmt->rowcount() == 0) {
            $stmt = null;
            $error = "Statement Failed null";
            header("location: ../index.php?error=" . $error . "");
            exit();
        } 

        // View delivery Items
        $output = '';
        foreach($stmt->fetchAll() as $row) {
        $image = $row['product_image'];
        $quantity = $row['quantity'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $cart_price = $row['cart_price'];

        $output .= '<li class="list-group-item d-flex lh-condensed">
            <a href="#" class="btn position-relative">
                <img src=".'.$image.'" width="30" height="30">
                <span
                    class="position-absolute mt-3 top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    '.$quantity.'
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>
            <div class="container">
                <h6 class="my-0">'.$product_title.'</h6>
                <p class="text-muted"> Price: ₱ '.$product_price.'</p>
            </div>
            <div class="justify-content-end">
                <span style="margin-right: 10px;"
                    class="text-muted">'.$cart_price.'</span>
            </div>
        </li>';
        }

        // show
        echo $output;
    }
}