<style>
    .stars, .twinkling{
        display: none !important;
    }
</style>
<!-- hs About Title Start -->
<div class="hs_indx_title_main_wrapper">
    <div class="hs_title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                <div class="hs_indx_title_left_wrapper">
                    <h2>Checkout</h2>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
                <div class="hs_indx_title_right_wrapper">
                    <ul>
                        <li><a href="/">Home</a> &nbsp;&nbsp;&nbsp;></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hs About Title End -->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <?php
                print_r($data);
                ?>
<button id="rzp-button1" style="background-color: red;">Pay</button>
            </div>
        </div>
    </div>
</section>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "rzp_test_4XDZQNrb3SgKIk", // Enter the Key ID generated from the Dashboard
        "amount": "", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        // "currency": "INR",
        "name": "The BodyBay",
        "description": "Best Online Health Supplements Store across PAN India with 100% Authentic Products",
        "image": "https://techneyo.com/images/logo/logo.png",
        "order_id": "<?=$data['id'];?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function (response){
            alert(response.razorpay_payment_id);
            alert(response.razorpay_order_id);
            alert(response.razorpay_signature)
        },
        "prefill": {
            // "name": "Gaurav Kumar",
            // "email": "gaurav.kumar@example.com",
            // "contact": "9999999999"
        },
        "notes": {
            // "address": "Razorpay Corporate Office"
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
    });
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
</script>