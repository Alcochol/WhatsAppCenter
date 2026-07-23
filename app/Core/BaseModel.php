<?php

namespace App\Core;

use App\Database\Database;
use PDO;

class BaseModel
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
}