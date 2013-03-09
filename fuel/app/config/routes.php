<?php
	return array(
		'_root_'  => 'amgsite/index',  // The default route
		'_404_'   => 'public/404',    // The main 404 route
		

		'site'							=> 'amgsite/index',

		'admin'							=> 'amgadmin/amgadmin/main/dashboard',
		'admin/login'					=> 'amgadmin/amgadmin/login/login',
		'admin/logout'					=> 'amgadmin/amgadmin/login/logout',
		'admin/dashboard'				=> 'amgadmin/amgadmin/main/dashboard',
		
		'admin/rexistros'				=> 'amgadmin/amgadmin/partituras/index',
		'admin/rexistros/index'			=> 'amgadmin/amgadmin/partituras/index',
		'admin/rexistros/view/(:any)'	=> 'amgadmin/amgadmin/partituras/view/$1',
		'admin/rexistros/edit/(:any)'	=> 'amgadmin/amgadmin/partituras/edit/$1',
		'admin/rexistros/create'		=> 'amgadmin/amgadmin/partituras/create',

		'admin/autores'					=> 'amgadmin/amgadmin/autores/index',
		'admin/autores/index'			=> 'amgadmin/amgadmin/autores/index',
		'admin/autores/create'			=> 'amgadmin/amgadmin/autores/create',
		'admin/autores/view/(:any)'		=> 'amgadmin/amgadmin/autores/view/$1',
		'admin/autores/edit/(:any)'		=> 'amgadmin/amgadmin/autores/edit/$1',
		'admin/autores/delete/(:any)'	=> 'amgadmin/amgadmin/autores/delete/$1',

		'admin/mensajes'				=> 'amgadmin/amgadmin/mensajes/index',
		'admin/mensajes/index'			=> 'amgadmin/amgadmin/mensajes/index',
		'admin/mensajes/view/(:any)'	=> 'amgadmin/amgadmin/mensajes/view/$1',

		'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);