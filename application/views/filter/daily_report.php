<form>
    <div class="row page-titles">
        <div class="col-md-7 col-7 align-self-center">
            <h3 class="text-themecolor"><?= $page_title ?>
                <button class="btn btn-success" data-toggle="tooltip" title="" onclick="window.open('<?= base_url() ?>laporan/cetak?type=daily&date=<?= $filter['date']?>&is_paid_off=<?= $filter['is_paid_off']?>')" data-original-title="Cetak Laporan"><i class="mdi mdi-printer"></i>Cetak</button>
                <button class="btn btn-inverse" data-toggle="tooltip" title="" onclick="window.open('<?= base_url() ?>laporan/download?type=daily&date=<?= $filter['date']?>&is_paid_off=<?= $filter['is_paid_off']?>')" data-original-title="Download Laporan"><i class="mdi mdi-download"></i>Download</button>
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $parent_page_url ?>"><?= $parent_page ?></a></li>
                <li class="breadcrumb-item active"><?= $page_child ?></li>
            </ol>
        </div>
        <div class="col-md-2 col-2 align-self-center">
        	<input type="date" name="date" class="form-control form-control-line" value="<?= $this->Ternary->isset_value($filter['date'], date("Y-m-d"))?>">
        </div>
        <div class="col-md-2 col-2 align-self-center">
            <select class="form-control form-control-line select2" name="is_paid_off" id="search-paidoff-id">
                <?php foreach ($this->TransactionConstant->get_paidoff_status() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= $filter['is_paid_off'] != '' && $filter['is_paid_off'] == $key ? 'selected' : '' ?> ><?= $value ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-1 col-1 align-self-center">
            <button type="submit" class="btn waves-effect btn-rounded btn-warning"> <i class="ti-search"></i> Cari </button>
        </div>
    </div>
</form>