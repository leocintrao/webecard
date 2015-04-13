<div id='ecards_title'>
<h1>Saques e Conta Bancária</h1>
</div>

<div id='faux'>


	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('cad_msg')) { echo $this->session->userdata('cad_msg'); echo "<br>"; $this->session->unset_userdata('cad_msg'); }
	echo validation_errors();
	
	?>
	</div>
	
	
	<?php 
	
	foreach((array)$banco as $data) {

		$checked1 = "";
		$checked2 = "";
		$checked3 = "";
		if (isset($data->b_conta_tipo)) {	$b_conta_tipo = $data->b_conta_tipo; 
					
			if ($data->b_conta_tipo == "c") $checked1 = 'checked';
			elseif ($data->b_conta_tipo == "p") $checked2 = 'checked';
			elseif ($data->b_conta_tipo == "o") $checked3 = 'checked';
			
		}	else $b_conta_tipo = "";
		
		if (isset($data->b_pagseg)) $b_pagseg = $data->b_pagseg; else $b_pagseg = "";
		if (isset($data->b_paypal)) $b_paypal = $data->b_paypal; else $b_paypal = "";
		if (isset($data->b_nome)) $b_nome = $data->b_nome; else $b_nome = "";
		if (isset($data->b_numero)) $b_numero = $data->b_numero; else $b_numero = "";
		if (isset($data->b_ag)) $b_ag = $data->b_ag; else $b_ag = "";
		if (isset($data->b_ag_dig)) $b_ag_dig = $data->b_ag_dig; else $b_ag_dig = "";
		if (isset($data->b_conta)) $b_conta = $data->b_conta; else $b_conta = "";
		if (isset($data->b_conta_dig)) $b_conta_dig = $data->b_conta_dig; else $b_conta_dig = "";
		if (isset($data->obs)) $obs = $data->obs; else $obs = "";
		if (isset($data->nome)) $nome = $data->nome; else $nome = "";
		if (isset($data->sobrenomes)) $sobrenomes = $data->sobrenomes; else $sobrenomes = "";
		if (isset($data->cpf)) $cpf = $data->cpf; else $cpf = "";
		
	}

	
	
	echo form_open('main/saque_validation'); 
	
		echo form_hidden('b_paypal', $b_paypal);	
		echo form_hidden('b_pagseg', $b_pagseg);	
		echo form_hidden('b_nome', $b_nome);
		echo form_hidden('b_numero', $b_numero);
		echo form_hidden('b_ag', $b_ag);
		echo form_hidden('b_ag_dig', $b_ag_dig);
		echo form_hidden('b_conta', $b_conta);
		echo form_hidden('b_conta_dig', $b_conta_dig);
		echo form_hidden('b_conta_tipo', $b_conta_tipo);
		echo form_hidden('obs', $obs);
		echo form_hidden('nome', $nome);
		echo form_hidden('sobrenomes', $sobrenomes);
		echo form_hidden('cpf', $cpf);
		
		echo form_hidden('meu_saldo', $meu_saldo);
	
		
		foreach($pergu as $data) {

	?>

	<table id='t_saque_form'>
	<tr>
	<td colspan="2" style="text-align:center;"> <h3>Saque</h3> </td>
	</tr>
	<tr>
	<td> Por favor entre com a quantia de saque desejada: </td> <td> <?php echo form_input('val_saque'); ?> </td>
	</tr>
	<tr>
	<td> Pergunta Secreta: </td> <td> <?php echo form_input('perg', $data->perg, 'readonly'); ?> </td> 
	</tr>
	<tr>
	<td> Resposta Secreta: </td> <td> <?php echo form_input('resp'); ?> </td>
	</tr>
	<tr>
	<td> Senha: </td> <td> <?php echo form_password('pw'); ?> </td>
	</tr>
	<tr>
	<td> Saque para: </td> <td> 
	<?php echo form_radio('conta_tipo', 'b', 'checked'); ?> 
	Conta Bancária <?php echo form_radio('conta_tipo', 'p'); ?> 
	Conta Paypal  <?php echo form_radio('conta_tipo', 's'); ?> 
	Conta PagSeguro  </td>
	</tr>
	<tr>
	<td>  </td> <td> <?php echo form_submit('saque_submit', 'Processar'); ?> </td>
	</tr>
	</table>

<?php
	}
	
	echo form_close();
?>
	
<?php	

	// Dados bancarios
	
	echo form_open('main/muda_banco_validation');
	

?>
	<table id='t_saque'>
	<tr>
	<td colspan="2" style="text-align:center;"> <h3>Conta Paypal</h3> </td>
	</tr>
	<tr>
	<td> Email Paypal: </td> <td> <?php echo form_input('b_paypal', $b_paypal); ?> </td>
	</tr>
	<tr>
	<td colspan="2" style="text-align:center;"> <h3>Conta PagSeguro</h3> </td>
	</tr>
	<tr>
	<td> Email PagSeguro: </td> <td> <?php echo form_input('b_pagseg', $b_pagseg); ?> </td>
	</tr>
	<tr>
	<td colspan="2" style="text-align:center;"> <h3>Dados Bancários</h3> </td>
	</tr>
	<tr>
	<td> Banco: </td> <td> <?php echo form_input('b_nome', $b_nome); ?> </td>
	</tr>
	<tr>
	<td> Banco Número: </td> <td> <?php echo form_input('b_numero', $b_numero); ?> </td>
	</tr>
	<tr>
	<td> Agência: </td> <td> <?php echo form_input('b_ag', $b_ag); ?> </td>
	</tr>
	<tr>
	<td> Agência Dígito: </td> <td> <?php echo form_input('b_ag_dig', $b_ag_dig); ?> </td>
	</tr>
	<tr>
	<td> Conta Bancária: </td> <td> <?php echo form_input('b_conta', $b_conta); ?> </td>
	</tr>
	<tr>
	<td> Conta Bancária Dígito: </td> <td> <?php echo form_input('b_conta_dig', $b_conta_dig); ?> </td>
	</tr>
		<tr>
		<td> Conta Bancária Tipo: </td> <td> 
		<?php echo form_radio('b_conta_tipo', 'c', $checked1); ?> 
		Corrente <?php echo form_radio('b_conta_tipo', 'p', $checked2); ?> 
		Poupança <?php echo form_radio('b_conta_tipo', 'o', $checked3); ?> 
		Outra </td>
		</tr>
	<tr>
	<td> Observações: </td> <td> <?php echo form_textarea('obs', $obs); ?> </td>
	</tr>
	<tr>
	<td> Nome: </td> <td> <?php if ($nome) echo form_input('nome', $nome, 'readonly'); 
								else echo form_input('nome', $nome); ?> </td>
	</tr>
	<tr>
	<td> Sobrenomes: </td> <td> <?php if ($sobrenomes) echo form_input('sobrenomes', $sobrenomes, 'readonly'); 
														else echo form_input('sobrenomes', $sobrenomes); ?> </td>
	</tr>
	<tr>
	<td> CPF: </td> <td> <?php if ($cpf) echo form_input('cpf', $cpf, 'readonly'); 
														else echo form_input('cpf', $cpf); ?> </td>
	</tr>
	<tr>
	<td>  </td> <td> <?php echo form_submit('muda_banco_submit', 'Atualizar Banco'); ?> </td>
	</tr>
	</table>

<?php
	
	echo form_close();

?>

</div>