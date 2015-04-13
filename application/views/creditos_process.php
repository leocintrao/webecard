<div id='ecards_title'>
<h1>Adicionar Crédito</h1>
</div>

<div id='faux'>

	<div id='creditos_process'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	echo validation_errors();
	?>
	</div>

<?php
	$tipo = $this->session->userdata('tipo');
	$cred_valor = $this->session->userdata('cred_valor');

	if ($tipo == "p") {
	
	echo "Pagamento iniciado, complete o pagamento e aguarde a liberação dos pontos. <br><br>";
	echo "R$" . $cred_valor  . ",00 reais";
?>
<br><br>

	<h3>Pagamento Paypal</h3>
	<br>
	<form action='https://www.paypal.com/cgi-bin/webscr' name='submit' target='_blank' method='post' >
<input type='hidden' name='cmd' value='_xclick'>
<input type='hidden' name='business' value='leo_cintrao-2013@yahoo.co.uk'>

<input type="hidden" name='image_url' value="<?php echo base_url() . "assets/images/logo_pal.jpg" ?>" >

<input type='hidden' name='lc' value='BR'>
<input type='hidden' name='item_name' value='<?php echo $this->session->userdata('log_user_name'); ?> Credito WEBECARD.net'>

<input type='hidden' name='amount' value='<?php echo $cred_valor; ?>'>
<input type='hidden' name='currency_code' value='BRL'>
<input type='hidden' name='button_subtype' value='services'>
<input type='hidden' name='bn' value='PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted'>
<input type='image' src='https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_buynowCC_LG.gif' border='0' name='submit' alt='PayPal - A maneira mais f⤩l e segura de efetuar pagamentos online!'>
<img alt='' border='0' src='https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif' width='1' height='1'>
</form>



<?php
	//} elseif ($tipo == "t") {
?>
<!--	<h3>Pagamento por Transferência Bancária</h3>
<br>	
<p>Banco: Bradesco</p>
<p>Conta: 10968-1</p>
<p>Agência: 2497</p>
<p>Nome: Leandro José Cintrão</p>
<p>CPF: 223.113.798-44</p>
-->
<?php
	
	//} elseif ($tipo == "b") {
?>
<!--	<h3>Pagamento por Boleto Bancário</h3>
<br>	
<p>Crie uma conta <a href='http://www.neteller.com/pt/' target='_blank'>Neteller.com</a>, abasteça por boleto bancário, e faça a transferência para rafa_1000@hotmail.co.uk</p>
-->
<?php
	} elseif ($tipo == "s") {
	
?>
<!-- <form target='pagseguro' method='post' name='submit' 
action='https://pagseguro.uol.com.br/checkout/checkout.jhtml'>
<input type='hidden' name='email_cobranca'
value='leo_cintrao-2013@yahoo.co.uk'>
<input type='hidden' name='tipo' value='CP'>
<input type='hidden' name='moeda' value='BRL'>

<input type='hidden' name='item_id_1' value='12345'>
<input type='hidden' name='item_descr_1' value='<?php //echo $this->session->userdata('log_user_name'); ?> Credito WEBECARD.net'> 
<input type='hidden' name='item_quant_1' value='1'>


<input type='hidden' name='item_valor_1' value='<?php //echo $cred_valor; ?>,00'>

<input type='image' src='https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/99x61-pagar-assina.gif' 
name='submit' alt='Pague com PagSeguro - é rápido, grátis e seguro!'>
</form>
-->


<?php

} elseif ($tipo == "r") {

	echo "Pagamento iniciado, complete o pagamento e aguarde a liberação dos pontos. <br><br>";
	echo "R$" . $cred_valor  . ",00 reais";

}

	$this->session->unset_userdata('cred_valor');
	$this->session->unset_userdata('tipo');
?>

	</div>
</div>