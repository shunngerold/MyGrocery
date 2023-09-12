<?php
// check if session is set
if (isset($_SESSION)) {
    session_write_close();
} else {
    session_start();
}
// if the user not logged in return to home page
if (!isset($_SESSION['user_id'])) {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "../head.php"; ?>
    <title>My Purchases | MyGrocery</title>
    <!-- Custom styles for this template -->
    <link href="../assets/css/shop-cart.css" rel="stylesheet">
    <link href="../assets/css/profile_edit.css" rel="stylesheet">
</head>

<body class="body-animate ">
    <!-- error/success message -->
    <?php
    if (isset($_SESSION['error'])) {
        $desc = $_SESSION['error'];
        $stat = "error";
        $btn = "Ok!";
    } elseif (isset($_SESSION['cancel'])) {
        $desc = "Order canceled!";
        $stat = "success";
        $btn = "Aww yiss!";
    } elseif (isset($_SESSION['buy_again'])) {
        $desc = "Order Successfully!";
        $stat = "success";
        $btn = "Aww yiss!";
    }
    ?>
    <script>
        swal({
        title: "<?php echo $desc; ?>",
        text: "",
        icon: "<?php echo $stat; ?>",
        button: "<?php echo $btn; ?>",
        });
    </script>
    <!-- unset message -->
    <?php 
        unset($_SESSION['error']);
        unset($_SESSION['cancel']);
        unset($_SESSION['buy_again']);
    ?>

    <!-- Account page navigation-->
    <?php include_once "./navigator_profile.php"; ?>
    <main class="mb-5">
        <div class="container px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-light p-5">
                        <?php 
                            // include autoload file - minimizing the include/require syntaxes for class files
                            include_once('../includes/auto_load.inc.php'); 

                            // Display delivery 
                            $delivery = new CartView();

                            // - to pay
                            if(!$delivery->showDeliveryPay()) {
                                $result_pay = false;
                            } else {
                                $result_pay = $delivery->showDeliveryPay();
                            }
                            // - to ship
                            if(!$delivery->showDeliveryShip()) {
                                $result_ship = false;
                            } else {
                                $result_ship = $delivery->showDeliveryShip();
                            }
                            // - to recieve
                            if(!$delivery->showDeliveryRecieve()) {
                                $result_recieve = false;
                            } else {
                                $result_recieve = $delivery->showDeliveryRecieve();
                            }
                            // - to complete
                            if(!$delivery->showDeliveryComplete()) {
                                $result_complete = false;
                            } else {
                                $result_complete = $delivery->showDeliveryComplete();
                            }
                        ?>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pay-tab" data-bs-toggle="tab" href="#pay" role="tab"
                                    aria-controls="pay" aria-selected="true" style="font-weight: bold;">
                                    <i class="bi bi-wallet2" style="font-size: 1.8rem;"></i> To Pay
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ship-tab" data-bs-toggle="tab" href="#ship" role="tab"
                                    aria-controls="ship" aria-selected="true" style="font-weight: bold;">
                                    <i class="bi bi-box-seam" style="font-size: 1.8rem;"></i> To Ship
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="recieve-tab" data-bs-toggle="tab" href="#recieve" role="tab"
                                    aria-controls="receive" aria-selected="true" style="font-weight: bold;">
                                    <i class="bi bi-truck" style="font-size: 1.8rem;"></i> To Receive
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="recieve-tab" data-bs-toggle="tab" href="#complete" role="tab"
                                    aria-controls="receive" aria-selected="true" style="font-weight: bold;">
                                    <i class="bi bi-check-circle" style="font-size: 1.8rem;"></i> Completed
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="recieve-tab" data-bs-toggle="tab" href="#cancel" role="tab"
                                    aria-controls="receive" aria-selected="true" style="font-weight: bold;">
                                    <i class="bi bi-x-octagon" style="font-size: 1.8rem;"></i> Cancelled
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="pay" role="tabpanel" aria-labelledby="pay-tab">
                                <!-- TO PAY -->
                                <?php
                                    if(!$result_pay == false) {
                                ?>
                                <table>
                                    <tr id="table-desc">
                                        <th style="text-align: center">DELIVERY ID</th>
                                        <th style="text-align: center">ACTIONS</th>
                                        <th style="text-align: center">DATE ORDERED</th>
                                        <th style="text-align: center">PRICE</th>
                                    </tr>
                                        <?php 
                                            foreach($result_pay as $row) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center">
                                                            <div class="cart-info">
                                                                <div class="col-md-12">
                                                                    <div class="col-md-12">
                                                                        <p class="text-danger mt-2">
                                                                            Note: This order will move to "To
                                                                            Ship" after one hour.
                                                                        </p>
                                                                    </div>
                                                                    <h1 class='mt-6' style="font-size: 25px;">
                                                                        <b><?php echo $row['delivery_id'];  ?></b>
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12 mt-2">
                                                                <!-- modal button: view details -->
                                                                <button name="view" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mt-2 form-control button-view">
                                                                    View
                                                                </button>
                                                                <button name="cancel" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mt-2 form-control button-cancel">
                                                                    Cancel Order
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <div class="col-md-12">
                                                                <p class="text fw-bold mt-2 align-center"><?php echo $row['order_date'];  ?></p>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php echo "₱ " . $row['total_price'];  ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                            } 
                                        } else {
                                            echo "<h1 class='mt-5'>" . "NO ORDERS YET" . "</h1>";
                                        }
                                    ?>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="ship" role="tabpanel" aria-labelledby="ship-tab">
                                <!-- TO SHIP -->
                                <?php
                                    if(!$result_ship == false) {
                                ?>
                                <table>
                                    <tr id="table-desc">
                                        <th style="text-align: center">DELIVERY ID</th>
                                        <th style="text-align: center">ACTIONS</th>
                                        <th style="text-align: center">DATE ORDERED</th>
                                        <th style="text-align: center">PRICE</th>
                                    </tr>
                                        <?php 
                                            foreach($result_ship as $row) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center">
                                                            <div class="cart-info">
                                                                <div class="col-md-12">
                                                                    <h1 class='mt-6' style="font-size: 25px;">
                                                                        <b><?php echo $row['delivery_id'];  ?></b>
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12 mt-2">
                                                                <!-- modal button: view details -->
                                                                <button name="view" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mt-2 form-control button-view">
                                                                    View
                                                                </button>
                                                                <button name="cancel" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mt-2 form-control button-cancel">
                                                                    Cancel Order
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <div class="col-md-12">
                                                                <p class="text fw-bold mt-2 align-center"><?php echo $row['order_date'];  ?></p>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php echo "₱ " . $row['total_price'];  ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                            } 
                                        } else {
                                            echo "<h1 class='mt-5'>" . "NO ORDERS YET" . "</h1>";
                                        }
                                    ?>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="recieve" role="tabpanel" aria-labelledby="recieve-tab">
                                <!-- TO RECIEVE -->
                                <?php
                                    if(!$result_recieve == false) {
                                ?>
                                <table>
                                    <tr id="table-desc">
                                        <th style="text-align: center">DELIVERY ID</th>
                                        <th style="text-align: center">ACTIONS</th>
                                        <th style="text-align: center">DATE ORDERED</th>
                                        <th style="text-align: center">PRICE</th>
                                    </tr>
                                        <?php 
                                            foreach($result_recieve as $row) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center">
                                                            <div class="cart-info">
                                                                <div class="col-md-12">
                                                                    <h1 class='mt-6' style="font-size: 25px;">
                                                                        <b><?php echo $row['delivery_id'];  ?></b>
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12 mt-2">
                                                                <!-- modal button: view details -->
                                                                <button name="view" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mt-2 form-control button-view">
                                                                    View
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <div class="col-md-12">
                                                                <p class="text fw-bold mt-2 align-center"><?php echo $row['order_date'];  ?></p>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php echo "₱ " . $row['total_price'];  ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                            } 
                                        } else {
                                            echo "<h1 class='mt-5'>" . "NO ORDERS YET" . "</h1>";
                                        }
                                    ?>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="recieve-tab">
                                <!-- COMPLETED -->
                                <?php
                                    if(!$result_complete == false) {
                                ?>
                                <table>
                                    <tr id="table-desc">
                                        <th style="text-align: center">DELIVERY ID</th>
                                        <th style="text-align: center">ACTIONS</th>
                                        <th style="text-align: center">DATE ORDERED</th>
                                        <th style="text-align: center">PRICE</th>
                                    </tr>
                                        <?php 
                                            foreach($result_complete as $row) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center">
                                                            <div class="cart-info">
                                                                <div class="col-md-12">
                                                                    <h1 class='mt-6' style="font-size: 25px;">
                                                                        <b><?php echo $row['delivery_id'];  ?></b>
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12 mt-2">
                                                                <!-- modal button: view details -->
                                                                <button name="view" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mt-2 form-control button-view">
                                                                    View
                                                                </button>
                                                                <button name="buyAgain" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mb-2 mt-2 form-control buy-complete">
                                                                    Buy again
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <div class="col-md-12">
                                                                <p class="text fw-bold mt-2 align-center"><?php echo $row['order_date'];  ?></p>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <?php echo "₱ " . $row['total_price'];  ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                            } 
                                        } else {
                                            echo "<h1 class='mt-5'>" . "NO ORDERS YET" . "</h1>";
                                        }
                                    ?>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="recieve-tab">
                                <!-- CANCELED -->
                                <?php 
                                    $canceled_order = new CheckoutView();
                                    $cancel = $canceled_order->viewCanceledOrders();
                                
                                    if(!$cancel == false) {
                                ?>
                                <table style="width:100%">
                                    <tr id="table-desc">
                                        <th style="width:20%; text-align: center;">PRIMARY ID</th>
                                        <th style="width:15%; text-align: center;">DELIVERY ID</th>
                                        <th style="width:25%; text-align: center;">ACTIONS</th>
                                        <th style="width:20%; text-align: center;">REASON</th>
                                        <th style="width:20%; text-align: center;">DATE CANCELED</th>
                                    </tr>
                                        <?php 
                                            foreach($cancel as $row) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <div class="cart-info">
                                                                <div class="col-md-12">
                                                                    <h1 class='mt-6' style="font-size: 25px;">
                                                                        <b><?php echo $row['cancel_id'];  ?></b>
                                                                    </h1>
                                                                </div>
                                                                <span class="border border-secondary"></span>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div class="cart-info">
                                                                <div class="col-md-12">
                                                                    <h1 class='mt-6' style="font-size: 25px;">
                                                                        <b><?php echo $row['delivery_id'];  ?></b>
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div class="col-md-12 mt-2">
                                                                <!-- modal button: view details -->
                                                                <button name="view" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mt-2 form-control button-view">
                                                                    View
                                                                </button>
                                                                <button name="buyAgain" id="<?php echo $row['delivery_id']; ?>" class="btn btn-outline-success mb-2 mt-2 form-control buy-again">
                                                                    Buy again
                                                                </button>
                                                                <span class="text-danger">Note: This order will be automatically deleted</span>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div class="col-md-12">
                                                                <p class="text fw-bold mt-2 align-center"><?php echo $row['reason'];  ?></p>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div class="col-md-12">
                                                                <p class="text fw-bold mt-2 align-center"><?php echo $row['date_canceled'];  ?></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                            } 
                                        } else {
                                            echo "<h1 class='mt-5'>" . "NO ORDERS YET" . "</h1>";
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- POP-UP CANCEL ORDER MODAL -->
    <div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #ECF87F;">
            <div class="modal-header">
                <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                <h5 class="modal-title" id="cancelModalLabel">Cancel Order | MyGrocery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- border head -->
            <span class="border border-secondary"></span>
            <div class="modal-body">
                <form id="form-cancel" action="../includes/c_checkout.inc.php" method="post">
                    <p class="lead mt-2">Are you sure you want to cancel this Order? Why?</p>
                    <!-- Delivery ID -->
                    <input type="hidden" name="delivery-id" id="delivery-id">
                    <!-- Radio Buttons -->
                    <div class="input-group mt-3">
                        <div class="input-group-text">
                            <input type="radio" name="radio" value="Need to change delivery address" required>
                        </div>
                        <input type="text" class="form-control" placeholder="Need to change delivery address" readonly required autofocus>
                    </div>
                    <div class="input-group mt-3">
                        <div class="input-group-text">
                            <input type="radio" name="radio" value="Need to modify order (Quantity)" required>
                        </div>
                        <input type="text" class="form-control" placeholder="Need to modify order (Quantity)" readonly required autofocus>
                    </div>
                    <div class="input-group mt-3">
                        <div class="input-group-text">
                            <input type="radio" name="radio" value="Found cheaper elsewhere" required>
                        </div>
                        <input type="text" class="form-control" placeholder="Found cheaper elsewhere" readonly required autofocus>
                    </div>
                    <div class="input-group mt-3">
                        <div class="input-group-text">
                            <input type="radio" name="radio" value="Don't want to buy anymore" required>
                        </div>
                        <input type="text" class="form-control" placeholder="Don't want to buy anymore" readonly required autofocus>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn text-light" style="background-color: #3D550C;" data-bs-dismiss="modal">Continue Shopping</button>
                <button form="form-cancel" name="cancel_delivery" type="submit" class="btn btn-danger">Yes, I want to cancel my order!</button>
            </div>
            </div>
        </div>
    </div>
    <!-- POP-UP VIEW DETAILS MODAL -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="viewdetailModal" tabindex="-1"
    aria-labelledby="viewdetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #ECF87F;">
                <div class="modal-header">
                    <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                    <h5 class="modal-title" id="viewdetailModalLabel">View Details | MyGrocery
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- border head -->
                <span class="border border-secondary"></span>
                <div class="modal-body">
                    <div class="col-md-12 order-md-6 mb-4 align-items-center">
                        <!-- delivery id -->
                        <input type="hidden" name="delivery-id-view" id="delivery-id-view">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Items Listed</span>
                            <span class="badge badge-secondary badge-pill"></span>
                        </h4>
                        <ul id="delivery-detail" class="list-group mb-3" style="height: 20rem; overflow-y: scroll;">
                            <!-- SHOW DELIVERY ITEMS -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BUY AGAIN MODAL -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="buyAgainModal" tabindex="-1"
    aria-labelledby="buyAgainModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #ECF87F;">
                <div class="modal-header">
                    <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                    <h5 class="modal-title" id="buyAgainModalLabel">Buy Again | MyGrocery
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- border head -->
                <span class="border border-secondary"></span>
                <div class="modal-body">
                    <div class="col-md-12 order-md-6 mb-4 align-items-center">
                        <!-- delivery id -->
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Item Details</span>
                            <span class="badge badge-secondary badge-pill"></span>
                        </h4>
                        <div id="buyAgain-details" class="mb-3">
                            <!-- BUY AGAIN DETAILS -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="form-buy-again" action="../includes/c_checkout.inc.php" method="post">
                        <input type="hidden" id="buyAgain-id" name="buy_again_id">
                    </form>
                    <button type="button" class="btn text-light" style="background-color: #3D550C;" data-bs-dismiss="modal">Continue Shopping</button>
                    <button type="submit" name="order_again" form="form-buy-again" class="btn btn-success">Yes, I want to buy it again!</button>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- BUY AGAIN MODAL COMPLETE -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="buyAgainModalcomplete" tabindex="-1"
    aria-labelledby="buyAgainModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #ECF87F;">
                <div class="modal-header">
                    <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                    <h5 class="modal-title" id="buyAgainModalLabel">Buy Again | MyGrocery
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- border head -->
                <span class="border border-secondary"></span>
                <div class="modal-body">
                    <div class="col-md-12 order-md-6 mb-4 align-items-center">
                        <!-- delivery id -->
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Item Details</span>
                            <span class="badge badge-secondary badge-pill"></span>
                        </h4>
                        <div id="buyAgain-details-complete" class="mb-3">
                            <!-- BUY AGAIN DETAILS -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="form-buy-again" action="../includes/c_checkout.inc.php" method="post">
                        <input type="hidden" id="buyAgain-id" name="buy_again_id">
                    </form>
                    <button type="button" class="btn text-light" style="background-color: #3D550C;" data-bs-dismiss="modal">Continue Shopping</button>
                    <button type="submit" name="order_again_complete" form="form-buy-again" class="btn btn-success">Yes, I want to buy it again!</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('purchases').classList.add('active');

    $(document).ready(function () {
        // Cancel Order
        $(document).on("click", ".button-cancel", function() {
            var delivery_id = $(this).attr("id");
            document.getElementById("delivery-id").value = delivery_id;
            $("#cancelModal").modal("show");
        });
        // View Order
        $(document).on('click', '.button-view', function(){  
           var delivery_id = $(this).attr("id");  
           if(delivery_id != '')  
           {  
                $.ajax({  
                    url:"../includes/c_checkout.inc.php",  
                    method:"POST",  
                    data:{delivery_id:delivery_id},  
                    success:function(data){  
                        $('#delivery-detail').html(data);  
                        $('#viewdetailModal').modal('show'); 
                    }  
                });  
           }            
        });  
        // Buy Again  
        $(document).on("click", ".buy-again", function() {
            var buy_again = $(this).attr("id");
            if(buy_again != '')  
            {  
                $.ajax({  
                    url:"../includes/c_checkout.inc.php",  
                    method:"POST",  
                    data:{buy_again:buy_again},  
                    success:function(data){ 
                        document.getElementById("buyAgain-id").value = buy_again; 
                        $('#buyAgain-details').html(data);  
                        $("#buyAgainModal").modal("show"); 
                    }  
                });  
            }       
        });
        // Buy Again  
        $(document).on("click", ".buy-complete", function() {
            var buy_complete = $(this).attr("id");
            if(buy_complete != '')  
            {  
                $.ajax({  
                    url:"../includes/c_checkout.inc.php",  
                    method:"POST",  
                    data:{buy_complete:buy_complete},  
                    success:function(data){ 
                        document.getElementById("buyAgain-id").value = buy_complete; 
                        $('#buyAgain-details-complete').html(data);  
                        $("#buyAgainModalcomplete").modal("show"); 
                    }  
                });  
            }       
        });
    });
</script>
</html>