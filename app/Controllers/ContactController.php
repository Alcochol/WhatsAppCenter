<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\Contact;

class ContactController extends BaseController
{
    public function index()
    {
        $contact = new Contact();

        $data = $contact->all();

        $this->render(
            'contacts/index',
            [
                'contactos' => $data
            ],
            'app'
        );

        
    }


    public function store()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');

        if ($nombre === '' || $telefono === '') {
            return $this->error("Todos los campos son obligatorios.");
        }

        $contact = new Contact();

        if ($contact->exists('telefono', $telefono)) {
            return $this->error("El teléfono ya está registrado.");
        }

        $contact->insert([
            'nombre' => $nombre,
            'telefono' => $telefono,
            'origen' => 'Manual',
            'activo' => 1
        ]);

        return $this->success("Contacto guardado correctamente.");
    }


}