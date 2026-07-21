<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();



return [

    'token' => $_ENV['WHATSAPP_TOKEN'],

    'phone_number_id' => $_ENV['WHATSAPP_PHONE_NUMBER_ID'],

    'business_account_id' => $_ENV['WHATSAPP_BUSINESS_ACCOUNT_ID'],

    'verify_token' => $_ENV['WHATSAPP_VERIFY_TOKEN'],

    'db_host' => $_ENV['DB_HOST'],
    
    'db_name' => $_ENV['DB_DATABASE'],
 
    'db_user' => $_ENV['DB_USERNAME'],

    'db_password' => $_ENV['DB_PASSWORD'],


];


