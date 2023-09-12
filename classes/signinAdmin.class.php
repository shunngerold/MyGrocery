<?php

// check if session is set
if (isset($_SESSION)) {
    session_write_close();
} else {
    session_start();
}

class SigninAdmin extends DbHandler
{
    // validating admin info to the database
    protected function getAdmin($uname, $pwd)
    {
        $sql = 'SELECT `password` FROM `users` WHERE `username` = ? OR `email` = ?;';
        $stmt = $this->connect()->prepare($sql);

        // If the sql statement fails
        if (!$stmt->execute(array($uname, $uname))) {
            $stmt = null;
            $err = "Statement Failed!";
            header("location: ../admin_side/signin.php?error=" . $err . "");
            exit();
        }

        // If the admin does not exist
        if ($stmt->rowcount() == 0) {
            $stmt = null;
            $err = "User Not Found!";
            header("location: ../admin_side/signin.php?error=" . $err . "");
            exit();
        }

        // hashed password
        $pwdHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Check if password is valid
        $pwdCheck = password_verify($pwd, $pwdHash[0]['password']);

        if ($pwdCheck == false) {
            $stmt = null;
            $err = "Invalid Password!";
            header("location: ../admin_side/signin.php?error=" . $err . "");
            exit();
        } elseif ($pwdCheck == true) {
            $AdminCredentials = $this->getUserCredentials($uname, $pwd);

            // If the admin does not exist
            if ($AdminCredentials->rowcount() == 0) {
                $stmt = null;
                $err = "Admin Not Found!";
                header("location: ../admin_side/signin.php?error=" . $err . "");
                exit();
            }

            // fetch all data
            $admin = $AdminCredentials->fetchAll(PDO::FETCH_ASSOC);

            // user attempt variable
            $_SESSION['attempt'] += 1;
            // session_unset();

            if($admin[0]['auth'] == 1) {
                // if user have 3 attempts
                if($_SESSION['attempt'] > 3) {
                    $stmt = null;
                    
                    // set body content
                    date_default_timezone_set('Asia/Manila');
                    $date = date("Y-m-d h:i:s a", time()) . "<br/>";
                    $code = 0;
                    $reset_message = "<br/> Your verification code is reset: ";
                    $body = "WARNING!!! your account has been opened three times. Check your account!<br/><br/>" . $date . $reset_message;
                    
                    // Send Warning message
                    if($this->sendCode($body, $code) == false) {
                        exit();
                    }

                    $err = "You have reached your login limit!";
                    header("location: ../admin_side/signin.php?error=" . $err . "");
                    exit();

                } else {
                    // set auth id and email
                    $_SESSION['auth_id'] = $admin[0]['username'];
                    $_SESSION['auth_email'] = $admin[0]['email'];
                    // echo $_SESSION['auth_email'];

                    // Random code : 6-digit
                    $code1 = rand(10, 20);
                    $code2 = rand(10, 20);
                    $code3 = rand(10, 20);
                    $full_code = $code1 . $code2 . $code3;
                    $body = "Your MyGrocery verification code <br/> is:";

                    // Send code to the user's email
                    if($this->sendCode($body, $full_code) == false) {
                        exit();
                    } 

                    // path for authentication page
                    header('location: ../admin_side/auth_verify.php');
                }
            } else {
                // user filter
                if ($admin[0]['role'] == "admin") {
                    $_SESSION['admin_id'] = $admin[0]['username'];
                    header('location: ../admin_side/home.php');

                } elseif ($admin[0]['role'] == "user") {
                    $stmt = null;
                    header("location: ../index.php");
                    exit();
                }
            }
        }
    }

