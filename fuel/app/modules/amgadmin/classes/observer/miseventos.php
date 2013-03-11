<?php

	namespace AMGAdmin;

	use Orm\Model;
	
	class Observer_Miseventos extends \Orm\Observer
	{
		public function after_save(Model $model)
		{
			//\Log::warning('I was notified of the event  on a Model of class '.get_class($model));
			\Log::warning(get_class($model));
		}		
	}