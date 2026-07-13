<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $conexion = null;

    public static function connect(): PDO
    {
        if (self::$conexion === null) {

            $config = require __DIR__ . '/../../config/config.php';

            try {

                self::$conexion = new PDO(
                    "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
                    $config['db_user'],
                    $config['db_password']
                );

                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {

                die($e->getMessage());

            }

        }

        return self::$conexion;
    }
}