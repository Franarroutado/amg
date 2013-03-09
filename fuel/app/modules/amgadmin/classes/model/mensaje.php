<?php

namespace AMGAdmin;

use Orm\Model;

class Model_Mensaje extends Model
{
	protected static $_properties = array(
		'id',
		'msg',
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
	);

	public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		
		$val->add_field('msg', 'Mensaje', 'required');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		
		return $val;
	}
}