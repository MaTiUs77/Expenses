<?php

namespace IAServer\Http\Controllers\Finanzas\Model;

use Illuminate\Database\Eloquent\Model;

class Monedas extends Model
{
    protected $connection = 'finanzas';
    protected $table = 'finanzas.monedas';
}
