<?php

namespace IAServer\Http\Controllers\Finanzas\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cuentas extends Model
{
    protected $connection = 'finanzas';
    protected $table = 'finanzas.cuentas';
}
