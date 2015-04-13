<?php

Class Model_users Extends CI_Model {

	public function can_log_in() {
	
		$this->db->where('user_name', $this->input->post('user_name') );
		$this->db->where('password', md5($this->input->post('pw')) );
		$this->db->where('status', '' );
		
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	public function log_in_user_id() {
	
		$this->db->where('user_name', $this->input->post('user_name') );
		$this->db->where('password', md5($this->input->post('pw')) );
		
		$query = $this->db->get('users');
		
		$row = $query->row();

		$data['user_id'] = $row->user_id;
		
		return $data;
	}
	
	
	public function atu_ecards($user_id_reg) {
				
		// update ids.
		$this->db->where('cpf', $this->session->userdata('reg_cpf2'));
		$this->db->where('status', 'n');
		$query = $this->db->get('users');
			
		//echo $this->session->userdata('reg_cpf2'); echo " < here"; exit();
		
		$this->session->unset_userdata('reg_cpf2');
		
		foreach ($query->result_array() as $row) {
					
			$data = array(	'user_id' => $user_id_reg );
			
			$this->db->where('atual', 's');
			$this->db->where('status', 'd');
			$this->db->where('user_id', $row['user_id']);
			$query2 = $this->db->update('ecards', $data);
				
		}			
			
		// Atualiza E-Cards de Novo Usuario apos cadastro seja o caso.
		$this->db->where('status','d');
		$this->db->where('atual','s');
		$this->db->where('user_id',$user_id_reg); 
		$query = $this->db->get('ecards');
		
		foreach ($query->result_array() as $row) {
		
			// duplica em aceito tipo = f
			$this->muda_status($row['id_ecard'],'f','');

			// duplica para 'e'
			$this->muda_status($row['id_ecard'],'e','');
		
		}			
			


	}
	public function atu_single_ecard($user_id_reg,$id_ecard,$status,$distribuicao) {
		
		// Atualiza E-Card de um Novo Usuario apos cadastro.
		$data = array( 'user_id' => $user_id_reg );	
		
		$this->db->where('distribuicao',$distribuicao);
		$this->db->where('id_ecard',$id_ecard);
		$this->db->where('atual','s');
		//$this->db->where('user_id',$user_id_reg);
		
		$query = $this->db->update('ecards', $data);
		
		// duplica em aceito tipo = f
		$this->muda_status($id_ecard,'f','');

		// duplica para 'e' ou 'c'
		$this->muda_status($id_ecard,$status,'');
	}
	

	public function add_user_reg($key,$novo_user_id) {
	
		// - normal sem indicacao, sem existir nenhum pre-cadastro
		// - normal sem indicacao, existindo pre-cadastros (atualiza e-cards ao final)	atu_ecards($user_id_reg)

		// se key = 1 (sem email) status = nada, dizendo que user ok. Se nao status = n pra confirmar email depois.
		if ($key == 1) $status = ''; else $status = 'n';
		/*
		if ($this->session->userdata('ja_cpf')) { 
		
			$data = array(	'user_name' => $this->session->userdata('reg_user_name'),
							'email' => $this->session->userdata('reg_email'),
							'email_tipo' => $this->session->userdata('reg_email_tipo'),
							'password' => md5($this->session->userdata('reg_pw')),
							'perg' => $this->session->userdata('reg_perg'),
							'resp' => $this->session->userdata('reg_resp'),
							'cel' => $this->session->userdata('reg_cel'),
							'status' => $status,
							'key_reg' => $key );
					
			$this->db->where('user_id' , $novo_user_id);				
			$this->db->where('status' , 'n');				
			$query = $this->db->update('users', $data);

			
			if ($query) {	
			
				$data = array(	'user_id' => $novo_user_id );
				$this->db->insert('bancos', $data);

			
				$my_sess = array( 	'reg_user_name2' => $this->session->userdata('reg_user_name'),
									'reg_cpf2' => $this->session->userdata('reg_cpf')
				);
				$this->session->set_userdata($my_sess);
			
				$this->session->unset_userdata('reg_user_name');
				$this->session->unset_userdata('reg_cpf');
				$this->session->unset_userdata('reg_email');
				$this->session->unset_userdata('reg_email_tipo');
				$this->session->unset_userdata('reg_pw');
				$this->session->unset_userdata('reg_perg');
				$this->session->unset_userdata('reg_resp');
				$this->session->unset_userdata('reg_cel');
				
				$this->session->unset_userdata('my_recom');
	
				$this->atu_ecards($novo_user_id);	
				return true;
			}			
			else return false;
		
		
		} else {	
		*/
			$data = array(	'user_id' => $novo_user_id,
							'user_name' => $this->session->userdata('reg_user_name'),
							//'cpf' => $this->session->userdata('reg_cpf'), 
							'email' => $this->session->userdata('reg_email'),
							'email_tipo' => $this->session->userdata('reg_email_tipo'),
							'password' => md5($this->session->userdata('reg_pw')),
							'perg' => $this->session->userdata('reg_perg'),
							'resp' => $this->session->userdata('reg_resp'),
							'cel' => $this->session->userdata('reg_cel'),
							'status' => $status,
							'key_reg' => $key );
								
			$query = $this->db->insert('users', $data);
				
			if ($query) {
			
				$data = array(	'user_id' => $novo_user_id );
				$this->db->insert('bancos', $data);

				$my_sess = array( 	'reg_user_name2' => $this->session->userdata('reg_user_name') );
				
				$this->session->set_userdata($my_sess);


				$this->session->unset_userdata('reg_user_name');
				//$this->session->unset_userdata('reg_cpf');
				$this->session->unset_userdata('reg_email');
				$this->session->unset_userdata('reg_email_tipo');
				$this->session->unset_userdata('reg_pw');
				$this->session->unset_userdata('reg_perg');
				$this->session->unset_userdata('reg_resp');
				$this->session->unset_userdata('reg_cel');
				
				$this->session->unset_userdata('my_recom');
			
				if ($this->session->userdata('id_ecard_pg')) {
				
					$this->atu_single_ecard($novo_user_id,$this->session->userdata('id_ecard_pg'),'e',$this->session->userdata('distribuicao'));
					
				} elseif ($this->session->userdata('id_ecard_npg')) {
				
					$this->atu_single_ecard($novo_user_id,$this->session->userdata('id_ecard_npg'),'c',$this->session->userdata('distribuicao'));
					
				}

			
			return true;
			}
			else return false;
		//}
		
	}		
			
		
	public function alt_user($key) {
	
		if ($key != 1) {
		
			$data = array(	'email_temp' => $this->input->post('email'),
							'cel' => $this->input->post('cel'),
							'key_reg' => $key );
							
		} else {
		
			if ($this->input->post('email_tipo') == 'n') $em = ""; else $em = $this->input->post('email');
			
			$data = array(	'email' => $em,
							'email_tipo' => $this->input->post('email_tipo'),
							'cel' => $this->input->post('cel'),
							'key_reg' => $key );
		}
					
			$this->db->where('user_id', $this->session->userdata('log_user_id'));				
			$this->db->where('status' , '');				
			$query = $this->db->update('users', $data);

			if ($query)	return true;
						
			else return false;
			
	}		
			
		
		
	
	public function novo_usuario($rec_id) {

		// perfect!
		// gets all letters and put in array
		preg_match_all('!\p{L}+!', $rec_id, $matches1);
		
		$a = end($matches1[0]);

		$aa = ++ $a;
		$aaa = $rec_id . $aa;
		
		$num = 1;
	
		do {
		
			$new_user_id = $aaa . $num;
			
			$this->db->where('user_id', $new_user_id);
			
			$query = $this->db->get('users');
		
			$num = $num + 1;

		} while ($query->num_rows() == 1);

		
		// if > 255 chars exit()
		
		return $new_user_id;
	}
		
	public function is_key_valid($key){
	
		$this->db->where('key_reg', $key);
		//$this->db->where('status', '');
		$query = $this->db->get('users');
		
		if ($query->num_rows() == 1) 
			return true;
		else 
			return false; 
		
	}
	
	public function add_user($key) {
	
		$this->db->where('key_reg', $key);
		$query = $this->db->get('users');
		
		$row = $query->row();
		
		$data3['user_name'] = $row->user_name;
		$data3['user_id'] = $row->user_id;
		
		// update
		$data2 = array( 'status' => '', 'key_reg' => ''  );
		$this->db->where('key_reg', $key);
		$confirm_user = $this->db->update('users', $data2);
		
		if ($confirm_user) {
		
			
			return $data3;
		}
		
		else return false;
		
	}
	
	
	public function alt_email_user($key) {
	
		$this->db->select('email_temp');
		$this->db->where('key_reg', $key);
		$query = $this->db->get('users');
		
		$row = $query->row();
				
		// update
		$data2 = array( 'email_temp' => '', 'key_reg' => '', 'email_tipo' => 'p', 'email' => $row->email_temp  );
		$this->db->where('key_reg', $key);
		$confirm_user = $this->db->update('users', $data2);
		
		if ($confirm_user)	
			
			return true;
		
		
		else return false;
		
	}
	
	
	
	public function do_nova_senha() {
		
		$this->db->select('user_id, user_name');
		$this->db->where('key_reg', $this->input->post('key_reg'));
		$query = $this->db->get('users');
	
		$row = $query->row();
		
		$data['user_name'] = $row->user_name;
		$data['user_id'] = $row->user_id;

		// update
		$data2 = array( 'password' => md5($this->input->post('pw')), 'key_reg' => ''  );
		$this->db->where('key_reg', $this->input->post('key_reg'));
		$this->db->where('status', '');
		$nova_senha = $this->db->update('users', $data2);
		
		if ($nova_senha) return $data;	
				
		else return false;		
	}
	
	
	
	public function get_cpf() {
	
		// hack cpf deixa soh numeros
		$cpf = $this->input->post('cpf');
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		
		$this->db->where('cpf', $cpf); // pode vir + do que 1
		$this->db->where('status', 'n'); 
		$query = $this->db->get('users');
		
		foreach ($query->result_array() as $row) {

			preg_match_all('!\p{L}+!', $row['user_id'], $matches1);
			array_pop($matches1[0]);
			
			preg_match_all('!\d+!', $row['user_id'], $matches);
			array_pop($matches[0]);
			
			$array = array_merge($matches1, $matches);
		
			$montado = "";
			
			for ($i = 0;$i < count($matches[0]);$i ++) {
			
				$montado .= $matches1[0][$i] . $matches[0][$i];
			}
			if ($montado == $this->session->userdata('distribuicao')) { 
			
				$data['new_user_id'] = $row['user_id'];
				$data['cpf'] = $cpf;
				break;
			}	
		}			
		return $data;
	
	}
	
	public function get_last_id() {
	
		$query = $this->db->query("	SELECT user_id, user_name FROM users WHERE status = ''
									ORDER BY LENGTH(user_id) DESC, id DESC LIMIT 1");
		$row = $query->row();
		
		$data['user_id'] = $row->user_id;
		$data['user_name'] = $row->user_name;
		
		return $data;	

	}
	
	
	public function get_id($user_name) {
	
		$query = $this->db->query("	SELECT user_id FROM users
									WHERE user_name = '$user_name' AND status = '' ");
		$row = $query->row();
		
		$data['user_id'] = $row->user_id;
		
		return $data;	

	}
	
	
	public function checa_cpf_erro() {
	
		// hack cpf deixa soh numeros
		$cpf = $this->input->post('cpf');
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
	
		// double check se existe mais q 1 usuario com mesmo cpf ativo
		$this->db->where('cpf', $cpf);
		$this->db->where('status', '');
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 1) { $data['erro'] = " Erro grave, mais do que 1 CPF ativo. CPF: " . $cpf; return $data; }
		
		elseif ($query->num_rows() == 1) { $data['erro'] = " Erro, CPF já ativo. CPF: " . $cpf; return $data;  }
		
	}
	
	public function checa_cpf() {
	
		// hack cpf deixa soh numeros
		$cpf = $this->input->post('cpf');
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
	
		// traz todos cadastros deste um cpf.
		$this->db->where('cpf', $cpf);
		$this->db->where('status', 'n');
		$query = $this->db->get('users');
			
		$my_res = "";			
		if ($query->num_rows() > 0) {
		
			foreach ($query->result_array() as $row) {
			
			// display nome, posicao, qt ecards pg
			preg_match_all('!\p{L}+!', $row['user_id'], $matches);
			
			$posicao = count($matches[0]) . "º";
			
			$query2 = $this->db->query("	SELECT COUNT(id_ecard) AS the_count, users.user_name FROM ecards 
											INNER JOIN users ON users.user_id = ecards.distribuicao
										WHERE ecards.atual = 's' 
										AND ecards.status = 'd'
										AND ecards.user_id = '{$row['user_id']}' ");
			$row2 = $query2->row();
			
			
			$my_res .= "<br> Rede de <a href='" . base_url() . "index.php/main/rede_picked/{$row['user_id']}'> {$row2->user_name}</a>
						com {$row2->the_count} E-Cards, posição $posicao lugar na rede.	<br>";			
			
			}
				
		return $data = array('my_res' => $my_res);
		
		}
		else return false;
	
	}
	
	public function muda_status($id_ecard,$novo_status,$nova_data) {
	
		// pega dados atual ecard
		
		$this->db->where('id_ecard',$id_ecard);
		$this->db->where('atual','s');
		$query = $this->db->get('ecards');
		
		$row = $query->row();
		
		if ($query->num_rows() > 1) { $data['erro'] = "Erro Grave, mais de 1 record encontrado como atual = 's' "; }
				
		$ecard = $row->ecard;
		
		if (empty($nova_data)) $sorteio_data = $row->sorteio_data; else $sorteio_data = $nova_data;
		
		$user_id = $row->user_id; 
		$sentence = $row->sentence;
		$design = $row->design;
		$distribuicao = $row->distribuicao;
		
		
		// retira atual...
		$data = array('atual' => '');
		$this->db->where('id_ecard',$id_ecard);
		$this->db->where('atual','s');
		$query2 = $this->db->update('ecards', $data);
		
	
		// insere ecard atualizado
		
		// hack, porque qd cria ecard sem saldo ele cria igual, ai mudo pra 'z' e atual = ''... (ate arrumar)
		$atual = 's';	if ($novo_status == 'z') $atual = '';  
		
		$data = array(	'id_ecard' => $id_ecard,
						'ecard' => $ecard,
						'sorteio_data' => $sorteio_data,
						'user_id' => $user_id,
						'sentence' => $sentence,
						'design' => $design,
						'distribuicao' => $distribuicao,
						'status' => $novo_status,
						'atual' => $atual
						);
		$query3 = $this->db->insert('ecards', $data);	

		
		if (!isset($data['erro'])) { return true; }
		

	}
		
	public function get_dados() {
	
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('status', '');
		$query = $this->db->get('users');
	
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data4[] = $row;
			}
			return $data4;
		}
		return false;
	}
	
	
	public function get_banco() {
	
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('saque_status', ''); // linha com saque_status vazio = banco oficial, outros sao pedidos de saque, nada legal mas funciona...
		$query = $this->db->get('bancos');
	
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data4[] = $row;
			}
			return $data4;
		}
		return false;
	}
	
	
	public function novo_banco() {
				
		$cpf = $this->input->post('cpf');
		$cpf = preg_replace("/[^0-9]/", "", $cpf);

	
		$data = array( 	'b_paypal' => $this->input->post('b_paypal') , 
						'b_pagseg' => $this->input->post('b_pagseg') , 
						'b_nome' => $this->input->post('b_nome') , 
						'b_numero' => $this->input->post('b_numero') ,
						'b_ag' => $this->input->post('b_ag') ,
						'b_ag_dig' => $this->input->post('b_ag_dig') ,
						'b_conta' => $this->input->post('b_conta') ,
						'b_conta_dig' => $this->input->post('b_conta_dig') ,
						'b_conta_tipo' => $this->input->post('b_conta_tipo') ,
						'obs' => $this->input->post('obs') ,
						'nome' => $this->input->post('nome') ,
						'sobrenomes' => $this->input->post('sobrenomes'),
						'cpf' => $cpf
						);
						
		if ($this->get_banco()) {
		
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$query = $this->db->update('bancos', $data);
		
		} else {
		
		$data['user_id'] = $this->session->userdata('log_user_id');
		$query = $this->db->insert('bancos', $data);
		}
	
		if ($query) return true;
		
		else return false;
	}
	
	
	public function nova_senha() {
	
		$data = array( 'password' => md5($this->input->post('pw')) );
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('status', '');
		$query = $this->db->update('users', $data);
	
		if ($query) return true;
		
		else return false;
	}
	
	
	public function check_senha() {
	
		$this->db->select('password');
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('status', '');
		$query = $this->db->get('users');
		
		$row = $query->row();
		
		if (md5($this->input->post('password')) == $row->password) return true; else return false;
	}
	
	
	public function check_resp() {
	
		$this->db->select('resp');
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('status', '');
		$query = $this->db->get('users');
		
		$row = $query->row();
		
		if ($this->input->post('resp') == $row->resp) return true; else return false;
	}
	
	
	public function nova_resp() {
	
		$data = array( 'resp' => $this->input->post('n_resp') , 'perg' => $this->input->post('n_perg') );
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('status', '');
		$query = $this->db->update('users', $data);
	
		if ($query) return true;
		
		else return false;
	}
	
	
	public function get_del_dados() {
	
		$this->db->select('perg');
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('status', '');
		$query = $this->db->get('users');
	
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function del_dados() {
	
		$this->db->select('password, resp, cpf');
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('status', '');
		$query = $this->db->get('users');
	
		if ($query->num_rows() > 0) {
		
			$row = $query->row();
			
			$pw = $row->password;
			$re = $row->resp;
			$cpf = $row->cpf;
			
			if ($pw == md5($this->input->post('pw')) && $re == $this->input->post('resp')) {
			
			
				$u_old = increment_string($this->session->userdata('log_user_name'), '_old');
				$cpf_old = increment_string($cpf, '_old');
				
				$data = array( 	'user_name' => $u_old , 
								'cpf' => $cpf_old,
								'status' => 'n'
								);
								
				$this->db->where('user_id', $this->session->userdata('log_user_id'));
				$this->db->where('status', '');
				$query = $this->db->update('users', $data);
			
				if ($query) return true;
				
				else return false;
				
			} else {			
				$data = array( 'cad_msg' => 'Senha ou Resposta Secreta não conferem.' );
				$this->session->set_userdata($data);
				return false;
			}
		} else {
				$data = array( 'cad_msg' => 'Problema ao encontrar dados.' );
				$this->session->set_userdata($data);
				return false;
		}
	}
	
	
	public function do_saque() {
	
		$this->db->select('password, resp, email_tipo, email');
		$this->db->where('user_id', $this->session->userdata('log_user_id'));
		$this->db->where('status', '');
		$query = $this->db->get('users');
	
		if ($query->num_rows() > 0) {
		
			$row = $query->row();
			
			$pw = $row->password;
			$re = $row->resp;
			$email_tipo = $row->email_tipo;
			$email = $row->email;
			
			if ($pw == md5($this->input->post('pw')) && $re == $this->input->post('resp')) {
			
				$conta_tipo = $this->input->post('conta_tipo');
				
				if ($conta_tipo == 'p') {
				
					$b_paypal = $this->input->post('b_paypal');
					$nome = $this->input->post('nome');
					$sobrenomes = $this->input->post('sobrenomes');
					$cpf = $this->input->post('cpf');
					
					if (empty($b_paypal) ||
						empty($nome) ||
						empty($sobrenomes) ||
						empty($cpf)					
					) {
					
						$data = array( 'cad_msg' => 'Dados Paypal Incompletos. Obrigatório: Email, CPF, Nome e Sobrenomes' );
						$this->session->set_userdata($data);
						return false;
					}
				} elseif ($conta_tipo == 's') {
				
					$b_pagseg = $this->input->post('b_pagseg');
					$nome = $this->input->post('nome');
					$sobrenomes = $this->input->post('sobrenomes');
					$cpf = $this->input->post('cpf');
					
					if (empty($b_pagseg) ||
						empty($nome) ||
						empty($sobrenomes) ||
						empty($cpf)					
					) {
					
						$data = array( 'cad_msg' => 'Dados PagSeguro Incompletos. Obrigatório: Email, CPF, Nome e Sobrenomes.' );
						$this->session->set_userdata($data);
						return false;
					}
				} elseif ($this->input->post('conta_tipo') == 'b') {
				
					$b_nome = $this->input->post('b_nome');
					$b_ag = $this->input->post('b_ag');
					$b_ag_dig = $this->input->post('b_ag_dig');
					$b_conta = $this->input->post('b_conta');
					$b_conta_tipo = $this->input->post('b_conta_tipo');
					$nome = $this->input->post('nome');
					$sobrenomes = $this->input->post('sobrenomes');
					$cpf = $this->input->post('cpf');
						
					if (empty($b_nome) ||
						empty($b_ag) ||
						//empty($b_ag_dig) ||
						empty($b_conta) ||
						empty($b_conta_tipo) ||
						empty($nome) ||
						empty($sobrenomes) ||
						empty($cpf)
						) {						
					
						$data = array( 'cad_msg' => 'Dados Bancários Incompletos.' );
						$this->session->set_userdata($data);
						return false;
					}
					
				} 
				
				$val_saque = str_replace(",", ".", $this->input->post('val_saque'));
				
				if ($val_saque < 50) { // 100, mudei para 50 temporariamente
				
						$data = array( 'cad_msg' => 'O valor do saque deve ser maior que 50,00.' );
						$this->session->set_userdata($data);
						return false;

				}
			
				if ($val_saque > $this->input->post('meu_saldo')) {
				
						$data = array( 'cad_msg' => 'O valor do saque deve ser menor ou igual ao saldo disponível.' );
						$this->session->set_userdata($data);
						return false;

				} 
				
					// entrar bancos saque_status = n, depois confirmado saque_status = s
					
					$data = array(	'valor' => $val_saque ,
									'tipo' => $this->input->post('conta_tipo') ,
									'saque_status' => 'n' ,
									
									'user_id' => $this->session->userdata('log_user_id') ,
									
									'b_paypal' => $this->input->post('b_paypal') , 
									'b_pagseg' => $this->input->post('b_pagseg') , 
									'b_nome' => $this->input->post('b_nome') , 
									'b_numero' => $this->input->post('b_numero') ,
									'b_ag' => $this->input->post('b_ag') ,
									'b_ag_dig' => $this->input->post('b_ag_dig') ,
									'b_conta' => $this->input->post('b_conta') ,
									'b_conta_dig' => $this->input->post('b_conta_dig') ,
									'b_conta_tipo' => $this->input->post('b_conta_tipo') ,
									'obs' => $this->input->post('obs') ,
									'nome' => $this->input->post('nome') ,
									'sobrenomes' => $this->input->post('sobrenomes'),
									'cpf' => $this->input->post('cpf')
							
									);
									
					$query = $this->db->insert('bancos', $data);
				
					if ($query) {
					
						// inserir creditos
						
						$this->load->model('model_sorteios');			

						$tipo_cred = 'i';
						
						$this->model_sorteios->add_credits($this->session->userdata('log_user_id'),$tipo_cred,$val_saque);
						
						// envia email
						if ($email_tipo != 'n') {
						
							$this->load->library('email', array('mailtype' => 'html'));
							$this->email->from('info@webecard.net', 'WEBECARD.net');
							$this->email->to($email);
							$this->email->subject('Pedido de Saque WEBECARD.net');
							
							$message = "<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>";
							$message .= "<p><img src='" . base_url() . "assets/images/logo.jpg' alt='Logomarca WEBECARD.net'></p><br>";
							$message .= "<h3>Pedido de Saque WEBECARD.net</h3><br>";
							$message .= "<p>Seu pedido de saque no valor de R$" . $val_saque . " reais foi realizado com sucesso.</p><br>";
							$message .= "<p>Por favor, aguarde a confirmação. Realizaremos seu saque o quanto antes.</p><br>";
							$message .= "<p>Obrigado por fazer parte da Rede <a href='http://www.webecard.net/'>WEBECARD.net</a> </p>";
							$message .= "</div>";

							$this->email->message($message);
							$this->email->send();
							
						}
						
						return true;
					}
					else return false;
					
				
				
			} else {			
				$data = array( 'cad_msg' => 'Senha ou Resposta Secreta não conferem.' );
				$this->session->set_userdata($data);
				return false;
			}
		} else {
				$data = array( 'cad_msg' => 'Problema ao encontrar dados.' );
				$this->session->set_userdata($data);
				return false;
		}
	}
	
	
	public function start_recup_cpf() {
	
		// se email tipo = p, envia email para redefinicao
		// se nao, manda perg para formulario view
		
		$conta = preg_replace("/[^0-9]/", "", $this->input->post('conta'));
		
		$this->db->select('user_id, resp, perg, email, email_tipo');
		$this->db->where('cpf', $conta);
		$this->db->where('status', '');
		$query = $this->db->get('users');
	
		if ($query->num_rows() > 0) {

			$row = $query->row();
			
			$email_tipo = $row->email_tipo;
			
			if ($email_tipo == "p") {

				$key = md5(uniqid());
			
				// envia email
				$this->load->library('email', array('mailtype' => 'html'));
				$this->email->from('info@webecard.net', 'WEBECARD.net');
				$this->email->to($row->email);
				$this->email->subject('Redefinição de Senha');
				
				$message = "<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>";
				$message .= "<p><img src='" . base_url() . "assets/images/logo.jpg' alt='Logomarca WEBECARD.net'></p><br>";
				$message .= "<h3>Redefinição de Senha</h3>";
				$message .= "<p> <a href='" . base_url() . "index.php/main/redef_senha/$key'> Redefinir Senha </a> </p>";
				$message .= "</div>";

				$this->email->message($message);
				
				$data = array('key_reg' => $key);
				$this->db->where('user_id', $row->user_id);
				$this->db->where('status', '');
				$query = $this->db->update('users', $data);

				if ($query) {
				
					if ($this->email->send()) {
					
						$data = array( 'msg' => 'Um email lhe foi enviado para a redefinição de senha.' );
						$this->session->set_userdata($data);
						return $data['perg'] = 1;
					
					} else {
						$data = array( 'msg' => 'Problema ao enviar Email, tente novamente.' );
						$this->session->set_userdata($data);
						return false;
					}
				} else {
						$data = array( 'msg' => 'Problema ao registrar chave, tente novamente.' );
						$this->session->set_userdata($data);
						return false;				
				}
				
			} else {
				$data['perg'] = $row->perg;
				
				$data2 = array( 'resp' => $row->resp, 'user_id' => $row->user_id );
				$this->session->set_userdata($data2);
				
				return $data;
				}
			
		} else {
			$data = array( 'msg' => 'CPF não encontrado.' );
			$this->session->set_userdata($data);
			return false;
			}
	}
	
	
	public function start_recup_username() {
	
		// se email tipo = p, envia email para redefinicao
		// se nao, manda perg para formulario view
	
		$this->db->select('user_id, resp, perg, email, email_tipo');
		$this->db->where('user_name', $this->input->post('conta'));
		$this->db->where('status', '');
		$query = $this->db->get('users');
	
		if ($query->num_rows() > 0) {

			$row = $query->row();
			
			$email_tipo = $row->email_tipo;
			
			if ($email_tipo == "p") {

				$key = md5(uniqid());
			
				// envia email
				$this->load->library('email', array('mailtype' => 'html'));
				$this->email->from('info@webecard.net', 'WEBECARD.net');
				$this->email->to($row->email);
				$this->email->subject('Redefinição de Senha');
				
				$message = "<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>";
				$message .= "<p><img src='" . base_url() . "assets/images/logo.jpg' alt='Logomarca WEBECARD.net'></p><br>";
				$message .= "<h3>Redefinição de Senha</h3>";
				$message .= "<p> <a href='" . base_url() . "index.php/main/redef_senha/$key'> Redefinir Senha </a> </p>";
				$message .= "</div>";

				$this->email->message($message);

				$data = array('key_reg' => $key);
				$this->db->where('user_id', $row->user_id);
				$this->db->where('status', '');
				$query = $this->db->update('users', $data);

				if ($query) {
				
					if ($this->email->send()) {
					
						$data = array( 'msg' => 'Um email lhe foi enviado para a redefinição de senha.' );
						$this->session->set_userdata($data);
						return $data['perg'] = 1;
					
					} else {
						$data = array( 'msg' => 'Problema ao enviar Email, tente novamente.' );
						$this->session->set_userdata($data);
						return false;
					}
				} else {
						$data = array( 'msg' => 'Problema ao registrar chave, tente novamente.' );
						$this->session->set_userdata($data);
						return false;				
				}
			} else {
				$data['perg'] = $row->perg;
				
				$data2 = array( 'resp' => $row->resp, 'user_id' => $row->user_id );
				$this->session->set_userdata($data2);
				
				return $data;
				}
			
		} else {
			$data = array( 'msg' => 'Nome de Usuário não encontrado.' );
			$this->session->set_userdata($data);
			return false;
			}
	}
	
	
	public function start_recup_email() {
	
		$this->db->select('email_tipo, user_id');
		$this->db->where('email', $this->input->post('conta'));
		$this->db->where('status', '');
		$query = $this->db->get('users');
	
		if ($query->num_rows() > 0) {
		
			$row = $query->row();
			
			$email_tipo = $row->email_tipo;
			
			if ($email_tipo == "p") {

				$key = md5(uniqid());
			
				// envia email
				$this->load->library('email', array('mailtype' => 'html'));
				$this->email->from('info@webecard.net', 'WEBECARD.net');
				$this->email->to($this->input->post('conta'));
				$this->email->subject('Redefinição de Senha');
				
				$message = "<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>";
				$message .= "<p><img src='" . base_url() . "assets/images/logo.jpg' alt='Logomarca WEBECARD.net'></p><br>";
				$message .= "<h3>Redefinição de Senha</h3>";
				$message .= "<p> <a href='" . base_url() . "index.php/main/redef_senha/$key'> Redefinir Senha </a> </p>";
				$message .= "</div>";
			
				$this->email->message($message);
				
				$data = array('key_reg' => $key);
				$this->db->where('user_id', $row->user_id);
				$this->db->where('status', '');
				$query = $this->db->update('users', $data);

				if ($query) {
				
					if ($this->email->send()) return true;
					
					else {
						$data = array( 'msg' => 'Problema ao enviar Email, tente novamente.' );
						$this->session->set_userdata($data);
						return false;
					}
				} else {
						$data = array( 'msg' => 'Problema ao registrar chave, tente novamente.' );
						$this->session->set_userdata($data);
						return false;				
				}
				
			} else {
				$data = array( 'msg' => 'Email não encontrado. <br> Emails de recado não são válidos para recuperação de senha.' );
				$this->session->set_userdata($data);
				return false;
			}
			
		} else {
			$data = array( 'msg' => 'Email não encontrado.' );
			$this->session->set_userdata($data);
			return false;
		}
	}
	
	public function update_key() {
	
		$data2['key2'] = md5(uniqid());

		$data = array('key_reg' => $data2['key2']);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('status', '');
		$query = $this->db->update('users', $data);

		if ($query)
		
			return $data2;
			
		else {
				$data = array( 'msg' => 'Problema ao registrar chave, tente novamente.' );
				$this->session->set_userdata($data);
				return false;				
		}

	}

	public function p_unique() {
		
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('email_tipo', 'p');
		$this->db->where('status', '');
		$query = $this->db->get('users');
	
		if ($query->num_rows() > 0) return true; else return false;
		
	}

	public function update_lang() {

		$data['lang'] = $this->session->userdata('_lang');

		$query = $this->db->update('copia', $data);
		
		if ($query) return true;
	
	}	
	
	public function get_lang() {
	
		$this->db->select('lang');
		$query = $this->db->get('copia');
		
		if ($query->num_rows() > 0) {
		
		$row = $query->row();
		
		return $row->lang;
		
		}
	
	}	
	
	
}
?>