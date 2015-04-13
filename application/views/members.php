

<div id="container">
	<h1>Members</h1>

	<div id="body">
	
	<?php
	echo "<pre>";
	print_r($this->session->all_userdata());
	echo "</pre>";
	?>
	
	<a href='<?php echo base_url() . "index.php/main/logout"; ?>'>Logout</a>
	</div>

</div>
