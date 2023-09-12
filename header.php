<header>
    <nav class="navbar navbar-expand-xl navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
                style="font-size: 8px; color: #ECF87F;">
                <span class="navbar-toggler-icon" style="font-size: 12px; color: #ECF87F;"></span>
            </button>
            <a href="./index.php" class="navbar-brand">
                <img class="bi me-2" width="280" height="65" src="./assets/images/icon-company.PNG">
            </a>
            <!-- Search Button trigger modal -->
            <button style="margin-right: 5px;" type="button" class="btn" data-bs-toggle="modal"
                data-bs-target="#searchModal">
                <i class="bi-search" id="navicons" style="font-size: 1.4rem; color: white;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a href="./index.php" class="btn position-relative">
                            <i class="bi-house-door" id="navicons"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-box" id="navicons"></i>
                            Products
                        </a>
                        <div class="dropdown-menu bg-success" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="./products.php?All_Products">All Products</a>
                            <a class="dropdown-item" href="./products.php?category=canned products">Canned Products</a>
                            <a class="dropdown-item" href="./products.php?category=breads and spreads">Breads &
                                Spreads</a>
                            <a class="dropdown-item" href="./products.php?category=snacks and chips">Snacks & Chips</a>
                            <a class="dropdown-item" href="./products.php?category=packed noodles">Packed Noodles</a>
                            <a class="dropdown-item" href="./products.php?category=meats and poultry">Meats and
                                Poultry</a>
                            <a class="dropdown-item" href="./products.php?category=fresh fruits and veggies">Fruits &
                                Veggies</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="./faqs.php" class="btn position-relative">
                            FAQs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="btn position-relative">
                            <i class="bi-info-circle" id="navicons"></i>
                            About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="btn position-relative">
                            <i class="bi-envelope" id="navicons"></i>
                            Contact Us
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php
                        include_once "./includes/auto_load.inc.php";
                        // initiate CartView
                        $cart_num = new CartView();
                    ?>
                    <!-- Notification -->
                    <?php
                        $notif;
                        if (isset($_SESSION['user_id'])) {
                           ?>
                            <button type="button" class="btn position-relative mb-1" data-bs-toggle="modal"
                            data-bs-target="#notifModal">
                            <i class="bi-bell-fill" id="navicons" style="font-size: 1.6rem; color: white;"></i>
                            <?php 
                                if(!$cart_num->viewgetNotif()->rowCount() == 0) {
                                    ?>
                                    <span class="position-absolute mt-3 top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php
                                        // take out the counted products inside the cart 
                                        echo $cart_num->viewgetNotif()->rowCount();
                                        ?>
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                <?php
                            }
                            ?>
                            </button>
                            <?php
                        } else {
                            ?>
                                <a href="./signin.php" class="btn position-relative">
                                    <i class="bi-bell-fill" id="navicons" style="font-size: 1.6rem; color: white;"></i>
                                </a>
                            <?php
                        }
                    ?>
                    <!-- SHOPPING CART -->
                    <?php
                    $cart;
                    if (isset($_SESSION['user_id'])) {
                        $cart = "./cart.php";
                    } else {
                        $cart = "./signin.php";
                    }
                    ?>
                    <a href="<?php echo $cart; ?>" class="btn position-relative">
                        <i class="bi-cart3" id="navicons" style="font-size: 1.6rem; color: white;"></i>
                        <?php 
                        if(!$cart_num->cartNum() == 0) {
                            ?>
                            <span
                            class="position-absolute mt-3 top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php
                            // take out the counted products inside the cart 
                            echo $cart_num->cartNum();
                            ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                        <?php
                        }
                    ?>
                    </a>
                    <?php
          // PROFILE BUTTON
          if (isset($_SESSION['user_id'])) {
          ?>
                    <a href="./user_edit_profile/profile.php" class="btn">
                        <i class="bi-person-check-fill" id="navicons" style="font-size: 1.8rem; color: white;"></i>
                    </a>
                    <?php
          } else {
          ?>
                    <a href="./signin.php" class="btn" class="btn">
                        <i class="bi-person-fill" id="navicons" style="font-size: 1.8rem; color: white;"></i>
                    </a>
                    <?php
          }
          ?>
                </div>
                <!-- Logout Button | Signin Button -->
                <?php
        if (isset($_SESSION['user_id'])) {
        ?>
                <!-- Logout Button trigger modal -->
                <button style="margin-right: 10px;" type="button" class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#logoutModal">
                    <i class="bi bi-door-closed" style="font-size: 20px;"></i> Logout
                </button>
                <?php
        } else {
        ?>
                <a href="./signin.php" class="btn btn-warning me-2">
                    <i class="bi bi-door-open" style="font-size: 20px;"></i> SignIn
                </a>
                <?php
        }
        ?>
            </div>
        </div>
        </div>
    </nav>
