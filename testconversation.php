<?php

require 'vendor/autoload.php';

use App\Models\Conversation;

/*$conversation=new Conversation();

$id=$conversation->createconversacion(1);

echo $id;*/


$conversation=new Conversation();

print_r($conversation->findOpenConversation(1));