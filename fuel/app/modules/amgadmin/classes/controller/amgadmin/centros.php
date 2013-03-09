<?php

namespace AMGAdmin;

class Controller_AMGAdmin_Centros extends \AMGAdmin\Controller_AMGAdmin
{

	public function action_index()
	{

		$busqueda = "";
		$data;
		$total_centros;
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

		// Get total centros and fill de array filtered
		if (strlen($busqueda)>0) 
		{
			$total_centros = Model_Centro::count(
	  			array(
	  				'where' 	=> array(
	  					array('nombre', 'like', '%'.$busqueda.'%'),
	  					array('vo' => 0),
		  			),
	  			)
	  		);	

			$this->establecerPaginacion($total_centros, $busqueda);

	  		$data['centros'] = Model_Centro::find('all',
	  			array(
	  				'where' 	=> array(
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
			$total_centros = Model_Centro::count(
	  			array(
	  				'where' => array('vo' => 0),
	  			)
	  		);		

			$this->establecerPaginacion($total_centros, $busqueda);

			$data['centros'] = Model_Centro::find('all',
	  			array(
	  				'where' 	=> array('vo' => 0),
		  			'limit'		=> Pagination::$per_page,
		  			'offset' 	=> Pagination::$offset,
	  			)
	  		);		
		}

		if ($flag_nuevaBusqueda) {
			$this->template->flash_message = __('admin.resultado_busqueda', 
				array('1' => $total_centros));
		}

		// Preparamos el restro de migas
		$rastro = array(
			'item' => array(
				'nombre' => __('centros.centros'),
				'ruta'   => ''),
		);

		$this->template->title = __('Centros');
		$this->template->breadcrumb = $rastro;
		$this->template->content = View::forge('centros/index', $data);

	}

	protected function establecerPaginacion($totalItems, $criterioBusqueda)
	{
		if (strlen($criterioBusqueda)>0) 
		{
			$criterioBusqueda = urlencode($criterioBusqueda)."/";
		}
		
		Pagination::set_config(array(
		    'pagination_url' 	=> 'centros/index/'.$criterioBusqueda,
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
		$data['centro'] = Model_Centro::find($id);

		is_null($id) and Response::redirect('Centros');

		$this->template->title = "Centro";
		$this->template->content = View::forge('centros/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Centro::validate('create');
			
			if ($val->run())
			{
				$centro = Model_Centro::forge(array(
					'nombre' => Input::post('nombre'),
					'user_id' => Input::post('user_id'),
					'comentarios' => Input::post('comentarios'),
					'vo' => Input::post('vo'),
				));

				if ($centro and $centro->save())
				{
					Session::set_flash('success', 'Added centro #'.$centro->id.'.');

					Response::redirect('centros');
				}

				else
				{
					Session::set_flash('error', 'Could not save centro.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Centros";
		$this->template->content = View::forge('centros/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Centros');

		$centro = Model_Centro::find($id);

		$val = Model_Centro::validate('edit');

		if ($val->run())
		{
			$centro->nombre = Input::post('nombre');
			$centro->user_id = Input::post('user_id');
			$centro->comentarios = Input::post('comentarios');
			$centro->vo = Input::post('vo');

			if ($centro->save())
			{
				Session::set_flash('success', 'Updated centro #' . $id);

				Response::redirect('centros');
			}

			else
			{
				Session::set_flash('error', 'Could not update centro #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$centro->nombre = $val->validated('nombre');
				$centro->user_id = $val->validated('user_id');
				$centro->comentarios = $val->validated('comentarios');
				$centro->vo = $val->validated('vo');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('centro', $centro, false);
		}

		$this->template->title = "Centros";
		$this->template->content = View::forge('centros/edit');

	}

	public function action_delete($id = null)
	{
		if ($centro = Model_Centro::find($id))
		{
			$centro->delete();

			Session::set_flash('success', 'Deleted centro #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete centro #'.$id);
		}

		Response::redirect('centros');

	}


}