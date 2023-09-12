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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './head.php'; ?>
    <title>Cart | FMyGrocery</title>
    <!-- Custom styles for this template -->
    <link href="./assets/css/shop-cart.css" rel="stylesheet">
    <style>
    /* Remove number arrows */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }
    </style>
</head>

<body class="body-animate">
    <?php
    // when the user want to search in homepage
    if (isset($_GET['search'])) {
      header('location: ./products.php?search=' . $_GET['search'] . '');
    }
    ?>
    <!-- error/success message -->
    <?php
    if (isset($_SESSION['delivery'])) {
      $desc = "Your items will arrive soon!";
      $stat = "success";
      $btn = "Aww yiss!";
    } elseif (isset($_SESSION['error'])) {
      $desc = $_SESSION['error'];
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
    <!-- unset message variables -->
    <?php 
      unset($_SESSION['delivery']);
      unset($_SESSION['error']);
    ?>
    <!-- header tag -->
    <?php include_once "./header.php";  ?>

    <main>
        <!-- cart items details -->
        <div class="small-container cart-page">
            <?php
      // include autoload file - minimizing the include/require syntaxes for class files
      include_once('./includes/auto_load.inc.php');

      // initiate CartView
      $cart_num = new CartView();
      // take out the counted products inside the cart
      $cart_num->cartView();
      ?>
            <div class="total-price">
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <td>
                            <?php
              echo "₱ " . $cart_num->sum_num_cart() . ".00";
              ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Delivery Fee (Distance: <?php
                                        if ($cart_num->countValueKM_deliveryfee() == 0) {
                                          echo "0km";
                                        } else {
                                          echo $cart_num->showKM() . "km";
                                        }
                                        ?>)</td>
                        <td><?php
                if ($cart_num->countValueKM_deliveryfee() == 0) {
                  echo "0";
                } else {
                  echo "₱" . $cart_num->showdeliveryfee() . ".00";
                }
                ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>
                            <?php
              if ($cart_num->countValueKM_deliveryfee() == 0) {
                echo "----";
              } elseif($cart_num->cartnum() == 0) {
                echo "----";
              } else {
                echo "₱ " . $cart_num->total_sum() . ".00";
              }
              ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="checkout mt-3">
                <button type="button" class="btn btn-warning col-4 me-2" onclick="history.back()">
                    <i class="bi-box-arrow-left"></i> Back
                </button>
                <?php
                    if ($cart_num->cartnum() == 0) {
                    ?>
                        <a href="./cart.php?checkout=404" class="btn text-light pull-right col-4 disabled"
                            style="background-color: #59981A; border: none;">
                            <i class="bi-cart3"></i> Checkout
                        </a>
                    <?php
                    } elseif ($cart_num->countValueKM_deliveryfee() == 0) {
                    ?>
                        <a href="./user_edit_profile/profile.php?null" class="btn text-light pull-right col-4"
                            style="background-color: #59981A; border: none;">
                            <i class="bi-cart3"></i> Checkout
                        </a>
                    <?php
                    } else {
                    ?>
                        <a href="./checkout.php" class="btn text-light pull-right col-4"
                            style="background-color: #59981A; border: none;">
                            <i class="bi-cart3"></i> Checkout
                        </a>
                    <?php
                    }
                ?>
            </div>
        </div>
    </main>
    <!-- Include Footer -->
    <?php include "./footer.php"; ?>
</body>
<!-- AUTO-SUBMIT -->
<script>
  // bind input box - auto submit
  $('#qty').bind('keyup', function() { 
      $('#form-cart').delay(200).submit();
  });
  
  $("#form-cart").on("submit", function( event ) {
    event.preventDefault();
    $.ajax({
      type: "post",
      dataType: "html",
      url: './includes/c_addCart.inc.php',
      data: $("form").serialize(),
      success:function(data){ 
        window.location.href = "./cart.php";
      }  
    });
  });
</script>
</html>