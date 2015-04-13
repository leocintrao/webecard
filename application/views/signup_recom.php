<div id='ecards_title'>
<h1>Nova Conta</h1>
</div>

<div id='faux'>

	<div id='criarconta'>
	<?php
	//print_r($this->session->all_userdata());
	
	echo form_open('main/signup_recom_validation');
	
	echo validation_errors();
	
	$size1 = "size='40'"; //maxlength="4" size="40"
?>
		<table class='t_signup'>
		<tr>
		<td class='form_right'> Nome de Usuário: </td> <td> <?php echo form_input('user_name', $this->input->post('user_name'), $size1); ?> 
		<span class='aste' >*</span> 
		<span id="form1" title="Letras e números são permitidos. Deve conter de 6 a 25 caracteres, sendo obrigatório pelo menos 1 letra. Não são aceitos caracteres especiais, com excessão de _ (underline), nem espaços." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<tr>
		<td class='form_right'> Email: </td> <td> <?php echo form_input('email', $this->input->post('email'), $size1); ?> 
		<span class='opci' >opcional</span> 
		<span id="form2" title="O email deve ser um email válido." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<tr>
		<td class='form_right'> Email Tipo: </td> <td>  &nbsp
		<?php echo form_radio('email_tipo', 'p', 'checked'); ?> 
		Próprio &nbsp &nbsp <?php echo form_radio('email_tipo', 'r'); ?> 
		Recado &nbsp &nbsp <?php echo form_radio('email_tipo', 'n'); ?> 
		Não Utilizar 
		<span class='aste' >*</span> 
		<span id="form3" title="EMAIL PRÓPRIO, será verificado e usado para notificações e movimentações de conta. EMAIL RECADO, será utilizado para notificações somente, ideal para auxílio de outras contas. NÃO UTILIZAR, a movimentação da conta é feita sem o uso de emails." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<!--
		<tr>
		<td class='form_right'> CPF: </td> 
		<td> 
		<?php 	/*if ($this->session->userdata('ja_cpf')) {
					echo "<input type='text' name='cpf' style='color:gray;' value='{$this->session->userdata('reg_cpf')}' size='40' readonly> ";
				} else {
					echo form_input('cpf', $this->input->post('cpf'), $size1); } */ ?> 
		<span class='aste' >*</span> 
		<span id="form4" title="CPF obrigatório. Importante: 1-) É necessário que o CPF seja o mesmo da conta bancária de retirada, 2-) É permitido somente 1 conta por CPF, usuários mal-intencionados terão suas contas suspensas permanentemente." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		-->
		<tr>
		<td class='form_right'> Senha: </td> <td> <?php echo form_password('pw', '', $size1); ?> 
		<span class='aste' >*</span> 
		<span id="form5" title="Letras e números são permitidos. Deve conter de 6 a 25 caracteres, sendo obrigatório pelo menos 1 número. Não são aceitos caracteres especiais, com excessão de ( '!' '_' '#' '@' ), nem espaços." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<tr>
		<td class='form_right'> Repetir Senha: </td> <td> <?php echo form_password('rpw', '', $size1); ?> 
		<span class='aste' >*</span> 
		<span id="form6" title="Repita a mesma senha entrada acima." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<tr> 
		<td class='form_right'> Pergunta Secreta: </td> <td> <?php echo form_input('perg', $this->input->post('perg'), $size1); ?> 
		<span class='aste' >*</span> 
		<span id="form7" title="Crie uma pergunta relacionada a algo íntimo seu, por exemplo, qual é o nome do meu primeiro animal de estimação? Responda-a abaixo. Esta pergunta será usada para garantir a segurança de sua conta." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<tr>
		<td class='form_right'> Resposta Secreta: </td> <td> <?php echo form_input('resp', $this->input->post('resp'), $size1); ?> 
		<span class='aste' >*</span> 
		<span id="form8" title="Responda aqui sua própria pergunta criada acima." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<!--
		<tr>
		<td class='form_right'> Celular: </td> <td> <?php //echo form_input('cel', $this->input->post('cel'), $size1); ?> 
		<span class='opci' >opcional</span>
		<span id="form9" title="Celular não obrigatório. Entre com o prefixo do país + código nacional + número do telefone." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		-->
		<tr>
		<td class='form_right'> Parte da Rede: </td> <td> <?php echo "<input type='text' name='rede' style='color:gray;' value='$rede' size='40' readonly> "; ?> 
		<span id="form10" title="Rede a qual sua conta será parte." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		</td>
		</tr>
		<tr>
		<td>  </td> <td><a href='<?php echo base_url(); ?>'><img src="<?php echo base_url(); ?>assets/images/cancel.png"></a>  
		<?php // echo form_submit('signup_submit', 'Criar Conta!'); ?> 
		<input type="image" src="<?php echo base_url(); ?>assets/images/signup.png" name="signup_submit">
		</td>
		</tr>
		</table>
<?php
	
	echo form_close();
	
	?>	
	</div>

</div>
