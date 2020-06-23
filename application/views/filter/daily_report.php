<form>
    <div class="row page-titles">
        <div class="col-md-9 col-9 align-self-center">
            <h3 class="text-themecolor"><?= $page_title ?>
                <button class="btn btn-success" data-toggle="tooltip" title="" onclick="window.open('<?= base_url() ?>laporan/cetak?type=daily&date=<?= $filter['date']?>')" data-original-title="Cetak invoice"><i class="mdi mdi-printer"></i>cetak</button>
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $parent_page_url ?>"><?= $parent_page ?></a></li>
                <li class="breadcrumb-item active"><?= $page_child ?></li>
            </ol>
        </div>
        <div class="col-md-2 col-2 align-self-center">
        	<input type="date" name="date" class="form-control form-control-line" value="<?= $this->Ternary->isset_value($filter['date'], date("Y-m-d"))?>">
        </div>
        <div class="col-md-1 col-1 align-self-center">
            <button type="submit" class="btn waves-effect btn-rounded btn-warning"> <i class="ti-search"></i> Cari </button>
        </div>
    </div>
</form>