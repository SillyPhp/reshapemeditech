<?php
use yii\helpers\Url;
?>
<div class="modal fade" id="modal" role="basic" aria-hidden="true">
    <div class="modal-dialog" style="width: <?= $width_size ?>;">
        <div class="modal-content">
            <div class="modal-body">
<!--                <img src="--><?//= Url::to('@backendAssets/global/img/loading-spinner-grey.gif'); ?><!--"-->
<!--                     alt="--><?//= Yii::t('frontend', 'Loading'); ?><!--" class="loading">-->
                <span> &nbsp;&nbsp;Loading... </span>
            </div>
        </div>
    </div>
</div>