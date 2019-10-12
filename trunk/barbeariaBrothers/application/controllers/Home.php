<?php

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('atendimentos_model');
		
		if (!isset($this->session->userdata['logged_in'])) {
			header('location: '.base_url().'login/index');
		}
	}

	public function index()
	{
		$page = 'home';
		
		$data['title'] = ucfirst($page);
		$data['active'] = $page;
		$data['controller'] = $page;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('home/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function table() {
		$data['atendimentos'] = $this->atendimentos_model->get_atendimentos(15, false);
			
		$this->load->view('atendimentos/table', $data);
	}

}