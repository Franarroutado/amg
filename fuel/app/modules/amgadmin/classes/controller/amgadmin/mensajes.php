<?php

namespace AMGAdmin;

class Controller_AMGAdmin_Mensajes extends \AMGAdmin\Controller_AMGAdmin
{
	public function action_index()
	{
		// Get all autores not VOID
		$contents = Model_Mensaje::find('all',
			array(
				'where' => array(
					'vo' => 0,
				),
		));

		if(!is_array($contents))
		{
			$contents = array($contents);
		}

		$view = \Theme::instance()->view('private/amgadmin/mensajes/index', array(
			'contents' => $contents,
		));

		\Theme::instance()->set_partial('content', $view);
	}

	public function action_view($id = null)
	{
		$contents = Model_Mensaje::find($id);

		$view = \Theme::instance()->view('private/amgadmin/mensajes/view', array(
		    'contents' => $contents,
    	));
		\Theme::instance()->set_partial('content', $view);
	}

	public function action_read($id = null)
	{
		if ($mensaje = Model_Mensaje::find($id) )
		{
			$mensaFlash = '';
			if ( $mensaje->leido == 0 )
			{
				$mensaje->leido = 1;
				$mensaFlash = 'privado.mensajes.msg_msgMarLeido';
			} 
			else
			{
				$mensaje->leido = 0;
				$mensaFlash = 'privado.mensajes.msg_msgMarNoLeido';
			}

			if ( $mensaje->save() )
			{
				\Session::set_flash('success',
					__($mensaFlash, array('numero' => $mensaje->id) )
				);
			} 
			else 
			{
				\Session::set_flash('error', 
					__('privado.mensajes.msg_msgReadErr', array('id' => $id))
				);
			}
		}
		\Response::redirect('admin/mensajes');
	}

	public function action_delete($id = null)
	{
		if ($mensaje = Model_Mensaje::find($id))
		{
			// $autore->delete();
			// Hacemo un borrado lógico
			$mensaje->vo = 1;
			if ($mensaje->save()) 
			{
				\Session::set_flash('success', 
					__('privado.mensajes.msg_msgDel', array('id' => $id)) );
			}
			else
			{
				\Session::set_flash('error', 
					__('privado.mensajes.msg_msgDelErr', array('id' => $id)));
			}
		}
		\Response::redirect('admin/mensajes');
	}
}

/* End of file  */