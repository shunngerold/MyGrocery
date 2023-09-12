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
    <title>Security | MyGrocery</title>
    <!-- Custom styles for this template -->
    <link href="../assets/css/profile_edit.css" rel="stylesheet">
</head>
<body class="body-animate ">
    <!-- Account page navigation-->
    <?php include_once "./navigator_profile.php"; ?>

    <main class="mb-5">
        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-md-8">
                    <!-- Change password card-->
                    <div class="card" style="background-color:#59981A; color: #fff;">
                        <div class="card-header">Change Password</div>
                        <div class="card-body">
                            <!-- error/success message -->
                            <?php 
                                if(isset($_GET['error'])) {
                                    $desc = $_GET['error'];
                                    $stat = "error";
                                    $btn = "Ok!";
                                    ?>
                                        <!-- error indicator -->
                                        <p class="text-danger"><?php echo $desc; ?></p>
                                    <?php
                                } elseif(isset($_GET['none'])) {
                                    $desc = "Account Details Updated!";
                                    $stat = "success";
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
                            <form action="../includes/c_edit_profile.inc.php" method="POST" enctype="multipart/form-data">
                                <!-- Form Group (current password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="currentPassword">Current Password</label>
                                    <input class="form-control" name="currentPassword" type="password" placeholder="Enter current password" required>
                                </div>
                                <!-- Form Group (new password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="newPassword">New Password</label>
                                    <input class="form-control" name="newPassword" type="password" placeholder="Enter new password" required>
                                </div>
                                <!-- Form Group (confirm password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                    <input class="form-control" name="confirmPassword" type="password" placeholder="Confirm new password" required>
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit_security" style="background-color:#3D550C; border: none;">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php 
                    // include autoload file - minimizing the include/require syntaxes for class files
                    include_once('../includes/auto_load.inc.php'); 
            
                    // Display DP form
                    $customer = new ProfileEditView();
                    $auth = $customer->showAuthVal();
                ?>
                <!-- Two factor Authentication-->
                <div class="card col-md-4" style="background-color:#59981A; color: #fff;">
                    <div class="card-header">Two-factor Authentication</div>
                    <div class="card-body">
                        <div class="mt-3">
                            <p>We will ask for a login code each time you login to our system. This code will be sent to the account registered in your "account details".</p>
                            <label for="auth-btn" class="mt-2">Current Status :</label>
                            <?php 
                                if($auth == 0) {
                                    ?>
                                        <a href="../includes/c_edit_profile.inc.php?auth=1" id="auth-btn" class="btn btn-lg btn-danger form-control mt-1"><b>Off</b></a>
                                    <?php
                                } else {
                                    ?>
                                        <a href="../includes/c_edit_profile.inc.php?auth=0" id="auth-btn" class="btn btn-lg btn-warning form-control mt-1"><b>On</b></a>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    document.getElementById('security').classList.add('active'); 
</script>
</html>