<div id='ecards_title'>
<h1>Ativos</h1>
</div>

<div id='faux'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>
	
<?php
//$left = true;
foreach ($myinfo as $row) {
/*
	if ($left == true) {
		$class_ecard = 'ecard_left'; 
		$left = false;
	} else {
		$class_ecard = 'ecard_left1';
		$left = true;
	}
*/
?>

<div id='<?php echo "ecard_left"; ?>'>

	<div class='sorteio_data'>
	sorteio data: <span class='sorteio_data_cor'><?php echo date("d-m-Y", strtotime($row['sorteio_data'])); ?></span>
	</div>
	<div class='ecard'>
	<?php echo $row['ecard']; ?>
	</div>
	<div class='id_ecard'>
	ID: <?php echo $row['id_ecard']; ?>
	</div>
	

<?php	
	$tempo = $row['sorteio_data'] . " 19:00:00"; // o dia e hora atual, para o dia e hora desejada = $tempo
	$days = $this->model_sorteios->get_time($tempo);
	
	// se days = 0, menos de 24 horas // mostrar a partir de sexta // mostrar a partir da proxima sexta
	if ($days >= 7) { 
	$alt_data = "<a href='" . base_url() . "index.php/main/alt_date/{$row['id_ecard']}'> Alterar Data</a>"; } 		
	else { 
	$alt_data = "Alteração de Data Sem Prazo"; }

?>	
	<div class='status'>
	Info: <?php echo $alt_data; ?>
	</div>
	
</div>

<?php } ?>


</div>