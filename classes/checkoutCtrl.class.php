<?php

class CheckoutCtrl extends Checkout
{
    // set methods
    public function checkout()
    {
        if(!$this->setDeliveryInfo()) {
            session_start();
            $_SESSION['delivery'] = "delivery";
            // back to cart page - error: none
            header('location: ../cart.php');
        }
    }

    // Canceled orders
    public function CancelCheckout($delivery_id, $radio) 
    {
        if(!$this->cancelOrder($delivery_id, $radio)) {
            session_start();
            $_SESSION['cancel'] = "cancel";
            // back to cart page - error: none
            header('location: ../user_edit_profile/purchases.php');
        }
    }

    // buy again orders
    public function BuyAgain($Buy_id) 
    {
        if(!$this->setBuyAgain($Buy_id)) {
            session_start();
            $_SESSION['buy_again'] = "buy_again";
            // back to cart page - error: none
            header('location: ../user_edit_profile/purchases.php');
        }
    }

    // buy again -> to_complete
    public function BuyAgainComplete($Buy_id) 
    {
        if(!$this->SetBuyAgainComplete($Buy_id)) {
            session_start();
            $_SESSION['buy_again'] = "buy_again";
            // back to cart page - error: none
            header('location: ../user_edit_profile/purchases.php');
        }
    }

    // edit delivery details -> Manage Delivery : Admin
    public function ctrlManageDelivery($delivery_id) 
    {
        $this->getDeliveryDetails($delivery_id);
    } 

    // Update delivery details
    public function updateDeliveryStat($delivery_options, $delivery_id) 
    {
        $this->setDeliveryStat($delivery_options, $delivery_id);
    }

    // View ordered Items
    public function getOrderedItems($delivery_id) 
    {
        $this->ViewOrderedItems($delivery_id);
    }
}