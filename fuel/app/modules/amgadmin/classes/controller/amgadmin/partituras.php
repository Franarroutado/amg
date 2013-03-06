<?php

namespace AMGAdmin;

class Controller_AMGAdmin_Partituras extends \AMGAdmin\Controller_AMGAdmin
{
	public function action_index()
	{
		// Get all partiruras not VOID
        $contents = Model_Partitura::find('all' ,
        	array(
        		'where' => array(
        				array('vo' => 0),
        			),
        		'related' => array('autore', 'genero')
        	));
        
        if (!is_array($contents)) {
        	$contents = array($contents);
        }
		
		$view = \Theme::instance()->view('private/amgadmin/partituras/index', array(
		    'contents' => $contents,
    	));

		\Theme::instance()->set_partial('content', $view);
	}

	public function action_view($id = null)
	{
		$contents = Model_Partitura::find($id);

		$view = \Theme::instance()->view('private/amgadmin/partituras/view', array(
		    'contents' => $contents,
    	));

		\Theme::instance()->set_partial('content', $view);
	}

	public function action_create()
	{
		$tipos = Model_Tipo::find('all');
		$misTipos;
		foreach ($tipos as $tipo) {
			$misTipos[$tipo->id] = $tipo->nombre;
		}

		$data['tipo'] = $misTipos;

		$materiales = Model_Material::find('all',
			array(
				'order_by' => 'nombre' 
		));
		
		$mismateriales;
		foreach ($materiales as $material) {
			$mismateriales[$material->id] = $material->nombre;
		}

		$data['material'] = $mismateriales;

		if (\Input::method() == 'POST')
		{
			$val = Model_Partitura::validate('create');
			
			if ($val->run())
			{
				$partitura = Model_Partitura::forge(array(
					'nombre' => \Input::post('nombre'),
					'autore_id' => \Input::post('autore_id'),
					'genero_id' => \Input::post('genero_id'),
					'arreglista' => \Input::post('arreglista'),
					'tipo_id' => \Input::post('tipo_id'),
					'fecha' => \Input::post('fecha'),
					'material' => \Input::post('material'),
					'centro_id' => \Input::post('centro_id'),
					'fondo' => \Input::post('fondo'),
					'edicion' => \Input::post('edicion'),
					'observacione_id' => \Input::post('observacione_id'),
					'user_id' => \Input::post('user_id'),
					'vo' => \Input::post('vo'),
				));

				\Debug::dump(Input::post('lstSelected'));

				if ($partitura and $partitura->save())
				{
					\Session::set_flash('success', 'Added partitura #'.$partitura->id.'.');

					\Response::redirect('partituras');
				}

				else
				{
					\Session::set_flash('error', 'Could not save partitura.');
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$view = \Theme::instance()->view('private/amgadmin/partituras/create', array(
		    'data' => $data,
    	));

		\Theme::instance()->set_partial('content', $view);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Partituras');

		$partitura = Model_Partitura::find($id,
			array('related' => array('autore', 'genero')));

		$tipos = Model_Tipo::find('all');
		$misTipos;
		foreach ($tipos as $tipo) {
			$misTipos[$tipo->id] = $tipo->nombre;
		}

		$data['tipo'] = $misTipos;

		$materiales = Model_Material::find('all',
			array(
				'order_by' => 'nombre' 
		));
		
		$mismateriales;
		foreach ($materiales as $material) {
			$mismateriales[$material->id] = $material->nombre;
		}

		$data['material'] = $mismateriales;

		$val = Model_Partitura::validate('edit');

		if ($val->run())
		{
			$partitura->nombre = \Input::post('nombre');
			$partitura->autore_id = \Input::post('autore_id');
			$partitura->genero_id = \Input::post('genero_id');
			$partitura->arreglista = \Input::post('arreglista');
			$partitura->tipo_id = \Input::post('tipo_id');
			$partitura->fecha = \Input::post('fecha');
			$partitura->material = \Input::post('material');
			$partitura->centro_id = \Input::post('centro_id');
			$partitura->fondo = \Input::post('fondo');
			$partitura->edicion = \Input::post('edicion');
			$partitura->observacione_id = \Input::post('observacione_id');
			$partitura->user_id = \Input::post('user_id');
			$partitura->vo = \Input::post('vo');


			if ($partitura->save())
			{
				\Session::set_flash('success', 'Updated partitura #' . $id);

				\Response::redirect('partituras');
			}

			else
			{
				\Session::set_flash('error', 'Could not update partitura #' . $id);
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
				$partitura->nombre = $val->validated('nombre');
				$partitura->autore_id = $val->validated('autore_id');
				$partitura->genero_id = $val->validated('genero_id');
				$partitura->arreglista = $val->validated('arreglista');
				$partitura->tipo_id = $val->validated('tipo_id');
				$partitura->fecha = $val->validated('fecha');
				$partitura->material = $val->validated('material');
				$partitura->centro_id = $val->validated('centro_id');
				$partitura->fondo = $val->validated('fondo');
				$partitura->edicion = $val->validated('edicion');
				$partitura->observacione_id = $val->validated('observacione_id');
				$partitura->user_id = $val->validated('user_id');
				$partitura->vo = $val->validated('vo');

				\Debug::dump( \Input::post('material') );

				\Session::set_flash('error', $val->error());

			}

			//$this->template->set_global('partitura', $partitura, false);
			$data['partitura'] =  $partitura;
			//\Theme::instance()->template->set_global('contents', $partitura, false);
		}

		// Preparamos el restro de migas
		/*$rastro = array(
			'item1' => array(
				'nombre' => __('partituras.partituras'),
				'ruta'   => 'partituras'),
			'item2' => array(
				'nombre' => __('partituras.editar_partituras'),
				'ruta'   => ''),
		);

		$this->template->breadcrumb = $rastro;
		$this->template->title = __('partituras.editar_partituras')." - ".$partitura->nombre;
		$this->template->content = View::forge('partituras/edit', $data);*/

		$view = \Theme::instance()->view('private/amgadmin/partituras/edit', array(
		    'data' => $data,
    	));

		\Theme::instance()->set_partial('content', $view);
	}

	public function action_delete($id = null)
	{
		if ($partitura = Model_Partitura::find($id))
		{
			$partitura->delete();

			Session::set_flash('success', 'Deleted partitura #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete partitura #'.$id);
		}

		Response::redirect('partituras');

	}
}