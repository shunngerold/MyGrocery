<?php 
    // check if session is set
    if (isset($_SESSION)) {
        session_write_close();
    } else {
        session_start();
    }
?>
<!doctype html>
<html lang="en">

<head>
    <?php include_once "./head.php"; ?>
    <title>Product | MyGrocery</title>
    <!-- Custom styles for this template -->
    <link href="./assets/css/signin.css" rel="stylesheet">
</head>

<body class="body-animate">
    <?php
    // when the user want to search in signin
    if (isset($_GET['search'])) {
        header('location: ./products.php?search=' . $_GET['search'] . '');
    }

    // entering admin side
    if (!isset($_SESSION['user_id'])) {
        if (isset($_GET['admin'])) {
            header('location: ./admin_side/signin.php');
        }
    }
    if (isset($_SESSION['cart_added'])) {
        $desc = $_SESSION['cart_added'];
        $stat = "success";
        $btn = "Aww yiss!";
    } 
    if (isset($_SESSION['less_stock'])) {
        $desc = $_SESSION['less_stock'];
        $stat = "info";
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
        unset($_SESSION['cart_added']);
        unset($_SESSION['less_stock']);
    ?>

    <!-- Navigator Bar -->
    <?php include_once "./header.php"; ?>

    <!-- Include View class -->
    <?php 
        // include mysqli database
        include_once "./includes/mysqli_db.inc.php";
        // include autoload file - minimizing the include/require syntaxes for class files
        include_once('./includes/auto_load.inc.php'); 

        $prod_id = mysqli_escape_string($conn, $_GET['product_id']);

        $product = new ProductView();
        $datas = $product->viewspecificItem($prod_id);
    ?>
    
    <main class="container text-center">
        <div class="row">
            <div class="col-md-6 mt-5 mb-5">
                <img src="<?php echo $datas[0]['images']; ?>" width="350" height="400">
            </div>
            <div class="col-md-6 mt-3 mb-5" style="text-align: left;">
                <h1 style="color: #3D550C;"><?php echo ucwords($datas[0]['product_title']); ?></h1>
                <h2><?php echo "₱ " . $datas[0]['price']; ?></h2>
                <p style="font-size: 23px;">
                    <?php echo $datas[0]['description']; ?>
                </p>
                <h3>Description lists</h3>
                <p><?php echo "Price per: " . $datas[0]['kilo_pcs_pack'];  ?></p>
                <p><?php echo "Product stock(s): " . $datas[0]['stock_number']; ?></p>
                <p>Expiry Date:<?php echo " ".$datas[0]['expiry_date']; ?></p>
                <form id="add-cart-form" action="./includes/c_addCart.inc.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="qty">Select Quantity</label>
                            <input type="number" class="form-control" min="1" max="100" value="1" name="qty" required>
                        </div>
                        <!-- hidden id -->
                        <input type="hidden" name="product_id" value="<?php echo $datas[0]['product_id']; ?>">
                    </div>
                </form>
                <div class="buttons mt-3">
                    <?php
                        // Check if user is set
                        if (isset($_SESSION['user_id'])) {
                            if($datas[0]['stock_number'] <= 0) {
                                ?>
                                    <button class='btn btn-lg text-light mt-3 mb-4 disabled' style="background-color: #3D550C;">
                                        <i class="bi-cart3"></i> Add to Cart
                                    </button>
                                    <button class='btn btn-lg text-light mt-3 mb-4 disabled' style="background-color: #3D550C;">
                                        <i class="bi-bag"></i> Buy it now
                                    </button>
                                    <input type="button" class="btn btn-lg btn-warning mt-3 mb-4" onclick="history.back()" value="Back">
                                    <p class="text-danger lead" style="font-size: 15px;">We sincerely apologize for this inconvenience. We've experienced an unusually high number of orders and have run out of inventory.</p>
                                <?php
                            } elseif ($datas[0]['stock_number'] < 20) {
                                ?>
                                    <button form="add-cart-form" id="addcart" name="add-cart" type="submit" class='btn btn-lg text-light mt-3 mb-4' style="background-color: #3D550C;">
                                        <i class="bi-cart3"></i> Add to Cart
                                    </button>
                                    <button form="add-cart-form" id="addcart" name="buy-now" type="submit" class='btn btn-lg text-light mt-3 mb-4' style="background-color: #3D550C;">
                                        <i class="bi-bag"></i> Buy it now
                                    </button>
                                    <input type="button" class="btn btn-lg btn-warning mt-3 mb-4" onclick="history.back()" value="Back">
                                    <p class="text-danger lead" style="font-size: 15px;">Less than or equal 20 stocks available.</p>
                                <?php
                            } else {
                                ?>
                                    <button form="add-cart-form" id="addcart" name="add-cart" type="submit" class='btn btn-lg text-light mt-3 mb-4' style="background-color: #3D550C;">
                                        <i class="bi-cart3"></i> Add to Cart
                                    </button>
                                    <button form="add-cart-form" id="addcart" name="buy-now" type="submit" class='btn btn-lg text-light mt-3 mb-4' style="background-color: #3D550C;">
                                        <i class="bi-bag"></i> Buy it now
                                    </button>
                                    <input type="button" class="btn btn-lg btn-warning mt-3 mb-4" onclick="history.back()" value="Back">
                                <?php
                            }
                        } else {
                            if($datas[0]['stock_number'] == 0) {
                                ?>
                                    <button class='btn btn-lg text-light mt-3 mb-4 disabled' style="background-color: #3D550C;">
                                        <i class="bi-cart3"></i> Add to Cart
                                    </button>
                                    <button class='btn btn-lg text-light mt-3 mb-4 disabled' style="background-color: #3D550C;">
                                        <i class="bi-bag"></i> Buy it now
                                    </button>
                                    <input type="button" class="btn btn-lg btn-warning mt-3 mb-4" onclick="history.back()" value="Back">
                                    <p class="text-danger" style="font-size: 15px;">We sincerely apologize for this inconvenience. We've experienced an unusually high number of orders and have run out of inventory.</p>
                                <?php
                            } elseif ($datas[0]['stock_number'] < 20) {
                                ?>
                                    <a href="./signin.php" class='btn btn-lg text-light mt-3 mb-4' style="background-color: #3D550C;">
                                        <i class="bi-cart3"></i> Add to Cart
                                    </a>
                                    <a href="./signin.php" class='btn btn-lg text-light mt-3 mb-4' style="background-color: #3D550C;">
                                        <i class="bi-bag"></i> Buy it now
                                    </a>
                                    <input type="button" class="btn btn-lg btn-warning mt-3 mb-4" onclick="history.back()" value="Back">
                                    <p class="text-danger" style="font-size: 15px;">Less than or equal 20 stocks available.</p>
                                <?php
                            } else {
                                ?>
                                    <a href="./signin.php" class='btn btn-lg text-light mt-3 mb-4' style="background-color: #3D550C;">
                                        <i class="bi-cart3"></i> Add to Cart
                                    </a>
                                    <a href="./signin.php" class='btn btn-lg text-light mt-3 mb-4' style="background-color: #3D550C;">
                                        <i class="bi-bag"></i> Buy it now
                                    </a>
                                    <input type="button" class="btn btn-lg btn-warning mt-3 mb-4" onclick="history.back()" value="Back">
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <br>
    <!-- Include Footer -->
    <?php include_once "./footer.php"; ?>
</body>
</html>