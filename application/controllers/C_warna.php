<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_warna extends CI_Controller {

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
		  
		  $this->load->model('M_warna');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'warna';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			

			$ojt1w=$this->M_warna->getKonfig('ojt1w');
			$ojt2w=$this->M_warna->getKonfig('ojt2w');
			$ojt3w=$this->M_warna->getKonfig('ojt3w');
			$ojt4w=$this->M_warna->getKonfig('ojt4w');
			$ojt2=$this->M_warna->getKonfig('ojt2');
			$ojt31=$this->M_warna->getKonfig('ojt31');
			$ojt32=$this->M_warna->getKonfig('ojt32');
			$ojt4=$this->M_warna->getKonfig('ojt4');

			foreach($ojt1w as $a){
				$data['ojt1w'] = $a->nilai;
			}
			foreach($ojt2w as $a){
				$data['ojt2w'] = $a->nilai;
			}
			foreach($ojt3w as $a){
				$data['ojt3w'] = $a->nilai;
			}
			foreach($ojt4w as $a){
				$data['ojt4w'] = $a->nilai;
			}
			foreach($ojt2 as $a){
				$data['ojt2'] = $a->nilai;
			}
			foreach($ojt31 as $a){
				$data['ojt31'] = $a->nilai;
			}
			foreach($ojt32 as $a){
				$data['ojt32'] = $a->nilai;
			}
			foreach($ojt4 as $a){
				$data['ojt4'] = $a->nilai;
			}

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('warna/V_warna',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

 	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'warna';

			$ojt1w=$this->M_warna->getKonfig('ojt1w');
			$ojt2w=$this->M_warna->getKonfig('ojt2w');
			$ojt3w=$this->M_warna->getKonfig('ojt3w');
			$ojt4w=$this->M_warna->getKonfig('ojt4w');

			$ojt1w = $this->input->post('ojt1w');
			$ojt2w = $this->input->post('ojt2w');
			$ojt3w = $this->input->post('ojt3w');
			$ojt4w = $this->input->post('ojt4w');

			$sojt1w = $this->M_warna->updateKonfig($ojt1w,'ojt1w');
			$sojt2w = $this->M_warna->updateKonfig($ojt2w,'ojt2w');
			$sojt3w = $this->M_warna->updateKonfig($ojt3w,'ojt3w');
			$sojt4w = $this->M_warna->updateKonfig($ojt4w,'ojt4w');
			

			if($sojt1w && $sojt2w && $sojt3w && $sojt4w &&  $sojt2 && $sojt31 && $sojt32 && $sojt4 )
			{
			$data['pesan'] ='<div class="alert alert-success text-center">
                               Simpan Data Berhasil.
                            </div>';
            }
            else
			{
			$data['pesan'] ='<div class="alert alert-danger text-center">
                               Simpan Data Gagal.
                            </div>';
			}                         

			redirect('warna');
		}else{
			redirect('index');
		}

	}
}
