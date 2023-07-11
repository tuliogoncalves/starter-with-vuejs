<?php

namespace App\Http\Controllers;
use App\Cruds\EmpresaCrud;
use App\Repositories\EmpresaRepository;
use App\Scriptpage\Controllers\CrudController;


class EmpresaController extends CrudController
{
    protected $repositoryClass = EmpresaRepository::class;
    protected $crudClass = EmpresaCrud::class;

    protected $template = "Empresas";

    protected function dataEdit($id = null, $id2 = null)
    {
        return [
            'data' => $this->repository->find($id)
        ];
    }

   
}
