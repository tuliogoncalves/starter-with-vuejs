<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Scriptpage\Controllers\RepositoryController;

class BaseController extends RepositoryController
{
    protected $allowFilters = false;

    /**
     * setBack
     *
     * @param  Request $request
     * @return void
     */
    final function setSessionUrl(Request $request)
    {
        session(['url' => $request->fullUrl()]);
    }

    /**
     * Get redirect url
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    final function getSessionUrl()
    {
        return session('url');
    }

    /**
     * render
     *
     * @param  mixed $component
     * @param  mixed $props
     * @return \Inertia\Response
     */
    final function render($component, $props = [])
    {
        return Inertia::render($component, $props);
    }

    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @param bool $valida
     * @return \Inertia\Response
     */
    public function sendResponse($component, $result, $message = null, bool $success = true, int $code = 200)
    {
        $resp = [
            'success' => $success,
            'paginator' => null,
            'data' => null,
            'code' => $code,
            'message' => $message,
        ];

        return Inertia::render(
            $component,
            array_merge($resp, $result)
        );
    }
}