<?php
session_start();

if (isset($_GET['type'])) {
if ($_GET['type'] == 'logout') {
session_destroy();
}
}

if (isset($_POST['senha'])) {

	if ($_POST['senha'] == '481176yfc') {
	
	$_SESSION['user1'] = true;
	
} else echo "no acess";
	
} 



if (isset($_SESSION['user1'])) {


?>

<h1 style="display:inline;">Admin</h1><p style="display:inline;"> <a href='?type=logout'>Logout</a></p> <br> <br>

 <h3 style="display:inline;"><a href="?type=sort">Sorteios</a></h3> | 
 <h3 style="display:inline;"><a href="?type=pend">Aprovacao Credito Pendente</a></h3>  | 
 <h3 style="display:inline;"><a href="?type=saque">Aprovacao Saque Pendente</a></h3>  | 
 <h3 style="display:inline;"><a href="?type=saque_ok">Saques OK</a></h3> 
<br>
 
<?php 					include 'global.php';
						//include 'functions.php';	
						
	function get_valores($val_total) {

		$val1 = $val_total * 0.35;		$val2 = $val_total * 0.10;		$val_taxas = $val_total * 0.20;		


		return $todos_val = array($val1,$val2,$val_taxas);
	}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - Sorteios

if ($_GET['type'] == 'sort' || empty($_GET['type'])) {
?>
 <h3 style="display:inline;"><a href="?sorteios=pend">Sorteios Pendentes</a></h3> 
 <h3 style="display:inline;"><a href="?sorteios=futu">Sorteios Futuros</a></h3> 

<?php

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - Sorteios Pendentes

	if ($_GET['sorteios'] == 'pend' || empty($_GET['sorteios'])) {
	
	$title = "Sorteios Pendentes";
	echo "<h2>" . $title . "</h2>";
	
/*	$result = mysqli_query($link, "	SELECT b.*, a.the_count
									FROM
									  ecards b, 
									  (SELECT sorteio_data, COUNT(*) AS the_count
									  FROM ecards
									  GROUP BY sorteio_data) AS a
									WHERE 									
									( (b.sorteio_data < CURDATE()) OR (b.sorteio_data = CURDATE() AND CURTIME() > '19:00:00') )
									AND b.sorteio_data != '0000-00-00'
									AND b.sorteio_data = a.sorteio_data
									ORDER BY b.sorteio_data ASC ");
*/	
	$result = mysqli_query($link, "	SELECT sorteio_data, COUNT(*) AS the_count FROM ecards
									WHERE sorteio_data <= CURDATE() 
									AND (status = 'a' OR status = 'u')
									AND atual = 's'
									GROUP BY sorteio_data
									ORDER BY sorteio_data ASC ");
	
	$sorteio_data = "";	
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
		if ($sorteio_data != $row['sorteio_data']) {
		
			echo "<br><a href='sortear.php?sortear=" . $row['sorteio_data'] . "'> Sortear -> " . $row['sorteio_data'] . "</a> 
			
			Num. Partc: " . $row['the_count'] . " Sorteio: " . $row['sorteio_num']; echo "<br><br>";
			
			$sorteio_data = $row['sorteio_data'];
			
		}
		/*
		echo $row['sorteio_data']; echo " | ";
		echo $row['user_id']; echo " | ";
		echo $row['id_ecard']; echo " | ";
		echo $row['ecard']; echo " <br>";
	*/
	}
	
	} // end get pend
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - Sorteios Futuros

	if ($_GET['sorteios'] == 'futu') {
	
	$title = "Sorteios Futuros";
	echo "<h2>" . $title . "</h2>";
/*	
	$result = mysqli_query($link, "	SELECT b.*, a.the_count
									FROM
									  ecards b, 
									  (SELECT sorteio_data, COUNT(*) AS the_count
									  FROM ecards
									  GROUP BY sorteio_data) AS a
									WHERE 				
									b.sorteio_data < DATE_ADD(CURDATE(), INTERVAL 3 MONTH)									
									AND b.sorteio_data != '0000-00-00'
									AND b.sorteio_data = a.sorteio_data
									ORDER BY b.sorteio_data ASC ");
*/									
	$result = mysqli_query($link, "	SELECT sorteio_data, COUNT(*) AS the_count FROM ecards
									WHERE sorteio_data >= CURDATE() 
									AND (status = 'a' OR status = 'u')
									AND atual = 's'
									GROUP BY sorteio_data
									ORDER BY sorteio_data ASC ");
	$sorteio_data = "";	
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
		if ($sorteio_data != $row['sorteio_data']) {
		
			echo "<br><a href='sortear.php?sortear=" . $row['sorteio_data'] . "'> Sortear -> " . $row['sorteio_data'] . "</a> 
			
			Num. Partc: " . $row['the_count'] . " Sorteio: " . $row['sorteio_num']; echo "<br><br>";
			
			$sorteio_data = $row['sorteio_data'];
			
		}
		/*
		echo $row['sorteio_data']; echo " | ";
		echo $row['user_id']; echo " | ";
		echo $row['id_ecard']; echo " | ";
		echo $row['ecard']; echo " <br>";
	*/
	}

	} // end get futu
	
	
	


} // end sorteios

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - Pendencias Aprovacao

if ($_GET['type'] == 'pend') {


	$result = mysqli_query($link, "SELECT id, user_id, DATE_FORMAT(data, '%d/%m/%Y') AS data, tipo_cred, valor, status, saldo 
									FROM creditos WHERE 
									tipo_cred = 'd' AND status = 'n'
									ORDER BY id DESC ");

	$title = "Pendencias";

	echo "<h2>" . $title . "</h2>";
?>
<table border="1">
<tr style="font-weight:bold;">
	<td> ID </td>
	<td> User </td>
	<td> data </td>
	<td> tipo credito </td>
	<td> valor </td>
	<td> status </td>
	<td> Aprovação </td>
</tr>

<?php
	if (mysqli_num_rows($result) >= 1) {
	
	while ($row = mysqli_fetch_array($result)) {

	$id2[] = $row['id'];
	$user_id2[] = $row['user_id'];
	$data2[] = $row['data'];
	$tipo_cred2[] = $row['tipo_cred'];
	$valor2[] = $row['valor'];
	$status2[] = $row['status'];
												}
	
$id2_rev = array_reverse($id2);												
$user_id2_rev = array_reverse($user_id2);												
$data2_rev = array_reverse($data2);												
$tipo_cred2_rev = array_reverse($tipo_cred2);												
$valor2_rev = array_reverse($valor2);												
$status2_rev = array_reverse($status2);												
											
	for ($i = 0;$i < count($data2);$i ++) {	
	
		echo "
		<tr>
			<td> $id2_rev[$i] </td>
			<td> $user_id2_rev[$i] </td>
			<td> $data2_rev[$i] </td>
			<td> $tipo_cred2_rev[$i] </td>
			<td> $valor2_rev[$i] </td>
			<td> $status2_rev[$i] </td>
			<td> <a href='aprovar.php?id=$id2_rev[$i]&u=$user_id2_rev[$i]&v=$valor2_rev[$i]'> Aprovar </a> </td>
		</tr>
		";
}

}//end mysql num rows

echo "</table>";											

}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - Pendencias Saque

if ($_GET['type'] == 'saque') {


	$result = mysqli_query($link, "SELECT a.*, DATE_FORMAT(a.date_added, '%d/%m/%Y') AS date_added, a.cpf
									FROM bancos a
									LEFT JOIN users b ON a.user_id = b.user_id
									WHERE 
									a.saque_status = 'n'
									ORDER BY a.id DESC ");

	$title = "Pendencias";

	echo "<h2>" . $title . "</h2>";
?>
<table border="1">
<tr style="font-weight:bold;">

	<td> ID </td>
	<td> b_paypal </td>
	<td> b_pagseg </td>
	<td> b_nome </td>
	<td> b_numero </td>
	<td> b_ag </td>
	<td> b_ag_dig </td>
	<td> b_conta </td>
	<td> b_conta_dig </td>
	<td> b_conta_tipo </td>
	<td> obs </td>
	<td> nome </td>
	<td> sobrenomes </td>
	<td> cpf </td>
	<td> user_id </td>
	<td> tipo </td>
	<td> valor </td>
	<td> date_added </td>
	<td> Aprovação </td>
</tr>

<?php
	if (mysqli_num_rows($result) >= 1) {
	
	while ($row = mysqli_fetch_array($result)) {

	$id2[] = $row['id'];
	$b_paypal2[] = $row['b_paypal'];
	$b_pagseg2[] = $row['b_pagseg'];
	$b_nome2[] = $row['b_nome'];
	$b_numero2[] = $row['b_numero'];
	$b_ag2[] = $row['b_ag'];
	$b_ag_dig2[] = $row['b_ag_dig'];
	$b_conta2[] = $row['b_conta'];
	$b_conta_dig2[] = $row['b_conta_dig'];
	$b_conta_tipo2[] = $row['b_conta_tipo'];
	$obs2[] = $row['obs'];
	$nome2[] = $row['nome'];
	$sobrenomes2[] = $row['sobrenomes'];
	$cpf2[] = $row['cpf'];
	$user_id2[] = $row['user_id'];
	$tipo2[] = $row['tipo'];
	$valor2[] = $row['valor'];
	$date_added2[] = $row['date_added'];
												}
	
	$id2_rev = array_reverse($id2);	
	$b_paypal2_rev = array_reverse($b_paypal2);
	$b_pagseg2_rev = array_reverse($b_pagseg2);
	$b_nome2_rev = array_reverse($b_nome2);
	$b_numero2_rev = array_reverse($b_numero2);
	$b_ag2_rev = array_reverse($b_ag2);
	$b_ag_dig2_rev = array_reverse($b_ag_dig2);
	$b_conta2_rev = array_reverse($b_conta2);
	$b_conta_dig2_rev = array_reverse($b_conta_dig2);
	$b_conta_tipo2_rev = array_reverse($b_conta_tipo2);
	$obs2_rev = array_reverse($obs2);
	$nome2_rev = array_reverse($nome2);
	$sobrenomes2_rev = array_reverse($sobrenomes2);
	$cpf2_rev = array_reverse($cpf2);
	$user_id2_rev = array_reverse($user_id2);
	$tipo2_rev = array_reverse($tipo2);
	$valor2_rev = array_reverse($valor2);
	$date_added2_rev = array_reverse($date_added2);
											
	for ($i = 0;$i < count($id2);$i ++) {	
	
		echo "
		<tr>
			<td> $id2_rev[$i] </td>
			<td> $b_paypal2_rev[$i] </td>
			<td> $b_pagseg2_rev[$i] </td>
			<td> $b_nome2_rev[$i] </td>
			<td> $b_numero2_rev[$i] </td>
			<td> $b_ag2_rev[$i] </td>
			<td> $b_ag_dig2_rev[$i] </td>
			<td> $b_conta2_rev[$i] </td>
			<td> $b_conta_dig2_rev[$i] </td>
			<td> $b_conta_tipo2_rev[$i] </td>
			<td> $obs2_rev[$i] </td>
			<td> $nome2_rev[$i] </td>
			<td> $sobrenomes2_rev[$i] </td>
			<td> $cpf2_rev[$i] </td>
			<td> $user_id2_rev[$i] </td>
			<td> $tipo2_rev[$i] </td>
			<td> $valor2_rev[$i] </td>
			<td> $date_added2_rev[$i] </td>
			<td> <a href='aprovar.php?id=$id2_rev[$i]&u_saque=$user_id2_rev[$i]&v=$valor2_rev[$i]'> Aprovar </a> </td>
		</tr>
		";
}

}//end mysql num rows

echo "</table>";											

}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - -  Saques ok

if ($_GET['type'] == 'saque_ok') {


	$result = mysqli_query($link, "SELECT *, DATE_FORMAT(date_added, '%d/%m/%Y') AS date_added
									FROM bancos WHERE 
									saque_status = 's'
									ORDER BY id DESC ");

	$title = "Pendencias";

	echo "<h2>" . $title . "</h2>";
?>
<table border="1">
<tr style="font-weight:bold;">

	<td> ID </td>
	<td> b_paypal </td>
	<td> b_pagseg </td>
	<td> b_nome </td>
	<td> b_numero </td>
	<td> b_ag </td>
	<td> b_ag_dig </td>
	<td> b_conta </td>
	<td> b_conta_dig </td>
	<td> b_conta_tipo </td>
	<td> obs </td>
	<td> nome </td>
	<td> sobrenomes </td>
	<td> user_id </td>
	<td> tipo </td>
	<td> valor </td>
	<td> date_added </td>
</tr>

<?php
	if (mysqli_num_rows($result) >= 1) {
	
	while ($row = mysqli_fetch_array($result)) {

	$id2[] = $row['id'];
	$b_paypal2[] = $row['b_paypal'];
	$b_pagseg2[] = $row['b_pagseg'];
	$b_nome2[] = $row['b_nome'];
	$b_numero2[] = $row['b_numero'];
	$b_ag2[] = $row['b_ag'];
	$b_ag_dig2[] = $row['b_ag_dig'];
	$b_conta2[] = $row['b_conta'];
	$b_conta_dig2[] = $row['b_conta_dig'];
	$b_conta_tipo2[] = $row['b_conta_tipo'];
	$obs2[] = $row['obs'];
	$nome2[] = $row['nome'];
	$sobrenomes2[] = $row['sobrenomes'];
	$user_id2[] = $row['user_id'];
	$tipo2[] = $row['tipo'];
	$valor2[] = $row['valor'];
	$date_added2[] = $row['date_added'];
												}
	
	$id2_rev = array_reverse($id2);	
	$b_paypal2_rev = array_reverse($b_paypal2);
	$b_pagseg2_rev = array_reverse($b_pagseg2);
	$b_nome2_rev = array_reverse($b_nome2);
	$b_numero2_rev = array_reverse($b_numero2);
	$b_ag2_rev = array_reverse($b_ag2);
	$b_ag_dig2_rev = array_reverse($b_ag_dig2);
	$b_conta2_rev = array_reverse($b_conta2);
	$b_conta_dig2_rev = array_reverse($b_conta_dig2);
	$b_conta_tipo2_rev = array_reverse($b_conta_tipo2);
	$obs2_rev = array_reverse($obs2);
	$nome2_rev = array_reverse($nome2);
	$sobrenomes2_rev = array_reverse($sobrenomes2);
	$user_id2_rev = array_reverse($user_id2);
	$tipo2_rev = array_reverse($tipo2);
	$valor2_rev = array_reverse($valor2);
	$date_added2_rev = array_reverse($date_added2);
											
	for ($i = 0;$i < count($id2);$i ++) {	
	
		echo "
		<tr>
			<td> $id2_rev[$i] </td>
			<td> $b_paypal2_rev[$i] </td>
			<td> $b_pagseg2_rev[$i] </td>
			<td> $b_nome2_rev[$i] </td>
			<td> $b_numero2_rev[$i] </td>
			<td> $b_ag2_rev[$i] </td>
			<td> $b_ag_dig2_rev[$i] </td>
			<td> $b_conta2_rev[$i] </td>
			<td> $b_conta_dig2_rev[$i] </td>
			<td> $b_conta_tipo2_rev[$i] </td>
			<td> $obs2_rev[$i] </td>
			<td> $nome2_rev[$i] </td>
			<td> $sobrenomes2_rev[$i] </td>
			<td> $user_id2_rev[$i] </td>
			<td> $tipo2_rev[$i] </td>
			<td> $valor2_rev[$i] </td>
			<td> $date_added2_rev[$i] </td>
		</tr>
		";
}

}//end mysql num rows

echo "</table>";											

}


} else {

echo "<form action='' method=post >
Acesso <input type=text name=senha >

<input type=submit>";


}
?>