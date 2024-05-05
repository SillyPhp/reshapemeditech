<section class="cart-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2">
                <div class="checkout">
                    <h1>Order Summary</h1>
                    <table class="amount">
                        <tr>
                            <td>Subtotal</td>
                            <td>2,999</td>
                        </tr>
                        <tr>
                            <td>Delivery</td>
                            <td>Free</td>
                        </tr>
                    </table>
                    <div class="total">
                        <span>Total</span>
                        <span>2,999</span>
                    </div>
                    <a href="" class="checkout-btn">Checkout</a>
                </div>
            </div>
            <div class="col-md-8 order-md-1">
                <div class="products">

                <?php
                for ($x = 0; $x <= 3; $x++) {?>

                    <div class="product-item">
                        <i class="fa fa-times cross-icon"></i>
                        <div class="product-img">
                            <img src="https://psychiclabz.techneyo.com/assets/images/banner/banner-01.png">
                        </div>
                        <div class="product-detail">
                        
                            <h1>₹1,999</h1>
                            <h3>Bigmuscles Nutrition Real Mass Gainer [1Kg, Chocolate] | Lean Whey Protein Muscle Mass Gainer.</h3>
                            <h5>1Kg Supplement</h5>
                        
                            <div class="quantity">
                                <div class="minus">-</div>
                                <div class="num">2</div>
                                <div class="plus">+</div>
                            </div>
                        
                        </div>
                    </div>
                
                <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->registerCss('
.cart-page{
    margin-top: 25px;
}
.cross-icon{
    position: absolute;
    top: 10px;
    right: 10px;
}
.product-item {
    position: relative;
    display: flex;
    min-height: 170px;
    box-shadow: 0 0 2px 2px #ededed;
    margin-bottom: 25px;
    padding: 10px 25px;
}
.product-img {
    max-width: 60px;
    margin-right: 30px;
}
.product-detail h1, .product-detail h3 {
    font-size: 20px;
    font-weight: 700;
    display: inline-block;
}
.product-detail h3 {
    font-size: 16px;
}
.product-detail h1 {
    color: #FF5C58;
}
.product-detail h5 {
    font-size: 13px;
    font-weight: 700;
    color: #7a7a7a;
}
.quantity {
    display: flex;
    border: 1px solid #818181;
    padding: 0 0px;
    align-items: center;
    width: fit-content;
    margin-top: 20px;
}
.minus, .num, .plus {
    display: flex;
    width: 32px;
    height: 32px;
    line-height: 32px;
    align-items: center;
    justify-content: center;
}
.checkout {
    box-shadow: 0 0 2px 2px #ededed;
    padding: 15px 10px;
    background: #f3f3f3;
    margin-bottom: 25px;
}
.checkout h1 {
    font-size: 18pt;
    font-family: Segoe UI;
}
.amount {
    width: 100%;
}
.amount tr td:nth-child(2) {
    text-align: right;
}
.total {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
    font-size: 20px;
    font-weight: 700;
}
.checkout-btn {
    display: block;
    text-align: center;
    background: #42d79e;
    color: #fff;
    margin-top: 40px;
    font-weight: 700;
    padding: 8px 0;
    text-transform: uppercase;
    letter-spacing: 1.1px;
}
.checkout-btn:hover{
    color: #fff;
    background: #57bce2;
    text-decoration: none;
}
')?>