<!doctype html>
<html lang="en">
<head>
    <?php include_once "./head.php"; ?>
    <title>2-factor Verification | MyGrocery</title>
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
    ?>
    <?php include_once "./header.php"; ?>
    <!-- error/success message -->
    <?php
    if (isset($_GET['error'])) {
        $desc = $_GET['error'];
        $stat = "error";
        $btn = "Ok!";
    } elseif (isset($_GET['resend'])) {
        $desc = "Authentication code had been resend!";
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

    <main class="form-signin container mb-5">
        <form action="./includes/signin.inc.php" method="POST">
            <p class="text-danger"><?php if (isset($_GET['error'])) {
                                        echo $desc;
                                    }?></p>
            <div class="row text-center">
                <div class="col-md-12">
                    <img class="mb-4" src="./assets/images/company_name.png" width="230" height="70">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <img class="" width="150" height="150" src="./assets/images/auth.png">
                </div>
                <div class="col-md-6">
                    <h1 class="h3 mb-4 fw-bolder">Two Factor Verification</h1>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <p>You have recieved an email which contains two factor login code. If you haven't recieved it, press <a href="./includes/signin.inc.php?send-auth">here</a></p>
                </div>
            </div>
            

            <div class="form-floating">
                <input name="code" class="form-control" id="floatingInput" placeholder="name@example.com"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    type = "number"
                    maxlength = "6" required
                />
                <label for="floatingInput">6-digit Code</label>
            </div>
            <button class="w-100 btn btn-lg text-light mt-3" name="verify-auth" type="submit">Verify</button>
        </form>
    </main>
    <!-- Include Footer -->
    <?php include_once "./footer.php"; ?>
</body>

</html>