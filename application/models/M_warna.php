<?php 
class M_warna extends CI_Model {
	
	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function updateKonfig($nilai,$setting)
        {
                $sql = "update konfig set nilai='$nilai' where setting='$setting'";
				
				$query = $this->db->query($sql);
		}

   	public function getKonfig($setting)
        {
                $sql = "select * from konfig where setting='$setting'";
				
				$query = $this->db->query($sql);

                return $query->result();
        }
	
}