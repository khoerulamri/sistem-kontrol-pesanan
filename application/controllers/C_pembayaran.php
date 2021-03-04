<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pembayaran extends CI_Controller {

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
		  
		  $this->load->model('M_pembayaran');
		  $this->load->model('M_pemesanan');
		  $this->load->model('M_customer');
		  $this->load->model('M_penanggungjawab');
		  $this->load->helper('date');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pembayaran';

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pembayaran/V_data_pembayaran',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_pembayaran)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pembayaran';
			
			$kode_pembayaran=urldecode($kode_pembayaran);
			$data['pembayaran']=$this->M_pembayaran->deletePembayaran($kode_pembayaran);
			
			$this->load->view('pembayaran/V_pembayaran_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_pembayaran)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pembayaran';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['getAllCustomer'] = $this->M_customer->getCustomerAll();
			$data['getAllpj'] = $this->M_penanggungjawab->getPenanggungJawabAll();
			$data['getAllPesananTempo'] = $this->M_pemesanan->getPesananAll();
			$data['getAllCaraBayar'] = $this->M_pembayaran->getCaraBayar();
			$data['getAllRekening'] = $this->M_pembayaran->getRekening();

			$kode_pembayaran=urldecode($kode_pembayaran);
			$data['pembayaran']=$this->M_pembayaran->getPembayaranByKode($kode_pembayaran);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pembayaran/V_pembayaran',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_pembayaran)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;

			$data['menu_active'] = 'pembayaran';
			$data['status']='ubah';

			$tgl_bayar = $this->input->post('tgl_bayar');
			$tgl_bayar = date('Y-m-d',strtotime($tgl_bayar));

			$kode_order = urldecode($this->input->post('kode_order'));
			$jumlah_bayar = $this->input->post('jumlah_bayar');
			$cara_bayar = $this->input->post('cara_bayar');
			$rekening = $this->input->post('rekening');
			$pengirim = $this->input->post('pengirim');
			$penerima = $this->input->post('penerima');
		

			$kode_pembayaran=urldecode($kode_pembayaran);
			$this->M_pembayaran->updatePembayaran($kode_pembayaran,$kode_order,$tgl_bayar,$jumlah_bayar,$cara_bayar,$rekening,$pengirim,$penerima);

			$data['kode_pembayaran']=$kode_pembayaran;
			$this->load->view('pembayaran/V_pembayaran_ubah',$data);


		}else{
			redirect('index');
		}

	}

	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pembayaran';
			
			$data['status'] = 'tambah';

			$tgl_bayar = $this->input->post('tgl_bayar');
			$tgl_bayar = date('Y-m-d',strtotime($tgl_bayar));

			$kode_order = urldecode($this->input->post('kode_order'));
			$jumlah_bayar = $this->input->post('jumlah_bayar');
			$cara_bayar = $this->input->post('cara_bayar');
			$rekening = $this->input->post('rekening');
			$pengirim = $this->input->post('pengirim');
			$penerima = $this->input->post('penerima');

			$this->M_pembayaran->savePembayaran($kode_order,$tgl_bayar,$jumlah_bayar,$cara_bayar,$rekening,$pengirim,$penerima);

			$this->load->view('pembayaran/V_pembayaran_simpan',$data);

		}else{
			redirect('index');
		}

	}

	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pembayaran';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';

			$data['getAllCustomer'] = $this->M_customer->getCustomerAll();
			$data['getAllpj'] = $this->M_penanggungjawab->getPenanggungJawabAll();
			$data['getAllPesananTempo'] = $this->M_pemesanan->getPesananAllTempo();
			$data['getAllCaraBayar'] = $this->M_pembayaran->getCaraBayar();
			$data['getAllRekening'] = $this->M_pembayaran->getRekening();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pembayaran/V_pembayaran',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_pembayaran()
    {
        $list = $this->M_pembayaran->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('pembayaran/ubah/').urlencode($field->kode_pembayaran).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('pembayaran/hapus/').urlencode($field->kode_pembayaran).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->tgl_bayar;
            $row[] = $field->pesanan;
            $row[] = $field->jumlah_bayar;
            $row[] = $field->nama_cara_bayar;
            $row[] = $field->pengirim;
            $row[] = $field->rekening;
            $row[] = $field->nama_penerima;
            $data[] = $row;
        } 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_pembayaran->count_all(),
            "recordsFiltered" => $this->M_pembayaran->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
