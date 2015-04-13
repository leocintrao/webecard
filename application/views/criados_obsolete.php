<div id='ecards_title'>
<h1>Criados</h1>
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
	

	<div class='status'>
	Info: <?php echo "<a href='" . base_url() . "index.php/main/validar_ecard/{$row['id_ecard']}/c/e'> Validar </a>"; ?>
	</div>
</div>
<?php } ?>

</div>