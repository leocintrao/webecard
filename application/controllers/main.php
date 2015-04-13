<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {



	public function index()
	{
		$this->home();
	}
	
	public function home() {
	
		//$this->load->model('model_users');
		//$_lang = $this->model_users->get_lang();
		
		if (null == ($this->session->userdata('_lang'))) {
		
		$data = array( 	'_lang' => 'br' );
		$this->session->set_userdata($data);
		
		}
		
		$this->load->model('model_sorteios');
		
		$this->model_sorteios->meutime(); 
		
		$ult_result = "ult_result_" . $this->session->userdata('_lang');
		$data2 = $this->model_sorteios->$ult_result(); 
		
		$data1 = $this->model_sorteios->pontos_sem(); 
		$data3 = $this->model_sorteios->total_membros();
		
		$data4 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'home'); 
		
		$data = array_merge($data1, $data2, $data3, $data4);
		
		$data5 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
		//$data5['_title'] = "Home";
		$data5['selected1'] = "selected";
		$data5['flash'] = true;
		
		$this->load->view('templates/header', $data5);
		$this->load->view('home', $data);
		$this->load->view('templates/footer');	

	}

	public function login()
	{
		if (null == ($this->session->userdata('_lang'))) {
		
			$this->load->model('model_users');
			$data = array( '_lang' => $this->model_users->get_lang() );
			$this->session->set_userdata($data);
		}

		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		$this->load->view('templates/header', $data);
		$this->load->view('login');
		$this->load->view('templates/footer');	

	}
	
	public function cad_conf() {
	
		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
		
		//$data['_title'] = "Confirmação";	
		
		$this->load->view('templates/header', $data);
		$this->load->view('conf_cad');
		$this->load->view('templates/footer');		
	}

	public function ecards_sem() {
	
		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header');
		
		$data1['info'] = $this->model_sorteios->get_ecards_sem(); 

		//$data['_title'] = "Todos E-Cards Participantes da Semana";	
		
		$this->load->view('templates/header', $data);
		$this->load->view('ecards_sem', $data1);
		$this->load->view('templates/footer');		
	}

	public function my_recom($distribuicao) {
		
		$distribuicao = str_rot13($distribuicao); // should be str_rot13(str_rot13($distribuicao)); but works this way
		$my_sess = array(	'my_recom' => $distribuicao );
		$this->session->set_userdata($my_sess);
		
		$this->home();
	
	}