    // get user credentials
    protected function getUserCredentials($uname, $pwd) {
        $sql = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ? AND `password` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($uname, $uname, $pwd))) {
            $stmt = null;
            $err = "Statement Failed!";
            header("location: ../signin.php?error=" . $err . "");
            exit();
        }

        return $stmt;
    }

    // set auth code
    protected function setCode($code, $username) {
        $sql = "UPDATE `users` SET `code` = ? WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($code, $username))) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    // send code 
    protected function sendCode($body, $code) {
        
        require("../includes/PHPMailer/src/PHPMailer.php");
        require("../includes/PHPMailer/src/SMTP.php");

        // Set verification code in user account
        if($this->setCode($code, $_SESSION['auth_id']) != false) {
            $mailTo = $_SESSION['auth_email'];

            $mail = new PHPMailer\PHPMailer\PHPMailer();

            // $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host = "mail.smtp2go.com";
            // Authentication : user credentials
            $mail->SMTPAuth = true;
            $mail->Username = "sansan_coder";
            $mail->Password = "sansan123456";
            // encrypt
            $mail->SMTPSecure = "tls";
            // server port
            $mail->Port = "2525";
            // email from info
            $mail->From = "mygroceryalert@gmail.com";
            $mail->FromName = "MyGrocery | Admin Security Alert";

            $mail->addAddress($mailTo, "Security Alert");
            $mail->isHTML(true);
            $mail->Subject = "Two Factor Verification Email";
            $mail->Body = $body . $code;
            $mail->AltBody = "This is the plain text version of the email content body";

            if(!$mail->send()) {
                $result = false; 
            } else {
                $result = true;
            }
        } else {
            $result = false;
        }

        return $result;
    }

    // ##########################################################################
    // Two-Factor Verification
    protected function adminVerify($code) {
        // admin credentials
        $sql = "SELECT * FROM `users` WHERE `username` = ? AND `code` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($_SESSION['auth_id'], $code))) {
            $stmt = null;
            $err = "Statement Failed!";
            header("location: ../signin.php?error=" . $err . "");
            exit();
        }

        // check if the code is correct
        if($stmt->rowCount() == 0) {
            $stmt = null;
            // Sesseion attempt filter
            if(isset($_SESSION['attempt'])) {
                if($_SESSION['attempt'] <= 1) {
                    $att = 1;
                } else {
                    $att = $_SESSION['attempt'];
                }
            }
            // message and back to signin page
            $err = "Verification failed! that's ".$att." attempt(s).";
            header("location: ../admin_side/signin.php?error=" . $err . "");
            exit();
        } else {
            // code verified - user logged in
            $_SESSION['admin_id'] = $_SESSION['auth_id'];
            unset($_SESSION['auth_id']);
            header("location: ../admin_side/home.php");
        }
    }

    // update admin account
    protected function setMyAccount($uname, $pass, $email) {
        $sql = "UPDATE `users` SET `username` = ?, `password` = ?, `email` = ? WHERE `role` = ?";
        $stmt = $this->connect()->prepare($sql);

        // Hashing password
        $pwdHash = password_hash($pass, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uname, $pwdHash, $email, 'admin'))) {
            $stmt = null;
            $err = "Statement Failed!";
            header("location: ../admin_side/home.php?error=" . $err . "");
            exit();
        }
    }

    // update admin account
    protected function addAdminAccount($uname, $pass, $email) {
        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `role`, `auth`, `verify_email`, `code`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        // Hashing password
        $pwdHash = password_hash($pass, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($uname, $email, $pwdHash, 'admin', 1, 1, 0))) {
            $stmt = null;
            $err = "Statement Failed!";
            header("location: ../admin_side/home.php?error=" . $err . "");
            exit();
        }
    }

    // set auth
    protected function setAuth($auth) {
        $sql = "UPDATE `users` SET `auth` = ? WHERE `role` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($auth, "admin"))) {
            $stmt = null;
            $err = "Statement Failed!";
            header("location: ../admin_side/home.php?error=" . $err . "");
            exit();
        }
    }

    // Set send notification
    protected function setSendNotif($users, $from, $content) {
        $sql = "INSERT INTO `notification` (`msg_from`, `msg_to`, `message`) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($from, $users, $content))) {
            $stmt = null;
            $err = "Statement Failed!";
            header("location: ../admin_side/home.php?error=" . $err . "");
            exit();
        }
    }
}
