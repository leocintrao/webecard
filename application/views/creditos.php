<div id='ecards_title'>
<h1>Adicionar Crédito</h1>
</div>

<div id='faux'>

	<div id='ctrl_creditos'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	echo validation_errors();
	?>
	</div>
 

	<p style="text-align:center;"><strong>Lembre-se</strong> que é possível agendar seus ecards para sorteios semanais <strong>em até 3 meses.</strong>
	<br><br><strong>Aproveite e agende!</strong></p>
<br><br>
<br>

	<form action='<?php echo base_url(); ?>index.php/main/validate_creditos' method='POST' >
	<strong>Entre com a quantidade de créditos desejada: </strong>
	
<select name="cred_valor">
  <option value="10">10,00</option>
  <option value="20">20,00</option>
  <option value="30">30,00</option>
  <option value="50">50,00</option>
  <option value="100">100,00</option>
  <option value="200">200,00</option>
  <option value="300">300,00</option>
</select> 

	<br>
	<br>
	<input type='radio' name='tipo' value='s' checked /> <strong>PagSeguro</strong>  (Cartão de Crédito/Débito, Boleto, Transferência Bancária, Crédito em Conta) <br><br>
	<input type='radio' name='tipo' value='p' /> <strong>Paypal</strong> (Cartão de Crédito, Crédito em Conta)  <br><br>
	<input type='radio' name='tipo' value='r' /> <strong>Representante</strong>
	<!-- <input type='radio' name='tipo' value='b' >boleto
	<input type='radio' name='tipo' value='t' > Transferência Bancária  -->
	<br>
	<br>
	<input type='submit' value='Recarregar' >
	</form>
<br><br><br> 
	
	<form action='<?php echo base_url(); ?>index.php/main/validate_cupom' method='POST' >
	<strong>Cupom Promocional:</strong>
	
	<input type='text' name='cupom' >

	<input type='submit' value='Recarregar' >
	</form>

	

	</div>
</div>