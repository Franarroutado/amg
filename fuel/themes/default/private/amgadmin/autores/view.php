<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-eye-open"></i></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		
		<th><?php echo __('privado.autores.nombre'); ?></th>
					  <th><?php echo __('privado.autores.fecha_creacion'); ?></th>
					  <th><?php echo __('privado.autores.acciones'); ?></th>
		
		<div class="box-content">
			<form class="form-horizontal">
			  <fieldset>
				<legend><?php echo $contents->nombre;  ?></legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead"><?php echo __('privado.autores.nombre'); ?> </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->nombre; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead"><?php echo __('privado.autores.creado_por'); ?> </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->user->username; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead"><?php echo __('privado.autores.fecha_creacion'); ?> </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo date('d/m/Y', $contents->created_at); ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead"><?php echo __('privado.autores.fecha_modificacion'); ?> </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo date('d/m/Y',$contents->updated_at); ?></span>
				  </div>
				</div>
				<div class="form-actions">
					<a href="/admin/autores/edit/<?php echo $contents->id  ?>" class="btn btn-primary"><?php echo __('privado.comunes.editar'); ?></a>
					<a href="/admin/autores/index" class="btn">Cancelar</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->
</div>