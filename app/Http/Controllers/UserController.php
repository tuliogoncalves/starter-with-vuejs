<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Scriptpage\Exceptions\ValidationException;

class UserController extends BaseController
{
    protected UserRepository $user;
    protected $allowFilters = true;
    // protected $cleanResponse = true;

    function __construct(UserRepository $user)
    {
        $this->user = $this->startRepository($user);
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

    function store(Request $request)
    {
        // Try storage new data
        try {
            $this->user->store();
        } catch (ValidationException $e) {
            dd($e);
        }

        // Success flash message
        Session::flash('success', 'Registro Adicionado com Sucesso');

        return redirect()::to($this->getSessionUrl())->->withErrors($validator)();

        // return $this->response(
        //     $this->user->store()
        // );
    }

    function update(Request $request, $id)
    {
        $user = $this->user;
        $user->id = $id;
        return $this->response($this->user->update($id));
    }

    function delete(Request $request, $id)
    {
        $user = $this->user;
        return $this->response($this->user->delete($id));
    }
}