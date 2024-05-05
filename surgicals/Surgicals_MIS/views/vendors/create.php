<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendors */

$this->title = 'Create Vendors';
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->address = '<p><span style="font-size: 18px;"><strong style="">Address </strong>:</span></p><p>BX-2, Gxxxxd Fxxxr,<br>Near IxxxI Bxxk, Sxxxx Nxxxr<br>Nxw Dxxxi 1xxxx1</p><p><strong>Phone</strong>: +91 895xx-xxx84, +91 754xx-xxx52<br><strong style="">Email&nbsp;</strong>: vendor@example,com</p>';
?>
<div class="vendors-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userList' => $userList,
    ]) ?>

</div>
