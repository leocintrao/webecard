<div id='menu2'>
<div class="underlinemenu">

<ul>
<li> <a>Saldo: <?php echo number_format($meu_saldo, 2, ',', '.'); ?></a></li>
<li> <a href="<?php echo base_url(); ?>index.php/main/meu_fin/controle_pontos" class='<?php if(isset($fin_selected1)) echo $fin_selected1; ?>'>Controle Pontos</a> </li>
<li> <a href="<?php echo base_url(); ?>index.php/main/meu_fin/rendimentos" class='<?php if(isset($fin_selected2)) echo $fin_selected2; ?>'>Rendimentos</a> </li>
<li> <a href="<?php echo base_url(); ?>index.php/main/creditos" class='<?php if(isset($fin_selected3)) echo $fin_selected3; ?>'>Recarga</a> </li>
<li> <a href="<?php echo base_url(); ?>index.php/main/saques" class='<?php if(isset($fin_selected5)) echo $fin_selected5; ?>'>Saque</a> </li>
<li> <a href="<?php echo base_url(); ?>index.php/main/dados" class='<?php if(isset($fin_selected4)) echo $fin_selected4; ?>' style='background:white; color:black;'>Meus Dados</a> </li>
</ul>
</div>
</div>
