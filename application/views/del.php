<div id='ecards_title'>
<h1>Deletar Conta</h1>
</div>

<div id='faux'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('cad_msg')) { echo $this->session->userdata('cad_msg'); $this->session->unset_userdata('cad_msg'); }
?>
	</div>

	<div id='ecards_msg'>
	<p>Por favor, confirme sua Senha e Resposta Secreta para deletar sua conta. 	</p>
	<p>Atenção, este processo é irreversível. Caso possua algum saldo em sua conta ele será transferido para sua conta. 	</p>
	</div>

	<div id='ecards_msg'>
	
	<?php
	
	echo form_open('main/delete_validation');
	
	echo validation_errors();
	
	foreach($pergu as $data) {
	
		//if (isset($data->perg)) $perg = $data->perg; else $perg = "";
		$size1 = "size='40'";

?>
		<table class='t_signup'>
		<tr>
		<td colspan="2" > <h3>Confirmação</h3> </td>
		</tr>
		<tr>
		<td> Senha: </td> <td> <?php echo form_password('pw', '', $size1); ?> </td>
		</tr>
		<tr>
		<td> Pergunta Secreta: </td> <td> <?php echo form_input('perg', $data->perg, $size1.'readonly'); ?> </td>
		</tr>
		<tr>
		<td> Resposta Secreta: </td> <td> <?php echo form_input('resp', '', $size1); ?> </td>
		</tr>
		<tr>
		<td>  </td> <td> <?php echo form_submit('submit_delete', 'Deletar Conta!'); ?> </td>
		</tr>
		</table>
<?php
	}
	echo form_close();
	
	
	?>

	</div>

</div>