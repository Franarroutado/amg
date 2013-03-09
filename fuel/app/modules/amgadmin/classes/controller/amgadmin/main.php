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

		$contents = Model_Autore::find('all',
			array(
				'where' => array(
					'user_id' => 0,
				),
		));

		// Set template
		$this->data['template_values']['title'] .=  __('privado.comunes.page_dashboard');

		\Theme::instance()->set_partial('content', 'private/amgadmin/main/dashboard');
	}
}

/* End of file */