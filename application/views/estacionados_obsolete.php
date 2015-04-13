<div id='ecards_title'>
<h1>Estacionados</h1>
</div>

<div id='faux'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>
<?php
foreach ($myinfo as $row) {

?>
<div id='ecard_left'>

	<div class='sorteio_data'>
	sorteio data: <span class='sorteio_data_cor'>--/--/----</span>
	</div>
	<div class='ecard'>
	<?php echo $row['ecard']; ?>
	</div>
	<div class='id_ecard'>
	ID: <?php echo $row['id_ecard']; ?>
	</div>
	

<?php
	if 		($row['status'] == 'd') $est_status = "<a href='" . base_url() . "index.php/main/aceitar/{$row['id_ecard']}'> Aceitar E-Card </a>";
										
	elseif 	($row['status'] == 'e') $est_status =  "<a href='" . base_url() . "index.php/main/add_date/{$row['id_ecard']}'> Inserir Data</a>";
			

?>											
	<div class='status'>
	Info: <?php echo $est_status; ?>
	</div>
	
</div>

<?php } ?>
	

</div>