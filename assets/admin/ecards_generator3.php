<?php 
	function gera_id_ecard() {

		$id_ecard_rand = "";

		for ($leo = 0; $leo < 12; $leo ++) {

			$ecard_random = mt_rand(0,9);

			$id_ecard_rand .= $ecard_random;

		}
		return $id_ecard_rand;
	
	}
	
	
	function gera_array($qt) {

		$count = 1;

		$heap = range(1, 50);

		shuffle($heap);

		foreach (array_chunk($heap, 5) as $block) {

			sort($block);

			$ecard_rand[] = join(",", $block);

			if ($count == $qt) { break; }

			$count = $count + 1;
		}

		return $ecard_rand;
	}
		// confirmar depois dupes group by id_ecard ***
?>
INSERT INTO ecards (`id_ecard`, `ecard`, `sorteio_data`, `user_id`, `sentence`, `design`, `distribuicao`, `status`, `atual`)
VALUES 
<br>
<!-- a1b1 -->

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c1', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c1d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c1d2', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c1d3', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c1d4', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c1d5', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c2d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b1c2d2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b1c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b1c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b1c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b1c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b1c2d5', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b1c2d5', '1', '2', '', 'a', 's'), <br>

<!-- a1b2 -->

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c1', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c1d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c1d2', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c1d3', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c1d4', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c1d5', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c2d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b2c2d2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b2c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b2c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b2c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b2c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b2c2d5', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b2c2d5', '1', '2', '', 'a', 's'), <br>

<!-- a1b3 -->

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c1', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c1d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c1d2', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c1d3', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c1d4', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c1d5', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c2d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b3c2d2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b3c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b3c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b3c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b3c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b3c2d5', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b3c2d5', '1', '2', '', 'a', 's'), <br>

<!-- a1b4 -->

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c1', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c1d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c1d2', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c1d3', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c1d4', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c1d5', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c2d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b4c2d2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b4c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b4c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b4c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b4c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b4c2d5', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b4c2d5', '1', '2', '', 'a', 's'), <br>

<!-- a1b5 -->

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c1', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c1d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c1d2', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c1d3', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c1d4', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c1d5', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c2d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b5c2d2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b5c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b5c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b5c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b5c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b5c2d5', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b5c2d5', '1', '2', '', 'a', 's'), <br>

<!-- a1b6 -->

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c1', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c1d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c1d2', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c1d3', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c1d4', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c1d5', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c2d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b6c2d2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b6c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b6c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b6c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b6c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b6c2d5', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b6c2d5', '1', '2', '', 'a', 's'), <br>

<!-- a1b7 -->

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c1', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c1d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c1d2', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c1d3', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c1d4', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c1d5', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c2d1', '1', '2', '', 't', ''), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-03-28', 'a1b7c2d2', '1', '2', '', 't', ''), <br>

('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b7c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b7c2d3', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b7c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b7c2d4', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-11', 'a1b7c2d5', '1', '2', '', 'a', 's'), <br>
('<?php echo gera_id_ecard(); ?>', '<?php echo gera_array(1)[0]; ?>', '2014-04-18', 'a1b7c2d5', '1', '2', '', 'a', 's')
