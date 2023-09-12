<!doctype html>
<html lang="en">
<head>
    <?php include_once "./head.php"; ?>
    <title>Email Verification | MyGrocery</title>
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
                    <h1 class="h3 mb-4 fw-bolder">Verify Your Email Address</h1>
                </div>
            </div>
            <div class="row mb-2 text-center">
                <div class="col-md-12">
                    <p>Hi, We're happy you signed up for <b>MyGrocery</b>. To start exploring the <b>MyGrocery App</b>, please check your email account and enter the 6-digit code.</p>
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
            <button class="w-100 btn btn-lg text-light mt-3" name="verify-email" type="submit">Verify</button>
            <div class="row mb-2 text-center">
                <div class="col-md-12 mt-3">
                    <p><b>Welcome to MyGrocery</b></p>
                    <p>- MyGrocery Team</p>
                </div>
            </div>
        </form>
    </main>
    <!-- Include Footer -->
    <?php include_once "./footer.php"; ?>
</body>

</html>