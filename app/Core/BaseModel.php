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

    public function find($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table}
            WHERE {$this->primaryKey}=?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
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


    public function update($id,array $data)
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

    public function first(string $campo,$valor)
    {

        $stmt=$this->db->prepare(

            "SELECT *

            FROM {$this->table}

            WHERE {$campo}=? LIMIT 1"

        );

        $stmt->execute([$valor]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    
    public function exists(string $campo,$valor)
    {

        return $this->first($campo,$valor)!==false;

    }
}