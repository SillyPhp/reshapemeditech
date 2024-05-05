<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->enc_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->enc_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('View List', ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'label' => 'Category',
                'value' => function ($m) {
                    return $m->cat->name;
                }
            ],
            [
                'label' => 'Brand Name',
                'value' => function ($m) {
                    return $m->brand->name;
                }
            ],
            [
                'label' => 'Product Image',
                'format' => 'html',
                'value' => function ($m) {
                    if ($m->media) {
                        $path = Yii::$app->params->upload_directories->product->image . $m->enc_id . '/';
                        return '<img src="' . $path . $m->media->enc_name . '" width="100px" height="auto">';
                    }
                }
            ],
            'short_description:ntext',
            [
                'attribute' => 'long_description',
                'format' => 'html'
            ],
        ],
    ]) ?>

</div>
