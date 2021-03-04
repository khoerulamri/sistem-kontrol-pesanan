<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pemesanan extends CI_Controller {

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
		  
		  $this->load->model('M_pemesanan');
		  $this->load->model('M_customer');
		  $this->load->model('M_penanggungjawab');
		  $this->load->helper('date');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pemesanan';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pemesanan/V_data_pemesanan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_pemesanan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pemesanan';
			
			$kode_pemesanan=urldecode($kode_pemesanan);
			$data['pemesanan']=$this->M_pemesanan->deletePesanan($kode_pemesanan);
			
			$this->load->view('pemesanan/V_pemesanan_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_pemesanan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pemesanan';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['getAllCustomer'] = $this->M_customer->getCustomerAll();
			$data['getAllpj'] = $this->M_penanggungjawab->getPenanggungJawabAll();

			$kode_pemesanan=urldecode($kode_pemesanan);
			$data['pemesanan']=$this->M_pemesanan->getPesananByKode($kode_pemesanan);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pemesanan/V_pemesanan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_pemesanan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pemesanan';
			$data['status']='ubah';

			$kode_pemesananbaru = $this->input->post('kode_pemesanan');
			$kode_customer = $this->input->post('kode_customer');
			$kode_pj = $this->input->post('kode_pj');
			$tglorder = $this->input->post('tglorder');
			$tgltempo = $this->input->post('tgltempo');
			$total_harga = $this->input->post('total_harga');
			$status = $this->input->post('status');

			//check status tempo tanggal tempo harus terisi
			if(($status=='tempo')&&($tgltempo==''))
			{
				//notif
				$data['kode_pemesanan']=$kode_pemesanan;
				$this->load->view('pemesanan/V_pemesanan_tempo',$data);
			}
			else
			{	

				//check kode baru sudah digunakan?
				if ($kode_pemesanan!=$kode_pemesananbaru)
				{
				$hasilcheck = $this->M_pemesanan->checkPesanan($kode_pemesananbaru);
				}
				else
				{
				$hasilcheck=false;	
				}


				if($hasilcheck == true){
					//notif
					$data['kode_pemesanan']=$kode_pemesanan;
					$this->load->view('pemesanan/V_pemesanan_konflik',$data);

				}
				else
				{
					if($status=='tempo')
					{
					$tglorder = date('Y-m-d',strtotime($tglorder));
					$tgltempo = date('Y-m-d',strtotime($tgltempo));
					}
					else
					{
					$tglorder = date('Y-m-d',strtotime($tglorder));
					$tgltempo = '0000-00-00';
					}
					//kode customer unik	

					$kode_pemesanan=urldecode($kode_pemesanan);
					$this->M_pemesanan->updatePesanan($kode_pemesanan,$kode_pemesananbaru,$tglorder,$kode_customer,$kode_pj,$status,$tgltempo,$total_harga);
					$data['kode_pemesanan']=$kode_pemesananbaru;
					$this->load->view('pemesanan/V_pemesanan_ubah',$data);
				}
			}

		}else{
			redirect('index');
		}

	}

	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pemesanan';
			
			$data['status'] = 'tambah';

			$kode_pemesanan = $this->input->post('kode_pemesanan');
			$kode_customer = $this->input->post('kode_customer');
			$kode_pj = $this->input->post('kode_pj');
			$tglorder = $this->input->post('tglorder');
			$tgltempo = $this->input->post('tgltempo');
			$total_harga = $this->input->post('total_harga');
			$status = $this->input->post('status');

			
			//check status tempo tanggal tempo harus terisi
			if(($status=='tempo')&&($tgltempo==''))
			{
				//notif
				$this->load->view('pemesanan/V_pemesanan_tempo',$data);
			}
			else
			{		
				// check kode sudah ada
				$hasilcheck = $this->M_pemesanan->checkPesanan($kode_pemesanan);

				if($hasilcheck == true){
					//notif
					$data['kode_pemesanan']=$kode_pemesanan;
					$this->load->view('pemesanan/V_pemesanan_konflik',$data);

				}
				else
				{
					if($status=='tempo')
					{
					$tglorder = date('Y-m-d',strtotime($tglorder));
					$tgltempo = date('Y-m-d',strtotime($tgltempo));
					}
					else
					{
					$tglorder = date('Y-m-d',strtotime($tglorder));
					$tgltempo = '0000-00-00';
					}
					//kode pj unik				
					$kode_pemesanan=urldecode($kode_pemesanan);	
					$this->M_pemesanan->savePesanan($kode_pemesanan,$tglorder,$kode_customer,$kode_pj,$status,$tgltempo,$total_harga);
					$data['kode_pemesanan']=$kode_pemesanan;
					$this->load->view('pemesanan/V_pemesanan_simpan',$data);
				}
			}

		}else{
			redirect('index');
		}

	}

	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pemesanan';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			
			$data['status']='tambah';

			$data['getAllCustomer'] = $this->M_customer->getCustomerAll();
			$data['getAllpj'] = $this->M_penanggungjawab->getPenanggungJawabAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pemesanan/V_pemesanan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_pemesanan()
    {
        $list = $this->M_pemesanan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('pemesanan/ubah/').urlencode($field->kode_order).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('pemesanan/hapus/').urlencode($field->kode_order).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_order;
            $row[] = $field->tgl_order_tampil;
            $row[] = $field->nama_customer;
            $row[] = $field->nama_pj;
            $row[] = $field->total_harga;
            $row[] = $field->kekurangan;
            $row[] = $field->nama_status;
            $row[] = $field->tgl_tempo_tampil;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_pemesanan->count_all(),
            "recordsFiltered" => $this->M_pemesanan->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

}
