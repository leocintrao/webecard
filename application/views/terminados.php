<div id='ecards_title'>
<h1>Terminados</h1>
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
<div id='ecard_left' style="background:url('<?php echo base_url() . "assets/images/ecard" . $row['design'] . ".png"; ?>') no-repeat;" >
	
	<div class='id_ecard'>
	ID: <?php echo $row['id_ecard']; ?>
	</div>
	<div class='ecard'>
	<?php echo $row['ecard']; ?>
	</div>
	<div class='sorteio_data'>
	sorteio data: <span class='sorteio_data_cor'><?php echo date("d-m-Y", strtotime($row['sorteio_data'])); ?></span>
	</div>

</div>

	<div id='ecards_status'>
	<p><span class='status_color'>Sorteio Data: </span><?php echo date("d-m-Y", strtotime($row['sorteio_data'])); ?></p>
	<p><span class='status_color'>E-Card: </span><?php echo $row['ecard']; ?></p>
	<p><span class='status_color'>ID: </span><?php echo $row['id_ecard']; ?></p>
	<p><span class='status_color'>Info: </span><?php echo $this->model_sorteios->siglas($row['status']); ?> </p>
	</div>
	
	<div id='ecards_print'>

	
	<a href="<?php echo base_url(); ?>index.php/main/del_ecard/terminados/<?php echo $row['id_ecard']; ?>/<?php echo $row['sorteio_data']; ?>" >
	<img src="<?php echo base_url(); ?>assets/images/delete.jpg" alt="Deletar E-Card" >
	</a>
	
	</div>

<?php } ?>

</div>