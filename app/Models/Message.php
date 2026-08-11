<?php

namespace App\Models;

use App\Core\BaseModel;
use PDO;

class Message extends BaseModel
{
    protected string $table = 'mensajes';


    /**
     * Crear un mensaje.
     *
     * Este método ya lo utiliza el webhook
     * para guardar mensajes recibidos de Meta.
     */
    public function createmensajes(
        int $conversationId,
        string $whatsappMessageId,
        string $telefono,
        string $tipo,
        string $tipoMensaje,
        string $mensaje,
        string $estado = 'recibido'
    ) {
        $sql = "
            INSERT INTO mensajes
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
                ?, ?, ?, ?, ?, ?, ?, NOW()
            )
        ";

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


    /**
     * Obtener todos los mensajes
     * de una conversación.
     */
    public function byConversation(int $conversationId)
    {
        $sql = "
            SELECT
                id,
                conversacion_id,
                whatsapp_message_id,
                telefono,
                tipo,
                tipo_mensaje,
                mensaje,
                estado,
                fecha

            FROM mensajes

            WHERE conversacion_id = ?

            ORDER BY fecha ASC, id ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$conversationId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Obtener el último mensaje
     * de una conversación.
     */
    public function lastByConversation(int $conversationId)
    {
        $sql = "
            SELECT *
            FROM mensajes

            WHERE conversacion_id = ?

            ORDER BY fecha DESC, id DESC

            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$conversationId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Crear un mensaje utilizando
     * un arreglo de datos.
     *
     * Útil para mensajes enviados
     * desde nuestro sistema.
     */
    public function create(array $data)
    {
        return $this->insert($data);
    }



     public function getByConversation(int $conversationId)
{
    $sql = "SELECT
                id,
                conversacion_id,
                whatsapp_message_id,
                telefono,
                tipo,
                tipo_mensaje,
                mensaje,
                estado,
                fecha
            FROM mensajes
            WHERE conversacion_id = ?
            ORDER BY fecha ASC, id ASC";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([$conversationId]);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
}