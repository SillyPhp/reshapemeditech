<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AppointmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Appointments';
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

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?//= Html::a('Create Appointment', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    Pjax::begin([
        'id' => 'pjax-appointments',
    ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            '_id',
//            'uid',
//            'created_at',
            'name',
            'phone',
            'email:email',
            [
                'label' => 'date',
                'contentOptions' => ['style' => 'min-width:80px'],
                'content' => function ($model, $key) {
                    $returnData = '<span data-url = "/site/edit-appointments" data-type="combodate"  data-name="date" data-title="Select Date" data-value="' . $model->date . '" class = "xedit_date cPointer" data-pk = "' . $key . '"></a>';
                    return $returnData;
                }
            ],
            [
            'attribute' => 'previous_appointment',
            'label' => 'Prev Appointment',
            'content' => function($model){
                if($model->previous_appointment == 1){
                    $return = 'Yes';
                } else {
                    $return = 'No';
                }
                return $return;
            }
            ],
            'gender',
            //'description:ntext',
            [
                'label' => 'Actions',
                'contentOptions' => ['style' => 'min-width:100px'],
                'content' => function ($model, $key) {
                    return Html::a('<i class="fa fa-edit"></i>',
                        Url::to('#'),
                        [
                            'url' => '/site/edit-appointment?id='.$key,
                            'class' => 'btn btn-success edit_btn',
                            'id' => 'edit_btn',
                            'data-key' => $key,
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                        ])
                        .Html::a('<i class="fa fa-trash"></i>',
                        Url::to('javascript:;'),
                        [
                            'class' => 'btn btn-danger',
                            'id' => 'dlt_btn',
                            'data-key' => $key,
                        ]);
                },
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    $this->registerJs("
    $('.xedit_date').editable({
                       format: 'YYYY-MM-DD HH-mm',    
                       viewformat: 'DD-MM-YYYY HH-mm',    
                       template: 'D MMMM YYYY HH mm',    
                        combodate: {
                                minYear: 2020,
                                maxYear: 2030,
                                minuteStep: 1
                           },
                           validate: function(value) {
                                    if($.trim(value) == '') {
                                        return 'This field is required';
                                    }
                                },
                            success: function (response) {
                                if (response.status == 200) {
                                    toastr.success(response.message, response.title);
                                } else {
                                    toastr.error(response.message, response.title);
                                }
                            }
                    });
    ");
    ?>


</div>
</section>
<?php
echo $this->render('/widgets/modal.php',[
    'width_size' => '80%'
]);
$script = <<<JS
$(document).on("click", ".edit_btn", function () {
    $(".modal-body").load($(this).attr("url"));
});
$(document).on('click','#dlt_btn',function(event) {
    event.preventDefault();
    if (confirm("Are you sure ?")) {
    var btn = $(this);
    var btn_value = btn.text();
    event.stopImmediatePropagation();
    if ( btn.data('requestRunning') ) {
        return false;
    }
    btn.data('requestRunning', true);
    var dltid = btn.attr('data-key');
    $.ajax({
        url: '/site/appointment-trash',
        method: 'POST',
        data : {id:dltid},
         beforeSend:function(){
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
               $.pjax.reload({container:'#products-container' , async : false});
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
$(document).on('submit','#edit-appointment',function (event){
    event.preventDefault();
    var form = $(this);
    var btn = $('.appointment-edit-btn');
    var btn_value = btn.text();
    event.stopImmediatePropagation();
    if ( form.data('requestRunning') ) {
        return false;
    }
    form.data('requestRunning', true);
    var url = form.attr('action');
    var method = form.attr('method');
    var formData = form.serialize();
    $.ajax({
        url: url,
        type: method,
        data: formData,
        beforeSend: function () {
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            btn.attr('disabled', true);
        },
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                $('#modal').modal('toggle');
                $.pjax.reload({container:'#pjax-appointments' , async : false});
            } else {
                toastr.error(response.message, response.title);
            }
            btn.html(btn_value);    
            btn.attr('disabled', false);
        },
        complete: function() {
            form.data('requestRunning', false);
            btn.attr('disabled', false);
            btn.html(btn_value);
        }
    });
});
JS;
$this->registerJS($script);
$this->registerJsFile('https://momentjs.com/downloads/moment.js', ['depends' => [\yii\web\JqueryAsset::className()]]);