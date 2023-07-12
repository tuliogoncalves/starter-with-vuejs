<?php

namespace App\Http\Controllers;

use App\Services\Roles\RoleService;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends RepositoryController
{
    protected $template = 'Users';
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

    public function dataShow(Request $request, $id)
    {
        return [
            'data' => $this->repository->find($id),
            'roles' => RoleService::listOfRoles()
        ];
    }

}