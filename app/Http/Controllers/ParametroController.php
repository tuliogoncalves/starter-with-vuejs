<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametroController extends Controller
{
    protected function dataEdit($id = null, $id2 = null)
    {
        return [
            'data' => $this->repository->find($id)
        ];
    }
}
