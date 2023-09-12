<?php

include_once "mysqli_db.inc.php";
// include autoload file - minimizing the include/require syntaxes for class files
include_once('./auto_load.inc.php');

if (isset($_POST['submit'])) {
    // Grabbing the data
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Instantiate SigninCtrl Class
    $signin = new SigninAdminCtrl($uname, $pwd);

    // Running error handlers and signin
    $signin->signinAdmin();

} elseif(isset($_POST['verify-auth'])) {
    // Grabbing the data
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $uname = null;
    $pwd = null;

    // Instantiate SigninCtrl Class
    $signin = new SigninAdminCtrl($uname, $pwd);

    // Running error handlers and signin
    $signin->adminAuth($code);

} elseif(isset($_POST['update-myaccount'])) {
    // Grabbing the data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

    // Instantiate SigninCtrl Class
    $update_account = new SigninAdminCtrl($username, $pass);

    // Running error handlers and signin
    $update_account->myAccount($email, $cpass);

    // error: none
    header("location: ../admin_side/home.php?updated");

} elseif(isset($_POST['add_account'])) {
    // Grabbing the data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

    // Instantiate SigninCtrl Class
    $add_account = new SigninAdminCtrl($username, $pass);

    // Running error handlers and signin
    $add_account->addAccount($email, $cpass);

    // error: none
    header("location: ../admin_side/home.php?added");

} elseif (isset($_POST['send_notif'])) {
    $username = null;
    $pass = null;
    // Grabbing the data
    $users = mysqli_real_escape_string($conn, $_POST['users']);
    $from = mysqli_real_escape_string($conn, $_POST['from']);
    $content = mysqli_real_escape_string($conn, $_POST['message_content']);

   // Instantiate SigninCtrl Class
   $send_notif = new SigninAdminCtrl($username, $pass);

   // Running error handlers and signin
   $send_notif->sendNotif($users, $from, $content);

   // error: none
   header("location: ../admin_side/home.php?notif");
}