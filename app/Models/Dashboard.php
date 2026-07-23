<?php

namespace App\Models;

use App\Core\BaseModel;

//use App\Database\Database;
//use PDO;

class Dashboard extends BaseModel
{
    //private PDO $db;

    /*public function __construct()
    {
        $this->db = Database::connect();
    }*/

    public function resumen()
    {
        return [

            'contactos'=>$this->db
                ->query("SELECT COUNT(*) FROM contactos")
                ->fetchColumn(),

            'conversaciones'=>$this->db
                ->query("SELECT COUNT(*) FROM conversaciones")
                ->fetchColumn(),

            'mensajes'=>$this->db
                ->query("SELECT COUNT(*) FROM mensajes")
                ->fetchColumn()

        ];
    }

}