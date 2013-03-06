<?php

namespace AMGSite;

class Controller_AMGSite extends \Controller_Public
{
	public function before()
	{
		parent::before();
 		// Get blog data
        /*$this->data['page_values']['categories'] = Model_Category::find()->order_by('title', 'asc')->get();
        $this->data['page_values']['pages'] = Model_Page::find()->where('published', 1)->order_by('title', 'asc')->get();
*/
        // Set template
  /*      $this->data['partials']['search'] = \Theme::instance()->set_partial('search', 'public/nvblog/_global/search');
        $this->data['partials']['categories'] = \Theme::instance()->set_partial('categories', 'public/nvblog/_global/categories');
        $this->data['partials']['pages'] = \Theme::instance()->set_partial('pages', 'public/nvblog/_global/pages');
	*/
	}

	public function action_index()
	{
		\Theme::instance()->set_partial('content', 'public/amgsite/index');
	}
}

/* End of file */