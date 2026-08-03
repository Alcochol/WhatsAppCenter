<?php

namespace App\Core;

use App\Database\Database;
use PDO;

abstract class BaseModel
{
    protected PDO $db;

    protected string $table = '';

    protected string $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all()
    {
        return $this->db
            ->query("SELECT * FROM {$this->table}")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
            WHERE {$this->primaryKey}=?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table}
            WHERE {$this->primaryKey}=?"
        );

        return $stmt->execute([$id]);
    }


    public function insert(array $data)
    {
        $campos = array_keys($data);

        $sql = "INSERT INTO {$this->table}
                (" . implode(',', $campos) . ")
                VALUES
                (:" . implode(',:', $campos) . ")";

        $stmt = $this->db->prepare($sql);

        if ($stmt->execute($data)) {
            return $this->db->lastInsertId();
        }

        return false;
    }


    public function update(int $id,array $data)
    {

        $campos=[];

        foreach($data as $campo=>$valor){

            $campos[]="$campo=:$campo";

        }

        $sql="UPDATE {$this->table}

            SET ".implode(",",$campos)."

            WHERE {$this->primaryKey}=:id";

        $data['id']=$id;

        $stmt=$this->db->prepare($sql);

        return $stmt->execute($data);

    }

    public function first(string $campo, mixed $valor)
    {

        $stmt=$this->db->prepare(

            "SELECT *

            FROM {$this->table}

            WHERE {$campo}=? LIMIT 1"

        );

        $stmt->execute([$valor]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    
    public function exists(string $campo, mixed $valor)
    {

        return $this->first($campo, $valor) !== false;

    }


    public function deactivate(int $id)
    {
        $stmt = $this->db->prepare(

            "UPDATE {$this->table}

            SET activo = 0

            WHERE {$this->primaryKey}=?"

        );

        return $stmt->execute([$id]);
    }

    public function activate(int $id)
    {
        $stmt = $this->db->prepare(

            "UPDATE {$this->table}

            SET activo = 1

            WHERE {$this->primaryKey} = ?"

        );

        return $stmt->execute([$id]);
    }

    public function count()
    {
        return $this->db
            ->query("SELECT COUNT(*) FROM {$this->table}")
            ->fetchColumn();
    }

    public function countWhere(string $campo,mixed $valor)
    {
        $stmt=$this->db->prepare(

            "SELECT COUNT(*)

            FROM {$this->table}

            WHERE {$campo}=?"

        );

        $stmt->execute([$valor]);

        return $stmt->fetchColumn();

    }

    public function getWhere(string $campo, mixed $valor)
    {
        $stmt=$this->db->prepare(

            "SELECT *

            FROM {$this->table}

            WHERE {$campo}=?"

        );

        $stmt->execute([$valor]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    
}