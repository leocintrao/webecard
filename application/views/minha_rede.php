<div id='ecards_title'>
<h1>Minha Rede</h1>
</div>

<div id='faux'>

	<div id='meu_link'>
	<h3> Basta recomendar um amigo através deste link e pronto, ele já será parte de sua rede!</h3> <br>
	Link de Distribuição: 
	<a href='<?php echo base_url(); ?>index.php/main/my_recom/<?php echo str_rot13($this->session->userdata('log_user_name')); ?>'> 
	<?php echo base_url(); ?>index.php/main/my_recom/<?php echo str_rot13($this->session->userdata('log_user_name')); ?> </a>
	<!--<br>
	<a href='<?php echo base_url(); ?>index.php/main/my_recom/<?php echo str_rot13($this->session->userdata('log_user_name')); ?>'> 
	<img src='<?php echo base_url(); ?>assets/images/logo.jpg' alt='Copie e cole este link' > </a>
	-->
	</div>

 	<div id='minha_left'>
	<h3>Gostaria de se tornar Imperador?</h3>
	<br>
	<p>Ser Imperador significa ser o iniciador de sua rede, assim aumentando os valores dos prêmios alcançados por sua rede.</p>
	<p>Para isso você deve contribuir com a participação de 20 novos membros em nossos sorteios e então <a href='#'>clicar aqui.</a></p>
	<p><strong>Importante,</strong> somente os 10 primeiros membros de sua rede serão levados a sua nova rede.</p>
	</div>

	<div id='minha_right'>
	<h3>Minha Rede</h3>

<?php

//print_r($rede);
//echo "<br>";

array_multisort($rede[0],$rede[1]); // aparentemente funciona ok!
//print_r($rede);
//echo "<br>";

//$no_dupes_rede = array_unique($rede);
//echo "<br>";
//print_r($no_dupes_rede);
//echo "<br>";


for ($i = 0; $i < count($rede[0]); $i ++) {

	//if (isset($rede[0][$i])) {
	
	preg_match_all('!\p{L}+!', $rede[0][$i], $matches1);
	
	echo "<div style='text-indent:" . count($matches1[0]) * 20 . "px;'>";
	//echo count($matches1[0]) . " | "; // count = class for position...

			
	//echo $rede[0][$i];
	//echo " | ";
	if ($rede[1][$i] == $this->session->userdata('log_user_name')) 
		echo "<strong>" . $rede[1][$i] . "</strong>";
	else
		echo $rede[1][$i];
	echo "</div>";
	//}
}

?>
	</div>

</div>