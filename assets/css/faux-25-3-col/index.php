<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<title>Faux Column CSS Layouts - 3 Column - faux-3-3-col</title>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>

   <!-- Begin Wrapper -->
   <div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
		 
			<div id="logo">
			WEBECARD<span class='logorede'> rede</span>
			</div>
			
			<div id="logged">
			Login / Logout
			</div>
			
			<div id="menu1">
			<div class="underlinemenu">
			<ul>
			<li><a href="<?php //echo base_url(); ?>">Home</a></li> 
			<li><a href="<?php //echo base_url(); ?>index.php/main/meus_ecards">Meus E-Cards</a></li> 
			<li><a href="<?php //echo base_url(); ?>index.php/main/meu_fin">Meu Financeiro</a></li> 
			<li><a href="<?php //echo base_url(); ?>index.php/main/minha_rede">Minha Rede</a></li> 
			<li><a href="<?php //echo base_url(); ?>index.php/main/ecardscheck">Checar E-cards</a></li> 
			</ul>
			</div>
			</div>
			 
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Navigation -->
         <div id="flash">
		 
		       This is the Flash		 
			   
		 </div>
		 <!-- End Navigation -->
		 
         <!-- Begin Faux Columns -->
		 <div id="faux">
		 
		       <!-- Begin Left Column -->
		       <div id="leftcolumn">
		 
		             
		 
		       </div>
		       <!-- End Left Column -->
		 
		       <!-- Begin Content Column -->
		       <div id="content">
		       
	                 <a href="#">Download this CSS Layout</a>
					 
					 <br /><br />
					 
					 <h1>Faux Column CSS Layouts</h1>	 
					 
				     <p>
					 
					       These 2 Column Faux CSS Layouts use a background image to make it look like the 
						   left and right columns are equal in height and independent of each other.
						   
						   <br />
						   <br />
						   
						   Things couldn't be further from the truth. I created a parent column called faux
						   and vertically tiled the image, that contained both the left and right child columns. 
						   I then vertically tiled the faux background image and viola. 
						   
						   <br />
						   <br />
						   
					       I first found about this method from the <a href="http://www.alistapart.com">
				           alistapart site</a> by a guy called <a href="http://simplebits.com/">Dan Cederholm</a>					 
						   
					 </p>
		       			  
		       </div>
		       <!-- End Content Column -->
			   
			   
			   
			   <!-- Begin Right Column -->
		       <div id="rightcolumn">
		 
		             
							
							
		       </div>
		       <!-- End Right Column -->

         </div>	   
         <!-- End Faux Columns --> 

         <!-- Begin Footer -->
         <div id="footer">
		       
               This is the Footer	333	

         </div>
		 <!-- End Footer -->
		 
   </div>
   <!-- End Wrapper -->
</body>
</html>
