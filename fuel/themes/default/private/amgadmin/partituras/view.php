<style type="text/css">

	/*#boxTags {
		border: 1px solid #d3d3d3;
		width: 500px;
		padding: 10px 10px 0 10px;
		//margin: 0 auto;
		//margin-top: 10px;
	}*/
	#ulTags {
		padding-right: 40px;
		margin: 0;
	}
	#ulTags .li_tags {
		border: 1px solid #e3e3e3;
		background: #e3e3e3;
		display: inline;
		float: left;
		list-style: none;
		margin: 0 10px 10px 0;
		padding: 0 3px 4px 5px;
	}
	#ulTags .li_tags:hover {
		border-color: #222;
	}
	#newTagInput {
		display: inline;
		float: left;
		list-style: none;
		margin: 0 10px 10px 0;
		padding: 0 2px 2px 0;
		width: 23px;
	}
	#boxTags .a_tag {
		color: #000000;
		text-decoration: none;
		font-size: 12px;
	}
	#boxTags .a_tag:hover {
		color: #000000;
	}
	#boxTags .del {
		font-size: 12px;
		text-decoration: none;
		font-weight: bold;
		padding: 1px 4px 1px 4px;
		background: #0099cc;
		color: #ffffff;
		position: relative;
	}
	#boxTags .del:hover {
		background: #ff0000;
	}
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
			<h2><i class="icon-eye-open"></i></h2>
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
				  <label class="control-label" for="typeahead">Título </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->nombre; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Autor </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->autore->nombre; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Xénero </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->genero->nombre; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">¿E arreglista? </label>
				  <div class="controls">
				  	<?php echo Form::checkbox('arreglista', null ,
				  		array(
				  			'data-no-uniform' => 'true', 
				  			'class' => 'iphone-toggle',
				  			($contents->arreglista == 1) ?  'checked' : 'unchecked',
				  		)); ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Tipo </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->tipo->nombre; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Fecha </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->fecha; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Material </label>
				  <div class="controls">
				  	<div class="chzn-container chzn-container-multi">
						<ul id="ulTags" style="clear:both;">
							<?php $datos = explode("||", trim($contents->material)); ?>
							<?php foreach ($datos as $dato): ?>
								<li id="tag-<?php echo $dato; ?>" class="li_tags">
									<span href="javascript://" class="a_tag"><?php echo $dato; ?>
									</span>&nbsp;
								</li>	
							<?php endforeach ?>
						</ul>
						<div style="clear:both;"></div>
					</div>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Centro </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->centro->nombre; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Fondo </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->fondo; ?></span>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Edición </label>
				  <div class="controls">
				  	<span class="input-xlarge uneditable-input"><?php echo $contents->edicion; ?></span>
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