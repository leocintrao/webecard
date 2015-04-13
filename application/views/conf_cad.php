<div id='ecards_title'>
<h1>Confirmação de Cadastro</h1>
</div>

<div id='faux'>


	<div id='ecards_msg'>
	<h3>
	<?php
	if ($this->session->userdata('cad_msg')) { echo $this->session->userdata('cad_msg'); $this->session->unset_userdata('cad_msg'); }
	?>
	</h3>
	</div>

</div>