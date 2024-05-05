<?php
//$this->params['body_classes'] = 'left-sidebar';
?>
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">
            <nav class="woocommerce-breadcrumb">
                <a href="/">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>My Account
            </nav>

            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <!--Main Content begins-->
                    <section class="pt-100 pb-100">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-10">
                                    <div class="account-wrapper">
                                        <div id="faq" class="panel-group">
                                            <div class="panel panel-default single-my-account">
                                                <div class="panel-heading my-account-title">
                                                    <h3 class="panel-title"><span>1 .</span> <a>Edit
                                                            your account information </a></h3>
                                                </div>
                                                <div id="my-account-1" class="panel-collapse collapse show">
                                                    <div class="panel-body">
                                                        <div class="myaccount-info-wrapper">
                                                            <div class="account-info-wrapper">
                                                                <h4>My Account Information</h4>
                                                                <h5>Your Personal Details</h5>
                                                            </div>
                                                            <div class="row">
<!--                                                                <div class="col-md-4">-->
<!--                                                                    <div class="avatar-upload">-->
<!--                                                                        <div class="avatar-edit">-->
<!--                                                                            <input type='file' id="imageUpload"-->
<!--                                                                                   accept=".png, .jpg, .jpeg"/>-->
<!--                                                                            <label for="imageUpload"></label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="avatar-preview">-->
<!--                                                                            <div id="imagePreview"-->
<!--                                                                                 style="background-image: url(http://placehold.it/180x180);">-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
                                                                <div class="col-md-12">
                                                                    <div class="row">
