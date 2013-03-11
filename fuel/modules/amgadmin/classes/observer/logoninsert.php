<?php

namespace AMGAdmin;

use Orm\Model;

class Observer_Logoninsert extends \Orm\Observer
{

	public static $texto = 'Valor por defecto';

	protected $_texto;

	public function __construct($class)
	{
		$props = $class::observers(get_class($this));
		$this->_texto  = isset($props['texto']) ? $props['texto'] : static::$texto;
		
	}

	public function after_insert(Model $model)
	{
		//\Log::warning('I was notified of the event  on a Model of class '.get_class($model));
		\Log::warning($this->_texto);
	}		
}

/* End of file */