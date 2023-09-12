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
  <title>Signup | MyGrocery</title>
  <!-- Custom styles for this template -->
  <link href="assets/css/signup.css" rel="stylesheet">
</head>

<body class="body-animate">

  <?php
  // when the user want to search in signup
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
  if (isset($_SESSION['error'])) {
    $desc = $_SESSION['error'];
    $stat = "error";
    $btn = "Ok!";
  } elseif (isset($_SESSION['none'])) {
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
  <main class="form-signup container mb-5 text-center">
    <form action="./includes/signup.inc.php" method="POST">
      <p class="text-danger"><?php if (isset($_SESSION['none'])) {
                                echo $desc;
                              } ?></p>
      <img class="mb-1" src="assets/images/company_name.png" alt="" width="230" height="70">
      <h1 class="h3 mb-2 fw-normal">Please sign up</h1>

      <div class="form-floating">
        <input type="text" name="uname" class="form-control" id="floatingInput" placeholder="example" required>
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
        <label for="floatingInput">Valid Email address</label>
      </div>
      <div class="form-floating">
        <select name="gender" id="floatingInput" class="form-control" required>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <label for="floatingInput">Select Gender</label>
      </div>
      <div class="form-floating">
        <input type="password" name="pwd" class="form-control" id="myInput" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>
      <div class="form-floating">
        <input type="password" name="pwdRepeat" class="c-pass form-control" placeholder="Password" required>
        <label for="floatingPassword">Confirm Password</label>
      </div>
      <button class="w-100 btn btn-lg text-light mt-3" name="submit" type="submit">Sign up</button>
      <p class="mt-3 text-muted">Do you have an account? <a href="signin.php"> Sign in.</a></p>
    </form>
  </main>
  <!-- Include Footer -->
  <?php include_once "./footer.php"; ?>
</body>
<?php 
    unset($_SESSION['none']);
    unset($_SESSION['error']);
?>
</html>