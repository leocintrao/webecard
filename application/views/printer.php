<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<title>Imprimir E-Cards</title>


<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/print.css" />



</head>
<body>


   <!-- Begin Wrapper -->
   <div id="wrapper">
   

<div id="ecards_title">
	<p style="display:inline; float:left; padding:5px;">
	<a href="<?php echo base_url(); ?>index.php/main/meus_ecards/">VOLTAR</a></p>
	
	<h1 style="display:inline;" >Área de Impressão</h1>
	

	<p style="display:inline; float:right; padding:5px;">
	<a href="javascript:window.print()">IMPRIMIR</a> | 
	<a href="<?php echo base_url(); ?>index.php/main/print_area_clear">LIMPAR TUDO</a>
	</p>
</div>

<div id="faux">
	
<?php
		$p_ecards = $this->session->userdata('print_area');
		
		//echo count($p_ecards['id_ecard']) . " < count <br>";
		for ($i = 0; $i < count($p_ecards['id_ecard']); $i ++) {			

?>
<div id='ecard_left' >
	<img src="<?php echo base_url() . "assets/images/ecard" . $p_ecards['design'][$i] . ".png"; ?>" width="400" >
<div id='caption' >
	<img src="<?php echo base_url() . "assets/images/cap.jpg"; ?>" >
</div>

</div>

	<div id='ecards_status'>
	<p><span class='status_color'>Sorteio Data: </span><?php echo $p_ecards['data'][$i]; ?></p>
	<p><span class='status_color'>E-Card: </span><?php echo $p_ecards['ecard'][$i]; ?></p>
	<p><span class='status_color'>ID: </span><?php echo $p_ecards['id_ecard'][$i]; ?></p>
	<p><span class='status_color'>Info: </span><?php echo $p_ecards['info'][$i]; ?> </p>
	</div>


<?php }  ?>






	

</div>
        
		 
   </div>
   <!-- End Wrapper -->

</body>
</html>

