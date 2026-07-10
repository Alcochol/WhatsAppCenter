<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


return [

    'token' => $_ENV['WHATSAPP_TOKEN'],

    'phone_number_id' => $_ENV['WHATSAPP_PHONE_NUMBER_ID'],

    'business_account_id' => $_ENV['WHATSAPP_BUSINESS_ACCOUNT_ID'],

    'verify_token' => $_ENV['WHATSAPP_VERIFY_TOKEN']


];