<?php

namespace AMGAdmin;

class Controller_AMGAdmin_Main extends \AMGAdmin\Controller_AMGAdmin 
{

	public function action_index()
	{
		\Response::redirect('admin/dashboard');
	}

	public function action_dashboard()
	{
		// Set template
		$this->data['template_values']['title'] .=  __('privado.comunes.page_dashboard');

		\Theme::instance()->set_partial('content', 'private/amgadmin/main/dashboard');
	}
}

/* End of file */