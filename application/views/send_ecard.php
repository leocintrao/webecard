<div id='ecards_title'>
<h1>Envio E-Cards</h1>
<!--<h1><?php //echo $_envio_ecards; ?></h1>-->
</div>

<div id='faux'>


<div id='ecard_left_send' style="background:url('<?php echo base_url() . "assets/images/ecard" . $design . ".png"; ?>') no-repeat;" >
	
	<div class='id_ecard'>
	ID: <?php echo $id_ecard; ?>
	</div>
	<div class='ecard'>
	<?php echo $ecard; ?>
	</div>
	<div class='sorteio_data'>
	sorteio data: <span class='sorteio_data_cor'><?php echo date("d-m-Y", strtotime($sorteio_data)); ?></span>
	</div>

</div>


	<div id='send_ecard_form'>
	<div id='send_ecard_form_in'>

	<?php 
	echo form_open('main/send_ecard_validation'); 
	
	$extra = array('cols' => '30', 'rows' => '5');
	
	echo "Mensagem: <br><br>";
	echo form_textarea('msg'); 
	echo "<br><br>";
	
	echo "Email(s): <i> Separe por vírgulas \",\" para múltiples emails.</i><br><br>";
	echo form_textarea('emails'); 
	
	echo form_hidden('id_ecard', $id_ecard);
	echo "<br><br>";
	echo form_submit('send_ecard_submit', 'Enviar'); 
	
	echo form_close(); 
	?>
	
	</div>
	</div>
	
</div>	
	
