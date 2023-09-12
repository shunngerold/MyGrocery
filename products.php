<?php 
    // check if session is set
    if (isset($_SESSION)) {
        session_write_close();
    } else {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- head links -->
    <?php include_once "./head.php"; ?>
    <title>Products | MyGrocery</title>
    <!-- Custom style for this page -->
    <link href="./assets/css/products.css" rel="stylesheet">
    <style>
        /* Remove number arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
</head>

<body class="body-animate">
<br><br>
    <!-- header tag -->
    <?php include_once "./header.php";  ?>
    <main class="mb-5">
        <?php 
            // include autoload file - minimizing the include/require syntaxes for class files
            include_once('./includes/auto_load.inc.php');
            // require mysqli database connection
            include_once('./includes/mysqli_db.inc.php');
            // require ProductView class
            $viewProducts = new ProductView();
            
            // CATEGORIZED PRODUCTS
            if(isset($_GET['category'])) {
                // variable for GET methods
                $category = mysqli_real_escape_string($conn, $_GET['category']);
                // view products
                $viewProducts->showCustomCategory($category);
                
            // ALL PRODUCTS
            } elseif(isset($_GET['All_Products'])) {
                ?>
                <!-- image cover -->
                <div class="container-fluid">
                    <div class="row row-cols-12 row-cols-sm-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12">
                        <div class="col mb-4">
                        <div class="card">
                            <img src="./assets/images/allProducts.jpeg" class="card-img-top" id="card">
                            <div class="centered h3 text-light">ALL PRODUCTS</div>
                        </div>
                    </div>
                </div>
                <?php
                // view all products
                $viewProducts->showAllProducts();

            // SEARCHED PRODUCTS
            } elseif(isset($_GET['search'])) {
                // variable for searched text
                $search = mysqli_real_escape_string($conn, $_GET['search']);
                // view searched products
                $viewProducts->showSearchedProduct();

            } else {
                // Set default page -> View All Products
                $viewProducts->showAllProducts();
            }
        ?>
    </main>
    <!-- Include Footer -->
    <?php include_once "./footer.php"; ?>
</body>
<script>
    $(document).ready(function () {
        $(document).on('click', '.button-cart', function(){  
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
    });
</script>
</html>