<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => IAServer\User::class,
        'key'    => '',
        'secret' => '',
    ],
	
	'google' => [
		'client_id' => '1011318778070-r0a3s67h0vf208vmlej93i7eruak8blr.apps.googleusercontent.com',
		'client_secret' => 'leLnPx5kJ8lia35zJhyCbqtY',
		'redirect' => 'http://localhost/expenses/public/auth/google/callback',
	],
	
	'facebook' => [
		'client_id' => '1875795192638938',
		'client_secret' => '833d9cd1bb6015b3d1c975be5cbd6c7c',
		'redirect' => 'http://localhost/expenses/public/auth/facebook/callback',
	],

];
