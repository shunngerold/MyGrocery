<?php 
    session_start();
    if(isset($_SESSION['admin_id'])) {
        header('location: ./home.php');
    }
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once "../head.php"; ?>
    <title>Signin | Admin</title>
    <!-- Custom styles for this template -->
    <link href="../assets/css/a_signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <!-- error/success message -->
    <?php 
        $desc;
        $stat;
        $btn;
        if(isset($_GET['error'])) {
            $desc = $_GET['error'];
            $stat = "error";
            $btn = "Ok!";
        } elseif(isset($_GET['none'])) {
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

    <main class="form-signin">
        <form action="../includes/a_signin.inc.php" method="POST">
            <p class="text-danger"><?php if(isset($_GET['error'])) {echo $desc;} ?></p>
            <img class="mb-4" src="../assets/images/company_name.png" alt="" width="230" height="70">
            <h1 class="h3 mb-5 fw-normal">Welcome Admin</h1>

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
            <button class="mt-4 w-100 btn btn-lg text-light" name="submit" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2022 . MyGrocery</p>
        </form>
    </main>
</body>

</html>

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