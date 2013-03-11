<?php

namespace AMGAdmin;

class Model_Partitura extends \Orm\Model_Soft
{
	protected static $_soft_delete = array(
		'deleted_field' => 'vo',
		'mysql_timestamp' => false,
	);

	protected static $_properties = array(
		'id',
		'nombre',
		'autore_id',
		'genero_id',
		'arreglista',
		'tipo_id',
		'fecha',
		'material',
		'centro_id',
		'fondo',
		'edicion',
		'observacione_id',
		'user_id',
		'vo',
		'created_at',
		'updated_at',
	);

	protected static $_belongs_to = array(
		'user' => array(
			'key_from' => 'user_id',
			'model_to' => 'Model_User',
			'key_to'   => 'id',
		),
		'autore', 'genero', 'tipo', 'centro',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		$val->add_field('nombre', 'Nombre', 'required|max_length[50]');
		$val->add_field('autore_id', 'Autore Id', 'required|valid_string[numeric]');
		$val->add_field('genero_id', 'Genero Id', 'required|valid_string[numeric]');
		$val->add_field('arreglista', 'Arreglista', 'required');
		$val->add_field('tipo_id', 'Tipo Id', 'required|valid_string[numeric]');
		$val->add_field('fecha', 'Fecha', 'required|valid_string[numeric]');
		$val->add_field('material', 'Material', 'required');
		$val->add_field('centro_id', 'Centro Id', 'required|valid_string[numeric]');
		$val->add_field('fondo', 'Fondo', 'required');
		$val->add_field('edicion', 'Edicion', 'required');
		$val->add_field('observacione_id', 'Observacione Id', 'required|valid_string[numeric]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('vo', 'Vo', 'required');

		return $val;
	}

}

/* End of file */