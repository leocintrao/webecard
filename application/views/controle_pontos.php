<div id='ecards_title'>
<h1>Controle Pontos</h1>
</div>

<div id='faux'>


	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>
	

	<table id='tb_ctrl_pontos'>
	
	<tr style="font-weight:bold;">
		<td> Data </td>
		<td> Tipo </td>
		<td> Valor </td>
		<td> Status </td>
		<td> Saldo </td>
	</tr>

	
	
<?php
	if (!empty($results)) {

		foreach($results as $data) {

			$data2[] = $data->data;
			$tipo_cred2[] = $data->tipo_cred;
			$valor2[] = $data->valor;
			$status2[] = $data->status;
			$saldo2[] = $data->saldo;

		}

		$data2_rev = array_reverse($data2);												
		$tipo_cred2_rev = array_reverse($tipo_cred2);												
		$valor2_rev = array_reverse($valor2);												
		$status2_rev = array_reverse($status2);												
		$saldo2_rev = array_reverse($saldo2);												
												
		for ($i = 0;$i < count($data2);$i ++) {	
		
			echo "
			<tr>
				<td> $data2_rev[$i] </td>
				<td> {$this->model_sorteios->siglas($tipo_cred2_rev[$i])} </td>
				<td> " . number_format($valor2_rev[$i], 2, ',', '.') . " </td>
				<td> {$this->model_sorteios->siglas($status2_rev[$i])} </td>
				<td> " . number_format($saldo2_rev[$i], 2, ',', '.') . " </td>
			</tr>
			";
		}
	}

	echo "</table>";											

?>
   <p><?php echo $links; ?></p>
   
   
   
</div>