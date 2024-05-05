<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Add Faqs';
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
        <?php $form = ActiveForm::begin(['id' => 'faq-form']); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'question')->textInput(['class' => 'form-control']) ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'answer')->textArea(['rows' => 5,'column' => 4,'placeholder' => 'Answer']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </section>
<?php
$script = <<<JS
$(document).on('submit', '#faq-form', function(event) {
    event.preventDefault();
    var form = $(this);
    event.stopImmediatePropagation();
    if ( form.data('requestRunning') ) {
        return false;
    }
    form.data('requestRunning', true);
    var url = form.attr('action');
    var method = form.attr('method');
    var data = form.serialize();
      $.ajax({
        url: url,
        method: method,
        data:data,
        beforeSend:function(){   
        },
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
                form[0].reset();
                window.location.href = '/site/faq';
            } else {
                toastr.error(response.message, response.title);
            }
        },
        complete: function() {
            form.data('requestRunning', false);
        }
    });
});
new Jodit('textarea', {
    height: 400,
    sizeLG: 900,
    sizeMD: 700,
    sizeSM: 400,
     buttons: [
        'source', '|',
        'bold',
        'italic', '|',
        'ul',
        'ol', '|',
        'font',
        'fontsize',
        'paragraph', '|',
        'left',
        'center',
        'right',
        'justify', '|',
        'undo', 'redo', '|',
        'hr',
        'eraser'
    ],
    buttonsMD: [
        'source', '|',
        'bold',
        'italic', '|',
        'ul',
        'ol', '|',
        'font',
        'fontsize',
        'paragraph', '|',
        'left',
        'center',
        'right',
        'justify', '|',
        'undo', 'redo', '|',
        'hr',
        'eraser'
    ],
    buttonsSM: [
        'source', '|',
        'bold',
        'italic', '|',
        'ul',
        'ol', '|',
        'font',
        'fontsize',
        'paragraph', '|',
        'left',
        'center',
        'right',
        'justify', '|',
        'undo', 'redo', '|',
        'hr',
        'eraser'
    ],
    buttonsXS: [
        'source', '|',
        'bold',
        'italic', '|',
        'ul',
        'ol', '|',
        'font',
        'fontsize',
        'paragraph', '|',
        'left',
        'center',
        'right',
        'justify', '|',
        'undo', 'redo', '|',
        'hr',
        'eraser'
    ]
});
JS;
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/jodit/3.1.92/jodit.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jodit/3.1.92/jodit.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJS($script);

