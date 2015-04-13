<?php
session_start();

if (isset($_SESSION['user1'])) {

?><h1>Admin Sorteios</h1>

<?php
include 'functions.php'; 

if ($_GET['sortear']) {					

	$data = $_GET['sortear'];
	
	$result = mysqli_query($link, "	SELECT *, COUNT(*) AS the_count
									FROM ecards
									WHERE 									
									sorteio_data = '$data'
									AND (status = 'u' OR status = 'a') AND atual = 's' ");
	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		
	echo "Entrar Resultado: (ja do < p/ >) ex. 
	
		<form action='sortear.php' method='POST' >
		
		<input type='text' name='resultado' >	
		<input type='hidden' name='sorteio_num' value='{$row['sorteio_num']}' >	
		<input type='hidden' name='sorteio_data' value='{$row['sorteio_data']}' >
		<input type='submit' >
		
		</form>";

							
	echo "<br><br><a href='sortear.php?sortear=" . $row['sorteio_data'] . "'> Sortear -> " . $row['sorteio_data'] . "</a> 
	
	Num. Partc: " . $row['the_count'] . " Sorteio: " . $row['sorteio_num']; echo "<br><br>";
			
}	


if ($_POST['resultado']) {

	$resultado = $_POST['resultado'];	$sorteio_num = $_POST['sorteio_num'];	$sorteio_data = $_POST['sorteio_data'];
	
	if (count(explode(',', $resultado)) == 5) {
	
	$resultado = str_replace(" ", "", $resultado);

	$pieces1 = array_map('intval', explode(',', $resultado));

	sort($pieces1);
	
	$resultado = join(",",$pieces1);


	// checa se sorteio ja realizado
	
	$result = mysqli_query($link, "SELECT sorteio_data FROM prem_info WHERE sorteio_data = '$sorteio_data' ");
	$ja_existe = mysqli_num_rows($result);
	if ($ja_existe == 0) {		
	
		
	// Pegar todos os participantes do sorteio, fazer pontuacao para results_temp
	
	$result = mysqli_query($link, "	SELECT * FROM ecards WHERE 									
									sorteio_data = '$sorteio_data'
									AND (status = 'u' OR status = 'a') AND atual = 's' ");


	$num_particp = mysqli_num_rows($result);
	
	
	// ver acumulados

	
	if ($num_particp < 20) { // < 20 normal // < 1 para teste
	
		echo "Acumulou...";
	
		$a = strtotime("next Friday", strtotime($sorteio_data));
		
		//$next_friday = date( "Y-m-d", strtotime("next Friday"));

		$next_friday = date( "Y-m-d", $a);

		
		// update novo com atual...
		if (!muda_status_acu($sorteio_data,$next_friday)) echo "erro ao entrar acumulados...";

							

	// Realiza prem_info
	
	mysqli_query($link, "INSERT INTO prem_info (sorteio_num, sorteio_data, sorteio_result, num_win_1, num_win_2, val_total, num_dilu) 

						VALUES ('$sorteio_num', '$sorteio_data', 'acumulado', '0', '0', '0', '0')");		
	
	} else {
	

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

	
		$total_pontos = pontuacao($resultado, $row['ecard']);
		
		mysqli_query($link, "INSERT INTO results_temp (sorteio_num, sorteio_data, user_id, total_pontos, ecard, id_ecard) 

							VALUES ('$sorteio_num', '$sorteio_data', '{$row['user_id']}', '$total_pontos', '{$row['ecard']}', '{$row['id_ecard']}')");		

	}
	
	
	
	// get winners and numero de ganhadores do sorteio
	
	// prim = "0,1" seg = "1,1"

	// Traz ganhadores 1 e 2 premio
	$getwinners1 = get_winners($sorteio_data,"0,1");
	$count_win1 = count($getwinners1);
	
	
	$getwinners2 = get_winners($sorteio_data,"1,1");
	$count_win2 = count($getwinners2);
	
	
	for ($i = 0; $i < $count_win1; $i ++) {
	
		$rede[] = get_rede($getwinners1[$i]['a_user_id']);
	
	}
	
	
	
		// novo update
		
	$a = strtotime("next Friday", strtotime($sorteio_data));

	$next_friday = date( "Y-m-d", $a);

	//$next_friday = date( "Y-m-d", strtotime("next Friday"));

	if (!muda_status_usados($sorteio_data,$next_friday)) echo "erro ao alterar usados...";
	


	
	// numero de diluicao total
	
	
	for ($i = 0; $i < $count_win1; $i ++) {
	
		for ($m = 0; $m < $rede[$i][2]; $m ++) {

			$id_rede[] = $rede[$i][1][$m]; 
			$rede_rede[] = $rede[$i][0][$m]; 
			//$rede_missed[] = $rede[$i][3][$m]; 
		}	
	}	
	


	$num_dilu = count($id_rede);
	
	// get valor total
	
	$val_total = $num_particp * 5;
	
	
	// Realiza prem_info
	
	mysqli_query($link, "INSERT INTO prem_info (sorteio_num, sorteio_data, sorteio_result, num_win_1, num_win_2, val_total, num_dilu) 

						VALUES ('$sorteio_num', '$sorteio_data', '$resultado', '$count_win1', '$count_win2', '$val_total', '$num_dilu')");		

						
						
	// Valor primeiro premio, ja divido entre ganhadores
	
	$valor1 = ($val_total * 0.35) / $count_win1;
	
	
	// set data format for email
	$sorteio_data_2 = date("d-m-Y", strtotime($sorteio_data));

	
	// Realiza prem_sorteios 1 premio
	
	for ($i = 0; $i < $count_win1; $i ++) {

	mysqli_query($link, "INSERT INTO prem_sorteios (sorteio_num, sorteio_data, id_winner, prim_ou_seg, valor, ecard, pontuacao, id_ecard) 

						VALUES ('$sorteio_num', '$sorteio_data', '{$getwinners1[$i]['a_user_id']}', '1', '$valor1', 
								'{$getwinners1[$i]['a_ecard']}', '{$getwinners1[$i]['a_total_pontos']}', '{$getwinners1[$i]['a_id_ecard']}')");	
						
	$tipo_cred = "b";
	
	if (!add_credits($getwinners1[$i]['a_user_id'],$tipo_cred,$valor1)) { echo "problema ao adicionar creditos..."; }

	// altera status para 1 winner
	$novo_status = 'w';
	if (!muda_status_winners($getwinners1[$i]['a_id_ecard'],$novo_status,$sorteio_data)) { echo "problema ao alterar 1 winner..."; }
	
	
	$res_email = mysqli_query($link, "	SELECT email, email_tipo, user_name FROM users 
										WHERE user_id = '{$getwinners1[$i]['a_user_id']}' AND status = '' ");
		
	$row = mysqli_fetch_row($res_email);
	
	if (!empty($row[0]) && $row[1] != 'n') {
	
		 //change this to your email.
		$to = $row[0];
		$from = "info@webecard.net";
		$subject = $row[2] . ", você ganhou o Sorteio $sorteio_data_2 WEBECARD.net";

		$valor_1 = number_format($valor1, 2, '.', ',');
		
		$logopath = "http://www.webecard.net/assets/images/logo.jpg";
		//begin of HTML message
		$message = "
			<html>
			  <body>
				<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>
				<p><img src='" . $logopath . "' alt='Logomarca WEBECARD.net'></p><br>
				<h3>Sorteio WEBECARD.net</h3><br>
					<p>Parabéns, você ganhou " . $valor_1 . " pontos no Sorteio da Promoção WEBECARD.net</p> 
					<br>
					<p><a href='http://www.webecard.net/'>WEBECARD.net</a></p>
					<br>
				</div>
			  </body>
			</html>
			";
	   //end of message
		$headers  = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";

		//options to send to cc+bcc
		//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
		//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
	
		if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar menssagem..."; }
	
	} // else echo $row[2] . " < 1 email... nao...<br>";


	}
	
	
	// Valor segundo premio, ja divido entre ganhadores
	
	$valor2 = ($val_total * 0.10) / $count_win2;
	
	
	// Realiza prem_sorteios 2 premio
	
	for ($i = 0; $i < $count_win2; $i ++) {

	mysqli_query($link, "INSERT INTO prem_sorteios (sorteio_num, sorteio_data, id_winner, prim_ou_seg, valor, ecard, pontuacao, id_ecard) 

						VALUES ('$sorteio_num', '$sorteio_data', '{$getwinners2[$i]['a_user_id']}', '2', '$valor2', 
								'{$getwinners2[$i]['a_ecard']}', '{$getwinners2[$i]['a_total_pontos']}', '{$getwinners2[$i]['a_id_ecard']}')");

	$tipo_cred = "c";
	
	if (!add_credits($getwinners2[$i]['a_user_id'],$tipo_cred,$valor2)) { echo "problema ao adicionar creditos..."; }

	// altera status para 2 winner
	$novo_status = 'y';
	if (!muda_status_winners($getwinners2[$i]['a_id_ecard'],$novo_status,$sorteio_data)) { echo "problema ao alterar 2 winner..."; }

	$res_email = mysqli_query($link, "	SELECT email, email_tipo, user_name FROM users 
										WHERE user_id = '{$getwinners2[$i]['a_user_id']}' AND status = '' ");
		
	$row = mysqli_fetch_row($res_email);
	
	if (!empty($row[0]) && $row[1] != 'n') {
	
		 //change this to your email.
		$to = $row[0];
		$from = "info@webecard.net";
		$subject = $row[2] . ", você ganhou em 2º lugar o Sorteio $sorteio_data_2 WEBECARD.net";

		//begin of HTML message
		$valor_2 = number_format($valor2, 2, '.', ',');

		$logopath = "http://www.webecard.net/assets/images/logo.jpg";
		$message = "
			<html>
			  <body>
				<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>
				<p><img src='" . $logopath . "' alt='Logomarca WEBECARD.net'></p><br>
				<h3> Sorteio WEBECARD.net</h3><br>
					<p>Parabéns, você ganhou " . $valor_2 . " pontos pelo 2º lugar do Sorteio da Promoção WEBECARD.net</p> 
					<br>
					<p><a href='http://www.webecard.net/'>WEBECARD.net</a></p>
				<br>
				</div>
			  </body>
			</html>
			";
	   //end of message
		$headers  = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";

		//options to send to cc+bcc
		//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
		//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
	
		if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar menssagem..."; }
	
	} // else echo $row[2] . " < 2 email... nao...<br>";
	
	
	}
	
	
	
	// Realiza prem_dilu. Eu ganhei dilu de quem? rede inversa...

	
	// get valor da diluicao // $valor1 = 35% ja contabilizado acima
	
	$val_dilu = ($val_total * 0.35) / $num_dilu;

	// descarregar 3 dimensao...
	
	for ($i = 0; $i < $num_dilu; $i ++) {
															// pagar diluicao id_winner, ganhou de rede
		mysqli_query($link, "INSERT INTO prem_dilu (sorteio_num, sorteio_data, id_winner, rede, valor) 

							VALUES ('$sorteio_num', '$sorteio_data', '{$id_rede[$i]}', '{$rede_rede[$i]}', '$val_dilu')");	
							
		
		$tipo_cred = "a";
		
		if (!add_credits($id_rede[$i],$tipo_cred,$val_dilu)) { echo "problema ao adicionar creditos..."; }
		
	// envia email	
	$res_email = mysqli_query($link, "	SELECT email, email_tipo, user_name FROM users 
										WHERE user_id = '{$id_rede[$i]}' AND status = '' ");
		
	$row = mysqli_fetch_row($res_email);
	
	if (!empty($row[0]) && $row[1] != 'n') {
		
		// get user_name rede
		$res_email2 = mysqli_query($link, "	SELECT user_name FROM users 
											WHERE user_id = '{$rede_rede[$i]}' AND status = '' ");
			
		$row2 = mysqli_fetch_row($res_email2);
	
		// format valor e data
		$val_dilu_2 = number_format($val_dilu, 2, '.', ',');

		 //change this to your email.
		$to = $row[0];
		$from = "info@webecard.net";
		$subject = $row[2] . ", você ganhou pela sua Rede WEBECARD.net $sorteio_data_2 através de " . $row2[0];

		$logopath = "http://www.webecard.net/assets/images/logo.jpg";
		//begin of HTML message
		$message = "
			<html>
			  <body>
				<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>
				<p><img src='" . $logopath . "' alt='Logomarca WEBECARD.net'></p><br>
				<h3>Diluição Rede WEBECARD.net</h3><br>
					<p>Parabéns {$row[2]}, você ganhou " . $val_dilu_2 . " pontos pela sua Rede da WEBECARD.net através de {$row2[0]}</p> 
					<br>
					<p>Rede <a href='http://www.webecard.net/'>WEBECARD.net</a></p>
					<br>
				</div>
			  </body>
			</html>
			";
	   //end of message
		$headers  = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";

		//options to send to cc+bcc
		//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
		//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
	
		if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar menssagem..."; }
	
	} // else echo $row[2] . " < dilu email... nao...<br>";


	
	}	
	
		for ($i = 0; $i < $count_win1; $i ++) {
	
		for ($m = 0; $m < $rede[$i][4]; $m ++) {

			// $id_rede[] = $rede[$i][1][$m]; 
			// $rede_rede[] = $rede[$i][0][$m]; 
			
			//$rede_missed[] = $rede[$i][3][$m]; 
			//$rede_missed_id[] = $rede[$i][5][$m]; 
			
				if ($rede[$i][5][$m]) {
				mysqli_query($link, "INSERT INTO prem_dilu (sorteio_num, sorteio_data, id_winner, rede, valor, missed) 

									VALUES ('$sorteio_num', '$sorteio_data', '{$rede[$i][3][$m]}', '{$rede[$i][5][$m]}', '$val_dilu', 's')");	

									
				// envia email	
				$res_email = mysqli_query($link, "	SELECT email, email_tipo, user_name FROM users 
													WHERE user_id = '{$rede[$i][3][$m]}' AND status = '' ");
					
				$row = mysqli_fetch_row($res_email);
				
				if (!empty($row[0]) && $row[1] != 'n') {
					
					// get user_name rede
					$res_email2 = mysqli_query($link, "	SELECT user_name FROM users 
														WHERE user_id = '{$rede[$i][5][$m]}' AND status = '' ");
						
					$row2 = mysqli_fetch_row($res_email2);
				
					// format valor e data
					$val_dilu_2 = number_format($val_dilu, 2, '.', ',');

					 //change this to your email.
					$to = $row[0];
					$from = "info@webecard.net";
					$subject = $row[2] . ", você deixou de ganhar pela sua Rede WEBECARD.net Sorteio $sorteio_data_2 ";

		$logopath = "http://www.webecard.net/assets/images/logo.jpg";
		//begin of HTML message
		$message = "
			<html>
			  <body>
				<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>
				<p><img src='" . $logopath . "' alt='Logomarca WEBECARD.net'></p><br>
				<h3>Diluição Rede WEBECARD.net</h3><br>
								<p>{$row[2]}, você deixou de ganhar " . $val_dilu_2 . " pontos pela sua Rede da WEBECARD.net através de {$row2[0]}</p> 
								<br>
								<p>Basta participar com 1 E-Card a cada 2 meses para estar ativo e receber por sua rede.</p> 
								<br>
								<p>Não fique fora desta!</p> 
								<br>
								<p>Rede <a href='http://www.webecard.net/'>WEBECARD.net</a></p>
								<br>
							</div>
						  </body>
						</html>
						";
				   //end of message
					$headers  = "From: $from\r\n";
					$headers .= "Content-type: text/html\r\n";

					//options to send to cc+bcc
					//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
					//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
				
					if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar menssagem..."; }
				
				} // else echo $row[2] . " < dilu email... nao...<br>";
									
									
				}	
			}	
		}	

		
	echo "Sorteio realizado com sucesso...";
	
} // acumulados
} else echo " Sorteio já realizado..."; // se ja houve sorteio

} else echo " Resultado com erro..."; // se ja houve sorteio

} else echo " Resultado nao pode estar vazio..."; // se ja houve sorteio

} // session
?>