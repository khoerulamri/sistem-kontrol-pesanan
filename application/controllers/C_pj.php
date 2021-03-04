<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pj extends CI_Controller {

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
		  
		  $this->load->model('M_penanggungjawab');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pj';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			

			$data['pj']=$this->M_penanggungjawab->getPenanggungJawabAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pj/V_data_pj',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_pj)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pj';
			
			$kode_pj=urldecode($kode_pj);
			$data['pj']=$this->M_penanggungjawab->deletePenanggungJawab($kode_pj);
			
			$this->load->view('pj/V_pj_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_pj)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pj';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$kode_pj=urldecode($kode_pj);
			$data['pj']=$this->M_penanggungjawab->getPenanggungJawabByKode($kode_pj);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pj/V_pj',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_pj)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pj';
			
			$kode_pjbaru = $this->input->post('kode_pj');
			$nama_pj = $this->input->post('nama_pj');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');


			//check kode baru sudah digunakan?
			if ($kode_pj!=$kode_pjbaru)
			{
			$hasilcheck = $this->M_penanggungjawab->checkPenanggungJawab($kode_pjbaru);
			}
			else
			{
			$hasilcheck=false;	
			}


			if($hasilcheck == true){
				//notif
				$data['kode_pj']=$kode_pj;
				$this->load->view('pj/V_pj_konflik',$data);

			}
			else
			{
				//kode customer unik				
				$kode_pj=urldecode($kode_pj);
				$this->M_penanggungjawab->updatePenanggungJawab($kode_pj,$kode_pjbaru,$nama_pj,$telpon,$alamat,$keterangan);
				$data['kode_pj']=$kode_pjbaru;
				$this->load->view('pj/V_pj_ubah',$data);
			}
			

		}else{
			redirect('index');
		}

	}

	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pj';
			
			$kode_pj = $this->input->post('kode_pj');
			$nama_pj = $this->input->post('nama_pj');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');

			$hasilcheck = $this->M_penanggungjawab->checkPenanggungJawab($kode_pj);

			if($hasilcheck == true){
				//notif
				$data['kode_pj']=$kode_pj;
				$this->load->view('pj/V_pj_konflik',$data);

			}
			else
			{
				//kode pj unik				
				$kode_pj=urldecode($kode_pj);
				$this->M_penanggungjawab->savePenanggungJawab($kode_pj,$nama_pj,$telpon,$alamat,$keterangan);
				$data['kode_pj']=$kode_pj;
				$this->load->view('pj/V_pj_simpan',$data);
			}
			

		}else{
			redirect('index');
		}

	}

	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pj';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pj/V_pj',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_pj()
    {
        $list = $this->M_penanggungjawab->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('pj/ubah/').urlencode($field->kode_pj).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('pj/hapus/').urlencode($field->kode_pj).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_pj;
            $row[] = $field->nama_pj;
            $row[] = $field->alamat;
            $row[] = $field->telpon;
            $row[] = $field->keterangan; 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_penanggungjawab->count_all(),
            "recordsFiltered" => $this->M_penanggungjawab->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
