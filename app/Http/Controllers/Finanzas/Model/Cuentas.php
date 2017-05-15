<?php

namespace IAServer\Http\Controllers\Finanzas\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cuentas extends Model
{
    protected $connection = 'finanzas';
    protected $table = 'finanzas.cuentas';

    public static function withShare() {
        return self::where('id_owner',Auth::user()->id)
            ->orWhere('id_owner', DB::raw('(select id_user from finanzas.user_share where with_id_user = '.Auth::user()->id.')'))
            ->orderBy('orden', 'asc');
    }
}
