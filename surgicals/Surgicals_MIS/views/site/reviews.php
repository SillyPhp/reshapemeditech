<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client Says';
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

        <div class="client-reviews-index">

            <p>
                <?= Html::a('Add Review', ['add-review'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'image',
                        'label' => 'Profile Image',
                        'content' => function ($model) {
                            $base_path = Yii::$app->params->upload_directories->client->image . $model->_uid;
                            return '<img src="' .$base_path . '/' . $model->image .'" width="40px" height="40px">';
                        }
                    ],
                    'name',
                    'designation',
                    [
                        'attribute' => 'description',
                        'label' => 'Comment',
                        'value' => function ($model) {
                            return $model->description;
                        }
                    ],
                    'created_at',
                    [
                        'label' => 'Actions',
                        'contentOptions' => ['style' => 'min-width:100px'],
                        'content' => function ($model) {
                            return Html::a('<i class="fa fa-edit"></i>',
                                    Url::to('/site/edit-review?id=' . $model->_uid),
                                    [
                                        'class' => 'btn btn-info edit_btn',
                                        'id' => 'edit_btn',
                                        'data-target' => '_blank'
                                    ])
                                .Html::a('<i class="fa fa-trash"></i>',
                                Url::to('#'),
                                [
                                    'class' => 'btn btn-danger edit_btn',
                                    'id' => 'dlt_btn',
                                    'data-key' => $model->_id,
                                ]);
                        }
                    ]
                    //'image',
                    //'is_deleted',

//            ['class' => 'yii\grid\ActionColumn'],
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
        url: '/site/review-trash',
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
$this->registerJS($script);
