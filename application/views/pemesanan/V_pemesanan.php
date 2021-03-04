     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Pemesanan</h3>
            </div>
            <div class="panel-body">

                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('pemesanan/simpan'); }
                    else 
                    { 
                        foreach($pemesanan as $c){
                            $kode_pemesanan=$c->kode_order;
                            $tglorder=$c->tgl_order;
                            $tgltempo=$c->tgl_tempo;
                            $kode_status=$c->kode_status;
                            $total_harga=$c->total_harga;
                            $kode_customer=$c->kode_customer;
                            $kode_pj=$c->penanggung_jawab;
                        }
                        if ('01-01-1970'==$tgltempo || '0000-00-00' == $tgltempo) {
                            $tgltempo='';
                        }
                        else
                        {
                            $tgltempo=date('d-m-Y',strtotime($tgltempo));
                        }
                        echo base_url('pemesanan/simpanubah/'.urlencode($kode_pemesanan)); };?>" method="post">
                        <div class="form-group">
                            <label>Kode Order</label>
                            <input class="form-control" placeholder="Masukan kode order"  name="kode_pemesanan"
                            <?php if($status=='ubah'){echo "value=\"".$kode_pemesanan."\"" ;} ?> required>
                        </div>
						<div class="form-group">
                            <label>Tanggal Order</label>
                            <input type="text" class="form-control" value="<?php if($status=='ubah'){echo date('d-m-Y',strtotime($tglorder));}
                            else
                            { echo date('d-m-Y');} ?>" id="tglorder" name="tglorder" required>
                        </div>
						<div class="form-group">
                            <label>Customer</label>
							<select  id="customer" class="form-control" name="kode_customer" required>
                                    <?php 
                                    foreach ($getAllCustomer as $gAC) {
                                        if($status=='ubah' && $kode_customer==$gAC->kode_customer)
                                        {
                                        echo "<option value=".$gAC->kode_customer." selected>".$gAC->nama_customer."</option>";
                                        }
                                        else
                                        {
                                        echo "<option value=".$gAC->kode_customer.">".$gAC->nama_customer."</option>";
                                        }   
                                    }

                                    ?>
                                </select>
                        </div>
						<div class="form-group">
                            <label>Penanggung Jawab</label>
							<select id="pj" class="form-control" name="kode_pj" required>
                                    <?php 
                                    foreach ($getAllpj as $gAP) {
                                        if($status=='ubah' && $kode_pj==$$gAP->kode_pj)
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
                            <label>Total Harga</label>											
                            <input class="form-control" placeholder="Masukan total harga"  type="number" <?php if($status=='ubah'){echo "value=\"".$total_harga."\"" ;} ?>  name="total_harga" required>
                        </div>
						<div class="form-group">
                            <label>Status</label>
							<select id="status" class="form-control" name="status" required>
                                    <option value="lunas" <?php if($status=='ubah' && $kode_status=='lunas'){echo "selected" ;} ?> >Lunas</option>
                                    <option value="tempo"  <?php if($status=='ubah' && $kode_status=='tempo'){echo "selected" ;} ?> >Tempo</option>
                                </select>
                        </div>		
                        <div class="form-group">
                            <label>Tanggal Tempo (Apabila Tempo)</label>
                            <input type="text" class="form-control" value="<?php if($status=='ubah'){echo $tgltempo;} ?>" id="tgltempo" name="tgltempo">
                        </div>								
                       <div class="pull-right"><a href="<?php echo base_url('pemesanan');?>" class="btn btn-info">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button></div>
					</form>
                </div>
            </div>
           </div>
       </section>
