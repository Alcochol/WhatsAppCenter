<?php

require 'vendor/autoload.php';

use App\Database\Database;

try {

    $db = Database::connect();

    echo "Conexión exitosa";

} catch(Exception $e){

    echo $e->getMessage();

}