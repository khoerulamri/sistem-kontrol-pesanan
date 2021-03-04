<meta http-equiv="refresh" content="0; url=<?php 
if($status=='tambah'){
echo base_url('pembayaran/tambah');
}
else
{
echo base_url('pembayaran/ubah/'.$kode_pembayaran);	
}
 ?>" />
<script>
alert('Tanggal Tempo Harus Terisi Jika Status Pemesanan TEMPO!');
</script>