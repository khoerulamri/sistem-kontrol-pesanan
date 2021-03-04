

     <!-- Main content -->
    <section class="content"> 
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
              <a href="<?php echo base_url('pemesanan/tambah');?>">
            <span class="info-box-icon bg-grey"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Klik Disini untuk </span>
              <span class="info-box-number">PEMESANAN</span>
            </div>
               </a>
            <!-- /.info-box-content -->
          </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
              <a href="<?php echo base_url('pembayaran/tambah');?>">
            <span class="info-box-icon bg-grey"><i class="fa fa-file-text"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Klik Disini untuk </span>
              <span class="info-box-number">PEMBAYARAN </span>
            </div>
              </a>
            <!-- /.info-box-content -->
          </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
              <div class="info-box-content">
                <?php 
                    foreach($order_hari_ini as $a) {
                      $jmlorder=$a->jml_order;
                      $total_harga=$a->total_harga;
                    }
                ?>
                <span class="info-box-text">Pesanan Diterima Hari Ini</span>
                <span class="info-box-text"><?php echo $jmlorder; ?> Order</span><br>
                <span class="info-box-number">Rp <?php echo $total_harga; ?>,-</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>
              <?php 
                    foreach ($bayar_hari_ini as $a) {
                      $jmlorder=$a->jml_pembayaran;
                      $total_harga=$a->jumlah_bayar;
                    }
                ?>
              <div class="info-box-content">
                <span class="info-box-text">Total Pembayaran Diterima Hari Ini</span>
                <span class="info-box-text"><?php echo $jmlorder; ?> Transaksi</span><br>
                <strong><span class="info-box-number">Rp <?php echo $total_harga; ?></span></strong>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php 
              foreach ($lewat_batas_tempo as $a) {
              $jml=$a->jml;
              }
              echo "<h3>$jml</h3>";
                ?>
              <p>Order Lewat Jatuh Tempo</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('dashboard/monitoringTempo/red');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php 
              foreach ($lewat_batas_tempo2 as $a) {
              $jml=$a->jml;
              }
              echo "<h3>$jml</h3>";
                ?>

              <p>Order Tempo Kurang 2 Hari</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('dashboard/monitoringTempo/yellow');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php 
             foreach ($lewat_batas_tempo34 as $a) {
              $jml=$a->jml;
              }
              echo "<h3>$jml</h3>";
                ?>

              <p>Order Tempo Kurang 3-4 Hari</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('dashboard/monitoringTempo/blue');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             <?php 
              foreach ($lewat_batas_tempo5 as $a) {
              $jml=$a->jml;
              }
              echo "<h3>$jml</h3>";
                ?>

              <p>Order Tempo lebih dari 5 Hari</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('dashboard/monitoringTempo/green');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
    </section>
    <!-- /.content -->

