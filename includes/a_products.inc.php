<?php
// check if session is set
if(isset($_SESSION)) {
    session_write_close();
} else {
    session_start();
}

// include mysqli database
include_once "mysqli_db.inc.php";
// include autoload file - minimizing the include/require syntaxes for class files
include_once('./auto_load.inc.php'); 

if (isset($_POST['submit']) && $_FILES['image']) {
    // Setting Variables With Escape String
    $prod_title = mysqli_real_escape_string($conn, $_POST['prod_title']);
    $stock_number = mysqli_real_escape_string($conn, $_POST['stock_number']);
    $exp_date = mysqli_real_escape_string($conn, $_POST['exp_date']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $kilo_pcs_pack = mysqli_real_escape_string($conn, $_POST['kilo_pcs_pack']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['descrip']);

    // image array
    $img_name = $_FILES['image']['name'];
    $img_tmp_name = $_FILES['image']['tmp_name'];
    $img_error = $_FILES['image']['error'];
    $img_size = $_FILES['image']['size'];

    // Instantiate ProductsCtrl Class
    $products = new ProductsCtrl(
        $prod_title,
        $stock_number,
        $exp_date,
        $price, 
        $kilo_pcs_pack,
        $category, 
        $description,
        $img_name,
        $img_tmp_name,
        $img_error,
        $img_size
    );

    // Running error handlers and addProducts
    $products->addProducts();

    // back to home page - error: none
    echo "<script> window.history.go(-1); </script>";
    $_SESSION['added'] = "added";
    
} elseif(isset($_POST['delete_id'])) {
    // Setting Variables With Escape String
    $prod_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    // constructor variables
    $prod_title = "";
    $stock_number = "";
    $exp_date = "";
    $price = "";
    $kilo_pcs_pack = "";
    $category = "";
    $description = "";
    $img_name = "";
    $img_tmp_name = "";
    $img_error = "";
    $img_size = "";

    // Instantiate ProductsCtrl Class
    $products = new ProductsCtrl(
        $prod_title,
        $stock_number,
        $exp_date,
        $price, 
        $kilo_pcs_pack,
        $category, 
        $description,
        $img_name,
        $img_tmp_name,
        $img_error,
        $img_size
    );

    // Running error handlers and DeleteProducts
    $products->getdeleteProducts($prod_id);

    // back to home page - error: none
    echo "<script> window.history.go(-1); </script>";
    $_SESSION['deleted'] = "deleted";

} elseif(isset($_POST['update'])) {
    // Setting Variables With Escape String
    $prod_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $prod_title = mysqli_real_escape_string($conn, $_POST['prod_title']);
    $stock_number = mysqli_real_escape_string($conn, $_POST['stock_number']);
    $exp_date = mysqli_real_escape_string($conn, $_POST['exp_date']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $kilo_pcs_pack = mysqli_real_escape_string($conn, $_POST['kilo_pcs_pack']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['descrip']);

    // image array
    $img_name = $_FILES['image']['name'];
    $img_tmp_name = $_FILES['image']['tmp_name'];
    $img_error = $_FILES['image']['error'];
    $img_size = $_FILES['image']['size'];

    // Instantiate ProductsCtrl Class
    $products = new ProductsCtrl(
        $prod_title,
        $stock_number,
        $exp_date,
        $price, 
        $kilo_pcs_pack,
        $category, 
        $description,
        $img_name,
        $img_tmp_name,
        $img_error,
        $img_size
    );

    // Running error handlers and UpdateProducts
    $products->updateProducts($prod_id);

    // back to home page - error: none
    echo "<script> window.history.go(-1); </script>";
    $_SESSION['updated'] = "updated";

} elseif(isset($_POST['product_id'])) {
    $prod_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    // Instantiate ProductView Class
    $products = new ProductView();

    // Running error handlers and getProducts
    $print = $products->getProducts($prod_id);

    echo $print;

} elseif(isset($_POST['submit-excel']) && $_FILES['excel']) {
    
    // constructor variables
    $prod_title = "";
    $stock_number = "";
    $exp_date = "";
    $price = "";
    $kilo_pcs_pack = "";
    $category = "";
    $description = "";
    $img_name = "";
    $img_tmp_name = "";
    $img_error = "";
    $img_size = "";

    // Instantiate ProductsCtrl Class
    $products = new ProductsCtrl(
        $prod_title,
        $stock_number,
        $exp_date,
        $price, 
        $kilo_pcs_pack,
        $category, 
        $description,
        $img_name,
        $img_tmp_name,
        $img_error,
        $img_size
    );
    
    // Running error handlers and addExcelFile
    $products->addExcelFile();

} elseif (isset($_POST['view_delivery'])) {
    // Get POST data
    $delivery_id = mysqli_real_escape_string($conn, $_POST['view_delivery']);

    // Instantiate CheckoutCtrl
    $order = new CheckoutCtrl();

    // Running error handlers and ManageDelivery
    $order->getOrderedItems($delivery_id);

} elseif (isset($_POST['manage_delivery_id'])) {
    // get POST data
    $delivery_id = mysqli_real_escape_string($conn, $_POST['manage_delivery_id']);

    // Instantiate CheckoutCtrl
    $order = new CheckoutCtrl();

    // Running error handlers and ManageDelivery
    $order->ctrlManageDelivery($delivery_id);

} elseif (isset($_POST['update-delivery'])) {
    // get POST data
    $delivery_id = mysqli_real_escape_string($conn, $_POST['delivery_id']);
    $delivery_options = mysqli_real_escape_string($conn, $_POST['delivery_options']);

    // echo $delivery_id;
    // echo $delivery_options;

    // Instantiate CheckoutCtrl
    $order = new CheckoutCtrl();

    // Running error handlers and ManageDelivery
    $order->updateDeliveryStat($delivery_options, $delivery_id);

    // back to manage delivery page - error: none
    header("location: ../admin_side/manage_delivery.php?none");

} elseif(isset($_POST['delete_cancel_order'])) {
    // Setting Variables With Escape String
    $delivery_id = mysqli_real_escape_string($conn, $_POST['delivery_id']);
    // constructor variables
    $prod_title = null;
    $stock_number = null;
    $exp_date = null;
    $price = null;
    $kilo_pcs_pack = null;
    $category = null;
    $description = null;
    $img_name = null;
    $img_tmp_name = null;
    $img_error = null;
    $img_size = null;

    // Instantiate ProductsCtrl Class
    $products = new ProductsCtrl(
        $prod_title,
        $stock_number,
        $exp_date,
        $price, 
        $kilo_pcs_pack,
        $category, 
        $description,
        $img_name,
        $img_tmp_name,
        $img_error,
        $img_size
    );

    // Running error handlers and DeleteProducts
    $products->getcanceledOrders($delivery_id);

    // back to home page - error: none
    header("location: ../admin_side/canceled_order.php?delete");
}