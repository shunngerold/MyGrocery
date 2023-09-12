<?php
// check if session is set
if (isset($_SESSION)) {
  session_write_close();
} else {
  session_start();
}
// if the user not logged in return to home page
if (!isset($_SESSION['user_id'])) {
  header('location: ./index.php');
}
// if delivery details is null, back to cart
include_once('./includes/auto_load.inc.php'); // include autoload file - minimizing the include/require syntaxes for class files
$cart = new CartView();
if ($cart->countValueKM_deliveryfee() == 0) {
  header("location: ./user_edit_profile/profile.php?null");
}
if($cart->sum_num_cart() == 0) {
  echo "<script> window.history.go(-1); </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Checkout | MyGrocery</title>
  <!-- head links -->
  <?php include_once "./head.php"; ?>
  <!-- Custom styles for this template -->
  <link href="./assets/css/checkout.css" rel="stylesheet">
</head>

<body>
  <!-- error/success message -->
  <?php
  if (isset($_GET['error'])) {
    $desc = $_GET['error'];
    $stat = "error";
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

  <div class="container">
    <div class="py-5 text-center">
      <div class="rich-text__heading--large text-center">
        <h2 id="checkout-title">MY GROCERY | CHECKOUT FORM</h2>
        <p id="checkout-description" class="lead">Confirm the necessary payment for your items that will be buying.</p>
        <p id="checkout-description" class="lead text-danger"><?php if (isset($_GET['error'])) {
                                                                echo $_GET['error'];
                                                              } ?></p>
      </div><br>
    </div>

    <div class="row">
      <?php
      // include autoload file - minimizing the include/require syntaxes for class files
      include_once('./includes/auto_load.inc.php');

      // Display Items in a cart
      $cart_num = new CartView();
      $cart_num->itemsInCart();

      // Display DP form
      $customer = new ProfileEditView();
      $customer->viewcheckout();
      ?>

    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2021-2022 MyGrocery</p>
    </footer>
  </div>
</body>
</html>