     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Setting Warna</h3>
            </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url('warna/simpan');?>" method="post">
                            <div class="form-group">
                                <label>Waktu Tempo Sudah Lewat</label>
                                <select id="Warna1" name="ojt1w" class="form-control">
                                    <option value="gray" <?php if($ojt1w=='gray'){echo "selected";} ?>>Abu-Abu</option>
                                    <option value="red" <?php if($ojt1w=='red'){echo "selected";} ?>>Merah</option>
                                    <option value="yellow" <?php if($ojt1w=='yellow'){echo "selected";} ?>>Kuning</option>
                                    <option value="green" <?php if($ojt1w=='green'){echo "selected";} ?>>Hijau</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Waktu tempo kurang 2 Hari dari sekarang </label>
                                <select id="Warna2" name="ojt2w" class="form-control">
                                        <option value="gray" <?php if($ojt2w=='gray'){echo "selected";} ?>>Abu-Abu</option>
                                        <option value="red" <?php if($ojt2w=='red'){echo "selected";} ?>>Merah</option>
                                        <option value="yellow" <?php if($ojt2w=='yellow'){echo "selected";} ?>>Kuning</option>
                                        <option value="green" <?php if($ojt2w=='green'){echo "selected";} ?>>Hijau</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Waktu tempo kurang 3 Hari sampai 4 Hari dari sekarang </label>
                                <select id="Warna3" name="ojt3w" class="form-control">
                                        <option value="gray" <?php if($ojt3w=='gray'){echo "selected";} ?>>Abu-Abu</option>
                                        <option value="red" <?php if($ojt3w=='red'){echo "selected";} ?>>Merah</option>
                                        <option value="yellow" <?php if($ojt3w=='yellow'){echo "selected";} ?>>Kuning</option>
                                        <option value="green" <?php if($ojt3w=='green'){echo "selected";} ?>>Hijau</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Waktu tempo lebih dari atau sama dengan 5 Hari dari sekarang </label>
                                <select id="Warna4" name="ojt4w" class="form-control select2">
                                        <option value="gray" <?php if($ojt4w=='gray'){echo "selected";} ?>>Abu-Abu</option>
                                        <option value="red" <?php if($ojt4w=='red'){echo "selected";} ?>>Merah</option>
                                        <option value="yellow" <?php if($ojt4w=='yellow'){echo "selected";} ?>>Kuning</option>
                                        <option value="green" <?php if($ojt4w=='green'){echo "selected";} ?>>Hijau</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                            </div>
                    </div>
                            <!-- /.row (nested) -->
                </div>
                </form>
        </div>
    </section>