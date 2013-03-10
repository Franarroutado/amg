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

		$loggedOnUser = $this->data['site_values']['global_user'];
		$contents;

		//$contents['num_mensajes'] = 
		$resultados = \DB::select(\DB::expr('COUNT(*) as count'))
				->from('mensajes')
				->where('vo', 0)
				->and_where('user_id', $loggedOnUser->id)
				->execute(); 

		// find all messages avaliable
		foreach ($resultados as $valor)
		{
			$contents['num_mensajes'] = $valor['count'];
		}

		$resultados = \DB::select(\DB::expr('COUNT(*) as count'))
				->from('mensajes')
				->where('vo', 0)
				->and_where('user_id', $loggedOnUser->id)
				->and_where('leido', '0')
				->execute();

		// find not readed messages
		foreach ($resultados as $valor)
		{
			$contents['num_mensajesNoLeidos'] = $valor['count'];
		}

		$view = \Theme::instance()->view('private/amgadmin/main/dashboard', array(
			'contents' => $contents,
		));
		\Theme::instance()->set_partial('content', $view);

		// Set template
		//$this->data['template_values']['title'] .=  __('privado.comunes.page_dashboard');

		//\Theme::instance()->set_partial('content', 'private/amgadmin/main/dashboard');
	}
}

/* End of file */