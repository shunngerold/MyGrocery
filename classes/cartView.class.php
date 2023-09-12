<?php

class CartView extends Cart {
    // view cart number
    public function cartNum() {
        if(isset($_SESSION['user_id'])) {
            if($this->countCart() == false) {
                return 0;
            } else {
                return $this->countCart();
            }

        } else {
            return 0;
        }
    }

    // view notification
    public function viewgetNotif() {
        if(isset($_SESSION['user_id'])) {
            return $this->getNotif();
        } else {
            return 0;
        }
    }

    // view users -> Admin side
    public function viewgetUsers() {
        if($this->getUsers()->rowCount() == 0) {
            return null;
        } else {
            return $this->getUsers();
        }
    }

    // view cart items
    public function cartView() {
        $cart = $this->getCart();

        ?>
<table>
    <tr id="table-desc">
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>

    <?php 
    if($this->countCart() == false) {
        ?>
    <tr>
        <td>
            <br><br>
            <h1>NO ITEMS IN YOUR CART</h1>
            <br><br>
        </td>
    </tr>
    <?php
    } else {
        
        foreach($cart as $cart_items) {
            ?>
                <tr>
                    <td>
                        <?php
                        if($this->getstockNum($cart_items['product_id']) == 0)
                        {
                            ?>
                        <div class="cart-info">
                            <img src="<?php echo $cart_items['product_image']; ?>">
                            <div>
                                <a href="./items.php?product_id=<?php echo $cart_items['product_title']; ?>">
                                    <?php echo ucwords($cart_items['product_title']); ?>
                                </a>
                                </br>
                                <dd><?php echo "Product Available Stock(s): "  ?></dd>
                                <p class="fw-normal text-danger">No longer available</p>
                                <small> Price: <?php echo "₱ ".$cart_items['product_price']; ?></small>
                                <br />
                                <a href="./includes/c_removeCart.inc.php?id=<?php echo $cart_items['product_id']; ?>">
                                    Remove Item
                                </a>
                            </div>
                        </div>
                        <?php
                        } else {
                        ?>
                        <div class="cart-info">
                            <img src="<?php echo $cart_items['product_image']; ?>">
                            <div>
                                <a style="font-size: large;" class="fw-bolder text-dark" href="./items.php?product_id=<?php echo $cart_items['product_id']; ?>">
                                    <?php echo ucwords($cart_items['product_title']); ?>
                                </a>
                                <dd class="mt-2"><?php echo "Available Stock(s): ". $this->getStockstoCart($cart_items['product_id'])->fetchAll()[0]['stock_number'];  ?></dd>
                                <dd class="mt-2"><?php echo "Expiration date: ". $this->getStockstoCart($cart_items['product_id'])->fetchAll()[0]['expiry_date'];  ?></dd>
                                <small> Price: <?php echo "₱ ".$cart_items['product_price']; ?></small>
                                <br />
                                <a href="./includes/c_removeCart.inc.php?id=<?php echo $cart_items['product_id']; ?>">
                                    Remove Item
                                </a>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                    </td>
                    <td>
                        <form id="form-cart" action="">
                            <div class="input-group" style="width: 150px">
                                <!-- Minus button -->
                                <a href="./includes/c_addCart.inc.php?product_id=<?php echo $cart_items['product_id']; ?>&qty=1" class="btn btn-outline-success">
                                    <i class="bi-dash-circle"></i>
                                </a>
                                <!-- Input box -->
                                <input type="number" name="qty" id="qty" class="form-control" style="height: 40px;" min="0" max="150" value="<?php echo $cart_items['quantity']; ?>"/>
                                <input type="hidden" name="prod_id" id="prod_id" value="<?php echo $cart_items['product_id']; ?>">
                                <!-- Plus button -->
                                <a href="./includes/c_addCart.inc.php?product_idp=<?php echo $cart_items['product_id']; ?>&qty=1" class="btn btn-outline-success">
                                    <i class="bi-plus-circle"></i>
                                </a>
                            </div>
                        </form>
                    </td>
                    <td>₱<?php echo $cart_items['cart_price']; ?></td>
                </tr>
            <?php
            }
        }
    ?>

</table>
<?php
    }

    // view cart items (checkout)
    public function itemsInCart() {
        // check if session is set
        if(isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        $cart = $this->getCart();
        ?>
<div class="col-md-4 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Items inside the cart</span>
        <span class="badge badge-secondary badge-pill">3</span>
    </h4>
    <ul class="list-group mb-3" style="height: 26rem; overflow-y: scroll;">
        <?php 
                        foreach($cart as $cart_items) {
                            if(!$this->getstockNum($cart_items['product_id']) == 0){
                                ?>
        <li class="list-group-item d-flex lh-condensed">
            <a href="<?php echo $cart; ?>" class="btn position-relative">
                <img src="<?php echo $cart_items['product_image']; ?>" width="30" height="30">
                <span class="position-absolute mt-3 top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $cart_items['quantity']; ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>
            <div class="container">
                <h6 class="my-0"><?php echo ucwords($cart_items['product_title']); ?></h6>
                <p class="text-muted"> Price: <?php echo "₱ ".$cart_items['product_price']; ?></p>
            </div>
            <div class="justify-content-end">
                <span style="margin-right: 10px;"
                    class="text-muted">₱<?php echo ''. $cart_items['cart_price']; ?></span>
            </div>
        </li>
        <?php 
                            }
                        }
                    ?>
    </ul>

    <li class="list-group-item d-flex justify-content-between">
        <strong>Subtotal :</strong>
        <strong>₱<?php echo $this->sum_num_cart(); ?></strong>
    </li>
    <li class="list-group-item d-flex justify-content-between">
        <strong>Delivery Fee :</strong>
        <strong>₱<?php echo $this->showdeliveryfee(); ?></strong>
    </li>
    <li class="list-group-item d-flex justify-content-between">
        <strong>Total :</strong>
        <strong>₱<?php echo $this->total_sum(); ?></strong>
    </li>
</div>
<?php
    }

    // sum of products in your cart
    public function sum_num_cart() {
        $sum = $this->sumCart();

        $val = 0;
        foreach($sum as $var) {
            $val += $var['cart_price'];
        }

        return $val;
    }

    public function countValueKM_deliveryfee() {
        $count = $this->getValuedeliveryfee();

        return $count;
    }

    // get kilometers
    public function showKM() {
        $showdeliveryfee = $this->getdeliveryfee();

        return $showdeliveryfee;
    }

    // get delivery fee
    public function showdeliveryfee() {
        $showdeliveryfee = $this->getdeliveryfee();

        // equals to 0km
        if($showdeliveryfee == 0) {
            $deliveryFee = 10;

        // equals to 10km - 19km
        } elseif($showdeliveryfee > 10 && $showdeliveryfee < 20) {
            $deliveryFee = 25;

        // equals to 20km - 29km
        } elseif($showdeliveryfee > 20 && $showdeliveryfee < 30) {
            $deliveryFee = 35;

        // equals to 30km - 39km
        } elseif($showdeliveryfee > 30 && $showdeliveryfee < 40) {
            $deliveryFee = 45;

        // greater than 40
        } elseif($showdeliveryfee > 40) {
            $deliveryFee = 55;

        } 
        
        return $deliveryFee;
    }

    // total sum including delivery fee
    public function total_sum() {
        $sub_total = $this->sum_num_cart();
        $delivery = $this->showdeliveryfee();

        $total = $sub_total + $delivery;

        return $total;
    }

    // show delivery - to pay
    public function showDeliveryPay() {
        
        if(!$this->getShippingDetailPay()) {
            $ID = false;
        } else {
            $ID = $this->getShippingDetailPay();
        }

        if(!$this->countShippingDetailPay()) {
            $result = false;
        } else {
            $result = $ID;
        }

        return $result;
    }

    // show delivery - to ship
    public function showDeliveryShip() {
        
        if(!$this->getShippingDetailShip()) {
            $ID = false;
        } else {
            $ID = $this->getShippingDetailShip();
        }

        if(!$this->countShippingDetailShip()) {
            $result = false;
        } else {
            $result = $ID;
        }

        return $result;
    }

    // show delivery - to recieve
    public function showDeliveryRecieve() {
        
        if(!$this->getShippingDetailRecieve()) {
            $ID = false;
        } else {
            $ID = $this->getShippingDetailRecieve();
        }

        if(!$this->countShippingDetailRecieve()) {
            $result = false;
        } else {
            $result = $ID;
        }

        return $result;
    }

    // show delivery - completed
    public function showDeliveryComplete() {
        
        if(!$this->getShippingDetailComplete()) {
            $ID = false;
        } else {
            $ID = $this->getShippingDetailComplete();
        }

        if(!$this->countShippingDetailComplete()) {
            $result = false;
        } else {
            $result = $ID;
        }

        return $result;
    }
}