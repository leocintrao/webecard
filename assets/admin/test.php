<?php 

$password = "223.113.798-44d";

if (strlen(preg_replace("/[^A-Za-z]/", "", $password)) == 0 && strlen(preg_replace("/[^0-9]/", "", $password)) == 11) echo "true";

//$password = preg_replace("/[^A-Za-z]/", "", $password);

//echo $password;
 /*
 if (preg_match('/^(?=[^\._]+[\._]?[^\._]+$)[\w\.]{5,25}$/', $cpf)) { echo "pass 1<br>";

	if (preg_match("/(?=[a-z]*[0-9])(?=[0-9]*[a-z])([a-z0-9-]+)/i",$cpf)) 
   echo "pass 2";
}
*/
//if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@_#]{6,25}$/', $password)) {

//if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@_#]{6,25}$/', $password)) {
  //  echo 'the password does not meet the requirements!';
//} else echo "yes";

/*
Between Start -> ^
And End -> $
of the string there has to be at least one number -> (?=.*\d)
and at least one letter -> (?=.*[A-Za-z])
and it has to be a number, a letter or one of the following: !@#$% -> [0-9A-Za-z!@#$%]
and there have to be 8-12 characters -> {8,12}
*/
?>