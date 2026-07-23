<?php

namespace App\Models;

use App\Core\BaseModel;

//use App\Database\Database;
//use PDO;

class Message extends BaseModel
{
    //private PDO $db;

    /*public function __construct()
    {
        $this->db = Database::connect();
    }*/

    public function create(
        int $conversationId,
        string $whatsappMessageId,
        string $telefono,
        string $tipo,
        string $tipoMensaje,
        string $mensaje,
        string $estado = 'recibido'
    )
    {

        $sql = "INSERT INTO mensajes
        (
            conversacion_id,
            whatsapp_message_id,
            telefono,
            tipo,
            tipo_mensaje,
            mensaje,
            estado,
            fecha
        )
        VALUES
        (
            ?,?,?,?,?,?,?,NOW()
        )";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $conversationId,
            $whatsappMessageId,
            $telefono,
            $tipo,
            $tipoMensaje,
            $mensaje,
            $estado
        ]);

        return $this->db->lastInsertId();
    }
}