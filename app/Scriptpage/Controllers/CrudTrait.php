<?php

namespace App\Scriptpage\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

trait CrudTrait
{

    /**
     * store
     * @param mixed $id
     * @param mixed $id2
     * @return RedirectResponse
     */
    final function crudStore(Request $request, $id = null, $id2 = null)
    {
        // Set request data
        $this->crud->setData($request->all());

        // Valida data
        $validator = $this->crud->validate();
        $validator->validate();

        // Try storage new data
        $this->crud->store();

        // Success flash message
        Session::flash('success', 'Registro Adicionado com Sucesso');

        // Get ID from model
        if (is_null($id)) {
            $id = $this->crud->getId();
        } else {
            $id2 = $this->crud->getId();
        }
    }


    /**
     * update
     *
     * @param mixed $request
     * @param mixed $id
     * @param mixed $id2
     * @return RedirectResponse
     * @throws ValidationException
     */
    final function crudUpdate(Request $request, $id = null, $id2 = null)
    {
        // Set request data
        $this->crud->setData($request->all());

        // Valida data
        $validator = $this->crud->validate();
        $validator->validate();

        // Try update data
        $model_id = $this->getId($id, $id2);
        $this->crud->update($model_id);

        // Success flash message
        Session::flash('success', 'Registro Atualizado com Sucesso');
    }


    /**
     * destroy
     *
     * @param  mixed $request
     * @param  mixed $id
     * @param  mixed $id2
     * @return RedirectResponse
     */
    final function crudDestroy(Request $request, $id = null, $id2 = null)
    {
        // Delete record
        $this->crud->delete($this->getId($id, $id2));

        // Success flash message
        Session::flash('success', 'Registro Removido com Sucesso');
    }


    /**
     * getId
     *
     * @param  mixed $id
     * @param  mixed $id2
     * @return mixed
     */
    final function getId($id = null, $id2 = null)
    {
        return is_null($id2) ? $id : $id2;
    }
}
