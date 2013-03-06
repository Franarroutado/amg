<?php

namespace AMGAdmin;

class Controller_AMGAdmin extends \Controller_Private
{
	public function before()
	{
		parent::before();

		\Lang::load('amgadmin');

		// Initial configuration
		\Package::load('nvutility');
		\Theme::instance()->set_template($this->template);
	}
}

/* End of file */