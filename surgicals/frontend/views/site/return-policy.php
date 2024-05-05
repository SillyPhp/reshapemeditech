<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Return Policy';
?>
    <section class="about">
        <div class="about-heading">
            <img src="/images/return-policy.jpg">
            <h1>Return Policy</h1>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="about-text">
                        <h1>Return and Refund</h1>
                        <p>
                            Return and Cancellation Policy:
                            <br>
                            <br>
                            “Due to Covid-19 Pandemic, Returns are RESTRICTED.”
                            <br>
                            1. Do not Accept any product that seems to have been tampered at delivery.
                            <br>
                            2. Please make a video while opening the Packaging as supporting proof.
                            <br>
                            3. Do not open the seal of the product if you have any doubts/questions about its authenticity.
                            <br>
                            4. Once the product seal is broken, we don't accept the product for exchange or return.
                            <span class="gap-bt-ques"></span>
                            WE DO NOT TAKE ANY LIABILITY REGARDING THE TASTE / MIXABILITY OF THE PRODUCT. If there is any concern, you need to raise it to Brand and there is no return/replacement for the same.
                            <br>
                            We won’t be able to accept any return/replacement if the above points are not being followed.
                            <br>
                            Since ingredients of BCAA’s and Pre-workout are hygroscopic in nature, they’ll tend to form lumps. However, the supplement is completely safe to consume. Please shake the product well before use.
                            <br>
                            If you have any additional questions or concerns please email us.
                            <br>
                            At thebodybay.com, we offer you complete peace of mind while ordering.
                            <span class="gap-bt-ques"></span>
                            Q: What should I do if I receive a damaged item, wrong product, or missing units in my order?
                            <br>
                            A: We recommend that you should make a video as proof before unboxing. If you received any damaged item or incorrect item or less quantity than you have ordered then just sent the image or the video to us at support@thebodybay.com. We will get back to you within 24-48hrs.
                            <br>
                            After doing all the investigation, we will get back to you. We will arrange a reverse pickup.
                            <br>
                            1. Our courier partner will take 1-2 working days to pick up the product/item from you,
                            <br>
                            2. The standard delivery takes a minimum of 5-7 working days to get back to our warehouse.
                            <br>
                            3. Once the product is received back to us, our quality team will check the condition of the product.
                            <br>
                            4. On receiving a positive response we will get back to you and as per your request, we will replace or refund you for the order.
                            <br>
                            5. In case we receive a negative response the product would be sent back to you in the same condition.
                            <span class="gap-bt-ques"></span>
                            Q. What should I do when I receive a damaged product/item?
                            <br>
                            A. We recommend you not to accept the product/item from the courier boy and kindly take images (or videos) of the same and share with us at support@thebodybay.com (We will respond back in 24 – 48 hours).
                            <br>
                            Q: Is there a category-specific policy for returns?
                            <br>
                            A: No there is not any category-specific policy for returns. Products should be received in original packaging and sealed condition. Opened or used boxes will not be accepted as returns. If you are allergic to anything, please consult with the doctor before buying the product.
                            <span class="gap-bt-ques"></span>
                            Q: Can I modify the shipping address of my order after it has been placed?
                            A: Get in touch with us at support@thebodybay.com.
                            <br>
                            <br>
                            The following shall NOT be eligible for return or replacement:
                            <br>
                            1. Damages due to misuse of the product.<br>
                            2. Incidental damage due to malfunctioning of product.<br>
                            3. Any consumable item which has been used or installed.<br>
                            4. Products with tampered or missing serial / UPC numbers.<br>
                            <br>
                            Stock Clearance Products are not eligible for return or replacement. The damage that is not covered under the manufacturer’s warranty.
                            <br>
                            Some special rules for promotional offers may override. In case of any queries, please write to our customer care on support@thebodybay.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
<?php $this->registerCss('
    .gap-bt-ques{
        height: 35px;
        display: block;
    }
    .about{
        margin: 25px 0;
        margin-top: 0;
    }
    .about-heading{
        height: 250px;
        width: 100%;
        position: relative;
    }
    .about-heading img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.5;
    }
    .about-heading h1 {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        text-transform: uppercase;
        color: #000;
        font-family: inherit;   
    }
    .about-heading h1::before {
        width: 9px;
        height: 100%;
        background: #57bce2;
        content: "";
        display: inline-block;
        position: absolute;
        left: -17px;
    }
    .about-text {
        max-width: 720px;
        margin: 25px auto;
        background: #fff4dc;
        padding: 50px;
        border-top: 4px solid #ffc851;
    }
    .about-text h1 {
        margin-bottom: 20px;
    }
    .about-text p {
        font-size: 16px;
        font-weight: 600;
        color: #5c5c5c;
    }
    @media only screen and (max-width: 475px){
        .about-text{
            padding: 15px;
        }
    }
')?>