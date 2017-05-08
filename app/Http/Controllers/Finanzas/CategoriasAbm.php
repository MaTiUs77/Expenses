<?php

namespace IAServer\Http\Controllers\Finanzas;

use IAServer\Http\Controllers\Auth\Entrust\Role;
use IAServer\Http\Controllers\Controller;
use IAServer\Http\Controllers\Finanzas\Model\Categorias;
use IAServer\Http\Controllers\Finanzas\Model\Movimientos;
use IAServer\Http\Requests;
use IAServer\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoriasAbm extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categorias = Categorias::orderBy('categoria','asc')->get();
        $output =  compact('categorias');
        return view('finanzas.categorias.index',$output);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $roles = Role::orderBy('display_name','asc')->get();

        return view('finanzas.movimientos.edit',compact('roles'));
    }

    public function create()
    {
        $categorias = Categorias::orderBy('categoria','asc')->get();
        $output = compact('categorias');

        return view('finanzas.categorias.create',$output);
    }

    public function store()
    {
        $rules = array(
            'categoria'  => 'required|unique:finanzas.categorias',
            'icon'  => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('categorias/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            Categorias::create(Input::all());
            return redirect(route('categorias.create'))->with('message','Categoria creada con exito!');
        }
    }

    public function update($id)
    {
        $rules = array(
            'nombre' => 'required',
            'apellido' => 'required',
            'permiso' => 'numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('movimientos/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = User::find($id);

            if(Input::get('password')!='')
            {
                $user->password = bcrypt(Input::get('password'));
                $user->save();
            }

            $user->profile->nombre = Input::get('nombre');
            $user->profile->apellido = Input::get('apellido');
            $user->profile->save();

            if(is_numeric(Input::get('permiso')) && Input::get('permiso')> 0)
            {
                $user->attachRole(Input::get('permiso'));
            }

            return redirect('movimientos')->with('message','Usuario creado con exito!');
        }
    }

    public function destroy($id)
    {
        $message = 'Movimiento eliminado con exito!';
        $el = Movimientos::find($id);
        if($el) {
            $el->delete();
        } else {
            $message = 'El movimiento no existe!';
        }

        return redirect('movimientos')->with('message',$message);
    }
}
