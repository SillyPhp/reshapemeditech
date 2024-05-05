<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
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

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <div class="table-responsive">
                <?php
                Pjax::begin([
                    'id' => 'products-container',
                ]);
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'name',
                        [
                            'attribute' => 'brand_name',
                            'label' => 'Update brand',
                            'content' => function ($m) use($brands){
                                if($m["brand_name"]){
                                    $brandName = $m["brand_name"];
                                } else {
                                    $brandName = 'Empty';
                                }
                                $return = '<div class="dropdown">';
                                $return .= '<span class="multiAction dropdown-toggle" data-toggle="dropdown"><u>'.$brandName.'</u></span>';
                                $return .= '<ul class="dropdown-menu actionul" data-key="' . $m["_id"] . '">';
                                foreach ($brands as $p) {
                                    $cls = 'update_brand';
                                    if ($m["brand_id"] == $p['_id']) {
                                        $cls = 'selectedValue';
                                    }
                                    $return .= '<li><a class="' . $cls . '" data-value="' . $p['_id'] . '" href="javascript:;">' . $p['name'] . '</a></li>';
                                }
                                $return .= '</ul>';
                                $return .= '</div>';
                                return $return;
                            }
                        ],
                        'created_at',
//                        [
//                            'label' => 'Actions',
//                            'content' => function ($model, $key) {
//                                return Html::a('<i class="fa fa-trash"></i>',
//                                    Url::to('javascript:;'),
//                                    [
//                                        'class' => 'btn btn-danger',
//                                        'id' => 'dlt_btn',
//                                        'data-key' => $key,
//                                    ]);
//                            },
//                        ],
//                ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                Pjax::end();
                ?>
            </div>

        </div>
    </section>
<?php
$this->registerCss('
.actionul{
    max-height: 150px;
        overflow-y: auto;
    }
.selectedValue{
    background: #bfbfbf;
}
a.selectedValue {
        cursor: not-allowed;
    }
');
$script = <<<JS
$(document).on('click', '.update_brand', function (event) {
            event.preventDefault();
            var btn = $(this);
            if (confirm("Are you Sure? Change Sub Category?")) {
                var toggleBtn = btn.closest('ul').prev('span');
                var key = btn.closest('ul').attr('data-key');
                var value = btn.attr('data-value');
                toggleBtn.closest('div').removeAttr('style');
                var preBtn = btn.closest('ul').find('.selectedValue');
                preBtn.removeClass('selectedValue')
                preBtn.addClass('update_brand')
                btn.removeClass('update_brand')
                btn.addClass('selectedValue');
                toggleBtn.text(btn.text());
                toggleBtn.click();
                $.ajax({
                url: '/products/update-brands',
                method: 'POST',
                data: {key: key, value: value},
                success: function (response) {
                    if (response.status == 201) {
                        toastr.error(response.message, response.title);
                    } else {
                         toastr.success(response.message, response.title);
                         location.reload();
                    }
                }
            }).fail(function (data) {
                toastr.error('Invalid URL', 'Error: ' + data.responseJSON.message);
            });
                }
        });
$(document).on('click','#dlt_btn',function(event) {
    event.preventDefault();
    if (confirm("Are you sure delete this Product ?")) {
    var btn = $(this);
    var btn_value = btn.text();
    event.stopImmediatePropagation();
    if ( btn.data('requestRunning') ) {
        return false;
    }
    btn.data('requestRunning', true);
    var dltid = btn.attr('data-key');
    $.ajax({
        url: '/products/trash',
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
JS;
$this->registerJS($script);
