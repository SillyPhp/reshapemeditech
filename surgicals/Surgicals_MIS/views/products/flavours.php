<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = 'Add Flavours';
$this->params['breadcrumbs'][] = ['label' => 'Vouchers', 'url' => ['index']];
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
                    <li><span><?= 'Add Flavours' ?></span></li>
                    <li><span><?= $this->title ?></span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <form id="flavour_form" method="post" action="/products/flavours">
            <div class="blogs-create container-fluid">
                <div class="blogs-form">
                    <h2>Add Flavours</h2>
                    <div class="addflavour">
                        <div class="reward_heading">
                            <?php
                            if ($flavours) {
                                foreach ($flavours as $key => $flavour) {
                                    ?>
                                    <div class="flavour-container row">
                                        <div class="col-md-5">
                                            <div class="form-group field-flavour_name">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <label class="control-label" for="flavour_name">Flavour Name</label>
                                                    <input type="text" id="flavour_name"
                                                           class="form-control flavour_name"
                                                           name="flavour_name[flavour_<?= $key ?>]" autocomplete="off" value="<?= $flavour->flavours->name ?>">
                                                    <p class="help-block help-block-error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group field-flavour_price">
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <label class="control-label" for="flavour_price">Flavour
                                                        Price</label>
                                                    <input type="number" id="flavour_price"
                                                           class="form-control flavour_price"
                                                           name="flavour_price[flavour_<?= $key ?>]" autocomplete="off" value="<?= $flavour->price ?>" min="0">
                                                    <p class="help-block help-block-error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span class="text-danger removeflavour" data-key="<?= $flavour->_uid ?>">x</span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" style="margin-top: 15px;" id="reward_btn">Add
                            Flavour
                        </button>
                    </div>
                    <div class="row text-right">
                        <input type="submit" class="btn btn-success submitBtn btn-lg" name="submit" Value="Save">
                    </div>
                </div>
            </div>
        </form>
    </section>
<?php
$this->registerCss('
.removeflavour{
cursor:pointer;
font-weight: bold;
}
');
$script = <<<JS
var rew;
if('$all_flavours'){
    rew = '$all_flavours';
} else {
    rew = 0;
}
$(document).on('submit','#flavour_form', function (e){
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    var btn = $('.submitBtn');
    var flavours = $('.flavour_name');
    if(flavours){
    $.ajax({
        url: '/products/flavours?id=$id',
        type: 'POST',
        data: data,
        beforeSend: function () {
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
            //     $.pjax.reload({container: "#users-container", async: false});
            } else {
                toastr.error(response.message, response.title);
            }
            btn.attr('disabled', false);
            btn.html('Save');
        },
    });
    } else {
        alert("flavour name can't be empty");
    }
    
});
$(document).on('click', '#reward_btn', function (e) {
    e.preventDefault();
    let container = $('.addflavour');
    container.append(addReward(rew));
    rew++;
});
function addReward(i){
    return '<div class="flavour-container row"><div class="col-md-5"><div class="form-group field-flavour_name"><div class="form-group form-md-line-input form-md-floating-label"><label class="control-label" for="flavour_name">Flavour Name</label><input type="text" id="flavour_name" class="form-control flavour_name" name="flavour_name[flavour_'+i+']" autocomplete="off"><p class="help-block help-block-error"></p></div></div></div><div class="col-md-5"><div class="form-group field-flavour_price"><div class="form-group form-md-line-input form-md-floating-label"><label class="control-label" for="flavour_price">Flavour Price</label><input type="number" id="flavour_price" class="form-control flavour_price" name="flavour_price[flavour_'+i+']" autocomplete="off" min="0" value="0"><p class="help-block help-block-error"></p></div></div></div><div class="col-md-1"><span class="text-danger removeflavour" data-key="">x</span></div></div>';
}
$(document).on('click', '.removeflavour', function(e) {
  e.preventDefault();
  var btn = $(this);
  let key = btn.attr('data-key');
  let data_table = 'product_combination_favour';
  if(key) {
      $.ajax({
        url: '/products/delete',
        type: 'POST',
        data: {'id':key, table: data_table},
        success: function (response) {
            if (response.status == 201) {
                toastr.error(response.message, response.title);
            }
        },
    });
  }
  btn.parent().parent().remove();
})
JS;

$this->registerJS($script);