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
                        <h3 class="text-themecolor"><?= $page_title ?>
                    	   <button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah data material" onclick="document.location.href='<?= base_url()?>material/tambah'"><i class="mdi mdi-plus"></i>Tambah</button>
                        </h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $parent_page_url ?>"><?= $parent_page ?></a></li>
                            <li class="breadcrumb-item active"><?= $page_child ?></li>
                        </ol>
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
                                                <th>Nama Material</th>
                                                <th>Kode Material</th>
                                                <th>Harga per m<sup>3</sup></th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($material as $key => $value) { ?>
                                            <tr>
                                                <td> <?= $key+1 ?> </td>
                                                <td> <?= $value['material_name'] ?> </td>
                                                <td> <?= $value['material_code'] ?> </td>
                                                <td> <?= $this->Converter->to_rupiah($value['price']) ?> </td>
                                                <td width="120px">
                                                	<button class="btn btn-warning" data-toggle="tooltip" title="Perbarui data material" onclick="document.location.href='<?= base_url()?>material/detail?id=<?= $value["material_id"] ?>'"><i class="mdi mdi-pencil"></i></button>
                                                	<button class="btn btn-danger" data-toggle="tooltip" title="Hapus data material" onclick="if (!confirm('Kamu yakin ingin hapus data material ini?')) return; document.location.href='<?= base_url()?>material/delete?id=<?= $value["material_id"] ?>'"><i class="mdi mdi-delete"></i></button>
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
