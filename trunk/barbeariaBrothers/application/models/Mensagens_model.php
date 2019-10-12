<?php
class Mensagens_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_mensagens()
        {
        	$sql = "SELECT idCliente, nome AS cliente, texto AS mensagem, descricao AS tipo, status AS situacao,
        				DATE_FORMAT(data, '%d/%m/%Y') AS data, COALESCE(DATE_FORMAT(dataEnvio, '%d/%m/%Y %H:%i'), '-') AS dataEnvio,
        				COALESCE(erroMisterPostman, statusMisterPostman) AS descMisterPostman
					FROM mensagem
					JOIN cliente USING(idCliente)
					JOIN modelo_mensagem USING(idModelo)
					WHERE status = 'Pendente' OR DATE(data) = CURRENT_DATE OR DATE(dataEnvio) = CURRENT_DATE";
        	$query = $this->db->query($sql);
        	return $query->result_array();
        }
        
        public function get_mensagensPendentes()
        {
        	$sql = "SELECT idMensagem, maskRemove(telefone) AS telefone, texto AS mensagem
					FROM mensagem
					JOIN cliente USING(idCliente)
					JOIN modelo_mensagem USING(idModelo)
					WHERE status = 'Pendente'";
        	$query = $this->db->query($sql);
        	return $query->result_array();
        }
        
        public function get_minDataPendente()
        {
        	$sql = "SELECT DATE_FORMAT(MIN(data), '%d/%m/%Y') AS minData
					FROM mensagem
					JOIN cliente USING(idCliente)
					JOIN modelo_mensagem USING(idModelo)
					WHERE status = 'Pendente'";
        	$query = $this->db->query($sql);
        	return $query->row_array()['minData'];
        }

        public function update_msg($idMensagem, $status, $idMister, $erroMister = '') {
        	
        	if($idMister == null)
        		$idMister = 'NULL';
        	else
        		$idMister = "'$idMister'";
        	
			$query = $this->db->query("CALL atualizarMensagem($idMensagem, '$status', $idMister, '$erroMister')");
        	return $query;
        }
        
        public function update_statusMister($idMister, $statusMister) {
        	
			$data = array(
				'statusMisterPostman' => ucfirst($statusMister)
			);
        		 
        	$this->db->where('idMisterPostman', $idMister);
        		 
        	return $this->db->update('mensagem', $data);
        	
        }
        
}