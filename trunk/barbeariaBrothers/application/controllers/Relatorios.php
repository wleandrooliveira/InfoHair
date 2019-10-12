<?php
class Relatorios extends CI_Controller {

	private $active = 'relatorios';
	
	private $status = array('Pendente' => array('class' => 'warning', 'icon' => 'warning'),
			'Cancelada' => array('class' => 'danger', 'icon' => 'times'),
			'Enviando' => array('class' => 'primary', 'icon' => 'clock-o'),
			'Enviada' => array('class' => 'success', 'icon' => 'check'),
			'Falha' => array('class' => 'danger', 'icon' => 'times') );

	public function __construct()
	{
		parent::__construct();
		$this->load->model('relatorios_model');
		
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
		$this->load->view('relatorios/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function generate() {		
		if($this->input->method() == 'post') {
			$tipo = $this->input->post('tipo');
			$dataInicio = strtotime($this->input->post('dataInicio'));
			$dataFim = strtotime($this->input->post('dataFim'));			
			
			$data['relatorios'] = $this->relatorios_model->generateRelatorio();
			$data['dataInicio'] = date('d/m/Y', $dataInicio);
			$data['dataFim'] = date('d/m/Y', $dataFim);
			
			if($tipo == 'dia') {
				$this->load->view('relatorios/generate/dia', $data);
			} else if($tipo == 'servico') {
				$this->load->view('relatorios/generate/servico', $data);
			} else if($tipo == 'funcionario') {
				$this->load->view('relatorios/generate/funcionario', $data);
			} else if($tipo == 'mensagem') {
				$data['status'] = $this->status;
				$this->load->view('relatorios/generate/mensagem', $data);
			}
						
		}
	}


}