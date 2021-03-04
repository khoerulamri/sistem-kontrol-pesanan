<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rekening extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
          parent::__construct();
		  
		  $this->load->model('M_rekening');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'rekening';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('rekening/V_data_rekening',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_rekening)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'rekening';
			
			$kode_rekening=urldecode($kode_rekening);
			$data['rekening']=$this->M_rekening->deleteRekening($kode_rekening);
			
			$this->load->view('rekening/V_rekening_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_rekening)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'rekening';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$kode_rekening=urldecode($kode_rekening);
			$data['rekening']=$this->M_rekening->getRekeningByKode($kode_rekening);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('rekening/V_rekening',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_rekening)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'rekening';
			
			$kode_rekeningbaru = $this->input->post('kode_rekening');
			$nama_rekening = $this->input->post('nama_rekening');


			//check kode baru sudah digunakan?
			if ($kode_rekening!=$kode_rekeningbaru)
			{
			$hasilcheck = $this->M_rekening->checkRekening($kode_rekeningbaru);
			}
			else
			{
			$hasilcheck=false;	
			}


			if($hasilcheck == true){
				//notif
				$data['kode_rekening']=$kode_rekening;
				$this->load->view('rekening/V_rekening_konflik',$data);

			}
			else
			{
				//kode customer unik				
				$kode_rekening=urldecode($kode_rekening);
				$this->M_rekening->updateRekening($kode_rekening,$kode_rekeningbaru,$nama_rekening);
				$data['kode_rekening']=$kode_rekeningbaru;
				$this->load->view('rekening/V_rekening_ubah',$data);
			}
			

		}else{
			redirect('index');
		}

	}

	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'rekening';
			
			$kode_rekening = $this->input->post('kode_rekening');
			$nama_rekening = $this->input->post('nama_rekening');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');

			$hasilcheck = $this->M_rekening->checkRekening($kode_rekening);

			if($hasilcheck == true){
				//notif
				$data['kode_rekening']=$kode_rekening;
				$this->load->view('rekening/V_rekening_konflik',$data);

			}
			else
			{
				//kode pj unik				
				$kode_rekening=urldecode($kode_rekening);
				$this->M_rekening->saveRekening($kode_rekening,$nama_rekening);
				$data['kode_rekening']=$kode_rekening;
				$this->load->view('rekening/V_rekening_simpan',$data);
			}
			

		}else{
			redirect('index');
		}

	}

	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'rekening';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('rekening/V_rekening',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_rekening()
    {
        $list = $this->M_rekening->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('rekening/ubah/').urlencode($field->kode_rekening).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('rekening/hapus/').urlencode($field->kode_rekening).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_rekening;
            $row[] = $field->rekening;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_rekening->count_all(),
            "recordsFiltered" => $this->M_rekening->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
