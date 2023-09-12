<?php
    // check if session is set
    if(isset($_SESSION)) {
        session_write_close();
    } else {
        session_start();
    }
    // if the user not logged in return to home page
    if(!isset($_SESSION['admin_id'])) {
        header('location: ./signin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "../head.php"; ?>
    <title>Manage Products | MyGrocery</title>

    <!-- Custom styles for this template -->
    <link href="../assets/css/manage_product.css" rel="stylesheet">

</head>

<body class="body-animate">
    <!-- Account page navigation-->
    <?php include_once "./navigator_admin.php"; ?>

    <!-- error/success message -->
    <?php 
        if(isset($_SESSION['error'])) {
            $desc = $_SESSION['error'];
            $stat = "error";
            $btn = "Ok";
        } elseif(isset($_SESSION['added'])) {
            $desc = "Product Added!";
            $stat = "success";
            $btn = "Ok";
        } 
        elseif(isset($_SESSION['updated'])) {
            $desc = "Product details updated!";
            $stat = "success";
            $btn = "Ok";
        }
        elseif(isset($_SESSION['deleted'])) {
            $desc = "Product successfully deleted!";
            $stat = "success";
            $btn = "Ok";
        }
        elseif(isset($_SESSION['excel'])) {
            $desc = $_SESSION['excel'];
            $stat = "success";
            $btn = "Ok";
        }
        elseif(isset($_GET['error'])) {
            $desc = $_GET['error'];
            $stat = "error";
            $btn = "Ok";
        }
        elseif(isset($_GET['updated'])) {
            $desc = "Your account is successfully updated!";
            $stat = "success";
            $btn = "Ok";
        }
        elseif(isset($_GET['added'])) {
            $desc = "New Account Added!";
            $stat = "success";
            $btn = "Ok";
        }
        elseif(isset($_GET['notif'])) {
            $desc = "Notification has been sent!";
            $stat = "success";
            $btn = "Ok";
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
    <!-- unset session message variables -->
    <?php 
        unset($_SESSION['error']); 
        unset($_SESSION['added']);
        unset($_SESSION['updated']);
        unset($_SESSION['deleted']);
        unset($_SESSION['excel']);
    ?>
    <main>
        <div>
            <div class="page-width rich-text">
                <div class="grid">
                    <div class="grid__item  medium-up--two-thirds medium-up--push-one-sixth">
                        <div class="container">
                            <div class="table-wrapper">
                                <div class="table-title" style="background-color:#59981A;">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2><b>Manage Products</b></h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Search Button trigger modal -->
                                            <button style="margin-right: 5px;" type="button" class="btn"
                                                data-bs-toggle="modal" data-bs-target="#searchModal">
                                                <i class="bi-search" id="navicons"
                                                    style="font-size: 1.4rem; color: white;"></i>
                                            </button>
                                            <button type="button" class="text-dark btn btn-warning"
                                                data-bs-toggle="modal" data-bs-target="#addProductModal">
                                                <i class="bi bi-file-plus" style="font-size: 20px;"></i>
                                                <span>Add Product</span>
                                            </button>
                                            <a href="./home.php" class="btn btn-light text-dark">
                                                <i class="bi bi-arrow-clockwise" style="font-size: 20px;"></i>Refresh Page
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    // include autoload file - minimizing the include/require syntaxes for class files
                                    include_once('../includes/auto_load.inc.php');

                                    // Initiate ProductView class
                                    $productView = new ProductView();
                                ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Title</th>
                                            <th>Stock Number</th>
                                            <th>Expiry Date</th>
                                            <th>Price (₱)</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(isset($_GET['search'])) {
                                                // Show searched products
                                                $productView->AdminSearched();

                                            } else {
                                                ?>
                                                    <form action="../includes/a_products.inc.php" id="check_box_form" method="POST">
                                                        <?php 
                                                            // Show all products
                                                            $productView->AdminShowProducts()
                                                        ?>
                                                    </form>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <?php 
                                        if(isset($_GET['search'])) {
                                            // pagination for searched products
                                            $productView->PaginationSearched();
                                        } else {
                                            // pagination for all products
                                            $productView->AllProductPagination();
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- POP-UP ADD PRODUCT MODAL -->
                        <div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background-color: #ECF87F;">
                                    <form action="../includes/a_products.inc.php" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-content" style="background-color: #ECF87F;">
                                            <div class="modal-header">
                                                <img class="bi me-2" width="40" height="43"
                                                    src="../assets/images/logo.png">
                                                <p class="modal-title fs-5" id="addModalLabel">Add Product | MyGrocery
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <!-- border head -->
                                            <span class="border border-secondary"></span>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Product Title</label>
                                                    <input type="text" name="prod_title" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Stock Number</label>
                                                    <input type="number" name="stock_number" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Expiry Date</label>
                                                    <input type="date" name="exp_date" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Price</label>
                                                    <input type="number" name="price" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Select Kg / Pcs / Pack</label>
                                                    <select class="form-control" name="kilo_pcs_pack">
                                                        <option value="1 kilo">1 kg</option>
                                                        <option value="1 pc">1 pc</option>
                                                        <option value="1 pack">1 pack</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Category</label>
                                                    <input type="text" name="category" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Description</label>
                                                    <textarea name="descrip" class="form-control" cols="30" rows="10"
                                                        required></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Select Image :</label>
                                                    <input type="file" name="image" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <button type="button" class="form-control btn btn-success"
                                                        data-bs-toggle="modal" data-bs-target="#addProduct">
                                                        <i class="bi bi-file-earmark-spreadsheet"
                                                            style="font-size: 20px;"></i>
                                                        <span>Add Product through </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ECF87F;">
                                                <input type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                    value="Cancel">
                                                <input type="submit" name="submit" class="btn btn-default"
                                                    style="background-color: #3D550C; color: #fff;" value="Add">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Edit Modal HTML -->
                        <div id="editProductModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="../includes/a_products.inc.php" method="POST"
                                        enctype="multipart/form-data" id="edit-form">
                                        <div class="modal-content" style="background-color: #ECF87F;">
                                            <div class="modal-header">
                                                <img class="bi me-2" width="40" height="43"
                                                    src="../assets/images/logo.png">
                                                <p class="modal-title fs-5" id="addModalLabel">Edit Product | MyGrocery
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <!-- border head -->
                                            <span class="border border-secondary"></span>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Product Title</label>
                                                    <input type="text" id="title" name="prod_title" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Stock Number</label>
                                                    <input type="number" id="stock" name="stock_number" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Expiry Date</label>
                                                    <input type="date" id="date" name="exp_date" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Price</label>
                                                    <input type="number" id="prices" name="price" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Select Kg / Pcs / Pack</label>
                                                    <select class="form-control" id="kilo" name="kilo_pcs_pack">
                                                        <option value="1 kilo">1 kg</option>
                                                        <option value="1 pc">1 pc</option>
                                                        <option value="1 pack">1 pack</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Category</label>
                                                    <input type="text" id="categories" name="category" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Description</label>
                                                    <textarea name="descrip" id="description" class="form-control" cols="30" rows="10"
                                                        required></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Select Image :</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <!-- Hidden inputs -->
                                                    <input type="hidden" id="product_id" name="product_id">
                                                    <input type="hidden" id="image" name="image">
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ECF87F;">
                                                <input type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                    value="Cancel">
                                                <input type="submit" name="update" class="btn btn-default"
                                                    style="background-color: #3D550C; color: #fff;" value="Update">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal HTML -->
                        <div id="deleteProductModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="delete-form" action="../includes/a_products.inc.php" method="POST">
                                        <div class="modal-content" style="background-color: #ECF87F;">
                                            <!-- hidden -->
                                            <input type="hidden" name="product_id" id="delete_prod_id">
                                            <div class="modal-header">
                                                <img class="bi me-2" width="40" height="43"
                                                    src="../assets/images/logo.png">
                                                <p class="modal-title fs-5" id="addModalLabel">Add Product | MyGrocery
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <!-- border head -->
                                            <span class="border border-secondary"></span>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete these Product?</p>
                                                <p class="text-danger"><small>This action cannot be undone.</small></p>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ECF87F;">
                                                <input type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                    value="Cancel">
                                                <input type="submit" form="delete-form" class="btn btn-default" name="delete_id"
                                                    style="background-color: #3D550C; color: #fff;" value="Delete">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Excel Modal HTML -->
                        <div id="addProduct" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="-form" action="../includes/a_products.inc.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-content" style="background-color: #ECF87F;">
                                            <div class="modal-header">
                                                <img class="bi me-2" width="40" height="43"
                                                    src="../assets/images/logo.png">
                                                <p class="modal-title fs-5" id="addModalLabel">Add Product | MyGrocery
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <!-- border head -->
                                            <span class="border border-secondary"></span>
                                            <div class="modal-body">
                                                <label for="_file">Select  file ('xls', 'csv', 'xlsx')</label>
                                                <input class="form-control mt-2" type="file" name="excel" id="excel_file" required>
                                                <p class="text-danger mt-3"><b>Note: </b>This is the sequence of
                                                    products in database.</p>
                                                <p class="text-danger mt-1">Product title | Stock Number |
                                                    Expiry date (yyyy-mm-dd) | Price | Kilo/Pcs/Pack | Category |
                                                    Description</p>
                                                    <p class="text-danger mt-2"><b>Note II: </b>Product image is default.</p>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ECF87F;">
                                                <input type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                    value="Cancel">
                                                <input type="submit" name="submit-excel" class="btn btn-default"
                                                    style="background-color: #3D550C; color: #fff;"
                                                    value="Add products">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- POP-UP SEARCH MODAL -->
                        <div class="modal fade" id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="searchtModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background-color: #ECF87F;">
                                <div class="modal-header">
                                    <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                                    <h5 class="modal-title" id="searchModalLabel">Search | MyGrocery</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- border head -->
                                <span class="border border-secondary"></span>
                                <div class="modal-body">
                                    <form id="searchProd" method="GET">
                                    <input type="text" name="search" class="form-control" required>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-light" data-bs-dismiss="modal">Continue Shopping</button>
                                    <button type="submit" form="searchProd" class="btn text-light" style="background-color: #3D550C;">
                                    Search
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<!-- JQuery Modal -->
<script>
    $(document).ready(function () {
        // Edit Products
        $(document).on('click', '.button-edit', function(){  
           var product_id = $(this).attr("id");  
           if(product_id != '')  
           {  
               $.ajax({  
                    url:"../includes/a_products.inc.php",  
                    method:"POST",  
                    data:{product_id:product_id},  
                    dataType:"json",
                    success:function(data){  
                       $('#title').val(data.product_title);
                       $('#stock').val(data.stock_number);
                       $('#date').val(data.expiry_date);
                       $('#prices').val(data.price);
                       $('#kilo').val(data.kilo_pcs_pack);
                       $('#categories').val(data.category);
                       $('#description').val(data.description);
                       $('#product_id').val(data.product_id);
                       $('#image').val(data.images);
                       $('#editProductModal').modal('show'); 
                    }  
                });  
           }            
        });  
        // Delete Product
        $(document).on('click', '.button-delete', function(){  
           var delete_id = $(this).attr("id");
           document.getElementById("delete_prod_id").value = delete_id;
           $('#deleteProductModal').modal('show'); 
        }); 
    });
</script>
<script>
  
</script>
</html>