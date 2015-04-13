<div id='ecards_title'>
<h1>Login</h1>
</div>

<div id='faux'>

	<div id='ecards_msg'>
	<?php
	if ($this->session->userdata('ecards_msg')) { echo $this->session->userdata('ecards_msg'); $this->session->unset_userdata('ecards_msg'); }
	?>
	</div>

	<div id='mylogin'>
	<?php
	
	//echo date('l jS \of F Y h:i:s A'); 
	
	echo form_open('main/login_validation');
	
	echo validation_errors();
	 
?>	
		<table class='t_signup'>
		<tr>
		<td> Nome de Usuário: </td> <td> <?php echo form_input('user_name', $this->input->post('user_name')); ?> </td>
		</tr>
		<tr>
		<td> Senha: </td> <td> <?php echo form_password('pw'); ?> </td>
		</tr>
		<tr>
		<td>  </td> <td> <?php echo form_submit('login_submit', 'Login'); ?> </td>
		</tr>
		</table>

<?php		
	echo form_close();
	
	?>	

	<a href='<?php echo base_url(); ?>index.php/main/signup_basic'> <img src="<?php echo base_url(); ?>assets/images/signup_sml.png" ></a> </p>
<br>
	<a href='<?php echo base_url() . "index.php/main/recup_senha"; ?>'>Esqueci a Senha</a>
<br>
</div>
</div>
