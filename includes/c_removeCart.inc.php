<?php

// include mysqli database
include_once "mysqli_db.inc.php";
// include autoload file - minimizing the include/require syntaxes for class files
include_once('./auto_load.inc.php');

if (isset($_GET['id'])) {
    // Setting Variables With Escape String
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);
    $qty = null;

    // Instantiate AddCartCtrl Class
    $cart = new CartCtrl($product_id, $qty);

    // Running error handlers and AddCart
    $cart->removeCart();

    // back to cart page - error: none
    echo "<script> window.history.go(-1); </script>";
}
