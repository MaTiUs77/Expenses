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

            $periodos = new PeriodosController($cuenta);
            $cuenta->periodos = $periodos->getSaldos();

            $cuenta->movimientos = Movimientos::where('id_cuenta',$cuenta->id)
                ->orWhere('transfer_id_cuenta',$cuenta->id)
                ->orderBy('created_at', 'desc')
                ->get();

            foreach($cuenta->movimientos as $movimiento)
            {
                $movimiento->createdCarbon = Carbon::parse($movimiento->created_at);
                $movimiento->monthYear = ucfirst($movimiento->createdCarbon->formatLocalized('%B/%Y'));
                $movimiento->futuro = false;
                $movimiento->transfer = false;

                if($movimiento->createdCarbon->diff($date->currentDate)->invert > 0 )
                {
                    $movimiento->futuro = true;
                }
            }

            $lastPeriod = $cuenta->periodos->last();
            $cuenta->actual = [
                'ingreso' => $lastPeriod,
                'egreso' => $lastPeriod
            ];
        }

        $output = compact('cuentas','saldos','date');

        return $output;
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
