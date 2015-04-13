<div id='ecards_title'>
<h1>Rendimentos</h1>
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
		<td> Rede </td>
		<td> Valor </td>
	</tr>

<?php
	if (!empty($results)) {
	
		foreach($results as $data) {

		if ($data->missed == 's') $missed = "<span style='color:red;'>(não recebido)</span>"; else $missed = "";
		
		echo "
		<tr>
			<td> {$data->sorteio_data} </td>
			<td> {$data->user_name} " . $missed . "</td>
			<td> " . number_format($data->valor, 2, ',', '.') . " </td>
		</tr>
		";
		}
	}

	echo "</table>";											
									
?>
   <p><?php echo $links; ?></p>

</div>