<?php
			echo form_open('pages/cpf_validation');
			
			echo validation_errors();
			
			echo "<p> CPF ";
			echo form_input('cpf');
			echo "</p>";
			echo "<p>";
			echo form_submit('cpf_submit', 'Buscar');
			echo "</p>";
			
			echo form_close();
?>hello world 2