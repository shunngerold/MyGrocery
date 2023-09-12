<?php

class ProfileEditView extends ProfileEdit
{
    // DISPLAY IMAGE IN HOME
    public function dpIcon()
    {
        $result = $this->getInfo();
?>
        <a href="./profile.php">
            <img class="rounded-circle border border-success border-3" src="<?php echo $result[0]['display']; ?>" width="40" height="40">
        </a>
    <?php
    }
    // VIEW DISPLAY PHOTO
    public function viewDPInfo()
    {
        $result = $this->getInfo();

    ?>
        <div class="card-header text-light">Profile Picture</div>
        <div class="card-body text-center" style="padding-left: 16rem; padding-right: 16rem;">
            <!-- Profile picture image-->
            <img class="img-account-profile rounded-circle mb-2" src="<?php echo $result[0]['display']; ?>" width="200" height="200">
            <!-- Profile picture help block-->
            <div class="small font-italic text-muted mb-4">
                <p style="color: #fff;">JPG or PNG no larger than 5 MB</p>
            </div>
            <!-- Profile picture upload button-->
            <div class="input-group mb-3">
                <input type="file" name="image" class="form-control text-light" id="inputGroupFile02" style="background-color:#3D550C;">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
            <div class="alert alert-success" role="alert">
                <b>YOUR ACCOUNT IS VERIFIED!</b> 
            </div>
            <input type="hidden" name="image_path" value="<?php echo $result[0]['display']; ?>">
        </div><br>
    <?php
    }

