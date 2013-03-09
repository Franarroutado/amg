<?php 
	
	$contents = $data['tipo']; 
	$material = $data['material'];
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal">
			  <fieldset>
				<legend><?php echo __('partituras.crear_nuevo') ?></legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Título </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'nombre',
				  		\Input::post('nombre', ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Autor </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'autore_id',
				  		\Input::post('autore_id', ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Xénero </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'genero_id',
				  		\Input::post('genero_id', ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">¿E arreglista? </label>
				  <div class="controls">
				  	<?php echo Form::checkbox('arreglista', '', true); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Tipo </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'tipo_id',
				  		\Input::post('tipo_id', ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Fecha </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'nombre',
				  		\Input::post('fecha', ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Material </label>
				  <div class="controls">
					<table>
						<tbody>
							<tr>
								<td><i><b><?php echo __('partituras.material_disponible') ?></b></i></td>
								<td></td>
								<td><i><b><?php echo __('partituras.material_seleccionado') ?></b></i></td>
								<td></td>
							</tr>
								<tr>
									<td>
										<?php echo Form::select('lstNonSelected', 
											null, 
											$material, 
											array(
												'multiple' => 'multiple',
												'name' => 'form_lstNonSelected',
										)) ?>
									</td>
									<td>
										<input type="button" class="button" value="&gt;" onclick="MoveToSelection();">
										<br><br>
										<input type="button" class="button" value="&lt;" onclick="MoveFromSelection();">
									</td>
									<td>
										<?php echo Form::hidden('material', 
											isset($partitura) ? $partitura->material : ''); ?>
										
										<?php 
											$itemsMateriales;
											if (isset($partitura->material))
											{
												$itemsMateriales = explode("||", $partitura->material);
											}
										?>	
										
										<?php echo Form::select('lstSelected', 
											null, 
											isset($itemsMateriales) ? $itemsMateriales : array(),
											array(
												'multiple' => 'multiple',
												'name' => 'form_lstSelected',
											)) ?>			             
									</td>
									<td>
										<input type="button" class="button" value="Up" onclick="MoveUpOrDown(true) ;" style="width:50px">
										<br><br>
										<input type="button" class="button" value="reset" onclick="resetearElemento() ;" style="width:50px">
										<br><br>
										<input type="button" class="button" value="Down" onclick="MoveUpOrDown(false) ;" style="width:50px">
									</td>
								</tr>
								<tr>
									<td colspan="4" align="center">
										<script type="text/javascript">
											function handleChange(cb) {

												console.debug('call handleChange');

												var strTexto = '';

												var listbox = $("select[name*='lstSelected']");

												if ($(listbox).find("option:selected").length == 0) 
									            {
									                alert("You need to select atleast one selection.");
									            }
									            else 
									            {
													$('#chkPrincipal').attr('checked') ? strTexto =  strTexto + "Pral " : '';
													$('#chkPrimero').attr('checked') ? strTexto =  strTexto + "1º " : '';
													$('#chkSegundo').attr('checked') ? strTexto =  strTexto + "2º " : '';
													$('#chkTercero').attr('checked') ? strTexto =  strTexto + "3º " : '';
													$('#chkCuarto').attr('checked') ? strTexto =  strTexto + "4º " : '';

													$('#txtModificador').val(
														$(listbox).find("option:selected").text() + " " + strTexto
													);
													$('#txtModificador').text(
														$(listbox).find("option:selected").text() + " " + strTexto
													);
												}
											}

											function resetearElemento() 
											{
												console.log('call resetearElemento');
												var listbox = $("select[name*='lstSelected']");

												if ($(listbox).find("option:selected").length == 0) 
									            {
									                alert("You need to select atleast one selection.");
									            }
									            else 
									            {
									            	var strValue = 
									            		$(listbox).find("option:selected").text();
									            	if ( strValue.indexOf(" ") != -1 )
									            	{
									            		$(listbox).find("option:selected").text(
									            			strValue.substring(0, strValue.indexOf(" "))
									            		);
									            	}											            	
									            }
											}

											function fijarValor() 
											{
												console.log('call fijarValor');
												var listbox = $("select[id*='form_lstSelected']");

												if ($(listbox).find("option:selected").length == 0) 
										            {
										                alert("You need to select atleast one selection.");
										            }
										            else 
										            {
                										
										                var val = $(listbox).find("option:selected").val($('#txtModificador').text());
										                var text = $(listbox).find("option:selected").text($('#txtModificador').text());
										            	
										            	$('#txtModificador').val(" ");
										            	$('#txtModificador').text(" ");
										            	$('#chkPrincipal').attr('checked', false);
										            	$('#chkPrimero').attr('checked', false);
										            	$('#chkSegundo').attr('checked', false);
										            	$('#chkTercero').attr('checked', false);
										            	$('#chkCuarto').attr('checked', false);
                										
										            }
											}
										</script>

										<input id="chkPrincipal" onchange='handleChange(this);' name="your_name" value="Pral" type="checkbox">Pral</input>
										<input id="chkPrimero" onchange='handleChange(this);' name="your_name" value="1" type="checkbox">1º</input>
										<input id="chkSegundo" onchange='handleChange(this);' name="your_name" value="2" type="checkbox">2º</input>
										<input id="chkTercero" onchange='handleChange(this);' name="your_name" value="3" type="checkbox">3º</input>
										<input id="chkCuarto" onchange='handleChange(this);' name="your_name" value="4" type="checkbox">4º</input>

									</td>
								</tr>
								<tr>
									<td colspan="4" align="right">
										<label type="text" id="txtModificador" />
									</td>
								</tr>
								<tr>
									<td colspan="4" align="center">
										<input type="button" value="fijar valor" id="btnFijar" onclick="fijarValor()"/>
									</td>
								</tr>					
						</tbody>
					</table>
					<div style="clear:both;"></div>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Centro </label>
				  <div class="controls">
				  <?php echo Form::input(
				  		'centro',
				  		\Input::post('nombre', ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Fondo </label>
				  <div class="controls">
					<?php echo Form::input(
				  		'fondo',
				  		\Input::post('fondo', ''),
				  		array('class' => 'span6 typeahead')
					); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Edición </label>
				  <div class="controls">
					<?php echo Form::input(
				  		'edicion',
				  		\Input::post('edicion', ''),
				  		array('class' => 'span6 typeahead')
					); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="textarea2">Observaciones</label>
				  <div class="controls">
					<textarea class="cleditor" id="textarea2" rows="3"><?php echo \Input::post('observaciones', ''); ?></textarea>
				  </div>
				</div>
				<div class="form-actions">
					<a href="/admin/rexistros/edit/<?php /*echo $contents->id*/  ?>" class="btn btn-primary">Editar</a>
					<a href="/admin/rexistros/index" class="btn">Cancelar</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->
</div>