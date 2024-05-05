<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
$this->title = 'Profile';
?>
<!-- <seciton class="my-profile">
    <div class="container">
        <div>
            <h1>My Profile</h1>
            <div class="personal-info">
                <h4>
                    Personal information
                </h4>
                <div class="input-fields">

                    <form>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control" placeholder="First name">
                            </div>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Last name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <input type="number" class="form-control phone" placeholder="987654321">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <input type="Submit" value="Save" class="form-control">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <div class="email-info">
                <h4>
                    Email
                </h4>
                <div class="input-fields">

                    <form>
                        <div class="row">
                            <div class="col">
                            <input type="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <input type="Submit" value="Save" class="form-control">
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</seciton>

<?php $this->registerCss('
    seciton.my-profile {
        display: block;
        background: #eee;
        padding: 40px 0;
    }
    .my-profile h1 {
        font-size: 35px;
        margin: 20px 0;
    }
    .personal-info, .email-info {
        background: #fff;
        padding: 20px 40px;
    }
    .personal-info h4, .email-info h4 {
        font-size: 16px;
        font-weight: 600;
        border-bottom: 1px solid #aaa;
        padding-bottom: 6px;
        margin-bottom: 24px;
    }
    .input-fields .row {
        margin-bottom: 15px;
    }
    input, input:focus {
        margin-bottom: 0 !important;
        border: 1px solid #ddd !important;
        outline: none !important;
    }
    input, input:focus {
        margin-bottom: 0 !important;
        border: 1px solid #ddd !important;
        outline: none !important;
    }
    input[type="submit"]{
        width: fit-content;
        display: inline-block;
    }
    .input-fields input[type="date"] {
        max-width: 180px;
    }
    .input-fields input.phone {
        max-width: 200px;
    }
    .email-info .input-fields input {
        max-width: 250px;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0; 
    }
') ?> -->




<section class="my-profile">
    <div class="container">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">My Profile</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">My Orders</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="user-detail">
<!--                    <i class="fa fa-pencil"></i>-->
                    <h1>Personal Details</h1>
                    <div class="details">
                        <span>
                            <span>User Name : </span>
                            <span><?= $model['username'] ?></span>
                        </span>
                        <?php
                        if($model['contact']) {
                        ?>
                        <span>
                            <span>Phone No : </span>
                            <span><?= $model['contact'] ?></span>
                        </span>
                        <?php } ?>
                        <span>
                            <span>Email : </span>
                            <span><?= $model['email']?></span>
                        </span>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="orders">
                    <h1>My Order</h1>
                    <div class="single-order">
                        <div class="order-head">
<!--                            <div class="order-no">-->
<!--                                ORDER NO: 12345657-->
<!--                            </div>-->
<!--                            <div class="order-date">-->
<!--                                Order Placed on 16th Oct 2021-->
<!--                            </div>-->
                        </div>

                        <!--Multiple Product-->
                        <?php
                        if($orders) {
                            foreach($orders as $order) {

                        ?>
                        <div class="prod-detail">
                            <div class="prod">
                                <div class="prod-img">
<!--                                    <img src="/frontend/web/images/products/1/BHOWKUwIzvbSZLh.jpg">-->
                                </div>
                                <div class="prod-text">
                                    <h2>Product Details</h2>
                                    <p><span class="price">Rs. <?= $order['grand_total']?></span></p>
                                </div>
                            </div>
                                <div class="address">
                                    <p><?= $order['first_name'] . ' ' . $order['last_name']?></p>
                                    <p>Address : </p>
                                    <p><?= $order['address1'] ?></p>
                                    <?php if($order['address2']) { ?><p><?= $order['address2'] ?></p> <?php } ?>
                                    <p><?= $order['city_name'].','. $order['state_name'] ?>, <?= $order['zip_code'] ?></p>
                                    <?php if($order['contact']) { ?><p>Phone No. <?= $order['contact']?></p> <?php } ?>
                                </div>
                            <div class="delivery">
                                <p>Delivered By</p>
                                <p><?= date('d M Y H:i:s', strtotime($order['created_at'])) ?></p>
                            </div>
                            <div class="delivery">
                                <a href="<?= Url::to('/site/order-detail?id='.$order['_id'])?>">View Detail</a>
                            </div>
                        </div>
                            <?php } } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<?php $this->registerCss('
p{
    margin: 0;
}
section.my-profile {
    padding: 50px 0;
    background: #eee;
}
a[role="tab"] {
    padding: 6px 20px;
    display: inline-block;
}
.tab-pane.active {
    background: #fff;
    margin: 15px;
    padding: 15px;
}
li.active a {
    color: #fff;
    background: #57bce2;
}  
.user-detail h1, .orders h1 {
    margin: 0;
    font-size: 18px;
}
// .details tr span:first-child {
//     width: 50%;
//     text-align: right;
//     font-weight: 600;
//     padding: 2px 12px;
//     vertical-align: top;
// }
// .details tr span:nth-child(2) {
//     padding: 3px 0;
// }
.details {
    max-width: 500px;
    margin-top: 18px;
}
.details p {
    margin: 0;
}
.details > span {
    display: flex;
}
.details > span span {
    flex-basis: 50%;
}
.details > span span:first-child {
    font-weight: 700;
    text-align: right;
    padding-right: 15px;
}

.user-detail{
    position: relative;
}
.user-detail i{
    position: absolute;
    right: 5px;
    top: 5px;
}
.order-head .order-date {
    font-weight: 700;
    color: #939393;
}
.order-head .order-no {
    margin-right: 15px;
    padding: 7px 17px;
    background: #57bce217;
    color: #57bce2;
    border-radius: 23px;
    font-weight: 700;
}
.order-head {
    display: flex;
    align-items: center;
    font-size: 18px;
    margin: 20px 0;
    font-family: segoe UI;
}
.prod-detail {
    display: flex;
    justify-content: space-between;
    padding: 20px 0;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
}
.prod .prod-img {
    max-width: 130px;
    margin-right: 10px;
}
.prod {
    display: flex;
}
.quan {
    padding-left: 0 !important;
}
.quan, .price {
    font-size: 14px;
    padding: 5px 16px;
    font-weight: 600;
    color: #444;
    display: inline-block;
}
.address p:first-child, .delivery p:first-child {
    font-size: 15px;
    font-weight: 700;
}
.prod-text h2 {
    font-size: 19px;
    margin: 0;
}
.single-order {
    outline: none;
    background: #57bce200;
    padding: 10px 30px;
    margin: 30px 0;
    box-shadow: 0 0 2px 2px #eee;
}
.total .total-price p {
    font-weight: 700;
    font-size: 22px;
}
.total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}
@media only screen and (max-width: 1199px){
    .prod-detail{
        flex-direction: column;
    }
    .prod-detail > div{
        margin-bottom: 10px;
    }
}
@media only screen and (max-width: 767px){
    .order-head{
        flex-direction: column;
        align-items: flex-start;
    }
    .order-head > div{
        margin-bottom: 10px;
    }
    .single-order{
        padding: 10px;
    }
}
@media only screen and (max-width: 475px){
    .details > span {
        flex-direction: column;
        margin-bottom: 10px;
    }
    .details > span span:first-child{
        text-align: left;
    }
    .prod{
        flex-direction: column;
    }
    .prod > div{
        margin-bottom: 10px;
    }
    .cancel{
        font-size: 14px;
    }
    .total .total-price p{
        font-size: 18px;
    }
    .order-head .order-no, .order-head .order-date{
        font-size: 16px;
    }
}
');



$script = <<<JS
$(function() {
    $('a[data-toggle="tab"]').on('click', function(e) {
        window.localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = window.localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
        window.localStorage.removeItem("activeTab");
    }
});
JS;
$this->registerJS($script);
?>