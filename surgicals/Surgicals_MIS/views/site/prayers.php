<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrayersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prayers';
$this->params['breadcrumbs'][] = $this->title;
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= $this->title ?></h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span><?= $this->title ?></span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
<div class="container-fluid">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Create Prayers', ['/site/add-prayer'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'description:ntext',
            [
                'label' => 'Actions',
                'contentOptions' => ['style' => 'min-width:100px'],
                'content' => function ($model,$key) {
                    return Html::a('<i class="fa fa-edit"></i>',
                        Url::to('/site/add-prayer?id='.$model->uid),
                        [
                            'class' => 'btn btn-primary edit_btn',
                            'id' => 'edit_btn',
                            'data-target' => '_blank'
                        ])
                        .Html::a('<i class="fa fa-trash"></i>',
                            Url::to('#'),
                            [
                                'class' => 'btn btn-danger edit_btn',
                                'id' => 'dlt_btn',
                                'data-key' => $model->id,
                            ]);
                }
            ],

        ],
    ]); ?>


</div>
</section>
<?php
$script = <<<JS
$(document).on('click','#dlt_btn',function(e){
   e.preventDefault();
   var btn = $(this);
   if(confirm("Are you sure ?")){
   var btnParent = btn.parent().parent();
   var id = btn.attr('data-key');
   e.stopImmediatePropagation();
        if (btn.data('requestRunning')) {
            return false;
        }
        btn.data('requestRunning', true);
   $.ajax({
        url: '/site/prayer-trash',
        type: "POST",
        data: {id:id},
        beforeSend: function() {
                btn.html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>');
                btn.attr("disabled", true);
            },
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                btnParent.remove();
            } else {
                toastr.error(response.message, response.title);
                btn.attr("disabled", false);
            }
        },
    })
    }
});
JS;
$this->registerJs($script);
