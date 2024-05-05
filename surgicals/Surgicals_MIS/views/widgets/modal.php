<?php
use yii\helpers\Url;
?>
<div class="modal fade" id="modal" role="basic" aria-hidden="false">
    <div class="modal-dialog" style="width: <?= $width_size ?>;">
        <div class="modal-content">
            <div class="modal-body">
                <i class="fa fa-spin"></i>
                <span> &nbsp;&nbsp;<?= Yii::t('app', 'Loading'); ?>... </span>
            </div>
        </div>
    </div>
</div>