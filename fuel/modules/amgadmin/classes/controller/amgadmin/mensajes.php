<?php

namespace AMGAdmin;

class Controller_AMGAdmin_Mensajes extends \AMGAdmin\Controller_AMGAdmin
{
	/**
	 * Shows a grid of messages
	 */
	public function action_index()
	{
		// get all autores not VOIDed
		$contents = Model_Mensaje::find('all',
			array(
				'where' => array(
					'vo' => 0,
				),
		));

		// when just one record is returned, doesn't came into an array, so do it!
		if( !is_array($contents) )
		{
			$contents = array($contents);
		}

		// set the view and add the contents
		$view = \Theme::instance()->view('private/amgadmin/mensajes/index', array(
			'contents' => $contents,
		));

		\Theme::instance()->set_partial('content', $view);
	}

	/**
	 * View a message form
	 * @param  int $id message id
	 */
	public function action_view($id = null)
	{
		is_null($id) and \Response::redirect('admin/mensajes');

		$contents = Model_Mensaje::find($id);

		$view = \Theme::instance()->view('private/amgadmin/mensajes/view', array(
		    'contents' => $contents,
    	));

		\Theme::instance()->set_partial('content', $view);
	}

	/**
	 * Marks the message as read/unread
	 * @param  int $id message id
	 */
	public function action_read($id = null)
	{
		is_null($id) and \Response::redirect('admin/mensajes');

		if ( $mensaje = Model_Mensaje::find($id) )
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

	/**
	 * Soft delete, voids the message.
	 * @param  int $id message id
	 */
	public function action_delete($id = null)
	{
		is_null($id) and \Response::redirect('admin/mensajes');

		if ($mensaje = Model_Mensaje::find($id))
		{
			// void the message 
			$mensaje->vo = 1;
			
			// save changes
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
		// redirect to the messages list
		\Response::redirect('admin/mensajes');
	}
}

/* End of file  */