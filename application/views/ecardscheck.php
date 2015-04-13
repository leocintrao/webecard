<div id='ecards_title'>
<h1>Buscar E-Cards</h1>
</div>

<div id='faux'>

	<div id='form_busca'>
	
	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>
	
	<?php
	//print_r($this->session->all_userdata());
	//echo $this->session->userdata('distribuicao') . " < dist <br>";
	
	echo form_open('main/ecardscheck_validation');
	
	echo validation_errors();
	
	echo "<br><p> ID E-Card, 12 Números <br>";
	echo form_input('id_ecard');
	echo "</p>";
	echo "<p>";
	echo form_submit('ecardscheck_submit', 'Buscar');
	echo "</p>";
	
	echo form_close();
?>	

	</div>
	

	<div id='res_busca'>
<?php	
	// se erro na busca
	if (isset($busca)) { 
	
		echo $busca;
	
	}
	elseif (isset($status)) {
	
		
		if ($status == 'n') {
		
			//echo "<p>Criar conta com essa rede.</p>";
			echo "<a href='" . base_url() . "index.php/main/signup_recom'>Criar conta e fazer parte da rede ></a>
			<strong> " . $this->session->userdata('rede_user_name') . "</strong>";
			
		}
		elseif ($status == 's') {
		
			echo "<p>E-Card válido e disponível para registro, entre com o <br><strong>Nome de Usuário</strong> do fornecedor deste E-Card.</p><br>
								<p>Este E-Card já foi pago, para registrá-lo basta inserir o <br><strong>Nome de Usuário</strong> do fornecedor deste  
								E-Card e prosseguir com o cadastro.</p><br>";
								
			echo form_open('main/user_name_validation');
			
			echo "<p> Nome de Usuário ";
			echo form_input('user_name_chk');

			
			echo form_submit('user_name_submit', 'Buscar');
			echo "</p>";
			
			echo form_close();
								
		}
		elseif ($status == 'd') {
		
			echo "<p>E-Card válido. Entre com o seu CPF.</p><br>
								<p>Este E-Card já foi pago e deve estar em seu nome, para registrá-lo basta inserir o seu CPF 
								e prosseguir com o cadastro.</p><br>";
								
			echo form_open('main/cpf_validation');
			
			echo "<p> CPF ";
			echo form_input('cpf');

			echo form_submit('cpf_submit', 'Buscar');
			echo "</p>";
			
			echo form_close();
		}

			
		
	}
	?>
	</div>
	</div>

