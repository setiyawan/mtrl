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
                            <div class="row">
                                <div class="col-7">
                                    <div class="pull-left">
                                        <address style="margin-left: 0px;">
                                            <h4>
                                                Penggilingan Batu
                                                <i class="fa fa-print" onclick="window.print()" id="print-id" data-toggle="tooltip" title="Click disini untuk cetak laporan" style="cursor: pointer;"> </i> 
                                            </h4>
                                            <h1><b class="text-danger">NOYKIMA</b></h1>
                                            <p class="text-muted ml-1">
                                                Jl. Trunojoyo Km. 3 Ds. Klecorejo, Caruban
                                                <br>
                                                Telp. 081233982098
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="pull-right text-right">
                                        <address>
                                            <h4><?= $report_title ?></h4>
                                            <h3 class="font-bold"><?= $report_time ?></h3>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive mt-3" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Pemasukan (Rp)</th>
                                                    <th>Pengeluaran (Rp)</th>
                                                    <th>Balance (Rp)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $total_income = 0;
                                            $total_expense = 0;
                                            $balance = 0;
                                            
                                            foreach ($report as $key => $value) { 
                                                $additional_info = '';
                                                $value['total_income'] = $value['cashflow_type'] == 1 ? $value['cashflow_amount'] : 0;
                                                $value['total_expense'] = $value['cashflow_type'] == 2 ? $value['cashflow_amount'] : 0;

                                                $total_income += $value['total_income'];
                                                $total_expense += $value['total_expense'];
                                                $balance = $balance + $value['total_income'] - $value['total_expense'];
                                                
                                                if ($value['volume'] > 0) {
                                                    $additional_info = ' (' . $value['volume'] . ' m<sup>3</sup>)';
                                                }
                                            ?>
                                            <tr>
                                                <td class="text-center"> <?= $key+1 ?> </td>
                                                <td> <?= $this->Converter->to_indonesia_date_full($value['date']) ?> </td>
                                                <td> <?= $value['description'] . $additional_info ?> </td>
                                                <td> <?= $this->Converter->to_rupiah($value['total_income']) ?> </td>
                                                <td> <?= $this->Converter->to_rupiah($value['total_expense']) ?> </td>
                                                <td> <?= $this->Converter->to_rupiah($balance) ?> </td>
                                            </tr>
                                            <?php } ?>
                                            <thead>
                                                <tr>
                                                    <td class="text-center">#</td>
                                                    <td class="" colspan="2">Jumlah</td>
                                                    <td class=""><?= $this->Converter->to_rupiah($total_income) ?></td>
                                                    <td class=""><?= $this->Converter->to_rupiah($total_expense) ?></td>
                                                    <td class=""><?= $this->Converter->to_rupiah($balance) ?></td>
                                                </tr>
                                            </thead>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-center">
                                        <p>
                                            Dicetak oleh,
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
