<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {

    /**
     * Home routes
     */
    addRoute('web/home');

    /**
     * Users routes
     */
    addRoute('web/users');

});

/**
 * Login routes
 */
addRoute('web/login');

Route::middleware('public')->group(function () {
    /**
     * Home routes
     */
    addRoute('public/home');
});
