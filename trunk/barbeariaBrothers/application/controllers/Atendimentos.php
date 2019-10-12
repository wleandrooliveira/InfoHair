<?php
class Atendimentos extends CI_Controller {
	
	private $active = 'atendimentos';

        public function __construct()
        {
                parent::__construct();
                $this->load->model('atendimentos_model');
                
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
	        $this->load->view('atendimentos/index', $data);
	        $this->load->view('templates/footer', $data);
		}
		
		public function form()
		{			
			if($this->input->method() == 'post') {
				echo json_encode($this->atendimentos_model->insert_servicosAtendimento());
			} else {
				$data['active'] = $this->active;
				$data['controller'] = $this->active;
				$data['hasCharts'] = false;
				$data['autocomplete'] = true;
				$data['title'] = ucfirst($this->active);
				
				$this->atendimentos_model->clearServicoQuantidade();
			
				$this->load->view('templates/header', $data);
				$this->load->view('templates/menu', $data);
				$this->load->view('atendimentos/form', $data);
				$this->load->view('templates/footer', $data);
			}
		}
		
		public function autocomplete() {
			$field = $this->input->post('field');
			$desc = addslashes($this->input->post('desc'));
			$inList = $this->input->post('inList');
				
			switch ($field) {
				case "cliente":
					echo json_encode($this->atendimentos_model->get_clientesByCelOrName($desc));
					break;
				case "funcionario":
					echo json_encode($this->atendimentos_model->get_funcionarios($desc));
					break;
				case "servico":
					echo json_encode($this->atendimentos_model->get_servicos($desc, $inList));
					break;
			}
		}
		
		public function table() {
			$data['atendimentos'] = $this->atendimentos_model->get_atendimentos(10, true);
			
			$this->load->view('atendimentos/table', $data);
		}
		
		public function tableServico() {
			$data['servicos'] = $this->atendimentos_model->get_servicoQuantidade();
				
			$this->load->view('atendimentos/table-servicos', $data);
		}
		
		public function insert() {
			echo $this->atendimentos_model->insert_servicoQuantidade();
		}

		public function update() {
			echo $this->atendimentos_model->update_servicoQuantidade();
		}

		public function delete($idServico) {
			echo $this->atendimentos_model->deleteServicoQuantidade($idServico);
		}
		
		public function get($element) {
			echo $this->atendimentos_model->get_tempServicoTotal()[$element];
		}
		
}