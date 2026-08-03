<?php

namespace App\Controllers;

use App\Core\BaseCrudController;
use App\Models\Contact;

class ContactController extends BaseCrudController
{
    public function __construct()
    {
        $this->model = new Contact();

        $this->view = 'contacts';
    }

    public function store()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');

        if ($nombre === '' || $telefono === '') {
            return $this->error("Todos los campos son obligatorios.");
        }

        if ($this->model->exists('telefono', $telefono)) {
            return $this->error("El teléfono ya está registrado.");
        }

        $this->model->insert([
            'nombre'   => $nombre,
            'telefono' => $telefono,
            'origen'   => 'Manual',
            'activo'   => 1
        ]);

        return $this->success("Contacto guardado correctamente.");
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);

        $nombre = trim($_POST['nombre'] ?? '');

        $telefono = trim($_POST['telefono'] ?? '');

        if (!$id) {
            return $this->error("ID inválido.");
        }

        if ($nombre === '' || $telefono === '') {
            return $this->error("Todos los campos son obligatorios.");
        }

        $actual = $this->model->find($id);

        if (!$actual) {
            return $this->error("El contacto no existe.");
        }

        if (
            $actual['telefono'] != $telefono &&
            $this->model->exists('telefono', $telefono)
        ) {
            return $this->error("El teléfono ya está registrado.");
        }

        $this->model->update($id, [
            'nombre' => $nombre,
            'telefono' => $telefono
        ]);

        return $this->success("Contacto actualizado correctamente.");
    }
}