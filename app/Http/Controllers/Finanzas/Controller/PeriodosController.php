<?php

namespace IAServer\Http\Controllers\Finanzas\Controller;

use Carbon\Carbon;
use IAServer\Http\Controllers\Finanzas\Model\Cuentas;
use IAServer\Http\Requests;
use IAServer\Http\Controllers\Controller;

class PeriodosController extends Controller
{
    private $saldos;

    public function __construct(Cuentas $cuenta)
    {
        $this->saldos = SaldosController::totalCuenta($cuenta->id);
        $this->extendSaldos();
    }

    public function getSaldos() {
        return $this->saldos;
    }

    private function extendSaldos()
    {
        if(count($this->saldos)) {

            $ultimoPeriodo = null;

            foreach ($this->saldos as $periodo) {
                $periodo->carbonDate = Carbon::create($periodo->anio, $periodo->mes, 1, 0, 0, 0);
                $periodo->formatPeriodo = ucfirst($periodo->carbonDate->formatLocalized('%B/%Y'));
                $periodo->humanMes = ucfirst($periodo->carbonDate->formatLocalized('%B'));
            }

            $this->saldos = $this->saldos->sortBy('carbonDate');

            foreach ($this->saldos as $periodo) {
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
}
