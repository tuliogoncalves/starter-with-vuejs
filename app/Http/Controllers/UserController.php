<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UserController extends BaseController
{
    protected UserRepository $user;
    // protected $cleanResponse = true;

    function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function getdata(Request $request)
    {
        return $this->response(
            $this->user->doQuery()
        );
    }

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
                'paginator' => $this->user->doQuery()
            ]
        );
    }

    public function create(Request $request)
    {
        return $this->sendResponse(
            'Users/form',
            [
                'data' => $this->user->create()
            ]
        );
    }

    public function show(Request $request, $id)
    {
        return $this->sendResponse(
            'Users/form',
            [
                'data' => $this->user->find($id)
            ]
        );
    }

    public function edit(Request $request, $id)
    {
        return $this->sendResponse(
            'Users/form',
            [
                'data' => $this->user->find($id)
            ]
        );
    }

    function store(Request $request)
    {
        $user = $this->user;
        $user->setDataPayload($request->all());

        // Get Validator data
        $validator = $user->getValidator();
        
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            // Try storage new data
            $user->store();

            // Success flash message
            Session::flash('success', 'Registro Adicionado com Sucesso');
        }

        return Redirect::to($this->getSessionUrl());
    }

    function update(Request $request, $id)
    {
        $user = $this->user;
        $user->setDataPayload($request->all());

        // Get Validator
        $validator = $user->getValidator('update');
        
        if ($validator->fails()) {
            // Errors flash message
            return back()->withErrors($validator);
        } else {
            // Try storage new data
            $user->update($id);

            // Success flash message
            Session::flash('success', 'Registro Adicionado com Sucesso');
        }

        return Redirect::to($this->getSessionUrl());
    }

    function destroy(Request $request, $id)
    {
        // Delete record
        $this->user->delete($id);

        // Success flash message
        Session::flash('success', 'Registro Removido com Sucesso');

        return Redirect::to($this->getSessionUrl());
    }
}