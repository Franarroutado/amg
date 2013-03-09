<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> <?php echo __('privado.autores.breadcrumb'); ?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal">
			  <fieldset>
				<legend><?php echo $contents->nombre;  ?></legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Nombre </label>
				  <div class="controls">
				  	<div class="input-prepend" title="<?php echo __('privado.autores.msg_autor'); ?>"data-rel="tooltip">
					  	<?php echo Form::input(
					  		'nombre',
					  		\Input::post('nombre', isset($contents) ? $contents->nombre : ''),
					  		array('class' => 'input-xxlarge typeahead')
					  	); ?>
					</div>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead"><?php echo __('privado.comunes.creado_por'); ?> </label>
				  <div class="controls">
				  	<div class="input-prepend" title="<?php echo __('privado.comunes.msg_creadoPor'); ?>"data-rel="tooltip">
				  		<span class="input uneditable-input"><?php echo $contents->user->username; ?></span>
				  	</div>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead"><?php echo __('privado.comunes.fecha_modif'); ?> </label>
				  <div class="controls">
				  	<div class="input-prepend" title="<?php echo __('privado.comunes.msg_FechaActPor'); ?>"data-rel="tooltip">
				  		<span class="input uneditable-input"><?php echo date('d/m/Y',$contents->updated_at); ?></span>
				  	</div>
				  </div>
				</div>
				<div class="form-actions">
					<div class="input-prepend" title="<?php echo __('privado.comunes.msg_btnGuardar'); ?>"data-rel="tooltip">
						<button type="submit" class="btn btn-primary"><?php echo __('privado.comunes.guardar'); ?></button>
					</div>
					<div class="input-prepend" title="<?php echo __('privado.comunes.msg_btnCancelar'); ?>"data-rel="tooltip">
						<?php echo Html::anchor('admin/autores/index',
							__('privado.comunes.cancelar'),
							array('class' => 'btn',)
						); ?>
					</div>
				</div>
			  </fieldset>
			</form>   
		</div>
	</div><!--/span-->
</div>