<?php 
class M_petugas extends CI_Model {
	
	
	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function checkPetugas($kodepetugas)
        {
                $sql = "select * from petugas where kode_petugas='$kodepetugas'";
				
				$query = $this->db->query($sql);
		        
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}


   	public function savePetugas($kode,$nama,$telepon,$alamat,$keterangan)
        {
                $sql = "insert into petugas values ('$kode','$nama','$telepon','$alamat','$keterangan')";
				
				$query = $this->db->query($sql);
		}

   	public function updatePetugas($kodelama,$kodebaru,$nama,$telepon,$alamat,$keterangan)
        {
                $sql = "update petugas  set nama_petugas='$nama',telepon_petugas='$telepon',alamat_petugas='$alamat',ket='$keterangan', kode_petugas='$kodebaru' where kode_petugas='$kodelama'";
				$query = $this->db->query($sql);
		}

   	public function deletePetugas($kode)
        {
                $sql = "delete from petugas where kode_petugas='$kode'";
				
				$query = $this->db->query($sql);
		}

   	public function getPetugasAll()
        {
                $sql = "select * from petugas order by nama_petugas";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

	public function getPetugasByKode($kodepetugas)
        {
                $sql = "select * from petugas where kode_petugas='$kodepetugas'";
				
				$query = $this->db->query($sql);

                return $query->result();
        }
	
	

}