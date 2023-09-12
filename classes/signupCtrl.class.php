<?php

class SignupCtrl extends Signup
{
    // properties
    private $uname;
    private $email;
    private $gender;
    private $pwd;
    private $pwdRepeat;
    private $defaultf;
    private $defaultm;

    // methods
    // intiate constructor
    public function __construct($uname, $email, $gender, $pwd, $pwdRepeat, $defaultf, $defaultm)
    {
        $this->uname = $uname;
        $this->email = $email;
        $this->gender = $gender;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->defaultf = $defaultf;
        $this->defaultm = $defaultm;
    }

    public function __destruct()
    {
        // Clean up all resources / objects here
    }

    // CREATE METHOD FOR SIGNUP
    public function signupUser()
    {
        session_start();
        if ($this->userTakenCheck() == false) {
            // User is already exist
            $err = "User is already exist!";
            $_SESSION['error'] = $err;
            header('location: ../signup.php');
            exit();
        }
        if ($this->invalidInput() == false) {
            // Invalid Username
            $err = "Invalid Username!";
            $_SESSION['error'] = $err;
            header('location: ../signup.php?error=' . $err . '');
            exit();
        }
        if ($this->emailTakenCheck() == false) {
            // Email is already exist
            $err = "Email is already exist!";
            $_SESSION['error'] = $err;
            header('location: ../signup.php?error=' . $err . '');
            exit();
        }
        if ($this->pwdLength() == false) {
            // Password must be 8 char
            $err = "Password must be 8 characters!";
            $_SESSION['error'] = $err;
            header('location: ../signup.php');
            exit();
        }
        if ($this->pwdMatch() == false) {
            // Password not match
            $err = "Password not match!";
            $_SESSION['error'] = $err;
            header('location: ../signup.php');
            exit();
        }

        if(!$this->setUser(
            $this->uname,
            $this->email,
            $this->gender,
            $this->pwd,
            $this->defaultf,
            $this->defaultm
        )) {
            $_SESSION['none'] = "Successfully Registered!";
            // back to home page - error: none
            header("location: ../signin.php");
        }
    }

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

    // matching passwords
    public function pwdMatch()
    {
        if ($this->pwd !== $this->pwdRepeat) {
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

    // if user is already exists
    public function userTakenCheck()
    {
        if (!$this->checkUser($this->uname)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // if email is already exists
    public function emailTakenCheck()
    {
        if (!$this->checkEmail($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
