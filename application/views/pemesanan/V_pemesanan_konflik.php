<meta http-equiv="refresh" content="0; url=<?php 
if($status=='tambah'){
echo base_url('pemesanan/tambah');
}
else
{
echo base_url('pemesanan/ubah/'.$kode_pemesanan); 
}
?>" />
<script>
alert('Kode Pemesanan Sudah Digunakan!');
</script>