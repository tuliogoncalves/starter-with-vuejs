<?php

namespace App\Http\Controllers;

use App\Cruds\UserCrud;

use App\Repositories\UserRepository;
use App\Scriptpage\Controllers\CrudController;

class UserController extends CrudController
{
    protected $repositoryClass = UserRepository::class;
    protected $crudClass = UserCrud::class;

    protected $template = "Users";

}
