<?php

namespace AMGAdmin;

class Model_Material extends \Orm\Model_Soft
{
	protected static $_soft_delete = array(
		'deleted_field' => 'vo',
		'mysql_timestamp' => false,
	);

	protected static $_properties = array(
		'id',
		'nombre',
		'user_id',
		'vo',
		'created_at',
		'updated_at',
	);

	protected static $_has_many = array('materialesdim');

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
		$val = Validation::forge($factory);
		$val->add_field('nombre', 'Nombre', 'required|max_length[10]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('vo', 'Vo', 'required');

		return $val;
	}

}

/* End of file */