<?php 
	
	$contents = $data['partitura']; 
	$material = $data['material'];
?>

<!-- TODO this javascript should be include dinamicly in a js in the footer.php-->
<script type="text/javascript">/**
	 * Objetos DOM
	 * lstNonSelected -> lista desplegable donde aparecen las abreviaturas de los materiales disponibles
	 * lstSelected -> lista desplegable donde aparecen los materiales seleccionados
	 */

   /**
     * TODO esta función no sé para que diablos se utiliza
     */
    //Set The Default Selected
    function SetTheDefaultSelected() 
    {
        //Select Pay Codes
        if ($("input[name*='txtSelected']").val() != "") 
        {
            //On the basis of value select the options
            var txt = $("input[name*='txtSelected']").val().split(',');
            //On the basis of value select the options
            for (var i = 0; i < txt.length; i = i + 1) 
            {

                //Get the values
                var val = $("select[name*='lstNonSelected'] option:[value='" + txt[i] + "']").val();
                var text = $("select[name*='lstNonSelected'] option:[value='" + txt[i] + "']").text();

                //Insert a new option
                $("select[name*='lstSelected']").append("<option value='" + val + "'>" + text + "</option>");

                //Remove the first list box
                $("select[name*='lstNonSelected'] option:[value='" + txt[i] + "']").remove();

            }
        }
    }

    //Move to Selection box
    function MoveToSelection() 
    {
    	MoveTheOptions($("select[name*='lstNonSelected']").attr("id"), $("select[name*='lstSelected']").attr("id"));
    }

    //Move from Selection box
    function MoveFromSelection() 
    {
    	MoveTheOptions($("select[name*='lstSelected']").attr("id"), $("select[name*='lstNonSelected']").attr("id"));
    }

    //Swap the values
    function MoveTheOptions(listBox1, listBox2) 
    {
        //Check if the list box is having any options selected
        if ($("#" + listBox1 + " option:selected").val() == null) 
        {
        	alert("<?php echo __('privado.partituras.msg_jsSelecOpc'); ?>");
        	return;
        }

        //Get iteself to an array
        var arr = $("#" + listBox1 + "  option:selected").map(function() { return "<option value='" + $(this).val() + "'>" + $(this).text() + "</option>"; });

        //Insert a new option(s)
        $("#" + listBox2 + "").append($.makeArray(arr).join(""));

        //Remove the first list box
        $("#" + listBox1 + "  option:selected").remove();

        //Refills the paycodes
        RefillHiddenTextBox();
    }

    //Refills the txt pay codes
    function RefillHiddenTextBox() 
    {
        // IMPORTANT-> get all selected elements by commas
        var txt = $("select[name*='lstSelected'] option").map(function() { return this.value }).get().join(",");


        // Clear the items
        var miLI = $('<li></li>', {
        	id: 'newTagInput'
        });
        $('#ulTags').empty();
        $('#ulTags').append(miLI);

        $("select[name*='lstSelected'] option").each(function(i, selected){
            $(insertTag( $.trim($(selected).text()) )).insertBefore("#newTagInput");
        });
    }

    function insertTag(tag) {
    	var liEl = '<li id="tag-'+tag+'" class="li_tags">'+
    	'<span href="javascript://" class="a_tag">'+tag+'</span>&nbsp;'+
    	'</li>';
    	return liEl;
    }

    //Moves the options up or down using the buttons on the right hand side of the Selected List
    function MoveUpOrDown(isUp) 
    {
    	var listbox = $("select[name*='lstSelected']");

    	if ($(listbox).find("option:selected").length == 0) 
    	{
    		alert("<?php echo __('privado.partituras.msg_jsErrSelect'); ?>"); // "You need to select atleast one selection."
    	}
    	else if ($(listbox).find("option:selected").length > 1) 
    	{
    		alert("<?php echo __('privado.partituras.msg_jsErrUpDown'); ?>"); //"You can only select one option to move Up or Down."
    	}
    	else 
    	{
            //Get the values
            var val = $(listbox).find("option:selected").val();
            var text = $(listbox).find("option:selected").text();
            var index = $(listbox).find("option:selected").index();

            //Get the length now
            var length = $(listbox).find("option").length;

            //Move it up or down
            if (isUp == true) 
            {
                //Move the option a row above
                index = (index == 0 ? index : index - 1);
                //Insert the options
                $("<option value='" + val + "'>" + text + "</option>").insertBefore($(listbox).find("option:eq(" + index + ")"));
            }
            else // Down
            {
                //Move the option a row down
                index = (index == length - 1 ? index : index + 1);

                $("<option value='" + val + "'>" + text + "</option>").insertAfter($(listbox).find("option:eq(" + index + ")"));
            }

            //Remove the options
            $(listbox).find("option:selected").remove();

            //Set the value as selected
            $(listbox).val(val);

            //Refill the textbox
            RefillHiddenTextBox();
        }
    }

    function cargarMaterial()
    {
   		var material = $('#form_lstSelected option');

   		var values = material.map(function() { 
            			return this.text; 
    	    		}).get().join('||');

		$('#form_material').val(values);
    }



	function handleChange(cb) {
		var strTexto = '';

		var listbox = $("select[name*='lstSelected']");

		if ($(listbox).find("option:selected").length == 0) 
        {
            alert('<?php echo  __('privado.partituras.msg_jsErrSelect'); ?>'); // "You need to select atleast one selection."
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
		var listbox = $("select[name*='lstSelected']");

		if ($(listbox).find("option:selected").length == 0) 
        {
            alert('<?php echo  __('privado.partituras.msg_jsErrSelect'); ?>'); // You need to select atleast one selection.
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
		var listbox = $("select[id*='form_lstSelected']");

		if ($(listbox).find("option:selected").length == 0) 
        {
            alert('<?php echo  __('privado.partituras.msg_jsErrSelect'); ?>'); // "You need to select atleast one selection."
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

	// set all javascritp event ready
	$(document).ready( function(){

		//Double click settings for the LIST items
		$("select[name*='lstNonSelected']").on('dblclick', function() 
		{
			MoveToSelection();
		});

		$("select[name*='lstSelected']").on('dblclick', function() 
		{
	  		MoveFromSelection();
		});

		// Set the client events:
		// Those are the buttons that adds Pral, 1º, 2º, 3º, 4º to the material
		$('#chkPrincipal').on('change', function() { handleChange(this); });
		$('#chkPrimero').on('change', function() { handleChange(this); });
		$('#chkSegundo').on('change', function() { handleChange(this); });
		$('#chkTercero').on('change', function() { handleChange(this); });
		$('#chkCuarto').on('change', function() { handleChange(this); });
		// this button sets the new value to the lstSelected
		$('#btnFijar').on('click', function() { fijarValor(); return false});
		// this two buttons moves materials from   to lstSelected
		$('#btnMoveTo').on('click', function() { MoveToSelection(); return false;});
		$('#btnMoveFrom').on('click', function() { MoveFromSelection(); return false;});
		// button for lstSelected for moving up, down and reset the origina material name
		$('#btnMoveUp').on('click', function() { MoveUpOrDown(true); return false; });
		$('#btnResetMaterial').on('click', function() { resetearElemento(); return false; });
		$('#btnMoveDown').on('click', function() { MoveUpOrDown(false); return false; });
	});
</script>

<style>
	select#form_lstNonSelected {
		height: 20em; 
		width:150px;
	}
	select#form_lstSelected {
		height: 20em; 
		width:190px;
	}
</style>

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
			<?php echo Form::open(array('class' => 'form-horizontal')); ?>
			  <fieldset>
				<legend><?php echo $contents->nombre;  ?></legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Título </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'nombre',
				  		\Input::post('nombre', isset($contents) ? $contents->nombre : ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Autor </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'autore_id',
				  		\Input::post('autore_id', isset($contents) ? $contents->autore->nombre : ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Xénero </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'genero_id',
				  		\Input::post('genero_id', isset($contents) ? $contents->genero->nombre : ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">¿E arreglista? </label>
				  <div class="controls">
				  	<?php echo Form::checkbox('arreglista', '',($contents->arreglista == 1) ? true : false); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Tipo </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'tipo_id',
				  		\Input::post('tipo_id', isset($contents) ? $contents->tipo->nombre : ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Fecha </label>
				  <div class="controls">
				  	<?php echo Form::input(
				  		'nombre',
				  		\Input::post('fecha', isset($contents) ? $contents->fecha : ''),
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
										<button id="btnMoveTo" class="btn" class="button">&gt;</button>
										<br/><br/>
										<button id="btnMoveFrom" class="btn" class="button">&lt;</button>
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
										<button id="btnMoveUp" class="btn" style="width:50px">Up</button>
										<br/><br/>
										<button id="btnResetMaterial" class="btn" style="width:50px">reset</button>
										<br/><br/>
										<button id="btnMoveDown" class="btn" style="width:50px">Down</button>
									</td>
								</tr>
								<tr>
									<td colspan="4" align="center">
										<input id="chkPrincipal" name="your_name" value="Pral" type="checkbox">Pral</input>
										<input id="chkPrimero" name="your_name" value="1" type="checkbox">1º</input>
										<input id="chkSegundo" name="your_name" value="2" type="checkbox">2º</input>
										<input id="chkTercero" name="your_name" value="3" type="checkbox">3º</input>
										<input id="chkCuarto" name="your_name" value="4" type="checkbox">4º</input>
									</td>
								</tr>
								<tr>
									<td colspan="4" align="right">
										<label type="text" id="txtModificador" />
									</td>
								</tr>
								<tr>
									<td colspan="4" align="center">
										<button id="btnFijar" class="btn">fijar valor</button>
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
				  		\Input::post('nombre', isset($contents) ? $contents->centro->nombre : ''),
				  		array('class' => 'span6 typeahead')
				  	); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Fondo </label>
				  <div class="controls">
					<?php echo Form::input(
				  		'fondo',
				  		\Input::post('fondo', isset($contents) ? $contents->fondo : ''),
				  		array('class' => 'span6 typeahead')
					); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Edición </label>
				  <div class="controls">
					<?php echo Form::input(
				  		'edicion',
				  		\Input::post('edicion', isset($contents) ? $contents->edicion : ''),
				  		array('class' => 'span6 typeahead')
					); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="textarea2">Observaciones</label>
				  <div class="controls">
					<textarea class="cleditor" id="textarea2" rows="3"><?php echo $contents->observacione_id; ?></textarea>
				  </div>
				</div>
				<div class="form-actions">
					<a href="/admin/rexistros/edit/<?php echo $contents->id  ?>" class="btn btn-primary">Editar</a>
					<a href="/admin/rexistros/index" class="btn">Cancelar</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->
</div>