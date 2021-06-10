<?php $this->view('side/header'); ?>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        
        <?php $this->view('navbar/top_navbar'); ?>
        
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
        <?php $this->view('navbar/left_navbar'); ?>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <?php $this->view('filter/'.$filter['filter_search']); ?>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                
                <div class="row">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table myTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Volume</th>
                                                <th>Sopir</th>
                                                <th>Pemasukan (Rp)</th>
                                                <th>Pengeluaran (Rp)</th>
                                                <th>Balance (Rp)</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_income = 0;
                                            $total_expense = 0;
                                            $balance = 0;
                                            
                                            foreach ($report as $key => $value) { 
                                                $volume = '';
                                                $value['total_income'] = $value['cashflow_type'] == 1 ? $value['cashflow_amount'] : 0;
                                                $value['total_expense'] = $value['cashflow_type'] == 2 ? $value['cashflow_amount'] : 0;

                                                $total_income += $value['total_income'];
                                                $total_expense += $value['total_expense'];
                                                $balance = $balance + $value['total_income'] - $value['total_expense'];
                                                
                                                if ($value['volume'] > 0) {
                                                    $volume = $value['volume'] . ' m<sup>3</sup>';
                                                }
                                            ?>
                                            <tr>
                                                <td> <?= $key+1 ?> </td>
                                                <td> <?= $this->Converter->to_indonesia_date_full($value['date']) ?> </td>
                                                <td> <?= $value['description'] ?> </td>
                                                <td> <?= $volume ?> </td>
                                                <td> <?= $value['driver_name'] ?> </td>
                                                <td> <?= $this->Converter->to_rupiah($value['total_income']) ?> </td>
                                                <td> <?= $this->Converter->to_rupiah($value['total_expense']) ?> </td>
                                                <td> <?= $this->Converter->to_rupiah($balance) ?> </td>
                                                <td> <?= $this->TransactionConstant->get_paidoff_status()[$value['is_paid_off']] ?> </td>
                                            </tr>
                                            <?php } ?>
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <td class="" colspan="4">Jumlah</td>
                                                <td class=""><?= $this->Converter->to_rupiah($total_income) ?></td>
                                                <td class=""><?= $this->Converter->to_rupiah($total_expense) ?></td>
                                                <td class=""><?= $this->Converter->to_rupiah($balance) ?></td>
                                                <td class=""></td>
                                            </tr>
                                        </thead>
                                        </tbody>
                                    </table>
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
            <?php $this->view('navbar/buttom_navbar'); ?>
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

    <?php $this->view('side/footer'); ?>

</body>

</html>
