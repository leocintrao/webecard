<div id='ecards_title'>
<h1>Inserir Data</h1>
</div>

<div id='faux'>

<div id='ecard_left' style="background:url('<?php echo base_url() . "assets/images/ecard" . $design . ".png"; ?>') no-repeat;" >

	<div class='sorteio_data'>
	sorteio data: <span class='sorteio_data_cor'>--/--/----</span>
	</div>
	<div class='ecard'>
	<?php echo $ecard; ?>
	</div>
	<div class='id_ecard'>
	ID: <?php echo $id_ecard; ?>
	</div>
	
</div>


	<div id='dates_form'>
	
	<?php 
	if (validation_errors()) { echo validation_errors(); echo "<br>"; }
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg');
	echo "<br><br>";	}
	?>
	
	<form action='<?php echo base_url(); ?>index.php/main/validate_repasse' method='POST' >
	Nome de Usuário: 
	<input type='radio' name='tipo' value='username' >
	CPF: 
	<input type='radio' name='tipo' value='cpf' >
	<br>
	<br>
	<input type='text' name='value' >
	<input type='hidden' name='id_ecard' value='<?php echo $id_ecard; ?>' >
	<input type='submit' >	
	</form>

	
	</div>
	
</div>