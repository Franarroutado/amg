<?php
	$data = \Theme::instance()->get_info('data');
	
	/**
	 * Used for:
	 * + Retrieve autores
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
			<h2><i class="icon-user"></i> <?php echo __('privado.autores.breadcrumb'); ?></h2>
			<div class="box-icon">
				<?php echo Html::anchor('admin/autores/create', 
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
					  <th><?php echo __('privado.autores.nombre'); ?></th>
					  <th><?php echo __('privado.autores.fecha_creacion'); ?></th>
					  <th><?php echo __('privado.autores.acciones'); ?></th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if ($contents): ?>
					<?php foreach ($contents as $content):  ?>
						<tr>
							<td><?php echo $content->nombre; ?></td>
							<td class="center"><?php echo date('d/m/Y',$content->created_at);  ?></td>
							<td class="center">
								<?php echo Html::anchor('admin/autores/view/'.$content->id, 
									"<i class='icon-zoom-in icon-white'></i>", array('class'=>"btn btn-success")); ?>
								
								<?php echo Html::anchor('admin/autores/edit/'.$content->id, 
									"<i class='icon-edit icon-white'></i>", array('class'=>"btn btn-info")); ?>
									
								<?php echo Html::anchor('admin/autores/delete/'. '$content->id', 
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