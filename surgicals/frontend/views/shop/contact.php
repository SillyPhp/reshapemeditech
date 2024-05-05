<section class="contact">
    <div class="contact-heading">
        <img src="/images/content/about/whey-protein-powder.jpg">
        <h1>Contact Phychiclabz</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center my-3">Get in Touch</h1>
            </div>
        </div>
        <div class="row contact-form mb-5">
            <div class="col-md-12">
                <form class="contact-form row">
                    <div class="form-field col x-50">
                        <input id="name" class="input-text js-input" name="name" type="text" required>
                        <label class="label" for="name">Name</label>
                    </div>
                    <div class="form-field col x-50">
                        <input id="email" class="input-text js-input" type="email" name="email" required>
                        <label class="label" for="email">E-mail</label>
                    </div>
                    <div class="form-field col x-100">
                        <input id="message" class="input-text js-input" type="text" name="message" required>
                        <label class="label" for="message">Message</label>
                    </div>
                    <div class="form-field col x-100 align-center">
                        <input class="submit-btn" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="contact-card py-3">
                    <i class="fa fa-map-marker"></i>
                    <h3>Address</h3>
                    <p>#2128 - Street Number 7,Arjun Nagar</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="fa fa-phone"></i>
                    <h3>Phone</h3>
                    <p>+91-9876543210</p>
                    <p>+91-9876543210</p>
                    <a href="">Call</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="fa fa-envelope"></i>
                    <h3>Email</h3>
                    <p>example@mail.com</p>
                    <p>example@mail.com</p>
                    <a href="">Mail</a>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->registerCss('
    .contact{
        margin: 25px 0;
        margin-top: 0;
    }
    .contact-heading{
        height: 250px;
        width: 100%;
        position: relative;
    }
    .contact-heading img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.2;
    }
    .contact-heading h1 {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        text-transform: uppercase;
        color: #000;
    }
    .contact-heading h1::before {
        width: 9px;
        height: 100%;
        background: #57bce2;
        content: "";
        display: inline-block;
        position: absolute;
        left: -17px;
    }
    .contact-form{
        margin-bottom: 25px;
    }
    .contact-form .row {
        margin: -20px 0;
        display: block;
      }
      .contact-form .row:after {
        content: "";
        display: table;
        clear: both;
      }
      .contact-form .row .col {
        padding: 0 20px;
        float: left;
        box-sizing: border-box;
      }
      .contact-form .row .col.x-50 {
        width: 50%;
      }
      .contact-form .row .col.x-100 {
        width: 100%;
      }
    .contact-form .form-field {
    position: relative;
    margin: 25px 0;
    }
    .contact-form .input-text {
    display: block;
    width: 100%;
    height: 36px;
    border-width: 0 0 2px 0;
    border-color: #000;
    font-family: Lusitana, serif;
    font-size: 18px;
    line-height: 26px;
    font-weight: 400;
    }
    .contact-form .input-text:focus {
    outline: none;
    }
    .contact-form .input-text:focus + .label, .contact-form .input-text.not-empty + .label {
    transform: translateY(-24px);
    }
    .contact-form .label {
    position: absolute;
    left: 20px;
    bottom: 17px;
    font-family: Lusitana, serif;
    font-size: 18px;
    line-height: 26px;
    font-weight: 400;
    color: #888;
    cursor: text;
    transition: transform 0.2s ease-in-out;
    }
    .contact-form .submit-btn {
    display: inline-block;
    background-color: #000;
    color: #fff;
    font-family: Raleway, sans-serif;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 16px;
    line-height: 24px;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    }
    .contact-card {
        box-shadow: 0 0 2px 2px #ddd;
        padding: 20px;
        min-height: 240px;
        text-align: center;
        position: relative;
    }
    .contact-card i {
        font-size: 50px;
        color: #42d79e;
    }
    .contact h3 {
        margin-top: 20px;
        color: #646464;
    }
    .contact-card p {
        font-size: 16px;
        margin: 0;
    }
    .contact-card a {
        background: #42d79e;
        text-decoration: none;
        color: #fff;
        left: 50%;
        transform: translate(-50%);
        width: 90%;
        position: absolute;
        bottom: 10px;
        padding: 3px 0;
    }
    
') ?>