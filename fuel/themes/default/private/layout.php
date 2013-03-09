<?php
	$data = \Theme::instance()->get_info('data');
	$template_values = $data['template_values'];
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
		<title><?php echo $template_values['title']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
		<meta name="author" content="Muhammad Usman">

		<!-- TODO se mueve del footer.php. Se debería poder inyectar el código al footer. cuando se pueda hacer mover este js al footer.php  -->
		<?php echo \Theme::instance()->asset->js(array('jquery-1.7.2.min.js', 'jquery.validate.min.js')); ?>

		<!-- The styles -->
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
		
		<?php echo $partials['topbar']; ?>
		
		<div class="container-fluid">
			<div class="row-fluid">
			
        		<?php echo $partials['leftmenu']; ?>
        		
        		<div id="content" class="span10">
				<!-- content starts -->
				
					<div>
						<ul class="breadcrumb">
							<li>
								<a href="#">Home</a> <span class="divider">/</span>
							</li>
							<li>
								<a href="#">Dashboard</a>
							</li>
						</ul>
					</div>


					<?php if ( \Session::get_flash('error') ) : ?>
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<p><?php echo implode('</p><p>', e((array) \Session::get_flash('error'))); ?></p>
						</div>
					<?php elseif ( \Session::get_flash('success') ) : ?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<p><?php echo implode('</p><p>', e((array) \Session::get_flash('success'))); ?></p>
						</div>
					<?php endif; ?>
					
	        		<?php echo $partials['content']; ?>   	
					
        			<!-- content ends -->
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
				
			<hr>

			<div class="modal hide fade" id="myModal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3>Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here settings can be configured...</p>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn" data-dismiss="modal">Close</a>
					<a href="#" class="btn btn-primary">Save changes</a>
				</div>
			</div>
			
	        <footer>
				<p class="pull-left">&copy; <a href="http://usman.it" target="_blank">Muhammad Usman</a> 2012</p>
				<p class="pull-right">Powered by: <a href="http://usman.it/free-responsive-admin-template">Charisma</a></p>
			</footer>
			
		</div><!--/.fluid-container-->
		
		<?php echo $partials['footer']; ?> 
		
	</body>
</html>