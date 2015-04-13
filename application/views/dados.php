<div id='ecards_title'>
<h1>Meus Dados</h1>
</div>

<div id='faux'>

	<div id='muda_dados'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>
	
<?php	
	echo form_open('main/muda_dados_validation');
	
	echo validation_errors();
		
	foreach($result as $data) {
								echo form_hidden('b4_email', $data->email);	
								echo form_hidden('b4_email_tipo', $data->email_tipo);	
								echo form_hidden('b4_cel', $data->cel);	
			$checked1 = "";
			$checked2 = "";
			$checked3 = "";
			if ($data->email_tipo == "p") $checked1 = 'checked';
			elseif ($data->email_tipo == "r") $checked2 = 'checked';
			elseif ($data->email_tipo == "n") $checked3 = 'checked';
			
			$size1 = "size='40'";
?>
		<table class='t_signup'>
		<tr>
		<td colspan="2" style="text-align:center;"> <h3>Dados Básicos</h3> </td>
		</tr>
		<tr>
		<td class='form_right'> Nome de Usuário: </td> <td> <?php echo form_input('user_name', $data->user_name, $size1.'readonly'); ?> 
		</td>
		</tr>
		<tr>
		<td class='form_right'> Email: </td> <td> <?php echo form_input('email', $data->email, $size1 ); ?> 
		<span class='opci' >opcional</span> 
		<span id="form2" title="Email não obrigatório. Não são aceitos etc..." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span> 
		</td>
		</tr>
		<tr>
		<td class='form_right'> Email Tipo: </td> <td>  &nbsp
		<?php echo form_radio('email_tipo', 'p', $checked1); ?> 
		Próprio &nbsp &nbsp <?php echo form_radio('email_tipo', 'r', $checked2); ?> 
		Recado &nbsp &nbsp <?php echo form_radio('email_tipo', 'n', $checked3); ?> 
		Não Utilizar 
		<span class='aste' >*</span> 
		<span id="form3" title="3 Nome de Usuário obrigatório. Não são aceitos etc..." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<!--
		<tr>
		<td class='form_right'> CPF: </td> 
		<td> <?php //echo form_input('cpf', $data->cpf, $size1.'readonly'); ?> 
		</td>
		</tr>
		-->
		<tr>
		<td class='form_right'> Celular: </td> <td> <?php echo form_input('cel', $data->cel, $size1); ?> 
		<span class='opci' >opcional</span>
		<span id="form9" title="Celular não obrigatório. Entre com o prefixo do país + código nacional + número do telefone." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<tr>
		<td>  </td> <td> <?php echo form_submit('muda_dados_submit', 'Alterar Dados'); ?> </td>  
		</tr>
		</table>

<?php

	echo form_close();

	
	// Alterar Senha
	
	echo form_open('main/muda_senha_validation');
		
?>
	<table class='t_signup'>
	<tr>
	<td colspan="2" style="text-align:center;"> <h3>Alterar Senha</h3> </td>
	</tr>
	<tr>
	<td> Senha Atual: </td> <td> <?php echo form_password('password'); ?> </td>
	</tr>
	<tr>
	<td> Nova Senha: </td> <td> <?php echo form_password('pw'); ?> </td>
	</tr>
	<tr>
	<td> Repetir Senha: </td> <td> <?php echo form_password('rpw'); ?> </td>
	</tr>
	<tr>
	<td>  </td> <td> <?php echo form_submit('muda_senha_submit', 'Alterar Senha'); ?> </td>
	</tr>
	</table>

<?php

	echo form_close();

	// Alterar Pergunta
	
	echo form_open('main/muda_perg_validation');
	
?>
	<table class='t_signup'>
	<tr>
	<td colspan="2" style="text-align:center;"> <h3>Alterar Pergunta Secreta</h3> </td>
	</tr>
	<tr>
	<td> Pergunta Secreta: </td> <td> <?php echo form_input('perg', $data->perg, $size1.'readonly'); ?> </td>
	</tr>
	<tr>
	<td> Entre Resposta Secreta: </td> <td> <?php echo form_input('resp','', $size1); ?> </td>
	</tr>
	<tr>
	<td> Nova Pergunta Secreta: </td> <td> <?php echo form_input('n_perg','', $size1); ?> </td>
	</tr>
	<tr>
	<td> Nova Resposta Secreta: </td> <td> <?php echo form_input('n_resp','', $size1); ?> </td>
	</tr>
	<tr>
	<td>  </td> <td> <?php echo form_submit('muda_perg_submit', 'Alterar Pergunta'); ?> </td>
	</tr>
	</table>

<?php
	}
	echo form_close();

	
?>
<br>
	<a href="<?php echo base_url(); ?>index.php/main/delete" >Deletar Conta</a> <!-- deletar row, deixar id e status = 'n' -->
<br>
	</div>
</div>