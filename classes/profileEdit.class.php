<?php

// check if session is set
if (isset($_SESSION)) {
    session_write_close();
} else {
    session_start();
}

class ProfileEdit extends DbHandler
{
    // Update customer info to the database
    protected function setCustomer(
        $inputEmail,
        $inputFirstName,
        $inputLastName,
        $inputGender,
        $inputBirthday,
        $inputCivilstat,
        $inputContact,
        $img_upload_path
    ) {

        // If image (display) is null
        if ($_FILES['image']['error'] == 4) {

            $sql = "UPDATE `customers` 
                    SET `email` = ?,
                        `firstname` = ?, 
                        `lastname` = ?, 
                        `gender` = ?, 
                        `date_of_birth` = ?, 
                        `civil_status` = ?, 
                        `contact_number` = ?
                    WHERE `username` = ?";

            $stmt = $this->connect()->prepare($sql);

            // Convert to camel case
            $Gender = ucwords($inputGender);
            $FirstName = ucwords($inputFirstName);
            $LastName = ucwords($inputLastName);
            $Civilstat = ucwords($inputCivilstat);

            // execute values for each prepared statements 
            if (!$stmt->execute(array(
                $inputEmail,
                $FirstName,
                $LastName,
                $Gender,
                $inputBirthday,
                $Civilstat,
                $inputContact,
                $_SESSION['user_id']
            ))) {

                $stmt = null;
                $err = "Statement Failed";
                header("location: ../profile.php?error=" . $err . "");
                exit();
            }

            $stmt = null;

            // if image is not null 
        } else {
            $sql = "UPDATE `customers` 
                    SET `firstname` = ?, 
                        `lastname` = ?, 
                        `gender` = ?, 
                        `date_of_birth` = ?, 
                        `civil_status` = ?, 
                        `contact_number` = ?, 
                        `display` = ? 
                    WHERE `username` = ?";

            $stmt = $this->connect()->prepare($sql);

            // Convert to camel case
            $Gender = ucwords($inputGender);
            $FirstName = ucwords($inputFirstName);
            $LastName = ucwords($inputLastName);
            $Civilstat = ucwords($inputCivilstat);

            // execute values for each prepared statements 
            if (!$stmt->execute(array(
                $FirstName,
                $LastName,
                $Gender,
                $inputBirthday,
                $Civilstat,
                $inputContact,
                $img_upload_path,
                $_SESSION['user_id']
            ))) {

                $stmt = null;
                $err = "Statement Failed";
                header("location: ../profile.php?error=" . $err . "");
                exit();
            }

            $stmt = null;
        }
    }

    // get customer's info
    protected function getInfo()
    {
        $sql = "SELECT * FROM `customers` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute(array($_SESSION['user_id']))) {
            // fetch all data
            $customer = $stmt->fetchAll();
            // return data
            return $customer;
        } else {
            $stmt = null;
            $err = "Statement Failed";
            header("location: ../user_edit_profile/profile.php?error=" . $err . "");
            exit();
        }

        $stmt = null;
    }

    // Update delivery details
    protected function setDelivery(
        $inputStreet,
        $inputBarangay,
        $inputMC,
        $inputProvince
    ) {
        $sql = "UPDATE `customers` 
                    SET `postal` = ?,
                        `street` = ?, 
                        `barangay` = ?,
                        `city_municipal` = ?, 
                        `province` = ?
                    WHERE `username` = ?";

        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array(
            $this->getzip($inputMC, $inputProvince),
            ucwords($inputStreet),
            ucwords($inputBarangay),
            ucwords($inputMC),
            ucwords($inputProvince),
            $_SESSION['user_id']
        ))) {

            $stmt = null;
            $err = "Statement Failed";
            header("location: ../user_edit_profile/profile.php?error=" . $err . "");
            exit();
        }

        $stmt = null;
    }

    // get location
    protected function getLocation()
    {
        $sql = "SELECT * FROM `location`";
        $stmt = $this->connect()->query($sql);

        if (!$stmt) {
            $stmt = null;
            $err = "Statement Failed";
            header("location: ../user_edit_profile/profile.php?error=" . $err . "");
            exit();
        } else {
            // fetch all data
            $location = $stmt->fetchAll();
            // return data
            return $location;
        }
    }
    // check province
    protected function checkProvince($inputProvince)
    {
        if (!$inputProvince == "Metro Manila" || !$inputProvince == "Bulacan") {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
    // check Municipal / City
    protected function checkMC($inputMC)
    {
        $sql = "SELECT * FROM `location` WHERE `city_municipal` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($inputMC))) {
            $stmt = null;
            $err = "Statement Failed";
            header("location: ../user_edit_profile/profile.php?error=" . $err . "");
            exit();
        }

        if ($stmt->rowcount() == 0) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    protected function checkMCProvinceValid($inputMC, $inputProvince)
    {
        $sql = "SELECT * FROM `location` WHERE `city_municipal` = ? AND `province` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($inputMC, $inputProvince))) {
            $stmt = null;
            $err = "Statement Failed";
            header("location: ../user_edit_profile/profile.php?error=" . $err . "");
            exit();
        }

        if ($stmt->rowcount() == 0) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
    // get zip code 
    protected function getZip($inputMC, $inputProvince)
    {
        $sql = "SELECT * FROM `location` WHERE `city_municipal` = ? AND `province` = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute(array($inputMC, $inputProvince))) {
            $stmt = null;
            $err = "Statement Failed";
            header("location: ../user_edit_profile/profile.php?error=" . $err . "");
            exit();
        }

        $result = $stmt->fetchAll();
        return $result[0]['zip'];
    }

    // get image / dp of a user
    protected function getDP($user_id) {
        $sql = "SELECT * FROM `customers` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($user_id))) {
            $stmt = null;
            $err = "Statement Failed";
            header("location: ../user_edit_profile/security.php?error=" . $err . "");
            exit();
        }

        if(!$stmt->rowCount() > 0) {
            $result = false;
        }

        $result = $stmt->fetchAll()[0]['display'];

        return $result;
    }

    // get auth value
    protected function getAuthVal() {
        $sql = "SELECT * FROM `users` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute(array($_SESSION['user_id']))) {
            $stmt = null;
            $err = "Statement Failed";
            header("location: ../user_edit_profile/security.php?error=" . $err . "");
            exit();
        }

        return $stmt->fetchAll()[0]['auth'];
    }
}
