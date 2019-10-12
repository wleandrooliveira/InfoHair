<?php
class Servicos extends CI_Controller {
	
		private $active = 'servicos';

        public function __construct()
        {
                parent::__construct();
                $this->load->model('servicos_model');
                
                // Removing session data
                $sess_array = array(
                		'idUser' => '',
                		'username' => ''
                );
                
                $this->session->unset_userdata('logged_in', $sess_array);
        }

		public function index()
		{
				$data['active'] = $this->active;
				$data['controller'] = $this->active;
				$data['hasCharts'] = false;
				$data['title'] = ucfirst($this->active);
				
		        $this->load->view('templates/header', $data);
		        $this->load->view('templates/menu', $data);
		        $this->load->view('servicos/index', $data);
		        $this->load->view('templates/footer', $data);
		}

		public function form($idServico = NULL)
		{
		        
		        if($this->input->method() == 'post') {
		        	echo $this->servicos_model->insert_or_update();
		        } else {
		        	
		        	$data['active'] = $this->active;
		        	$data['controller'] = $this->active;
		        	$data['hasCharts'] = false;
		        	$data['title'] = ucfirst($this->active);
		        	$data['servico_item'] = $this->servicos_model->get_servicos($idServico);
		        	$data['action'] = 'Editar';
		        	
		        	if (empty($data['servico_item'])) {
		        		$data['action'] = 'Cadastrar';
		        	}
		        	
		        	$this->load->view('templates/header', $data);
		        	$this->load->view('templates/menu', $data);
		        	$this->load->view('servicos/form', $data);
		        	$this->load->view('templates/footer', $data);
		        }
		        
		}
		
		public function delete($idServico) {
			echo $this->servicos_model->delete($idServico);
		}
		
		public function table() {
			$data['servicos'] = $this->servicos_model->get_servicos();
			
			$this->load->view('servicos/table', $data);
		}

		
}