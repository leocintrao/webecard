<?php
//error_reporting(0);
//error_reporting(E_ALL ^ E_NOTICE);
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


						
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

			
			
?>