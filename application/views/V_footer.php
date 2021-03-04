    </div>      
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.2.0.0
    </div>
    <strong>Copyright &copy;</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->


    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url('assets/bower_components/raphael/raphael.min.js'); ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'); ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('assets/bower_components/jquery-knob/dist/jquery.knob.min.js'); ?>"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="<?php echo base_url('assets/dist/js/pages/dashboard.js'); ?>"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script> -->
   

        <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/dataTables.bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/buttons.flash.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/jszip.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/vfs_fonts.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/buttons.colVis.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/currency.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/numeric-comma.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-responsive/dataTables.responsive.js'); ?>"></script>

    <script type="text/javascript">
    var table;
    $(document).ready(function() {
 
        //datatables
        table = $('#dataCustomer').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('customer/get_data_customer')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Customer',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('customer/tambah');?>';
                }
            }],
            "scrollX": true,
        });

        //datatables
        table = $('#dataPJ').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('pj/get_data_pj')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Penanggung Jawab',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('pj/tambah');?>';
                }
            }],
            "scrollX": true,
        }); 

        //datatables
        table = $('#dataRekening').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('rekening/get_data_rekening')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Rekening',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('rekening/tambah');?>';
                }
            }],
            "scrollX": true,
        });

        //datatables
        table = $('#dataPemesanan').DataTable({  
            "processing": true, 
            "serverSide": true,
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('pemesanan/get_data_pemesanan')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            },
            { 
                "targets":[6],
                "type": 'currency' , 
            },
            { 
                "targets":[7],
                "type": 'currency' , 
            },
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Pemesanan',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('pemesanan/tambah');?>';
                }
            }],
            "scrollX": true,
        }); 

        //datatables
        table = $('#dataMonitoringOrderLewatJatuhTempo').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('dashboard/get_data_red')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            },
            { 
                "targets":[6],
                "type": 'currency' , 
            },
            { 
                "targets":[7],
                "type": 'currency' , 
            },
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis'],
            "scrollX": true,
        }); 

        //datatables
        table = $('#dataMonitoringOrderTempoKurang2Hari').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('dashboard/get_data_yellow')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            },
            { 
                "targets":[6],
                "type": 'currency' , 
            },
            { 
                "targets":[7],
                "type": 'currency' , 
            },
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis'],
            "scrollX": true,
        }); 

        //datatables
        table = $('#dataMonitoringOrderTempoKurang3-4Hari').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('dashboard/get_data_blue')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            },
            { 
                "targets":[6],
                "type": 'currency' , 
            },
            { 
                "targets":[7],
                "type": 'currency' , 
            },
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis'],
            "scrollX": true,
        }); 


        //datatables
        table = $('#dataMonitoringOrderTempolebihdari5Hari').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('dashboard/get_data_green')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            },
            { 
                "targets":[6],
                "type": 'currency' , 
            },
            { 
                "targets":[7],
                "type": 'currency' , 
            },
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis'],
            "scrollX": true,
        }); 

        //datatables
        table = $('#dataPembayaran').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('pembayaran/get_data_pembayaran')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            },
            { 
                "targets":[4],
                "type": 'currency' , 
            },
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Pembayaran',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('pembayaran/tambah');?>';
                }
            }],
            "scrollX": true,
        }); 
    });
 
</script>


<script type="text/javascript">
        //Date picker
    $('#tglorder').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgltempo').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tglbayar').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgl_bayar').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgldari').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>
<script type="text/javascript">
        //Date picker
    $('#tglsampai').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
     })
</script>



</body>
</html>