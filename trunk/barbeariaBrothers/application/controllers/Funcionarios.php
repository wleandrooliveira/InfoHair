<?php
class Funcionarios extends CI_Controller {
	
		private $active = 'funcionarios';

        public function __construct()
        {
           	parent::__construct();
            $this->load->model('funcionarios_model');
                
	        if (!isset($this->session->userdata['logged_in'])) {
				header('location: '.base_url().'login/index');
			}
                
        }

		public function index()
		{
				$data['active'] = $this->active;
				$data['controller'] = $this->active;
				$data['hasCharts'] = false;
				$data['title'] = ucfirst($this->active);
				
		        $this->load->view('templates/header', $data);
		        $this->load->view('templates/menu', $data);
		        $this->load->view('funcionarios/index', $data);
		        $this->load->view('templates/footer', $data);
		}

		public function form($idFuncionario = NULL)
		{
		        
		        if($this->input->method() == 'post') {
		        	echo $this->funcionarios_model->insert_or_update();
		        } else {
		        	
		        	$data['active'] = $this->active;
		        	$data['controller'] = $this->active;
		        	$data['hasCharts'] = false;
		        	$data['title'] = ucfirst($this->active);
		        	$data['funcionario_item'] = $this->funcionarios_model->get_funcionarios($idFuncionario);
		        	$data['action'] = 'Editar';
		        	
		        	if (empty($data['funcionario_item'])) {
		        		$data['action'] = 'Cadastrar';
		        	}
		        	
		        	$this->load->view('templates/header', $data);
		        	$this->load->view('templates/menu', $data);
		        	$this->load->view('funcionarios/form', $data);
		        	$this->load->view('templates/footer', $data);
		        }
		        
		}
		
		public function delete($idFuncionario) {
			echo $this->funcionarios_model->delete($idFuncionario);
		}
		
		public function table() {
			$data['funcionarios'] = $this->funcionarios_model->get_funcionarios();
			
			$this->load->view('funcionarios/table', $data);
		}

		
}