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

    public function list()
    {
        $contact = new Contact();

        $data = $contact->all();

        return $this->json([
            "data" => $data
        ]);
    }
    public function edit()
    {

        $id=$_GET['id'] ?? 0;

        $contact=new Contact();

        return $this->json(

            $contact->find($id)

        );

    }
    
    public function update()
    {
        $id = $_POST['id'] ?? 0;

        $nombre = trim($_POST['nombre'] ?? '');

        $telefono = trim($_POST['telefono'] ?? '');

        if ($id == 0) {
            return $this->error("ID inválido.");
        }

        if ($nombre === '' || $telefono === '') {
            return $this->error("Todos los campos son obligatorios.");
        }

        $contact = new Contact();

        $actual = $contact->find($id);

        if (!$actual) {
            return $this->error("El contacto no existe.");
        }

        // Solo validar duplicado si cambió el teléfono
        if ($actual['telefono'] != $telefono) {

            if ($contact->exists('telefono', $telefono)) {

                return $this->error("El teléfono ya está registrado.");

            }

        }

        $contact->update($id, [

            'nombre' => $nombre,

            'telefono' => $telefono

        ]);

        return $this->success("Contacto actualizado correctamente.");
    }

    public function delete()
    {
        $id = $_POST['id'] ?? 0;

        if ($id == 0) {
            return $this->error("ID inválido.");
        }

        $contact = new Contact();

        if (!$contact->find($id)) {
            return $this->error("El contacto no existe.");
        }

        $contact->deactivate($id);

        return $this->success("Contacto eliminado correctamente.");
    }

}