<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('dashboard'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>KP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SKP </b>v.1.2.0.0</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/avatar04.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <strong><?php echo $nama_petugas;?> </strong><br>
          <a href="<?php echo base_url('changepassword');?>"><i class="fa fa-key"></i> Ganti Password</a><br>
          <a href="<?php echo base_url('logout');?>"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class=" <?php if($menu_active=='dashboard')
                                    {
                                        echo 'active';
                                    }?> ">
          <a href="<?php echo base_url('dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php if(($menu_active=='pemesanan')||($menu_active=='pembayaran'))
                                    {
                                        echo 'active';
                                    }?> treeview" >
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($menu_active=='pemesanan')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('pemesanan');?>"><i class="fa fa-file-text-o"></i>Pemesanan</a></li>
            <li <?php if($menu_active=='pembayaran')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('pembayaran');?>"><i class="fa fa-file-text"></i> Pembayaran</a></li>
          </ul>
        </li>
        <li class="<?php if(($menu_active=='laporanpemesanan')||($menu_active=='laporanpembayaran')||($menu_active=='laporanpemesananperpj')||($menu_active=='laporankinerjaperpj')||($menu_active=='laporanhutangcustomer'))
                                    {
                                        echo 'active';
                                    }?> treeview" >
          <a href="#">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($menu_active=='laporanpemesanan')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('laporan/laporanPemesanan')?>"><i class="fa fa-book"></i>Lap. Pemesanan</a></li>
            <li <?php if($menu_active=='laporanpembayaran')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('laporan/laporanpembayaran')?>"><i class="fa fa-book"></i>Lap. Pembayaran</a></li>
            <li <?php if($menu_active=='laporanpemesananperpj')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php  echo base_url('laporan/laporanPemesananPerPJ');?>"><i class="fa fa-book"></i>Lap. Pemesanan Per PJ</a></li>
            <li <?php if($menu_active=='laporankinerjaperpj')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('laporan/laporanKinerjaPJ'); ?>"><i class="fa fa-book"></i>Lap. Kinerja Per PJ</a></li>
            <li <?php if($menu_active=='laporanhutangcustomer')
                                    {
                                        echo 'class="active"';
                                    }?> ><a href="<?php echo base_url('laporan/laporanHutangCustomer'); ?>"><i class="fa fa-book"></i>Lap. Hutang Customer</a></li>
          </ul>
        </li>
        <?php 
        //Menu setting hanya muncul di halaman admin
        if("operator"!=$kode_hak_akses)
        {
        ?>
        <li class=" <?php if(($menu_active=='instansi')||($menu_active=='customer')||($menu_active=='pj')||($menu_active=='rekening')||($menu_active=='warna'))
                                    {
                                        echo 'active';
                                    }?> treeview">
          <a href="#">
            <i class="fa fa-cog"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($menu_active=='instansi')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('instansi');?>"><i class="fa fa-home"></i>Instansi</a></li>
            <li <?php if($menu_active=='customer')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('customer');?>"><i class="fa fa-users"></i>Customer</a></li>
            <li <?php if($menu_active=='pj')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('pj');?>"><i class="fa fa-user"></i>Penanggung Jawab</a></li>
            <li <?php if($menu_active=='rekening')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('rekening');?>"><i class="fa fa-credit-card"></i>Rekening</a></li>
            <li <?php if($menu_active=='warna')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('warna');?>"><i class="fa fa-bars"></i>Warna</a></li>
          </ul>
        </li>
        <?php 
        }
        //end if menu setting login admin
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">