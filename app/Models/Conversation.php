<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Conversation
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Busca una conversación abierta del contacto
     */
    public function findOpenConversation(int $contactId)
    {
        $sql = "SELECT *
                FROM conversaciones
                WHERE contacto_id=?
                AND estado='Abierta'
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$contactId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crear conversación
     */
    public function create(int $contactId)
    {

        $sql="INSERT INTO conversaciones
              (contacto_id)
              VALUES(?)";

        $stmt=$this->db->prepare($sql);

        $stmt->execute([$contactId]);

        return $this->db->lastInsertId();

    }

}