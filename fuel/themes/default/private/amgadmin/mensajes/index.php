<?php
	$data = \Theme::instance()->get_info('data');
	
	/**
	 * Used for:
	 * + Retrieve mensajes
	 */
	$page_values = $data['page_values'];
?>

<script>
	$(document).ready(function()
	{
		$('a[name*="btnBorrar"]').on('click', function () {
			return confirm('<?php echo __("privado.comunes.jsmsg_btnBorrar") ?>');
		});
	});
</script>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> <?php echo __('privado.mensajes.breadcrumb'); ?></h2>
			<div class="box-icon">
				<?php echo Html::anchor('admin/mensajes/create', 
					"<i class='icon-plus-sign'></i>", 
					array('class'=>"btn btn-round")
				); ?>
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th><?php echo __('privado.mensajes.nombre'); ?></th>
					  <th><?php echo __('privado.mensajes.evento'); ?></th>
					  <th><?php echo __('privado.mensajes.fecha_creacion'); ?></th>
					  <th><?php echo __('privado.mensajes.acciones'); ?></th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if ($contents): ?>
					<?php foreach ($contents as $content):  ?>
						<tr>
							<td>
								<?php if( $content->leido ):  ?>
									<span class="icon icon-color icon-envelope-open" title=".icon32 .icon-color  .icon-bullet-on "></span>
								<?php else: ?>
									<span class="icon icon-color icon-envelope-closed" title=".icon32 .icon-color  .icon-bullet-on "></span>
								<?php endif; ?>
								<?php echo $content->msg; ?>
							</td>
							<td><?php echo $content->evento; ?></td>
							<td class="center"><?php echo date('d/m/Y',$content->created_at);  ?></td>
							<td class="center">
								<?php echo Html::anchor('admin/mensajes/read/'.$content->id, 
									"<i class='icon-check icon-white'></i>", 
									array('class'=>"btn btn-info"
								)); ?>
							
								<?php echo Html::anchor('admin/mensajes/view/'.$content->id, 
									"<i class='icon-zoom-in icon-white'></i>", 
									array('class'=>"btn btn-success"
								)); ?>
									
								<?php echo Html::anchor('admin/mensajes/delete/'. $content->id, 
									"<i class='icon-trash icon-white'></i>", 
									array('class'=>'btn btn-danger','name'=>'btnBorrar',							
								)); ?>
							</td>
						</tr>				
					<?php endforeach; ?>					
				<?php endif; ?>
			  </tbody>
		  </table>            
		</div>
	</div><!--/span-->
</div>