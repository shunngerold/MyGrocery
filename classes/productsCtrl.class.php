<?php

class ProductsCtrl extends Products
{
    // PROPERTIES
    // product info
    private $prod_title;
    private $stock_number;
    private $exp_date;
    private $price;
    private $kilo_pcs_pack;
    private $category;
    private $description;

    // img arrays
    private $img_name;
    private $img_tmp_name;
    private $img_error;
    private $img_size;

    public function __construct(
        $prod_title,
        $stock_number,
        $exp_date,
        $price, 
        $kilo_pcs_pack,
        $category, 
        $description,
        $img_name,
        $img_tmp_name,
        $img_error,
        $img_size
    ) {
        // product info
        $this->prod_title = $prod_title;
        $this->stock_number = $stock_number;
        $this->exp_date = $exp_date;
        $this->price = $price;
        $this->kilo_pcs_pack = $kilo_pcs_pack;
        $this->category = $category;
        $this->description = $description;
        // img arrays
        $this->img_name = $img_name;
        $this->img_tmp_name = $img_tmp_name;
        $this->img_error = $img_error;
        $this->img_size = $img_size;
    }

    public function __destruct()
    {
        // Clean up all resources / objects here
    }

    // CREATE METHOD FOR ADD PRODUCTS
    public function addProducts()
    {
        if($this->getProductExists() == false) {
            // Product Exist
            $_SESSION['error'] = "Product Exist!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->invalidTitleInput() == false) {
            // Invalid Input
            $_SESSION['error'] = "Invalid input!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->stockLimit() == false) {
            // stock limit
            $_SESSION['error'] = "Sorry, limit your stocks into 200,000!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->imageErr() == false) {
            // image error
            $_SESSION['error'] = "Image error, please choose another!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->filetypeErr() == false) {
            // file type
            $_SESSION['error'] = "You can't upload files of this type!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->imagesizeErr() == false) {
            // stock limit
            $_SESSION['error'] = "Sorry, your file is too large!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }

        // get image extension
        $img_extension = pathinfo($this->img_name, PATHINFO_EXTENSION);
        $img_extension_lowcase = strtolower($img_extension);

        // move image to upload folder
        $new_img_name = uniqid("PRO-", true) . '.' . $img_extension_lowcase;
        $img_upload_path = '../assets/images/uploads/' . $new_img_name;
        move_uploaded_file($this->img_tmp_name, $img_upload_path);

        $filtered_path = str_replace("../", "./", $img_upload_path);
        // move data to setProducts function
        $this->setProducts(
            $this->prod_title,
            $this->stock_number,
            $this->exp_date,
            $this->price, 
            $this->kilo_pcs_pack,
            $this->category, 
            $this->description,
            $filtered_path
        );
    }

    // Update Product Details
    public function updateProducts($prod_id) {
        if ($this->invalidTitleInput() == false) {
            // Invalid Input
            $_SESSION['error'] = "Invalid input!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->stockLimit() == false) {
            // stock limit
            $_SESSION['error'] = "Sorry, limit your stocks into 200,000!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->imageErr() == false) {
            // image error
            $_SESSION['error'] = "Image error, please choose another!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->filetypeErr() == false) {
            // file type
            $_SESSION['error'] = "You can't upload files of this type!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        if ($this->imagesizeErr() == false) {
            // stock limit
            $_SESSION['error'] = "Sorry, your file is too large!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }
        
        // get image extension
        $img_extension = pathinfo($this->img_name, PATHINFO_EXTENSION);
        $img_extension_lowcase = strtolower($img_extension);

        // move image to upload folder
        $new_img_name = uniqid("PRO-", true) . '.' . $img_extension_lowcase;
        $img_upload_path = '../assets/images/uploads/' . $new_img_name;
        move_uploaded_file($this->img_tmp_name, $img_upload_path);

        $filtered_path = str_replace("../", "./", $img_upload_path);

        // move data
        $this->updateProductDetails(
            $prod_id, 
            $this->prod_title,
            $this->stock_number,
            $this->exp_date,
            $this->price, 
            $this->kilo_pcs_pack,
            $this->category, 
            $this->description,
            $filtered_path
        );
    }

    // Delete Product Method
    public function getdeleteProducts($prod_id) {
        // Pass data to model class
        $this->deleteProduct($prod_id);
    }

    // Add product through Excel File
    public function addExcelFile() {
        if ($this->checkExcelFile() == false) {
            // file type
            $_SESSION['error'] = "You can't upload files of this type!";
            echo "<script> window.history.go(-1); </script>";
            exit();
        }

        $this->insertExcelFile();
    }

    // USER VALIDATE
    // check if product exists
    public function getProductExists() 
    {
        if(!$this->checkIfProductExists($this->prod_title) == 0) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
    // if product title input is invalid
    public function invalidTitleInput()
    {
        if (!preg_match('/[a-zA-Z ]/', $this->prod_title)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // stock limit
    public function stockLimit()
    {
        if ($this->stock_number > 200000) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // IMAGE VALIDATE
    // error in image
    public function imageErr()
    {
        if (!$this->img_error === 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // image size
    public function imagesizeErr()
    {
        if ($this->img_size > 235000) {
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
            $img_extension = pathinfo($this->img_name, PATHINFO_EXTENSION);
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
    // EXCEL VALIDATE
    // check excel file 
    public function checkExcelFile() {
        $filename = $_FILES['excel']['name'];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
        $file_ext_lowercase = strtolower($file_ext);
        $allowed = array("xls", "csv", "xlsx");

        if(!in_array($file_ext_lowercase, $allowed)) {
            $result = false;

        } else {
            $result = true;

        }

        return $result;
    }

    // Delete Canceled Order Method
    public function getcanceledOrders($delivery_id) {
        // Pass data to model class
        $this->CanceledOrder($delivery_id);
    }
}
