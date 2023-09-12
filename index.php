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
  <title>Home | MyGrocery</title>
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
            <h2 id="welcome-title">MY GROCERY | ONLINE SHOPPING EXPERIENCE</h2>
          </div><br>

          <div class="rich-text__heading--large text-center">
            <p class="d-inline-block text-center" style="max-width: 700px; font-size: 18px;" id="description-title"><strong>Welcome to</strong>&nbsp;<strong><span style="color: #59981A;">My Grocery</span>.&nbsp;</strong> This is our group's main thesis application proposal. This is an online grocery application that offers a variety of different products that are locally available for customer's needs. We have a broad selection of products of

              <!-- Palagay ng mga links papasok sa mga products -->
              <a id="product-links" href="./products.php?category=canned products">Canned Products</a>,
              <a id="product-links" href="./products.php?category=breads and spreads">Breads & Spreads</a>,
              <a id="product-links" href="./products.php?category=snacks and chips">Snacks & Chips</a>,
              <a id="product-links" href="./products.php?category=packed noodles">Packed Noodles</a><em>,</em>&nbsp;
              <a id="product-links" href="./products.php?category=meats and poultry">Meats & Poultry</a> and
              <a id="product-links" href="./products.php?category=fresh fruits and veggies">Fruits & Veggies</a>.&nbsp;<br /><br />

            <div class="rich-text__heading--large text-center">
              <h6 id="products-selection" style="font-size: 22px;">DELIVERY OPTION: </h6>
            </div><br>
            <p class="d-inline-block text-center" style="max-width: 700px; font-size: 18px;" id="description-title">We only offer <span style="color: #59981A;">Cash on Delivery</span> form of payment on the time being. The delivery fee is not yet settled for now.</p>
          </div>
        </div>
      </div>
    </div><br><br>

    <!-- PRODUCT SELECTION -->
    <div class="rich-text__heading--large text-center">
      <h2 id="products-selection">AVAILABLE PRODUCTS</h2>
    </div><br>

    <div class="container">
      <div class="row row-cols-3 row-cols-sm-3 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
        <div class="col mb-4">
          <div class="card">
            <a href="./products.php?category=canned products">
              <img src="//st.depositphotos.com/2075661/4508/i/950/depositphotos_45081567-stock-photo-canned-food.jpg" class="card-img-top" id="card">
              <div class="centered h3 text-light">CANNED GOODS</div>
            </a>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card">
            <a href="./products.php?category=breads and spreads">
              <img src="//media.gettyimages.com/photos/chocolate-and-hazelnut-spread-on-bread-slices-shot-on-rustic-wooden-picture-id815870712?k=20&m=815870712&s=612x612&w=0&h=odkZP9qPOBFNtnRN_Z38lrvQ4BFxoMLLTI_G599G65A=" class="card-img-top" id="card">
              <div class="centered h3 text-light">BREADS & SPREADS</div>
            </a>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card">
            <a href="./products.php?category=snacks and chips">
              <img src="//media.istockphoto.com/photos/salty-snacks-picture-id478815753?k=20&m=478815753&s=612x612&w=0&h=fBpfqyP-4ddG9tGyDVLmm4614zKfxxbeKioJqwP1qAY=" class="card-img-top" id="card">
              <div class="centered h3 text-light">SNACKS & CHIPS</div>
            </a>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card">
            <a href="./products.php?category=packed noodles">
              <img src="//media.istockphoto.com/photos/various-products-from-asian-grocery-picture-id1276555001?k=20&m=1276555001&s=612x612&w=0&h=TXNVvs0z7smjgQWi4mferkQOoLvZICL0x26kFEdc2mU=" class="card-img-top" id="card">
              <div class="centered h3 text-light">NOODLES</div>
            </a>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card">
            <a href="./products.php?category=meats and poultry">
              <img src="//cdn.shopify.com/s/files/1/0264/3420/7802/collections/AdobeStock_175165460_900x.jpg?" class="card-img-top" id="card">
              <div class="centered h3 text-light">MEATS AND POULTRY</div>
            </a>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card">
            <a href="./products.php?category=fresh fruits and veggies">
              <img src="//cdn.shopify.com/s/files/1/0264/3420/7802/collections/vegetables_540x.jpg?v=1591006873" class="card-img-top" id="card">
              <div class="centered h3 text-light">FRUITS & VEGGIES</div>
            </a>
          </div>
        </div>
      </div>
    </div><br><br><br>
    <!-- /.container -->

    <!--- OTHER INFO --->
    <div class="rich-text__heading--large text-center">
      <h2 id="welcome-title">MY GROCERY | ONLINE SHOPPING EXPERIENCE</h2>
    </div><br>

    <div class="rich-text__heading--large text-center">
      <p class="d-inline-block text-center" style="max-width: 700px; font-size: 18px;" id="description-title"> Here at My Grocery, we offer great quality services for our dear customers. This Online Grocery or E-Commerce application was created by our team of developers and designers consisting of <span style="color: #59981A;">Shunn Gerold Villagonza</span>, <span style="color: #59981A;">Jouie Fajardo</span>, <span style="color: #59981A;">James Perez</span> and <span style="color: #59981A;">Mark De Guzman</span>. You can easily navigate through out the system with ease, also you can browse and search your desired products and add them to cart for later purchases.
      </p>
    </div><br><br><br>

    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark" id="hero">
      <div class="col-md-6 px-0">
        <h1 class="display-4" style="font-weight: bolder;">Our Mission</h1>
        <p class="lead my-3">Our mission is to provide the customers a unique experience of shopping online with great ease and assurance, worry-free environment also securring their own safety by staying at home amidst the pandemic.</p>
        <p class="lead mb-0"><a href="./products.php?All_Products" class="text-white fw-bold">See Our Products</a></p>
      </div>
    </div>
  </main>

  <!-- Include Footer -->
  <?php include_once "./footer.php"; ?>
</body>

</html>