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
                                    <input type="hidden" name="transaction_id" id="transaction-id" value="<?= $this->Ternary->isset_value($transaction['transaction_id'])?>">
                                    <input type="hidden" name="vehicle_id" id="vehicle-id" value="<?= $this->Ternary->isset_value($transaction['vehicle_id'])?>">
                                    <input type="hidden" name="item_price" id="item-price-id" value="<?= $this->Ternary->isset_value($transaction['item_price'])?>">

                                    <div style="display: flex;">
                                        <div class="form-group col-md-4 col-xlg-4">
                                            <label>No Nota</label>
                                            <input type="text" name="invoice_code" placeholder="Otomatis" disabled required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($transaction['invoice_code'])?>">
                                        </div>
                                        <div class="form-group col-md-4 col-xlg-4">
                                            <label>Tgl Transaksi</label>
                                            <input type="datetime-local" required  disabled class="form-control form-control-line" value="<?= $this->Ternary->isset_value($transaction['transaction_time'], date("Y-m-d H:i:s"))?>">
                                            <input type="hidden" name="transaction_time" value="<?= $this->Ternary->isset_value($transaction['transaction_time'], date("Y-m-d H:i:s"))?>">
                                        </div>
                                        <div class="form-group col-md-4 col-xlg-4">
                                            <input type="checkbox" class="form-check-input" id="is_paid_off" name="is_paid_off" <?= $transaction['is_paid_off'] ? 'checked' : '' ?> >
                                            <label class="form-check-label" for="is_paid_off"> <b> L U N A S </b> </label>
                                            <!-- <input type="datetime-local" required  disabled class="form-control form-control-line" value="<?= $this->Ternary->isset_value($transaction['paidoff_time'], '')?>"> -->
                                            <!-- <input type="hidden" name="paidoff_time" value="<?= $this->Ternary->isset_value($transaction['paidoff_time'], '')?>"> -->
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-xlg-4">
                                        <label>Nopol Kendaraan</label>
                                        <select class="form-control form-control-line select2" name="license_plate" id="license-plate-id">
                                            <option value="">Pilih</option>
                                            <?php foreach ($vehicle as $key => $value) { ?>
                                                <option value="<?= $value['license_plate'] ?>" <?= $value['license_plate'] == $transaction['license_plate'] ? 'selected' : '' ?> ><?= $value['license_plate'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-xlg-4">
                                        <label>Penerima</label>
                                        <input type="text" name="receiver_name" id="receiver-name-id" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($transaction['receiver_name'])?>">
                                    </div>
                                    <div class="form-group col-md-4 col-xlg-4">
                                        <label>Nama Sopir</label>
                                        <input type="text" name="driver_name" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($transaction['driver_name'])?>">
                                    </div>

                                    <div class="form-group col-md-4 col-xlg-4">
                                        <label>Material</label>
                                        <select class="form-control form-control-line select2" name="material_id" id="material-id" required>
                                            <option>Pilih</option>
                                            <?php foreach ($material as $key => $value) { ?>
                                                <option value="<?= $value['material_id'] ?>" <?= $value['material_id'] == $transaction['material_id'] ? 'selected' : '' ?> ><?= $value['material_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div style="font-size: 12px;font-style: italic;" id="material-price-id"></div>
                                    </div>
                                    <div class="form-group col-md-4 col-xlg-4">
                                        <label>Volume (m<sup>3</sup>)</label>
                                        <input type="number" name="volume" id="volume-id" step="0.01" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($transaction['volume'])?>">
                                        <div style="font-size: 12px;font-style: italic;" id="vehicle-dimensi-id"></div>
                                    </div>
                                    <div class="form-group col-md-4 col-xlg-4">
                                        <label>Total Harga</label>
                                        <input type="number" name="total_price" id="total-price-id" step="0.01" required class="form-control form-control-line" value="<?= $this->Ternary->isset_value($transaction['total_price'])?>">
                                    </div>
                                    <div class="form-group col-xlg-12 col-md-12">
                                        <button class="btn btn-success pull-right">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <?php if ($transaction['transaction_id'] > 0) { ?>
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-block">
                                <center class="m-t-30"> 
                                    <iframe src="<?= base_url() ?>transaksi/invoice?id=<?= $transaction['transaction_id']?>" style="display:none;" name="invoice"></iframe>
                                    <a onClick="frames['invoice'].print()">
                                        <img src="<?=base_url()?>asset/images/printer.png" class="img-circle" title="cetak nota" width="150" style="cursor: pointer;">
                                    </a>
                                    <h6 class="card-subtitle m-t-10">Total Pembayaran</h6>
                                    <h1 class="card-title" id="resume-total-price-id"><?= $this->Converter->to_rupiah($this->Ternary->isset_value($transaction['total_price']))?></h1>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-12"><a href="javascript:void(0)" class="link"><i class="mdi mdi-account"></i><font class="font-medium card-subtitle"><?= $user_full_name ?></font></a></div>
                                        <div class="col-12"><a href="javascript:void(0)" class="link"><i class="mdi mdi-update"></i><font class="font-medium card-subtitle"><?= $this->Converter->to_indonesia_timestamp($this->Ternary->isset_value($transaction['update_time'], $transaction['create_time']))?></font></a></div>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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

    <script type="text/javascript">
        var vehicle = <?php echo json_encode($vehicle); ?>;
        var material = <?php echo json_encode($material); ?>;
        var current_volume = <?php echo json_encode($this->Ternary->isset_value($transaction['volume']))?>;
        var current_price = <?php echo json_encode($this->Ternary->isset_value($transaction['total_price']))?>;;
    </script>

    <?php $this->view('side/footer'); ?>

</body>

</html>
