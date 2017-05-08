<?php
require('Controllers/Finanzas/routes.php');

Route::auth();

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/home', 'HomeController@index');
