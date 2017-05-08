<?php

namespace IAServer\Http\Controllers\IAServer\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $connection = 'finanzas';
    protected $table = 'finanzas.menu';
    public $timestamps = false;
}
