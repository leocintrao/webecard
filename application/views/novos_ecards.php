<div id='ecards_title'>
<h1>Criar E-Cards</h1>
</div>

<div id='faux'> 

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>
	
	<div id='novo_ecard_left'> 
	
	<h3>Números Promocionais</h3>
	<br>
	<p>Escolha 5 números e crie seu E-Card.</p>
	<?php echo validation_errors(); ?>

	<form action="<?php echo base_url(); ?>index.php/main/n_ecard_validation" method="POST">

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
	<?php
	$tempo = "next Friday 19:00:00";
	
		// get_time retorna o tempo que falta, em dias, para a data e hora #tempo
	$days = $this->model_sorteios->get_time($tempo);

	// se days = 0, menos de 24 horas // mostrar a partir de sexta // mostrar a partir da proxima sexta
	if ($days > 0) 							{ $i_date = 0; } 		else 		{ $i_date = 1; }
	
	$options = $this->model_sorteios->get_dates($i_date);
	?>	
	<h3>Data</h3>
	<br>
	Entrar Data do Sorteio
	<select name="date" >
	<?php echo $options; ?>
	</select>
	<input type="checkbox" name="naodatar" value="n" /> Não Datar Agora
	</div>
	
	
	<div id='novo_ecard_msg'>
	
	<input type="submit" value="Criar E-Card">
	</form>

	<br><br>
	<p>Ao criar o seu E-Card você será debitado 10 pontos.</p>
	</div>
	
</div>