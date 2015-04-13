<?php		include 'global.php';

$user_id = "a1b1c1";

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao para 
	
function novo_usuario($rec_id) {

	// perfect!
	// gets all letters and put in array
	preg_match_all('!\p{L}+!', $rec_id, $matches1);
	
	$a = end($matches1[0]);

	$aa = ++ $a;
	$aaa = $rec_id . $aa;
	
	global $link;
	
	$num = 1;
	
	do {
	
	$new_user_id = $aaa . $num;
	
	$query = "SELECT * FROM users WHERE user_id = '$new_user_id' ";
	//echo $query . "<br>";
	$result = mysqli_query($link,$query);
	
	$num = $num + 1;
	
	//echo mysqli_num_rows($result) . " num rows<br>";
	} while (mysqli_num_rows($result) == 1);
	
	// if > 255 chars exit()
	
	return $new_user_id;
	
}
//$rec_id = "a1b1c1";

//echo novo_usuario($rec_id);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao para 
	
function get_valores($val_total) {

	$val1 = $val_total * 0.35;		$val2 = $val_total * 0.10;		$val_taxas = $val_total * 0.20;		


	return $todos_val = array($val1,$val2,$val_taxas);
}

	
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao para 
	
function convert_sigla($sigla) { switch($sigla) {
	
	case "": $sigla = "Não Definido"; break;
	case "p": $sigla = "Prim. Cadastro"; break;
	case "i": $sigla = "Indicação"; break;
	case "g": $sigla = "Recarga"; break;
	case "t": $sigla = "Tentativa"; break;
	case "v": $sigla = "Voucher"; break;
	case "b": $sigla = "Recarga/Boleto"; break;
	case "c": $sigla = "Recarga/C.Crédito"; break;
	case "d": $sigla = "Recarga/C.Débito"; break;
	case "f": $sigla = "Recarga/Transf"; break;
	case "s": $sigla = "Confirmado"; break;
	case "n": $sigla = "Pendente"; break;
	case "e": $sigla = "Erro"; break;
	case "a": $sigla = "Acerto"; break;
	case "1": $sigla = "Plano 30 - 6 Meses"; break;
	case "2": $sigla = "Plano 30 - 12 Meses"; break;
	case "3": $sigla = "Plano 50 - 6 Meses"; break;
	case "4": $sigla = "Plano 50 - 12 Meses"; break;
	case "z": $sigla = "Plano 30 - Grátis"; break;
	case "y": $sigla = "Plano 50 - Grátis"; break;
	case "x": $sigla = "Tentativa/Grátis"; break;
	
} return $sigla; }


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao para 
/*
function count_recursive ($array, $limit) {
    $count = 0;
    foreach ($array as $id => $_array) {
        if (is_array ($_array) && $limit > 0) {
            $count += count_recursive ($_array, $limit - 1);
        } else {
            $count += 1;
        }
    }
    return $count;
}
*/
// echo count_recursive ($array, $limit); // $limit = 0, primeira raiz, = 1 segunda raiz...

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao para 
	
