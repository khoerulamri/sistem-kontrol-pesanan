<?php 
class M_pembayaran extends CI_Model {

	var $table = "(SELECT
  `a`.`kode_pembayaran` AS `kode_pembayaran`,
  `a`.`tgl_bayar`       AS `tgl_bayar`,
  `a`.`kode_order`      AS `kode_order`,
  FORMAT(`a`.`jumlah_bayar`,0) AS `jumlah_bayar`,
  `a`.`cara_bayar`      AS `cara_bayar`,
  `a`.`rekening`        AS `rekening`,
  `a`.`pengirim`        AS `pengirim`,
  `a`.`penerima`        AS `penerima`,
  SUBSTR(CONCAT(`b`.`kode_order`,_latin1' ',`c`.`nama_customer`),1,100) AS `pesanan`,
  `d`.`nama_cara_bayar` AS `nama_cara_bayar`,
  `e`.`rekening`        AS `nama_rekening`,
  `f`.`nama_pj`         AS `nama_penerima`,
  DATE_FORMAT(`a`.`tgl_bayar`,_utf8'%d %M %Y') AS `tgl_bayar_tampil`
FROM `pembayaran` `a`
       LEFT JOIN `pesan` `b`
         ON `a`.`kode_order` = `b`.`kode_order`
      LEFT JOIN `customer` `c`
        ON `b`.`kode_customer` = `c`.`kode_customer`
     LEFT JOIN `cara_bayar` `d`
       ON `a`.`cara_bayar` = `d`.`kode_cara_bayar`
    LEFT JOIN `rekening` `e`
      ON `a`.`rekening` = `e`.`kode_rekening`
   LEFT JOIN `pj_pesanan` `f`
     ON `f`.`kode_pj` = `a`.`penerima` ) tabel " ; //nama tabel dari database
    var $column_order = array(null,null, 'tgl_bayar','pesanan','jumlah_bayar','nama_cara_bayar','pengirim','rekening','nama_penerima'); //field yang ada di table 
    var $column_search = array('tgl_bayar','pesanan','jumlah_bayar','nama_cara_bayar','pengirim','rekening','nama_penerima');  //field yang diizin untuk pencarian 

    var $order = array('tgl_bayar' => 'desc'); // default order 
	
	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }

   	public function savePembayaran($kodeorder,$tglbayar,$jumlahbayar,$carabayar,$rekening,$pengirim,$penerima)
        {
                //input data pembayaran
                $sql ="insert into pembayaran (tgl_bayar, kode_order, jumlah_bayar, cara_bayar, rekening, pengirim, penerima) values ('$tglbayar','$kodeorder','$jumlahbayar','$carabayar','$rekening','$pengirim','$penerima')";
                
                $query = $this->db->query($sql);

                //check statusnya dan update status pesanan
                $sql="SELECT
                  `a`.`kode_order`       AS `kode_order`,
                  FORMAT(`a`.`total_harga`,0) AS `total_harga`,
                  FORMAT((SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),'0')` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`)),0) AS `sudah_bayar`,
                  FORMAT((`a`.`total_harga` - (SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),'0')` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`))),0) AS `kekurangan`
                FROM (((`pesan` `a`
                     LEFT JOIN `customer` `b`
                       ON ((`a`.`kode_customer` = `b`.`kode_customer`)))
                    LEFT JOIN `pj_pesanan` `c`
                      ON ((`a`.`penanggung_jawab` = `c`.`kode_pj`)))
                   LEFT JOIN `status` `d`
                     ON ((`a`.`kode_status` = `d`.`kode_status`)))
                WHERE a.kode_order='$kodeorder'";
                $query = $this->db->query($sql);
                $a= $query->result();
                foreach ($a as $b ) {
                $total_harga=str_replace(",", "", $b->total_harga);
                $sudah_bayar=str_replace(",", "", $b->sudah_bayar);
                $kekurangan=str_replace(",", "", $b->kekurangan);
                }


                if ('0'==$kekurangan)
                {
                    $sql="
                    UPDATE pesan SET kode_status='lunas', sudah_bayar='$sudah_bayar' WHERE kode_order='$kodeorder'";
                    $query = $this->db->query($sql);
                }
                else
                {
                    $sql="
                    UPDATE pesan SET kode_status='tempo', sudah_bayar='$sudah_bayar' WHERE kode_order='$kodeorder'";
                    $query = $this->db->query($sql);
                }

                
		}

   	public function updatePembayaran($kodebayar,$kodeorder,$tglbayar,$jumlahbayar,$carabayar,$rekening,$pengirim,$penerima)
        {
                $sql = "update pembayaran set kode_order='$kodeorder', tgl_bayar='$tglbayar',jumlah_bayar='$jumlahbayar',cara_bayar='$carabayar',rekening='$rekening',pengirim='$pengirim',penerima='$penerima' where kode_pembayaran='$kodebayar'";
				$query = $this->db->query($sql);

                 //check statusnya dan update status pesanan
                $sql="SELECT
                  `a`.`kode_order`       AS `kode_order`,
                  FORMAT(`a`.`total_harga`,0) AS `total_harga`,
                  FORMAT((SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),'0')` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`)),0) AS `sudah_bayar`,
                  FORMAT((`a`.`total_harga` - (SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),'0')` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`))),0) AS `kekurangan`
                FROM (((`pesan` `a`
                     LEFT JOIN `customer` `b`
                       ON ((`a`.`kode_customer` = `b`.`kode_customer`)))
                    LEFT JOIN `pj_pesanan` `c`
                      ON ((`a`.`penanggung_jawab` = `c`.`kode_pj`)))
                   LEFT JOIN `status` `d`
                     ON ((`a`.`kode_status` = `d`.`kode_status`)))
                WHERE a.kode_order='$kodeorder'";
                $query = $this->db->query($sql);
                $a= $query->result();
                foreach ($a as $b ) {
                $total_harga=str_replace(",", "", $b->total_harga);
                $sudah_bayar=str_replace(",", "", $b->sudah_bayar);
                $kekurangan=str_replace(",", "", $b->kekurangan);
                }


                if ('0'==$kekurangan)
                {
                    $sql="
                    UPDATE pesan SET kode_status='lunas', sudah_bayar='$sudah_bayar'  WHERE kode_order='$kodeorder'";
                    $query = $this->db->query($sql);
                }
                else
                {
                    $sql="
                    UPDATE pesan SET kode_status='tempo', sudah_bayar='$sudah_bayar'  WHERE kode_order='$kodeorder'";
                    $query = $this->db->query($sql);
                }
		}

   	public function deletePembayaran($kode)
        {
                //ambil kode order
                $sql = "SELECT * from pembayaran where kode_pembayaran='$kode'";
                $query = $this->db->query($sql);
                $a= $query->result();
                foreach ($a as $b ) {
                $kodeorder=$b->kode_order;
                }

                $sql = "delete from pembayaran where kode_pembayaran='$kode'";
                
                $query = $this->db->query($sql);
                
                 //check statusnya dan update status pesanan
                $sql="SELECT
                  `a`.`kode_order`       AS `kode_order`,
                  FORMAT(`a`.`total_harga`,0) AS `total_harga`,
                  FORMAT((SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),'0')` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`)),0) AS `sudah_bayar`,
                  FORMAT((`a`.`total_harga` - (SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),'0')` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`))),0) AS `kekurangan`
                FROM (((`pesan` `a`
                     LEFT JOIN `customer` `b`
                       ON ((`a`.`kode_customer` = `b`.`kode_customer`)))
                    LEFT JOIN `pj_pesanan` `c`
                      ON ((`a`.`penanggung_jawab` = `c`.`kode_pj`)))
                   LEFT JOIN `status` `d`
                     ON ((`a`.`kode_status` = `d`.`kode_status`)))
                WHERE a.kode_order='$kodeorder'";
                $query = $this->db->query($sql);
                $a= $query->result();
                foreach ($a as $b ) {
                $total_harga=str_replace(",", "", $b->total_harga);
                $sudah_bayar=str_replace(",", "", $b->sudah_bayar);
                $kekurangan=str_replace(",", "", $b->kekurangan);
                }


                if ('0'==$kekurangan)
                {
                    $sql="
                    UPDATE pesan SET kode_status='lunas', sudah_bayar='$sudah_bayar'  WHERE kode_order='$kodeorder'";
                    $query = $this->db->query($sql);
                }
                else
                {
                    $sql="
                    UPDATE pesan SET kode_status='tempo', sudah_bayar='$sudah_bayar'  WHERE kode_order='$kodeorder'";
                    $query = $this->db->query($sql);
                }                

		}

   	public function getPembayaranAll()
        {
                $sql = "SELECT a.*,  substr(CONCAT(b.kode_order,' ',c.nama_customer),1,100) AS pesanan,
						 d.nama_cara_bayar, e.rekening AS nama_rekening, f.nama_pj AS nama_penerima,
						DATE_FORMAT(a.tgl_bayar,'%d %M %Y') AS tgl_bayar_tampil
						FROM pembayaran a 
						LEFT JOIN pesan b ON a.kode_order=b.kode_order 
						LEFT JOIN customer c ON b.kode_customer=c.kode_customer
						LEFT JOIN cara_bayar d ON a.cara_bayar=d.kode_cara_bayar 
						LEFT JOIN rekening e ON a.rekening=e.kode_rekening 
						LEFT JOIN pj_pesanan f ON f.kode_pj=a.penerima 
						ORDER BY a.tgl_bayar";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

    public function getPembayaranAllAsc($tgldari,$tglsampai)
        {
                $sql = "SELECT
  `a`.`kode_pembayaran` AS `kode_pembayaran`,
  `a`.`tgl_bayar`       AS `tgl_bayar`,
  `a`.`kode_order`      AS `kode_order`,
  FORMAT(`a`.`jumlah_bayar`,0) AS `jumlah_bayar`,
  `a`.`cara_bayar`      AS `cara_bayar`,
  `a`.`rekening`        AS `rekening`,
  `a`.`pengirim`        AS `pengirim`,
  `a`.`penerima`        AS `penerima`,
  SUBSTR(CONCAT(`b`.`kode_order`,_latin1' ',`c`.`nama_customer`),1,100) AS `pesanan`,
  `d`.`nama_cara_bayar` AS `nama_cara_bayar`,
  `e`.`rekening`        AS `nama_rekening`,
  `f`.`nama_pj`         AS `nama_penerima`,
  DATE_FORMAT(`a`.`tgl_bayar`,_utf8'%d %M %Y') AS `tgl_bayar_tampil`
FROM `pembayaran` `a`
       LEFT JOIN `pesan` `b`
         ON `a`.`kode_order` = `b`.`kode_order`
      LEFT JOIN `customer` `c`
        ON `b`.`kode_customer` = `c`.`kode_customer`
     LEFT JOIN `cara_bayar` `d`
       ON `a`.`cara_bayar` = `d`.`kode_cara_bayar`
    LEFT JOIN `rekening` `e`
      ON `a`.`rekening` = `e`.`kode_rekening`
   LEFT JOIN `pj_pesanan` `f`
     ON `f`.`kode_pj` = `a`.`penerima` WHERE tgl_bayar BETWEEN '$tgldari' AND '$tglsampai' ORDER BY tgl_bayar asc";
                
                $query = $this->db->query($sql);

                return $query->result();
        }

	public function getPembayaranByKode($kodepembayaran)
        {
                $sql = "SELECT a.*,  substr(CONCAT(b.kode_order,' ',c.nama_customer),1,100) AS pesanan,
						 d.nama_cara_bayar, e.rekening AS nama_rekening, f.nama_pj AS nama_penerima,
						DATE_FORMAT(a.tgl_bayar,'%d %M %Y') AS tgl_bayar_tampil
						FROM pembayaran a 
						LEFT JOIN pesan b ON a.kode_order=b.kode_order 
						LEFT JOIN customer c ON b.kode_customer=c.kode_customer
						LEFT JOIN cara_bayar d ON a.cara_bayar=d.kode_cara_bayar 
						LEFT JOIN rekening e ON a.rekening=e.kode_rekening 
						LEFT JOIN pj_pesanan f ON f.kode_pj=a.penerima 
						where a.kode_pembayaran='$kodepembayaran'";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

    public function getCaraBayar()
        {
                $sql = "SELECT * from cara_bayar";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

	public function getRekening()
        {
                $sql = "SELECT * from rekening";
				
				$query = $this->db->query($sql);

                return $query->result();
        }


        private function _get_datatables_query()
   		{
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
	
	
}