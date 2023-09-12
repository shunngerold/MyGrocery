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
    <title>Signin | MyGrocery</title>
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
    $desc;
    $stat;
    $btn;
    if (isset($_SESSION['error'])) {
        $desc = $_SESSION['error'];
        $stat = "error";
        $btn = "Ok!";
    } elseif (isset($_SESSION['none'])) {
        $desc = "Successfuly Registered!";
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

    <main class="form-signin container mb-5 text-center">
        <form action="./includes/signin.inc.php" method="POST">
            <p class="text-danger"><?php if (isset($_GET['error'])) {
                                        echo $desc;
                                    } ?></p>
            <img class="mb-4" src="./assets/images/company_name.png" alt="" width="230" height="70">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input name="uname" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input name="pwd" type="password" class="form-control" id="myInput" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <center>
                    <input type="checkbox" onclick="myFunction()"><a style="color: #3D550C; font-size: 15px;">Show
                        Password</a>
                </center>
            </div>
            <button class="w-100 btn btn-lg text-light" name="submit" type="submit">Sign in</button>
            <p class="mt-5 mb-4 text-muted">Don't have an account? <a href="signup.php"> Sign up.</a></p>
        </form>
    </main>
    <!-- Include Footer -->
    <?php include_once "./footer.php"; ?>
</body>

</html>
<?php 
    unset($_SESSION['error']);
    unset($_SESSION['none']);
?>
<script>
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>