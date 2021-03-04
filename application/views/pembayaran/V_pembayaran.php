     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pembayaran</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('pembayaran/simpan'); }
                    else 
                    { 

                        foreach($pembayaran as $c){
                            $kode_pembayaran=$c->kode_pembayaran;
                            $kode_order=$c->kode_order;
                            $tgl_bayar=$c->tgl_bayar;
                            $cara_bayar=$c->cara_bayar;
                            $rekening=$c->rekening;
                            $jumlah_bayar=$c->jumlah_bayar;
                            $pengirim=$c->pengirim;
                            $penerima=$c->penerima;
                        }
                        if ('01-01-1970'==$tgl_bayar || '0000-00-00' == $tgl_bayar) {
                            $tgl_bayar='';
                        }
                        else
                        {
                            $tgl_bayar=date('d-m-Y',strtotime($tgl_bayar));
                        }
                        echo base_url('pembayaran/simpanubah/'.urlencode($kode_pembayaran)); };?>" method="post">
                        <div class="form-group">
                            <label>Tanggal Pembayaran</label>
                            <input type="text" class="form-control" value="<?php if($status=='ubah'){echo date('d-m-Y',strtotime($tgl_bayar));}
                            else
                            { echo date('d-m-Y');} ?>" id="tgl_bayar" name="tgl_bayar" required>
                        </div>
						<div class="form-group">
                            <label>Order Yang Dibayar (Pesanan | Total Tagihan - Sudah Bayar = Kekurangan)</label>
							<select  id="kode_order" class="form-control" name="kode_order" required>
                                    <?php 
                                    foreach ($getAllPesananTempo as $gAPT) {
                                        if($status=='ubah' && $kode_order==$gAPT->kode_order)
                                        {
                                        echo "<option value=".urlencode($gAPT->kode_order)." selected>".$gAPT->kode_order." - ".$gAPT->nama_customer." | ".$gAPT->total_harga." - ".($gAPT->sudah_bayar)." = ".$gAPT->kekurangan."</option>";
                                        }
                                        else
                                        {
                                        echo "<option value=".urlencode($gAPT->kode_order).">".$gAPT->kode_order." - ".$gAPT->nama_customer." | ".$gAPT->total_harga." - ".($gAPT->sudah_bayar)." = ".$gAPT->kekurangan."</option>";
                                        }   
                                    }

                                    ?>
                                </select>
                        </div>
                        
                         <div class="form-group">
                            <label>Yang Dibayarkan</label>                                          
                            <input class="form-control" placeholder="Masukan jumlah uang yang dibayarkan"  type="number" <?php if($status=='ubah'){echo "value=\"".$jumlah_bayar."\"" ;} ?>  name="jumlah_bayar" required>
                        </div>  
                        <div class="form-group">
                            <label>Penerima</label>
                           <select id="penerima" class="form-control" name="penerima" required>
                                    <?php 
                                    foreach ($getAllpj as $gAP) {
                                        if($status=='ubah' && $penerima==$gAP->kode_pj)
                                        {
                                        echo "<option value=".$gAP->kode_pj." selected>".$gAP->nama_pj."</option>";
                                        }
                                        else
                                        {
                                        echo "<option value=".$gAP->kode_pj.">".$gAP->nama_pj."</option>";
                                        }
                                    }

                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Cara Pembayaran</label>
                            <select  id="cara_bayar" class="form-control" name="cara_bayar" required>
                                    <?php 
                                    foreach ($getAllCaraBayar as $gACB) {
                                        if($status=='ubah' && $cara_bayar==$gACB->kode_cara_bayar)
                                        {
                                        echo "<option value=".$gACB->kode_cara_bayar." selected>".$gACB->nama_cara_bayar."</option>";
                                        }
                                        else
                                        {
                                        echo "<option value=".$gACB->kode_cara_bayar.">".$gACB->nama_cara_bayar."</option>";
                                        }   
                                    }

                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Rekening Tujuan</label>
                            <select  id="rekening" class="form-control" name="rekening">
                                    <option value="">-</option>
                                    <?php 
                                    foreach ($getAllRekening as $gAR) {
                                        if($status=='ubah' && $rekening==$gAR->kode_rekening)
                                        {
                                        echo "<option value=".$gAR->kode_rekening." selected>".$gAR->rekening."</option>";
                                        }
                                        else
                                        {
                                        echo "<option value=".$gAR->kode_rekening.">".$gAR->rekening."</option>";
                                        }   
                                    }

                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Pengirim</label>
                            <input type="text" class="form-control" value="<?php if($status=='ubah'){echo $pengirim;}?>" id="pengirim" name="pengirim">
                        </div>                  
                       <div class="pull-right">
                        <span><a href="<?php echo base_url('pembayaran');?>" class="btn btn-primary">Kembali</a></span>
                        <span><button type="submit" class="btn btn-success">Simpan</button></span>
                        </div>
					</form>
                </div>
               </div>
           </div>
       </section>