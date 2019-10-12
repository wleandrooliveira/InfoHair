<?php

class Login extends CI_Controller {
	private $active = 'login';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('funcionarios_model');
		
		// Removing session data
		$sess_array = array(
				'idUser' => '',
				'username' => ''
		);
		
		$this->session->unset_userdata('logged_in', $sess_array);
		
	}
	
	public	function index() {
		
		if($this->input->method() == 'get') {
			$data['controller'] = $this->active;
			$data['title'] = ucfirst($this->active);
			
			$this->load->view('login/index', $data);
		} else if($this->input->method() == 'post') {
			$result = $this->funcionarios_model->signIn();
			
			if(!empty($result) && count($result) > 0) {
				$result['sucesso'] = true;
				
				$session_data = array(
						'idUser' => $result['idFuncionario'],
						'username' => $result['nome']
				);
				
				// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
				
			} else {
				$result = array('sucesso' => false, 'ocorrencia' => 'Login ou Senha Incorretos!');				
			}
			
			echo json_encode($result);
		}
	}

}