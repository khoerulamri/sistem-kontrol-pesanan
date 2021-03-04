     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Rekening</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('rekening/simpan'); }
                    else 
                    { 
                        foreach($rekening as $c){
                            $kode_rekening=$c->kode_rekening;
                            $nama_rekening=$c->rekening;
                        }
                        echo base_url('rekening/simpanubah/'.urlencode($kode_rekening)); };?>" method="post">
                        <div class="form-group">
                            <label>Kode Rekening</label>
                            <input class="form-control" placeholder="Masukan kode rekening" name="kode_rekening"
                            <?php if($status=='ubah'){echo "value=\"".$kode_rekening."\"" ;} ?> maxlength="10" >
                        </div>
                        <div class="form-group">
                            <label>Nama Rekening</label>
                            <input class="form-control" placeholder="Masukan nama rekening" name="nama_rekening"
                            <?php if($status=='ubah'){echo "value=\"".$nama_rekening."\"" ;} ?> >
                        </div>
                        <div class="pull-right"><a href="<?php echo base_url('rekening');?>" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button></div>
					</form>
                </div>
            </div>
        </div>
    </section>
