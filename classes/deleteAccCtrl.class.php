<?php

class DeleteAccCtrl extends ProfileEdit
{
    // set properties
    private $user_id;

    // set contructor
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function __destruct()
    {
        // Clean up all resources / objects here
    }
}
