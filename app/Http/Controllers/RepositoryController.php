<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Scriptpage\Repository\BaseRepository;

class RepositoryController extends BaseController
{
    protected Model $model;
    protected $template;
    protected BaseRepository $repository;

    /**
     * Index
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Inertia\Response
     */
    public function index(Request $request, $id = null)
    {
        $this->setSessionUrl($request);

        return $this->sendResponse(
            $this->template.'/index',
            $this->dataIndex($request)
        );
    }

    /**
     * Create
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Inertia\Response
     */
    public function create(Request $request, $id = null)
    {
        return $this->sendResponse(
            $this->template.'/form',
            $this->dataCreate($request)
        );
    }

    /**
     * Show
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Inertia\Response
     */
    public function show(Request $request, $id)
    {
        return $this->sendResponse(
            $this->template.'/form',
            $this->dataShow($request, $id)
        );
    }

    /**
     * Edit
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Inertia\Response
     */
    public function edit(Request $request, $id)
    {
        return $this->sendResponse(
            $this->template.'/form',
            $this->dataEdit($request, $id)
        );
    }

    /**
     * dataIndex
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return array
     */
    public function dataIndex(Request $request, $id = null)
    {
        return [
            'paginator' => $this->repository->doQuery()
        ];
    }

    /**
     * dataCreate
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return array<Model>
     */
    public function dataCreate(Request $request, $id = null)
    {
        return [
            'data' => $this->repository->create()
        ];
    }

    /**
     * dataShow
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return array
     */
    public function dataShow(Request $request, $id)
    {
        return [
            'data' => $this->repository->find($id),
        ];
    }

    /**
     * dataEdit
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return array
     */
    public function dataEdit(Request $request, $id)
    {
        return $this->dataShow($request, $id);
    }

    /**
     * store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function store(Request $request)
    {
        $repository = $this->repository;
        // $repository->setDataPayload($request->all());

        // Get Validator data
        $validator = $repository->getValidator('store');

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            // Try storage new data
            $this->model = $repository->store();

            // Success flash message
            Session::flash('success', 'Registro Adicionado com Sucesso');
        }

        return Redirect::to($this->getSessionUrl());
    }

    /**
     * update
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function update(Request $request, $id)
    {
        $repository = $this->repository;
        // $repository->setDataPayload($request->all());

        // Get Validator
        $validator = $repository->getValidator('update');

        if ($validator->fails()) {
            // Errors flash message
            return back()->withErrors($validator);
        } else {
            // Try storage new data
            $this->model = $repository->update($id);

            // Success flash message
            Session::flash('success', 'Registro Adicionado com Sucesso');
        }

        return Redirect::to($this->getSessionUrl());
    }

    /**
     * destroy
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy(Request $request, $id)
    {
        // Delete record
        $this->repository->delete($id);

        // Success flash message
        Session::flash('success', 'Registro Removido com Sucesso');

        return Redirect::to($this->getSessionUrl());
    }
}
