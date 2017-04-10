<?php

namespace IAServer\Http\Controllers\Finanzas\Controller;

use IAServer\Http\Controllers\Finanzas\Model\Cuentas;
use IAServer\Http\Controllers\Finanzas\Model\Movimientos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Saldos extends Model
{
    public static function totalActual($id_cuenta)
    {
        $sql = Cuentas::where('id_cuenta',$id_cuenta)
            //->orWhere('transfer_id_cuenta',$id_cuenta)
            ->sum('monto');
        return $sql;
    }

    public static function totalCuenta($id_cuenta)
    {
        $sql = Movimientos::select(
                DB::raw("
    YEAR(m.`created_at`) as anio ,
	MONTH(m.`created_at`) as mes,
	SUM(m.`monto`) as neto,
    (
		select
			SUM(`monto`) as ingreso
		from `finanzas`.`movimientos` subm
		where
			subm.`id_cuenta` = $id_cuenta and
			subm.`modo` = 'I' and
			MONTH(subm.`created_at`) = MONTH(m.`created_at`) and
			YEAR(subm.`created_at`) = YEAR(m.`created_at`)
		group by
			MONTH(subm.`created_at`),
			YEAR(subm.`created_at`)
    ) as ingreso,
    (
		select
			SUM(`monto`) as ingreso
		from `finanzas`.`movimientos` subm
		where
			subm.`id_cuenta` = $id_cuenta and
			subm.`modo` = 'E' and
			MONTH(subm.`created_at`) = MONTH(m.`created_at`) and
			YEAR(subm.`created_at`) = YEAR(m.`created_at`)
		group by
			MONTH(subm.`created_at`),
			YEAR(subm.`created_at`)
    ) as egreso

"            ))->from('movimientos as m')
            ->whereRaw("m.id_cuenta = $id_cuenta")
            //->orWhere('transfer_id_cuenta',$id_cuenta)
            ->groupBy(DB::raw('MONTH(m.`created_at`)'))
            ->groupBy(DB::raw('YEAR(m.`created_at`)'))
            ->get();

        return $sql;
    }

    public static function ingresos($id_cuenta)
    {
        $sql = Movimientos::select(
            DB::raw('
                    SUM(`monto`) as saldo,
                    MONTH(`created_at`) as mes,
                    YEAR(`created_at`) as anio')
        )
            ->where('id_cuenta',$id_cuenta)
            ->where('modo','I')
            ->groupBy(DB::raw('MONTH(`created_at`)'))
            ->groupBy(DB::raw('YEAR(`created_at`)'))
            ->get();

        return $sql;
    }

    public static function egresos($id_cuenta)
    {
        $sql = Movimientos::select(
            DB::raw('
                    SUM(`monto`) as saldo,
                    MONTH(`created_at`) as mes,
                    YEAR(`created_at`) as anio')
        )
            ->where('id_cuenta',$id_cuenta)
            ->where('modo','E')
            ->groupBy(DB::raw('MONTH(`created_at`)'))
            ->groupBy(DB::raw('YEAR(`created_at`)'))
            ->get();

        return $sql;
    }
}
