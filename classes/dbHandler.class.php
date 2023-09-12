<?php

class DbHandler
{
    // Set Properties
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbname = "mydatabase";

    // Set Methods
    protected function connect()
    {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $conn = new PDO($dsn, $this->user, $this->pwd);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            echo 'Database Error: ' . $e->getmessage() . '</br>';
            die();
        }
    }
}
