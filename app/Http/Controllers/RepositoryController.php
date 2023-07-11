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

    /**
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $this->setSessionUrl($request);

        return $this->sendResponse(
            'Users/index',
            [
                'paginator' => $this->repository->doQuery()
            ]
        );
    }

    public function create(Request $request)
    {
        return $this->sendResponse(
            'Users/form',
            [
                'data' => $this->repository->create()
            ]
        );
    }

    public function show(Request $request, $id)
    {
        return $this->sendResponse(
            'Users/form',
            [
                'data' => $this->repository->find($id),
                'roles' => RoleService::listOfRoles()
            ]
        );
    }

    public function edit(Request $request, $id)
    {
        return $this->sendResponse(
            'Users/form',
            [
                'data' => $this->repository->find($id)
            ]
        );
    }

    function store(Request $request)
    {
        $repository = $this->repository;
        $repository->setDataPayload($request->all());

        // Get Validator data
        $validator = $repository->getValidator();
        
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            // Try storage new data
            $repository->store();

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