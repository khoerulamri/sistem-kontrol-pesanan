     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Instansi</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php echo base_url('instansi/simpan');?>" method="post">
                        <div class="form-group">
                            <label>Nama Instansi</label>
                            <input class="form-control" name="nama_instansi" value="<?php echo $nama_instansi;?>" placeholder="Masukan nama instansi">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input class="form-control"  name="telepon" value="<?php echo $telepon;?>" placeholder="Masukan nomor telepon">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input class="form-control" name="alamat" value="<?php echo $alamat;?>" placeholder="Masukan alamat">
                        </div>
                        <div class="form-group">
                            <label>Slogan</label>
                            <input class="form-control" name="slogan" value="<?php echo $slogan;?>" placeholder="Masukan slogan instansi">
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input class="form-control" name="website" value="<?php echo $website;?>" placeholder="Masukan website instansi">
                        </div>
                        <div>
                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                        </div>
                        <div>
                            <?php 
                            if(isset($pesan))
                                {
                                    echo $pesan;
                                }

                            ?>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> 