<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vendors */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendors-view">

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
        <?= Html::a('All List', ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'email:email',
            'phone',
            [
                'label' => 'Proprietor Name',
                'value' => function ($m) {
                    return $m->user->username;
                }
            ],
            [
                'attribute' => 'address',
                'format' => 'html',
            ],
            [
                'attribute' => 'status',
                'value' => function ($m) {
                    switch ($m->status) {
                        case 0 :
                            $status = 'Pending';
                            break;
                        case 1 :
                            $status = 'Approved';
                            break;
                        case 2 :
                            $status = 'Rejected';
                            break;
                        default :
                            $status = 'N/A';
                    }
                    return $status;
                },
            ],
        ],
    ]) ?>

</div>
