<div id='ecards_title'>
<h1>Todos E-Cards Participantes da Semana</h1>
</div>

<div id='faux'>


	<div id='ecards_msg'>
	<h3>
	<?php
	if ($this->session->userdata('msg')) { echo $this->session->userdata('msg'); $this->session->unset_userdata('msg'); }
	?>
	</h3>
	</div>
	
	<div id='ecards_pdf'>
	
	
	<?php
	if (!empty($info)) {
	
		foreach((array)$info as $data) {
		
			$sorteio_data = "<strong>" . $data->sorteio_data . "</strong>";
			break;
		} 	
	
	
		$content = " <table id='tb_pdf' > <tr> <td colspan='5'>Sorteio $sorteio_data</td></tr><tr>";
						
		$content_p = " <table id='tb_pdf' style='margin:0 auto; border:0; text-align:center; 
						font-family:Tahoma, Geneva, sans-serif;color:gray; font-size:12px;' > <tr>
						<td colspan='5'>Sorteio $sorteio_data</td></tr><tr>";
						
		$count = 0;
	
		foreach((array)$info as $data) {
		
			if ($count == 5) { 
			
				$content .= "</tr><tr>";
				$content_p .= "</tr><tr>";
			}
		
			if (isset($data->ecard)) {
			
				$content .= "<td>" . $data->ecard . "</td>";
				$content_p .= "<td style='padding:10px;padding-top:5px;padding-bottom:5px; border:1px solid lightgray;'>" . $data->ecard . "</td>";
			}
			
			if ($count == 5) $count = 0;
			
			$count++;

			//echo $count . " < count <br>";
			
			//echo "<div class='cl_ecards_pdf'>" . $data->ecard . "</div>";
			//echo $data->ecard;
			//echo "<br>";
		
		} 
		
		$content .= " </tr> </table> ";
		$content_p .= " </tr> </table> ";
		
		?>
		<div id='salvar'>
		<form action="<?php echo base_url(); ?>index.php/main/savefile" method="post">
        <input type="hidden" name="content" value="<?php echo htmlspecialchars($content_p); ?>">
        <input type="submit" value="Salvar em Arquivo" />
        </form>
		</div>
		<?php
				echo $content;

	
	} else echo "Nenhum E-Card participante até o momento.";
	
	
	?>
	</div>
</div>