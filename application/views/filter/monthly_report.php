<form>
    <div class="row page-titles">
        <div class="col-md-7 col-7 align-self-center">
            <h3 class="text-themecolor"><?= $page_title ?>
                <button class="btn btn-success" data-toggle="tooltip" title="" onclick="window.open('<?= base_url() ?>laporan/cetak?type=monthly&month=<?= $filter['month']?>&year=<?= $filter['year']?>')" data-original-title="Cetak Laporan"><i class="mdi mdi-printer"></i>cetak</button>
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $parent_page_url ?>"><?= $parent_page ?></a></li>
                <li class="breadcrumb-item active"><?= $page_child ?></li>
            </ol>
        </div>
        <div class="col-md-2 col-2 align-self-center">
        	<select class="form-control form-control-line select2" name="month" id="search-month-id">
                <?php foreach ($this->TimeConstant->get_month_list() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= $filter['month'] == $key ? 'selected' : '' ?> ><?= $value ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2 col-2 align-self-center">
            <select class="form-control form-control-line select2" name="year" id="search-year-id">
                <?php foreach ($this->TimeConstant->get_year_list() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= $filter['year'] == $key ? 'selected' : '' ?> ><?= $value ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-1 col-1 align-self-center">
            <button type="submit" class="btn waves-effect btn-rounded btn-warning"> <i class="ti-search"></i> Cari </button>
        </div>
    </div>
</form>