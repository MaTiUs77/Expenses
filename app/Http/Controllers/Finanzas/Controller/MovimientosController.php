<?php

namespace IAServer\Http\Controllers\Finanzas\Controller;

use Carbon\Carbon;
use IAServer\Http\Controllers\Finanzas\Model\Cuentas;
use IAServer\Http\Controllers\Finanzas\Model\Movimientos;
use IAServer\Http\Requests;
use IAServer\Http\Controllers\Controller;

class MovimientosController extends Controller
{
    public function ultimosMovimientos()
    {
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'Spanish');

        $date = $this->dateHelpers();
        $cuentas = Cuentas::orderBy('orden', 'asc')->get();

        foreach($cuentas as $cuenta) {
            $cuenta->periodos = Saldos::totalCuenta($cuenta->id);
            $this->extendPeriod($cuenta);

            $cuenta->movimientos = Movimientos::where('id_cuenta',$cuenta->id)
                // ->orWhere('transfer_id_cuenta',$cuenta->id)
                ->orderBy('created_at', 'desc')
                ->get();

            foreach($cuenta->movimientos as $movimiento)
            {
                $movimiento->createdCarbon = Carbon::parse($movimiento->created_at);
                $movimiento->futuro = false;
                $movimiento->transfer = false;

                //$theMonth = (int)$movimiento->createdCarbon->format('m');

                if($movimiento->createdCarbon->diff($date->currentDate)->invert > 0 )
                {
                    $movimiento->futuro = true;
                }
            }
        }

        $output = compact('cuentas','saldos','date');

        return $output;
    }

    private function extendPeriod(Cuentas $cuenta)
    {
        if(count($cuenta->periodos)) {

            $ultimoPeriodo = null;

            foreach ($cuenta->periodos as $periodo) {
                $periodo->carbonDate = Carbon::create($periodo->anio, $periodo->mes, 1, 0, 0, 0);
                $periodo->formatPeriodo = ucfirst($periodo->carbonDate->formatLocalized('%B/%Y'));
                $periodo->humanMes = ucfirst($periodo->carbonDate->formatLocalized('%B'));
            }

            foreach ($cuenta->periodos->sortBy('carbonDate') as $periodo) {
                if($ultimoPeriodo==null)
                {
                    $periodo->balance = $periodo->neto;
                    $ultimoPeriodo = $periodo;
                } else
                {
                    $periodo->balance = $periodo->neto + $ultimoPeriodo->balance;
                    $ultimoPeriodo = $periodo;
                }
            }
        }
    }

    private function dateHelpers()
    {
        $currentDate = Carbon::now();
        $nextMonth = Carbon::now()->addMonth(1);

        $date = (object)[
            'currentDate' => $currentDate,
            'nextMonth' => $nextMonth,
            'currentMonthFormated' => ucfirst($currentDate->formatLocalized('%B de %Y'))
        ];

        return $date;
    }
}
