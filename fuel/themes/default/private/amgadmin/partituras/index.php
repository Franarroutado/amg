<?php

	$data = \Theme::instance()->get_info('data');
	
	/**
	 * Used for:
	 * + Retrieve partituras
	 */
	$page_values = $data['page_values'];
	//$contents = $page_values['contents'];
	//\Debug::dump($contents);

?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> <?php echo __('privado.partituras.breadcrumb'); ?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th><?php echo __('privado.partituras.titulo'); ?></th>
					  <th><?php echo __('privado.partituras.autor'); ?></th>
					  <th><?php echo __('privado.partituras.genero'); ?></th>
					  <th><?php echo __('privado.partituras.acciones'); ?></th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if ($contents): ?>
					<?php foreach ($contents as $content):  ?>
						<tr>
							<td><?php echo $content->nombre; ?></td>
							<td class="center"><?php echo $content->autore->nombre; ?></td>
							<td class="center"><?php echo $content->genero->nombre;  ?></td>
							<td class="center">
								<?php echo Html::anchor('admin/rexistros/view/'.$content->id, 
									"<i class='icon-zoom-in icon-white'></i>", array('class'=>"btn btn-success")); ?>
								
								<?php echo Html::anchor('admin/rexistros/edit/'.$content->id, 
									"<i class='icon-edit icon-white'></i>", array('class'=>"btn btn-info")); ?>
									
								<?php echo Html::anchor('admin/rexistros/delete/'.$content->id, 
									"<i class='icon-trash icon-white'></i>", array('class'=>"btn btn-danger")); ?>
							</td>
						</tr>				
					<?php endforeach; ?>					
				<?php endif; ?>
			  </tbody>
		  </table>            
		</div>
	</div><!--/span-->
</div>