<?php

namespace AMGAdmin;

class Controller_AMGAdmin_Generos extends \AMGAdmin\Controller_AMGAdmin
{

	public function action_index()
	{

		$busqueda = "";
		$data;
		$total_generos;
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

		// Get total generos and fill de array filtered
		if (strlen($busqueda)>0) 
		{
			$total_generos = Model_Genero::count(
	  			array(
	  				'where' => array(
	  					array('nombre', 'like', '%'.$busqueda.'%'),
	  					array('vo' => 0),
		  			),
	  			)
	  		);	

			$this->establecerPaginacion($total_generos, $busqueda);

	  		$data['generos'] = Model_Genero::find('all',
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
			$total_generos = Model_Genero::count(
	  			array(
	  				'where' => array('vo' => 0),
	  			)
	  		);		

			$this->establecerPaginacion($total_generos, $busqueda);

			$data['generos'] = Model_Genero::find('all',
	  			array(
	  				'where'		=> array('vo' => 0),
		  			'limit'		=> Pagination::$per_page,
		  			'offset' 	=> Pagination::$offset,
	  			)
	  		);		
		}

		if ($flag_nuevaBusqueda) {
			$this->template->flash_message = __('admin.resultado_busqueda', 
				array('1' => $total_generos));
		}
		
		$rastro = array(
			'item' => array(
				'nombre' => __('generos.generos'),
				'ruta'   => ''),
		);

		$this->template->title = __('generos.generos');
		$this->template->breadcrumb = $rastro;
		$this->template->content = View::forge('generos/index', $data);

	}

	protected function establecerPaginacion($totalItems, $criterioBusqueda)
	{
		if (strlen($criterioBusqueda)>0) 
		{
			$criterioBusqueda = urlencode($criterioBusqueda)."/";
		}
		
		Pagination::set_config(array(
		    'pagination_url' 	=> 'generos/index/'.$criterioBusqueda,
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
		$data['genero'] = Model_Genero::find($id);

		is_null($id) and Response::redirect('Generos');

		$this->template->title = "Genero";
		$this->template->content = View::forge('generos/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Genero::validate('create');
			
			if ($val->run())
			{
				$genero = Model_Genero::forge(array(
					'nombre' => Input::post('nombre'),
					'user_id' => Input::post('user_id'),
					'lang' => Input::post('lang'),
					'vo' => Input::post('vo'),
				));

				if ($genero and $genero->save())
				{
					Session::set_flash('success', 'Added genero #'.$genero->id.'.');

					Response::redirect('generos');
				}

				else
				{
					Session::set_flash('error', 'Could not save genero.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Generos";
		$this->template->content = View::forge('generos/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Generos');

		$genero = Model_Genero::find($id);

		$val = Model_Genero::validate('edit');

		if ($val->run())
		{
			$genero->nombre = Input::post('nombre');
			$genero->user_id = Input::post('user_id');
			$genero->lang = Input::post('lang');
			$genero->vo = Input::post('vo');

			if ($genero->save())
			{
				Session::set_flash('success', 'Updated genero #' . $id);

				Response::redirect('generos');
			}

			else
			{
				Session::set_flash('error', 'Could not update genero #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$genero->nombre = $val->validated('nombre');
				$genero->user_id = $val->validated('user_id');
				$genero->lang = $val->validated('lang');
				$genero->vo = $val->validated('vo');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('genero', $genero, false);
		}

		$this->template->title = "Generos";
		$this->template->content = View::forge('generos/edit');

	}

	public function action_delete($id = null)
	{
		if ($genero = Model_Genero::find($id))
		{
			$genero->delete();

			Session::set_flash('success', 'Deleted genero #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete genero #'.$id);
		}

		Response::redirect('generos');

	}


}