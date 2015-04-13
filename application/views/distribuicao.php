<div id='ecards_title'>
<h1>Distribuição</h1>
</div>

<div id='faux'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>
<?php

if (empty($myinfo)) echo "<div id='ecards_msg'>Você não possui nenhum E-Card Distribuição no momento.</div>"; else {

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
	sorteio data: <span class='sorteio_data_cor'>--/--/----</span>
	</div>

<?php
				if ($row['status'] == 'n') { 
				//$validar = "<a href='" . base_url() . "index.php/main/validar_ecard/{$row['id_ecard']}/n/s'> Validar </a>"; } 		
				$validar = " Não Pago, Aguardando"; } 		
				elseif ($row['status'] == 'd') { 
					if ($row['user_name']) $env = "Usuário:</span> " . $row['user_name']; else $env = "CPF:</span> " . $row['cpf'];
				$validar = "Enviado a;<br> <span class='status_color'>" . $env; }
				elseif ($row['status'] == 'f') { 
				$validar = "Recebido de;<br> <span class='status_color'>Usuário:</span> " . $row['user_name']; }
				elseif ($row['status'] == 's') {
				//$validar = "Pago <a href='" . base_url() . "index.php/main/repasse/{$row['id_ecard']}'> Repassar? </a>"; }
				$validar = "Pago, Aguardando"; }

				
?>											
	
</div>

	<div id='ecards_status'>
	<p><span class='status_color'>Sorteio Data: </span><?php echo "--/--/----"; ?></p>
	<p><span class='status_color'>E-Card: </span><?php echo $row['ecard']; ?></p>
	<p><span class='status_color'>ID: </span><?php echo $row['id_ecard']; ?></p>
	<p><span class='status_color'>Info: </span><?php echo $validar; ?> </p>
	</div>

	<div id='ecards_print'>
	<?php
	$hidden = array('p_data' => "--/--/----", 
					'p_ecard' => $row['ecard'],
					'p_id_ecard' =>	$row['id_ecard'],
					'p_design' => $row['design'],
					'p_info' => $validar,
					'p_redirect' => 'distribuicao'
						);

	echo form_open('main/print_area', '', $hidden);	?>
	
	<input type="image" src="<?php echo base_url(); ?>assets/images/printer.jpg" name="printer_submit">

	<?php echo form_close(); ?>
	
	<a href="<?php echo base_url(); ?>index.php/main/del_ecard/distribuicao/<?php echo $row['id_ecard']; ?>" >
	<img src="<?php echo base_url(); ?>assets/images/delete.jpg" alt="Deletar E-Card" >
	</a>

	<a href="<?php echo base_url(); ?>index.php/main/send_ecard/<?php echo $row['id_ecard']; ?>" >
	<img src="<?php echo base_url(); ?>assets/images/printer.jpg" alt="Enviar E-Card" >
	</a>

	</div>

<?php 
} 
} 
?>
	

</div>