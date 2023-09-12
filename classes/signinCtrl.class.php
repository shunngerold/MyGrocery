<?php

class SigninCtrl extends Signin
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
    public function signinUser()
    {
        // Pass data to SignIn class
        $this->getUser($this->uname, $this->pwd);
    }

    // CREATE METHOD FOR AUTHENTICATION
    public function userAuth($code) 
    {
        $this->userVerify($code);
    }

    public function userVerifyEmail($code) 
    {
        $this->VerifyEmail($code);
    }

    public function reSendAuth($body, $full_code, $sub) 
    {
        if($this->sendCode($body, $full_code, $sub) == false){
            $err = "Send Failed, check your internet connection!";
            header("location: ../signin.php?error=" . $err . "");
            exit();
        }
    }
}
