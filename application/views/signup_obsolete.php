

<div id="container">
	<h1>Criar Conta!</h1>

	<div id="body">
	<?php
	
	print_r($this->session->all_userdata());

	//$this->session->userdata('is_logged_in')

	//echo $this->session->userdata('session_id'); // this works!

	// user_id_validation = 1 se user_id de cartela paga ok.
	// cpf_validation = 1
	
	
	// ver questao de registro do ecard verificado para a conta nova.
	// na hora que o usuario confirmar a conta, ecard deve passar ok!
	

	
	echo form_open('main/signup_validation');
	
	echo validation_errors();
	
	echo "<p> Nome de Usuário ";
	echo form_input('user_name', $this->input->post('user_name'));
	echo "</p>";
	echo "<p> Email ";
	echo form_input('email', $this->input->post('email'));
	echo "</p>";
	echo "<p> Email <br> Próprio ";
	echo form_radio('email_tipo', 'p', 'checked');
	echo " <br> Recado ";
	echo form_radio('email_tipo', 'r');
	echo " <br> Não Utilizar ";
	echo form_radio('email_tipo', 'n');
	echo "</p>";
	
	echo "<p> CPF ";
	
	if ($this->session->userdata('cpf_validation')) {
	echo form_input('cpf', $this->session->userdata('cpf_validation'), 'disabled');
	} else {
	echo form_input('cpf', $this->input->post('cpf')); }
	
	echo "</p>";
	
	echo "<p> Senha";
	echo form_password('pw');
	echo "</p>";
	echo "<p> Repetir Senha";
	echo form_password('rpw');
	echo "</p>";
	echo "<p> Pergunta Secreta ";
	echo form_input('perg', $this->input->post('perg'));
	echo "</p>";
	echo "<p> Resposta Secreta ";
	echo form_input('resp', $this->input->post('resp'));
	echo "</p>";
	echo "<p> Celular ";
	echo form_input('cel', $this->input->post('cel'));
	echo "</p>";
	echo "<p> Parte da Rede ";
	echo form_input('rede', $rede, 'disabled');
	echo "</p>";
	echo "<p>";
	echo form_submit('signup_submit', 'Sign Up!');
	echo "</p>";
	
	echo form_close();
	
	?>	
	</div>

</div>
