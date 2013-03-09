<?php 
	$data = \Theme::instance()->get_info('data');
	/**
	* Used for:
	* + get the username data
	 */
	$usernameId = $data['site_values']['global_user']->id;
	$username = $data['site_values']['global_user']->username; 
?>
<script>

	$(document).ready(function()
	{
		var errorPanel = $('#errorPanel');

		// Si viene del servidor con errores existirán mensajes que deberán ser mostrados
		if ( errorPanel.find('li').length == 0 )
		{
			errorPanel.hide();
		}

		$('#submitForm').valisdate({
			errorLabelContainer: "#messageBox",
			wrapper: "li",
			invalidHandler: function(event, validator) {
		      // 'this' refers to the form
		      var errors = validator.numberOfInvalids();
		      if (errors) {
		        var message =  "<?php echo __('privado.autores.valm_mensa1');  ?>";
		        errorPanel.find('span').html(message);
		        errorPanel.show();
		      } else {
		        errorPanel.hide();
		      }
		    },
			rules: {
				nombre: {
					required: true
				}
			},
			messages: {
				nombre: "<?php echo __('privado.autores.valm_nonbre_obl');  ?>"
			}
		});
	});

</script>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> <?php echo __('privado.autores.breadcrumb'); ?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
			</div>
		</div>
		<div class="box-content">
		
			<?php if ( \Session::get_flash('error') ) : ?>
				<div id="errorPanel" class="alert alert-error">
					<span><?php echo __('privado.autores.valm_mensa1');  ?></span>
					<ul id="messageBox">
						<li><?php echo implode('</li><li>', e((array) \Session::get_flash('error'))); ?></li>
					</ul>
				</div>
			<?php else: ?>
				<div id="errorPanel" class="alert alert-error">
					<span></span>
					<ul id="messageBox"></ul>
				</div>
			<?php endif; ?>
			<?php echo Form::open(array('id' => 'submitForm', 'class' => 'form-horizontal')); ?>
			  <fieldset>
				<legend><?php echo __('privado.autores.nuevoAutor');  ?></legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Nombre </label>
				  <div class="controls">
				  	<div class="input-prepend" title="<?php echo __('privado.autores.msg_autor'); ?>"data-rel="tooltip">
					  	<?php echo Form::input(
					  		'nombre',
					  		\Input::post('nombre', ''),
					  		array('class' => 'input-xxlarge typeahead')
					  	); ?>
					</div>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead"><?php echo __('privado.comunes.creado_por'); ?> </label>
				  <div class="controls">
				  	<div class="input-prepend" title="<?php echo __('privado.comunes.msg_creadoPor'); ?>"data-rel="tooltip">
				  		<span class="input-large uneditable-input"><?php echo $username; ?></span>
				  		<?php echo Form::hidden('user_id', $usernameId); ?>
				  	</div>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead"><?php echo __('privado.comunes.fecha_modif'); ?> </label>
				  <div class="controls">
				  	<div class="input-prepend" title="<?php echo __('privado.comunes.msg_FechaActPor'); ?>"data-rel="tooltip">
				  		<span class="input-large uneditable-input">
				  			<?php echo date("d/m/Y"); ?>
				  		</span>
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