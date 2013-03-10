<?php

	$contents['num_mensajes'];
	$contents['num_mensajesNoLeidos'];

?>

<div class="sortable row-fluid ui-sortable">
	<a data-rel="tooltip" class="well span3 top-block" href="#" data-original-title="6 new members.">
		<span class="icon32 icon-red icon-user"></span>
		<div>Total Members</div>
		<div>507</div>
		<span class="notification">6</span>
	</a>
	<a data-rel="tooltip" class="well span3 top-block" href="#" data-original-title="4 new pro members.">
		<span class="icon32 icon-color icon-star-on"></span>
		<div>Pro Members</div>
		<div>228</div>
		<span class="notification green">4</span>
	</a>
	<a data-rel="tooltip" class="well span3 top-block" href="#" data-original-title="$34 new sales.">
		<span class="icon32 icon-color icon-cart"></span>
		<div>Sales</div>
		<div>$13320</div>
		<span class="notification yellow">$34</span>
	</a>
	
	<?php echo Html::anchor('admin/mensajes',
		'<span class="icon32 icon-color icon-envelope-closed"></span>
		<div>Messages</div>
		<div>'.$contents['num_mensajes'].'</div>'.
		(( $contents['num_mensajesNoLeidos'] > 0 ) ? '<span class="notification red">'.$contents['num_mensajesNoLeidos'].'</span>' : '' )
		,
		array(
			'class' 				=> 'well span3 top-block',
			'data-rel'				=> 'tooltip',
			'data-original-title' 	=> __('privado.dashboard.numMsgNuevos', array('numero' => $contents['num_mensajesNoLeidos'])),
		)
	); ?>
	
</div>