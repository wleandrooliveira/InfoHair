<?php

class Mensagens extends CI_Controller {
	
		private $active = 'mensagens';
		private $status = array('Pendente' => array('class' => 'warning', 'icon' => 'warning'),
								'Cancelada' => array('class' => 'danger', 'icon' => 'times'),
								'Enviando' => array('class' => 'primary', 'icon' => 'clock-o'),
								'Enviada' => array('class' => 'success', 'icon' => 'check'),
								'Falha' => array('class' => 'danger', 'icon' => 'times') );
		
		private $postman_userid = "4d0dc98e-f5b9-484e-9158-70447cee2524";
		private $postman_token = "83222044";
		
		public function __construct()
        {
                parent::__construct();
                $this->load->model('mensagens_model');
                
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
				
				$this->atualizaStatusMisterPostman();
				
		        $this->load->view('templates/header', $data);
		        $this->load->view('templates/menu', $data);
		        $this->load->view('mensagens/index', $data);
		        $this->load->view('templates/footer', $data);
		}

		public function form($idCliente = NULL)
		{		        
		        if($this->input->method() == 'post') {
		        	echo $this->clientes_model->insert_or_update();
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
		        	$this->load->view('mensagens/form', $data);
		        	$this->load->view('templates/footer', $data);
		        }
		        
		}
		
		public function getSaldo() {
			try {
			
				// Monta a URL para acionar o Gateway
				$URLGateway = $this->getGatewayURL().'&acao=saldo';
					
				// Aciona o Gateway  - Opção ideal para PHP 4.3.x ou superior
				$content = file_get_contents($URLGateway);
					
				$matches = explode(":", $content);
					
				$saldo = $matches[3];
					
				// Coloca no video a resposta do gateway
				echo $saldo;
				
			} catch (Exception $e) {
				echo '0 (Não Encontrado)';
			}
						
		}
		
		public function table() {
			$data['mensagens'] = $this->mensagens_model->get_mensagens();
			$data['status'] = $this->status;
			
			$this->load->view('mensagens/table', $data);
		}
		
		public function atualizaStatusMisterPostman() {
			$data = $this->mensagens_model->get_minDataPendente();
			$URLGateway = $this->getGatewayURL().'&acao=status&data1='.$data;
			
			$response = file_get_contents($URLGateway);
			$content = explode(PHP_EOL, $response);
			$columns = explode(';', $content[0]);
			$array = array();
			
			for($i = 1; $i < count($content); $i++) {			
				if (strpos($content[$i], ';') !== false) {
					$explodeItem = explode(';', $content[$i]);
					$idMister = $explodeItem[3];
					$statusMister = trim(str_replace(PHP_EOL, '', $explodeItem[4]));
					
					$this->mensagens_model->update_statusMister($idMister, $statusMister);
// 					for($x = 0; $x < count($explodeItem); $x++) {
// 						$array[$i][$columns[$x]] = $explodeItem[$x];
// 					}
				}
			}
			
		}
		
		public function sendAll() {
			$result = true;
			
			$msgs = $this->mensagens_model->get_mensagensPendentes();
			$i = 0;
			foreach ($msgs as $item) {
				$mensagem = urlencode($item['mensagem']);
				$telefone = $item['telefone'];
				$URLGateway = $this->getGatewayURL().'&NroDestino='.$telefone.'&Mensagem='.$mensagem.'&ID=true';
				
				echo $response = file_get_contents($URLGateway);
				$data = explode(";", $response);
				
				$success = trim($data[0]);
				$desc = trim($data[1]); 
				
				if($success == 'OK') {
					$this->mensagens_model->update_msg($item['idMensagem'], 'Enviada', $desc);
				} else {
					$this->mensagens_model->update_msg($item['idMensagem'], 'Falha', null, $desc);
					$result = false;
				}
				
			}
			
			echo $result;
			
		}
		
		private function getGatewayURL() {
			return 'http://www.misterpostman.com.br/gateway.aspx?UserID='.$this->postman_userid.'&Token='.$this->postman_token;
		}
		
}