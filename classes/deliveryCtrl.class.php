<?php

class DeliveryCtrl extends ProfileEdit
{
    // set properties
    private $inputStreet;
    private $inputBarangay;
    private $inputMC;
    private $inputProvince;

    public function __construct(
        $inputStreet,
        $inputBarangay,
        $inputMC,
        $inputProvince
    ) {

        $this->inputStreet = $inputStreet;
        $this->inputBarangay = $inputBarangay;
        $this->inputMC = $inputMC;
        $this->inputProvince = $inputProvince;
    }

    public function __destruct()
    {
        // Clean up all resources / objects here
    }

    // CREATE METHOD FOR EDITDELIVERY
    public function editDelivery()
    {
        if ($this->getCheckMC() == false) {
            // MC error
            $err = "This city / municipality is invalid or not yet available in our delivery area.";
            header('location: ../user_edit_profile/delivery.php?error=' . $err . '');
            exit();
        }
        if ($this->getcheckProvince() == false) {
            // Street error
            $err = "This province is not yet available in our delivery area!";
            header('location: ../user_edit_profile/delivery.php?error=' . $err . '');
            exit();
        }
        if ($this->getCheckProvinceMCValid() == false) {
            // Province & MC error
            $err = "This city / municipality is not in this province.";
            header('location: ../user_edit_profile/delivery.php?error=' . $err . '');
            exit();
        }
        if ($this->checkStringSt() == false) {
            // Check string Street error
            $err = "Please put valid Street and House number!";
            header('location: ../user_edit_profile/delivery.php?error=' . $err . '');
            exit();
        }
        if ($this->checkStringLoc() == false) {
            // Check string Location error
            $err = "Please put valid Barangay!";
            header('location: ../user_edit_profile/delivery.php?error=' . $err . '');
            exit();
        }
        if ($this->checkStringMC() == false) {
            // Check string MC error
            $err = "Please put valid City/Municipality!";
            header('location: ../user_edit_profile/delivery.php?error=' . $err . '');
            exit();
        }

        $this->setDelivery(
            $this->inputStreet,
            $this->inputBarangay,
            $this->inputMC,
            $this->inputProvince
        );
    }

    // Check user input for street
    public function checkStringSt()
    {
        if (!preg_match('/[a-zA-Z0-9 ]/', $this->inputStreet)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    // Check user input for barangay
    public function checkStringLoc()
    {
        if (!preg_match('/[a-zA-Z ]/', $this->inputBarangay)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    // Check user input for City/Municipal
    public function checkStringMC()
    {
        if (!preg_match('/[a-zA-Z ]/', $this->inputMC)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    // check municipal / city
    public function getCheckMC()
    {
        if (!$this->checkMC($this->inputMC)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    // check if MC is valid in province
    public function getCheckProvinceMCValid()
    {
        if (!$this->checkMCProvinceValid($this->inputMC, $this->inputProvince)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    // check province 
    public function getcheckProvince()
    {
        if (!$this->checkProvince($this->inputProvince)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
}
