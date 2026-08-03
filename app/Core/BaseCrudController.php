<?php

namespace App\Core;

abstract class BaseCrudController extends BaseController
{
    protected BaseModel $model;

    protected string $view = '';

    protected string $layout = 'app';

    public function index()
    {
        $this->render(
            $this->view . '/index',
            [],
            $this->layout
        );
    }

    public function list()
    {
        return $this->json([
            'data' => $this->model->all()
        ]);
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);

        if (!$id) {
            return $this->error("ID inválido.");
        }

        $registro = $this->model->find($id);

        if (!$registro) {
            return $this->error("Registro no encontrado.");
        }

        return $this->json($registro);
    }

    public function delete()
    {
        $id = (int)($_POST['id'] ?? 0);

        if (!$id) {
            return $this->error("ID inválido.");
        }

        if (!$this->model->find($id)) {
            return $this->error("Registro no encontrado.");
        }

        $this->model->deactivate($id);

        return $this->success("Registro eliminado correctamente.");
    }

    public function restore()
    {
        $id = (int)($_POST['id'] ?? 0);

        if (!$id) {
            return $this->error("ID inválido.");
        }

        if (!$this->model->find($id)) {
            return $this->error("Registro no encontrado.");
        }

        $this->model->activate($id);

        return $this->success("Registro restaurado correctamente.");
    }
}