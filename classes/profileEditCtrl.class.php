<?php

class ProfileEditCtrl extends ProfileEdit
{
    // PROPERTIES
    // customer info
    private $inputFirstName;
    private $inputLastName;
    private $inputGender;
    private $inputBirthday;
    private $inputCivilstat;
    private $inputContact;
    private $image_path;

    public function __construct(
        $inputEmail,
        $inputFirstName,
        $inputLastName,
        $inputGender,
        $inputBirthday,
        $inputCivilstat,
        $inputContact,
        $image_path
    ) {
        // customer info
        $this->inputEmail = $inputEmail;
        $this->inputFirstName = $inputFirstName;
        $this->inputLastName = $inputLastName;
        $this->inputGender = $inputGender;
        $this->inputBirthday = $inputBirthday;
        $this->inputCivilstat = $inputCivilstat;
        $this->inputContact = $inputContact;
        $this->image_path = $image_path;
    }

    public function __destruct()
    {
        // Clean up all resources / objects here
    }

    // CREATE METHOD FOR EDITCUSTOMER
    public function editCustomer()
    {
        // check if session is set
        if (isset($_SESSION)) {
            session_write_close();
        } else {
            session_start();
        }

        if ($this->imageErr() == false) {
            // image error
            $err = "Image error, please choose another!";
            header('location: ../user_edit_profile/profile.php?error=' . $err . '');
            exit();
        }
        if ($this->filetypeErr() == false) {
            // file type
            $err = "You can't upload files of this type!";
            header('location: ../user_edit_profile/profile.php?error=' . $err . '');
            exit();
        }
        if ($this->imagesizeErr() == false) {
            // stock limit
            $err = "Sorry, your file is too large!";
            header('location: ../user_edit_profile/profile.php?error=' . $err . '');
            exit();
        }

        // check if image is exists
        if (file_exists($this->image_path)) {
            // image defaults
            $defaultf = "../assets/images/customers_dp/default-female.png";
            $defaultm = "../assets/images/customers_dp/default-male.jpeg";

            // if the image is not default
            if ($this->image_path != $defaultf || $this->image_path != $defaultm) {
                // delete picture in directory
                unlink($this->image_path);

            } else {
                // return 0 value
                $this->image_path = null;
            }

        } else {
            // return 0 value
            $this->image_path = null;
        }

        // get file extension
        $img_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $img_extension_lowcase = strtolower($img_extension);

        // new image name
        $new_img_name = $_SESSION['user_id'] . "." . $img_extension_lowcase;
        // move image to upload folder
        $img_upload_path = '../assets/images/customers_dp/' . $new_img_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $img_upload_path);

        // if($move) {
        //     echo $_FILES['image']['tmp_name'] . "<br>";
        //     echo $img_upload_path;
        // } else {
        //     echo $_FILES['image']['tmp_name'] . "<br>";
        //     echo $img_upload_path. "<br>";
        //     echo "failed";
        // }

        // move data to setProducts function
        $this->setCustomer(
            $this->inputEmail,
            $this->inputFirstName,
            $this->inputLastName,
            $this->inputGender,
            $this->inputBirthday,
            $this->inputCivilstat,
            $this->inputContact,
            $img_upload_path
        );
    }

    // IMAGE VALIDATE
    // error in image
    public function imageErr()
    {
        if (!$_FILES['image']['error'] === 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // image size
    public function imagesizeErr()
    {
        if ($_FILES['image']['size'] > 5000000) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // file type error
    public function filetypeErr()
    {

        // if file button /image is equals to null
        if ($_FILES['image']['error'] == 4) {

            $result = true;

            // if file button / image is not null
        } else {

            // validate file type
            $img_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $img_extension_lowcase = strtolower($img_extension);

            $allowed_extension = array("jpeg", "jpg", "png");

            if (!in_array($img_extension_lowcase, $allowed_extension)) {
                $result = false;
            } else {
                $result = true;
            }
        }

        return $result;
    }

    //USER VALIDATION
    // Email validation
    public function invalidEmail()
    {
        if (!filter_var($this->inputEmail, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function invalidInput()
    {
        if (
            !preg_match("/^[a-zA-Z0-9]*$/", $this->inputFirstname) ||
            !preg_match("/^[a-zA-Z0-9]*$/", $this->inputLastname)
        ) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
