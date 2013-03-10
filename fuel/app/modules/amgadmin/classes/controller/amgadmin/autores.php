<?php

namespace AMGAdmin;

class Controller_AMGAdmin_Autores extends \AMGAdmin\Controller_AMGAdmin
{
	public function action_index()
	{
		// Get all autores not VOID
		$contents = Model_Autore::find('all',
			array(
				'where' => array(
					'vo' => 0,
				),
		));

		if(!is_array($contents))
		{
			$contents = array($contents);
		}

		$view = \Theme::instance()->view('private/amgadmin/autores/index', array(
			'contents' => $contents,
		));

		\Theme::instance()->set_partial('content', $view);
	}

	public function action_view($id = null)
	{
		$contents = Model_Autore::find($id);

		$view = \Theme::instance()->view('private/amgadmin/autores/view', array(
		    'contents' => $contents,
    	));
		\Theme::instance()->set_partial('content', $view);
	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_Autore::validate('create');
			
			if ($val->run())
			{
				$autore = Model_Autore::forge(array(
					'nombre' => \Input::post('nombre'),
					'user_id' => \Input::post('user_id'),
					'vo' => 0,
				));

				if ($autore and $autore->save())
				{
					\Session::set_flash('success', 
						__('privado.autores.msg_autorNuevo', 
							array('nombre' => $autore->nombre)));
					\Response::redirect('admin/autores');
				}

				else
				{
					\Session::set_flash('error', 
						__('privado.autores.msg_erroGuardar', 
							array('nombre' => $autore->nombre)));
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		} 

		$view = \Theme::instance()->view('private/amgadmin/autores/create');

		\Theme::instance()->set_partial('content', $view);
	}

	public function action_edit($id = null)
	{
		is_null($id) and \Response::redirect('admin/autores');

		// If no autor is find do
		if ( ! $autore = Model_Autore::find($id))
		{
			\Session::set_flash('error', __('privado.autores.msg_autorNoEnc'));
			\Response::redirect('admin/autores');
		}

		$val = Model_Autore::validate('edit');

		if ($val->run())
		{
			$autore->nombre = \Input::post('nombre');
			$autore->user_id = \Input::post('user_id');

			if ($autore->save())
			{
				\Session::set_flash('success', 'Autor ' . $autore->nombre . ' actualizado.');
				\Response::redirect('admin/autores');
			}
			else
			{
				\Session::set_flash('error', 
					__('privado.autores.msg_autorActuErr', array('nombre' => $autore->nombre)));
			}
		}
		else
		{
			if (\Input::method() == 'POST')
			{
				$autore->nombre = $val->validated('nombre');
				$autore->user_id = $val->validated('user_id');
				$autore->modified_at = $val->validated('updated_at');

				\Session::set_flash('error', $val->error());
			}
		}

        $view = \Theme::instance()->view('private/amgadmin/autores/edit',
			array('contents' => $autore,)
		);

		\Theme::instance()->set_partial('content', $view);
	}

	public function action_delete($id = null)
	{
		if ($autore = Model_Autore::find($id))
		{
			// $autore->delete();
			// Hacemo un borrado lógico
			$autore->vo = 1;
			if ($autore->save()) 
			{
				\Session::set_flash('success', 
					__('privado.autores.msg_autorDel', array('id' => $id)) );

			}
			else
			{
				\Session::set_flash('error', 
					__('privado.autores.msg_autorDelErr', array('id' => $id)));
			}
		}
		\Response::redirect('admin/autores');
	}
}

/* End of file */