function get_rede($id_winner) {
										global $link;
	// perfect!
	//$id_winner = 'aa11bc12c1d1d2d3';	
	
	// gets all letters and put in array					// gets all numbers and put in array
	preg_match_all('!\p{L}+!', $id_winner, $matches1);		preg_match_all('!\d+!', $id_winner, $matches);
	
	$array = array_merge($matches1, $matches);
	
	$temp = "";		$rede_missed = "";		$rede_missed_id = "";
	
	for ($i = 0; $i < count($array[0]); $i ++){
	
	// checar ecards por 2 meses e se nao salvar em uma array separada e enviar email e add to rendimentos = 0
	// checar tambem por status '', caso conta deletada
	
		$temp .= $array[0][$i] . $array[1][$i];
		
		$result = mysqli_query($link, "	SELECT user_id FROM users 
										WHERE user_id = '$temp' AND status = '' ");
											
		if (mysqli_num_rows($result) > 0) { 
		
			// se t, y , w nos ultimos 2 meses, e se 'a' para a mesma semana(assim nao podendo ser mudada)
			
/*			$result = mysqli_query($link, "	SELECT sorteio_data FROM ecards 
											WHERE ( status = 't' OR status = 'y' OR status = 'w' )
											AND user_id = '$temp'
											AND sorteio_data > DATE_SUB(CURDATE(), INTERVAL 2 MONTH)
											AND sorteio_data <= CURDATE()
											UNION ALL
											SELECT sorteio_data FROM ecards 
											WHERE status = 'a'
											AND user_id = '$temp'
											AND sorteio_data < DATE_ADD(CURDATE(), INTERVAL 7 DAY)
											AND sorteio_data >= CURDATE()
											");
*/		
			$result = mysqli_query($link, "	SELECT sorteio_data FROM ecards 
											WHERE ( status = 't' OR status = 'y' OR status = 'w' OR status = 'a' )
											AND user_id = '$temp'
											AND sorteio_data > DATE_SUB(CURDATE(), INTERVAL 8 WEEK)
											AND sorteio_data <= CURDATE()
											");
												
			if (mysqli_num_rows($result) < 1 && $temp != 'a1') {
			
				$rede_missed[] = $temp;
				$rede_missed_id[] = $id_winner;
			
			} else {
			
				if ($temp != $id_winner) {
			
					$rede[] = $temp;
					$id[] = $id_winner;
				}
			
			}
		}
	}
	
	$num_redes = count($rede);
	$num_rede_missed = count($rede_missed);
	
	return array( $id, $rede, $num_redes, $rede_missed, $num_rede_missed, $rede_missed_id );
}



function get_rede_old($id_winner) {

	// perfect!
	//$id_winner = 'aa11bc12c1d1d2d3';
	
	// gets all letters and put in array
	preg_match_all('!\p{L}+!', $id_winner, $matches1);
	
	// gets all numbers and put in array
	preg_match_all('!\d+!', $id_winner, $matches);

	$array = array_merge($matches1, $matches);
	$temp = "";
	for ($i=0;$i<count($array[0]);$i++){
	
		$temp .= $array[0][$i] . $array[1][$i];
		$rede[] = $temp;
		$id[] = $id_winner;
	}
	
	$num_redes = count($rede);
	
	return array($id,$rede,$num_redes);
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao para 

function get_winners($sorteio_data,$prim_ou_seg) {

	// prim = "0,1" seg = "1,1"
	global $link;

	$query = "SELECT * FROM results_temp WHERE
	 sorteio_data='$sorteio_data' AND
	 total_pontos IN (
	   SELECT * FROM (
		  SELECT DISTINCT total_pontos 
		  FROM results_temp WHERE sorteio_data='$sorteio_data'       
		  ORDER BY total_pontos "; 
	$query .= "LIMIT " .  $prim_ou_seg;
	$query .= "   ) AS t
		)";

	$result = mysqli_query($link, $query);

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

	$a_total_pontos[] = array($row["user_id"] => $row["total_pontos"]);
	$a_ecard[] = array($row["user_id"] => $row["ecard"]);
	$a_id_ecard[] = array($row["user_id"] => $row["id_ecard"]);
	
	$user_id[] = array(
						'a_user_id' 		=> $row['user_id'], 
						'a_total_pontos' 	=> $row['total_pontos'], 
						'a_ecard' 			=> $row["ecard"],
						'a_id_ecard' 		=> $row["id_ecard"]	
						);
	}
	
	return $user_id; 
}

//$getwinners = get_winners($sorteio_data,$prim_ou_seg);
//count($getwinners) = numero de winners. $getwinners[] = winners id

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao para 
	
function get_time($tempo) {

	//$date = strtotime("next Friday 19:00:00"); //Converted to a PHP date (a second count)
	$date = strtotime($tempo);

	//Calculate difference
	$diff = $date-time();//time returns current time in seconds
	$days = floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
	//$hours = round(($diff-$days*60*60*24)/(60*60));

	//Report
	//echo "$days days $hours hours remain<br />";
	
	return $days;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao para 
	
function get_dates($i_date) {

	for($i_date; $i_date < 12;$i_date ++) {
	
		$data = date( "Y-m-d", strtotime("next Friday" . '+' . $i_date . ' week'));
		$data2 = date( "d/m/Y", strtotime("next Friday" . '+' . $i_date . ' week'));
	
		$options .= "
		<option value='" . $data . "'> " . $data2 . " </option>
		";
	
	}
	
	return $options;	
		
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao adiciona novo ecard				
		
function add_new_ecard($user_id, $ecard, $new_id_ecard, $new_sentence, $new_design, $distribuicao) {
	
	global $link;	
	
	$status = 'c';
	
	if ($distribuicao) { $distribuicao = $user_id; $user_id = 0; $status = 'n'; }
		
	// *** adicionar seguranca de double id_ecard...
	if ($result = mysqli_query($link, "INSERT INTO ecards (id_ecard, ecard, user_id, sentence, design, distribuicao, status, atual)
		
					VALUES ('$new_id_ecard', '$ecard', '$user_id', '$new_sentence', '$new_design', '$distribuicao', '$status', 's')")) {
		
		/* free result set */
		mysqli_free_result($result);
	}


}

//if (valida_ecard($id_ecard)) echo "e-card validado com sucesso"; else echo "Erro ao validar e-card...";				

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao debita ecard				
		
function debita_ecard($user_id,$saldo) {
	
	global $link;	
	
	$saldo = $saldo - 10; 		$tipo_cred = "e";		$valor = 10;
	
	$query = "INSERT INTO creditos (user_id, tipo_cred, valor, saldo)
	
	VALUES ('$user_id', '$tipo_cred', '$valor', '$saldo') ";

	if ($result = mysqli_query($link, $query)) { return true; }
	
    mysqli_free_result($result);

}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao debita ecard				
		
function add_credits($user_id,$tipo_cred,$valor) {
	
	global $link;	
	
	// pega saldo					
	$result = mysqli_query($link, "SELECT saldo FROM creditos WHERE 
										user_id = '$user_id' 
										ORDER BY id DESC ");
										
	$row = mysqli_fetch_row($result);
	
	// se compra de credito, necessita aprovacao
	if ($tipo_cred == 'd') {
	
	$saldo = $row[0];
	$status = 'n';
	
	} else {
				$saldo = $row[0] + $valor; 
				$status = '';
	}
	
	// adiciona creditos					
	if (mysqli_query($link, "INSERT INTO creditos (user_id, tipo_cred, valor, status, saldo)

						VALUES ('$user_id', '$tipo_cred', '$valor', '$status', '$saldo') ")) { 
						
	return true; }

	mysqli_free_result($result);
							
							
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao que duplica o ecard e muda de status				
		
function muda_status($id_ecard,$novo_status,$nova_data) {
	
	global $link;	
	
	// pega dados atual ecard
	
	$query = "SELECT * FROM ecards
	
	WHERE id_ecard = '$id_ecard' AND atual = 's' ";
	
	$result = mysqli_query($link, $query);
	
	if (mysqli_num_rows($result) > 1) { echo "Mais de 1 record encontrado como atual = 's' "; exit(); }
	
	$row = mysqli_fetch_array($result);
	
	$ecard = $row['ecard'];
	
	if (empty($nova_data)) $sorteio_data = $row['sorteio_data']; else $sorteio_data = $nova_data;
	
	$user_id = $row['user_id'];
	$sentence = $row['sentence'];
	$design = $row['design'];
	$distribuicao = $row['distribuicao'];
	
	
	// retira atual...
	$query2 = "UPDATE ecards SET  atual = '' WHERE id_ecard = '$id_ecard' AND atual = 's' ";
	
	mysqli_query($link, $query2);
	
	
	// insere ecard atualizado
	$query3 = "INSERT INTO ecards 
	(id_ecard, ecard, sorteio_data, user_id, sentence, design, distribuicao, status, atual) 
		VALUES 
	('$id_ecard', '$ecard', '$sorteio_data', '$user_id', '$sentence', '$design', '$distribuicao', '$novo_status', 's') ";
	
	mysqli_query($link, $query3);
	

	
	if (mysqli_affected_rows($link) > 0) { return true; }
	
    mysqli_free_result($result);

}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao que duplica o ecard e muda de status				
		
function muda_status_winners($id_ecard,$novo_status,$sorteio_data) {
	
	global $link;	
	
	// pega dados atual ecard
	
	$query = "	UPDATE ecards SET status = '$novo_status' 
				WHERE id_ecard = '$id_ecard' 
				AND status = 't' AND sorteio_data = '$sorteio_data' ";
	
	
	if ($result = mysqli_query($link, $query)) { return true; }
	
    mysqli_free_result($result);

}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao que duplica os ecards e muda os status para m = acumulados		
		
function muda_status_acu($sorteio_data,$nova_data) {
	
	global $link;	
	
	// pega dados atual ecard
	
	$query = "SELECT ecards.*, users.user_name, users.email_tipo, users.email  FROM ecards
	
	LEFT JOIN users ON ecards.user_id = users.user_id
	
	WHERE ecards.sorteio_data = '$sorteio_data' AND ecards.atual = 's' AND (ecards.status = 'u' OR ecards.status = 'a') ";
	
	$result = mysqli_query($link, $query);
	
	if (mysqli_num_rows($result) < 1) { echo "Ninguem encontrado para alteracao acumulados "; exit(); }
	
	$sorteio_data_2 = date("d-m-Y", strtotime($sorteio_data));

	while ($row = mysqli_fetch_array($result)) {
	
		// envia email comunicacao acumulacao por falta de 20
		
		if ($row['email_tipo'] != 'n') {
		
			$to = $row['email'];
			$from = "info@webecard.net";
			$subject = $row['user_name'] . ", o Sorteio de $sorteio_data_2 WEBECARD.net foi Acumulado.";

		$logopath = "http://www.webecard.net/assets/images/logo.jpg";
		//begin of HTML message
		$message = "
			<html>
			  <body>
				<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>
				<p><img src='" . $logopath . "' alt='Logomarca WEBECARD.net'></p><br>
						<h3>Sorteio Acumulado</h3> 
						<br>
						<p>O Sorteio de $sorteio_data_2 WEBECARD.net foi acumulado pois o mínimo de 20 E-Cards não foi atingido.</p> 
						<br>
						<p>Não se preocupe, seus E-Cards participantes foram datados para a próxima semana.</p> 
						<br>
						<p>Recomende nossa rede para que não acumule mais!.</p> 
						<br>
						<p>Obrigado, Rede <a href='http://www.webecard.net/'>WEBECARD.net</a></p>
						<br>
					</div>
				  </body>
				</html>
				";
		   //end of message
			$headers  = "From: $from\r\n";
			$headers .= "Content-type: text/html\r\n";
		
			if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar menssagem..."; }
		}
	
		$id_ecard[] = $row['id_ecard'];
		$ecard[] = $row['ecard'];				
		$user_id[] = $row['user_id'];
		$sentence[] = $row['sentence'];
		$design[] = $row['design'];
		$distribuicao[] = $row['distribuicao'];
		$status[] = $row['status'];
	
	}
	
	// retira atual...
	$query2 = "	UPDATE ecards SET  atual = '', status = 'm'
				WHERE 
				sorteio_data = '$sorteio_data' AND
				atual = 's' AND
				(status = 'u' OR status = 'a') ";
				
	if (!mysqli_query($link, $query2)) $erro = 2;
	
	
	// insere ecards atualizados
	for ($i = 0; $i < count($id_ecard); $i ++) {
	
		$query3 = "INSERT INTO ecards 
		(id_ecard, ecard, sorteio_data, user_id, sentence, design, distribuicao, status, atual) 
			VALUES 
		('$id_ecard[$i]', '$ecard[$i]', '$nova_data', '$user_id[$i]', '$sentence[$i]', '$design[$i]', '$distribuicao[$i]', '$status[$i]', 's') ";
		
		if (!mysqli_query($link, $query3)) $erro = 2;
	
	}
	
			
	
	if (!$erro) return true; else echo $erro;
	
    mysqli_free_result($result);

}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao que duplica os ecards e muda os status para t = term. ou u = usado		
		
function muda_status_usados($sorteio_data,$nova_data) {
	
	global $link;	
	
	// pega dados atual ecard
	
	$query = "SELECT * FROM ecards
	
	WHERE sorteio_data = '$sorteio_data' AND atual = 's' AND (status = 'u' OR status = 'a') ";
	
	$result = mysqli_query($link, $query);
	
	if (mysqli_num_rows($result) < 1) { echo "Ninguem encontrado para alteracao acumulados "; exit(); }
	
	while ($row = mysqli_fetch_array($result)) {
	
		$id_ecard[] = $row['id_ecard'];
		$ecard[] = $row['ecard'];				
		$user_id[] = $row['user_id'];
		$sentence[] = $row['sentence'];
		$design[] = $row['design'];
		$distribuicao[] = $row['distribuicao'];
		$status[] = $row['status'];
	
	}
	
	// retira atual...
	$query2 = "	UPDATE ecards SET  atual = '', status = 't'
				WHERE 
				sorteio_data = '$sorteio_data' AND
				atual = 's' AND
				(status = 'u' OR status = 'a') ";
	
	if (!mysqli_query($link, $query2)) $erro = 1;
	
	
	// insere ecards atualizados
	for ($i = 0; $i < count($id_ecard); $i ++) {
	
		if ($status[$i] == 'a') {
		
			$query3 = "INSERT INTO ecards 
			(id_ecard, ecard, sorteio_data, user_id, sentence, design, distribuicao, status, atual) 
				VALUES 
			('$id_ecard[$i]', '$ecard[$i]', '$nova_data', '$user_id[$i]', '$sentence[$i]', '$design[$i]', '$distribuicao[$i]', 'u', 's') ";
			
			if (!mysqli_query($link, $query3)) $erro = 2;
		}
	}
	
	if (!$erro) return true; else echo $erro;
	
    mysqli_free_result($result);

}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao valida ecard apos pagamento				
		
function valida_ecard($id_ecard) {
	
	global $link;	
	
	$query = "UPDATE ecards SET valido = 's'
	
	WHERE id_ecard = '$id_ecard' AND valido != 's' " 
			
			or die("Erro ao validar e-card..." . mysqli_error($link));

	$result = mysqli_query($link, $query);
	
	if (mysqli_affected_rows($link) > 0) { return true; }
	
    mysqli_free_result($result);

}
//$id_ecard = "00";

//if (valida_ecard($id_ecard)) echo "e-card validado com sucesso"; else echo "Erro ao validar e-card...";				

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao adiciona primeira data e altera ex. 20/03/2013 ao ecard				
		
function add_date($date, $id_ecard, $add_date_true) {
	
	global $link;	
	// muda status
	if ($add_date_true) { muda_status($id_ecard,'a',$date); }	
	
	$query = "UPDATE ecards SET sorteio_data = '$date'
	
	WHERE id_ecard = '$id_ecard' AND atual = 's' " ;

	if ($result = mysqli_query($link, $query)) { return true; }
	
    mysqli_free_result($result);

}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao get design				
		
function get_design($design) {

	return $design;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao get sentence				
		
function get_sentence($sentence) {

	return $sentence;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao gera id_ecard de 12 numeros				
		
function gera_id_ecard() {

	$id_ecard_rand = "";

	for ($leo = 0; $leo < 12; $leo ++) {

		$ecard_random = mt_rand(0,9);

		$id_ecard_rand .= $ecard_random;

	}
	return $id_ecard_rand;
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao gera array de 5 numeros de 1 a 50 (sem duplicados). Gera no maximo 10 arrays.

function gera_array($qt) {

	$count = 1;
	$heap = range(1, 50);
	shuffle($heap);

	foreach (array_chunk($heap, 5) as $block) {
		sort($block);
		$ecard_rand[] = join(",", $block);
		if ($count == $qt) { break; }
		$count = $count + 1;
	}
	return $ecard_rand;
}

//$a = gera_array(5);
//print_r($a);

		
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao gera array de 5 numeros de 1 a 50 (sem duplicados) 

function gera_ecards() {

		// Funcao gera array de 5 numeros de 1 a 50 (com duplicados)	
		if (!function_exists('gera_array_old')) {		
		
		function gera_array_old() {

			$ecard_rand = array();

			for ($leo = 0; $leo < 5; $leo ++) {

				$ecard_random = mt_rand(1,50);

				array_push($ecard_rand, $ecard_random);

			}
			return $ecard_rand;
		}
		
		}
					
		// Funcao remove duplicados da array	
		if (!function_exists('array_has_dupes')) {		
		
		function array_has_dupes($ecard_rand) {

		   return count($ecard_rand) !== count(array_unique($ecard_rand));
		}
		}


	do {
		$ecard_rand = gera_array_old();
	} while (array_has_dupes($ecard_rand));	
	
	sort($ecard_rand);
	
	$ecard_rand = implode(",", $ecard_rand);
	
	return $ecard_rand;
	
}
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// resulta pontos para cada numero do resultado	
		
function diferenca($trio, $prem) {

	if ($trio > $prem) {		
	$pontos = $trio - $prem;
	}
	elseif ($trio < $prem) {		
	$pontos = $prem - $trio;
	}
	else { $pontos = 0; }

	return $pontos;
	}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

// Funcao get pontuacao

function pontuacao($sorteio_result, $cartela) {

	$pieces1 = explode(",", $sorteio_result);
	
	// resultado em pedacos para checagem
	$sorteio_result1 = $pieces1[0];       
	$sorteio_result2 = $pieces1[1];       
	$sorteio_result3 = $pieces1[2];       
	$sorteio_result4 = $pieces1[3];       
	$sorteio_result5 = $pieces1[4];  
		
		
	$pieces2 = explode(",", $cartela);
	// cartela do usuario em pedacos
	$cartela1 = $pieces2[0];       
	$cartela2 = $pieces2[1];       
	$cartela3 = $pieces2[2];       
	$cartela4 = $pieces2[3];       
	$cartela5 = $pieces2[4];       

	$result = array_diff($pieces1, $pieces2);

	//print_r($result);
	// 5 significa que nenhum numero na cabeca
	if (count($result) >= 5) {


	$total_pontos = array();
	// adiciona os pontos de cada numero
	$pontos = diferenca($cartela1,$sorteio_result1);	
	array_push($total_pontos, $pontos);	
	$pontos = diferenca($cartela2,$sorteio_result2); 
	array_push($total_pontos, $pontos);
	$pontos = diferenca($cartela3,$sorteio_result3); 
	array_push($total_pontos, $pontos);
	$pontos = diferenca($cartela4,$sorteio_result4); 
	array_push($total_pontos, $pontos);
	$pontos = diferenca($cartela5,$sorteio_result5); 
	array_push($total_pontos, $pontos);
	
	// soma todos os pontos
	$total_pontos = array_sum($total_pontos);	
	
	} else $total_pontos = count($result);
		
	return $total_pontos;
	
}	
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 


?>