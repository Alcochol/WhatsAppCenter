<?php

namespace App\Models;

use App\Core\BaseModel;

//use App\Database\Database;
//use PDO;

class Contact extends BaseModel
{
    //private PDO $db;

    /*public function __construct()
    {
        $this->db = Database::connect();
    }*/

    /**
     * Buscar contacto por teléfono
     */
    public function findByPhone(string $phone)
    {
        $sql = "SELECT * FROM contactos WHERE telefono = ? LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$phone]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crear contacto nuevo
     */
    public function create(string $phone, string $name = "Sin nombre")
    {
        $sql = "INSERT INTO contactos
                (telefono,nombre)
                VALUES(?,?)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$phone,$name]);

        return $this->db->lastInsertId();
    }

}