<?php

namespace AMGAdmin;

use Orm\Model;

class Model_Autore extends Model
{
	protected static $_properties = array(
		'id',
		'nombre',
		'user_id',
		'created_at',
		'updated_at',
		'vo',
	);

	protected static $_belongs_to = array(
		'user' => array(
			'key_from' => 'user_id',
			'model_to' => 'Model_User',
			'key_to'   => 'id',
		),
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
		'AMGAdmin\Observer_Miseventos',
	);

	public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		
		$val->add_field('nombre', 'Nombre', 'required|max_length[50]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->set_message('required|max_length[50]', 'You have to fill in your :label so you can proceed');

		return $val;
	}

}
