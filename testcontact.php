<?php

require 'vendor/autoload.php';

use App\Models\Contact;

$contact = new Contact();

$cliente = $contact->findByPhone("5213117439200");

echo "<pre>";

print_r($cliente);

/*<?php

require 'vendor/autoload.php';

use App\Models\Contact;

$contact = new Contact();

$id = $contact->create("5213117439200","Angel");

echo $id;*/