    // ACCOUNT DETAILS FORM
    public function viewAccDetails()
    {
        $result = $this->getInfo();

    ?>
        <?php
        if (isset($_GET['error'])) {
            $desc = $_GET['error'];
            $stat = "error";
            $btn = "Ok!";
        } elseif (isset($_GET['none'])) {
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
        <!-- Account details card -->
        <div class="card mb-5 mt-3 text-light" style="background-color:#59981A;">
            <div class="card-header">Account Details</div>
            <div class="card-body mb-3" style="padding-left: 2.5rem; padding-right: 2.5rem;">
                <!-- Form Group (username)-->
                <div class="mb-3">
                    <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                    <input disabled class="form-control" name="inputUsername" name type="text" value="<?php echo $result[0]['username']; ?>" placeholder="Enter your username">
                </div>
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (first name)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputFirstName">First name</label>
                        <input class="form-control" name="inputFirstName" type="text" value="<?php echo $result[0]['firstname']; ?>" placeholder="Enter your first name" value="" required>
                    </div>
                    <!-- Form Group (last name)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="inputLastName">Last name</label>
                        <input class="form-control" name="inputLastName" type="text" value="<?php echo $result[0]['lastname']; ?>" placeholder="Enter your last name" value="" required>
                    </div>
                </div>
                <!-- Form Row  -->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (Gender)-->
                    <div class="col-md-6 col-xl-6">
                        <label class="small mb-1" for="inputGender">Gender</label>
                        <input class="form-control" name="inputGender" type="text" placeholder="Enter your Gender" value="<?php echo $result[0]['gender']; ?>" required>
                    </div>
                    <!-- Form Group (civil status)-->
                    <div class="col-md-6 col-xl-6">
                        <label class="small mb-1" for="inputLocation">Civil Status</label>
                        <input class="form-control" name="inputCivilstat" type="text" placeholder="Enter your civil status" value="<?php echo $result[0]['civil_status']; ?>" required>
                    </div>
                </div>
                <!-- Form Group (email address)-->
                <div class="row mb-3">
                    <div class="col-md-6 col-xl-6">
                        <label class="small mb-1" for="inputEmail">Email address</label>
                        <input class="form-control" name="inputEmail" type="email" placeholder="Enter your email address" value="<?php echo $result[0]['email']; ?>" required>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <label class="small mb-1" for="cartnum">Your cart number</label>
                        <input disabled class="form-control" name="cartnum" type="text" value="<?php echo $result[0]['cart_number']; ?>">
                    </div>
                </div>
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (phone number)-->
                    <div class="col-md-6 col-xl-6">
                        <label class="small mb-1" for="inputPhone">Contact number</label>
                        <input class="form-control" name="inputContact" type="tel" placeholder="Enter your contact number" value="<?php echo $result[0]['contact_number']; ?>" required>
                    </div>
                    <!-- Form Group (birthday)-->
                    <div class="col-md-6 col-xl-6">
                        <label class="small mb-1" for="inputBirthday">Birthday</label>
                        <input class="form-control" name="inputBirthday" type="date" name="birthday" placeholder="Enter your birthday" value="<?php echo $result[0]['date_of_birth']; ?>" required>
                    </div>
                </div>
                <!-- Save changes button-->
                <button class="btn btn-primary" type="submit" style="background-color:#3D550C; border: none;" name="submit-acc_detail">Save changes</button>
            </div>
        </div>
    <?php
    }

    // DELIVERY DETAILS
    public function viewDeliveryDetails()
    {
        $result = $this->getInfo();
    ?>
        <?php
        if (isset($_GET['error'])) {
            $desc = $_GET['error'];
            $stat = "error";
            $btn = "Ok!";
        } elseif (isset($_GET['none'])) {
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

        <!-- Form Group (fullname)-->
        <div class="mb-3">
            <label class="small mb-1" for="inputfullname">Full Name (Fill out/Edit this box in account details)</label>
            <input disabled class="form-control" id="inputFullname" type="text" placeholder="" value="<?php echo $result[0]['firstname'] . ' ' . $result[0]['lastname']; ?>">
        </div>
        <!-- Form Row -->
        <div class="row gx-3 mb-3">
            <!-- Form Group (street)-->
            <div class="col-md-6">
                <label class="small mb-1" for="inputstreet">Street Name, House Number</label>
                <input class="form-control" name="inputStreet" type="text" value="<?php echo $result[0]['street']; ?>" required>
            </div>
            <!-- Form Group (barangay)-->
            <div class="col-md-3">
                <label class="small mb-1" for="inputBarangay">Barangay</label>
                <input class="form-control" name="inputBarangay" type="text" value="<?php echo $result[0]['barangay']; ?>" required>
            </div>
            <!-- Form Group (barangay)-->
            <div class="col-md-3">
                <label for="MC" class="small mb-1">City / Municipality</label>
                <input class="form-control" name="inputMC" list="Municipal-city" id="MC" placeholder="Input City / Municipality" value="<?php echo $result[0]['city_municipal']; ?>" required>
                <datalist id="Municipal-city">
                    <?php
                    $location = $this->getLocation();

                    foreach ($location as $MC) {
                    ?>
                        <option value="<?php echo $MC['city_municipal']; ?>">
                        <?php
                    }
                        ?>
                </datalist>
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <!-- Form Group (Region)-->
            <div class="col-md-6">
                <label for="province" class="small mb-1">Your province</label>
                <input class="form-control" name="inputProvince" list="Province" id="province" placeholder="Input Province" value="<?php echo $result[0]['province']; ?>" required>
                <datalist id="Province">
                    <option value="Metro Manila">Manila, Malabon, Caloocan, Navotas, Valenzuela etc.</option>
                    <option value="Bulacan">San Jose Del Monte, Pandi, Angat, Sta. Maria etc.</option>
                </datalist>
            </div>
            <!-- Form Group (Postal Code)-->
            <div class="col-md-6">
                <label for="postal" class="small mb-1">Your zip code</label>
                <input disabled class="form-control" value="<?php echo $result[0]['postal']; ?>">
            </div>
        </div>
        <!-- Form Row-->
        <div class="row gx-3 mb-3">
            <!-- Form Group (phone number)-->
            <div class="col-md-6">
                <label class="small mb-1" for="inputPhone">Phone number (Fill out/Edit this box in account details)</label>
                <input disabled class="form-control" name="inputPhone" type="text" placeholder="Fill out this box in the account details" value="<?php echo $result[0]['contact_number']; ?>" required>
            </div>
        </div>
        <!-- Save changes button-->
        <?php 
            // initiate CartView
            $cart_num = new CartView();
        ?>
        <button class="btn btn-primary" type="submit" style="background-color:#3D550C; border: none;" name="submit-delivery">Save changes</button>
        <?php
            if ($cart_num->cartnum() == 0) {
            ?>
                <a href="../cart.php?checkout=404" class="btn btn-success text-light col-4 disabled">
                    <i class="bi-cart3"></i> Checkout
                </a>
            <?php
            } elseif ($cart_num->countValueKM_deliveryfee() == 0) {
            ?>
                <a href="../user_edit_profile/profile.php?null" class="btn btn-success text-light col-4">
                    <i class="bi-cart3"></i> Checkout
                </a>
            <?php
            } else {
            ?>
                <a href="../checkout.php" class="btn btn-success text-light col-4">
                    <i class="bi-cart3"></i> Checkout
                </a>
            <?php
            }
        ?>
        <?php
    }

    // CHECKOUT FORM
    public function viewcheckout()
    {
        $result = $this->getInfo();
        ?>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Choose mode of payment</h4>
                <p class="lead">Other payment methods are currently not supported.</p>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="credit">Cash On Delivery</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required disabled>
                        <label class="custom-control-label" for="debit" muted disabled>Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required disabled>
                        <label class="custom-control-label" for="paypal" muted disabled>PayPal</label>
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Delivery and Shipping address</h4>
                <form method="POST" action="./includes/c_checkout.inc.php">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold" for="firstName">First name</label>
                            <p class="mt-2" style="font-size: 1.3rem;"><?php echo $result[0]['firstname']; ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold" for="lastName">Last name</label>
                            <p class="mt-2" style="font-size: 1.3rem;"><?php echo $result[0]['lastname']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold" for="address">Address</label>
                            <p class="mt-2" style="font-size: 1.3rem;"><?php echo ucwords($result[0]['street']) . ', ' . ucwords($result[0]['barangay']) . ', ' . ucwords($result[0]['city_municipal']) . ', ' . ucwords($result[0]['province']); ?></p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold" for="zip">Postal Code</label>
                            <p class="mt-2" style="font-size: 1.3rem;"><?php echo $result[0]['postal']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="./user_edit_profile/delivery.php" class="btn btn-md btn-block mt-4 text-light" style="background: #3D550C; border: none !important">Edit Billing Address</a>
                        </div>
                    </div>
                    <div class="justify-content-end">
                        <hr class="mb-4">
                        <button class="btn btn-lg btn-block text-light" name="confirm_pay" type="submit" style="background: #3D550C; border: none !important">
                            Confirm Payment
                        </button>
                        <a href="./cart.php" class="btn btn-lg btn-block btn-warning">Back to Cart</a>
                    </div>
                </form>
            </div>
    <?php
    }

    // Show auth value
    public function showAuthVal() 
    {
        return $this->getAuthVal();
    }
}
