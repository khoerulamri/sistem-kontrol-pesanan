<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_instansi extends CI_Controller {

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
		  
		  $this->load->model('M_instansi');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'instansi';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			

			$nama_instansi=$this->M_instansi->getKonfig('nama_instansi');
			$alamat=$this->M_instansi->getKonfig('alamat');
			$telepon=$this->M_instansi->getKonfig('telepon');
			$slogan=$this->M_instansi->getKonfig('slogan');
			$website=$this->M_instansi->getKonfig('website');

			foreach($nama_instansi as $a){
				$data['nama_instansi'] = $a->nilai;
			}
			foreach($alamat as $a){
				$data['alamat'] = $a->nilai;
			}
			foreach($telepon as $a){
				$data['telepon'] = $a->nilai;
			}
			foreach($slogan as $a){
				$data['slogan'] = $a->nilai;
			}
			foreach($website as $a){
				$data['website'] = $a->nilai;
			}


			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('instansi/V_instansi',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

 	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'instansi';

			$nama_instansi = $this->input->post('nama_instansi');
			$alamat = $this->input->post('alamat');
			$telepon = $this->input->post('telepon');
			$slogan = $this->input->post('slogan');
			$website = $this->input->post('website');

			$snama_instansi = $this->M_instansi->updateKonfig($nama_instansi,'nama_instansi');
			$salamat = $this->M_instansi->updateKonfig($alamat,'alamat');
			$stelepon = $this->M_instansi->updateKonfig($telepon,'telepon');
			$sslogan = $this->M_instansi->updateKonfig($slogan,'slogan');
			$swebsite = $this->M_instansi->updateKonfig($website,'website');

			if($snama_instansi && $salamat && $stelepon && $sslogan &&  $swebsite)
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

			redirect('instansi');
		}else{
			redirect('index');
		}

	}
}
