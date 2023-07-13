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
        $builder = $this->repository->getBuilder();
        return [
            'data' => $builder->with('roles')->find($id),
            'roles' => RoleService::listOfRoles()
        ];
    }

    function store(Request $request)
    {
        $result = parent::store($request);
        $user = $this->model;
        if(isset($user)) $this->repository->updateRoles($user);
        return $result;
    }
    
    function update(Request $request, $id)
    {
        $result = parent::update($request, $id);
        $user = $this->model;
        if(isset($user)) $this->repository->updateRoles($user);
        return $result;
    }
}
