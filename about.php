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
  <title>About Us | MyGrocery</title>
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

  <main class="mb-5">
    <div class="page-width rich-text">
      <div class="grid">
        <div class="grid__item  medium-up--two-thirds medium-up--push-one-sixth">

          <div class="rich-text__heading--large text-center">
            <h2 id="welcome-title">ABOUT US</h2>
          </div><br>

          <div class="rich-text__heading--large text-center">
            <p class="d-inline-block text-center" style="max-width: 700px; font-size: 18px;" id="description-title">My Grocery is a online shopping and delivery service provider which tends to be great for customers who are being concious about the ongoing pandemic and didn't want to go out and be near other people. This online groceyr store provides the quality goods and services for our dear customers. We have different kinds of products ranging from

              <a id="product-links" href="./products.php?category=canned products">Canned Products</a>,
              <a id="product-links" href="./products.php?category=breads and spreads">Breads & Spreads</a>,
              <a id="product-links" href="./products.php?category=snacks and chips">Snacks & Chips</a>,
              <a id="product-links" href="./products.php?category=packed noodles">Packed Noodles</a><em>,</em>&nbsp;
              <a id="product-links" href="./products.php?category=meats and poultry">Meats & Poultry</a> and
              <a id="product-links" href="./products.php?category=fresh fruits and veggies">Fruits & Veggies</a>.&nbsp;


            <div class="rich-text__heading--large text-center">
              <p class="d-inline-block text-center" style="max-width: 700px; font-size: 18px;" id="description-title"> Our groupd or team of developers are composed of <span style="color: #59981A;">Shunn Gerold Villagonza</span>, <span style="color: #59981A;">Jouie Fajardo</span>, <span style="color: #59981A;">James Perez</span> and <span style="color: #59981A;">Mark De Guzman</span>, and we greatly assure you that we will provide the quality of service to you and the other customer that will be interested in our shop. Also our system is working exceptionally well and ready to be deployed.</>
              </p>
            </div><br><br><br>
          </div>
        </div>
      </div>
    </div><br><br>

    <div class="rich-text__heading--large text-center">
      <div class="rich-text__heading--large text-center">
        <h2 id="welcome-title">OUR MISSION</h2>
      </div><br>
      <p class="d-inline-block text-center" style="max-width: 700px; font-size: 18px;" id="description-title">For a few years, My Grocery will became a part of every filipino's online grocery shopping experience. Through the years, My Grocery will still be managing and serving a variety of products with outmost quality and provide safest options for our dear customers.
      </p>
    </div><br><br><br>
  </main>

  <!-- Include Footer -->
  <?php include_once "./footer.php"; ?>
</body>

</html>