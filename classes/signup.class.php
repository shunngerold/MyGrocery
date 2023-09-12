<?php
// check if session is set
if (isset($_SESSION)) {
    session_write_close();
} else {
    session_start();
}

class Signup extends DbHandler
{
    // Insert user info to the database
    protected function setUser($uname, $email, $gender, $pwd, $defaultf, $defaultm)
    {
        // check column 'cart_number' 
        $check = "SELECT * FROM `customers` ORDER BY `cart_number` DESC LIMIT 1";
        $stmt_check = $this->connect()->query($check);

        // check if the database greater than 0
        if ($stmt_check->rowcount() > 0) {
            if ($row = $stmt_check->fetchAll()) {
                // Generate cart number
                $uid = $row[0]['cart_number']; // Declaring variable for cart number
                // get number in existing id
                $get_numbers = str_replace("CRT", "", $uid);
                // Auto Increament for custom cart number = CRT-01 + 1 
                $id_increase = $get_numbers + 1;
                // Setting format of a custom cart number = CRT0001
                $get_string = str_pad($id_increase, 4, 0, STR_PAD_LEFT);
                // Variable for custom id
                $cart_num = "CRT" . $get_string;

                $sql = 'INSERT INTO `users` (`username`, `email`, `password`) VALUES (?,?,?)';
                $stmt = $this->connect()->prepare($sql);

                // Hashing password
                $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

                // if statement 1 is true prepare for 2nd input
                if ($stmt->execute(array($uname, $email, $pwdHash))) {
                    // insert table 2
                    $sql = 'INSERT INTO `customers` (`username`, `cart_number`, `email`, `gender`, `display`) VALUES (?,?,?,?,?)';
                    $stmt = $this->connect()->prepare($sql);

                    // check gender for default image
                    if ($gender == 'male' || $gender == 'Male') {
                        $display = $defaultm;
                    } else {
                        $display = $defaultf;
                    }

                    // Convert to camel case
                    $camelcase_gender = ucwords($gender);

                    if (!$stmt->execute(array($uname, $cart_num, $email, $camelcase_gender, $display))) {
                        $stmt = null;
                        $error = "Statement Failed!";
                        header("location: ../signup.php?error=" . $error . "");
                        exit();
                    }
                } else {
                    $stmt = null;
                    $error = "Statement Failed!";
                    header("location: ../signup.php?error=" . $error . "");
                    exit();
                }
            }
            // if database = 0
        } else {
            $cart_num = "CRT0001";

            $sql = 'INSERT INTO `users` (`username`, `email`, `password`) VALUES (?,?,?)';
            $stmt = $this->connect()->prepare($sql);

            // Hashing password
            $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

            // if statement 1 is true prepare for 2nd input
            if ($stmt->execute(array($uname, $email, $pwdHash))) {
                // insert table 2
                $sql = 'INSERT INTO `customers` (`username`, `cart_number`, `email`, `gender`, `display`) VALUES (?,?,?,?,?)';
                $stmt = $this->connect()->prepare($sql);

                // check gender for default image
                if ($gender == 'male' || $gender == 'Male') {
                    $display = $defaultm;
                } else {
                    $display = $defaultf;
                }

                // Convert to camel case
                $camelcase_gender = ucwords($gender);

                if (!$stmt->execute(array($uname, $cart_num, $email, $camelcase_gender, $display))) {
                    $stmt = null;
                    $error = "Statement Failed!";
                    header("location: ../signup.php?error=" . $error . "");
                    exit();
                }
            } else {
                $stmt = null;
                $error = "Statement Failed!";
                header("location: ../signup.php?error=" . $error . "");
                exit();
            }
        }

        $stmt = null;
    }

    // checking users database if the user is already exist
    protected function checkUser($uname)
    {
        $sql = 'SELECT `username` FROM `users` WHERE `username` = ?';
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($uname))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../signup.php?error=" . $error . "");
            exit();
        }

        if ($stmt->rowcount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    // checking users database if the email is already exist
    protected function checkEmail($email)
    {
        $sql = 'SELECT `email` FROM `users` WHERE `email` = ?';
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../signup.php?error=" . $error . "");
            exit();
        }

        if ($stmt->rowcount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    // =======================================================================
    // update security details
    protected function setSecurity($newPassword)
    {
        $sql = "UPDATE `users` SET `password` = ? WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        // Hashing password
        $pwdHash = password_hash($newPassword, PASSWORD_DEFAULT);

        if (!$stmt->execute(array(
            $pwdHash,
            $_SESSION['user_id']
        ))) {

            $stmt = null;
            $error = "Statement Failed!";
            header("location: ../customer_side/security.php?error=" . $error . "");
            exit();
        }

        $stmt = null;
    }

    // check current password
    protected function checkCurrentPwd($currentPassword)
    {
        session_start();
        $sql = 'SELECT `password` FROM `users` WHERE `username` = ?';
        $stmt = $this->connect()->prepare($sql);

        // If the sql statement fails
        if (!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            header("location: ../index.php?error=statementfailed");
            exit();
        }

        // hashed password
        $pwdHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Check if password is valid
        $pwdCheck = password_verify($currentPassword, $pwdHash[0]['password']);

        return $pwdCheck;
    }

    // update auth value
    protected function setAuthenticationVal($auth_val) {
        $sql = "UPDATE `users` SET `auth` = ? WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($auth_val, $_SESSION['user_id']))) {
            $stmt = null;
            header("location: ../includes/security.php?error=statementfailed");
            exit();
        }
    }
}
