<?php

return array(

	// Valores comunes
	'comunes' => array(
		'titulo_site'			=> 'Arquivo Musical Galego',
		'intro'					=> 'Entrar',
		'cancelar'				=> 'Cancelar',
		'editar'				=> 'Editar'
	),

	// Valores para la sección admin
	'privado' => array(
		'comunes' => array(
			'usuario' 			=> 'Usuario',
			'password'			=> 'Password',
			'recuerda_me'		=> 'Lémbrame',
			'page_dashboard' 	=> ' :: Dashboard',
			'editar'			=> 'Editar',
			'cancelar'			=> 'Cancelar',
			'guardar'			=> 'Gardar',
			'creado_por' 		=> 'Creado por',
			'fecha_modif'		=> 'F. modificación',
			'jsmsg_btnBorrar'	=> '¿Desexa elimina-lo rexistro?',
			'msg_creadoPor' 	=> 'Usuario que creou ou modificou o rexistro',
			'msg_FechaActPor'	=> 'Data da creación o da última modificación do rexistro',
			'msg_btnEditar'		=> 'Editar este rexistro',
			'msg_btnCancelar'   => 'Cancela esta acción e volve atrás',
			'msg_btnGuardar'	=> 'Gardar os cambios do rexistro',
			'msg_logingOk'		=> 'Está logado correctamente',
			'msg_logoutOk' 		=> 'Se ha deslogado correctamente',
		),

		// Dashboard
		'dashboard' => array(
			'numMsgNuevos'		=> ':numero novos mensaxes.',
		),

		// TopBar
		'topbar' => array(
			'ver_site' 			=> 'ver site',
			'buscar'			=> 'pesquisar',
			'perfil'			=> 'Perfil',
			'salir'				=> 'Pecha-la sesión',
		),

		// LeftMenu
		'leftmenu' => array(
			'dashboard'			=> 'Dashboard',
			'gestor' 			=> 'Xestión',
			'utilidades'		=> 'Utilidades',
			'registros'			=> 'Rexistros',
			'autores'			=> 'Autores',
		),

		// Sección login
		'login' => array(
			'titulo' 			=> 'Benvido ó Arquivo Musical Galego',
			'mensaje1' 			=> 'Introduzca usuario e password.'
		),

		// Pagina Partituras
		'partituras' => array(
			'breadcrumb'		=> 'Rexistros',
			'titulo' 			=> 'Título',
			'autor' 			=> 'Autor',
			'genero' 			=> 'Xéneros',
			'acciones' 			=> 'Accións',
			'crear_nuevo' 		=> 'Novo Rexistro',
			'msg_jsErrSelect'	=> 'No hay seleccionado ningún material para continuar.',
			'msg_jsSelecOpc'	=> 'Por favor, seleccione unha opción.',
			'msg_jsErrUpDown'	 => 'Sólo puede seleccionar un material para subirlo o bajarlo.',
		),

		// Autores Page
		'autores' => array(
			'breadcrumb' 		=> 'Autores',
			'nombre' 			=> 'Nome',
			'fecha_creacion' 	=> 'F. creación',
			'acciones' 			=> 'Accións',
			'msg_autor'			=> 'Nome do autor',
			'nuevoAutor'		=> 'Novo Autor',
			'valm_nonbre_obl'	=> 'O nome do autor é obrigatorio',
			'valm_mensa1'		=> 'Por favor revise os seguintes mensaxes para continuar:',
			'msg_autorNuevo'	=> 'Se ha añadido o autor :nombre ',
			'msg_erroGuardar'	=> 'Non se ha podido gardar o autor :nombre',
			'msg_autorActu'		=> 'Autor nombre actualizado.',
			'msg_autorActuErr'	=> 'Non se ha podido actualizar el autor :nombre',
			'msg_autorDelErr'	=> 'Nos se ha podido eliminar o autor :nombre',
			'msg_autorDel'		=> 'Autor con id :id borrado',
			'msg_autorNoEnc'	=> 'Autor non atopado',
		),

		// Mensajes
		'mensajes' => array(
			'breadcrumb'		=> 'Mensaxe',
			'nombre' 			=> 'Mensaxe',
			'fecha_creacion' 	=> 'Data',
			'acciones' 			=> 'Accións',
			'msg_mensaje'		=> 'Texto do evento, producido automáticamente',
			'msg_codMensaje'	=> 'Número mensaxe: ',
			'evento'			=> 'Evento',
			'msg_msgMarLeido'	=> 'Mensaje #:numero  marcado como leído',
			'msg_msgMarNoLeido' => 'Mensaje #:numero  marcado como non leído',
			'msg_msgReadErr'	=> 'Ocurrio algún problema marcando como leído o mensaxe #:numero',
			'msg_msgDel'		=> 'Mensaxe :id  borrado correctamente',
			'msg_msgDelErr'		=> 'Non se ha podido eliminar o rexistro #:id ',
			'tip_leidoNoLeido'  => 'Faga click aquí para marca-lo mensaxe como leído, non leído',
		),
	),
);

/* End of file  */