<html lang="en">
<head>
	<meta charset="utf-8">
<title>Rede WEBECARD.net</title>
</head>
<body>
<?php
/*
 * ***********************************************************************
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
 * ***********************************************************************
 */

require_once "source/PagSeguroLibrary/PagSeguroLibrary.php";

/**
 * Class with a main method to illustrate the usage of the domain class PagSeguroPaymentRequest
 */
class CreatePaymentRequest
{

    public static function main()
    {
		$r = $_GET['r'];
					
		include '../global.php';
		
		$result = mysqli_query($link, "	SELECT creditos.valor, users.user_name FROM creditos 
		
										LEFT JOIN users ON creditos.user_id = users.user_id
			
										WHERE creditos.referencia = '$r' ");
											
		$row = mysqli_fetch_row($result);

		$d = $row[1] . " Crédito WEBECARD.net";
		$v = $row[0];

		// Instantiate a new payment request
        $paymentRequest = new PagSeguroPaymentRequest();

        // Sets the currency
        $paymentRequest->setCurrency("BRL");

        // Add an item for this payment request
        $paymentRequest->addItem('0001', $d, 1, $v);

        // Sets a reference code for this payment request, it is useful to identify this payment
        // in future notifications.
        $paymentRequest->setReference($r);


        // Sets the url used by PagSeguro for redirect user after ends checkout process
        $paymentRequest->setRedirectUrl("http://www.testing.webecard.net/assets/admin/ps/obrigado.php");


        try {

            $credentials = new PagSeguroAccountCredentials("info@webecard.net",
                "A5A0C5F59A584911915F7235828CB57D");

            // Register this payment request in PagSeguro, to obtain the checkout code
            $onlyCheckoutCode = true;
            $code = $paymentRequest->register($credentials, $onlyCheckoutCode);

            //self::printPaymentUrl($code);

            // Register this payment request in PagSeguro, to obtain the payment URL for redirect your customer.
            $url = $paymentRequest->register($credentials);

            self::printPaymentUrl($url);
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function printPaymentUrl($url)
    {
        if ($url) {
		
			// get code update table where referencia - r
			//include '../../../global.php';
			//if (!mysqli_query($link, "
			//	UPDATE creditos SET code_ps = '$code' WHERE referencia = '$r' ")) echo "erro db...";
		

		
			echo "<meta http-equiv='refresh' content='1; url=$url'>"; // vai redirecionar em 7 segundos

            echo "<h2>Criando requisi&ccedil;&atilde;o de pagamento, você será redirecionado.</h2>";
            //echo "<p>URL do pagamento: <strong>$url</strong></p>";
            //echo "<p><a title=\"URL do pagamento\" href=\"$url\">Ir para URL do pagamento.</a></p>";
        }
    }
}

CreatePaymentRequest::main();
?>
</body>
</html>
