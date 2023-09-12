<?php

include_once "mysqli_db.inc.php";

if (isset($_POST['submit'])) {
    // Grabbing the data
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $pwdRepeat = mysqli_real_escape_string($conn, $_POST['pwdRepeat']);
    // image defaults
    $defaultf = "../assets/images/customers_dp/default-female.png";
    $defaultm = "../assets/images/customers_dp/default-male.jpeg";

    // Instantiate SignupCtrl Class
    include_once('./auto_load.inc.php'); // include autoload file - minimizing the include/require syntaxes for class files
    $signup = new SignupCtrl($uname, $email, $gender, $pwd, $pwdRepeat, $defaultf, $defaultm);

    // Running error handlers and signup
    $signup->signupUser();
}
