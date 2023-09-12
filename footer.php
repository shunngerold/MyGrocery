<!-- Footer -->
<footer class="page-footer text-light font-small pt-4 mt-5 border-top" style="background-color: #59981A;">
  <div class="container-fluid text-center text-md-left mt-3">
    <div class="row">
      <div class="col-md-6 mt-md-0 mt-3 text-center">
        <?php 
          $file = "./assets/images/icon-company.PNG";

          if(file_exists($file)) {
            $path = "./assets/images/icon-company.PNG";
          } else {
            $path = "../assets/images/icon-company.PNG";
          }
        ?>
        <!-- Content -->
        <img class="bi me-2" width="280" height="65" src="<?php echo $path; ?>">
        <p class="lead text-light">Our grocery is always there for you.</p><br>

        <div class=" text-center">
          <h2 id="welcome-title" style="text-decoration: none; color: #ECF87F;">CONTACT US @</h2><br>
        </div>

				<ul class="nav col-md-12 row-cols-4" style="font-size: 30px;">
					<li class="nav-item "><a href="" class="nav-link"><i class="bi bi-facebook text-light"></i></a></li>
					<li class="nav-item "><a href="" class="nav-link"><i class="bi bi-twitter text-light"></i></a></li>
					<li class="nav-item "><a href="" class="nav-link"><i class="bi bi-instagram text-light"></i></a></li>
          <li class="nav-item "><a href="" class="nav-link"><i class="bi bi-google text-light"></i></a></li>
      	</ul>  
      </div>           

      <hr class="clearfix w-100 d-md-none pb-3">
      
			<div class="col-md-3">
        <h5 class="text-uppercase" id="welcome-title" style="text-decoration: none; color: #ECF87F;">List of Products</h5>
        <ul class="list-unstyled">
          <li>
            <a class="text-light" href="./products.php?All_Products" style="font-size: 18px;">All Products</a>
          </li>
          <li>
            <a class="text-light" href="./products.php?category=canned products" style="font-size: 18px;">Canned Products</a>
          </li>
          <li>
            <a class="text-light" href="./products.php?category=breads and spreads" style="font-size: 18px;">Breads & Spreads</a>
          </li>
          <li>
            <a class="text-light" href="./products.php?category=snacks and chips" style="font-size: 18px;">Snacks & Chips</a>
          </li>
          <li>
            <a class="text-light" href="./products.php?category=packed noodles" style="font-size: 18px;">Packed Noodles</a>
          </li>
          <li>
            <a class="text-light" href="./products.php?category=meats and poultry" style="font-size: 18px;">Meats and Poultry</a>
          </li>
          <li>
            <a class="text-light" href="./products.php?category=fresh fruits and veggies" style="font-size: 18px;">Fruits & Veggies</a>
          </li>
        </ul>
      </div>

      <div class="col-md-3">
        <h5 class="text-uppercase" id="welcome-title" style="text-decoration: none; color: #ECF87F;">FAQ's About</h5>
        <ul class="list-unstyled">
          <li>
            <a class="text-light" href="./faqs.php" style="font-size: 18px;">Profile/Account</a>
          </li>
          <li>
            <a class="text-light" href="./faqs.php" style="font-size: 18px;">Add to Cart</a>
          </li>
          <li>
            <a class="text-light" href="./faqs.php" style="font-size: 18px;">Transactions</a>
          </li>
          <li>
            <a class="text-light" href="./faqs.php" style="font-size: 18px;">General Help</a>
          </li>
        </ul>
      </div>

  <!-- Copyright -->
  <div class="footer-copyright mt-3 border-top text-center py-3">© 2022 Copyright:
    <a class="text-light" href="#">MyGrocery.com.ph</a>
  </div>
</footer>