<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faqs';
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
    <div class="faq-index container-fluid">
        <p>
            <?= Html::a('Add Faq', ['/site/add-faq'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?

        Pjax::begin([
            'id' => 'faq-container',
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'question',
                [
                    'attribute' => 'answer',
                    'content' => function($model){
                        return $model->answer;
                    }
                ],
                [
                    'label' => 'Actions',
                    'contentOptions' => ['style' => 'min-width:100px'],
                    'content' => function ($model, $key) {
                        return Html::a('<i class="fa fa-edit"></i>',
                            Url::to('/site/add-faq?id='.$model->_uid),
                            [
                                'class' => 'btn btn-success',
                                'id' => 'edit_btn',
                                'data-key' => $model->_uid,
                            ]) . Html::a('<i class="fa fa-trash"></i>',
                            Url::to('javascript:;'),
                            [
                                'class' => 'btn btn-danger',
                                'id' => 'dlt_btn',
                                'data-key' => $model->_uid,
                            ]);
                    },
                ],
                //'created_by',
                //'created_on',
                //'is_deleted',

//            ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        Pjax::end();
        ?>


    </div>
</section>
<?php
$script = <<<JS
$(document).on('click','#dlt_btn',function(event) {
    event.preventDefault();
    if (confirm("Are you sure delete this Faq ?")) {
        var btn = $(this);
        var btn_value = btn.text();
        event.stopImmediatePropagation();
        if ( btn.data('requestRunning') ) {
            return false;
        }
        btn.data('requestRunning', true);
        var dltid = btn.attr('data-key');
        var table = 'faq';
        $.ajax({
        url: '/site/trash',
        method: 'POST',
        data : {id:dltid,table:table},
         beforeSend:function(){
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
                $.pjax.reload({container:'#faq-container' , async : false});
            } else {
                toastr.error(response.message, response.title);
            }
            btn.attr('disabled', false);
            btn.html(btn_value);
        },
        complete: function() {
            btn.data('requestRunning', false);
        }
    });
    }
});
JS;
$this->registerJS($script);
