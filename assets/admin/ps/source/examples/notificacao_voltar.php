<?php
				$to = "info@webecard.net";
				$from = "info@webecard.net";
				$subject = "11 test status - seu Crédito WEBECARD.net foi Aprovado.";

				//begin of HTML message
				$message = "
					<html>
					  <body bgcolor='lightyellow'>
						<center>
						<br>
							<p>Aprovação de Crédito WEBECARD.net</p> 
							<br>
							<br>
							<p>Não perca tempo, adquira já seus E-Cards e comece a ganhar!</p> 
							<br>
							<p>Obrigado, Rede <a href='http://www.webecard.net/'>WEBECARD.net</a></p>
							<br>
						</center>
					  </body>
					</html>
					";
			   //end of message
				$headers  = "From: $from\r\n";
				$headers .= "Content-type: text/html\r\n";
			
				if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar mensagem...<br>"; }

require_once "../PagSeguroLibrary/PagSeguroLibrary.php";


    /* Definindo as credenciais  */    
            $credentials = new PagSeguroAccountCredentials("info@webecard.net",
               "A5A0C5F59A584911915F7235828CB57D");
      
    /* Tipo de notificação recebida */  
    $type = $_POST['notificationType'];  
      
    /* Código da notificação recebida */  
    $code = $_POST['notificationCode'];  
      
      
    /* Verificando tipo de notificação recebida */  
    if ($type === 'transaction') {  
          
        /* Obtendo o objeto PagSeguroTransaction a partir do código de notificação */  
        $transaction = PagSeguroNotificationService::checkTransaction(  
            $credentials,  
            $code // código de notificação  
        );  
          
    }  

    /* objeto PagSeguroTransactionStatus */  
    $status = $transaction->getStatus();  
	


				
	if ( $status->getValue() == 1 ) { // 3 = PAID // 1 = WAITING_PAYMENT -> used to try and see if it approves no problem
	
	//if ( $_GET ) {  // TESTE
	
	///* // TESTE
		$transactions = $result->getTransactions();
		if (is_array($transactions) && count($transactions) > 0) {
			foreach ($transactions as $key => $transactionSummary) {
				$referencia = $transactionSummary->getReference();				
			}
		}
	//*/
	
	//$referencia = $_GET['referencia']; // TESTE			
	
	include '../../../global.php';

		// get dados da transacao
		$result = mysqli_query($link, "SELECT id, user_id, valor 
									FROM creditos WHERE 
									tipo_cred = 'd' AND status = 'n' AND referencia = '$referencia'
									");
									
		if (mysqli_num_rows($result) > 0) {

			$row = mysqli_fetch_row($result);
			
			$id = $row[0];		$user_id = $row[1];		$valor = $row[2];
			
			// aprova // rever auto on ***
			
			// pega saldo					
			$result = mysqli_query($link, "	SELECT creditos.saldo, users.user_name, users.email_tipo, users.email FROM creditos 
			
											LEFT JOIN users ON creditos.user_id = users.user_id
				
											WHERE creditos.user_id = '$user_id' 
											
											ORDER BY creditos.id DESC ");
												
			$row = mysqli_fetch_row($result);
			
			// adiciona saldo + valor recarga
			$saldo = $row[0] + $valor; 
			
			// adiciona creditos					
			if (!mysqli_query($link, "INSERT INTO creditos (user_id, tipo_cred, valor, saldo)

								VALUES ('$user_id', 'p', '$valor', '$saldo') ")) 
								
			{ echo " erro ao add creditos... from admin"; }

			mysqli_free_result($result);
			
			
			if (!mysqli_query($link, "UPDATE creditos SET status = '' WHERE id = '$id' AND status = 'n' "))
			
			{ echo " erro ao update creditos... from admin"; }
			
			
			// envia email cliente			
			if ($row[2] != 'n') {
			
				$to = $row[3];
				$from = "info@webecard.net";
				$subject = $row[1] . ", seu Crédito WEBECARD.net foi Aprovado.";

				//begin of HTML message
				$message = "
					<html>
					  <body bgcolor='lightyellow'>
						<center>
						<br>
							<p>Aprovação de Crédito WEBECARD.net</p> 
							<br>
							<p>Parabéns, seu crédito de R$" . $valor . " reais foi aprovado.</p> 
							<br>
							<p>Não perca tempo, adquira já seus E-Cards e comece a ganhar!</p> 
							<br>
							<p>Obrigado, Rede <a href='http://www.webecard.net/'>WEBECARD.net</a></p>
							<br>
						</center>
					  </body>
					</html>
					";
			   //end of message
				$headers  = "From: $from\r\n";
				$headers .= "Content-type: text/html\r\n";
			
				if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar mensagem...<br>"; }
				
				}
			echo "Done!";
		}
	}	

				

