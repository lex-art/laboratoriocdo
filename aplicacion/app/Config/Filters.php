<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		//agregamos nuestro filtro para el logueo
		'Session_filter' => \App\Filters\Session_filter::class,	
		'Is_Login' => \App\Filters\Is_Login::class,
	];

	// Always applied before every request
	public $globals = [
		'before' => [
			//'honeypot'
			// 'csrf',
		],
		'after'  => [
			'toolbar',
			//'honeypot'
		],
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [
		/* Aqui colocamos todas las rutas que queremos validar para el usuarios logueado */
		'Is_Login'=>[
			"before" => [
				"/login",
			]
		],
		"Session_filter"=>[
			"before" => [
				"/app",
				"/ordenes",
				"/resultados",
				"/reportes",
				"/actualizarPassword",
				"/crearusuario"
			]
		]

	];
}
