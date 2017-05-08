<?php

Route::get('/', function () {
    return redirect('/movimientos');
});

Route::post('/atlogin', function () {
//    Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')]);
	
	$remember = Input::get('rememberme');
	
	 $userdata = array(
		'email'     => Input::get('email'),
		'password'  =>  Input::get('password')
	);
		
    if (Auth::attempt($userdata, $remember)) {
		return redirect('/movimientos');
	} else {
		return back()->withErrors(['Credencial incorrecta!']);	
	}	    
});

Route::resource('/movimientos', 'Finanzas\MovimientosAbm');
Route::resource('/categorias', 'Finanzas\CategoriasAbm');
