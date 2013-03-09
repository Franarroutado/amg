<?php

namespace AMGAdmin;

class Controller_AMGAdmin_MaterialesDims extends \AMGAdmin\Controller_AMGAdmin
{

	public function action_index()
	{
		$data['materialesDims'] = Model_MaterialesDim::find('all');
		$this->template->title = "MaterialesDims";
		$this->template->content = View::forge('materialesdims/index', $data);

	}

	public function action_view($id = null)
	{
		$data['materialesDim'] = Model_MaterialesDim::find($id);

		is_null($id) and Response::redirect('MaterialesDims');

		// Preparamos el restro de migas
		$rastro = array(
			array(
				'nombre' => __('materiales.materiales'),
				'ruta'   => 'material/view/'),
			array(
				'nombre' => __('materialesDim.ver'),
				'ruta'   => ''),
		);

		$this->template->title = __('materialesDim.ver');
		$this->template->breadcrumb = $rastro;
		$this->template->title = "MaterialesDim";
		$this->template->content = View::forge('materialesdims/view', $data);

	}

	public function action_create($materialId)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Materialesdim::validate('create'); 
			
			if ($val->run())
			{
				$materialesDim = Model_Materialesdim::forge(array(
					'nombre' => Input::post('nombre'),
					'material_id' => Input::post('material_id'),
					'user_id' => Input::post('user_id'),
					'lang' => Input::post('lang'),
					'vo' => Input::post('vo'),
				));

				if ($materialesDim and $materialesDim->save( $materialId ))
				{
					Session::set_flash('success', __('materialesDim.flash_crear_exito'));
					Response::redirect('material/view/'.$materialId);
				}
				else
				{
					Session::set_flash('error', __('materialesDim.flash_crear_error'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		} 

		$data['material'] = Model_Material::find($materialId,
			array('related' => 'materialesdim')
		);

		// Preparamos el restro de migas
		$rastro = array(
			array(
				'nombre' => __('materiales.materiales'),
				'ruta'   => 'material/view/'.$materialId),
			array(
				'nombre' => __('materialesDim.nuevo'),
				'ruta'   => ''),
		);

		$this->template->title = __('materialesDim.nuevo');
		$this->template->breadcrumb = $rastro;
		$this->template->content = View::forge('materialesdims/create', $data);
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('MaterialesDims');

		$data['materialesDims'] = Model_MaterialesDim::find($id);

		$val = Model_MaterialesDim::validate('edit');

		if ($val->run())
		{
			$data['materialesDims']->nombre = Input::post('nombre');
			$data['materialesDims']->material_id = Input::post('material_id');
			$data['materialesDims']->user_id = Input::post('user_id');
			$data['materialesDims']->lang = Input::post('lang');
			$data['materialesDims']->vo = Input::post('vo');

			if ($data['materialesDims']->save())
			{
				Session::set_flash('success', 'Updated materialesDim #' . $id);

				Response::redirect('materialesdims');
			}
			else
			{
				Session::set_flash('error', 'Could not update materialesDim #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$data['materialesDims']->nombre = $val->validated('nombre');
				$data['materialesDims']->material_id = $val->validated('material_id');
				$data['materialesDims']->user_id = $val->validated('user_id');
				$data['materialesDims']->lang = $val->validated('lang');
				$data['materialesDims']->vo = $val->validated('vo');

				Session::set_flash('error', $val->error());
			}
			
			// Preparamos el restro de migas
			$rastro = array(
				array(
					'nombre' => __('materiales.materiales'),
					'ruta'   => 'material/edit/'.$id),
				array(
					'nombre' => __('materialesDim.editar'),
					'ruta'   => ''),
			);

			$this->template->title = __('materialesDim.editar');
			$this->template->breadcrumb = $rastro;
			$this->template->content = View::forge('materialesdims/edit', $data);
		}
	}

	public function action_delete($id = null)
	{
		if ($materialesDim = Model_MaterialesDim::find($id))
		{
			$materialesDim->delete();

			Session::set_flash('success', 'Deleted materialesDim #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete materialesDim #'.$id);
		}

		Response::redirect('materialesdims');

	}


}