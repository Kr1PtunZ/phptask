<?php

class DataBase
{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbName = 'api-task';

    public function getConnection()
    {
        $conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName);
        if (!$conn) {
            return "Error";
        }
            return $conn;
    }
}