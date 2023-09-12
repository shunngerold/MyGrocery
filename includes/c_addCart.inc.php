<?php

// include mysqli database
include_once "mysqli_db.inc.php";
// include autoload file - minimizing the include/require syntaxes for class files
include_once('./auto_load.inc.php');

if (isset($_POST['add-cart'])) {
    // Setting Variables With Escape String
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);

    // Instantiate AddCartCtrl Class
    $cart = new CartCtrl($product_id, $qty);

    // Running error handlers and AddCart
    $cart->addCart();
    
} elseif(isset($_POST['buy-now'])) {
    // Setting Variables With Escape String
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);

    // Instantiate AddCartCtrl Class
    $cart = new CartCtrl($product_id, $qty);

    // Running error handlers and AddCart
    $cart->addCart();

    header("location: ../checkout.php");

} elseif(isset($_POST['search'])) {
    // Setting Variables With Escape String
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $product_id = mysqli_real_escape_string($conn, $_POST['prod_id']);

    // Instantiate AddCartCtrl Class
    $cart = new CartCtrl($product_id, $qty);

    // Running error handlers and AddCart
    $cart->updateQty();

// if set minus / plus button
} elseif(isset($_GET['product_id'])) {
    // grab the GET data
    $qty = mysqli_real_escape_string($conn, $_GET['qty']);
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);

    // Instantiate AddCartCtrl Class
    $cart = new CartCtrl($product_id, $qty);

    // Running error handlers and AddCart
    $cart->updateQtyBtn();

    echo "<script> window.history.go(-1); </script>";

} elseif(isset($_GET['product_idp'])) {
    // grab the GET data
    $qty = mysqli_real_escape_string($conn, $_GET['qty']);
    $product_id = mysqli_real_escape_string($conn, $_GET['product_idp']);

    // Instantiate AddCartCtrl Class
    $cart = new CartCtrl($product_id, $qty);

    // Running error handlers and AddCart
    $cart->updateQtyBtn2();

    echo "<script> window.history.go(-1); </script>";
}