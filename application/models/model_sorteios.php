<?php



Class Model_sorteios Extends CI_Model {



	// sends $todos_val as array

	public function pontos_sem() {

		// localhost time difference

		if (date('D') == 'Fri' && date('H') < 19)  

			$next_friday = date('Y-m-d'); 
		else 
			$next_friday = date( "Y-m-d", strtotime("next Friday"));

		$query = $this->db->query("SELECT COUNT(sorteio_data) AS the_count FROM ecards WHERE sorteio_data = '$next_friday'");

		$row = $query->row();

		$pontos = $row->the_count * 5;

		$todos_val = $this->get_valores($pontos);

		return $todos_val;

	}

	

	public function get_valores($val_total) {

		$val1 = $val_total * 0.35;		$val2 = $val_total * 0.10;		$val_taxas = $val_total * 0.20;		

		$todos_val = array( 	'val1' => $val1,
								'val2' => $val2,
								'val_taxas' => $val_taxas
							);

		return $todos_val;
	}
	
	// Latest result of the promotion -English
	// Último resultado da promoção - Portugues

	public function ult_result_br() { 

		$my_res = "";

		$query = $this->db->query('SELECT * FROM prem_info	ORDER BY sorteio_data DESC LIMIT 1 ');

		foreach ($query->result_array() as $row)

		{

			unset($header);

			$todos_val = $this->get_valores($row['val_total']);



			$my_res .= "

					<h3>Sorteio " . date("d-m-Y", strtotime($row['sorteio_data'])) . "</h3><br><br>";

			

			$my_res .= "	<table class='t_home' bgcolor='#ededed' >

					<tr>

					<th> Resultado  </th>

					<th> Ganhadores 1&#186; Prem. </th>

					<th> Valor Prêmio </th>

					<th> Ganhadores 2&#186; Prem. </th>

					<th> Valor Prêmio </th>

					<th> Rede Diluição </th>

					<th> Valor Prêmio </th>

					</tr>

					<tr>

					<td> {$row['sorteio_result']} </td>

					<td> {$row['num_win_1']} </td>

					<td> " . number_format($todos_val['val1'], 2, ',','.') . " </td>

					<td> {$row['num_win_2']} </td>

					<td> " . number_format($todos_val['val2'], 2, ',','.') . " </td>

					<td> {$row['num_dilu']} </td>

					<td> " . number_format($todos_val['val1'], 2, ',','.') . " </td>

					</tr>

					</table>				

					";

			$query1 = $this->db->query("SELECT prem_sorteios.*, users.user_name FROM prem_sorteios
										INNER JOIN users ON prem_sorteios.id_winner = users.user_id
										WHERE sorteio_data = '{$row['sorteio_data']}'									
										ORDER BY sorteio_data DESC

			");

			$my_res .= "<br><h3>Ganhadores dos Sorteios</h3><br>";

			$my_res .= "<table class='t_home' >";



			foreach ($query1->result_array() as $row1) {

			

				if (!isset($header)) {

					$my_res .= "	<tr>

							<th> Usuário  </th>

							<th> 1&#186; ou 2&#186; Prem. </th>

							<th> Valor </th>

							<th> E-Card </th>

							<th> Pontuação </th>

							</tr>

							";

					$header = 1;

				}

					$my_res .= "	<tr>

							<td> {$row1['user_name']} </td>

							<td> {$row1['prim_ou_seg']} </td>

							<td> " . number_format($row1['valor'], 2, ',','.') . " </td>

							<td> {$row1['ecard']} </td>

							<td> {$row1['pontuacao']} </td>

							</tr>

							";

			}

			$my_res .= "</table>";

			$query1 = $this->db->query("SELECT prem_dilu.*, users.user_name FROM prem_dilu

										INNER JOIN users ON prem_dilu.id_winner = users.user_id

									WHERE sorteio_data = '{$row['sorteio_data']}'		
									AND missed = ''

									ORDER BY sorteio_data DESC	

			");

		

			$my_res .= "<br><h3>Ganhadores da Rede de Diluição</h3><br>";

			$my_res .= "<table class='t_home' >";



			foreach ($query1->result_array() as $row1) {

			

				if (!isset($header1)) {

					$my_res .= "	<tr>

							<th> Nome  </th>

							<th> Valor </th>

							</tr>

							";

					$header1 = 1;

				}

					$my_res .= "	<tr>

							<td> {$row1['user_name']} </td>

							<td> " . number_format($row1['valor'], 2, ',','.') . " </td>

							</tr>

							";

			}

			$my_res .= "</table>";	

			

		} // end for

	

		return $data = array('my_res' => $my_res );

	

	}

	// Último resultado da promoção - English

	public function ult_result_en() {

		$my_res = "";

		$query = $this->db->query('SELECT * FROM prem_info	ORDER BY sorteio_data DESC LIMIT 1 ');

		foreach ($query->result_array() as $row)

		{

			unset($header);

			$todos_val = $this->get_valores($row['val_total']);



			$my_res .= "

					<h3>Draw Date " . date("d-m-Y", strtotime($row['sorteio_data'])) . "</h3><br><br>";

			

			$my_res .= "	<table class='t_home' bgcolor='#ededed' >

					<tr>

					<th> Result  </th>

					<th> Winners 1&#186; Prize </th>

					<th> Prize Value </th>

					<th> Winners 2&#186; Prize </th>

					<th> Prize Value </th>

					<th> Network Share </th>

					<th> Prize Value </th>

					</tr>

					<tr>

					<td> {$row['sorteio_result']} </td>

					<td> {$row['num_win_1']} </td>

					<td> " . number_format($todos_val['val1'], 2, ',','.') . " </td>

					<td> {$row['num_win_2']} </td>

					<td> " . number_format($todos_val['val2'], 2, ',','.') . " </td>

					<td> {$row['num_dilu']} </td>

					<td> " . number_format($todos_val['val1'], 2, ',','.') . " </td>

					</tr>

					</table>				

					";

			$query1 = $this->db->query("SELECT prem_sorteios.*, users.user_name FROM prem_sorteios
										INNER JOIN users ON prem_sorteios.id_winner = users.user_id
										WHERE sorteio_data = '{$row['sorteio_data']}'									
										ORDER BY sorteio_data DESC

			");

			$my_res .= "<br><h3>Draw Winners</h3><br>";

			$my_res .= "<table class='t_home' >";



			foreach ($query1->result_array() as $row1) {

			

				if (!isset($header)) {

					$my_res .= "	<tr>

							<th> User  </th>

							<th> 1&#186; or 2&#186; Prize </th>

							<th> Value </th>

							<th> E-Card </th>

							<th> Points </th>

							</tr>

							";

					$header = 1;

				}

					$my_res .= "	<tr>

							<td> {$row1['user_name']} </td>

							<td> {$row1['prim_ou_seg']} </td>

							<td> " . number_format($row1['valor'], 2, ',','.') . " </td>

							<td> {$row1['ecard']} </td>

							<td> {$row1['pontuacao']} </td>

							</tr>

							";

			}

			$my_res .= "</table>";

			$query1 = $this->db->query("SELECT prem_dilu.*, users.user_name FROM prem_dilu

										INNER JOIN users ON prem_dilu.id_winner = users.user_id

									WHERE sorteio_data = '{$row['sorteio_data']}'		
									AND missed = ''

									ORDER BY sorteio_data DESC	

			");

		

			$my_res .= "<br><h3>Network Share Winners</h3><br>";

			$my_res .= "<table class='t_home' >";



			foreach ($query1->result_array() as $row1) {

			

				if (!isset($header1)) {

					$my_res .= "	<tr>

							<th> Name  </th>

							<th> Value </th>

							</tr>

							";

					$header1 = 1;

				}

					$my_res .= "	<tr>

							<td> {$row1['user_name']} </td>

							<td> " . number_format($row1['valor'], 2, ',','.') . " </td>

							</tr>

							";

			}

			$my_res .= "</table>";	

			

		} // end for

	

		return $data = array('my_res' => $my_res );

	

	}

	// Display total numero de membros
	public function total_membros() {

		$query = $this->db->query("SELECT COUNT(user_name) AS the_count FROM users WHERE status = '' ");

		$row = $query->row();

		return $data = array('tot_mem' => $row->the_count);	
	}


	public function get_stuff($a) {

		$user_id = $this->session->userdata('log_user_id');

		if ($a == 'distribuicao') {

								// UNION ALL para trazer = f with atual = '' p/ confirmacao recebido

			$query = $this->db->query("	SELECT ecards.*, users.user_name FROM ecards 
			
											LEFT JOIN users ON ecards.user_id = users.user_id
									
											WHERE 

											ecards.sorteio_data = '0000-00-00'

											AND (ecards.status = 'n' OR ecards.status = 's' OR ecards.status = 'd')

											AND ecards.atual = 's'

											AND ecards.distribuicao = '$user_id'

											UNION ALL

											SELECT ecards.*, users.user_name FROM ecards 
			
											LEFT JOIN users ON ecards.user_id = users.user_id
									
											WHERE 

											ecards.sorteio_data = '0000-00-00'

											AND ecards.status = 'f'

											AND ecards.atual = ''

											AND ecards.distribuicao = '$user_id'	");
		}

		elseif ($a == 'ativos') {

			$query = $this->db->query("	SELECT ecards.*, users.user_name FROM ecards 
			
									LEFT JOIN users ON ecards.distribuicao = users.user_id
											
									WHERE 

									(ecards.status = 'u' OR ecards.status = 'a' OR ecards.status = 'e' OR ecards.status = 'd')

									AND ecards.atual = 's'

									AND ecards.user_id = '$user_id' 

									ORDER BY ecards.sorteio_data ASC ");	
		}
/*
		elseif ($a == 'estacionados') {

			$query = $this->db->query(" SELECT * FROM ecards WHERE 

										sorteio_data = '0000-00-00' AND

										(status = 'e' OR status = 'd')

										AND atual = 's'

										AND user_id = '$user_id' 

										ORDER BY date_added ASC ");

		}

		elseif ($a == 'criados') {

			$query = $this->db->query(" SELECT * FROM ecards WHERE 

										status = 'c' 

										AND atual = 's'

										AND user_id = '$user_id' 

										ORDER BY date_added ASC ");
		}
*/
		elseif ($a == 'terminados') {

			$query = $this->db->query(" SELECT * FROM ecards WHERE 

										(status = 'm' OR status = 'w' OR status = 'y' OR status = 't')

										AND user_id = '$user_id' 

										ORDER BY sorteio_data DESC ");
		}

		return $query->result_array();
	}

	
	public function get_dates($i_date) {

//$i_date = 1;

		// puxa as 12 sextas-feiras iniciando da 1 proxima ou 2 proxima.

		$options = '';

			// 12 = 12 sextas-feiras

		for($i_date; $i_date < 12;$i_date ++) {

		

			$data = date( "Y-m-d", strtotime("next Friday" . '+' . $i_date . ' week'));

			$data2 = date( "d/m/Y", strtotime("next Friday" . '+' . $i_date . ' week'));

		

			$options .= "

			<option value='" . $data . "'> " . $data2 . " </option>

			";

		}

		return $options;	

	}



	public function get_time($tempo) {

		

		// #tempo é igual uma determinada data e hora.

		// #days retorna o tempo em dias que falta ate chegar essa determinada data e hora.

		// em config esta Brazil #date_default_timezone_set("Brazil/East"); //America/Sao_Paulo tb ok.

		

		//$date = strtotime("next Friday 19:00:00"); //Converted to a PHP date (a second count)

		$date = strtotime($tempo);



		//Calculate difference

		$diff = $date-time();//time returns current time in seconds

		$days = floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)

		//$hours = round(($diff-$days*60*60*24)/(60*60));



		//Report

		//echo "$days days $hours hours remain<br />";

		

		return $days;

	}

	

	public function gera_array($qt) {

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


	public function add_new_ecard($user_id, $ecard, $new_id_ecard, $new_sentence, $new_design, $distribuicao) {

		$status = 'c';

		if ($distribuicao) { $distribuicao = $user_id; $user_id = 0; $status = 'n'; }
		
		// se nao distribuicao, nao criar caso nao haja credito (mudanca de logica)
		else {

		$chk_saldo = $this->get_saldo();
		
			if ($chk_saldo < 10) {
			
				$data = array( 'ecards_msg' => 'Saldo Insuficiente.' );
				$this->session->set_userdata($data);
				return false;
				}
		}

		// adicionado seguranca de double id_ecard...
		$this->db->where('id_ecard',$new_id_ecard);
		$query = $this->db->get('ecards');
		
		if ($query->num_rows() > 0) {
			
			$data = array( 'ecards_msg' => 'E-Card duplicado, gere novamente por favor.' );
			$this->session->set_userdata($data);
			return false;
		}
		
		else { 
		
			$data = array(
							'id_ecard' => $new_id_ecard,
							'ecard' => $ecard,
							'user_id' => $user_id,
							'sentence' => $new_sentence,
							'design' => $new_design,
							'distribuicao' => $distribuicao,
							'status' => $status,
							'atual' => 's'
			);

			$query = $this->db->insert('ecards', $data);

			if ($query) return true;
			
			else {
				$data = array( 'ecards_msg' => 'Falha na função add_new_ecard.' );
				$this->session->set_userdata($data);
				return false;

			}
		
		}

	}

									// Meu c/e ou Dist. n/s
	public function conf_val_id_ecard($id_ecard,$tipo1,$tipo2) {

		$user_id = $this->session->userdata('log_user_id');

		$query = $this->db->query(" SELECT * FROM ecards WHERE 
									sorteio_data = '0000-00-00'
									AND status = '$tipo1' AND atual = 's' 
									AND (user_id = '$user_id' OR distribuicao = '$user_id') 
									AND id_ecard = '$id_ecard'  ");
		$row = $query->row();

		if ($query->num_rows() == 1) {

			$this->db->select('saldo');
			$this->db->where('user_id', $user_id);
			$this->db->from('creditos');
			$this->db->order_by('id', 'desc');
			$this->db->limit('1');

			$query = $this->db->get();
			
			$row = $query->row();

			$this->load->model('model_users');

			if (isset($row->saldo)) $q_saldo = $row->saldo; else $q_saldo = 0;

			if ($q_saldo < 10) {

				$data = array( 'ecards_msg' => 'Saldo Insuficiente.' );
				$this->session->set_userdata($data);

				return false;

			} elseif (!$this->model_users->muda_status($id_ecard,$tipo2,'')) {

				$data = array( 'ecards_msg' => 'Erro ao validar E-Card.' );
				$this->session->set_userdata($data);

				return false;

			} elseif (!$this->debita_ecard($user_id,$row->saldo)) {

				$data = array( 'ecards_msg' => 'Erro ao debitar.' );
				$this->session->set_userdata($data);

				return false;

			} else return true;


		} else {

			$data = array( 'ecards_msg' => 'E-Card não encontrado, tente novamente.' );
			$this->session->set_userdata($data);

			return false;

		}

	}

	

	

	public function _debita_ecard($user_id,$saldo) {

		$saldo = $saldo - 10; 		$tipo_cred = "e";		$valor = 10;

		$data = array(	'user_id' => $user_id,

						'tipo_cred' => $tipo_cred,

						'valor' => $valor,

						'saldo' => $saldo	);

		$query = $this->db->insert('creditos', $data);

		if ($query) return true;

	}

	
	// ARRECADAÇÃO - adiciona R$1,00 para a conta Imperador
	
	public function debita_ecard($user_id,$saldo) {

		$saldo = $saldo - 10; 		$tipo_cred = "e";		$valor = 10;

		$data = array(	'user_id' => $user_id,

						'tipo_cred' => $tipo_cred,

						'valor' => $valor,

						'saldo' => $saldo	);

		$query = $this->db->insert('creditos', $data);
		
		// checa se Imperador => arrecadacao = 's'
		
		//$imp = substr($this->session->userdata('log_user_id'), 2, 4);
		
		// get imperador, perfect!	
		//$id_winner = 'aa11bc12c1d1d2d3';
		
		// gets all letters and put in array					
		preg_match_all('!\p{L}+!', $this->session->userdata('log_user_id'), $matches1);		
		// gets all numbers and put in array
		preg_match_all('!\d+!', $this->session->userdata('log_user_id'), $matches);
		
		$array = array_merge($matches1, $matches);		$imp = "a1" . $array[0][1] . $array[1][1];
	
		$this->db->where('user_id', $imp);
		$this->db->where('arrec', 's');
		$this->db->where('status', '');								
		$query2 = $this->db->get('users');								

		// se sim, adiciona R$1,00 real a conta Imperador
		// e possivelmente contabilizar para controle??
		
		if ($query2->num_rows() > 0) {
		
			// adiciona credito
			if (!$this->add_credits($imp,'j','1')) return false;	

			// adiciona prem_dilu
			if (!$this->add_prem_dilu($imp)) return false;	
			
			// envia email notificacao
			// get email if exists
			$this->db->select('email, email_tipo');
			$this->db->where('user_id', $imp);
			$this->db->where('status', '');
			$query3 = $this->db->get('users');
		
			if ($query3->num_rows() > 0) {

				$row = $query3->row();
				$email_tipo = $row->email_tipo;
				
				if ($email_tipo == "p" || $email_tipo == "r") {
				
					$email = $row->email;					
					
					$this->load->library('email', array('mailtype' => 'html'));
					$this->email->from('info@webecard.net', 'WEBECARD.net');
					$this->email->to($email);
					$this->email->subject('Arrecadação Rede WEBECARD.net');
					
					$message = "<p><img src='" . base_url() . "assets/images/logo.jpg' alt='Logomarce WEBECARD.net'></p><br>";
					$message .= "<h3>Arrecadação Rede WEBECARD.net</h3><br>";
					$message .= "<p>Parabéns, você ganhou 1.00 ponto pela sua Rede WEBECARD.net através de {$this->session->userdata('log_user_id')}</p>"; 
					$message .= "<p>Obrigado por fazer parte da Rede <a href='" . base_url() . "'> WEBECARD.net </a></p>";
				
					$this->email->message($message);
					$this->email->send();
				}
			}


			
		}

		if ($query) return true;

	}

	public function add_prem_dilu($imp) {
	
		$data_hj = date('Y-m-d');
		
		$data = array(	'sorteio_data' => $data_hj,
						'id_winner' => $imp,
						'rede' => $this->session->userdata('log_user_id'),
						'valor' => '1'
						);

		$query = $this->db->insert('prem_dilu', $data);
		
		if ($query) return true;

	}


	public function conf_rep_id_ecard($new_id_ecard) {

		$user_id = $this->session->userdata('log_user_id');

		$query = $this->db->query(" SELECT * FROM ecards WHERE 
									sorteio_data = '0000-00-00'
									AND status = 's' AND atual = 's' 
									AND distribuicao = '$user_id'
									AND id_ecard = '$new_id_ecard'  ");

		$row = $query->row();

		if ($query->num_rows() == 1) {

		return true;

		}

	}

	

	

	public function rep_cpf($new_id_ecard) {

		$user_id = $this->session->userdata('log_user_id');

		// ver se ja existe sendo filho da rede atual, se sim, adicionar ecard somente, se nao cadastrar e adicionar ecard.

		// pega todos

		$this->db->where('cpf', $this->input->post('cpf'));								
		$this->db->where('status', '');								
		$query = $this->db->get('users');	

		$row = $query->row();

		if ($query->num_rows() == 1) { $this->rep_username_cpf($new_id_ecard); return true; }
		
		else {

			$this->db->select('user_id');								
			$this->db->where('cpf', $this->input->post('cpf'));								
			$this->db->where('status', 'n');								
			$query = $this->db->get('users');								

			$novo_usuario = '';
			
			// tira o ultmio array

			foreach ($query->result_array() as $row) {

			//echo $row['user_id'] . " < user id row <br>";

				preg_match_all('!\p{L}+!', $row['user_id'], $matches1);
				array_pop($matches1[0]);

				preg_match_all('!\d+!', $row['user_id'], $matches);
				array_pop($matches[0]);

				$array = array_merge($matches1, $matches);

				$montado = "";

				for ($i = 0;$i < count($matches[0]);$i ++) {

					$montado .= $matches1[0][$i] . $matches[0][$i];

				}

				//echo $montado . " < - montado <br>";
				//echo $user_id . " < - user_id <br>";

				if ($montado == $user_id) { $novo_usuario = $row['user_id']; }

			}
			// ve se bate, se sim sim, se nao nao.

			$this->load->model('model_users');			

				//echo $novo_usuario . " <- novo_usuario";	 exit();					

			if (!$novo_usuario) {

				$novo_usuario = $this->model_users->novo_usuario($user_id);
				
				// hack cpf deixa soh numeros
				$cpf = $this->input->post('cpf');
				$cpf = preg_replace("/[^0-9]/", "", $cpf);


				$data = array(	'user_id' => $novo_usuario,
								'cpf' => $cpf,
								'status' => 'n'	);

				$this->db->insert('users', $data);

			}

			$this->model_users->muda_status($new_id_ecard,'d',''); 

			// update ecards add user_id
			$data = array(	'user_id' => $novo_usuario );

			$this->db->where('distribuicao', $user_id);
			$this->db->where('id_ecard', $new_id_ecard);
			$this->db->where('atual', 's');
			$this->db->update('ecards', $data);

			return true;
		}	

	}

	public function rep_username_cpf($new_id_ecard) {

		$user_id = $this->session->userdata('log_user_id');

		$this->db->select('user_id, user_name');
		$this->db->where('cpf', $this->input->post('cpf'));
		$query = $this->db->get('users');

		$row = $query->row();

		if ($query->num_rows() > 0) {

			$q_user_id = $row->user_id;

			$this->load->model('model_users');			

			$this->model_users->muda_status($new_id_ecard,'d',''); 
			
			
			// ja atualiza ecards se cpf ja cadastrado...
			
			// duplica em aceito tipo = f
			$this->model_users->muda_status($new_id_ecard,'f','');

			// duplica para 'e'
			$this->model_users->muda_status($new_id_ecard,'e','');

			
			
			// update ecards add user_id
			$data = array(	'user_id' => $q_user_id );

			$this->db->where('distribuicao', $user_id);
			$this->db->where('id_ecard', $new_id_ecard);
			$this->db->where('atual', 's');
			$this->db->update('ecards', $data);

			$data = array( 'ecards_msg2' => 'E-Card CPF repassado direto a usuário com sucesso.' );
			$this->session->set_userdata($data);

			return true;

		}

	}

	public function rep_username($new_id_ecard) {

		$user_id = $this->session->userdata('log_user_id');

		$this->db->select('user_id, user_name');
		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('users');

		$row = $query->row();

		if ($query->num_rows() > 0) {

			$q_user_id = $row->user_id;

			$this->load->model('model_users');			

			$this->model_users->muda_status($new_id_ecard,'d',''); 

			// update ecards add user_id
			$data = array(	'user_id' => $q_user_id );

			$this->db->where('distribuicao', $user_id);
			$this->db->where('id_ecard', $new_id_ecard);
			$this->db->where('atual', 's');
			$this->db->update('ecards', $data);

			return true;

		}

	}


	public function conf_add_id_ecard($id_ecard) {

		$user_id = $this->session->userdata('log_user_id');

		$query = $this->db->query(" SELECT * FROM ecards WHERE 
									status = 'e' 
									AND sorteio_data = '0000-00-00'
									AND atual = 's'
									AND user_id = '$user_id' 
									AND id_ecard = '$id_ecard'  ");
		$row = $query->row();

		if ($query->num_rows() == 1) {

		$data['sorteio_data'] = $row->sorteio_data;

		return $data;

		}
	}

	

	public function conf_alt_id_ecard($id_ecard) {

		$user_id = $this->session->userdata('log_user_id');

		$query = $this->db->query(" SELECT sorteio_data FROM ecards WHERE 
									status = 'a' 
									AND sorteio_data != '0000-00-00'
									AND atual = 's'
									AND user_id = '$user_id' 
									AND id_ecard = '$id_ecard' ");

		$row = $query->row();

		if ($query->num_rows() == 1) {

		$data['sorteio_data'] = $row->sorteio_data;

		return $data;

		}

	}

	

	

	public function do_add_date($date, $id_ecard, $add_date_true) {

	

		// muda status

		if ($add_date_true) { 			

			$this->load->model('model_users');			

			$this->model_users->muda_status($id_ecard,'a',$date); 

		}	

		

		$data = array( 'sorteio_data' => $date );	

		

		$this->db->where('id_ecard',$id_ecard);

		$this->db->where('atual','s');

		

		$query = $this->db->update('ecards', $data);



		if ($query) return true;		



	}

	
	
	public function count_creditos() {

		$this->db->where('user_id',$this->session->userdata('log_user_id'));
		$query = $this->db->get('creditos');
		return $query->num_rows();  
		
    }
	
	public function count_prem_dilu() {

		$this->db->where('id_winner',$this->session->userdata('log_user_id'));
		$query = $this->db->get('prem_dilu');
		return $query->num_rows();  
    }
   
   

	public function get_fin($a, $limit, $start) {

		$user_id = $this->session->userdata('log_user_id');

		if ($a == 'controle_pontos') {
		
			$this->db->select("DATE_FORMAT(data, ('%d/%m/%Y')) AS 'data', tipo_cred, valor, status, saldo");
			$this->db->where('user_id', $user_id);
			$this->db->order_by('id', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get('creditos');
			
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
			return false;
			
		}

		elseif ($a == 'rendimentos') {
					
			$this->db->select("DATE_FORMAT(prem_dilu.sorteio_data, ('%d/%m/%Y')) AS 'sorteio_data', prem_dilu.rede, prem_dilu.valor, prem_dilu.missed , users.user_name");
			$this->db->join('users', 'prem_dilu.rede = users.user_id', 'left');
			$this->db->where('prem_dilu.id_winner', $user_id);
			$this->db->order_by('prem_dilu.id', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get('prem_dilu');			
			
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
			return false;
		}
		//return $query->result_array();

	}


	public function add_credits($user_id,$tipo_cred,$valor) {

		// pega saldo	
		$this->db->select('saldo');

		$this->db->where('user_id', $user_id);

		$this->db->from('creditos');

		$this->db->order_by('id', 'desc');

		$query = $this->db->get();

		$row = $query->row(); 

		// se compra de credito, necessita aprovacao

		if (isset($row->saldo)) $saldo = $row->saldo; else $saldo = 0;
		
		if ($tipo_cred == 'd' || $tipo_cred == 'i') {			

			$status = 'n';
			
			if ($tipo_cred == 'i') $saldo = $saldo - $valor;

		} else {
					$saldo = $saldo + $valor; 
					$status = '';
		}

		// adiciona creditos
		$data = array(	'user_id' => $user_id,
						'tipo_cred' => $tipo_cred,
						'valor' => $valor,
						'status' => $status,
						'saldo' => $saldo,
						'referencia' => $this->session->userdata('referencia')
						);

		$query = $this->db->insert('creditos', $data);
		
		if ($query) return true;

	}







	public function get_minha_rede() {

		// gets all letters and put in array
		preg_match_all('!\p{L}+!', $this->session->userdata('log_user_id'), $matches1);

		preg_match_all('!\d+!', $this->session->userdata('log_user_id'), $matches);

		$array = array_merge($matches1, $matches);

		$temp = "";

		for ($i=0;$i<count($array[0]);$i++){

			$temp .= $array[0][$i] . $array[1][$i];

			if ($temp != $this->session->userdata('log_user_id')) {

			// query
			$this->db->select('user_name');
			$this->db->where('user_id', $temp); 
			$this->db->where('status', '');
			$query = $this->db->get('users');

			foreach ($query->result_array() as $row) {

				$redes[] = $temp;
				$user_names[] = $row['user_name'];
			}

			}

		}

		

		$this->db->select('user_id, user_name');

		$this->db->like('user_id', $this->session->userdata('log_user_id'), 'after'); 

		$this->db->where('status', '');

		$query = $this->db->get('users');


		foreach ($query->result_array() as $row) {

			$redes[] = $row['user_id'];

			//$rede[$row['user_name']] = $row['user_id'];

			$user_names[] = $row['user_name'];

		}
		
		$rede = array($redes,$user_names);

		return $rede;

	}



	public function get_ecard($id_ecard) {

	

		$this->db->where('id_ecard', $id_ecard);

		$this->db->where('atual', 's');

		//$this->db->where('status', 'e');

		//$this->db->where('sorteio_data', '0000-00-00');

		$query = $this->db->get('ecards');

		

		$row = $query->row();

		

		$data['ecard'] = $row->ecard;

		$data['id_ecard'] = $row->id_ecard;

		$data['sorteio_data'] = $row->sorteio_data;

		$data['design'] = $row->design;

		$data['sentence'] = $row->sentence;

		

		return $data;

	

	}
	

	public function siglas($sigla) {

		switch($sigla) {

			case "t": $sigla = "Terminado"; break;

			case "w": $sigla = "<strong>Vencedor 1&#186; Prêmio</strong>"; break;

			case "y": $sigla = "<strong>Vencedor 2&#186; Prêmio</strong>"; break;


			case "a": $sigla = "Rendimento Rede"; break;

			case "b": $sigla = "Sorteio 1&#186; Prêmio"; break;

			case "c": $sigla = "Sorteio 2&#186; Prêmio"; break;

			case "m": $sigla = "Acumulado"; break;

			case "d": $sigla = "Recarga"; break;
			case "i": $sigla = "Pedido de Saque"; break;

			case "p": $sigla = "Crédito Aprovado"; break;

			case "e": $sigla = "Validação E-Card"; break;

			case "f": $sigla = "Saque"; break;

			case "g": $sigla = "Taxa"; break;

			case "n": $sigla = "Pendente"; break;
			
			case "h": $sigla = "Crédito Cupom"; break;  

			case "j": $sigla = "Arrecadação"; break;  

			case "": $sigla = "Ok"; break;

		} 

		return $sigla;	

	}

	

	// resultados ultimos 3 meses - Portugues

	public function get_all_results_br() {

		

		$my_res = "";

		$query = $this->db->query('	SELECT * FROM prem_info	

									WHERE sorteio_data > DATE_SUB(CURDATE(), INTERVAL 3 MONTH)									

									ORDER BY sorteio_data DESC ');

		

		foreach ($query->result_array() as $row)

		{

			unset($header);

			$todos_val = $this->get_valores($row['val_total']);



			$my_res .= "

					<br><br><hr><br><h3>Sorteio " . date("d-m-Y", strtotime($row['sorteio_data'])) . "</h3><br><br>";

			

			$my_res .= "	<table class='t_home' bgcolor='#ededed' >

					<tr>

					<th> Resultado  </th>

					<th> Ganhadores 1&#186; Prem. </th>

					<th> Valor Prêmio </th>

					<th> Ganhadores 2&#186; Prem. </th>

					<th> Valor Prêmio </th>

					<th> Rede Diluição </th>

					<th> Valor Prêmio </th>

					</tr>

					<tr>

					<td> {$row['sorteio_result']} </td>

					<td> {$row['num_win_1']} </td>

					<td> " . number_format($todos_val['val1'], 2, ',','.') . " </td>
					
					<td> {$row['num_win_2']} </td>

					<td> " . number_format($todos_val['val2'], 2, ',','.') . " </td>

					<td> {$row['num_dilu']} </td>

					<td> " . number_format($todos_val['val1'], 2, ',','.') . " </td>

					</tr>

					</table>				

					";

			$query1 = $this->db->query("SELECT prem_sorteios.*, users.user_name FROM prem_sorteios

												INNER JOIN users ON prem_sorteios.id_winner = users.user_id

											WHERE sorteio_data = '{$row['sorteio_data']}'									

											ORDER BY sorteio_data DESC

			");

			$my_res .= "<br><h3>Ganhadores dos Sorteios</h3><br>";

			$my_res .= "<table class='t_home' >";



			foreach ($query1->result_array() as $row1) {

			

				if (!isset($header)) {

					$my_res .= "	<tr>

							<th> Usuário  </th>

							<th> 1&#186; ou 2&#186; Prem. </th>

							<th> Valor </th>

							<th> E-Card </th>

							<th> Pontuação </th>

							</tr>

							";

					$header = 1;

				}

					$my_res .= "	<tr>

							<td> {$row1['user_name']} </td>

							<td> {$row1['prim_ou_seg']} </td>

							<td> " . number_format($row1['valor'], 2, ',','.') . " </td>
							
							<td> {$row1['ecard']} </td>

							<td> {$row1['pontuacao']} </td>

							</tr>

							";

			}

			$my_res .= "</table>";

			$query1 = $this->db->query("SELECT prem_dilu.*, users.user_name FROM prem_dilu

										INNER JOIN users ON prem_dilu.id_winner = users.user_id

									WHERE sorteio_data = '{$row['sorteio_data']}'	
									AND missed = ''

									ORDER BY sorteio_data DESC	

			");

		

			$my_res .= "<br><h3>Ganhadores da Rede de Diluição</h3><br>";

			$my_res .= "<table class='t_home' >";



			foreach ($query1->result_array() as $row1) {

			

				if (!isset($header1)) {

					$my_res .= "	<tr>

							<th> Nome  </th>

							<th> Valor </th>

							</tr>

							";

					$header1 = 1;

				}

					$my_res .= "	<tr>

							<td> {$row1['user_name']} </td>

							<td> " . number_format($row1['valor'], 2, ',','.') . " </td>

							</tr>

							";

			}

			$my_res .= "</table>";	

			

		} // end for

	

		return $data = array('my_res' => $my_res );

	

	}

	// resultados ultimos 3 meses - English

	public function get_all_results_en() {

		

		$my_res = "";

		$query = $this->db->query('	SELECT * FROM prem_info	

									WHERE sorteio_data > DATE_SUB(CURDATE(), INTERVAL 3 MONTH)									

									ORDER BY sorteio_data DESC ');

		

		foreach ($query->result_array() as $row)

		{

			unset($header);

			$todos_val = $this->get_valores($row['val_total']);



			$my_res .= "

					<br><br><hr><br><h3>Draw " . date("d-m-Y", strtotime($row['sorteio_data'])) . "</h3><br><br>";

			

			$my_res .= "	<table class='t_home' bgcolor='#ededed' >

					<tr>

					<th> Result  </th>

					<th> Winners 1&#186; Prize </th>

					<th> Prize Value </th>

					<th> Winners 2&#186; Prize </th>

					<th> Prize Value </th>

					<th> Network Share Size</th>

					<th> Prize Value </th>

					</tr>

					<tr>

					<td> {$row['sorteio_result']} </td>

					<td> {$row['num_win_1']} </td>

					<td> " . number_format($todos_val['val1'], 2, ',','.') . " </td>
					
					<td> {$row['num_win_2']} </td>

					<td> " . number_format($todos_val['val2'], 2, ',','.') . " </td>

					<td> {$row['num_dilu']} </td>

					<td> " . number_format($todos_val['val1'], 2, ',','.') . " </td>

					</tr>

					</table>				

					";

			$query1 = $this->db->query("SELECT prem_sorteios.*, users.user_name FROM prem_sorteios

												INNER JOIN users ON prem_sorteios.id_winner = users.user_id

											WHERE sorteio_data = '{$row['sorteio_data']}'									

											ORDER BY sorteio_data DESC

			");

			$my_res .= "<br><h3>Draw Winners</h3><br>";

			$my_res .= "<table class='t_home' >";



			foreach ($query1->result_array() as $row1) {

			

				if (!isset($header)) {

					$my_res .= "	<tr>

							<th> User  </th>

							<th> 1&#186; or 2&#186; Prize </th>

							<th> Value </th>

							<th> E-Card </th>

							<th> Points </th>

							</tr>

							";

					$header = 1;

				}

					$my_res .= "	<tr>

							<td> {$row1['user_name']} </td>

							<td> {$row1['prim_ou_seg']} </td>

							<td> " . number_format($row1['valor'], 2, ',','.') . " </td>
							
							<td> {$row1['ecard']} </td>

							<td> {$row1['pontuacao']} </td>

							</tr>

							";

			}

			$my_res .= "</table>";

			$query1 = $this->db->query("SELECT prem_dilu.*, users.user_name FROM prem_dilu

										INNER JOIN users ON prem_dilu.id_winner = users.user_id

									WHERE sorteio_data = '{$row['sorteio_data']}'	
									AND missed = ''

									ORDER BY sorteio_data DESC	

			");

		

			$my_res .= "<br><h3>Ganhadores da Rede de Diluição</h3><br>";

			$my_res .= "<table class='t_home' >";



			foreach ($query1->result_array() as $row1) {

			

				if (!isset($header1)) {

					$my_res .= "	<tr>

							<th> Name  </th>

							<th> Value </th>

							</tr>

							";

					$header1 = 1;

				}

					$my_res .= "	<tr>

							<td> {$row1['user_name']} </td>

							<td> " . number_format($row1['valor'], 2, ',','.') . " </td>

							</tr>

							";

			}

			$my_res .= "</table>";	

			

		} // end for

	

		return $data = array('my_res' => $my_res );

	

	}

	
	public function get_saldo() {

			$this->db->select('saldo');
			$this->db->where('user_id', $this->session->userdata('log_user_id'));
			$this->db->from('creditos');
			$this->db->order_by('id', 'desc');
			$this->db->limit('1');
			$query = $this->db->get();

			$row = $query->row();

			if ($query->num_rows() > 0) {	
			
				$data = $row->saldo;			

			} else {
				$data = 0; 
				}
			return $data;
	}

	public function checa_cupom() {
	
		// checa se existe e esta valido
		$this->db->select('valor');
		$this->db->where('codigo', $this->input->post('cupom'));
		$this->db->where('usado', '');
		$query = $this->db->get('cupons');

		$row = $query->row();

		if ($query->num_rows() > 0) {	
		
			$cred_valor = $row->valor;
			
			// adiciona
			if (!$this->model_sorteios->add_credits($this->session->userdata('log_user_id'),'h',$cred_valor)) return false;

			// update usado = 's'
			$data = array( 'usado' => 's');
			
			$this->db->where('codigo', $this->input->post('cupom'));
			$this->db->where('usado', '');
			$this->db->update('cupons', $data);
			
			return $cred_valor;
			
		} else return false;
		
	
	}

	public function busca_ecard() {

		$this->session->unset_userdata('id_ecard_npg');
		$this->session->unset_userdata('id_ecard_pg');
		$this->session->unset_userdata('distribuicao');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('rede_user_name');
		//$this->session->unset_userdata('ja_cpf');
		$this->session->unset_userdata('conf_dist');
		$this->session->unset_userdata('new_user_id');

		$query = $this->db->query("	SELECT ecards.*, users.user_name FROM ecards 

										LEFT JOIN users ON ecards.distribuicao = users.user_id 

									WHERE ecards.id_ecard = '{$this->input->post('id_ecard')}' AND  ecards.atual = 's' ");
		$row = $query->row();

		
		if ($query->num_rows() == 1) {

			$data['status'] = $row->status;

			if ($data['status'] == 'n') {
			
				$my_sess = array ( 	'id_ecard_npg' 	=> $row->id_ecard,
									'distribuicao' => $row->distribuicao,
									'rede_user_name' => $row->user_name	);
									
				$this->session->set_userdata($my_sess);				

			}

			elseif ($row->status == 's') {

				$my_sess = array ( 	'id_ecard_pg' 	=> $row->id_ecard,
									'distribuicao' => $row->distribuicao,
									'rede_user_name' => $row->user_name,
									'user_name' => $row->user_name		);
									
				$this->session->set_userdata($my_sess);				
			}

			elseif ($row->status == 'd') {

				$my_sess = array ( 	'distribuicao' => $row->distribuicao,
									'rede_user_name' => $row->user_name	);
									
				$this->session->set_userdata($my_sess);	
			}

			else {
				$my_sess = array(	'my_recom' => $row->user_name );
				$this->session->set_userdata($my_sess);
				$data['busca'] =  "	<p>E-Card pertencente à um usuário.</p>
									<p><a href='" . base_url() . "index.php/main/signup_basic'>Criar conta e fazer parte de sua rede ></a>
			<strong> " . $this->session->userdata('my_recom') . "</strong></p>";
									
			}
		}
		else {
			$query = $this->db->query("	SELECT ecards.*, users.user_name FROM ecards 

											LEFT JOIN users ON ecards.distribuicao = users.user_id 

										WHERE ecards.id_ecard = '{$this->input->post('id_ecard')}' AND  ecards.distribuicao != '' ");
			$row = $query->row();
			
			if ($query->num_rows() > 0) {
			
				$my_sess = array(	'my_recom' => $row->user_name );
				$this->session->set_userdata($my_sess);
				$data['busca'] =  "	<p>E-Card pertencente à um usuário.</p>
									<p><a href='" . base_url() . "index.php/main/signup_basic'>Criar conta e fazer parte de sua rede ></a>
			<strong> " . $this->session->userdata('my_recom') . "</strong></p>";
			} 
			else $data['busca'] =  "<p>E-Card não encontrado.</p>";

			
		}

		return $data;

	}

	public function get_ecards_sem() {
	
		if (date('D') == 'Fri' && date('H') < 19)  

			$next_friday = date('Y-m-d'); 
		else 
			$next_friday = date( "Y-m-d", strtotime("next Friday"));

		$this->db->select("ecard,DATE_FORMAT(sorteio_data, ('%d/%m/%Y')) AS 'sorteio_data'");
		$this->db->where('sorteio_data', $next_friday);
		$query = $this->db->get('ecards');

		if ($query->num_rows() > 0) {
		
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	
	}
	
	
	public function del_ecard($redirect, $id_ecard, $sorteio_data) {
	
		// n s ou f ''
		if ($redirect == 'distribuicao') {
	
			// checa se existe e esta valido
			$this->db->where('id_ecard', $id_ecard);
			$this->db->where('distribuicao', $this->session->userdata('log_user_id'));
			
			$where = "(( status = 'f' AND atual = '') OR (status = 'n' AND atual = 's' ))";
			$this->db->where($where);
			
			$query = $this->db->get('ecards');

			$row = $query->row();
			$a = $query->num_rows();
			if ($query->num_rows() == 1) {
			
				// update ecards 
				$data = array(	'status' => 'z', 'atual' => '' );

				$this->db->where('id_ecard', $id_ecard);
				$this->db->where('distribuicao', $this->session->userdata('log_user_id'));
				
				$where = "(( status = 'f' AND atual = '') OR (status = 'n' AND atual = 's' ))";
				$this->db->where($where);
				
				$query = $this->db->update('ecards', $data);

				if ($query) return true;
				
			} else {
				$data = array( 'ecards_msg' => 'E-Card aguardando recebimento.' );
				$this->session->set_userdata($data);
			
			}
		
		
		
		
		} elseif ($redirect == 'terminados') {
		
			// checa se existe e esta valido
			$this->db->where('id_ecard', $id_ecard);
			$this->db->where('user_id', $this->session->userdata('log_user_id'));
			$this->db->where('sorteio_data', $sorteio_data);
			
			$where = "(status = 't' OR status = 'w' OR  status = 'y')";
			$this->db->where($where);
				
			$this->db->where('atual', '');
			
			$query = $this->db->get('ecards');

			$row = $query->row();
			
			if ($query->num_rows() == 1) {
			
				// update ecards 
				$data = array(	'status' => 'z', 'atual' => '' );

				$this->db->where('id_ecard', $id_ecard);
				$this->db->where('user_id', $this->session->userdata('log_user_id'));
				$this->db->where('sorteio_data', $sorteio_data);
				
			$where = "(status = 't' OR status = 'w' OR  status = 'y')";
			$this->db->where($where);
			
				$this->db->where('atual', '');
				
				$query = $this->db->update('ecards', $data);

				if ($query) return true;
				
			} else {
				$data = array( 'ecards_msg' => 'ops' );
				$this->session->set_userdata($data);
			
			}

		
		} 
	
	}
	
	public function minhacopia() {
	
		// creditos -> data 	| 	ecards -> date_added
		// get last date of each
		
		$this->db->select('creditos, ecards, users');
		$query = $this->db->get('copia');
		
		$row = $query->row();
		
		// select de creditos onde data > $row->creditos
		
		$query2 = $this->db->query(" SELECT * FROM creditos WHERE data >= '{$row->creditos}' ");
		
		// caso nao exista, pega este ultimo mesmo?
		$ult = $row->creditos;
		
		if ($query2->num_rows() > 0) {
		
			// envia email
			$this->load->library('email', array('mailtype' => 'html'));
			$this->email->from('info@webecard.net', 'WEBECARD.net');
			$this->email->to('leocintrao@yahoo.co.uk');
			$this->email->subject('copia creditos ' . base_url() );
			
			$data = "INSERT INTO `creditos` (`id`, `user_id`, `data`, `tipo_cred`, `valor`, `status`, `saldo`) VALUES <br>";

			$n_rows = $query2->num_rows();

			foreach ($query2->result() as $row3) {
				//$data[] = $row3;
				
				$data .= "(" . $row3->id . ", '" . $row3->user_id . "', '" . $row3->data . "', '" . $row3->tipo_cred . "', " . $row3->valor 
				. ", '" . $row3->status . "', " . $row3->saldo . ")";
				
				if ($n_rows == 1) 		$data .= ";"; 		else 	$data .= ",";
								
				$n_rows --;
				
				$data .= "<br>";

			}
			
			$message = $data; 	//$message = "<p>Erro ao copiar db</p>"; //$message .= "";
		
			$this->email->message($message);
			$this->email->send();
	
			$ult = $row3->data;
		}
		
		$this->db->query(" UPDATE copia SET creditos = '$ult' ");
		
		//echo $message;
		//echo "<br><br>";
		
		
		// select de ecards onde date_added > $row->ecards
		
		$query2 = $this->db->query(" SELECT * FROM ecards WHERE date_added >= '{$row->ecards}' ");
		
		$ult = $row->ecards;
		
		if ($query2->num_rows() > 0) {
		
			// envia email
			$this->load->library('email', array('mailtype' => 'html'));
			$this->email->from('info@webecard.net', 'WEBECARD.net');
			$this->email->to('leocintrao@yahoo.co.uk');
			$this->email->subject('copia ecards ' . base_url() );
			
			$data = "INSERT INTO `ecards` (`id`, `id_ecard`, `ecard`, `sorteio_data`, `user_id`, `sentence`, `design`, `distribuicao`, `status`, `atual`, `date_added`) VALUES <br>";

			$n_rows = $query2->num_rows();

			foreach ($query2->result() as $row2) {
				//$data[] = $row;
				
				$data .= "(" . $row2->id . ", '" . $row2->id_ecard . "', '" . $row2->ecard . "', '" . $row2->sorteio_data . "', '" . $row2->user_id 
				. "', '" . $row2->sentence . "', '" . $row2->design . "', '" . $row2->distribuicao . "', '" . $row2->status . "', '" . $row2->atual
				. "', '" . $row2->date_added . "')";
				
				if ($n_rows == 1) 		$data .= ";"; 		else 	$data .= ",";
								
				$n_rows --;
				
				$data .= "<br>";

			}
			
			$message = $data; 	//$message = "<p>Erro ao copiar db</p>"; //$message .= "";
		
			$this->email->message($message);
			$this->email->send();
	
			$ult = $row2->date_added;
		}
		
		$this->db->query(" UPDATE copia SET ecards = '$ult' ");
		
		//echo $message;
		//echo "<br><br>";
		
		
		// select de users onde date_added > $row->users
		
		$query2 = $this->db->query(" SELECT * FROM users WHERE date_added >= '{$row->users}' ");
		
		$ult = $row->users;
		
		if ($query2->num_rows() > 0) {
		
			// envia email
			$this->load->library('email', array('mailtype' => 'html'));
			$this->email->from('info@webecard.net', 'WEBECARD.net');
			$this->email->to('leocintrao@yahoo.co.uk');
			$this->email->subject('copia users ' . base_url() );

			
			$data = "INSERT INTO `users` (`id`, `user_id`, `password`, `user_name`, `email`, `email_temp`, `email_tipo`, `cpf`, `cel`, `perg`, `resp`, `status`, `key_reg`, `date_added`) VALUES <br>";

			$n_rows = $query2->num_rows();

			foreach ($query2->result() as $row4) {
				//$data[] = $row;
				
				$data .= "(" . $row4->id . ", '" . $row4->user_id . "', '" . $row4->password . "', '" . $row4->user_name . "', '" . $row4->email 
				. "', '" . $row4->email_temp . "', '" . $row4->email_tipo . "', '" . $row4->cpf . "', '" . $row4->cel . "', '" . $row4->perg
				. "', '" . $row4->resp . "', '" . $row4->status . "', '" . $row4->key_reg
				. "', '" . $row4->date_added . "')";
				
				if ($n_rows == 1) 		$data .= ";"; 		else 	$data .= ",";
								
				$n_rows --;
				
				$data .= "<br>";

			}
			
			$message = $data; 	//$message = "<p>Erro ao copiar db</p>"; //$message .= "";
		
			$this->email->message($message);
			$this->email->send();
	
			$ult = $row4->date_added;
		}
		
		$this->db->query(" UPDATE copia SET users = '$ult' ");
		
		
		//echo $message;
		//echo "<br><br>";
		
		
		return true;
		// update creditos, ecards com ultima data dos 2
	
	}


	public function meutime() {
	
		// se banco vazio, entra com data de 1 dia antes para trigger copia
		$query = $this->db->query(' SELECT meutime FROM copia ');		
		$row = $query->row();		
		if ($query->num_rows() == 0) 				
			$this->db->query('	INSERT INTO copia (meutime) VALUES (DATE_SUB(NOW(), INTERVAL 25 HOUR))  ');

		
		// select last time, se > 24hrs , do it		
		$query = $this->db->query(' SELECT meutime FROM copia WHERE meutime > DATE_SUB(NOW(), INTERVAL 24 HOUR) ');		
		$row = $query->row();		
		if ($query->num_rows() == 0) {
		
			if (!$this->minhacopia()) { 
			
				// envia email
				$this->load->library('email', array('mailtype' => 'html'));
				$this->email->from('info@webecard.net', 'WEBECARD.net');
				$this->email->to('leocintrao@yahoo.co.uk');
				$this->email->subject('Erro ao copiar db ' . base_url() );
				
				$message = "<p>Erro ao copiar db</p>";
				//$message .= "";
			
				$this->email->message($message);
				
				$this->email->send();

			} else {
			
				// update meutime 
				$this->db->query('	UPDATE copia SET meutime = NOW() ');
			
				//exit();

			}
		}
		
	
	}

	public function _language($_lang, $place) {
	
		if ($place == 'home') {
		
			if ($_lang == "br") {
			
				//$data['_title'] = "Home";
				$data['_ult_res'] = "Último Resultado";
				$data['_todos_res'] = "Ver todos os resultados";
				$data['_ecards_sem'] = "E-Cards da Semana";
				$data['_points_week'] = "Subtotal de pontos para esta semana";
				$data['_pontos'] = "pontos";
				$data['_mem_total'] = "Total de Membros";
				$data['_mem'] = "Membros";
				$data['_banner01'] = "banner01";
				$data['_banner02'] = "banner02";
				$data['_banner03'] = "banner03";
				
				
				
			} elseif ($_lang == "en") {
			
				//$data['_title'] = "Home";
				$data['_ult_res'] = "Last Result";
				$data['_todos_res'] = "View All Results";
				$data['_ecards_sem'] = "This Week's E-Cards";
				$data['_points_week'] = "This week's subtotal points";
				$data['_pontos'] = "points";
				$data['_mem_total'] = "Number of Members";
				$data['_mem'] = "Members";
				$data['_banner01'] = "banner01_en";
				$data['_banner02'] = "banner02_en";
				$data['_banner03'] = "banner03_en";
			}
		}
		elseif ($place == 'header') {
		
			if ($_lang == "br") {
			
				$data['_sair'] = "Sair";
				//$data['_title'] = "Entrar";
				$data['_entrar'] = "Entrar";
				$data['_criar_conta'] = "Criar Conta";
				$data['_signup_sml'] = "criar.png";
				$data['_entrar_sml'] = "entrar.png";
				$data['_company'] = "A WEBECARD.net";
				$data['_funciona'] = "Como Funciona";
				$data['_faq'] = "Perguntas & Respostas";
				$data['_meus_ecards'] = "Meus E-Cards";
				$data['_meu_fin'] = "Meus Pontos";
				$data['_minha_rede'] = "Minha Rede";
				$data['_ecardscheck'] = "Checar E-Cards";
				$data['_company_t1'] = "A WEBECARD.net";
				$data['_company_t2'] = "
<p><strong>A WEBECARD.net</strong> é um site promocional que realiza a venda de cartões virtuais,
<strong>os E-Cards</strong>. 
Eles possuem diversos designs e cada um possui um código promocional que permite concorrer a <strong>2 Sorteios</strong>, além
de outros recursos extras.</p><br>
	";
				
			} elseif ($_lang == "en") {
			
				$data['_sair'] = "Logout";
				//$data['_title'] = "Login";
				$data['_entrar'] = "Sign-in";
				$data['_criar_conta'] = "Register";
				$data['_signup_sml'] = "criar_en.png";
				$data['_entrar_sml'] = "entrar_en.png";
				$data['_company'] = "Company";
				$data['_funciona'] = "How It Works";
				$data['_faq'] = "FAQ";
				$data['_meus_ecards'] = "My E-Cards";
				$data['_meu_fin'] = "My Points";
				$data['_minha_rede'] = "My Network";
				$data['_ecardscheck'] = "Check E-Cards";
				$data['_company_t1'] = "WEBECARD.net";
				$data['_company_t2'] = "
<p><strong>WEBECARD.net</strong>  is a promotional website that sells virtual cards,
<strong>the E-Cards</strong>. 
They come in different designs and each of them has a promotional code. This code allows you to run for <strong>2 drawings</strong>,
apart from other features.</p><br>
";
				
				}
		}
		
		return $data;
	
	
	}


}

?>