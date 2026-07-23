<?php

namespace App\Models;

use App\Core\BaseModel;

//use App\Database\Database;
//use PDO;

class User extends BaseModel
{
    //private PDO $db;

    /*public function __construct()
    {
        $this->db = Database::connect();
    }*/

    public function login(string $correo)
    {
        $sql = "SELECT *
                FROM usuarios
                WHERE correo=?
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$correo]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUltimoAcceso(int $id)
    {
        $stmt = $this->db->prepare(
            "UPDATE usuarios
             SET ultimo_acceso=NOW()
             WHERE id=?"
        );

        $stmt->execute([$id]);
    }
}