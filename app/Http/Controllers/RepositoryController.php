<?php

namespace App\Http\Controllers;

use App\Services\Roles\RoleService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Scriptpage\Repository\BaseRepository;

class RepositoryController extends BaseController
{
    protected BaseRepository $repository;

    public function index(Request $request, $id = null)
    {
        $this->setSessionUrl($request);

        return $this->sendResponse(
            'Users/index',
            $this->dataIndex($request)
        );
    }

    public function create(Request $request, $id = null)
    {
        return $this->sendResponse(
            'Users/form',
            $this->dataCreate($request)
        );
    }

    public function show(Request $request, $id)
    {
        return $this->sendResponse(
            'Users/form',
            $this->dataShow($request, $id)
        );
    }

    public function edit(Request $request, $id)
    {
        return $this->sendResponse(
            'Users/form',
            $this->dataEdit($request, $id)
        );
    }

    public function dataIndex(Request $request, $id = null)
    {
        return [
            'paginator' => $this->repository->doQuery()
        ];
    }

    public function dataCreate(Request $request, $id = null)
    {
        return [
            'data' => $this->repository->create()
        ];
    }

    public function dataShow(Request $request, $id)
    {
        return [
            'data' => $this->repository->find($id),
        ];
    }

    public function dataEdit(Request $request, $id)
    {
        return $this->dataShow($request, $id);
    }

    function store(Request $request)
    {
        $repository = $this->repository;
        $repository->setDataPayload($request->all());

        // Get Validator data
        $validator = $repository->getValidator('store');

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            // Try storage new data
            $model = $repository->store();

            // Success flash message
            Session::flash('success', 'Registro Adicionado com Sucesso');
        }

        return Redirect::to($this->getSessionUrl());
    }

    function update(Request $request, $id)
    {
        $repository = $this->repository;
        $repository->setDataPayload($request->all());

        // Get Validator
        $validator = $repository->getValidator('update');

        if ($validator->fails()) {
            // Errors flash message
            return back()->withErrors($validator);
        } else {
            // Try storage new data
            $repository->update($id);

            // Success flash message
            Session::flash('success', 'Registro Adicionado com Sucesso');
        }

        return Redirect::to($this->getSessionUrl());
    }

    function destroy(Request $request, $id)
    {
        // Delete record
        $this->repository->delete($id);

        // Success flash message
        Session::flash('success', 'Registro Removido com Sucesso');

        return Redirect::to($this->getSessionUrl());
    }
}