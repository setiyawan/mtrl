<?php
    $alert = $this->session->flashdata('alert');
?>
<div id="success-alert-modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true" is-alert="<?=$alert['is_alert']?>">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-filled bg-<?=$alert['type']?>" style="margin-top: 80px;" >
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel"><?=$alert['message']?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>