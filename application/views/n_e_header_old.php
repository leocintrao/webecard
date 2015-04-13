<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<title>Rede WEBECARD.net</title>
<meta name="description" content="A WEBECARD.net é um site promocional que realiza a venda de cartões virtuais, os E-Cards. Eles possuem diversos designs e cada um possui um código promocional que permite concorrer a 2 Sorteios, além de outros recursos extras." />
<meta name="keywords" content="Promoções, Sorteios" />
<meta name="robots" content="index, follow" />
<!-- META Tags generated by http://www.submitexpress.com/meta-tags-generator.html -->

<script src="<?php echo asset_url();?>js/jquery-1.10.1.min.js"></script>
<script src="<?php echo asset_url();?>js/highlight.pack.js"></script>
<script src="<?php echo asset_url();?>js/jquery.checkboxes.min.js"></script>

<script src="<?php echo asset_url();?>js/jquery.tipsy.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/tipsy.css" />
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/tipsy-docs.css" />


<script type="text/javascript"> 
jQuery(function($) {
    $('#table5').checkboxes('max', 5);
});

$(function(){
    $( ".class_chk" ).on( "click", function(){
        if($(this).is(':checked'))
            $(this).parent().css({"background-color":"#cd0000", "color":"#FFF"});
        else
            $(this).parent().css({"background-color":"#FFF", "color":"#000"});
    });
});

function reloadPage()
  {
  location.reload();
  }
  
  $(function() {
    $('#divu1').tipsy({gravity: 'ne'});
    $('#divu2').tipsy({gravity: 'ne'});
    $('#divu3').tipsy({gravity: 'ne'});
    $('#divu4').tipsy({gravity: 'ne'});
  });
</script>
</head>
<body>

   <!-- Begin Wrapper -->
   <div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
			
			<div id="logo">
			<!-- WEB<span style='color:orange;'>ECARD</span><span class='logorede'>.net</span> <br> -->
			<a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt='WEBECARD.net'></a>
			</div>
			
			<div id="logged">
			<?php 					//print_r($this->session->all_userdata()); echo "<br>";
			
				if ($this->session->userdata('is_logged_in') == 1) {
				
					echo "Olá: <strong>";
					echo ucfirst($this->session->userdata('log_user_name'));
					echo "</strong> / ";
					echo "<a href='" . base_url() . "index.php/main/logout'>Sair</a>";
				} else {
					echo "<a href='" . base_url() . "index.php/main/login'>Entrar</a>";
					echo " / ";
					echo "<a href='" . base_url() . "index.php/main/signup_basic'>Criar Conta</a>";				
				}			
			?>
			</div>
			
			<div id="lang">
			<a href='#'><img src="<?php echo base_url(); ?>assets/images/uk_cru.png" alt='English' width='25' ></a>
			<a href='#'><img src="<?php echo base_url(); ?>assets/images/br_cru.png" alt='Português' width='25' ></a>		
			</div>
			
			<div id="menu3">
			<div class="underlinemenu">
			<ul>
			<li><a href="<?php echo base_url(); ?>index.php/main/company" class='<?php if(isset($s_selected4)) echo $s_selected4; ?>'>A WEBECARD.net</a></li> 
			<li><a href="<?php echo base_url(); ?>index.php/main/funciona" class='<?php if(isset($s_selected2)) echo $s_selected2; ?>'>Como Usar</a></li> 
			<li><a href="<?php echo base_url(); ?>index.php/main/perg_resp" class='<?php if(isset($s_selected1)) echo $s_selected1; ?>'>Perguntas & Respostas</a></li> 
			</ul>
			</div>
			</div>

			
			<div id="menu1">
			<div class="underlinemenu">
			<ul>
			<li><a href="<?php echo base_url(); ?>" class='<?php if(isset($selected1)) echo $selected1; ?>'>Home</a></li> 
			<li><a href="<?php echo base_url(); ?>index.php/main/meus_ecards" class='<?php if(isset($selected2)) echo $selected2; ?>'>Meus E-Cards</a></li> 
			<li><a href="<?php echo base_url(); ?>index.php/main/meu_fin" class='<?php if(isset($selected3)) echo $selected3; ?>'>Meus Pontos</a></li> 
			<li><a href="<?php echo base_url(); ?>index.php/main/minha_rede" class='<?php if(isset($selected4)) echo $selected4; ?>'>Minha Rede</a></li> 
			<li><a href="<?php echo base_url(); ?>index.php/main/ecardscheck" class='<?php if(isset($selected5)) echo $selected5; ?>'>Checar E-cards</a></li> 
			</ul>
			</div>
			</div>
			 
		 </div>
		 <!-- End Header -->
	

