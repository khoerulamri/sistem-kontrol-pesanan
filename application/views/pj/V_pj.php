     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Penanggung Jawab</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('pj/simpan'); }
                    else 
                    { 
                        foreach($pj as $c){
                            $kode_pj=$c->kode_pj;
                            $nama_pj=$c->nama_pj;
                            $telpon=$c->telpon;
                            $alamat=$c->alamat;
                            $keterangan=$c->keterangan;
                        }
                        echo base_url('pj/simpanubah/'.urlencode($kode_pj)); };?>" method="post">
                        <div class="form-group">
                            <label>Kode Penanggung Jawab</label>
                            <input class="form-control" placeholder="Masukan kode penanggung jawab" name="kode_pj"
                            <?php if($status=='ubah'){echo "value=\"".$kode_pj."\"" ;} ?> >
                        </div>
                        <div class="form-group">
                            <label>Nama Penanggung Jawab</label>
                            <input class="form-control" placeholder="Masukan nama penanggung jawab" name="nama_pj"
                            <?php if($status=='ubah'){echo "value=\"".$nama_pj."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input class="form-control" placeholder="Masukan telepon penanggung jawab" name="telpon"
                            <?php if($status=='ubah'){echo "value=\"".$telpon."\"" ;} ?> type="number" min="0">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input class="form-control" placeholder="Masukan alamat penanggung jawab" name="alamat"
                            <?php if($status=='ubah'){echo "value=\"".$alamat."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input class="form-control" placeholder="Masukan keterangan" name="keterangan"
                            <?php if($status=='ubah'){echo "value=\"".$keterangan."\"" ;} ?>>
                        </div>
						<div class="pull-right"><a href="<?php echo base_url('pj');?>" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button></div>
					</form>
                </div>
            </div>
        </div>
    </section>