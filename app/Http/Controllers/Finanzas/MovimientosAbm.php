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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MovimientosAbm extends MovimientosController
{
    public function index()
    {
        $output = $this->UltimosMovimientos();
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
        $cuentas = Cuentas::orderBy('orden','asc')->get();
        $categorias = Categorias::orderBy('categoria','asc')->get();

        $output = compact('movimiento','categorias','cuentas');

        return view('finanzas.movimientos.edit',$output);

    }

    public function create()
    {
        Filter::dateSession();
        $fecha = Util::dateToEn(Session::get('date_session'));

        $cuentas = Cuentas::orderBy('orden','asc')->get();
        $categorias = Categorias::orderBy('categoria','asc')->get();
        $output = compact('categorias','cuentas');

        return view('finanzas.movimientos.create',$output);
    }

    public function store()
    {
        $rules = array(
            'modo'  => 'required',
            'monto' => 'required|numeric',
            'id_cuenta' => 'required|numeric',
            'id_categoria' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('movimientos/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $values =  Input::all();

            if(isset($values['modo']) && $values['modo'] == 'E')
            {
                if($values['monto']>0)
                {
                    $values['monto'] = ($values['monto'] * -1);
                }
            }

            $created_at = Carbon::parse($values['date_session']);

            $values['created_at'] = $created_at->toDateString();

            $movimiento = Movimientos::create($values);
            return redirect(route('movimientos.create'))->with('message','Movimiento creado con exito!');
        }
    }

    public function update($id)
    {
        $rules = array(
            'modo'  => 'required',
            'monto' => 'required|numeric',
            'id_cuenta' => 'required|numeric',
            'id_categoria' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('movimientos/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            // store
            $values =  Input::all();

            if(isset($values['modo']) && $values['modo'] == 'E')
            {
                if($values['monto']>0)
                {
                    $values['monto'] = ($values['monto'] * -1);
                }
            }

            $created_at = Carbon::parse($values['date_session']);

            $values['created_at'] = $created_at->toDateString();

            $movimiento = Movimientos::find($id)->update($values);

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
