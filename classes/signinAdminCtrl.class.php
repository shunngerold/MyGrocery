<?php

class SigninAdminCtrl extends SigninAdmin
{
    // properties
    private $uname;
    private $pwd;

    // methods
    // intiate constructor
    public function __construct($uname, $pwd)
    {
        $this->uname = $uname;
        $this->pwd = $pwd;
    }

    public function __destruct()
    {
        // Clean up all resources / objects here
    }

    // CREATE METHOD FOR SIGNIN
    public function signinAdmin()
    {
        // Pass data to SignIn class
        $this->getAdmin($this->uname, $this->pwd);
    }

    // CREATE METHOD FOR AUTHENTICATION
    public function adminAuth($code) 
    {
        $this->adminVerify($code);
    }
    
    // CREATE METHOD FOR PROFILE EDIT
    public function myAccount($email, $cpass) 
    {
        if($this->invalidInput() == false) {
            // Invalid Username
            $err = "Invalid Username!";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }
        if($this->pwdLength() == false) {
            // Invalid pass lenght
            $err = "Password must be atleast 8 characters";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }
        if($this->pwdMatch($cpass) == false) {
            // password not matched
            $err = "Password not matched";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }

        $this->setMyAccount($this->uname, $this->pwd, $email);
    }

    // CREATE METHOD FOR PROFILE EDIT
    public function addAccount($email, $cpass) 
    {
        if($this->invalidInput() == false) {
            // Invalid Username
            $err = "Invalid Username!";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }
        if($this->pwdLength() == false) {
            // Invalid pass lenght
            $err = "Password must be atleast 8 characters";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }
        if($this->pwdMatch($cpass) == false) {
            // password not matched
            $err = "Password not matched";
            header('location: ../admin_side/home.php?error=' . $err . '');
            exit();
        }

        $this->addAdminAccount($this->uname, $this->pwd, $email);
    }

    // check uname input
    // if user input is invalid
    public function invalidInput()
    {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uname)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // if user inputted password less than 8 char
    public function pwdLength()
    {
        // get specific digit of a password
        $pwdlength = strlen((string)$this->pwd);

        if ($pwdlength < 8) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    
    // matching passwords
    public function pwdMatch($cpass)
    {
        if ($this->pwd !== $cpass) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // CREATE METHOD SEND NOTIF
    public function sendNotif($users, $from, $content) 
    {
        $this->setSendNotif($users, $from, $content);
    }
}
