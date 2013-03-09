<?php

namespace AMGAdmin;

use Orm\Model;

class Model_Centro extends Model
{
	protected static $_properties = array(
		'id',
		'nombre',
		'user_id',
		'comentarios',
		'vo',
		'created_at',
		'updated_at',
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
		$val = Validation::forge($factory);
		$val->add_field('nombre', 'Nombre', 'required|max_length[100]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('comentarios', 'Comentarios', 'required');
		$val->add_field('vo', 'Vo', 'required');

		return $val;
	}

}
