<?php

require 'vendor/autoload.php';

use App\Models\Conversation;

/*$conversation=new Conversation();

$id=$conversation->create(1);

echo $id;*/


$conversation=new Conversation();

print_r($conversation->findOpenConversation(1));