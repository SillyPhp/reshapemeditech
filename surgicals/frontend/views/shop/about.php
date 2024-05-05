<section class="about">
    <div class="about-heading">
        <img src="/images/content/about/whey-protein-powder.jpg">
        <h1>About Phychiclabz</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="about-text">
                    <h1>Who We Are</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, natus eveniet minus libero possimus quos unde aliquid laboriosam voluptas? Corporis, est fugiat. Officia dolor alias quibusdam suscipit atque necessitatibus esse aspernatur blanditiis rem dolorem ex non, quia vel minima laboriosam accusamus eveniet aliquam quasi ipsam tenetur? Tenetur modi, tempora et laudantium esse ipsam officiis facilis nulla quidem aliquam sit excepturi, necessitatibus porro delectus quaerat? Repellendus eius velit deleniti explicabo ab iusto ex voluptatibus officiis eum beatae inventore deserunt pariatur, provident consequatur aliquid cum voluptatum at quibusdam nihil, fugiat iste quidem? Repellendus dignissimos iusto perferendis quibusdam, eligendi voluptas tempora distinctio eveniet.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro impedit nostrum quam, quidem non odit doloribus quibusdam commodi, aut molestiae veritatis eos inventore assumenda, corporis veniam. Aperiam harum perspiciatis magnam laudantium architecto veritatis facere quia, recusandae dolorum a, sunt labore officia maxime repudiandae molestias iusto temporibus cumque fuga quos saepe.</p>
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