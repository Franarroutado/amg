<?php
	$data = \Theme::instance()->get_info('data');
	// Used for error reports
	$page_values = $data['page_values'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>Arquivo Musical Galego :: Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">

	<!-- The styles -->
	<!--<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet"> TODO-METER EL ID -->
	<?php echo \Theme::instance()->asset->css('bootstrap-cerulean.css'); ?>
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>

	<?php echo \Theme::instance()->asset->css(
			array(
				'bootstrap-responsive.css', 
				'charisma-app.css', 
				'jquery-ui-1.8.21.custom.css',
				'fullcalendar.css',
				'fullcalendar.print.css',
				'chosen.css',
				'uniform.default.css',
				'colorbox.css',
				'jquery.cleditor.css',
				'jquery.noty.css',
				'noty_theme_default.css',
				'elfinder.min.css',
				'elfinder.theme.css',
				'jquery.iphone.toggle.css',
				'opa-icons.css',
				'uploadify.css',
	)); ?>	
	
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2><?php echo __('privado.login.titulo');  ?></h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					
					
					<?php if(!empty($page_values['errors'])) { ?>
						<div class="alert alert-error">
							<a class="close" data-dismiss="alert" href="#">×</a><?php echo print_r($page_values['errors'], true); ?>
						</div>
					<?php } ?>
					
					<?php if(Session::get_flash('error')) { ?>
						<div class="alert alert-error">
							<?php echo Session::get_flash('error'); ?>
						</div>
					<?php } ?>
					
					<div class="alert alert-info"><?php echo __('privado.login.mensaje1');?></div>
					
					<!--<form class="form-horizontal" action="index.html" method="post">-->
					<?php echo Form::open(array('class' => 'form-horizontal'));  ?>
						<fieldset>
							<div class="input-prepend" title="<?php echo __('privado.comunes.usuario');?>" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><?php echo \Form::input('username',
									Input::post('username'),	
									array(
										'class' => 'input-large span10',
										'id' => 'username',
										'autofocus' => '',
									));?>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="<?php echo __('privado.comunes.password');?>" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><?php echo \Form::password('password', 
									Input::post('username'),
									array(
										'class' => 'input-large span10',
										'id' => 'password',
									));?>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" /><?php echo __('privado.comunes.recuerda_me');?></label>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary"><?php echo __('comunes.intro');?></button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<?php echo \Theme::instance()->asset->js(
		array(
			// jQuery
			'jquery-1.7.2.min.js',
			//jQuery UI
			'jquery-ui-1.8.21.custom.min.js',
			//transition / effect library
			'bootstrap-transition.js',
			//alert enhancer library
			'bootstrap-alert.js',
			//modal / dialog library
			'bootstrap-modal.js',
			//custom dropdown library
			'bootstrap-dropdown.js',
			//scrolspy library
			'bootstrap-scrollspy.js',
			// library for creating tabs
			'bootstrap-tab.js',
			//library for advanced tooltip
			'bootstrap-tooltip.js',
			//popover effect library
			'bootstrap-popover.js',
			//button enhancer library
			'bootstrap-button.js',
			//accordion library (optional, not used in demo)
			'bootstrap-collapse.js',
			//carousel slideshow library (optional, not used in demo)
			'bootstrap-carousel.js',
			//autocomplete library
			'bootstrap-typeahead.js',
			//tour library
			'bootstrap-tour.js',
			//library for cookie management
			'jquery.cookie.js',
			//calander plugin
			'fullcalendar.min.js',
			//data table plugin
			'jquery.dataTables.min.js',

			//chart libraries start
			'excanvas.js',
			'jquery.flot.min.js',
			'jquery.flot.pie.min.js',
			'jquery.flot.stack.js',
			'jquery.flot.resize.min.js',
			//chart libraries end

			//select or dropdown enhancer
			'jquery.chosen.min.js',
			//checkbox, radio, and file input styler
			'jquery.uniform.min.js',
			//plugin for gallery image view
			'jquery.colorbox.min.js',
			//rich text editor library
			'jquery.cleditor.min.js',
			//notification plugin
			'jquery.noty.js',
			//file manager library
			'jquery.elfinder.min.js',
			//star rating plugin
			'jquery.raty.min.js',
			//for iOS style toggle switch
			'jquery.iphone.toggle.js',
			//autogrowing textarea plugin
			'jquery.autogrow-textarea.js',
			//multiple file upload plugin
			'jquery.uploadify-3.1.min.js',
			//history.js for cross-browser state change on ajax
			'jquery.history.js',
			//application script for Charisma demo
			'charisma.js',
	)); ?>
	
		
</body>
</html>