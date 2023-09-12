<?php
// check if session is set
if (isset($_SESSION)) {
    session_write_close();
} else {
    session_start();
}

class Signin extends DbHandler
{
    // validating user info to the database
    protected function getUser($uname, $pwd)
    {
        $sql = 'SELECT `password` FROM `users` WHERE `username` = ? OR `email` = ?;';
        $stmt = $this->connect()->prepare($sql);

        // If the sql statement fails
        if (!$stmt->execute(array($uname, $uname))) {
            $stmt = null;
            $err = "Statement Failed!";
            header("location: ../signin.php?error=" . $err . "");
            exit();
        }

        // If the user does not exist
        if ($stmt->rowcount() == 0) {
            $stmt = null;
            $err = "User Not Found!";
            header("location: ../signin.php?error=" . $err . "");
            exit();
        }

        // hashed password
        $pwdHash = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if password is valid
        $pwdCheck = password_verify($pwd, $pwdHash[0]['password']);

        if ($pwdCheck == false) {
            $stmt = null;
            $err = "Invalid Password!";
            $_SESSION['error'] = $err;
            header("location: ../signin.php");
            exit();

        } elseif ($pwdCheck == true) {
            $UserCredentials = $this->getUserCredentials($uname, $pwd);

            // If the user does not exist
            if ($UserCredentials->rowcount() == 0) {
                $UserCredentials = null;
                $err = "User Not Found!";
                $_SESSION['error'] = $err;
                header("location: ../signin.php");
                exit();
            } 

            // fetch all data   
            $user = $UserCredentials->fetchAll(PDO::FETCH_ASSOC);

            // user attempt variable
            $_SESSION['attempt'] = 0;
            $_SESSION['attempt'] += 1;

            // set auth id and email
            $_SESSION['auth_id'] = $user[0]['username'];
            $_SESSION['auth_email'] = $user[0]['email'];
            
            // if user's email is not verified
            if($user[0]['verify_email'] == 0) {
                // check how many attempts
                if($_SESSION['attempt'] > 3) {
                    $stmt = null;
                    $err = "User account is locked, please try again later!";
                    header("location: ../signin.php?error=" . $err . "");
                    exit();

                } else {
                    // body content
                    $a = rand(10, 30);
                    $b = rand(10, 30);
                    $c = rand(10, 30);
                    $code = $a . $b . $c;
                    $body = "Your MyGrocery email verification code <br/> is:";
                    $sub = "Email Verification Code";

                    // send verification code
                    if(!$this->sendCode($body, $code, $sub)) {
                        exit();
                        header("location: ../verify_email.php");
                    }
                    
                    // goto verify email page
                    header("location: ../verify_email.php");
                }

            } else {
                // check if 2-factor auth is true
                if($user[0]['auth'] == 1) {
                    // if user have 3 attempts
                    if($_SESSION['attempt'] > 3) {
                        $stmt = null;
                        $err = "You have reached your login limit!";
                        header("location: ../signin.php?error=" . $err . "");
                        exit();

                    } else {

                        // Random code : 6-digit
                        $body = "Your MyGrocery verification code <br/> is:";
                        $code1 = rand(10, 20);
                        $code2 = rand(10, 20);
                        $code3 = rand(10, 20);
                        $full_code = $code1 . $code2 . $code3;
                        $sub = "Two Factor Verification Email";

                        // Send code to the user's email
                        if($this->sendCode($body, $full_code, $sub) == false) {
                            exit();
                            header("location: ../authentication.php");
                        } 
                    }
                    
                    // path for authentication page
                    header('location: ../authentication.php');

                } else {
                    // user filter
                    if ($user[0]['role'] == "user") {
                        $_SESSION['user_id'] = $user[0]['username'];
                        echo "<script> window.history.go(-2); </script>";
                    } elseif ($user[0]['role'] == "admin") {
                        $stmt = null;
                        $err = "User Failed!";
                        header("location: ../signin.php?error=" . $err . "");
                        exit();
                    }
                }
            }

        } else {
            echo "Error: Type, pwdCheck does not exist";
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
    protected function sendCode($body, $code, $sub) {
        require("../includes/PHPMailer/src/PHPMailer.php");
        require("../includes/PHPMailer/src/SMTP.php");

        // Set verification code in user account
        if($this->setCode($code, $_SESSION['auth_id']) != false) {
            $mailTo = $_SESSION['auth_email'];
            $body = $body . $code;

            $mail = new PHPMailer\PHPMailer\PHPMailer();

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
            $mail->From = "mygrocery.customersurvey@gmail.com";
            $mail->FromName = "MyGrocery | Customer Service";

            $mail->addAddress($mailTo, $_SESSION['auth_id']);
            $mail->isHTML(true);
            $mail->Subject = $sub;
            $mail->Body = $body;
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

    // ########################################
    // Two-Factor Verification
    protected function userVerify($code) {
        // user credentials
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
            header("location: ../signin.php?error=" . $err . "");
            exit();
        } else {
            // code verified - user logged in
            $_SESSION['user_id'] = $_SESSION['auth_id'];
            unset($_SESSION['auth_email']);
            unset($_SESSION['auth_id']);
            header("location: ../index.php");
        }
    }
    // Email Verification
    protected function VerifyEmail($code) {
        // user credentials
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
            header("location: ../signin.php?error=" . $err . "");
            exit();

        } else {
            // code verified - update verify email to 1
            $sql = "UPDATE `users` SET `verify_email` = ? WHERE `username` = ?";
            $stmt = $this->connect()->prepare($sql);

            if(!$stmt->execute(array("1", $_SESSION['auth_id']))) {
                $stmt = null;
                $err = "Statement Failed!";
                header("location: ../signin.php?error=" . $err . "");
                exit();
            }


            $_SESSION['user_id'] = $_SESSION['auth_id'];
            unset($_SESSION['auth_email']);
            unset($_SESSION['auth_id']);
            header("location: ../index.php");
        }
    }
}
