<?php 
class M_pemesanan extends CI_Model {
	
	var $table = "(SELECT
  `a`.`kode_order`    AS `kode_order`,
  `a`.`tgl_order`     AS `tgl_order`,
  `a`.`tgl_tempo`     AS `tgl_tempo`,
  FORMAT(`a`.`total_harga`,0) AS `total_harga`,
  a.kode_customer,
  a.penanggung_jawab,
  a.kode_status,
  `b`.`nama_customer` AS `nama_customer`,
  `c`.`nama_pj`       AS `nama_pj`,
  `d`.`nama_status`   AS `nama_status`,
  DATE_FORMAT(`a`.`tgl_order`,_utf8'%d %b %y') AS `tgl_order_tampil`,
  IFNULL(DATE_FORMAT(`a`.`tgl_tempo`,_utf8'%d %b %y'),_utf8'') AS `tgl_tempo_tampil`,
  IFNULL(FORMAT(`a`.`sudah_bayar`,0),0) AS `sudah_bayar`,
  IFNULL(FORMAT(a.`total_harga`-ifnull(a.sudah_bayar,0),0),0)  AS `kekurangan`
FROM `pesan` `a`
     LEFT JOIN `customer` `b`
       ON `a`.`kode_customer` = `b`.`kode_customer`
    LEFT JOIN `pj_pesanan` `c`
      ON `a`.`penanggung_jawab` = `c`.`kode_pj`
   LEFT JOIN `status` `d`
     ON `a`.`kode_status` = `d`.`kode_status`) tabel"; //nama tabel dari database

    var $column_order = array(null,null,  'kode_order','tgl_order','tgl_order_tampil','nama_customer','nama_pj','total_harga','kekurangan','nama_status','tgl_tempo_tampil'); //field yang ada di table 
    var $column_search = array('kode_order','tgl_order','kode_customer','penanggung_jawab','nama_status','tgl_tempo','total_harga','nama_customer','nama_pj','kekurangan');  //field yang diizin untuk pencarian 
    var $order = array('tgl_order' => 'desc'); // default order 

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function checkPesanan($kodepesanan)
        {
                $sql = "select * from pesan where kode_order='$kodepesanan'";
				
				$query = $this->db->query($sql);
		        
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}


   	public function savePesanan($kode,$tglorder,$customer,$pj,$status,$tgltempo,$total)
        {
                
                if('lunas'==$status)
                {
                    $sql = "insert into pesan values ('$kode','$tglorder','$customer','$pj','$status','$tgltempo','$total','$total')"; 
                    $query = $this->db->query($sql);

                    $sql="insert into pembayaran (tgl_bayar, kode_order, jumlah_bayar, cara_bayar, rekening, pengirim, penerima) values ('$tglorder','$kode','$total','cash','','','$pj')";
                    $query = $this->db->query($sql);
                }            
                else
                {
                    $sql = "insert into pesan values ('$kode','$tglorder','$customer','$pj','$status','$tgltempo','$total','0')"; 
                    $query = $this->db->query($sql);

                }
		}

   	public function updatePesanan($kodelama,$kodebaru,$tglorder,$customer,$pj,$status,$tgltempo,$total)
        {
                $sql = "update pesan set kode_order='$kodebaru', tgl_order='$tglorder', kode_customer='$customer',penanggung_jawab='$pj', kode_status='$status', tgl_tempo='$tgltempo', total_harga='$total' where kode_order='$kodelama'";
				$query = $this->db->query($sql);

				
				if('lunas'==$status)
                {
                    				
				$sql ="SELECT * FROM pembayaran where kode_order='$kodebaru'";
				$query = $this->db->query($sql);
				$a= $query->result();
                $sudah_bayar=0;
                foreach ($a as $b ) {
                $sudah_bayar=$sudah_bayar+$b->jumlah_bayar;
                }
                $kekurangan=$total-$sudah_bayar;
				
                   $sql="insert into pembayaran (tgl_bayar, kode_order, jumlah_bayar, cara_bayar, rekening, pengirim, penerima) values ('$tglorder','$kodebaru','$kekurangan','cash','','','$pj')";
                   $query = $this->db->query($sql);
                   $sql = "update pesan set sudah_bayar='$total' where kode_order='$kodebaru'";
                   $query = $this->db->query($sql);

                }
		}

   	public function deletePesanan($kode)
        {
                $sql ="SELECT * FROM pesan where kode_order='$kode'";
                $query = $this->db->query($sql);
                $a= $query->result();
                foreach ($a as $b ) {
                $tgl_order=$b->tgl_order;
                $kode_customer=$b->kode_customer;
                $penanggung_jawab=$b->penanggung_jawab;
                $kode_status=$b->kode_status;
                $tgl_tempo=$b->tgl_tempo;
                $total_harga=$b->total_harga;
                }

                $sql="INSERT INTO pesan_hapus VALUES ('$kode','$tgl_order','$kode_customer','$penanggung_jawab','$kode_status','$tgl_tempo','$total_harga',NOW())";   
                $query = $this->db->query($sql);

                $sql = "delete from pesan where kode_order='$kode'";
				
				$query = $this->db->query($sql);
		}

   	public function getPesananAll()
        {
                $sql = "SELECT
  `a`.`kode_order`    AS `kode_order`,
  `a`.`tgl_order`     AS `tgl_order`,
  `a`.`tgl_tempo`     AS `tgl_tempo`,
  FORMAT(`a`.`total_harga`,0) AS `total_harga`,
  a.kode_customer,
  a.penanggung_jawab,
  a.kode_status,
  `b`.`nama_customer` AS `nama_customer`,
  `c`.`nama_pj`       AS `nama_pj`,
  `d`.`nama_status`   AS `nama_status`,
  DATE_FORMAT(`a`.`tgl_order`,_utf8'%d %b %y') AS `tgl_order_tampil`,
  IFNULL(DATE_FORMAT(`a`.`tgl_tempo`,_utf8'%d %b %y'),_utf8'') AS `tgl_tempo_tampil`,
  IFNULL(FORMAT(`a`.`sudah_bayar`,0),0) AS `sudah_bayar`,
  IFNULL(FORMAT(a.`total_harga`-ifnull(a.sudah_bayar,0),0),0)  AS `kekurangan`
FROM `pesan` `a`
     LEFT JOIN `customer` `b`
       ON `a`.`kode_customer` = `b`.`kode_customer`
    LEFT JOIN `pj_pesanan` `c`
      ON `a`.`penanggung_jawab` = `c`.`kode_pj`
   LEFT JOIN `status` `d`
     ON `a`.`kode_status` = `d`.`kode_status` ORDER BY tgl_order desc";
                
                $query = $this->db->query($sql);

                return $query->result();
        }

    public function getPesananAllnoView()
        {
                $sql = "SELECT
                      `a`.`kode_order`       AS `kode_order`,
                      `a`.`tgl_order`        AS `tgl_order`,
                      `a`.`kode_customer`    AS `kode_customer`,
                      `a`.`penanggung_jawab` AS `penanggung_jawab`,
                      `a`.`kode_status`      AS `kode_status`,
                      `a`.`tgl_tempo`        AS `tgl_tempo`,
                      FORMAT(`a`.`total_harga`,0) AS `total_harga`,
                      `b`.`nama_customer`    AS `nama_customer`,
                      `c`.`nama_pj`          AS `nama_pj`,
                      `d`.`nama_status`      AS `nama_status`,
                      DATE_FORMAT(`a`.`tgl_order`,_utf8'%d %b %y') AS `tgl_order_tampil`,
                      IFNULL(DATE_FORMAT(`a`.`tgl_tempo`,_utf8'%d %b %y'),_utf8'') AS `tgl_tempo_tampil`,
                      FORMAT((SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),'0')` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`)),0) AS `sudah_bayar`,
                      FORMAT((`a`.`total_harga` - (SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),'0')` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`))),0) AS `kekurangan`
                    FROM (((`pesan` `a`
                         LEFT JOIN `customer` `b`
                           ON ((`a`.`kode_customer` = `b`.`kode_customer`)))
                        LEFT JOIN `pj_pesanan` `c`
                          ON ((`a`.`penanggung_jawab` = `c`.`kode_pj`)))
                       LEFT JOIN `status` `d`
                         ON ((`a`.`kode_status` = `d`.`kode_status`)))
                    ORDER BY `a`.`tgl_order` DESC";
                
                $query = $this->db->query($sql);

                return $query->result();
        }

    public function getPesananAllAsc($tgldari,$tglsampai)
        {
                $sql = "SELECT
  `a`.`kode_order`    AS `kode_order`,
  `a`.`tgl_order`     AS `tgl_order`,
  `a`.`tgl_tempo`     AS `tgl_tempo`,
  FORMAT(`a`.`total_harga`,0) AS `total_harga`,
  a.kode_customer,
  a.penanggung_jawab,
  a.kode_status,
  `b`.`nama_customer` AS `nama_customer`,
  `c`.`nama_pj`       AS `nama_pj`,
  `d`.`nama_status`   AS `nama_status`,
  DATE_FORMAT(`a`.`tgl_order`,_utf8'%d %b %y') AS `tgl_order_tampil`,
  IFNULL(DATE_FORMAT(`a`.`tgl_tempo`,_utf8'%d %b %y'),_utf8'') AS `tgl_tempo_tampil`,
  IFNULL(FORMAT(`a`.`sudah_bayar`,0),0) AS `sudah_bayar`,
  IFNULL(FORMAT(a.`total_harga`-ifnull(a.sudah_bayar,0),0),0)  AS `kekurangan`
FROM `pesan` `a`
     LEFT JOIN `customer` `b`
       ON `a`.`kode_customer` = `b`.`kode_customer`
    LEFT JOIN `pj_pesanan` `c`
      ON `a`.`penanggung_jawab` = `c`.`kode_pj`
   LEFT JOIN `status` `d`
     ON `a`.`kode_status` = `d`.`kode_status` WHERE tgl_order BETWEEN '$tgldari' AND '$tglsampai' ORDER BY tgl_order asc";
                
                $query = $this->db->query($sql);

                return $query->result();
        }

     public function getPesananAllPJ($tgldari,$tglsampai)
        {
                $sql = "SELECT
  `a`.`kode_order`    AS `kode_order`,
  `a`.`tgl_order`     AS `tgl_order`,
  `a`.`tgl_tempo`     AS `tgl_tempo`,
  FORMAT(`a`.`total_harga`,0) AS `total_harga`,
  a.kode_customer,
  a.penanggung_jawab,
  a.kode_status,
  `b`.`nama_customer` AS `nama_customer`,
  `c`.`nama_pj`       AS `nama_pj`,
  `d`.`nama_status`   AS `nama_status`,
  DATE_FORMAT(`a`.`tgl_order`,_utf8'%d %b %y') AS `tgl_order_tampil`,
  IFNULL(DATE_FORMAT(`a`.`tgl_tempo`,_utf8'%d %b %y'),_utf8'') AS `tgl_tempo_tampil`,
  IFNULL(FORMAT(`a`.`sudah_bayar`,0),0) AS `sudah_bayar`,
  IFNULL(FORMAT(a.`total_harga`-ifnull(a.sudah_bayar,0),0),0)  AS `kekurangan`
FROM `pesan` `a`
     LEFT JOIN `customer` `b`
       ON `a`.`kode_customer` = `b`.`kode_customer`
    LEFT JOIN `pj_pesanan` `c`
      ON `a`.`penanggung_jawab` = `c`.`kode_pj`
   LEFT JOIN `status` `d`
     ON `a`.`kode_status` = `d`.`kode_status` 
     where tgl_order BETWEEN '$tgldari' AND '$tglsampai'
     ORDER BY penanggung_jawab,tgl_order";
                
                $query = $this->db->query($sql);

                return $query->result();
        }

    public function getPesananAllTempo()
        {
                $sql = "SELECT
  `a`.`kode_order`    AS `kode_order`,
  `a`.`tgl_order`     AS `tgl_order`,
  `a`.`tgl_tempo`     AS `tgl_tempo`,
  FORMAT(`a`.`total_harga`,0) AS `total_harga`,
  a.kode_customer,
  a.penanggung_jawab,
  a.kode_status,
  `b`.`nama_customer` AS `nama_customer`,
  `c`.`nama_pj`       AS `nama_pj`,
  `d`.`nama_status`   AS `nama_status`,
  DATE_FORMAT(`a`.`tgl_order`,_utf8'%d %b %y') AS `tgl_order_tampil`,
  IFNULL(DATE_FORMAT(`a`.`tgl_tempo`,_utf8'%d %b %y'),_utf8'') AS `tgl_tempo_tampil`,
  IFNULL(FORMAT(`a`.`sudah_bayar`,0),0) AS `sudah_bayar`,
  IFNULL(FORMAT(a.`total_harga`-ifnull(a.sudah_bayar,0),0),0)  AS `kekurangan`
FROM `pesan` `a`
     LEFT JOIN `customer` `b`
       ON `a`.`kode_customer` = `b`.`kode_customer`
    LEFT JOIN `pj_pesanan` `c`
      ON `a`.`penanggung_jawab` = `c`.`kode_pj`
   LEFT JOIN `status` `d`
     ON `a`.`kode_status` = `d`.`kode_status` WHERE a.kode_status='tempo' ORDER BY kode_order";

                $query = $this->db->query($sql);

                return $query->result();
        }

    public function getHutangCustomerAll()
        {
                $sql = "SELECT c.kode_customer,c.`nama_customer`,
FORMAT((SELECT SUM(CAST(REPLACE(sudah_bayar,',','') AS UNSIGNED INTEGER)) FROM pesan WHERE kode_customer=c.kode_customer),0) AS sudah_dibayar, 
FORMAT((SELECT SUM(CAST(REPLACE(total_harga-sudah_bayar,',','') AS UNSIGNED INTEGER)) FROM pesan WHERE kode_customer=c.kode_customer),0) AS belum_dibayar, 
FORMAT((SELECT SUM(CAST(REPLACE(total_harga,',','') AS UNSIGNED INTEGER)) FROM pesan WHERE kode_customer=c.kode_customer),0) total         
FROM customer c ORDER BY c.`nama_customer`;";

				$query = $this->db->query($sql);

                return $query->result();
        }

	public function getPesananByKode($kodepesanan)
        {
                $sql = "SELECT a.*,b.nama_customer,c.nama_pj,d.nama_status,
				DATE_FORMAT(a.tgl_order,'%d %M %Y') AS tgl_order_tampil,
				IFNULL(DATE_FORMAT(a.tgl_tempo,'%d %M %Y'),'') AS tgl_tempo_tampil,
				(a.total_harga - (SELECT IFNULL(SUM(jumlah_bayar),'0') 
				FROM pembayaran z WHERE z.kode_order=a.kode_order)) AS kekurangan 
				FROM pesan a LEFT JOIN customer b ON a.kode_customer = b.kode_customer 
				LEFT JOIN pj_pesanan c ON a.penanggung_jawab = c.kode_pj   
				LEFT JOIN `status` d ON a.kode_status = d.kode_status where a.kode_order='$kodepesanan'";
				
				$query = $this->db->query($sql);

                return $query->result();
        }


    public function lapPemesananByDate($tgldari,$tglsampai)
        {
                $sql="SELECT tgl_order FROM pesan WHERE tgl_order BETWEEN '$tgldari' AND '$tglsampai' GROUP BY tgl_order ORDER BY tgl_order";
                $query = $this->db->query($sql);
                return $query->result();                

        }

    public function lapkinerjapj($tgldari,$tglsampai)
        {
                $sql="
                SELECT pp.kode_pj,pp.`nama_pj`, 
                (SELECT COUNT(*) FROM pesan p WHERE p.penanggung_jawab=pp.kode_pj and p.tgl_order BETWEEN '$tgldari' and '$tglsampai') AS pesanan_lunas,
                FORMAT((SELECT SUM(p.total_harga) FROM pesan p WHERE p.penanggung_jawab=pp.kode_pj and p.tgl_order BETWEEN '$tgldari' and '$tglsampai'),0) AS total_pesanan,
                (SELECT COUNT(*) FROM pesan p WHERE p.kode_status='tempo' AND penanggung_jawab=pp.kode_pj and p.tgl_order BETWEEN '$tgldari' and '$tglsampai') AS pesanan_tempo,
                FORMAT((SELECT SUM(CAST(REPLACE(sudah_bayar,',','') AS UNSIGNED INTEGER)) FROM pesan WHERE kode_status='tempo' AND penanggung_jawab=pp.kode_pj and tgl_order BETWEEN '$tgldari' and '$tglsampai' ),0) AS sudah_dibayar, 
                FORMAT((SELECT SUM(CAST(REPLACE(total_harga-sudah_bayar,',','') AS UNSIGNED INTEGER)) FROM pesan WHERE kode_status='tempo' AND penanggung_jawab=pp.kode_pj  and tgl_order BETWEEN '$tgldari' and '$tglsampai' ),0) AS belum_dibayar, 
                FORMAT((SELECT SUM(CAST(REPLACE(total_harga,',','') AS UNSIGNED INTEGER)) FROM pesan WHERE kode_status='tempo' AND penanggung_jawab=pp.kode_pj  and tgl_order BETWEEN '$tgldari' and '$tglsampai' ),0) total 
                FROM pj_pesanan pp ORDER BY nama_pj;
";  
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