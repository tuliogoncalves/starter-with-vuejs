<?php

namespace App\Scriptpage\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CrudController extends BaseController
{
    use CrudTrait;

    public function index(Request $request, $id = null, $id2 = null)
    {
        $this->setSessionUrl($request);
        return $this->sendResponse(
            $this->template . '/index',
            [
                'paginator' => $this->repository->getData()
            ]
        );
    }


    public function create(Request $request, $id = null, $id2 = null)
    {
        return $this->sendResponse(
            $this->template . '/form',
            [
                'data' => $this->crud->create()
            ]
        );
    }


    public function show(Request $request, $id = null, $id2 = null)
    {
        return $this->edit($request, $id, $id2);
    }


    public function edit(Request $request, $id, $id2 = null)
    {
        return $this->sendResponse(
            $this->template . '/form',
            [
                'data' => $this->repository->with('roles')->find($id)
            ]
        );
    }


    public function store(Request $request, $id = null, $id2 = null)
    {
        self::crudStore($request, $id, $id2);
        return Redirect::to($this->getSessionUrl());
    }


    public function update(Request $request, $id = null, $id2 = null)
    {
        self::crudUpdate($request, $id, $id2);
        return Redirect::to($this->getSessionUrl());
    }


    public function destroy(Request $request, $id = null, $id2 = null)
    {
        self::crudDestroy($request, $id, $id2);
        return Redirect::to($this->getSessionUrl());
    }
}
