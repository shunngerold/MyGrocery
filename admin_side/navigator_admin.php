<!-- Account page navigation-->
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" id="manage" href="./home.php">
                        <i class="bi-person-badge" id="navicons"></i>
                        Manage Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="delivery" href="./manage_delivery.php">
                        <i class="bi-truck" id="navicons"></i>
                        Manage Delivery
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="delivery" href="./canceled_order.php">
                        <i class="bi-bag-x" id="navicons"></i>
                        Canceled Orders
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav me-4 mb-2 mb-md-0">
                <li class="nav-item me-2">
                    <!-- Notification Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#notifCustomer">
                        <i class="bi-bell" id="navicons"></i> Notif Customers
                    </button>
                </li>
                <li class="nav-item">
                    <!-- My Account Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#myaccountModal">
                        <i class="bi-person-circle" id="navicons"></i> My Account
                    </button>
                </li>
                <li class="nav-item">
                    <a class="fs-4 mt-3 text-light" href="../logout.php">
                        <i class="bi-box-arrow-right" id="navicons"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- POP-UP MY ACCOUNT MODAL -->
<div class="modal fade" id="myaccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ECF87F;">
            <div class="modal-header">
                <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                <h5 class="modal-title" id="logoutModalLabel">My Account | MyGrocery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- border head -->
            <span class="border border-secondary"></span>
            <div class="mt-1 text-center">
                <button type="button" class="form-control btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#addAdmin">
                    <i class="bi bi-person-circle" style="font-size: 20px;"></i>
                    <span>Add New Admin </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card text-center">
                    <div class="card-header bg-success text-light">
                        Edit Account Details
                    </div>
                    <div class="card-body">
                        <form action="../includes/a_signin.inc.php" method="POST" class="mb-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- username -->
                                    <label class="mt-1" for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                    <!-- email -->
                                    <label class="mt-1" for="username">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                    <!-- password -->
                                    <label class="mt-1" for="username">Password</label>
                                    <input type="password" class="form-control" name="pass" id="myInput" required>
                                    <!-- confirm password -->
                                    <label class="mt-1" for="username">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpass" id="cpass" required>
                                    <!-- button -->
                                    <div class="mt-1">
                                        <button name="update-myaccount" class="btn btn-lg btn-success mt-3"
                                            type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-center mt-2">
                    <div class="card-header bg-success text-light">
                        Security: Two-factor verification
                    </div>
                    <div class="card-body">
                        <div class="mt-3">
                            <p>We will ask for a login code each time you login to our system. This code will be sent to
                                the account registered in our company.</p>
                            <label for="auth-btn" class="mt-2">Current Status : Is always ON</label>
                            <a class="btn btn-lg btn-warning form-control disabled"><b>On</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add New Admin Modal HTML -->
<div id="addAdmin" class="modal fade" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../includes/a_signin.inc.php" method="POST">
                <div class="modal-content" style="background-color: #ECF87F;">
                    <div class="modal-header">
                        <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                        <p class="modal-title fs-5" id="addModalLabel">Add New Admin | MyGrocery
                        </p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- border head -->
                    <div class="modal-body">
                        <div class="card text-center">
                            <div class="card-header bg-success text-light">
                                Admin Account Details
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- username -->
                                        <label class="mt-1" for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            required>
                                        <!-- email -->
                                        <label class="mt-1" for="username">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                        <!-- password -->
                                        <label class="mt-1" for="username">Password</label>
                                        <input type="password" class="form-control" name="pass" id="myInput"
                                            required>
                                        <!-- confirm password -->
                                        <label class="mt-1" for="username">Confirm Password</label>
                                        <input type="password" class="form-control" name="cpass" id="cpass"
                                            required>
                                        <!-- button -->
                                        <div class="mt-1">
                                            <button name="add_account" class="btn btn-lg btn-success mt-3"
                                                type="submit">Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Notif Customers Admin Modal HTML -->
<div id="notifCustomer" class="modal fade" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../includes/a_signin.inc.php" method="POST">
                <div class="modal-content" style="background-color: #ECF87F;">
                    <div class="modal-header">
                        <img class="bi me-2" width="40" height="43" src="../assets/images/logo.png">
                        <p class="modal-title fs-5" id="addModalLabel">Notif Customers | MyGrocery
                        </p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- border head -->
                    <div class="modal-body">
                        <div class="card text-center">
                            <div class="card-header bg-success text-light">
                                Notification Details
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                            // include autoload file - minimizing the include/require syntaxes for class files
                                            include_once('../includes/auto_load.inc.php'); 
                                            $users = new CartView();
                                        ?>
                                        <!-- users -->
                                        <label class="mt-3" for="users">Usernames</label>
                                        <input class="form-control" name="users" list="user_list" id="user" placeholder="Input username or customers" value="customers" required>
                                        <datalist id="user_list">
                                                <option value="customers">Send to all</option>
                                                <?php
                                                    foreach ($users->viewgetUsers()->fetchAll() as $user_data) {
                                                ?>
                                                    <option value="<?php echo $user_data['username']; ?>">
                                                <?php
                                                }
                                                ?>
                                        </datalist>
                                        <!-- message from -->
                                        <label class="mt-2" for="msg_from">Message From</label>
                                        <input type="text" class="form-control" name="from" id="msg_from" value="<?php echo $_SESSION['admin_id']; ?>" readonly>
                                        <!-- message Radio Buttons-->
                                        <label class="mt-3">Message content</label>
                                        <textarea class="form-control" name="message_content" id="content" cols="30" rows="10" required></textarea>
                                        <div class="mt-1">
                                            <button name="send_notif" class="btn btn-lg btn-success mt-3"
                                                type="submit">Send Notification
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>