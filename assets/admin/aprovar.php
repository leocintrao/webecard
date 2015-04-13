<?php
session_start();

if (isset($_SESSION['user1'])) {

include 'functions.php';

// Aprovacao credito

if ($_GET['u']) {	
		
	// pega saldo					
	$result = mysqli_query($link, "	SELECT creditos.saldo, users.user_name, users.email_tipo, users.email FROM creditos 
	
									LEFT JOIN users ON creditos.user_id = users.user_id
		
									WHERE creditos.user_id = '{$_GET['u']}' 
									
									ORDER BY creditos.id DESC ");
										
	$row = mysqli_fetch_row($result);
	
	$saldo = $row[0] + $_GET['v']; 
	
	// adiciona creditos					
	if (!mysqli_query($link, "INSERT INTO creditos (user_id, tipo_cred, valor, saldo)

						VALUES ('{$_GET['u']}', 'p', '{$_GET['v']}', '$saldo') ")) 
						
	{ echo " erro ao add creditos... from admin"; }

	mysqli_free_result($result);
	
	
	if (!mysqli_query($link, "UPDATE creditos SET status = '' WHERE id = '{$_GET['id']}' AND status = 'n' "))
	
	{ echo " erro ao update creditos... from admin"; }
				
	if ($row[2] != 'n') {
	
		$to = $row[3];
		$from = "info@webecard.net";
		$subject = $row[1] . ", seu Crédito WEBECARD.net foi Aprovado.";

		$logopath = "http://www.webecard.net/assets/images/logo.jpg";
		//begin of HTML message
		$message = "
			<html>
			  <body>
				<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>
				<p><img src='" . $logopath . "' alt='Logomarca WEBECARD.net'></p><br>
					<h3>Aprovação de Crédito WEBECARD.net</h3> 
					<br>
					<p>Parabéns, seu crédito de R$" . $_GET['v'] . " reais foi aprovado.</p> 
					<br>
					<p>Não perca tempo, adquira já seus E-Cards e comece a ganhar!</p> 
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
	
		if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar mensagem..."; }
	
	}
	
	
				
	header('Location: admin.php?type=pend');						
}
	
// Aprovacao Saques
	
if ($_GET['u_saque']) {

	// pega saldo					
	$result = mysqli_query($link, "	SELECT creditos.saldo, users.user_name, users.email_tipo, users.email FROM creditos 
	
									LEFT JOIN users ON creditos.user_id = users.user_id
	
									WHERE creditos.user_id = '{$_GET['u_saque']}' 
										
									ORDER BY creditos.id DESC ");
										
	$row = mysqli_fetch_row($result);
	
	$saldo = $row[0]; // + $_GET['v']; //retirado
	
	// adiciona creditos					
	if (!mysqli_query($link, "INSERT INTO creditos (user_id, tipo_cred, valor, saldo)

						VALUES ('{$_GET['u_saque']}', 'i', '{$_GET['v']}', '$saldo') ")) 
						
	{ echo " erro ao add creditos... from admin"; }

	mysqli_free_result($result);
	
	
	if (!mysqli_query($link, "UPDATE bancos SET saque_status = 's' WHERE id = '{$_GET['id']}' AND saque_status = 'n' "))
	
	{ echo " erro ao update creditos... from admin"; }
							
	if ($row[2] != 'n') {
	
		$to = $row[3];
		$from = "info@webecard.net";
		$subject = $row[1] . ", seu Saque WEBECARD.net foi Realizado.";

		$logopath = "http://www.webecard.net/assets/images/logo.jpg";
		//begin of HTML message
		$message = "
			<html>
			  <body>
				<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>
				<p><img src='" . $logopath . "' alt='Logomarca WEBECARD.net'></p><br>
					<h3>Saques WEBECARD.net</h3> 
					<br>
					<p>Parabéns, seu saque de R$" . $_GET['v'] . " reais foi realizado.</p> 
					<br>
					<p>Obrigado por fazer parte da Rede <a href='http://www.webecard.net/'>WEBECARD.net</a></p>
					<br>
				</div>
			  </body>
			</html>
			";
	   //end of message
		$headers  = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";
	
		if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar mensagem..."; }
		
		//echo $message; exit();
	
	}
							
	header('Location: admin.php?type=saque');						
}
	
	
} // fecha session start
?>