</header>
<!-- POP-UP LOGOUT MODAL -->
<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ECF87F;">
            <div class="modal-header">
                <img class="bi me-2" width="40" height="43" src="./assets/images/logo.png">
                <h5 class="modal-title" id="logoutModalLabel">Logout | MyGrocery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- border head -->
            <span class="border border-secondary"></span>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn text-light" style="background-color: #3D550C;"
                    data-bs-dismiss="modal">Continue Shopping</button>
                <a href="./logout.php" class="btn btn-danger">Yes, I want to logout!</a>
            </div>
        </div>
    </div>
</div>
<!-- POP-UP SEARCH MODAL -->
<div class="modal fade" id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="searchtModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ECF87F;">
            <div class="modal-header">
                <img class="bi me-2" width="40" height="43" src="./assets/images/logo.png">
                <h5 class="modal-title" id="searchModalLabel">Search | MyGrocery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- border head -->
            <span class="border border-secondary"></span>
            <div class="modal-body">
                <form id="searchProd" method="GET">
                    <input type="text" name="search" class="form-control" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-light" data-bs-dismiss="modal">Continue
                    Shopping</button>
                <button type="submit" form="searchProd" class="btn text-light" style="background-color: #3D550C;">
                    Search
                </button>
            </div>
        </div>
    </div>
</div>
<!-- POP-UP NOTIF MODAL -->
<div class="modal fade" id="notifModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="notifModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ECF87F;">
            <div class="modal-header">
                <img class="bi me-2" width="40" height="43" src="./assets/images/logo.png">
                <h5 class="modal-title" id="notifModalLabel">Notification | MyGrocery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- border head -->
            <span class="border border-secondary"></span>
            <div class="modal-body">
                <?php 
                    if(isset($_SESSION['user_id'])) {
                        if($cart_num->viewgetNotif()->rowCount() == 0) {
                        ?>
                            <center>
                                <p class="fw-bold">
                                    <i class="bi-bell-slash-fill"></i> NO NOTIFICATION
                                </p>
                            </center>
                        <?php
                        } else {
                            ?>
                            <ul class="list-group mb-3" style="height: 26rem; overflow-y: scroll;">
                            <?php
                            foreach ($cart_num->viewgetNotif()->fetchAll() as $notif_data) {
                            ?>
                                <li class="list-group-item d-flex lh-condensed">
                                    <a href="" class="btn position-relative">
                                        <img src="./assets/images/admin.jpg" width="50" height="50" class="border border-dark border-1 rounded-circle" alt="Image">
                                    </a>
                                    <div class="container">
                                        <h6 class="text-dark mt-2 fw-border"><?php echo "From: " . $notif_data['msg_from'] . " - Admin" ?></h6>
                                        <p class="text-muted"><?php echo $notif_data['message']; ?></p>
                                    </div>
                                    <div class="justify-content-end mt-3">
                                        <span style="margin-right: 10px;" class="text-muted"><?php echo $notif_data['date_issued']; ?></span>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>
                            <?php
                        }
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-light" data-bs-dismiss="modal">Continue
                    Shopping</button>
            </div>
        </div>
    </div>
</div>