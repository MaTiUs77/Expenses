<?php

Route::get('/', function () {
    return redirect('/movimientos');
});

Route::post('/atlogin', function () {
    Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')]);
    return redirect('/movimientos');
});

Route::resource('/movimientos', 'Finanzas\MovimientosAbm');
Route::resource('/categorias', 'Finanzas\CategoriasAbm');
