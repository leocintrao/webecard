<div id='flash'>
      <!--  Outer wrapper for presentation only, this can be anything you like -->
      <div id="banner-fade">

        <!-- start Basic Jquery Slider -->
        <ul class="bjqs">
          <li><img src="<?php echo asset_url();?>images/<?php echo $_banner01; ?>.jpg" title=""></li>
          <li><img src="<?php echo asset_url();?>images/<?php echo $_banner02; ?>.jpg" title=""></li>
          <li><img src="<?php echo asset_url();?>images/<?php echo $_banner03; ?>.jpg" title=""></li>
        </ul>
        <!-- end Basic jQuery Slider -->

      </div>
      <!-- End outer wrapper -->

      <script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 150,
            width       : 922,
            responsive  : true
          });

        });
      </script>
</div>

<div id='faux'>

<div id='leftcolumn'>	
	<h3 class="ult_res_home"> <?php echo $_ult_res; ?></h3>
	<br>
	<?php echo $my_res; ?>
</div>



<div id='rightcolumn'>	

	<h3><a href='<?php echo base_url() . "index.php/main/resultados"; ?>'> <?php echo $_todos_res; ?></a> | 
	<a href='<?php echo base_url() . "index.php/main/ecards_sem"; ?>'> <?php echo $_ecards_sem; ?></a></h3>
	<br>
	<br>
	<h3><?php echo $_points_week; ?>.</h3>
	<br>
	<p><strong><span style="text-decoration:underline;"><?php $val_8 = $val2 * 8; echo number_format($val_8, 2, ',', '.'); ?></span></strong> <?php echo $_pontos; ?>.</p>
	<br>
<!--	<p> 1&#186; Prêmio: <?php //echo number_format($val1, 2, ',', '.'); ?> pontos. </p>
	<p> 2&#186; Prêmio: <?php //echo number_format($val2, 2, ',', '.'); ?> pontos. </p>
	<p> Rede de Diluição: <?php //echo number_format($val1, 2, ',', '.'); ?> pontos. </p>
-->
<br>
<br>
<br>
<br>
	<h3><?php echo $_mem_total; ?> </h3>
	<br>
	<p><strong><span style="text-decoration:underline;"><?php echo $tot_mem; ?></span></strong> <?php echo $_mem; ?>.</p>
	
</div>

</div>


