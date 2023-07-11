<?php

namespace App\Http\Controllers;

use App\Cruds\TabelaValorCrud;
use App\Repositories\TabelaValoresRepository;
use App\Scriptpage\Controllers\CrudController;
use Inertia\Inertia;


class TabelaValorController extends CrudController
{
    protected $repositoryClass = TabelaValoresRepository::class;
    protected $crudClass = TabelaValorCrud::class;

    protected $template = "tabela_valores"; //envia para CrudController

    protected function dataEdit ($id = null, $id2 = null){

        return [
            'data' => $this->repository->find($id)
        ];

    }
}
