<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Main');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//para archivos dinamicos
//$routes->get('/login', 'Main::login');
//para cosas estaticas como la página web se recomienta udar add add
/* --------------------------- Rutas estaticas de la pagina web  -----------------------*/
$routes->add('/', 'Main::index');
$routes->add('/nosotros', 'Main::pagina/nosotros');
$routes->add('/servicios', 'Main::pagina/servicios');
$routes->add('/consultas', 'Main::pagina/consultas');
$routes->add('/contacto', 'Main::pagina/contacto');
$routes->add('/resultado_pendiente', 'Main::pagina/consulta_pendiente_pago');



/* --------------------------- Rutas dinamicas el inicio de sesion  -----------------------*/
$routes->add('/login', 'SessionController::index');
$routes->get('/salir', 'SessionController::lologout');
$routes->get('/actualizar_usuario', 'SessionController::updateUser/actualizarUsuario'); //protegida


/******************** Agrupacion de rutas para verificar quienes tienen acceso  **********************/
//$routes->group('admin', ['namespace'=> 'App\Controllers\AppController','filter'=>'Session_filter:admin'], function($routes){
	/* ------------------------ Rutas dinamicas para la aplicacion web estas las 
	vamos a proteger con liters de codeiniter para que no puedan acceder sin haberse logueado  -----------------------*/
	$routes->get('/app', 'AppController::index');

	//---------------------------- Ruta ordenes de trabajo -------------------------------------------
	$routes->get('/ordenes', 'AppController::crearOrden');
	$routes->get('/ver_ordenes', 'AppController::verOrden');


	//-------------------------------- Rutas las pruebas y ensayos -------------------------------------------
	$routes->get('/ver_pruebas_ensayos', 'AppController::verPruebasEnsayos');
	$routes->get('/crear_prueba_ensayo', 'AppController::resourse/prueba_ensayo_crear');//funcion resourse del app controller sirve para redireccionar
	$routes->get('/ver_orden', 'AppController::getOrden');
	$routes->get('/ver_orden_evaluador', 'AppController::getOrdenEvaluador');
	$routes->get('/actualizar_orden', 'AppController::getOrdenUpdate');
	$routes->get('/imprimir', 'OrdenesController::imprimirOrden');
	//---------------------------- Ruta para obtenr los clientes en formato jhson -------------------------------------------
	$routes->get('/get_cliente', 'AppController::getCliente');

	//----------------------- Rutas para subir resultados de orden de trabajo --------------------------

	$routes->get('/resultados', 'AppController::resultados');
	$routes->add('/subir_resultado', 'AppController::subirResultado');//pasa por parametro 
	$routes->add('/editar_resultado', 'AppController::editarResultado');//pasa por parametro 	

	//---------------------------- Ruta ordenes de trabajo -------------------------------------------
	$routes->get('/reportes', 'AppController::resourse/reportes');

	//---------------------------- Rutas para  los usuarios -------------------------------------------
	$routes->get('/usuarios_crear', 'AppController::resourse/usuarios_crear'); // Vista para crear usuario
	$routes->get('/usuarios_listar', 'AppController::listarUsuarios'); // Vista para vertodos los usuario

	//---------------------------- Ruta  para ver la bitacoa-------------------------------------------
	$routes->get('/bitacora', 'AppController::verBitacora');
	$routes->get('/evento', 'AppController::evento_publicar');

	//---------------------------- Ruta  para editar perfil-------------------------------------------
	$routes->get('/editar_perfil', 'AppController::resourse/editar_perfil');

	//---------------------------- Ruta  crear un evento-------------------------------------------
	





//});


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
