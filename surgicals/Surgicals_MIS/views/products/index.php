<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Combinations';
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
//                        [
//                            'label' => '@',
//                            'content' => function ($m) {
//                                return Html::a('Profile', \yii\helpers\Url::to('/products/profile?id=' . $m->_uid), ['target' => '_blank']);
//                            }
//                        ],
                        [
                            'label' => 'Images',
                            'content' => function($model){
                                return '<a href="/products/images?id='.$model->_id.'">Images</a>';
                            }
                        ],
                        'product_id',
                        [
                            'attribute' => 'title',
                            'contentOptions' => ['style' =>'min-width:180px'],
                            'content' => function($model){
                                return $model->title;
                            }
                        ],
                        [
                         'attribute' => 'price',
                            'label' => 'Purchased price',
                            'content' => function ($m) {
                                return $m->price;
                            }
                        ],
                        [
                            'label' => 'Move to Sub category',
                            'content' => function ($m) use($categories){
                                $return = '<div class="dropdown">';
                                $return .= '<span class="multiAction dropdown-toggle" data-toggle="dropdown"><u>'.$m->products->categories->name.'</u></span>';
                                $return .= '<ul class="dropdown-menu actionul" data-key="' . $m->products->_id . '">';
                                foreach ($categories as $p) {
                                    $cls = 'change_sub_category';
                                    if ($m->products->categories->_id == $p['_id']) {
                                        $cls = 'selectedValue';
                                    }
                                        $return .= '<li><a class="' . $cls . '" data-value="' . $p['_id'] . '" href="javascript:;">' . $p['name'] . '</a></li>';
                                }
                                $return .= '</ul>';
                                $return .= '</div>';
                                return $return;
                            }
                        ],
                        'sale_price',
                        [
//                    'attribute' => 'cat_name',
                            'label' => 'products__id',
                            'content' => function ($m) {
                                return $m->products->name;
                            }
                        ],
                        [
                            'label' => 'Flavours',
                            'contentOptions' => ['style' =>'min-width:180px'],
                            'content' => function ($model, $key) {
                                $return = '';
                                if($model->productCombinationsFlavours){
                                    foreach($model->productCombinationsFlavours as $fla){
                                        if($fla->is_deleted == 0){
                                            $return .= '<li>'. $fla->flavours->name .'</li>';
                                        }
                                    }
                                }
                                return $return . '<div class="text-center"><span class="flavours" data-href="'.Url::to("/products/flavours?id=".$key).'">+</span></div>';
                            },
                        ],
                        'created_at',
                        [
                            'label' => 'Actions',
                            'content' => function ($model, $key) {
                                return Html::a('<i class="fa fa-trash"></i>',
                                    Url::to('javascript:;'),
                                    [
                                        'class' => 'btn btn-danger',
                                        'id' => 'dlt_btn',
                                        'data-key' => $key,
                                    ]);
                            },
                        ],
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
.flavours{
color : blue;
cursor: pointer;
font-weight: bolder;
    font-size: 25px;
}
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
$(document).on('click','.flavours', function (){
    window.open($(this).attr('data-href'));
})
$(document).on('click', '.change_sub_category', function (event) {
            event.preventDefault();
            var btn = $(this);
            if (confirm("Are you Sure? Change Sub Category?")) {
                var toggleBtn = btn.closest('ul').prev('span');
                var key = btn.closest('ul').attr('data-key');
                var value = btn.attr('data-value');
                toggleBtn.closest('div').removeAttr('style');
                var preBtn = btn.closest('ul').find('.selectedValue');
                preBtn.removeClass('selectedValue')
                preBtn.addClass('change_sub_category')
                btn.removeClass('change_sub_category')
                btn.addClass('selectedValue');
                toggleBtn.text(btn.text());
                toggleBtn.click();
                $.ajax({
                url: '/products/change-sub-category',
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
