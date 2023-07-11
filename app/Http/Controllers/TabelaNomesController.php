<?php

namespace App\Http\Controllers;

use App\Cruds\TabelaNomesCrud;
use App\Models\tabela_nome;
use App\Repositories\TabelaNomesRepository;
use App\Scriptpage\Controllers\CrudController;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TabelaNomesController extends CrudController
{
    protected $repositoryClass = TabelaNomesRepository::class;
    protected $crudClass = TabelaNomesCrud::class;

    protected $template = "tabela_nomes";


    protected function dataEdit ($id = null, $id2 = null){

        // $dados = [];

        // $dados['nome_usuario'] = Auth::user()->nome;

        // $this->repository->update($id, $dados);

        // TabelaNome::update(['xxxx' => Auth::user()->nome])->where($id);

        return [

            'data' => $this->repository->find($id)
        ];

    }
}
