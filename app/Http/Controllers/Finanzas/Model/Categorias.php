<?php

namespace IAServer\Http\Controllers\Finanzas\Model;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $connection = 'finanzas';
    protected $table = 'finanzas.categorias';

    public $timestamps = false;

    protected $fillable = ['categoria','root','icon','color'];

}
