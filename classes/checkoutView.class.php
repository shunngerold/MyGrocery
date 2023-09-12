<?php

class CheckoutView extends Checkout {
    // view canceled Orders
    public function viewCanceledOrders() {
        return $this->getCanceledOrder();
    }
    // view products
    public function ViewCheckout($delivery_id) 
    {
        return $this->getOrderedItems($delivery_id);
    }

    // view Buy Aagain details
    public function ViewBuyAgain($Buy_id) 
    {
        return $this->getbuyagainDetail($Buy_id);
    }

    // view Buy Aagain details
    public function ViewBuyAgainComplete($Buy_id) 
    {
        return $this->getbuyagainCompleteDetail($Buy_id);
    }
}