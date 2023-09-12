<?php

include_once "mysqli_db.inc.php";
// include autoload file - minimizing the include/require syntaxes for class files
include_once('./auto_load.inc.php'); 

if (isset($_POST['submit'])) {
    // Grabbing the data
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Instantiate SigninCtrl Class
    $signin = new SigninCtrl($uname, $pwd);

    // Running error handlers and signin
    $signin->signinUser();

} elseif (isset($_POST['verify-auth'])) {
    // Grab the POST data
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    // fill the constructor variables
    $uname = null;
    $pwd = null;

    // Instantiate SigninCtrl Class
    $signin = new SigninCtrl($uname, $pwd);

    // Running error handlers and authentication
    $signin->userAuth($code);

} elseif (isset($_POST['verify-email'])) {
    // Grab the POST data
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    // fill the constructor variables
    $uname = null;
    $pwd = null;

    // Instantiate SigninCtrl Class
    $signin = new SigninCtrl($uname, $pwd);

    // Running error handlers and authentication
    $signin->userVerifyEmail($code) ;

} elseif (isset($_GET['send-auth'])) {
    // Random code : 6-digit
    $body = "Your MyGrocery verification code <br/> is:";
    $code1 = rand(10, 20);
    $code2 = rand(10, 20);
    $code3 = rand(10, 20);
    $full_code = $code1 . $code2 . $code3;
    $sub = "Two Factor Verification Email";

    // fill the constructor variables
    $uname = null;
    $pwd = null;

    // Instantiate SigninCtrl Class
    $signin = new SigninCtrl($uname, $pwd);

    // Running error handlers and authentication
    $signin->reSendAuth($body, $full_code, $sub);

    // error: none
    header('location: ../authentication.php?resend');
} 
