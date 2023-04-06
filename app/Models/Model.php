<?php

namespace App\Models;

use App\Models\Connection;

abstract class Model
{
    protected $conn;

    public function __construct()
    {
        $this->conn = (new Connection())->getConnection();
    }

    protected function paginate(int $offset)
    {
    }

    protected function save(array $data)
    {
    }
}
