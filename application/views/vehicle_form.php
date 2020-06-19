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
            <!-- Alert  -->
            <!-- ============================================================== -->
            <?php $this->view('alert'); ?>
            <!-- End Alert  -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor"><?= $page_title ?></h3>
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
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <form class="form-horizontal form-material" method="post" action="<?= $form_action ?>">
                                    <input type="hidden" name="vehicle_id" value="<?= $this->Ternary->isset_value($vehicle['vehicle_id'])?>">
                                    <div class="form-group col-xlg-4 col-md-4">
                                        <label>Jenis Kendaraan</label>
                                        <input type="text" name="vehicle_type" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($vehicle['vehicle_type'])?>">
                                    </div>
                                    <div class="form-group col-xlg-4 col-md-4">
                                        <label>Plat Nomor</label>
                                        <input type="text" name="license_plate" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($vehicle['license_plate'])?>">
                                    </div>
                                    <div class="form-group col-xlg-4 col-md-4">
                                        <label>Periode Pajak</label>
                                        <input type="date" name="tax_period" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($vehicle['tax_period'])?>">
                                    </div>
                                    <div class="form-group col-xlg-4 col-md-4">
                                        <label>Panjang (cm)</label>
                                        <input type="number" name="length" step="0.01" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($vehicle['length'])?>">
                                    </div>
                                    <div class="form-group col-xlg-4 col-md-4">
                                        <label>Lebar (cm)</label>
                                        <input type="number" name="width" step="0.01" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($vehicle['width'])?>">
                                    </div>
                                    <div class="form-group col-xlg-4 col-md-4">
                                        <label>Tinggi (cm)</label>
                                        <input type="number" name="height" step="0.01" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($vehicle['height'])?>">
                                    </div>
                                    <div class="form-group col-xlg-4 col-md-4">
                                        <label>Nama Pemilik</label>
                                        <input type="text" name="owner_name" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($vehicle['owner_name'])?>">
                                    </div>
                                    <div class="form-group col-xlg-12 col-md-12">
                                        <button class="btn btn-success pull-right">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
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
