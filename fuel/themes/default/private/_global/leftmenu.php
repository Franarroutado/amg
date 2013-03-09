<?php

	

?>

<!-- left menu starts -->
<div class="span2 main-menu-span">
	<div class="well nav-collapse sidebar-nav">
		<ul class="nav nav-tabs nav-stacked main-menu">
			<li class="nav-header hidden-tablet"><?php echo __('privado.leftmenu.gestor'); ?></li>
			<li>
				<?php echo Html::anchor('admin',
					'<i class="icon-home"></i><span class="hidden-tablet"> '.__('privado.leftmenu.dashboard').'</span>',
					array('class' => 'ajax-link',)
				); ?>
			<li>
				<?php echo Html::anchor('admin/rexistros',
					'<i class="icon-eye-open"></i><span class="hidden-tablet"> '.__('privado.leftmenu.registros').'</span>',
					array('class' => 'ajax-link',)
				); ?>
			</li>
			<li>
				<?php echo Html::anchor('admin/autores',
					'<i class="icon-edit"></i><span class="hidden-tablet"> '.__('privado.leftmenu.autores').'</span>',
					array('class' => 'ajax-link',)
				); ?>
			</li>
			<li><a class="ajax-link" href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
			<li><a class="ajax-link" href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
			<li><a class="ajax-link" href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
			<li class="nav-header hidden-tablet"><?php echo __('privado.leftmenu.utilidades'); ?></li>
			<li><a class="ajax-link" href="table.html"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
			<li><a class="ajax-link" href="calendar.html"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
			<li><a class="ajax-link" href="grid.html"><i class="icon-th"></i><span class="hidden-tablet"> Grid</span></a></li>
			<li><a class="ajax-link" href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
			<li><a href="tour.html"><i class="icon-globe"></i><span class="hidden-tablet"> Tour</span></a></li>
			<li><a class="ajax-link" href="icon.html"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
			<li><a href="error.html"><i class="icon-ban-circle"></i><span class="hidden-tablet"> Error Page</span></a></li>
			<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
		</ul>
		<label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
	</div><!--/.well -->
</div><!--/span-->
<!-- left menu ends -->