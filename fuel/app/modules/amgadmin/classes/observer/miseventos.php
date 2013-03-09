<?php

	namespace AMGAdmin;
	
	class Observer_Miseventos extends \Orm\Observer
	{
		public function after_save(\AMGAdmin\Model_Autore $model)
		{
			\Log::warning('I was notified of the event  on a Model of class '.get_class($model));
		}		
	}