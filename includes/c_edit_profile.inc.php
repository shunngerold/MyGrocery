<?php
// include mysqli database
include_once "./mysqli_db.inc.php";
include_once('./auto_load.inc.php'); // include autoload file - minimizing the include/require syntaxes for class files

// if account details is set
if (isset($_POST['submit-acc_detail']) && isset($_FILES['image'])) {
    // Setting Variables With Escape String
    $inputEmail = mysqli_real_escape_string($conn, $_POST['inputEmail']);
    $inputFirstName = mysqli_real_escape_string($conn, $_POST['inputFirstName']);
    $inputLastName = mysqli_real_escape_string($conn, $_POST['inputLastName']);
    $inputGender = mysqli_real_escape_string($conn, $_POST['inputGender']);
    $inputBirthday = mysqli_real_escape_string($conn, $_POST['inputBirthday']);
    $inputCivilstat = mysqli_real_escape_string($conn, $_POST['inputCivilstat']);
    $inputContact = mysqli_real_escape_string($conn, $_POST['inputContact']);
    $image_path = mysqli_real_escape_string($conn, $_POST['image_path']);

    // Instantiate ProfileEditCtrl Class
    $AccDetails = new ProfileEditCtrl(
        $inputEmail,
        $inputFirstName,
        $inputLastName,
        $inputGender,
        $inputBirthday,
        $inputCivilstat,
        $inputContact,
        $image_path
    );

    // Running error handlers and Account details
    $AccDetails->editCustomer();

    // back to home page - error: none
    header('location: ../user_edit_profile/profile.php?none');

    // if delivery details is set
} elseif (isset($_POST['submit-delivery'])) {
    // Setting Variables With Escape String
    $inputStreet = mysqli_real_escape_string($conn, $_POST['inputStreet']);
    $inputBarangay = mysqli_real_escape_string($conn, $_POST['inputBarangay']);
    $inputMC = mysqli_real_escape_string($conn, $_POST['inputMC']);
    $inputProvince = mysqli_real_escape_string($conn, $_POST['inputProvince']);

    // Instantiate ProfileEditCtrl Class
    $DeliveryDetails = new DeliveryCtrl(
        $inputStreet,
        $inputBarangay,
        $inputMC,
        $inputProvince
    );

    // Running error handlers and Delivery Details
    $DeliveryDetails->editDelivery();

    // back to home page - error: none
    header('location: ../user_edit_profile/delivery.php?none');

    // if security detail is set
} elseif (isset($_POST['submit_security'])) {
    // Setting Variables With Escape String
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // Instantiate ProfileEditCtrl Class
    $security = new SecurityCtrl(
        $currentPassword,
        $newPassword,
        $confirmPassword
    );

    // Running error handlers and Security Details
    $security->updateSecurity();

    // back to home page - error: none
    header('location: ../user_edit_profile/security.php?none');
} elseif (isset($_GET['auth'])) {
    // get username
    $auth_val = mysqli_real_escape_string($conn, $_GET['auth']);
    // Controller val
    $currentPassword = null;
    $newPassword = null;
    $confirmPassword = null;

    // Instantiate ProfileEditCtrl Class
    $security = new SecurityCtrl(
        $currentPassword,
        $newPassword,
        $confirmPassword
    );
    
    // Run Auth value
    $security->setAuthVal($auth_val);

    // error none -> back to security page
    echo "<script> window.history.go(-1); </script>";
}
