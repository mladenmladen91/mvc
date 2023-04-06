<?php

namespace App\Models;

use PDO;

class Connection
{

    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $connection;

    function __construct()
    {

        try {

            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        } catch (\PDOException $e) {

            echo $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection()
    {

        $this->connection = null;
    }
}