/*
	public function restricted()
	{
		$data['title'] = "Área Restrita";	
		$this->load->view('templates/header', $data);
		$this->load->view('restricted');
		$this->load->view('templates/footer');	
	
	}
	*/
	
	public function meus_ecards($a = NULL) {
	
		if ($this->session->userdata('is_logged_in')) {
		
		
			$this->load->model('model_sorteios');
				
			if (!$a || $a == 'ativos') { $a = 'ativos'; $my_select['menu2_selected1'] = 'selected'; }
			
			elseif ($a == 'terminados') $my_select['menu2_selected2'] = 'selected';
			
			elseif ($a == 'distribuicao') $my_select['menu2_selected4'] = 'selected';
			
			
			
			$data['myinfo'] = $this->model_sorteios->get_stuff($a);
		
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
			
			$data2['title'] = $a;	
			$data2['selected2'] = "selected";
			$this->load->view('templates/header', $data2);
			
			$this->load->view('ecards_menu',$my_select);
			
			$this->load->view($a, $data);			
			$this->load->view('templates/footer');	

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	
	public function meus_ecards_old($a = NULL) {
	
		if ($this->session->userdata('is_logged_in')) {
		
		
			$this->load->model('model_sorteios');
				
			if (!$a) { $a = 'ativos'; }
			
			$data['myinfo'] = $this->model_sorteios->get_stuff($a);
							
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

			$data2['title'] = $a;	
			$data2['selected2'] = "selected";
			$this->load->view('templates/header', $data2);
			$this->load->view('ecards_menu');
			$this->load->view($a, $data);			
			$this->load->view('templates/footer');	

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	
	public function meu_fin($a = NULL) {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->model('model_sorteios');
				
			if (!$a) { $a = 'controle_pontos'; }
			
			
		
			$this->load->library("pagination");
			
			$config = array();
			
			if ($a == 'controle_pontos') {
				$config["base_url"] = base_url() . "index.php/main/meu_fin/controle_pontos";
				$config["total_rows"] = $this->model_sorteios->count_creditos();
				
				$data3['fin_selected1'] = "selected";
			} elseif ($a == 'rendimentos') {
				$config["base_url"] = base_url() . "index.php/main/meu_fin/rendimentos";
				$config["total_rows"] = $this->model_sorteios->count_prem_dilu();
				
				$data3['fin_selected2'] = "selected";
			}
			
			$config["per_page"] = 10;
			$config["uri_segment"] = 4;
			
			$config['first_link'] = 'Primeira';
			$config['last_link'] = 'Última';
			/*
			$config['first_tag_open'] = "<div style='background:red;'>";
			$config['first_tag_close'] = '</div>';
			*/
			$config['full_tag_open'] = "<div id='pagination'>";
			$config['full_tag_close'] = '</div>';

	 
			$this->pagination->initialize($config);
	 
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$data["results"] = $this->model_sorteios->get_fin($a, $config["per_page"], $page);
			
			$data["links"] = $this->pagination->create_links();
	 
			//$this->load->view("example1", $data);


			
			
			//$data['myinfo'] = $this->model_sorteios->get_fin($a);
			$data3['meu_saldo'] = $this->model_sorteios->get_saldo();
			
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
			
			//$data2['_title'] = $a;	
			$data2['selected3'] = "selected";

			$this->load->view('templates/header', $data2);
			$this->load->view('fin_menu',$data3);
			$this->load->view($a, $data);			
			$this->load->view('templates/footer');	

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	public function creditos() {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->model('model_sorteios');
			$data3['meu_saldo'] = $this->model_sorteios->get_saldo();
			
			$data3['fin_selected3'] = "selected";

			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

			//$data2['_title'] = 'Créditos';	
			$data2['selected3'] = "selected";
			$this->load->view('templates/header', $data2);
			$this->load->view('fin_menu', $data3);
			$this->load->view('creditos');			
			$this->load->view('templates/footer');	
			

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	
	public function creditos_process() {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->model('model_sorteios');
			$data3['meu_saldo'] = $this->model_sorteios->get_saldo();
			
			$data3['fin_selected3'] = "selected";

			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
			
			//$data2['_title'] = 'Créditos';	
			$data2['selected3'] = "selected";
			$this->load->view('templates/header', $data2);
			$this->load->view('fin_menu', $data3);
			$this->load->view('creditos_process');			
			$this->load->view('templates/footer');	
			

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	
	public function dados() {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->model('model_sorteios');
			$data3['meu_saldo'] = $this->model_sorteios->get_saldo();
			
			$this->load->model('model_users');
			$data4['result'] = $this->model_users->get_dados();			
			
			$data3['fin_selected4'] = "selected";

			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
			
			//$data2['_title'] = 'Meus dados';	
			$data2['selected3'] = "selected";
			$this->load->view('templates/header', $data2);
			$this->load->view('fin_menu', $data3);
			$this->load->view('dados', $data4);			
			$this->load->view('templates/footer');	
			

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
		
	}
	
	
	public function saques() {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->model('model_sorteios');
			$data3['meu_saldo'] = $this->model_sorteios->get_saldo();
			
			$this->load->model('model_users');

			$data4['banco'] = $this->model_users->get_banco();
			$data4['pergu'] = $this->model_users->get_del_dados();
			
			$data3['fin_selected5'] = "selected";
			$data4['meu_saldo'] = $data3['meu_saldo'];
			
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
			
			//$data2['_title'] = 'Meus dados';	
			$data2['selected3'] = "selected";
			$this->load->view('templates/header', $data2);
			$this->load->view('fin_menu', $data3);
			$this->load->view('saques', $data4);			
			$this->load->view('templates/footer');	
			

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
		
	}
	
	
	public function minha_rede() {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->model('model_sorteios');
			
			$data['rede'] = $this->model_sorteios->get_minha_rede();

			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
			
			//$data2['_title'] = 'Minha Rede';	
			$data2['selected4'] = "selected";
			
			$this->load->view('templates/header', $data2);
			
			$this->load->view('minha_rede', $data);
			$this->load->view('templates/footer');	

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
		
	public function validate_cupom() {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->library('form_validation');
		
			$this->form_validation->set_rules('cupom', 'Cupom', 'required|trim|xss_clean|min_length[7]|max_length[7]');
			$this->form_validation->set_message('required', 'Por favor, entre com o código do cupom de 7 dígitos.');
			
			if ($this->form_validation->run()) {
		
				$this->load->model('model_sorteios');
				
				if ($valor = $this->model_sorteios->checa_cupom()) {
				
					$data = array( 'ecards_msg' => 'Créditos adicionados com sucesso.<br>Você adicionou <strong>' . $valor . ' créditos.</strong>');
					$this->session->set_userdata($data);
					redirect('main/creditos');
					
				} else {
					$data = array( 'ecards_msg' => 'Problema ao adicionar créditos com cupom.' );
					$this->session->set_userdata($data);
					redirect('main/creditos');
				}
			
			
			} else $this->creditos();
		}		
	}
					
					
	public function validate_creditos() {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->library('form_validation');
		
			$this->form_validation->set_rules('cred_valor', 'Quantidade', 'required|trim|xss_clean|greater_than[9.99]|less_than[300.01]');
			$this->form_validation->set_rules('tipo', 'Quantidade', 'required');
			$this->form_validation->set_message('required', 'Por favor, entre com uma quantidade e escolha uma forma de pagamento.');
			$this->form_validation->set_message('greater_than', 'O valor deve ser maior que R$10,00 reais, e menor que R$300,00 reais.');
			$this->form_validation->set_message('less_than', 'O valor deve ser maior que R$10,00 reais, e menor que R$300,00 reais.');
			
			if ($this->form_validation->run()) {

				$this->load->model('model_sorteios');
				
				$cred_valor = $this->input->post('cred_valor');
				$tipo_cred = 'd';
				
				// gera referencia pgto // verificar double
				$referencia = $this->gera_id_ecard();
				$my_sess = array ( 	'referencia' => $referencia	);
				$this->session->set_userdata($my_sess);		


				if ($this->model_sorteios->add_credits($this->session->userdata('log_user_id'),$tipo_cred,$cred_valor)) {
											
					// send email, u added such credits, please complete payment and wait for approval

					// get email if exists
					$this->db->select('email, email_tipo');
					$this->db->where('user_id', $this->session->userdata('log_user_id'));
					$this->db->where('status', '');
					$query = $this->db->get('users');
				
					if ($query->num_rows() > 0) {

						$row = $query->row();
						$email_tipo = $row->email_tipo;
						
						if ($email_tipo == "p" || $email_tipo == "r") {
						
							$email = $row->email;

							$this->load->library('email', array('mailtype' => 'html'));
							$this->email->from('info@webecard.net', 'WEBECARD.net');
							$this->email->to($email);
							$this->email->subject('Recarga WEBECARD.net');
							
							$message = "<p><img src='" . base_url() . "assets/images/logo.jpg' alt='Logomarce WEBECARD.net'></p><br>";
							$message .= "<h3>Recarga WEBECARD.net</h3><br>";
							$message .= "<p>Você adicionou R$" . $cred_valor . ",00 reais em créditos.</p><br>";
							$message .= "<p>Por favor, complete o pagamento caso ainda não tenha realizado e aguarde a aprovação.</p><br>";
							$message .= "<p>Obrigado por participar da Rede <a href='" . base_url() . "'> WEBECARD.net </a></p>";
						
							$this->email->message($message);
							$this->email->send();
						}
					}
					
					$data = array( 	'tipo' => $this->input->post('tipo'),
									'cred_valor' => $cred_valor
									);
					$this->session->set_userdata($data);
					
					$tipo = $this->input->post('tipo');
					
					if ($tipo == 's') {
						
						$referencia = $this->session->userdata('referencia');

						header( 'Location:' . base_url() . 'assets/admin/ps/ps_pgto.php?r=' . $referencia );
					} else 
						redirect('main/creditos_process');
										
					
				} else {
					$data = array( 'ecards_msg' => 'Problema ao adicionar créditos.' );
					$this->session->set_userdata($data);
					redirect('main/creditos');
				}
			} else {
				//$data = array( 'ecards_msg' => 'ops.' );
				//$this->session->set_userdata($data);
				$this->creditos();
			}
			
		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	
	public function ecards_divu() {
	
		if ($this->session->userdata('is_logged_in')) {
					
			// usado funcao gera_array
			$this->load->model('model_sorteios');

			//$data['user_id'] = $this->session->userdata('log_user_id');
			
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header');

			$data2['selected2'] = "selected";
			$data2['n_e_header'] = true;
			$data2['form_val'] = 1;
			//$this->load->view('n_e_header', $data2); // old
			$this->load->view('templates/header', $data2);
			
			$my_select['menu2_selected5'] = 'selected';
			$this->load->view('ecards_menu',$my_select);
			
			//$this->load->view('ecards_divu', $data);
			$this->load->view('ecards_divu');
			$this->load->view('templates/footer');	
			

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	public function novos_ecards() {
	
		if ($this->session->userdata('is_logged_in')) {
			
			// usado funcao gera_array
			$this->load->model('model_sorteios');

			//$data['user_id'] = $this->session->userdata('log_user_id');
			
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header');
		
			$data2['selected2'] = "selected";
			$data2['n_e_header'] = true;
			$data2['form_val'] = 1;
			//$this->load->view('n_e_header', $data2); // old
			$this->load->view('templates/header', $data2);
			
			$my_select['menu2_selected3'] = 'selected';
			$this->load->view('ecards_menu',$my_select);

			//$this->load->view('novos_ecards', $data);
			$this->load->view('novos_ecards');
			$this->load->view('templates/footer');	
			

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	public function login_validation()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('user_name', 'Nome de Usuário', 'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('pw', 'Senha', 'required|md5');
		
		if ($this->form_validation->run()) {
			$data = array(
							'log_user_name' => ucfirst(strtolower($this->input->post('user_name'))),
							'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			
			if ($this->session->userdata('redirect')) redirect($this->session->userdata('redirect')); 
			else
			redirect('main/');	
		} else {
			$this->login();
		}
		
	}
	
	

	public function validate_cpf() {
	
		$this->load->model('model_users');
		
		$data = $this->model_users->checa_cpf_erro();
		
		if (!$data['erro']) return true;
			
		else {
			$this->form_validation->set_message('validate_cpf' , $data['erro'] ); 
			return false;
		}
	
	}
	
	public function validate_cpf_formato() {
	
		$cpf = $this->input->post('cpf');
		
		// determina um valor inicial para o digito $d1 e $d2
		// pra manter o respeito ;)
		$d1 = 0;
		$d2 = 0;
		// remove tudo que não seja número
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		// lista de cpf inválidos que serão ignorados
		$ignore_list = array(
		'00000000000',
		'01234567890',
		'11111111111',
		'22222222222',
		'33333333333',
		'44444444444',
		'55555555555',
		'66666666666',
		'77777777777',
		'88888888888',
		'99999999999'
		);
		// se o tamanho da string for dirente de 11 ou estiver
		// na lista de cpf ignorados já retorna false
		if(strlen($cpf) != 11 || in_array($cpf, $ignore_list)){
		$this->form_validation->set_message('validate_cpf_formato' , 'CPF Formato Inválido (1)');
		return false;
		} else {
		// inicia o processo para achar o primeiro
		// número verificador usando os primeiros 9 dígitos
		for($i = 0; $i < 9; $i++){
		// inicialmente $d1 vale zero e é somando.
		// O loop passa por todos os 9 dígitos iniciais
		$d1 += $cpf[$i] * (10 - $i);
		}
		// acha o resto da divisão da soma acima por 11
		$r1 = $d1 % 11;
		// se $r1 maior que 1 retorna 11 menos $r1 se não
		// retona o valor zero para $d1
		$d1 = ($r1 > 1) ? (11 - $r1) : 0;
		// inicia o processo para achar o segundo
		// número verificador usando os primeiros 9 dígitos
		for($i = 0; $i < 9; $i++) {
		// inicialmente $d2 vale zero e é somando.
		// O loop passa por todos os 9 dígitos iniciais
		$d2 += $cpf[$i] * (11 - $i);
		}
		// $r2 será o resto da soma do cpf mais $d1 vezes 2
		// dividido por 11
		$r2 = ($d2 + ($d1 * 2)) % 11;
		// se $r2 mair que 1 retorna 11 menos $r2 se não
		// retorna o valor zeroa para $d2
		$d2 = ($r2 > 1) ? (11 - $r2) : 0;
		// retona true se os dois últimos dígitos do cpf
		// forem igual a concatenação de $d1 e $d2 e se não
		// deve retornar false.
		//return (substr($cpf, -2) == $d1 . $d2) ? true : false;
		
		if (substr($cpf, -2) == $d1 . $d2) return true; 
		else {
		$this->form_validation->set_message('validate_cpf_formato' , 'CPF Formato Inválido (2)');
		return false;
		}
		}
	
	}
	
	public function validate_user_name() {
	
		//if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!_]{6,25}$/', $this->input->post('user_name'))) {
		if(!preg_match('/^(?=.*[A-Za-z])[0-9A-Za-z!_]{6,25}$/', $this->input->post('user_name'))) {
			/*
			Between Start -> ^
			And End -> $
			of the string there has to be at least one number -> (?=.*\d)
			and at least one letter -> (?=.*[A-Za-z])
			and it has to be a number, a letter or one of the following: !@#$% -> [0-9A-Za-z!@#$%]
			and there have to be 8-12 characters -> {6,25}
			*/

		//if (!preg_match('/^(?=[^\._]+[\._]?[^\._]+$)[\w\.]{5,25}$/', $this->input->post('user_name'))) { // '/[^a-z\d]/i' should also work.

			$this->form_validation->set_message('validate_user_name' , 'Nome de Usuário irregular, escolha outro por favor.');
			return false;
			
		} else return true;
	
	}
	
	public function validate_senha() {

		if(!preg_match('/^(?=.*\d)[0-9A-Za-z!_#@]{6,25}$/', $this->input->post('pw'))) {

		/*
			Between Start -> ^
			And End -> $
			of the string there has to be at least one number -> (?=.*\d)
			and at least one letter -> (?=.*[A-Za-z])
			and it has to be a number, a letter or one of the following: !@#$% -> [0-9A-Za-z!@#$%]
			and there have to be 8-12 characters -> {6,25}
			*/
		//if (!preg_match('/^(?=[^\._]+[\._]?[^\._]+$)[\w\.]{5,25}$/', $this->input->post('pw'))) { // '/[^a-z\d]/i' should also work.

			$this->form_validation->set_message('validate_senha' , 'Senha irregular, escolha outra por favor.');
			return false;
			
		} else return true;
	
	}
	
	
	public function validate_email_tipo() {
	
		if ($this->input->post('email_tipo') == 'n') return true;
		
		else {
			$em = $this->input->post('email');
			if (empty($em)) {
			
				$this->form_validation->set_message('validate_email_tipo' , 'O campo Email não pode estar vazio neste tipo de email.');
				return false;
				
			} else return true;
			
		}
	
	}
	
	public function validate_email_p_unique() {
			
		$this->load->model('model_users');
		
		$em = $this->input->post('email');
		$b4_em = $this->input->post('b4_email');
		
		if ($b4_em == $em) return true;
		
		if ($this->model_users->p_unique()) {
			$this->form_validation->set_message('validate_email_p_unique' , 'Email próprio já cadastrado, recupere sua senha!.');
			return false;
		} 
		
		else return true;
	}
	
	// recebe dos 2 logins, simples e recom, ja com user_id definida.
	
	public function rede_picked($new_user_id) {
	
		$this->load->model('model_users');
		
		// se email tipo = p, utiliza email normal. Deve confirmar email e cadastro.
		if ($this->session->userdata('reg_email_tipo') == 'p') {
		
			// generate random key
			$key = md5(uniqid());
		
			// envia email
			$this->load->library('email', array('mailtype' => 'html'));
			$this->email->from('info@webecard.net', 'WEBECARD.net');
			$this->email->to($this->session->userdata('reg_email'));
			$this->email->subject('Confirmação de Cadastro WEBECARD.net');
			
			$message = "<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>";
			$message .= "<p><img src='" . base_url() . "assets/images/logo.jpg' alt='Logomarca WEBECARD.net'></p><br>";
			$message .= "<h3>Confirmação de Cadastro WEBECARD.net</h3><br>";
			$message .= "<p> <a href='" . base_url() . "index.php/main/register_user/$key'> Confirmar Cadastro </a> </p><br>";
			$message .= "<p> Por favor, desconsidere este email caso não tenha solicitado nenhum cadastro.</p><br>";
			$message .= "<p> Grato, <a href='" . base_url() . "'> WEBECARD.net </a></p>";
			$message .= "</div>";

			$this->email->message($message);

			// checa se adiciona, envia email
			if ($this->model_users->add_user_reg($key,$new_user_id)) {
		
				if ($this->email->send()) {
				
					$data = array( 'cad_msg' => 'Cadastro realizado com sucesso, por favor verifique sua conta através do email que lhe foi enviado.' );
					$this->session->set_userdata($data);
					redirect('main/cad_conf');

				} else {
				
					$data = array( 'cad_msg' => 'Cadastro Ok, problema ao enviar email.' );
					$this->session->set_userdata($data);
					redirect('main/cad_conf');
				}
			} else {
					$data = array( 'cad_msg' => 'Problema ao adicionar novo usuário. Tente novamente.' );
					$this->session->set_userdata($data);
					redirect('main/cad_conf');
			}
		
			} else {
				// se nao utiliza email proprio, key = 1 pra uso futuro
				$key = 1;
				// sem email
				if ($this->model_users->add_user_reg($key,$new_user_id)) {
									
					$data = array( 	'cad_msg' => 'Cadastro realizado com sucesso.',
					
									'log_user_name' => ucfirst(strtolower($this->session->userdata('reg_user_name2'))),
									'is_logged_in' => 1,
									'log_user_id' => $new_user_id );
					// login session
					$this->session->set_userdata($data);
					
					$this->session->unset_userdata('reg_user_name2');

					redirect('main/cad_conf');
					
				} else {
					$data = array( 'cad_msg' => 'Problema ao adicionar novo usuário.' );
					$this->session->set_userdata($data);
					redirect('main/cad_conf');
				}

		
			}
	}
		
	
	public function signup_basic_validation() {
	
		$this->session->unset_userdata('is_logged_in');
	
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('user_name', 'Nome de Usuário', 'required|trim|is_unique[users.user_name]|xss_clean|callback_validate_user_name');
		//$this->form_validation->set_rules('cpf', 'CPF', 'required|trim|callback_validate_cpf|callback_validate_cpf_formato'); //|callback_validate_cpf_formato
		$this->form_validation->set_rules('email_tipo', 'Email Tipo', 'callback_validate_email_tipo'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_validate_email_p_unique'); // |is_unique[users.email] retirado, email recado pode duplicar e cpf faz unico cadastro
		$this->form_validation->set_rules('pw', 'Senha', 'required|callback_validate_senha'); //|callback_validate_senha
		$this->form_validation->set_rules('rpw', 'Repetir Senha', 'required|matches[pw]');
		$this->form_validation->set_rules('perg', 'Pergunta Secreta', 'required|trim|min_length[10]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('resp', 'Resposta Secreta', 'required|trim|min_length[3]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('cel', 'Celular', 'trim');
		
		
		if ($this->form_validation->run()) {
			
			//$cpf = $this->input->post('cpf');
			//$cpf = preg_replace("/[^0-9]/", "", $cpf);
		
			$data = array(	'reg_user_name' => ucfirst(strtolower($this->input->post('user_name'))),
							//'reg_cpf' => $cpf, 
							'reg_email' => $this->input->post('email'), 
							'reg_email_tipo' => $this->input->post('email_tipo'), 
							'reg_pw' => $this->input->post('pw'), 
							'reg_perg' => $this->input->post('perg'),
							'reg_resp' => $this->input->post('resp'), 
							'reg_cel' => $this->input->post('cel') );
			$this->session->set_userdata($data);

			$this->load->model('model_users');
			
			// checa se cpf ja existe e dar opcoes e atualiza ecards, ou simplesmente cadastra
			/*
			if ($data2 = $this->model_users->checa_cpf()) {			
				
				$data = array(	'ja_cpf' => 1 );
				$this->session->set_userdata($data);

				$data['title'] = 'Escolha uma Rede';

				$this->load->view('templates/header', $data);
				$this->load->view('pick_rede', $data2);
				$this->load->view('templates/footer');	
				
			} else {
			*/
				$this->load->model('model_users');
				$novo_user_id = $this->model_users->novo_usuario( $this->input->post('rede') );	
				$this->rede_picked($novo_user_id);
			//}
			
		} else $this->signup_basic();
		
	}
			
				
	
	public function muda_senha_validation() {
	
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('pw', 'Senha', 'required|callback_validate_senha'); //|callback_validate_senha
		$this->form_validation->set_rules('rpw', 'Repetir Senha', 'required|matches[pw]');
		
		
		if ($this->form_validation->run()) {
		
		$this->load->model('model_users');
			
		if ($this->model_users->check_senha()) {
			
			if ($this->model_users->nova_senha()) {
			
				$data = array( 'ecards_msg' => 'Senha alterada com sucesso.' );
				$this->session->set_userdata($data);
				redirect('main/dados');
			} else {				
				$data = array( 'ecards_msg' => 'Problema ao alterar senha.' );
				$this->session->set_userdata($data);
				redirect('main/dados');
			}
			
		} else {				
			$data = array( 'ecards_msg' => 'Senha atual incorreta.' );
			$this->session->set_userdata($data);
			redirect('main/dados');
		}
		
		} else $this->dados();
		
	}
	
			
	public function muda_perg_validation() {
	
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('n_perg', 'Pergunta Secreta', 'required|trim|min_length[10]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('n_resp', 'Resposta Secreta', 'required|trim|min_length[3]|max_length[255]|xss_clean');
		
		
		if ($this->form_validation->run()) {
		
		$this->load->model('model_users');
			
		if ($this->model_users->check_resp()) {

			
			if ($this->model_users->nova_resp()) {
			
				$data = array( 'ecards_msg' => 'Pergunta secreta alterada com sucesso.' );
				$this->session->set_userdata($data);
				redirect('main/dados');
			} else {				
				$data = array( 'ecards_msg' => 'Problema ao alterar pergunta secreta.' );
				$this->session->set_userdata($data);
				redirect('main/dados');
			}
			
		} else {				
			$data = array( 'ecards_msg' => 'Resposta atual incorreta.' );
			$this->session->set_userdata($data);
			redirect('main/dados');
		}
	
		} else $this->dados();
		
	}
	
			
	public function muda_banco_validation() {
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('b_paypal', 'Email Paypal', 'valid_email');
		$this->form_validation->set_rules('b_pagseg', 'Email PagSeguro', 'valid_email');
		//$this->form_validation->set_rules('cpf', 'CPF', 'trim|callback_validate_cpf|callback_validate_cpf_formato'); //|callback_validate_cpf_formato

		if ($this->form_validation->run()) {
		
		
			$this->load->model('model_users');
							
			if ($this->model_users->novo_banco()) {
			
				$data = array( 'cad_msg' => 'Banco atualizado com sucesso.' );
				$this->session->set_userdata($data);
				redirect('main/saques');
			} else {				
				$data = array( 'cad_msg' => 'Problema ao atualizar banco.' );
				$this->session->set_userdata($data);
				redirect('main/saques');
			}
		} else $this->saques();
		
	}
	
			
	public function muda_dados_validation() {	// muda email, email tipo, celular
	
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email_tipo', 'Email Tipo', 'callback_validate_email_tipo'); 
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_validate_email_p_unique'); // |is_unique[users.email] retirado, email recado pode duplicar e cpf faz unico cadastro
		$this->form_validation->set_rules('cel', 'Celular', 'trim');
		
		
		if ($this->form_validation->run()) {
		
		if ($this->input->post('email') != $this->input->post('b4_email') ||
			$this->input->post('email_tipo') != $this->input->post('b4_email_tipo') ||
			$this->input->post('cel') != $this->input->post('b4_cel')) {

			$this->load->model('model_users');
			
			if (	$this->input->post('email_tipo') == 'p' and 
					$this->input->post('email') != $this->input->post('b4_email') ||
					$this->input->post('email_tipo') != $this->input->post('b4_email_tipo')	) {
			
				// generate random key
				$key = md5(uniqid());
			
				// envia email
				$this->load->library('email', array('mailtype' => 'html'));
				$this->email->from('info@webecard.net', 'WEBECARD.net');
				$this->email->to($this->input->post('email'));
				$this->email->subject('Alteração de Email');

				$message = "<div style='font-family: Verdana, Geneva, sans-serif; color:gray;'>";
				$message .= "<p><img src='" . base_url() . "assets/images/logo.jpg' alt='Logomarca WEBECARD.net'></p><br>";
				$message .= "<h3>Alteração de Email</h3>";
				$message .= "<p> <a href='" . base_url() . "index.php/main/alt_email/$key'> Confirmar Email </a> </p>";
				$message .= "</div>";
			
				$this->email->message($message);

				// checa se adiciona, envia email
				if ($this->model_users->alt_user($key)) {
			
					if ($this->email->send()) {
					
						$data = array( 'ecards_msg' => 'Dados alterados com sucesso, acesse seu email para confirmar.' );
						$this->session->set_userdata($data);
						redirect('main/dados');

					} else {
					
						$data = array( 'ecards_msg' => 'Problema ao enviar email de confirmação, tente novamente.' );
						$this->session->set_userdata($data);
						redirect('main/dados');
					}
				} else {
						$data = array( 'ecards_msg' => 'Problema ao alterar dados...' );
						$this->session->set_userdata($data);
						redirect('main/dados');
				}
			
				} else {
					// se nao utiliza email proprio, key = 1 pra uso futuro
					$key = 1;
					// sem email
					if ($this->model_users->alt_user($key)) {
										
						$data = array( 	'ecards_msg' => 'Dados alterados com sucesso.' );
						$this->session->set_userdata($data);
						redirect('main/dados');
						
					} else {
						$data = array( 'ecards_msg' => 'Problema ao alterar Dados.' );
						$this->session->set_userdata($data);
						redirect('main/dados');
					}
				}
		} else {				
			$data = array( 'ecards_msg' => 'Sem necessidade de alteração...' );
			$this->session->set_userdata($data);
			redirect('main/dados');
		}

		
		
		} else $this->dados();
		
	}
			
	public function signup_recom_validation() {
	
		$this->session->unset_userdata('is_logged_in');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('user_name', 'Nome de Usuário', 'required|trim|is_unique[users.user_name]|xss_clean|callback_validate_user_name');
		//$this->form_validation->set_rules('cpf', 'CPF', 'required|trim|callback_validate_cpf|callback_validate_cpf_formato'); //|callback_validate_cpf_formato
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_validate_email_p_unique'); // |is_unique[users.email] retirado, email recado pode duplicar e cpf faz unico cadastro
		$this->form_validation->set_rules('email_tipo', 'Email Tipo', 'callback_validate_email_tipo'); 
		$this->form_validation->set_rules('pw', 'Senha', 'required|callback_validate_senha'); //|callback_validate_senha
		$this->form_validation->set_rules('rpw', 'Repetir Senha', 'required|matches[pw]');
		$this->form_validation->set_rules('perg', 'Pergunta Secreta', 'required|trim|min_length[10]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('resp', 'Resposta Secreta', 'required|trim|min_length[3]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('cel', 'Celular', 'trim');
		
		
		if ($this->form_validation->run()) {

			//$cpf = $this->input->post('cpf');
			//$cpf = preg_replace("/[^0-9]/", "", $cpf);
			
			//echo $cpf . " < here 2"; exit();
		
			$data = array(	'reg_user_name' => ucfirst(strtolower($this->input->post('user_name'))),
							//'reg_cpf' => $cpf, 
							'reg_email' => $this->input->post('email'), 
							'reg_email_tipo' => $this->input->post('email_tipo'), 
							'reg_pw' => $this->input->post('pw'), 
							'reg_perg' => $this->input->post('perg'),
							'reg_resp' => $this->input->post('resp'), 
							'reg_cel' => $this->input->post('cel') );
			$this->session->set_userdata($data);

			// get novo usuario id
			/*
			if ($this->session->userdata('ja_cpf') == 1) {
			
					$this->rede_picked($this->session->userdata('new_user_id'));
					
			} else { // elseif ($this->session->userdata('conf_dist') == 1) {
			*/
					$this->load->model('model_users');
					$novo_user_id = $this->model_users->novo_usuario( $this->session->userdata('distribuicao') );	
					$this->rede_picked($novo_user_id);
					
			//}
						
		} else $this->signup_recom();
		
	}
			
	
	// valida o form do ecard
	public function ecardscheck_validation() {
	
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('id_ecard', 'ID E-Card', 
		'required|trim|min_length[12]|max_length[12]|xss_clean');
		
		if ($this->form_validation->run()) {
		
			$this->load->model('model_sorteios');			

			// traz os resultados do id_ecard
			$data = $this->model_sorteios->busca_ecard();						
					
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
			
			//$data2['_title'] = "Busca E-Cards";			
			$this->load->view('templates/header', $data2);
			// chama a pagina ecardscheck com as variaveis do resultado
			$this->load->view('ecardscheck', $data);
			$this->load->view('templates/footer');	
		}
		else {
			$this->ecardscheck();
			}
	}	
	
	
	
	// valida se usuario entra com a user_name correta, cartela paga
	public function user_name_validation() {
	
		//checa se user id confere
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name_chk', 'Nome de Usuário', 'required|trim');
		if ($this->form_validation->run()) {
			
			// pega user id e compara
			
			$user_name_chk = ucfirst(strtolower($this->input->post('user_name_chk')));
			
			if ($this->session->userdata('user_name') == $user_name_chk) {
			
				// se sim, leva pra sign up ja pre-preenchida

				$data = array( 'conf_dist' => 1 ); // ecards nomeados novo user_id ja existe
				$this->session->set_userdata($data);
				$this->signup_recom();
			
			} else {
			
				// se nao, volta mesma tela com msg e incentiva a registrar sem a cartela paga ou tentar novamente
				$data = array( 'ecards_msg' => 'Nome de Usuário Inválido.' );
				$this->session->set_userdata($data);

				$this->session->unset_userdata('conf_dist');
				redirect('main/ecardscheck');

			}
		}
	}
	
	
	// valida se usuario entra com o cpf correto, cartela paga e com nome
	public function cpf_validation() {
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cpf', 'CPF', 'required|trim|callback_validate_cpf|callback_validate_cpf_formato');
		//$this->form_validation->set_rules('cpf', 'CPF', 'required|trim|callback_validate_cpf|callback_validate_cpf_formato'); //|callback_validate_cpf_formato

		if ($this->form_validation->run()) {
		
			$this->load->model('model_users');
			
			$data = $this->model_users->get_cpf();
			
			if ($data['new_user_id']) {
			
				// se sim, leva pra sign up ja pre-preenchida
				$data = array( 	'ja_cpf' => 1, 
								'new_user_id' => $data['new_user_id'], 
								'reg_cpf' => $data['cpf'] 	); 								
				$this->session->set_userdata($data);				
				redirect('main/signup_recom');
			
			} else {
				// se nao, volta mesma tela com msg e incentiva a registrar sem a cartela paga ou tentar novamente
				$data = array( 	'ecards_msg' => "CPF Inválido, tente novamente.1"	); 								
				$this->session->set_userdata($data);
				
				$this->session->unset_userdata('ja_cpf');
				redirect('main/ecardscheck');

			}
		} else {
				// se nao, volta mesma tela com msg e incentiva a registrar sem a cartela paga ou tentar novamente
				$data = array( 	'ecards_msg' => "CPF Inválido, tente novamente.2"	); 								
				$this->session->set_userdata($data);
				//redirect('main/ecardscheck');
				$this->ecardscheck();
				}
	}
	
	
	// simplesmente chama a pagina ecardscheck
	public function ecardscheck() {
			
		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data['_title'] = "Busca E-Cards";
		$data['selected5'] = "selected";

		$this->load->view('templates/header', $data);
		$this->load->view('ecardscheck', $data);
		$this->load->view('templates/footer');	

	}
	
		
	public function signup_recom() {
	
		$this->session->unset_userdata('is_logged_in');
		$this->session->unset_userdata('log_user_name');
		$this->session->unset_userdata('log_user_id');

		$this->load->model('model_sorteios');
		$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data2['_title'] = "Criar Conta!";
		
		$data2['form_val'] = 1;
		
		$data['rede'] = $this->session->userdata('rede_user_name');
		
		$this->load->view('templates/header', $data2);
		$this->load->view('signup_recom', $data);
		$this->load->view('templates/footer');	

	}
	
	public function signup_basic() {
			
		$this->load->model('model_sorteios');
		$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
		
		//$data2['_title'] = "Criar Conta!";
		
		// busca ultimo
		$this->load->model('model_users');
		
		if ($this->session->userdata('my_recom')) {
			
			$data = $this->model_users->get_id($this->session->userdata('my_recom'));
			$data['user_name'] = $this->session->userdata('my_recom');
			
		} else $data = $this->model_users->get_last_id();
		
		$data2['form_val'] = 1;
		
		$this->load->view('templates/header', $data2);
		$this->load->view('signup_basic', $data);
		$this->load->view('templates/footer');	

	}
	
	
	public function register_user($key) {
		
		$this->load->model('model_users');
		
		if ($this->model_users->is_key_valid($key)) {
		
			if ($data3 = $this->model_users->add_user($key)) {
					
			//$this->session->sess_destroy();

			$data2 = array( 'log_user_name' => $data3['user_name'],
							'is_logged_in' => 1,
							'log_user_id' => $data3['user_id'] );
			// login session
			$this->session->set_userdata($data2);

				
				$data = array( 'cad_msg' => 'Sua conta foi confirmada, você está logado!' );
				$this->session->set_userdata($data);
				redirect('main/cad_conf');
				
				// send email welcome
			
			} else {			
				$data = array( 'cad_msg' => 'Problema ao confirmar usuário!' );
				$this->session->set_userdata($data);
				redirect('main/cad_conf');
				}
		} else {
			// erro
				$data = array( 'cad_msg' => 'Chave de confirmação de cadastro inválida!' );
				$this->session->set_userdata($data);
				redirect('main/cad_conf');
		}
	
	}
	
	public function alt_email($key) {
		
		$this->load->model('model_users');
		
		if ($this->model_users->is_key_valid($key)) {
		
			if ($this->model_users->alt_email_user($key)) {
								
				$data = array( 'ecards_msg' => 'Email confirmado e alterado com sucesso!' );
				$this->session->set_userdata($data);
				redirect('main/dados');
				
			} else {			
				$data = array( 'ecards_msg' => 'Problema ao confirmar email' );
				$this->session->set_userdata($data);
				redirect('main/dados');
				}
		} else {
			// erro
				$data = array( 'ecards_msg' => 'Chave de confirmação inválida!' );
				$this->session->set_userdata($data);
				redirect('main/dados');
		}
	
	}
	
	public function validate_credentials() 
	{
		$this->load->model('model_users');
		
		if ($this->model_users->can_log_in()){
		
			if ($data3 = $this->model_users->log_in_user_id()) {
			$data2 = array( 'log_user_id' => $data3['user_id'] );
			$this->session->set_userdata($data2);
			
			return true;
			}
			else return false;
		} else {
			$this->form_validation->set_message('validate_credentials' , 'Usuário/Senha Incorreto.');
			return false;
		}
		
		
	}
	
	public function logout() {
		
		$this->load->model('model_users');
		$this->model_users->update_lang();
		
		
		$this->session->sess_destroy();
		
		// does not work below...
		//$data = array( '_lang' => $this->model_users->get_lang() );
		//$this->session->set_userdata($data);
	
		//print_r($this->session->all_userdata());
		//exit();
	
		redirect('main/login');
	}
	
	
	public function validate_novos_ecards() {
	
		if(count($this->input->post()) == 12) { // 12 = total de posts qd vazio.
		
			$this->form_validation->set_message('validate_novos_ecards' , 'Você não selecionou nenhum.');
			return false;
		}
		else return true;
	}
		
		
	public function n_ecards_validation() {
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('numeros', 'E-Card', 'callback_validate_novos_ecards');
		if ($this->form_validation->run()) {

			$this->load->model('model_sorteios');
			
			for ($leo = 0; $leo < 5; $leo ++) {		
		
				if ($this->input->post('ecards' . $leo)) {
				
				//echo $this->input->post('ecards' . $leo) . "<br>";
				
					$ecards = $this->input->post('ecards' . $leo);
					
					$distribuicao = $this->input->post('distribuicao' . $leo);	
					
					// create codigo ecard
					$new_id_ecard = $this->gera_id_ecard();
					//echo $new_id_ecard;
					
					// get design and sentence
					//$new_sentence = get_sentence();
					$new_sentence = "1";
					$new_design = $this->input->post('new_design' . $leo);
					
					
					// add to db
					if ($this->model_sorteios->add_new_ecard
					($this->session->userdata('log_user_id'), $ecards, $new_id_ecard, $new_sentence, $new_design, $distribuicao)) {
					}
					else {
						echo "falha na funcao add_new_ecard, id_ecard duplicado";
					}

				}
			}
			$data = array( 'ecards_msg' => 'E-Card(s) criado(s) com sucesso.' );
			$this->session->set_userdata($data);
			redirect('main/novos_ecards');
		}
		else {
			$this->novos_ecards();
		}

	}
		
		
	public function validate_novo_ecard() {
	
		$numeros = $this->input->post('numeros');
		if(!$numeros) {
		
			$data = array( 'ecards_msg' => 'Você não selecionou nenhum.' );
			$this->session->set_userdata($data);
			//$this->form_validation->set_message('validate_novo_ecard' , 'Você não selecionou nenhum.');
			return false;
		}
		elseif (count($this->input->post('numeros')) < 5) {
		
			$data = array( 'ecards_msg' => 'Você selecionou menos de 5 números.' );
			$this->session->set_userdata($data);
			//$this->form_validation->set_message('validate_novo_ecard' , 'Você selecionou menos de 5 números.');
			return false;
		}
		else return true;

	}

	
	public function n_ecard_divu_validation() {
	
		$p_ecard = $this->input->post('ecard');
		
		if (!$p_ecard) {		
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('numeros', 'E-Card', 'callback_validate_novo_ecard');
			if ($this->form_validation->run()) {

				$p_ecard = join(",", $this->input->post('numeros'));
				//print_r($numero_joint);
			}
			else redirect('main/ecards_divu'); 
			
			//$this->ecards_divu();
			
		}
		
				
		// nao mais distribuicao aqui	
		//$distribuicao = $this->input->post('distribuicao');
		$distribuicao = "s";
		
		$this->load->model('model_sorteios');
		// create codigo ecard
		$new_id_ecard = $this->gera_id_ecard();
		//echo $new_id_ecard;
		
		// get design and sentence
		//$new_sentence = get_sentence();
		$new_sentence = "1";
		$new_design = $this->input->post('new_design');
		

		$p_tipo = $this->input->post('tipo');
		
		if ($p_tipo == '4') {

			$this->load->library('form_validation');
			$this->form_validation->set_rules('cpf', 'CPF', 'required|trim|callback_validate_cpf|callback_validate_cpf_formato');
			
			if (!$this->form_validation->run()) {
			
				$data = array( 'ecards_msg' => 'CPF Formato Inválido.' );
				$this->session->set_userdata($data);
				redirect('main/ecards_divu');								
			}	
		
		}
			
		// add to db
		if ($this->model_sorteios->add_new_ecard
		($this->session->userdata('log_user_id'), $p_ecard, $new_id_ecard, $new_sentence, $new_design, $distribuicao)) {	
			
			
			if ($p_tipo != '1') {	
			
				// muda status //debita
				if ($this->validar_ecard($new_id_ecard,'n','s')) {
				
					if ($p_tipo == '3' || $p_tipo == '4') {
				
						// confirma id_ecard com data e se pode alterar
						if ($this->model_sorteios->conf_rep_id_ecard($new_id_ecard)) {
							
							if ($p_tipo == '4') {
							
								
									$p_cpf = $this->input->post('cpf');
								
									if ($p_cpf) {
								
										if ($this->model_sorteios->rep_cpf($new_id_ecard)) {
										
											$data = array( 'ecards_msg' => 'E-Card CPF repassado com sucesso.' );
											$this->session->set_userdata($data);
											redirect('main/ecards_divu');
										
										} else {
											$data = array( 'ecards_msg' => 'Problema ao repassar E-Card CPF.' );
											$this->session->set_userdata($data);
											redirect('main/ecards_divu');
											}
									} else {
											$data = array( 'ecards_msg' => 'O campo CPF não deve estar vazio.' );
											$this->session->set_userdata($data);
											redirect('main/ecards_divu');								
									}
							} 
							elseif ($p_tipo == '3') {
							
								$p_username = $this->input->post('username');
								
								if ($p_username) {
							
									if ($this->model_sorteios->rep_username($new_id_ecard)) {
									
										$data = array( 'ecards_msg' => 'E-Card Nome de Usuário repassado com sucesso.' );
										$this->session->set_userdata($data);
										redirect('main/ecards_divu');
									
									} else {
										$data = array( 'ecards_msg' => 'Nome de Usuário não encontrado.' );
										$this->session->set_userdata($data);
										redirect('main/ecards_divu');
										//$this->repasse($new_id_ecard);
										}
								} else {
										$data = array( 'ecards_msg' => 'O campo Nome de Usuário não deve estar vazio.' );
										$this->session->set_userdata($data);
										redirect('main/ecards_divu');								
								}
							}
						} else {
						
							$data = array( 'ecards_msg' => 'E-Card repasse não confirmado. Tente novamente.' );
							$this->session->set_userdata($data);
							redirect('main/ecards_divu');				
						}
					}
					
					
					$data = array( 'ecards_msg' => 'E-Card criado com sucesso.' ); // 'E-Card criado com sucesso.'.$p_tipo 
					$this->session->set_userdata($data);
					redirect('main/ecards_divu');
				}
				else {
					//$data = array( 'ecards_msg' => 'Falha ao validar ecard.' );
					//$this->session->set_userdata($data);
					
					// hack, deleta pra z o ecard criado qd saldo insuficiente... (ate arrumar)
					$this->load->model('model_users');
					$this->model_users->muda_status($new_id_ecard,'z','');
					
					redirect('main/ecards_divu');
				}
			} else {
				$data = array( 'ecards_msg' => 'E-Card não pago criado com sucesso.' );
				$this->session->set_userdata($data);
				redirect('main/ecards_divu');
			}
		}
		else {
			$data = array( 'ecards_msg' => 'Falha na função add_new_ecard, id_ecard duplicado.' );
			$this->session->set_userdata($data);
			redirect('main/ecards_divu');
		}


	}
		
	public function n_ecard_validation() {
	
		$p_ecard = $this->input->post('ecard');
		
		if (!$p_ecard) {		
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('numeros', 'E-Card', 'callback_validate_novo_ecard');
			if ($this->form_validation->run()) {

				$p_ecard = join(",", $this->input->post('numeros'));
				//print_r($numero_joint);
			}
			else redirect('main/novos_ecards'); 
			
			//$this->novos_ecards();
			
		}
		
		// nao mais distribuicao aqui	
		//$distribuicao = $this->input->post('distribuicao');
		$distribuicao = "";
		
		$this->load->model('model_sorteios');
		// create codigo ecard
		$new_id_ecard = $this->gera_id_ecard();
		//echo $new_id_ecard;
		
		// get design and sentence
		//$new_sentence = get_sentence();
		$new_sentence = "1";
		$new_design = $this->input->post('new_design');
			
		// add to db
		if ($this->model_sorteios->add_new_ecard
		($this->session->userdata('log_user_id'), $p_ecard, $new_id_ecard, $new_sentence, $new_design, $distribuicao)) {	
			
			
			// muda status
			if ($this->validar_ecard($new_id_ecard,'c','e')) {
				
				$p_naodatar = $this->input->post('naodatar');
				
				if ($p_naodatar != "n") { 
				
					// confirma id_ecard com data e se pode alterar
					if ($data = $this->model_sorteios->conf_add_id_ecard($new_id_ecard)) {
						
						$date = $this->input->post('date');
			
						// confirma data se < 1 dia etc...
						$tempo = $date . " 19:00:00";
						$days = $this->model_sorteios->get_time($tempo);
						
						// se days = 0, menos de 24 horas // mostrar a partir de sexta // mostrar a partir da proxima sexta
						if ($days) {	
						
							if ($this->model_sorteios->do_add_date($date, $new_id_ecard,1)) {
							
							$data = array( 'ecards_msg' => 'E-Card criado e datado com sucesso.' );
							$this->session->set_userdata($data);
							redirect('main/novos_ecards');
							
							} else return false;

						} else {
							$data = array( 'ecards_msg' => 'E-Card sem prazo para a data escolhida.' );
							$this->session->set_userdata($data);
							redirect('main/novos_ecards');
						}
				
					} else {
						$data = array( 'ecards_msg' => 'E-Card não confirmado. Tente novamente.' );
						$this->session->set_userdata($data);
						redirect('main/novos_ecards');
						
					}
				}

				
				$data = array( 'ecards_msg' => 'E-Card criado com sucesso.' );
				$this->session->set_userdata($data);
				redirect('main/novos_ecards');
			}
			else {
				//$data = array( 'ecards_msg' => 'Falha ao validar ecard.' );
				//$this->session->set_userdata($data);
				redirect('main/novos_ecards');
			}
		}
		else {
			redirect('main/novos_ecards');
		}


	}
		
		
	public function gera_id_ecard() {

		$id_ecard_rand = "";

		for ($leo = 0; $leo < 12; $leo ++) {

			$ecard_random = mt_rand(0,9);

			$id_ecard_rand .= $ecard_random;

		}
		return $id_ecard_rand;
	
	}

	public function aceitar($id_ecard) {
	
		if ($this->session->userdata('is_logged_in')) {
						
			$this->load->model('model_users');
			
			// duplica em aceito tipo = f
			$this->model_users->muda_status($id_ecard,'f','');

			// duplica para 'e'
			$this->model_users->muda_status($id_ecard,'e','');
			
			redirect('main/meus_ecards/ativos');
				
	
		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}

									// Meu c/e ou Dist. n/s
	public function validar_ecard($id_ecard,$tipo1,$tipo2) {
	
		if ($this->session->userdata('is_logged_in')) {
						
			$this->load->model('model_sorteios');
			
			// confirma id_ecard e debita
			if ($this->model_sorteios->conf_val_id_ecard($id_ecard,$tipo1,$tipo2)) {
			
				$data = array( 'ecards_msg' => 'E-Card validado com sucesso.' );
				$this->session->set_userdata($data);
				
				return true;
				}
			//if ($tipo1 == 'n') redirect('main/meus_ecards/distribuicao');
				
			//else redirect('main/novos_ecards');
				
		} else return false; 
	}


/*
	public function repasse_old($id_ecard) {
		
		if ($this->session->userdata('is_logged_in')) {
							
				$this->load->model('model_sorteios');
				$data = $this->model_sorteios->get_ecard($id_ecard);
				
				$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
				
				//$data2['_title'] = 'Repasse de E-Card';			
				$this->load->view('templates/header', $data2);
				$this->load->view('ecards_menu');
				
				$this->load->view('repasse_form', $data);
				$this->load->view('templates/footer');				

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
		
	}
*/

	public function validate_repasse() {
	
		if ($this->session->userdata('is_logged_in')) {
						
			$this->load->model('model_sorteios');
			
			$this->load->library('form_validation');
		
			$this->form_validation->set_rules('value', 'CPF ou Nome de Usuário', 'required|trim|xss_clean');
			$this->form_validation->set_rules('tipo', 'Tipo', 'required');
			$this->form_validation->set_message('required', 'Por favor, entre com o CPF ou Nome de Usuário e identifique o tipo.');
			
			if ($this->form_validation->run()) {
			
			// confirma id_ecard com data e se pode alterar
			if ($this->model_sorteios->conf_rep_id_ecard()) {
				
				
				if ($this->input->post('tipo') == 'cpf') {
				
					if ($this->model_sorteios->rep_cpf()) {
					
						$data = array( 'ecards_msg' => 'E-Card CPF repassado com sucesso.' );
						$this->session->set_userdata($data);
						redirect('main/meus_ecards/distribuicao');
					
					} else {
						$data = array( 'ecards_msg' => 'Problema ao repassar E-Card CPF.' );
						$this->session->set_userdata($data);
						redirect('main/meus_ecards/distribuicao');
						}
					
				} 
				elseif ($this->input->post('tipo') == 'username') {
				
					if ($this->model_sorteios->rep_username()) {
					
						$data = array( 'ecards_msg' => 'E-Card Nome de Usuário repassado com sucesso.' );
						$this->session->set_userdata($data);
						redirect('main/meus_ecards/distribuicao');
					
					} else {
						$data = array( 'ecards_msg' => 'Nome de Usuário não encontrado.' );
						$this->session->set_userdata($data);
						//redirect('main/meus_ecards/distribuicao');
						$this->repasse($this->input->post('id_ecard'));
						}
				
				}
				} else {
				
					$data = array( 'ecards_msg' => 'E-Card repasse não confirmado. Tente novamente.' );
					$this->session->set_userdata($data);
					redirect('main/meus_ecards/distribuicao');				
				}
			} else {
				$this->repasse($this->input->post('id_ecard'));				
			}
		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}


	public function add_date($id_ecard) {
		
		if ($this->session->userdata('is_logged_in')) {
							
				$this->load->model('model_sorteios'); //used on the view
				$data = $this->model_sorteios->get_ecard($id_ecard);
				
				$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

				//$data2['_title'] = 'Adicionar Data';			
				$this->load->view('templates/header', $data2);
				
				$selected['selected1'] = 'selected';
				$this->load->view('ecards_menu');

				$this->load->view('add_date_form', $data);
				$this->load->view('templates/footer');				

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
		
	}
	

	public function validate_add_date() {
	
		if ($this->session->userdata('is_logged_in')) {
						
			$this->load->model('model_sorteios');
			
			// confirma id_ecard com data e se pode alterar
			if ($data = $this->model_sorteios->conf_add_id_ecard($this->input->post('id_ecard'))) {
				
				$id_ecard = $this->input->post('id_ecard');
				$date = $this->input->post('date');
	
				// confirma data se < 1 dia etc...
				$tempo = $date . " 19:00:00";
				$days = $this->model_sorteios->get_time($tempo);
				
				// se days = 0, menos de 24 horas // mostrar a partir de sexta // mostrar a partir da proxima sexta
				if ($days) {	
				
					if ($this->model_sorteios->do_add_date($date, $id_ecard,1)) {
					$data = array( 'ecards_msg' => 'E-Card datado com sucesso.' );
					$this->session->set_userdata($data);
					redirect('main/meus_ecards/ativos');
					
					} else return false;

				} else {
					$data = array( 'ecards_msg' => 'E-Card sem prazo para a data escolhida.' );
					$this->session->set_userdata($data);
					redirect('main/meus_ecards/ativos');
				}
		
			} else {
				$data = array( 'ecards_msg' => 'E-Card não confirmado. Tente novamente.' );
				$this->session->set_userdata($data);
				redirect('main/meus_ecards/ativos');
				
			}
	
		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}

	
	public function alt_date($id_ecard) {
		
		if ($this->session->userdata('is_logged_in')) {
							
				$this->load->model('model_sorteios');
				// passa #data com sorteio_data do banco.
				$data = $this->model_sorteios->get_ecard($id_ecard);
				
				$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 
				
				//$data2['_title'] = 'Alteração de Datas';			
				$this->load->view('templates/header', $data2);
				$this->load->view('ecards_menu');
				
				$this->load->view('alt_date_form', $data);
				$this->load->view('templates/footer');				

		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	public function validate_alt_date() {
	
		if ($this->session->userdata('is_logged_in')) {
						
			$this->load->model('model_sorteios');
			
			// confirma id_ecard com data e se pode alterar
			if ($data = $this->model_sorteios->conf_alt_id_ecard($this->input->post('id_ecard'))) {
				
				$id_ecard = $this->input->post('id_ecard');
				$date = $this->input->post('date');
		
				// confirma data se < 7 dias etc...
				$tempo = $data['sorteio_data'] . " 19:00:00"; // o dia e hora atual, para o dia e hora desejada = $tempo
				$days = $this->model_sorteios->get_time($tempo);
				
				// se days = 0, menos de 24 horas // mostrar a partir de sexta // mostrar a partir da proxima sexta
				if ($days >= 7) {	
				
					if ($this->model_sorteios->do_add_date($date, $id_ecard,0)) {
					$data = array( 'ecards_msg' => 'E-Card alterado com sucesso.' );
					$this->session->set_userdata($data);
					redirect('main/meus_ecards/ativos');
					
					} else return false;

				} else {
					$data = array( 'ecards_msg' => 'E-Card sem prazo.' );
					$this->session->set_userdata($data);
					redirect('main/meus_ecards/ativos');
				}
		
			} else {
				$data = array( 'ecards_msg' => 'E-Card não confirmado. Tente novamente.' );
				$this->session->set_userdata($data);
				redirect('main/meus_ecards/ativos');
				
			}
	
		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	}
	
	public function resultados() {
	
		$this->load->model('model_sorteios');
		
		$get_all_results = "get_all_results_" . $this->session->userdata('_lang');
		$data = $this->model_sorteios->$get_all_results();
		
		$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data2['_title'] = "Login";	
		$this->load->view('templates/header', $data2);
		
		$this->load->view('resultados', $data);
		$this->load->view('templates/footer');	
	
	}
	
 
	public function delete() {
	
		$this->load->model('model_users');
		
		$data['pergu'] = $this->model_users->get_del_dados();
		
		$this->load->model('model_sorteios');
		$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data2['_title'] = "Deletar Conta";	
		$this->load->view('templates/header', $data2);
		
		$this->load->view('del', $data);
		$this->load->view('templates/footer');	
	
	}
	
 
	public function delete_validation() {
	
		$this->load->model('model_users');
		
		if ($this->model_users->del_dados()) {
		
			$this->session->unset_userdata('is_logged_in');
			
			$data = array( 'cad_msg' => 'Conta deletada. Será um prazer ter lhe de volta!' );
			$this->session->set_userdata($data);
			redirect('main/cad_conf');

		} else {
		
			redirect('main/delete');
		}
		
	
	}
	
	public function recup_senha() {
		
		$this->load->model('model_sorteios');
		$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data2['_title'] = "Recuperação de Senha";	
		
		//$this->load->model('model_users');
		//$data = $this->model_users->get_perg();
		
		$this->load->view('templates/header', $data2);
		//$this->load->view('recup_senha', $data);
		$this->load->view('recup_senha');
		$this->load->view('templates/footer');	
	
	}

	
	public function conta_validation() {
		
		$conta = $this->input->post('conta');

		if (empty($conta)) {
		
			$data = array( 'msg' => 'Campo Vazio!' );
			$this->session->set_userdata($data);
			redirect('main/recup_senha');
		}	
		elseif (strpos($conta,'@') !== false) {
		
			// EMAIL
			$this->load->model('model_users');
			
			// start_recup finds account by email if proprio
			// se sim, envia email para redefinicao de senha
			if ($this->model_users->start_recup_email()) {
			
				$data = array( 'msg' => 'Um email lhe foi enviado para a redefinição de senha.' );
				$this->session->set_userdata($data);
				redirect('main/recup_senha');
				
			} else redirect('main/recup_senha');
		}	
		elseif (strlen(preg_replace("/[^A-Za-z]/", "", $conta)) == 0 && strlen(preg_replace("/[^0-9]/", "", $conta)) == 11) {
			
			// CPF
			$this->load->model('model_users');
			
			// start_recup finds account by email if proprio
			// se sim, envia email para redefinicao de senha
			if ($data['perg'] = $this->model_users->start_recup_cpf()) {
			
				if ($data['perg'] != 1) {
				
					$this->load->model('model_sorteios');
					$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

					//$data2['_title'] = "Recuperação de Senha";	
					
					$this->load->model('model_users');
					
					$this->load->view('templates/header', $data2);
					$this->load->view('recup_senha', $data);
					$this->load->view('templates/footer');	
				
				} else {
					redirect('main/recup_senha');
				}

				
			} else redirect('main/recup_senha');
		
		}
		else { 		
		
			// NOME DE USUARIO
			$this->load->model('model_users');
			
			// start_recup finds account by email if proprio
			// se sim, envia email para redefinicao de senha
			if ($data['perg'] = $this->model_users->start_recup_username()) {
			
				if ($data['perg'] != 1) {
				
					$this->load->model('model_sorteios');
					$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

					//$data2['_title'] = "Recuperação de Senha";	
									
					$this->load->view('templates/header', $data2);
					$this->load->view('recup_senha', $data);
					$this->load->view('templates/footer');	
				
				} else {
					redirect('main/recup_senha');
				}

				
			} else redirect('main/recup_senha');
		
		}
	}


	public function recup_senha_validation() {
		
		// checa resp session, se sim update/insert key in db e envia pra form nova senha
		// se nao, pede de novo resp 
		
		if ($this->input->post('resp') == $this->session->userdata('resp')) {
		
			$this->load->model('model_users');
			
			if ($data = $this->model_users->update_key()) $this->redef_senha($data['key2']);
			
			else redirect('main/recup_senha');
		
		} else {
			$data = array( 'perg' => $this->input->post('perg'), 'msg' => 'Resposta incorreta, tente novamente.' );
			$this->session->set_userdata($data);
			$this->recup_senha();
			}

	
	}
	
	public function redef_senha($key) {
		
		$this->load->model('model_users');
		
		if ($this->model_users->is_key_valid($key)) {
		
			$this->load->model('model_sorteios');
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

			//$data2['_title'] = "Recuperação de Senha";	
			
			$data['key2'] = $key;
			//echo $data['key2'] . " < key"; exit();
			
			$this->load->view('templates/header', $data2);
			$this->load->view('recup_senha', $data);
			$this->load->view('templates/footer');	

		} else {
			// erro
			$data = array( 'cad_msg' => 'Chave de confirmação inválida!' );
			$this->session->set_userdata($data);
			redirect('main/cad_conf');
		}
	}
	
	

	public function nova_senha_validation() {
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('pw', 'Senha', 'required|callback_validate_senha'); //|callback_validate_senha
		$this->form_validation->set_rules('rpw', 'Repetir Senha', 'required|matches[pw]');
		
		if ($this->form_validation->run()) {
		
			$this->load->model('model_users');
			
			if ($data2 = $this->model_users->do_nova_senha()) {
					
				$data = array( 	'cad_msg' => 'Nova senha registrada com sucesso!',
				
								'log_user_name' => $data2['user_name'],
								'is_logged_in' => 1,
								'log_user_id' => $data2['user_id']
				);
				$this->session->set_userdata($data);
				redirect('main/cad_conf');
				
			} else {
				// erro
				$data = array( 'cad_msg' => 'Problema ao entrar nova senha, tente novamente!' );
				$this->session->set_userdata($data);
				redirect('main/cad_conf');
			}
		} else {
			$data = array( 'key' => $this->input->post('key_reg') );
			$this->session->set_userdata($data);
			$this->recup_senha();
			}
		
	}
	
	public function savefile() {
	
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
		header('Content-type: text/html');
		header('Content-Disposition: attachment; filename="table.html"');

		echo $_POST['content'];
		}
	}
	
	
	public function saque_validation() {
	
		$this->load->model('model_users');
		
		if ($this->model_users->do_saque()) {
					
			$data = array( 'cad_msg' => 'Pedido de Saque realizado com sucesso! Aguarde a confirmação.' );
			$this->session->set_userdata($data);
			redirect('main/saques');

		} else {
		
			redirect('main/saques');
		}
	}
	
	
	public function company() {
	
		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data['_title'] = "WEBECARD.net";
		
		$data['s_selected4'] = "selected";
		
		$this->load->view('templates/header', $data);
		$this->load->view('company', $data);
		$this->load->view('templates/footer');	

	}


	public function perg_resp() {
	
		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data['_title'] = "WEBECARD.net";
		
		$data['s_selected1'] = "selected";
		
		$this->load->view('templates/header', $data);
		$this->load->view('perg_resp', $data);
		$this->load->view('templates/footer');	

	}


	public function funciona() {
	
		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data['_title'] = "WEBECARD.net";
		
		$data['s_selected2'] = "selected";
		
		$this->load->view('templates/header', $data);
		$this->load->view('funciona', $data);
		$this->load->view('templates/footer');	

	}


	public function contato() {
	
		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		//$data['_title'] = "WEBECARD.net";
		
		$data['s_selected3'] = "selected";
		
		$this->load->view('templates/header', $data);
		$this->load->view('contato', $data);
		$this->load->view('templates/footer');	

	}


	public function print_area() {
	
		$id_ecard = $this->input->post('p_id_ecard');
		$ecard = $this->input->post('p_ecard');
		$data = $this->input->post('p_data');
		$design = $this->input->post('p_design');
		$info = $this->input->post('p_info');
		$redirect = $this->input->post('p_redirect');
		
		# pull the existing IDs out of the session
		$array_id_ecard =  $this->session->userdata('print_area');

		# on first load, the array may not be initialized
		if (!is_array($array_id_ecard))
		  $array_id_ecard = array();

		  //echo $id_ecard;
		  //echo " < <br> > ";
		  //print_r($array_id_ecard['id_ecard']);
		  //exit();
		  
		//if (count($array_id_ecard['id_ecard']) < 6) { // liberado para qualquer quantidade...
		
			# append $id_ecard to the list of viewed items
			if (!in_array($id_ecard, $array_id_ecard['id_ecard'])) {
			
				$array_id_ecard['id_ecard'][] = $id_ecard;
				$array_id_ecard['ecard'][] = $ecard;
				$array_id_ecard['info'][] = $info;
				$array_id_ecard['data'][] = $data;
				$array_id_ecard['design'][] = $design;
				
				$data = array( 'ecards_msg' => 'E-Card adicionado à área de impressão.' );
				$this->session->set_userdata($data);
				
			} else {			
				$data = array( 'ecards_msg' => 'E-Card já existente na área de impressão.' );
				$this->session->set_userdata($data);
			}

		//} else {		
			//$data = array( 'ecards_msg' => 'Área de impressão cheia.' );
			//$this->session->set_userdata($data);
		//}
		

		# put the new list back into the session
		$this->session->set_userdata('print_area', $array_id_ecard);

		//$this->session->unset_userdata('print_area'); 

		
		
		redirect('main/meus_ecards/' . $redirect);

	}


	public function printer() {
	

		$this->load->view('printer');
	

	}
	
	public function print_area_clear() {
	
		$this->session->unset_userdata('print_area'); 
		
		redirect('main/meus_ecards/');



	}


	public function del_ecard($redirect, $id_ecard, $sorteio_data) {
	
	
		$this->load->model('model_sorteios');
	
		if ($this->model_sorteios->del_ecard($redirect, $id_ecard, $sorteio_data)) {
		
			$data = array( 'ecards_msg' => 'E-Card deletado com sucesso.' );
			$this->session->set_userdata($data);
			
		} else {
			$data = array( 'ecards_msg' => 'Problema ao deletar E-Card.' );
			//$this->session->set_userdata($data);
		}

		redirect('main/meus_ecards/' . $redirect);
	}

/*
	public function retorno_dados($dados) {
	
		if ($this->session->userdata('is_logged_in')) {
		
			$this->load->model('model_sorteios');
			$data2 = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

			//$data2['_title'] = "Obrigado";	
			
			$data['dados'] = $dados;	
			echo $data['dados'];	
			echo "<br>d<br>";
			echo $dados;	
			exit();

			$this->load->view('templates/header', $data2);
			$this->load->view('ecards_menu');
			$this->load->view('retorno_dados', $data);			
			$this->load->view('templates/footer');	
			
		} else {
			$data = array( 	'redirect' => "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
							'ecards_msg' => 'Você deve estar logado para acessar este conteúdo.'
							);
			$this->session->set_userdata($data);
			redirect('main/login');

		}
	
	
	}
	*/
	
	public function set_lang($lang) {
	
		$data = array( 	'_lang' => $lang );
		$this->session->set_userdata($data);
		
		$this->home();
	}
 
	
	public function test() {
	
		$this->load->model('model_sorteios');
		$data = $this->model_sorteios->_language($this->session->userdata('_lang'), 'header'); 

		$this->load->view('templates/header', $data);
		$this->load->view('ecards_menu');
		$this->load->view('test');			
		$this->load->view('templates/footer');	

	}
 
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */