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
                <div class="row page-titles">
                    <div class="col-md-8 col-8 align-self-center">
                        <h3 class="text-themecolor"><?= $page_title ?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $parent_page_url ?>"><?= $parent_page ?></a></li>
                            <li class="breadcrumb-item active"><?= $page_child ?></li>
                        </ol>
                    </div>
                    <div class="col-md-4 col-4 align-self-center">
                    	<button class="btn btn-info pull-right" data-toggle="tooltip" title="Tambah data Transaksi" onclick="document.location.href='<?= base_url()?>transaksi/tambah'"><i class="mdi mdi-plus"></i>Transaksi Baru</button>
                    </div>
                </div>
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
                                                <th>Tanggal Transaksi</th>
                                                <th>No Nota</th>
                                                <th>Jenis Material</th>
                                                <th>Nopol Kendaraan</th>
                                                <th>Penerima</th>
                                                <th>Total Harga</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($transaction as $key => $value) { ?>
                                            <tr>
                                                <td> <?= $key+1 ?> </td>
                                                <td> <?= $this->Converter->to_indonesia_date($value['transaction_time']) ?> </td>
                                                <td> <?= $value['invoice_code'] ?> </td>
                                                <td> <?= $value['material_name'] ?> </td>
                                                <td> <?= $value['license_plate'] ?> </td>
                                                <td> <?= $value['receiver_name'] ?> </td>
                                                <td> <?= $this->Converter->to_rupiah($value['total_price']) ?> </td>
                                                <td width="160px">
                                                    <button class="btn btn-success" data-toggle="tooltip" title="Cetak invoice" onclick="window.open('<?= base_url()?>transaksi/invoice?id=<?= $value['transaction_id'] ?>')"><i class="mdi mdi-printer"></i></button>
                                                	<button class="btn btn-warning" data-toggle="tooltip" title="Perbarui data transaksi" onclick="document.location.href='<?= base_url()?>transaksi/detail?id=<?= $value['transaction_id'] ?>'"><i class="mdi mdi-pencil"></i></button>
                                                	<button class="btn btn-danger" data-toggle="tooltip" title="Hapus data transaksi" onclick="if (!confirm('Kamu yakin ingin hapus data transaksi ini?')) return; document.location.href='<?= base_url()?>transaksi/delete?id=<?= $value['transaction_id'] ?>'"><i class="mdi mdi-delete"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
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
