<section class="chcekout-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout-form">
                    <h1>Ship To</h1>
                    <form>
                        <div class="form-row">
                            <div class="col">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" placeholder="First name" name="firstname">
                            </div>
                            <div class="col">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last name" name="lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St">
                        </div>
                        <div class="form-row">
                            <div class="col">
                            <label for="pincode">ZIP code</label>
                            <input type="text" class="form-control" placeholder="ZIP code" name="pincode">
                            </div>
                            <div class="col">
                            <label for="city">Town/City</label>
                            <input type="text" class="form-control" placeholder="Town/City" name="city">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col">
                            <label for="state">State</label>
                            <input type="text" class="form-control" placeholder="State" name="state">
                            </div>
                            <div class="col">
                            <label for="phone">Phone No.</label>
                            <input type="text" class="form-control" placeholder="9876543210" name="phone">
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="col-md-4">
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
        </div>
    </div>
</section>

<?php $this->registerCss('
.chcekout-page{
    margin: 25px;
}

.checkout-form h1{
    margin-bottom: 20px;
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