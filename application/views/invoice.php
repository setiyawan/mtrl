<?php $this->view('side/header'); ?>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="">
            <!-- Alert  -->
            <!-- ============================================================== -->
            <!-- End Alert  -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <h3>
                                #<?= $transaction['invoice_code'] ?> &nbsp <i class="fa fa-print" onclick="window.print()" id="print-id" data-toggle="tooltip" title="Click disini untuk cetak invoice" style="cursor: pointer;"> </i> 
                                <span class="pull-right">
                                    <p class="text-muted" style="text-align: right; font-size: 12px; margin-top: -10px;"> <i class="fa fa-calendar"> </i> Caruban, <?= $this->Converter->to_indonesia_date_full($transaction['transaction_time']) ?></p>   
                                </span>
                            </h3>
                            <div class="row">
                                <div class="col-7">
                                    <div class="pull-left">
                                        <address style="margin-left: 0px;">
                                            <h4>Penggilingan Batu</h4>
                                            <h1><b class="text-danger">NOYKIMA</b></h1>
                                            <p class="text-muted ml-1">
                                                Jl. Trunojoyo Km. 3 Ds. Klecorejo, Caruban
                                                <br>
                                                Telp. (0351) 388383
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="pull-right text-right">
                                        <address>
                                            <h4>Kepada yth,</h4>
                                            <h3 class="font-bold"><?= $transaction['receiver_name'] ?></h3>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive mt-3" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Jenis Batu - Ukuran Bak</th>
                                                    <th class="text-center">Volume (m<sup>3</sup>)</th>
                                                    <th class="text-center">Harga Satuan</th>
                                                    <th class="text-right">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td><?= $transaction['material_name'] ?> <br> <i style="font-size: 12px;"> (<?= $transaction['length'] . ' x ' . $transaction['width'] . ' x ' . $transaction['height'] ?>) </i> </td>
                                                    <td class="text-center"> <?= $transaction['volume'] ?> </td>
                                                    <td class="text-center"> <?= $this->Converter->to_rupiah($transaction['item_price']) ?> </td>
                                                    <td class="text-right"> <?= $this->Converter->to_rupiah($transaction['total_price']) ?> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pull-left mt-2 text-left">
                                        <p>Nopol Kendaraan: <b> <?= $transaction['license_plate'] ?> </b> </p>
                                        <p>Nama Sopir: <b> <?= $transaction['driver_name'] ?> </b> </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pull-right mt-2 text-right">
                                        <h3><b>Total :</b> <?= $this->Converter->to_rupiah($transaction['total_price']) ?></h3>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-center">
                                        <p>
                                            Tanda Terima,
                                            <br>
                                            <br>
                                            <br>
                                            <b> <?= $user_full_name ?> </b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row -->
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url()?>asset/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>asset/plugins/bootstrap/js/tether.min.js"></script>
    <script src="<?= base_url()?>asset/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
