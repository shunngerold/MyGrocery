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
    <title>Manage Delivery | MyGrocery</title>

    <!-- Custom styles for this template -->
    <link href="../assets/css/manage_product.css" rel="stylesheet">

</head>

<body class="body-animate">
    <!-- Account page navigation-->
    <?php include_once "./navigator_admin.php"; ?>

    <!-- error/success message -->
    <?php 
        if(isset($_GET['none'])) {
            $desc = "Delivery Details Updated!";
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
                                            <h2><b>Manage Delivery</b></h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Search Button trigger modal -->
                                            <button style="margin-right: 5px;" type="button" class="btn"
                                                data-bs-toggle="modal" data-bs-target="#searchModal">
                                                <i class="bi-search" id="navicons"
                                                    style="font-size: 1.4rem; color: white;"></i>
                                            </button>
                                            <a href="./manage_delivery.php" class="btn btn-light text-dark">
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
                                            <th>Delivery ID</th>
                                            <th>Cart Number</th>
                                            <th>Username</th>
                                            <th>Postal</th>
                                            <th>Sub Total</th>
                                            <th>Delivery Fee</th>
                                            <th>Total Price</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(isset($_GET['search'])) {
                                                // Show searched orders
                                                $productView->AdminSearchManageDelivery();

                                            } else {
                                                ?>
                                                    <form action="../includes/a_products.inc.php" id="check_box_form" method="POST">
                                                        <?php 
                                                            // Show all orders
                                                            $productView->AdminManageDelivery();
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
                                            // pagination for searched orders
                                            $productView->SearchedDeliveryPagination();
                                        } else {
                                            // pagination for all orders
                                            $productView->ManageDeliveryPagination();
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Edit Modal HTML -->
                        <div id="editProductModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="../includes/a_products.inc.php" method="POST">
                                        <div class="modal-content" style="background-color: #ECF87F;">
                                            <div class="modal-header">
                                                <img class="bi me-2" width="40" height="43"
                                                    src="../assets/images/logo.png">
                                                <p class="modal-title fs-5" id="addModalLabel">Edit Delivery Status | MyGrocery
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <!-- border head -->
                                            <span class="border border-secondary"></span>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Delivery ID</label>
                                                    <input readonly type="text" name="delivery_id" id="delivery_id" class="form-control">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Postal</label>
                                                    <input disabled type="text" id="postal" class="form-control">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Full Address</label>
                                                    <textarea disabled class="form-control" id="f-address" cols="30" rows="10"></textarea>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Total Price (₱)</label>
                                                    <input disabled type="text" id="t-price" class="form-control">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Status</label>
                                                    <select name="delivery_options" id="options" class="form-control" required>
                                                        <option value="to_pay">To Pay</option>
                                                        <option value="to_ship">To Ship</option>
                                                        <option value="to_recieve">To Recieve</option>
                                                        <option value="to_complete">To Complete</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="background-color: #ECF87F;">
                                                <input type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                    value="Cancel">
                                                <input type="submit" name="update-delivery" class="btn"
                                                    style="background-color: #3D550C; color: #fff;" value="Update">
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
                        <!-- POP-UP VIEW DETAILS MODAL -->
                        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="viewdetailModal" tabindex="-1"
                        aria-labelledby="viewdetailModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background-color: #ECF87F;">
                                    <div class="modal-header">
                                        <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                                        <h5 class="modal-title" id="viewdetailModalLabel">View Products | MyGrocery
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
           var manage_delivery_id = $(this).attr("id");  
           if(manage_delivery_id != '')  
           {  
               $.ajax({  
                    url:"../includes/a_products.inc.php",  
                    method:"POST",  
                    data:{manage_delivery_id:manage_delivery_id},  
                    dataType:"json",
                    success:function(data){  
                       $('#delivery_id').val(data.delivery_id);
                       $('#postal').val(data.postal);
                       $('#f-address').val(data.full_address);
                       $('#t-price').val(data.total_price);
                       $('#options').val(data.delivery_status);
                       $('#editProductModal').modal('show'); 
                    }  
                });  
           }          
        });  
        // View Order
        $(document).on('click', '.button-view', function(){  
            var view_delivery = $(this).attr("id");  
            if(view_delivery != '')  
            {  
                    $.ajax({  
                        url:"../includes/a_products.inc.php",  
                        method:"POST",  
                        data:{view_delivery:view_delivery},  
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