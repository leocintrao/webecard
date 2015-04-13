<?php

class Pages extends CI_Controller {

	public function view($page = 'home')
	{
		if ( ! file_exists('application/views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);	
	}
	
	


		public function cpf_validation() {
		
		echo $new_user = "a1b1c1d1";
		echo "<br>";
		echo $this->novo_usuario($new_user);
		
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
			
//echo $query . "<br>";	
		
			$num = $num + 1;
			
//echo $query->num_rows() . " num rows<br>";

		} while ($query->num_rows() == 1);

		
		// if > 255 chars exit()
		
		return $new_user_id;
	}
	
	
}