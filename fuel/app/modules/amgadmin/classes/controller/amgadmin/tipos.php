<?php

namespace AMGAdmin;

class Controller_Tipos extends \AMGAdmin\Controller_AMGAdmin
{

	public function action_index()
	{
		$busqueda = "";
		$data;
		$total_tipo;
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

		// Get total tipos and fill de array filtered
		if (strlen($busqueda)>0) 
		{
			$total_tipo = Model_Tipo::count(
	  			array(
	  				'where' => array(
	  					array('nombre', 'like', '%'.$busqueda.'%'),
	  					array('vo' => 0),
		  			),
	  			)
	  		);	

			$this->establecerPaginacion($total_tipo, $busqueda);

	  		$data['tipos'] = Model_Tipo::find('all',
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
			$total_tipo = Model_Tipo::count(
	  			array(
	  				'where' => array('vo' => 0),
	  			)
	  		);		

			$this->establecerPaginacion($total_tipo, $busqueda);

			$data['tipos'] = Model_Tipo::find('all',
	  			array(
	  				'where'		=> array('vo' => 0),
		  			'limit'		=> Pagination::$per_page,
		  			'offset' 	=> Pagination::$offset,
	  			)
	  		);		
		}

		if ($flag_nuevaBusqueda) {
			$this->template->flash_message = __('admin.resultado_busqueda', 
				array('1' => $total_tipo));
		}

		// Preparamos el restro de migas
		$rastro = array(
			'item' => array(
				'nombre' => __('tipos.tipos'),
				'ruta'   => ''),
		);

		$this->template->title = __('tipos.tipos');
		$this->template->breadcrumb = $rastro;
		$this->template->content = View::forge('tipos/index', $data);
	}

	protected function establecerPaginacion($totalItems, $criterioBusqueda)
	{
		if (strlen($criterioBusqueda)>0) 
		{
			$criterioBusqueda = urlencode($criterioBusqueda)."/";
		}
		
		Pagination::set_config(array(
		    'pagination_url' 	=> 'tipos/index/'.$criterioBusqueda,
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
		$data['tipo'] = Model_Tipo::find($id);

		is_null($id) and Response::redirect('Tipos');

		$this->template->title = "Tipo";
		$this->template->content = View::forge('tipos/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Tipo::validate('create');
			
			if ($val->run())
			{
				$tipo = Model_Tipo::forge(array(
					'nombre' => Input::post('nombre'),
					'user_id' => Input::post('user_id'),
					'lang' => Input::post('lang'),
					'vo' => Input::post('vo'),
				));

				if ($tipo and $tipo->save())
				{
					Session::set_flash('success', 'Added tipo #'.$tipo->id.'.');

					Response::redirect('tipos');
				}

				else
				{
					Session::set_flash('error', 'Could not save tipo.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Tipos";
		$this->template->content = View::forge('tipos/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Tipos');

		$tipo = Model_Tipo::find($id);

		$val = Model_Tipo::validate('edit');

		if ($val->run())
		{
			$tipo->nombre = Input::post('nombre');
			$tipo->user_id = Input::post('user_id');
			$tipo->lang = Input::post('lang');
			$tipo->vo = Input::post('vo');

			if ($tipo->save())
			{
				Session::set_flash('success', 'Updated tipo #' . $id);

				Response::redirect('tipos');
			}

			else
			{
				Session::set_flash('error', 'Could not update tipo #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$tipo->nombre = $val->validated('nombre');
				$tipo->user_id = $val->validated('user_id');
				$tipo->lang = $val->validated('lang');
				$tipo->vo = $val->validated('vo');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('tipo', $tipo, false);
		}

		$this->template->title = "Tipos";
		$this->template->content = View::forge('tipos/edit');

	}

	public function action_delete($id = null)
	{
		if ($tipo = Model_Tipo::find($id))
		{
			$tipo->delete();

			Session::set_flash('success', 'Deleted tipo #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete tipo #'.$id);
		}

		Response::redirect('tipos');

	}


}