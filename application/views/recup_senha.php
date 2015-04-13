<div id='ecards_title'>
<h1>Recuperação de Senha</h1>
</div>

	<div id='faux'>
	
	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('msg')) { echo $this->session->userdata('msg') . "<br>"; $this->session->unset_userdata('msg'); }
	echo validation_errors();
	?>
	</div>

	<!-- se usa email, email sent + perg -->
	<?php
	echo form_open('main/conta_validation'); 
	?>
	<table class='t_signup'>
	<tr>
	<td> Entre com o seu Email registrado ou Nome de Usuário ou CPF: </td> <td> <?php echo form_input('conta'); ?> </td>
	</tr>
	<tr>
	<td>  </td> <td> <?php echo form_submit('conta_submit', 'Enviar'); ?> </td>
	</tr>
	</table>
		
	<?php
	echo form_close();
	
	
	//-------------------------------------- se sem email proprio
		
	$sess_perg = $this->session->userdata('perg');
	
	if (isset($perg) || !empty($sess_perg)) {
	
		if (!empty($sess_perg)) $perg['perg'] = $this->session->userdata('perg');
	
		echo form_open('main/recup_senha_validation'); 
		
		echo form_hidden('perg', $perg['perg']);	
		?>
		 
		<table class='t_signup'>
		<tr>
		<td> Pergunta Secreta: </td> <td> <?php echo $perg['perg']; ?> </td>
		</tr>
		<tr>
		<td> Resposta Secreta: </td> <td> <?php echo form_input('resp'); ?> </td>
		</tr>
		<tr>
		<td>  </td> <td> <?php echo form_submit('recup_senha_submit', 'Enviar'); ?> </td>
		</tr>
		</table>
	
		<?php 
		
		echo form_close();
		
		$this->session->unset_userdata('perg');
	}
	
	//------------------------------------- nova senha pra todos, vem com key
	

	$sess_key = $this->session->userdata('key');
	
	//print_r($key2);
	
	if (isset($key2) || !empty($sess_key)) {
	
		if (!empty($sess_key)) $key2 = $this->session->userdata('key');
	
		$this->session->unset_userdata('resp');
		$this->session->unset_userdata('user_id');

		echo form_open('main/nova_senha_validation'); 
		
		echo form_hidden('key_reg', $key2);	

		?>
		<table class='t_signup'>
		<tr>
		<td> Nova Senha: </td> <td> <?php echo form_password('pw'); ?> </td>
		</tr>
		<tr>
		<td> Repetir Senha: </td> <td> <?php echo form_password('rpw'); ?> </td>
		</tr>
		<tr>
		<td>  </td> <td> <?php echo form_submit('nova_senha_submit', 'Enviar'); ?> </td>
		</tr>
		</table>
		<?php
		echo form_close();
		
		$this->session->unset_userdata('key');
		
	}
	?>
	<!-- se usa cpf, perg -->
	
	</div>
