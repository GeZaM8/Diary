<?php

namespace Controllers;

class DatabaseController
{
    public $conn;

    function __construct()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "diary";

        $this->conn = mysqli_connect($host, $username, $password, $database);
    }

}
