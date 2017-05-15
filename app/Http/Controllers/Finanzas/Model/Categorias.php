<?php

namespace IAServer\Http\Controllers\Finanzas\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Categorias extends Model
{
    protected $connection = 'finanzas';
    protected $table = 'finanzas.categorias';

    public $timestamps = false;

    protected $fillable = ['categoria','root','icon','color'];

    public static function withShare() {
        return self::where('id_owner',Auth::user()->id)
            ->orWhere('id_owner', DB::raw('(select id_user from finanzas.user_share where with_id_user = '.Auth::user()->id.')'))
            ->orderBy('categoria', 'asc');
    }

    public static function findWithShare($id_categoria) {
        return self::where('id',$id_categoria)
            ->where('id_owner',Auth::user()->id)
            ->orWhere('id_owner', DB::raw('(select id_user from finanzas.user_share where with_id_user = '.Auth::user()->id.')'))
            ->orderBy('categoria', 'asc')
            ->first();
    }

}
