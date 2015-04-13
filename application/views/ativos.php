<div id='ecards_title'>
<h1>Meus E-Cards</h1>
</div>

<div id='faux'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	
	//$this->session->unset_userdata('print_area'); 

	//print_r($this->session->all_userdata()); echo "<br>";
	

	?>
	</div>
	
	
<?php

if (empty($myinfo)) echo "<div id='ecards_msg'>Você não possui nenhum E-Card Ativo no momento.</div>"; else {

?>
	
	
<?php
//$left = true;
$est_status = '';


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

<div id='ecard_left' style="background:url('<?php echo base_url() . "assets/images/ecard" . $row['design'] . ".png"; ?>') no-repeat;" >
	
	<div class='id_ecard'>
	ID: <?php echo $row['id_ecard']; ?>
	</div>
	<div class='ecard'>
	<?php echo $row['ecard']; ?>
	</div>
	<div class='sorteio_data'>
	sorteio data: <span class='sorteio_data_cor'>
	<?php 
			if ($row['sorteio_data'] != 0) $s_data = date("d-m-Y", strtotime($row['sorteio_data'])); 
			else $s_data =  "--/--/----"; 
			echo $s_data; ?></span>
	</div>

<?php	
	if 		($row['status'] == 'd') $est_status = "<a href='" . base_url() . "index.php/main/aceitar/{$row['id_ecard']}'> Aceitar E-Card</a> de:<br><span class='status_color'>Usuário:</span> " .  $row['user_name'];
										
	elseif 	($row['status'] == 'e') $est_status =  "<a href='" . base_url() . "index.php/main/add_date/{$row['id_ecard']}'> Inserir Data</a>";

	elseif ($row['status'] == 'u' || $row['status'] == 'a') {

		$tempo = $row['sorteio_data'] . " 19:00:00"; // o dia e hora atual, para o dia e hora desejada = $tempo
		$days = $this->model_sorteios->get_time($tempo);
		
		// se days = 0, menos de 24 horas // mostrar a partir de sexta // mostrar a partir da proxima sexta
		if ($days >= 7) { 
		$est_status = "<a href='" . base_url() . "index.php/main/alt_date/{$row['id_ecard']}'> Alterar Data</a>"; } 		
		else { 
		$est_status = "Alteração de Data Sem Prazo"; }
	
	}

	
			
?>	
</div>

	<div id='ecards_status'>
	<p><span class='status_color'>Sorteio Data: </span><?php echo $s_data; ?></p>
	<p><span class='status_color'>E-Card: </span><?php echo $row['ecard']; ?></p>
	<p><span class='status_color'>ID: </span><?php echo $row['id_ecard']; ?></p>
	<p><span class='status_color'>Info: </span><?php echo $est_status; ?> </p>
	</div>
	
	<div id='ecards_print'>
	
	<?php
	$hidden = array('p_data' => $s_data, 
					'p_ecard' => $row['ecard'],
					'p_id_ecard' =>	$row['id_ecard'],
					'p_design' => $row['design'],
					'p_info' => $est_status,
					'p_redirect' => 'ativos'
						);

	echo form_open('main/print_area', '', $hidden);	?>
	
	<input type="image" src="<?php echo base_url(); ?>assets/images/printer.jpg" name="printer_submit">

	<?php echo form_close(); ?>

	<!-- <a href='<?php //echo base_url(); ?>index.php/main/print_area/<?php //echo $this->uri->segment(3, 0) . "/" . $row['id_ecard']; ?>' ><img src='<?php //echo base_url(); ?>assets/images/printer.jpg'></a> -->
	</div>


	
<?php 
}
} 
?>


</div>