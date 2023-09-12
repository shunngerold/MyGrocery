<?php
    // check if session is set
    if(isset($_SESSION)) {
        session_write_close();
    } else {
        session_start();
    }
    // if the user not logged in return to home page
    if(!isset($_SESSION['user_id'])) {
        header('location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "../head.php"; ?>
    <title>Profile | MyGrocery</title>

    <!-- Custom styles for this template -->
    <link href="../assets/css/profile_edit.css" rel="stylesheet">
    
</head>
<body class="body-animate">
    <!-- Account page navigation-->
    <?php include_once "./navigator_profile.php"; ?>
    
    <!-- error/success message -->
    <?php 
        if(isset($_GET['error'])) {
            $desc = $_GET['error'];
            $stat = "error";
            $btn = "confirm";
        } elseif(isset($_GET['none'])) {
            $desc = "Account Details Updated!";
            $stat = "success";
            $btn = "confirm";
        } elseif (isset($_GET['null'])) {
            $desc = "Please fill the delivery details first!";
            $stat = "info";
            $btn = "Ok!";
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
    <main class="mb-5">
        <div class="container-lg px-4 mt-4" >
            <form action="../includes/c_edit_profile.inc.php" method="POST" enctype="multipart/form-data">
                <!-- Account page navigation-->
                <hr class="mt-0 mb-4">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0 mb-lg-0" style="background-color:#59981A;">
                            <?php 
                                // include autoload file - minimizing the include/require syntaxes for class files
                                include_once('../includes/auto_load.inc.php'); 
        
                                // Display DP form
                                $customer = new ProfileEditView();
                                $customer->viewDPInfo();
                            ?>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <?php
                            // Display Account detail form
                            $customer->viewAccDetails();
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
<script>
    document.getElementById('profile').classList.add('active'); 
</script>
</html>