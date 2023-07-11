<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends RepositoryController
{
    protected $allowFilters = true;
    // protected $cleanResponse = true;

    function __construct(UserRepository $user)
    {
        $this->repository = $this->startRepository($user);
    }

    public function getdata(Request $request)
    {
        return $this->response(
            $this->repository->doQuery()
        );
    }
}