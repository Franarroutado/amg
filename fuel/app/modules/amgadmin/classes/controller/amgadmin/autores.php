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
		if (Input::method() == 'POST')
		{
			$val = Model_Autore::validate('create');
			
			if ($val->run())
			{
				$autore = Model_Autore::forge(array(
					'nombre' => Input::post('nombre'),
					'user_id' => Input::post('user_id'),
					'vo' => 0,
				));

				if ($autore and $autore->save())
				{
					Session::set_flash('success', 'Added autore #'.$autore->id.'.');

					Response::redirect('autores');
				}

				else
				{
					Session::set_flash('error', 'Could not save autore.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		// Preparamos el restro de migas
		$rastro = array(
			'item1' => array(
				'nombre' => 'Autores',
				'ruta'   => 'autores'),
			'item2' => array(
				'nombre' => 'Nuevo Autor',
				'ruta'   => ''),
		);

		$this->template->title = "Autores";
		$this->template->breadcrumb = $rastro;
		$this->template->content = View::forge('autores/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Autores');

		$autore = Model_Autore::find($id, 
			array('related' => array('user'))
		);

		$val = Model_Autore::validate('edit');

		if ($val->run())
		{
			$autore->nombre = Input::post('nombre');
			$autore->user_id = Input::post('user_id');

			if ($autore->save())
			{
				Session::set_flash('success', 'Autor "' . $autore->nombre . '" actualizado.');

				Response::redirect('autores');
			}

			else
			{
				Session::set_flash('error', 'Could not update autore #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$autore->nombre = $val->validated('nombre');
				$autore->user_id = $val->validated('user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('autore', $autore, false);
		}

		// Preparamos el restro de migas
		$rastro = array(
			'item1' => array(
				'nombre' => 'Autores',
				'ruta'   => 'autores'),
			'item2' => array(
				'nombre' => 'Editar Autor',
				'ruta'   => ''),
		);

		$this->template->title = "Autores";
		$this->template->breadcrumb = $rastro;
		$this->template->content = View::forge('autores/edit');

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
				Session::set_flash('success', 'Autor "'.$autore->nombre.'" Eliminado');
			}
			else
			{
				Session::set_flash('error', 'No se ha podido borrar el autor"'.$autore->nombre);
			}
			
		}

		Response::redirect('autores');

	}

}