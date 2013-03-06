<!-- external javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<?php echo \Theme::instance()->asset->js(
	array(
		// jQuery
		//'jquery-1.7.2.min.js', TODO se añade al principio de la página (layout.php) para que se pueda ejectuar el código cliente correctamente
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


<?php 
// TODO This script must be called only when edit/partituras is called
echo \Theme::instance()->asset->js('materialControl.js'); ?>