<?php

// check if session is set
if (isset($_SESSION)) {
    session_write_close();
} else {
    session_start();
}

include_once "mysqli_db.inc.php";
// include autoload file - minimizing the include/require syntaxes for class files
include_once('./auto_load.inc.php');

if (isset($_POST['confirm_pay'])) {
    // Get payment info
    $payment = new CartView();
    $_SESSION['sum_cart'] = $payment->sum_num_cart();
    $_SESSION['delivery_fee'] = $payment->showdeliveryfee();
    $_SESSION['total'] = $payment->total_sum();

    // Instantiate CheckoutCtrl Class
    $checkout = new CheckoutCtrl();

    // Running error handlers and checkout
    $checkout->checkout();
    
} elseif(isset($_POST['cancel_delivery'])) {
    // get data
    $delivery_id = mysqli_escape_string($conn, $_POST['delivery-id']);
    $radio = mysqli_escape_string($conn, $_POST['radio']);

    // Instantiate CheckoutCtrl Class
    $checkout = new CheckoutCtrl();

    // Running error handlers and checkout
    $checkout->CancelCheckout($delivery_id, $radio);

} elseif(isset($_POST['delivery_id'])) {
    // get data
    $delivery_id = mysqli_escape_string($conn, $_POST['delivery_id']);

    // Instantiate CheckoutCtrl Class
    $checkout = new CheckoutView();

    // Running error handlers and checkout
    $checkout->ViewCheckout($delivery_id);

} elseif(isset($_POST['buy_again'])) {
    // get data
    $Buy_id = mysqli_escape_string($conn, $_POST['buy_again']);

    // Instantiate CheckoutCtrl Class
    $checkout = new CheckoutView();

    $checkout->ViewBuyAgain($Buy_id);

} elseif(isset($_POST['order_again'])) {
    // get data
    $Buy_id = mysqli_escape_string($conn, $_POST['buy_again_id']);

    // Instantiate CheckoutCtrl Class
    $checkout = new CheckoutCtrl();

    // Running error handlers and checkout
    $checkout->BuyAgain($Buy_id);

} elseif(isset($_POST['buy_complete'])) {
    // get data
    $Buy_id = mysqli_escape_string($conn, $_POST['buy_complete']);

    // Instantiate CheckoutCtrl Class
    $checkout = new CheckoutView();

    $checkout->ViewBuyAgainComplete($Buy_id);

} elseif(isset($_POST['order_again_complete'])) {
    // get data
    $Buy_id = mysqli_escape_string($conn, $_POST['buy_again_id']);

    // Instantiate CheckoutCtrl Class
    $checkout = new CheckoutCtrl();

    // Running error handlers and checkout
    $checkout->BuyAgainComplete($Buy_id);
}
