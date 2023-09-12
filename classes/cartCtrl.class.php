<?php 

class CartCtrl extends Cart {
    // set properties
    private $product_id;
    private $qty;

    // set contructor
    public function __construct($product_id, $qty) {
        $this->product_id = $product_id;
        $this->qty = $qty;
    }

    public function __destruct() {
        // Clean up all resources / objects here
    }

    // set methods
    public function addCart() {
        // move data to database
        if(!$this->setCart($this->product_id, $this->qty)) {
            session_start();
            $_SESSION['cart_added'] = "Successfully Added to your cart!";
            // back to home page - error: none
            echo "<script> window.history.go(-1); </script>";
        } 
    }

    public function removeCart() {
        // move data to database
        $this->deleteItemCart($this->product_id);
    }

    public function updateQty() {
        // move data to database
        $this->setQtyData($this->product_id, $this->qty);
    }

    public function updateQtyBtn() {
        // move data to database
        $this->setQtyDataBtn($this->product_id, $this->qty);
    }

    public function updateQtyBtn2() {
        // move data to database
        $this->setQtyDataBtn2($this->product_id, $this->qty);
    }
}