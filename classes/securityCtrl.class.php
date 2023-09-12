<?php

class SecurityCtrl extends Signup
{
    private $currentPassword;
    private $newPassword;
    private $confirmPassword;

    public function __construct(
        $currentPassword,
        $newPassword,
        $confirmPassword
    ) {

        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
        $this->confirmPassword = $confirmPassword;
    }

    public function __destruct()
    {
        // Clean up all resources / objects here
    }

    // CREATE METHOD FOR SECURITY
    public function updateSecurity()
    {
        if ($this->checkCurrentPwd($this->currentPassword) == false) {
            // Invalid current password
            $error = "Invalid current password";
            header("location: ../user_edit_profile/security.php?error=" . $error . "");
            exit();
        }
        if ($this->pwdLength() == false) {
            // Invalid current password
            $error = "Password must be 8 characters";
            header("location: ../user_edit_profile/security.php?error=" . $error . "");
            exit();
        }
        if ($this->newpwdMatch() == false) {
            // Invalid current password
            $error = "Password not matched!";
            header("location: ../user_edit_profile/security.php?error=" . $error . "");
            exit();
        }

        $this->setSecurity($this->newPassword);
    }

    // check password length
    public function pwdLength()
    {
        // get specific digit of a password
        $pwdlength = strlen((string)$this->newPassword);

        if ($pwdlength < 8) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    // check new password match
    public function newpwdMatch()
    {
        if ($this->newPassword !== $this->confirmPassword) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    // Update auth value
    public function setAuthVal($auth_val) 
    {
        $this->setAuthenticationVal($auth_val);
    }
}
