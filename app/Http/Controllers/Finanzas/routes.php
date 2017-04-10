<?php

Route::get('/', function () {
    return redirect('/movimientos');
});

Route::resource('/movimientos', 'Finanzas\MovimientosAbm');
Route::resource('/categorias', 'Finanzas\CategoriasAbm');
