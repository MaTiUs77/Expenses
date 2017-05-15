<?php

namespace IAServer\Http\Controllers\Finanzas;

use Carbon\Carbon;
use IAServer\Http\Controllers\Finanzas\Controller\MovimientosController;
use IAServer\Http\Controllers\Finanzas\Model\Categorias;
use IAServer\Http\Controllers\Finanzas\Model\Cuentas;
use IAServer\Http\Controllers\Finanzas\Model\Movimientos;
use IAServer\Http\Controllers\IAServer\Filter;
use IAServer\Http\Controllers\IAServer\Util;
use IAServer\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MovimientosAbm extends MovimientosController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $output = $this->ultimosMovimientos();
        return view('finanzas.movimientos.index',$output);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        Filter::dateSession();
        $fecha = Util::dateToEn(Session::get('date_session'));

        $movimiento = Movimientos::find($id);
        $cuentas = Cuentas::withShare()->get();
        $categorias = Categorias::withShare()->get();

        $output = compact('movimiento','categorias','cuentas');

        return view('finanzas.movimientos.edit',$output);

    }

    public function create()
    {
        Filter::dateSession();
        $fecha = Util::dateToEn(Session::get('date_session'));
        $cuentas = Cuentas::withShare()->get();
        $categorias = Categorias::withShare()->get();
        $output = compact('categorias','cuentas');

        return view('finanzas.movimientos.create',$output);
    }

    public function store()
    {
        $params = Input::all();

        $categoria = Categorias::findWithShare(Input::get('id_categoria'));

        if($categoria == null && is_string(Input::get('id_categoria'))) {
            $newCategoria = new Categorias();
            $newCategoria->categoria = Input::get('id_categoria');
            $newCategoria->id_owner = Auth::user()->id;
            $newCategoria->save();

            $params['id_categoria'] = $newCategoria->id;
        }

        $rules = array(
            'modo'  => 'required',
            'monto' => 'required|numeric',
            'id_cuenta' => 'required|numeric',
            'id_categoria' => 'required|numeric'
        );

        $validator = Validator::make($params, $rules);

        if ($validator->fails()) {
            return redirect('movimientos/create')
                ->withErrors($validator)
                ->withInput($params);
        } else {
            if(isset($params['modo']) && $params['modo'] == 'E')
            {
                if($params['monto']>0)
                {
                    $params['monto'] = ($params['monto'] * -1);
                }
            }

            $created_at = Carbon::parse($params['date_session']);

            $params['created_at'] = $created_at->toDateString();

            $movimiento = Movimientos::create($params);
            return redirect(route('movimientos.create'))->with('message','Movimiento creado con exito!');
        }
    }

    public function update($id)
    {
        $params = Input::all();
        $categoria = Categorias::findWithShare(Input::get('id_categoria'));

        if($categoria == null && is_string(Input::get('id_categoria'))) {
            $newCategoria = new Categorias();
            $newCategoria->categoria = Input::get('id_categoria');
            $newCategoria->id_owner = Auth::user()->id;
            $newCategoria->save();

            $params['id_categoria'] = $newCategoria->id;
        }

        $rules = array(
            'modo'  => 'required',
            'monto' => 'required|numeric',
            'id_cuenta' => 'required|numeric',
            'id_categoria' => 'required|numeric'
        );

        $validator = Validator::make($params, $rules);

        if ($validator->fails()) {
            return redirect('movimientos/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            if(isset($params['modo']) && $params['modo'] == 'E')
            {
                if($params['monto']>0)
                {
                    $params['monto'] = ($params['monto'] * -1);
                }
            }

            $created_at = Carbon::parse($params['date_session']);

            $params['created_at'] = $created_at->toDateString();

            $movimiento = Movimientos::find($id)->update($params);

            return redirect('movimientos')->with('message','Movimiento actualizado con exito!');
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
