<?php

namespace IAServer\Http\Controllers\Finanzas\Model;

use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    protected $connection = 'finanzas';
    protected $table = 'finanzas.movimientos';

    protected $fillable = ['id_cuenta','id_categoria','id_moneda','monto','modo','modo_pago','nota','created_at'];

    public function joinCategoria()
    {
        return $this->hasOne('IAServer\Http\Controllers\Finanzas\Model\Categorias', 'id', 'id_categoria');
    }

    public function joinCuenta()
    {
        return $this->hasOne('IAServer\Http\Controllers\Finanzas\Model\Cuentas', 'id', 'id_cuenta');
    }

    public function joinMoneda()
    {
        return $this->hasOne('IAServer\Http\Controllers\Finanzas\Model\Monedas', 'id', 'id_moneda');
    }
}
