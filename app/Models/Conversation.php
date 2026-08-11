<?php

namespace App\Models;

use App\Core\BaseModel;
use PDO;

class Conversation extends BaseModel
{
    protected string $table = 'conversaciones';


    /**
     * Buscar una conversación abierta de un contacto.
     */
    public function findOpenConversation(int $contactId)
    {
        $sql = "
            SELECT *
            FROM conversaciones
            WHERE contacto_id = ?
            AND estado = 'Abierta'
            ORDER BY id DESC
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$contactId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Crear una nueva conversación.
     */
    public function createConversation(int $contactId)
    {
        $sql = "
            INSERT INTO conversaciones
                (contacto_id)
            VALUES
                (?)
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$contactId]);

        return (int)$this->db->lastInsertId();
    }


    /**
     * Obtener todas las conversaciones
     * junto con la información del contacto.
     */
    public function allWithContacts()
{
    $sql = "
        SELECT
            c.id,
            c.contacto_id,
            c.estado,
            c.fecha_inicio,
            c.fecha_fin,

            ct.nombre,
            ct.telefono,
            ct.foto,

            (
                SELECT m.mensaje
                FROM mensajes m
                WHERE m.conversacion_id = c.id
                ORDER BY m.fecha DESC, m.id DESC
                LIMIT 1
            ) AS ultimo_mensaje,

            (
                SELECT m.fecha
                FROM mensajes m
                WHERE m.conversacion_id = c.id
                ORDER BY m.fecha DESC, m.id DESC
                LIMIT 1
            ) AS ultima_interaccion

        FROM conversaciones c

        INNER JOIN contactos ct
            ON ct.id = c.contacto_id

        WHERE ct.activo = 1

        ORDER BY
            ultima_interaccion DESC,
            c.id DESC
    ";

    return $this->db
        ->query($sql)
        ->fetchAll(PDO::FETCH_ASSOC);
}


    /**
     * Obtener una conversación junto
     * con los datos de su contacto.
     */
    public function findWithContact(int $id)
    {
        $sql = "
            SELECT
                c.*,

                ct.nombre,
                ct.telefono,
                ct.foto

            FROM conversaciones c

            INNER JOIN contactos ct
                ON ct.id = c.contacto_id

            WHERE c.id = ?

            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Obtener todas las conversaciones de un contacto.
     */
    public function byContact(int $contactId)
    {
        $sql = "
            SELECT *
            FROM conversaciones
            WHERE contacto_id = ?
            ORDER BY id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$contactId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Cerrar una conversación.
     */
    public function close(int $id)
    {
        $sql = "
            UPDATE conversaciones
            SET
                estado = 'Cerrada',
                fecha_fin = NOW()
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }


    /**
     * Reabrir una conversación.
     */
    public function reopen(int $id)
    {
        $sql = "
            UPDATE conversaciones
            SET
                estado = 'Abierta',
                fecha_fin = NULL
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
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