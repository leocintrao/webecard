<div id='ecards_title'>
<h1>Criar E-Cards Divulgação</h1>
</div>

<div id='faux'> 

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	if ($this->session->userdata('ecards_msg2')) { echo "<br>".$this->session->userdata('ecards_msg2'); $this->session->unset_userdata('ecards_msg2'); }
	?>
	</div>
	
	<div id='novo_ecard_left'> 
	
	<h3>Números Promocionais</h3>
	<br>
	<p>Escolha 5 números e crie seu E-Card.</p>
	<?php echo validation_errors(); ?>

	<form action="<?php echo base_url(); ?>index.php/main/n_ecard_divu_validation" method="POST">

	<table id="table5" data-toggle="checkboxes" data-max="5">
	<?php 		

	$c = 1;
	for ($leo = 0; $leo < 5; $leo ++) {	
		echo "<tr>";	
			for ($leo2 = 0; $leo2 < 10; $leo2 ++) { 		
				echo "<td><input class='class_chk' type='checkbox' name='numeros[]' value='$c' > ";			
				echo $c;			
				$c = $c + 1;			
				echo "</td>";
			}		
		echo "</tr>";
	}
	?>
	</table>
	<br>
	<strong>OU</strong>
	<br>
	<p>Escolha seu E-Card criado automaticamente.</p>
	<?php 
	$g_ecards = $this->model_sorteios->gera_array(1); // 5 = numero de cartelas (up to 10 at once)
	?>

	<input type='checkbox' name='ecard' value='<?php echo $g_ecards[0]; ?>'>
	<strong> <?php echo $g_ecards[0]; ?> </strong>
		
	<input type="button" value="Gerar Novo Número" onclick="reloadPage()">
				

	</div>
	
	<div id='novo_ecard_right'>
		<h3>Design</h3>
		<br>
		<div class='design'>
		<img src='<?php echo base_url(); ?>assets/images/ecard1.png' width='100' alt='Design 1'>
		<br>
		<input type="radio" name="new_design" value="1" checked /> Design 1
		</div>
	
		<div class='design'>
		<img src='<?php echo base_url(); ?>assets/images/ecard2.png' width='100' alt='Design 2'>
		<br>
		<input type="radio" name="new_design" value="2"> Design 2
		</div>
	
		<div class='design'>
		<img src='<?php echo base_url(); ?>assets/images/ecard3.png' width='100' alt='Design 3'>
		<br>
		<input type="radio" name="new_design" value="3"> Design 3
		</div>
	
		<div class='design'>
		<img src='<?php echo base_url(); ?>assets/images/ecard4.png' width='100' alt='Design 4'>
		<br>
		<input type="radio" name="new_design" value="4"> Design 4
		</div>
	
		<div class='design'>
		<img src='<?php echo base_url(); ?>assets/images/ecard5.png' width='100' alt='Design 5'>
		<br>
		<input type="radio" name="new_design" value="5"> Design 5
		</div>
	
		<div class='design'>
		<img src='<?php echo base_url(); ?>assets/images/ecard6.png' width='100' alt='Design 6'>
		<br>
		<input type="radio" name="new_design" value="6"> Design 6
		</div>
	
	</div>
		
	<div id='novo_ecard_data'>	
		<h3>Destino</h3>
		<br>
		<input type="radio" name="tipo" value="2" checked /> Pagar e Liberar para Cadastro
		<span id="divu2" title="Com esta opção você terá este E-Card pronto para distribuir à qualquer pessoa. Lembre-se de informar
		também o seu Nome de Usuário à pessoa, pois será necessário para a validação do E-Card." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>		
		<br>
		<br>
		<input type="radio" name="tipo" value="3"> Pagar e Enviar a Um Usuário <input type="text" name="username" /> 
		<span id="divu3" title="Com esta opção você terá este E-Card enviado à um usuário do site. O usuário de destino deverá aceitar 
		o E-Card para utilizá-lo." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		<!--
		<br>
		<br>
		<input type="radio" name="tipo" value="4"> Pagar e Enviar a Um CPF <input type="text" name="cpf" /> 
		<span id="divu4" title="Com esta opção você terá este E-Card enviado à uma pessoa através do CPF desta pessoa. Quando a mesma 
		se cadastrar no site, este E-Card será adicionado à sua conta. Caso esta pessoa já possua uma conta, o E-Card será enviado da 
		mesma forma." 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		-->
		<br>	
		<br>	
		<input type="radio" name="tipo" value="1" /> Não Pagar, E-Card Recomendação 
		<span id="divu1" title="Com esta opção você terá este E-Card criado e qualquer pessoa que acessar o site através dele será 
		adicionada a sua rede. O E-Card não servirá para Sorteios, e mais do que 1 pessoa poderá acessar o site com ele que também entrará 
		em sua rede. Recomende!" 
		style="background:gray; color:white; padding:0 3px 0 3px;" >?</span>
		<br>
	</div>
	
	<div id='novo_ecard_msg'>
	
	<input type="submit" value="Criar E-Card">
	</form>

	<br><br>
	<p>Ao criar o seu E-Card você será debitado 10 pontos, com exceção do E-Card Recomendação.</p>
	</div>
	
</div>