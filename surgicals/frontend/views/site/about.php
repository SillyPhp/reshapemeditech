<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
?>
    <section class="about">
        <div class="about-heading">
            <img src="/images/content/about/whey-protein-powder.jpg">
            <h1>About The BodyBay</h1>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                    <div class="col-sm-6">
<!--                        <img src="/images/header/psychiclabz-logo.png">-->
                    </div>
                    <div class="col-sm-6">
                    <div class="about-text">
                        <h1>About</h1>
                        <p>Happiness lies in Good Health. As we all know if our bodies are healthy only then we will be able to enjoy our lives to the fullest. Here, in The BodyBay, we focus on providing genuine and authentic health supplements at the best price to maintain your health and eventually your happiness. We deal in various health supplements like whey proteins, Gainers, BCAA, omega3, multivitamin & other wellness products.</p>
                        <h1>Our Story</h1>
                        <p>Our founder Sunny Goyal got this idea when he was in Melbourne, Australia back in 2009 and came across people who were so concerned about their health. In 2010, he came back to India with big dreams but he joined his family business.
                            In 2013, he came across a person who was selling fake health supplements to people and was risking their lives. From there, The BodyBay came into existence to provide 100% genuine health supplements to people.
                            We started our journey in 2014 from a wholesale business of health supplements. In 2015, we moved from wholesale business to retail business to provide 100% authentic products to the customers in the market of counterfeit products.
                            Currently we have taken a step ahead by making our business digital across PAN India. We have come up with the goal of providing the unfeigned and authentic health supplements to the customers at affordable and genuine prices. Thus, believing that the best investment that anyone can make is in their own health.</p>
                    </div>
                    </div>
            </div>
        </div>
    </section>


<?php $this->registerCss('
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
        opacity: 0.2;
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