<!--                                                                        <div class="col-lg-6 col-md-6">-->
<!--                                                                            <div class="billing-info">-->
<!--                                                                                <label>First Name</label>-->
<!--                                                                                <input type="text">-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="col-lg-6 col-md-6">-->
<!--                                                                            <div class="billing-info">-->
<!--                                                                                <label>Last Name</label>-->
<!--                                                                                <input type="text">-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="col-lg-6 col-md-6">-->
<!--                                                                            <div class="billing-info">-->
<!--                                                                                <label>Email Address</label>-->
<!--                                                                                <input type="email">-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="col-lg-6 col-md-6">-->
<!--                                                                            <div class="billing-info">-->
<!--                                                                                <label>Phone</label>-->
<!--                                                                                <input type="text">-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
                                                                        <div class="col-lg-4 col-md-4">
                                                                            <div class="billing-info">
                                                                                <label>Username</label>
                                                                                <input type="text" name="username" id="username" value="<?= $model['username'] ?>" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4">
                                                                            <div class="billing-info">
                                                                                <label>Contacts</label>
                                                                                <input type="text" name="contact" id="contact" value="<?= $model['contact'] ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4">
                                                                            <div class="billing-info">
                                                                                <label>Emails</label>
                                                                                <input type="text" name="emails" id="emails" value="<?= $model['email'] ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="billing-back-btn">
                                                                <div class="billing-btn">
                                                                    <button type="submit" class="action-primary" id="edit_info">Continue
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default single-my-account">
                                                <div class="panel-heading my-account-title">
                                                    <h3 class="panel-title"><span>2 .</span> <a>Change
                                                            your password </a></h3>
                                                </div>
                                                <div id="my-account-2" class="panel-collapse collapse show">
                                                    <div class="panel-body">
                                                        <div class="myaccount-info-wrapper">
                                                            <div class="account-info-wrapper">
                                                                <h4>Change Password</h4>
                                                                <h5>Your Password</h5>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="billing-info">
                                                                        <label>Password</label>
                                                                        <input type="password">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="billing-info">
                                                                        <label>Password</label>
                                                                        <input type="password">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4">
                                                                    <div class="billing-info">
                                                                        <label>Password Confirm</label>
                                                                        <input type="password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="billing-back-btn">
                                                                <div class="billing-back">
                                                                    <a href="#"><i class="fa fa-arrow-up"></i> back</a>
                                                                </div>
                                                                <div class="billing-btn">
                                                                    <button type="submit" class="action-primary">Continue
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default single-my-account">
                                                <div class="panel-heading my-account-title">
                                                    <h3 class="panel-title"><span>3 .</span> <a>Modify
                                                            your address book entries </a></h3>
                                                </div>
                                                <div id="my-account-3" class="panel-collapse collapse show">
                                                    <div class="panel-body">
                                                        <div class="myaccount-info-wrapper">
                                                            <div class="account-info-wrapper">
                                                                <h4>Address Book Entries</h4>
                                                            </div>
                                                            <div class="entries-wrapper">
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                                        <div class="entries-info text-center">
                                                                            <p>Model Town </p>
                                                                            <p> Road#1 , Block#c </p>
                                                                            <p>Punjab </p>
                                                                            <p>India </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                                        <div class="entries-edit-delete text-center">
                                                                            <a class="edit" href="#">Edit</a>
                                                                            <a href="#">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="billing-back-btn">
                                                                <div class="billing-back">
                                                                    <a href="#"><i class="fa fa-arrow-up"></i> back</a>
                                                                </div>
                                                                <div class="billing-btn">
                                                                    <button type="submit" class="action-primary">Continue
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>
<?php
$this->registerCss('
/*My account page css start*/
.pt-100 {
    padding-top: 100px;
}
.pt-50 {
    padding-top: 50px;
}
.pb-100 {
    padding-bottom: 100px;
}
.single-my-account {
    margin-bottom: 20px;
    border: 1px solid #ebebeb;
}
.single-my-account h3.panel-title {
    background-color: #f9f9f9;
    border-bottom: 1px solid #ebebeb;
    color: #000;
    font-size: 15px;
    font-weight: 500;
    margin: 0;
    position: relative;
    text-transform: uppercase;
}
@media only screen and (max-width: 767px) {
    .single-my-account h3.panel-title {
        line-height: 22px;
        font-size: 14px;
    }
}
.single-my-account h3.panel-title span {
    color: #242424;
    font-size: 15px;
    left: 20px;
    position: absolute;
    top: 16px;
}
.single-my-account h3.panel-title a {
    color: #242424;
    display: block;
    padding: 16px 55px;
    position: relative;
}
@media only screen and (max-width: 767px) {
    .single-my-account h3.panel-title a {
        padding: 16px 30px 16px 40px;
    }
}
.single-my-account h3.panel-title a:hover {
    color: #099A6F;
}
.single-my-account h3.panel-title a::before {
    color: #000;
    content: "\f107";
    display: inline-block;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 16px;
    position: absolute;
    right: 10px;
    top: 19px;
}
.single-my-account h3.panel-title a:hover::before {
    color: #099A6F;
}
.single-my-account .myaccount-info-wrapper {
    padding: 30px 20px;
    background-color: #fff;
}
.single-my-account .myaccount-info-wrapper .account-info-wrapper {
    border-bottom: 1px solid #eaeaea;
    margin-bottom: 28px;
    padding-bottom: 30px;
}
.single-my-account .myaccount-info-wrapper .account-info-wrapper h4 {
    font-size: 15px;
    margin: 0;
    text-transform: uppercase;
}
.single-my-account .myaccount-info-wrapper .account-info-wrapper h5 {
    font-size: 16px;
    letter-spacing: 0.2px;
    margin-top: 7px;
}
.single-my-account .myaccount-info-wrapper .billing-info {
    margin-bottom: 20px;
}
.single-my-account .myaccount-info-wrapper .billing-info label {
    color: #000;
    font-size: 14px;
    text-transform: capitalize;
}
.single-my-account .myaccount-info-wrapper .billing-info input {
    background: transparent none repeat scroll 0 0;
    border: 1px solid #ebebeb;
    color: #000;
    height: 45px;
    padding: 0 15px;
}
.single-my-account .myaccount-info-wrapper .billing-back-btn {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    margin-top: 26px;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.single-my-account .myaccount-info-wrapper .billing-back-btn .billing-back a {
    color: #000;
    display: inline-block;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
}
.single-my-account .myaccount-info-wrapper .billing-back-btn .billing-back a:hover {
    color: #099A6F;
}
.single-my-account .myaccount-info-wrapper .billing-back-btn .billing-back a i {
    font-size: 16px;
    color: #099A6F;
}
.single-my-account .myaccount-info-wrapper .billing-back-btn .billing-btn button:hover {
    background: #099A6F;
    color: #fff;
}
.single-my-account .myaccount-info-wrapper .entries-wrapper {
    border: 1px solid #eaeaea;
    position: relative;
}
@media only screen and (max-width: 767px) {
    .single-my-account .myaccount-info-wrapper .entries-wrapper {
        padding: 30px 10px;
    }
    .single-my-account .myaccount-info-wrapper .entries-wrapper::before {
        display: none;
    }
}
.single-my-account .myaccount-info-wrapper .entries-wrapper::before {
    position: absolute;
    content: "";
    height: 100%;
    width: 1px;
    left: 50%;
    top: 0;
    background-color: #eaeaea;
}
.single-my-account .myaccount-info-wrapper .entries-wrapper .entries-info {
    padding: 30px 20px;
}
@media only screen and (max-width: 767px) {
    .single-my-account .myaccount-info-wrapper .entries-wrapper .entries-info {
        padding: 0 10px 30px;
    }
}
.single-my-account .myaccount-info-wrapper .entries-wrapper .entries-info p {
    color: #000;
    font-size: 15px;
    margin: 0;
    text-transform: capitalize;
}
.single-my-account .myaccount-info-wrapper .entries-wrapper .entries-edit-delete a {
    background-color: #000;
    color: #fff;
    display: inline-block;
    line-height: 1;
    margin: 0 2px;
    padding: 12px 15px;
    text-transform: uppercase;
    font-weight: 500;
}
.single-my-account .myaccount-info-wrapper .entries-wrapper .entries-edit-delete a:hover,
.single-my-account .myaccount-info-wrapper .entries-wrapper .entries-edit-delete a.edit,
.single-my-account .myaccount-info-wrapper .entries-wrapper .entries-edit-delete a.edit:hover {
    background-color: #099A6F;
}
.avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;
}
.avatar-upload .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 10px;
}
.avatar-upload .avatar-edit input {
    display: none;
}
.avatar-upload .avatar-edit input+label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input+label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input+label:after {
    content: "\f303";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    color: #757575;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
}
.avatar-upload .avatar-preview {
    width: 192px;
    height: 192px;
    position: relative;
    border-radius: 100%;
    border: 6px solid #F8F8F8;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview>div {
    width: 100%;
    height: 100%;
    border-radius: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
/*My account page css ends*/
');
$script = <<<JS
$(document).on('click','#edit_info',function(e){
    e.preventDefault();
    var contact = $('#contact').val();
    var email = $('#emails').val();
    $.ajax({
        url: '/site/edit-profile',
        type: 'POST',
        data: {contact: contact,email:email},
        success: function (response) { 
            if (response.status == 200) {
                toastr.success(response.message, response.title);
            } else {
                toastr.error(response.message, response.title);
            }
        },
    });
});
JS;
$this->registerJs($script);