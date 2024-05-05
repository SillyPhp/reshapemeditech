<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
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
        <form action="/categories/sub-category" method="post" id="categories_id">
        <div class="col-md-4">
            <label>Select Category</label>
            <select name="category" id="category" form="categoryForm" class="form-control">
                <option>Select Category</option>
                <?php
                if($categories){
                    foreach ($categories as $cat){
                        ?>
                        <option value="<?= $cat['_id']?>" class="form-control"><?= $cat['name']?></option>
                    <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label>Sub Category</label>
            <input name = "sub_category" id="sub_category" type="text" placeholder = "Sub Category" class = "form-control">
        </div>
        <div class="col-md-4">
            <input type = "submit" value="Submit" class="btn btn-success submitBtn">
        </div>
    </form>
    </div>
    <div class="container-fluid" style="margin-top: 50px;">

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
                        'attribute' => 'parent_name',
                        'label' => 'Category',
                        'content' => function ($model){
                            return $model->parentId->name;
                        }
                    ],
                    [
                        'attribute' => 'name',
                        'label' => 'Sub Category',
                        'content' => function ($model){
                            return $model->name;
                        }
                    ],
                ],
            ]);
            Pjax::end();
            ?>
        </div>

    </div>
</section>
<?php
$script = <<<JS
$(document).on('click','.submitBtn', function(event) {
  event.preventDefault();
    var btn = $(this);
    var btn_value = btn.text();
    let category = $('#category').find(":selected").val();
    let subcategory = $('#sub_category').val();
    if(subcategory && category != 'Select Category'){
    $.ajax({
        url:'/categories/sub-category',
        method: "POST",
        data: {category:category,subcategory:subcategory},
        beforeSend:function (){
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            btn.attr("disabled",true);
        },
        success:function(res){
            if(res.status == 200) {
            toastr.success(res.message, res.title);
            location.reload();
            }
            else {
                toastr.error(res.message, res.title);
            }
            btn.attr("disabled", false);
            btn.html(btn_value);
        }
        
   })
   } else {
        alert('Please Filled All Fields');
   }
})
JS;
$this->registerJS($script);