<?php
require_once "source/PagSeguroLibrary/PagSeguroLibrary.php";

    /* Informando as credenciais  */    
    $credentials = new PagSeguroAccountCredentials(     
        'info@webecard.net',       
        'A5A0C5F59A584911915F7235828CB57D'      
    );  
    /* Código identificador da transação  */    
    $transaction_id = '018D23B6-D873-4EA6-B571-6EFC6ED3DFF2';  
      
    /*  
        Realizando uma consulta de transação a partir do código identificador  
        para obter o objeto PagSeguroTransaction 
    */   
    $transaction = PagSeguroTransactionSearchService::searchByCode(  
        $credentials,  
        $transaction_id  
    );  


    /* Imprime o código do status da transação */  
    echo $transaction->getStatus()->getValue() . '<br>';  
	                
	// teste
	echo "Postal code Teste: " . $transaction->getShipping()->getAddress()->getPostalCode() . '<br>';

	// teste
	echo "Código da Transação: " . $transaction->getCode() . '<br>';

	
?>