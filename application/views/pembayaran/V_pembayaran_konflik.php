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
alert('Kode Pembayaran Sudah Digunakan!');
</script>