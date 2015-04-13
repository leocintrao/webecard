<div id='ecards_title'>
<h1>Área de Impressão</h1>
</div>

<div id='faux'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>
	
<?php
		$p_ecards = $this->session->userdata('print_area');
		
		//echo count($p_ecards['id_ecard']) . " < count <br>";
		for ($i = 0; $i < count($p_ecards['id_ecard']); $i ++) {			

?>
<div id='ecard_left' style="background:url('<?php echo base_url() . "assets/images/ecard" . $p_ecards['design'][$i] . ".png"; ?>') no-repeat;" >
	
	<div class='id_ecard'>
	ID: <?php echo $p_ecards['id_ecard'][$i]; ?>
	</div>
	<div class='ecard'>
	<?php echo $p_ecards['ecard'][$i]; ?>
	</div>
	<div class='sorteio_data'>
	sorteio data: <span class='sorteio_data_cor'><?php echo $p_ecards['data'][$i]; ?></span>
	</div>
	
</div>

	<div id='ecards_status'>
	<p><span class='status_color'>Sorteio Data: </span><?php echo $p_ecards['data'][$i]; ?></p>
	<p><span class='status_color'>E-Card: </span><?php echo $p_ecards['ecard'][$i]; ?></p>
	<p><span class='status_color'>ID: </span><?php echo $p_ecards['id_ecard'][$i]; ?></p>
	<p><span class='status_color'>Info: </span><?php echo $p_ecards['info'][$i]; ?> </p>
	</div>


<?php }  ?>
	

</div>