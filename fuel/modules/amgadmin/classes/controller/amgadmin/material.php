<?php

namespace AMGAdmin;

class Controller_AMGAdmin_Material extends \AMGAdmin\Controller_AMGAdmin
{

	public function action_index()
	{
		$busqueda = "";
		$data;
		$total_materiales;
		$flag_nuevaBusqueda = false;

		// Establecemos el criterios de búsqueda
		// POST -> obtenemos el valor a través de la caja de búsqueda
		// El criterio de búsqueda va insertado en la URL
		if (Input::method() == 'POST')
		{
			if (Input::post('txtBusqueda')) 
			{
				$busqueda = Input::post('txtBusqueda');
				$flag_nuevaBusqueda = true;
			}
		}
		else
		{
			$segmentos = Uri::segments();
			
			if (count($segmentos)==4) 
			{
				$busqueda=$segmentos[2];
			}
			elseif (count($segmentos)>=4 && $segmentos[2] != 'index') {
				$busqueda=urldecode($segmentos[2]);
			}
		}

		// Get total materiales and fill de array filtered
		if (strlen($busqueda)>0) 
		{
			$total_materiales = Model_Material::count(
	  			array(
	  				'where' => array(
	  					array('nombre', 'like', '%'.$busqueda.'%'),
	  					array('vo' => 0),
		  			),
	  			)
	  		);	

			$this->establecerPaginacion($total_materiales, $busqueda);

	  		$data['materiales'] = Model_Material::find('all',
	  			array(
	  				'where' => array(
	  					array('nombre', 'like', '%'.$busqueda.'%'),
	  					array('vo' => 0),
		  			),
		  			'limit'		=> Pagination::$per_page,
		  			'offset' 	=> Pagination::$offset,
	  			)
	  		);			
		}
		else
		{
			$total_materiales = Model_Material::count(
	  			array(
	  				'where' => array('vo' => 0),
	  			)
	  		);		

			$this->establecerPaginacion($total_materiales, $busqueda);

			$data['materiales'] = Model_Material::find('all',
	  			array(
	  				'where'		=> array('vo' => 0),
		  			'limit'		=> Pagination::$per_page,
		  			'offset' 	=> Pagination::$offset,
	  			)
	  		);		
		}

		if ($flag_nuevaBusqueda) {
			$this->template->flash_message = __('admin.resultado_busqueda', 
				array('1' => $total_materiales));
		}
		
		$rastro = array(
			array(
				'nombre' => __('materiales.materiales'),
				'ruta'   => ''),
		);

		$this->template->title = __('materiales.materiales');
		$this->template->breadcrumb = $rastro;
		$this->template->content = View::forge('material/index', $data);

	}

	protected function establecerPaginacion($totalItems, $criterioBusqueda)
	{
		if (strlen($criterioBusqueda)>0) 
		{
			$criterioBusqueda = urlencode($criterioBusqueda)."/";
		}
		
		Pagination::set_config(array(
		    'pagination_url' 	=> 'material/index/'.$criterioBusqueda,
		    'total_items' 		=> $totalItems,
		    'per_page' 			=> 10,
		    'uri_segment' 		=> strlen($criterioBusqueda)>0 ?  4 : 3,
		    'num_links' 		=> 5,
		    'template' 			=> array(
		        'wrapper_start'			  => '<div class="paging"> ',
		        'wrapper_end' 			  => ' </div>',
		        'page_start'              => '',
		        'page_end'                => '',
		        'previous_start'          => '<span class="previous"> ',
		        'previous_end'            => ' </span>',
		        'previous_inactive_start' => ' <span class="prev disabled">',
		        'previous_inactive_end'   => ' </span>',
		        'previous_inactive_attrs' => array(),
		        'previous_mark'           => '< '.__('admin.anterior'),
		        'previous_attrs'          => array(),
		        'next_start'              => '<span class="next"> ',
		        'next_end'                => ' </span>',
		        'next_inactive_start'     => ' <span class="next-inactive">',
		        'next_inactive_end'       => ' </span>',
		        'next_inactive_attrs'     => array(),
		        'next_mark'               => __('admin.siguiente').' >',
		        'next_attrs'              => array(),
		        'active_start'            => '<span class="current"> ',
		        'active_end'              => ' </span>',
		        'active_attrs'            => array(),
		        'regular_start'           => '<span> ',
		        'regular_end'             => ' </span>',
		        'regular_attrs'           => array(),
		    ),
		));
	}

	public function action_view($id = null)
	{
		$data['material'] = Model_Material::find($id, array('related' => 'materialesdim'));

		is_null($id) and Response::redirect('Material');

		$rastro = array(
			array(
				'nombre' => __('materiales.materiales'),
				'ruta'   => 'material'),
			array(
				'nombre' => __('materiales.ver_material'),
				'ruta'   => ''),
		);

		$this->template->breadcrumb = $rastro;
		$this->template->title = "Material";
		$this->template->content = View::forge('material/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Material::validate('create');
			
			if ($val->run())
			{
				$material = Model_Material::forge(array(
					'nombre' => Input::post('nombre'),
					'user_id' => Input::post('user_id'),
					'vo' => Input::post('vo'),
				));

				if ($material and $material->save())
				{
					Session::set_flash('success', 'Added material #'.$material->id.'.');

					Response::redirect('material');
				}

				else
				{
					Session::set_flash('error', 'Could not save material.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Materials";
		$this->template->content = View::forge('material/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Material');

		$material = Model_Material::find($id);

		$val = Model_Material::validate('edit');

		if ($val->run())
		{
			$material->nombre = Input::post('nombre');
			$material->user_id = Input::post('user_id');
			$material->vo = Input::post('vo');

			if ($material->save())
			{
				Session::set_flash('success', 'Updated material #' . $id);

				Response::redirect('material');
			}

			else
			{
				Session::set_flash('error', 'Could not update material #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$material->nombre = $val->validated('nombre');
				$material->user_id = $val->validated('user_id');
				$material->vo = $val->validated('vo');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('material', $material, false);
		}

		$rastro = array(
			'item' => array(
				'nombre' => __('materiales.materiales'),
				'ruta'   => ''),
		);

		$this->template->breadcrumb = $rastro;
		$this->template->title = __('materiales.materiales');
		$this->template->content = View::forge('material/edit');
	}

	public function action_delete($id = null)
	{
		if ($material = Model_Material::find($id))
		{
			$material->delete();

			Session::set_flash('success', 'Deleted material #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete material #'.$id);
		}

		Response::redirect('material');

	}
	
}