<?php
// check if session is set
if (isset($_SESSION)) {
  session_write_close();
} else {
  session_start();
}

// entering admin side
if (!isset($_SESSION['user_id'])) {
  if (isset($_GET['admin'])) {
    header('location: ./admin_side/signin.php');
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- head links -->
  <?php include_once "./head.php"; ?>
  <title>Contact Us | MyGrocery</title>
  <!-- Custom styles for this template -->
  <link href="./assets/css/home.css" rel="stylesheet">
</head>

<body class="body-animate">
  <br><br>

  <?php
  // when the user want to search in homepage
  if (isset($_GET['search'])) {
    header('location: ./products.php?search=' . $_GET['search'] . '');
  }
  ?>

  <!-- header tag -->
  <?php include_once "./header.php";  ?>

  <main class="mb-5 container-fluid text-center">
    <div class="rich-text__heading--large text-center">
      <h2 id="welcome-title">CONTACT US</h2>
    </div><br>
    <center>
      <form action="">
        <div class="input-group mb-3" style="width: 350px;">
            <span class="input-group-text">@</span>
            <input type="email" name="email-acc" class="form-control" placeholder="Email" required>
        </div>
        <div class="input-group mb-3" style="width: 350px;">
          <textarea class="form-control" name="msg-box" id="" cols="30" rows="10" required></textarea>
        </div>
        <div class="input-group mb-3" style="width: 350px;">
          <input type="submit" value="Send" class="btn btn-success form-control">
        </div>
      </form>
    </center>
  
    <div class="rich-text__heading--large text-center mt-5">
      <h4 id="welcome-title"><a href="#" style="text-decoration: none;">www.MyGrocery.com</a></h4>
    </div><br>
  
    <div class="rich-text__heading--large text-center">
      <h6 id="welcome-title">Email US @: <a href="#" style="text-decoration: none;">mygrocery@gmail.com</a></h6>
    </div><br>
  
    <p class="d-inline-block text-center mt-3" style="max-width: 700px; font-size: 18px;" id="description-title">Here at My Grocery we greatly value cutomer service. Message us any time through our Email and we will try to get back to you as soon as possible. We are happy to deliver! <span style="color: #59981A;">My Grocery | Our grocery is always there for you.</span>
  </main>

  <!-- Include Footer -->
  <br>
  <?php include_once "./footer.php"; ?>
</body>

</html>