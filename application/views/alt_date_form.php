<div id='ecards_title'>
<h1>Alteração de Data</h1>
</div>

<?php // *** rever logica // aparentemente not ok
	//$tempo = $sorteio_data . " 19:00:00"; // o dia e hora atual, para o dia e hora desejada = $tempo
	
	// teste // aparentemente ok
	$tempo = "next Friday 19:00:00";

	//echo $tempo . " < tempo..."; exit();

	$days = $this->model_sorteios->get_time($tempo);

	//echo $days . " < here..."; exit();
	
	// se days = 7, menos de 24 horas // mostrar a partir de sexta // mostrar a partir da proxima sexta
	if ($days > 0)							{ $i_date = 0; } 		else 		{ $i_date = 1; }
	
	$options = $this->model_sorteios->get_dates($i_date);
?>	
<div id='faux'>

<div id='ecard_left' style="background:url('<?php echo base_url() . "assets/images/ecard" . $design . ".png"; ?>') no-repeat;" >
	
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


	<div id='dates_form'>

	<form action="<?php echo base_url(); ?>index.php/main/validate_alt_date" method="POST">
	<select name="date" >
	<?php echo $options; ?>
	</select>
	<input type="hidden" name="id_ecard" value="<?php echo $id_ecard; ?>" >
	<input type="submit" >
	</form>
	
	</div>
	
</div>	
	
