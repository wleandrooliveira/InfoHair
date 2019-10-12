<?php
class Clientes extends CI_Controller {
	
		private $active = 'clientes';

        public function __construct()
        {
                parent::__construct();
                $this->load->model('clientes_model');
                
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
		        $this->load->view('clientes/index', $data);
		        $this->load->view('templates/footer', $data);
		}

		public function form($idCliente = NULL)
		{		        
			if($this->input->method() == 'post') {
		    	echo json_encode( $this->clientes_model->insert_or_update());
		    } else {
			      $data['active'] = $this->active;
			      $data['controller'] = $this->active;
			      $data['hasCharts'] = false;
			      $data['title'] = ucfirst($this->active);
			      $data['cliente_item'] = $this->clientes_model->get_clientes($idCliente);
			      $data['action'] = 'Editar';
			        	
			      if (empty($data['cliente_item'])) {
			      	$data['action'] = 'Cadastrar';
			      }
			        	
			      $this->load->view('templates/header', $data);
			      $this->load->view('templates/menu', $data);
			      $this->load->view('clientes/form', $data);
			      $this->load->view('templates/footer', $data);
		     }
		        
		}
		
		public function delete($idCliente) {
			echo $this->clientes_model->delete($idCliente);
		}
		
		public function table() {
			$data['clientes'] = $this->clientes_model->get_clientes();
			
			$this->load->view('clientes/table', $data);
		}

		
}