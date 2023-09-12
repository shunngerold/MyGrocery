<?php
    // check if session is set
    if(isset($_SESSION)) {
        session_write_close();
    } else {
        session_start();
    }
    // if the user not logged in return to home page
    if(!isset($_SESSION['user_id'])) {
        header('location: ./index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "../head.php"; ?>
    <title>Delivery | MyGrocery</title>
    <!-- Custom styles for this template -->
    <link href="../assets/css/profile_edit.css" rel="stylesheet">
    
</head>
<body class="body-animate">
    <!-- Account page navigation-->
    <?php include_once "./navigator_profile.php"; ?>

    <main class="container-fluid mb-5">
        <div class="px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row" style="align-content: center;">
                <div class="col-xl-12" >
                    <!-- Account details card-->
                    <div class="card mb-4" style="background-color:#59981A; color: #fff;">
                        <div class="card-header">Delivery and Shipping Details</div>
                        <div class="card-body mb-3" style="padding-left: 4rem; padding-right: 4rem;">
                            <form action="../includes/c_edit_profile.inc.php" method="POST" enctype="multipart/form-data">
                                <?php 
                                    // include autoload file - minimizing the include/require syntaxes for class files
                                    include_once('../includes/auto_load.inc.php'); 

                                    // Display DP form
                                    $customer = new ProfileEditView();
                                    $customer->viewDeliveryDetails();
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    document.getElementById('delivery').classList.add('active'); 
</script>
</html>