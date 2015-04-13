<?php
/*
 ************************************************************************
 Copyright [2011] [PagSeguro Internet Ltda.]

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 ************************************************************************
 */

require_once "../PagSeguroLibrary/PagSeguroLibrary.php";

class NotificationListener
{

    public static function main()
    {

        $code = (isset($_POST['notificationCode']) && trim($_POST['notificationCode']) !== "" ?
            trim($_POST['notificationCode']) : null);
        $type = (isset($_POST['notificationType']) && trim($_POST['notificationType']) !== "" ?
            trim($_POST['notificationType']) : null);

        if ($code && $type) { 

            $notificationType = new PagSeguroNotificationType($type);
            $strType = $notificationType->getTypeFromValue();

            switch ($strType) {

                case 'TRANSACTION':
                    self::transactionNotification($code);
                    break;

                default:
                    LogPagSeguro::error("Unknown notification type [" . $notificationType->getValue() . "]");

            }

            self::printLog($strType);

        } else {

            LogPagSeguro::error("Invalid notification parameters.");
            self::printLog();

        }

    }

    private static function transactionNotification($notificationCode)
    {

        /*
         * #### Credentials #####
         * Substitute the parameters below with your credentials (e-mail and token)
         * You can also get your credentials from a config file. See an example:
         * $credentials = PagSeguroConfig::getAccountCredentials();
         */
        $credentials = new PagSeguroAccountCredentials("info@webecard.net",
               "A5A0C5F59A584911915F7235828CB57D");
        try {
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);
            // Do something with $transaction
			
		$to = "info@webecard.net";
		$from = "info@webecard.net";
		$subject = "Status Test WEBECARD.net";

		//begin of HTML message

		$message = "
			<html>
			  <body bgcolor='lightyellow'> 
				<center>
				<br>
					<p>Status WEBECARD.net</p> 
					<br>
					<p>" . $status->getTypeFromValue() . "</p> 
					<br>
					<p>" . $transaction->getCode() . "</p> 
					<br>
					<p>" . print_r($transaction) . "</p> 
					<br>
					<p><a href='http://www.webecard.net/'>WEBECARD.net</a></p>
				<br>
				</center>
			  </body>
			</html>
			";
	   //end of message
		$headers  = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";

		if (!mail($to, $subject, $message, $headers)) { echo "problema ao enviar menssagem..."; }
			
			
			
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }

    }

    private static function printLog($strType = null)
    {
        $count = 4;
        echo "<h2>Receive notifications</h2>";
        if ($strType) {
            echo "<h4>notifcationType: $strType</h4>";
        }
        echo "<p>Last <strong>$count</strong> items in <strong>log file:</strong></p><hr>";
        echo LogPagSeguro::getHtml($count);
    }
}

NotificationListener::main();




    /* Informando as credenciais  */    
    $credentials = new PagSeguroAccountCredentials(      
        'info@webecard.net',       
        'A5A0C5F59A584911915F7235828CB57D'      
    );  
      
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
    //$status = $transaction->getStatus();  
    //echo $status->getValue(); // imprime um valor numérico, p.e. 3  
	
	/* objeto PagSeguroTransactionStatus */  
    //$status = $transaction->getStatus();  
    //echo $status->getTypeFromValue(); // imprime uma String, p.e. PAID  
	
	
	/* fluxos diferentes */  
	//$status = $transaction->getStatus();  
	
	if ( $status->getValue() == '1' ) { // 3 = PAID // 1 = WAITING_PAYMENT -> used to try and see if it approves no problem
	
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
	
date_default_timezone_set("Brazil/East");

if ($_SERVER['HTTP_HOST'] == "127.0.0.1") { 

		$link = mysqli_connect("127.0.0.1", "root", "", "aranha");
} 

elseif ($_SERVER['HTTP_HOST'] == "testing.webecard.net" || $_SERVER['HTTP_HOST'] == "www.testing.webecard.net") { 

		$link = mysqli_connect("localhost", "leolondo_leo", "35481176", "leolondo_tes_aranha"); 
} 

elseif ($_SERVER['HTTP_HOST'] == "webecard.net" || $_SERVER['HTTP_HOST'] == "www.webecard.net") { 

		$link = mysqli_connect("localhost", "leolondo_leo", "35481176", "leolondo_aranha");
}




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

