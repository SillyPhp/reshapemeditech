<li class="dropdown menu-button hs_top_user_profile">
    <a href="#">
        <img src="/images/header/top_user.png" alt="user">
        <span class="hidden-xs">Login / Register</span>
    </a>
    <ul class="dropdown-menu">
        <li class="signin_dropdown">
            <a href="#" class="btn btn-primary"> <span>Login with Facebook</span> <i
                    class="fa fa-facebook"></i> </a>
            <a href="#" class="btn btn-primary google-plus"> Login with Google <i
                    class="fa fa-google-plus"></i> </a>
            <h2>or</h2>
            <form id="login-widget">
            <div class="formsix-pos">
                <div class="form-group i-email">
                    <input type="email" class="form-control" required="" id="emailTen"
                           placeholder="Email Address *">
                </div>
            </div>
            <div class="formsix-e">
                <div class="form-group i-password">
                    <input type="password" class="form-control" required=""
                           id="namTen-first" placeholder="Password *">
                </div>
            </div>
            <div class="remember_box">
                <label class="control control--checkbox">Remember me
                    <input type="checkbox">
                    <span class="control__indicator"></span>
                </label>
                <a href="#" class="forget_password">
                    Forgot Password
                </a>
            </div>
            <div class="hs_effect_btn">
                <ul>
                    <li data-animation="animated flipInX">
                        <button type="submit" class="hs_btn_hover requestLogin">Login</button>
                    </li>
                </ul>
            </div>
            </form>
            <div class="sign_up_message">
                <p>Don’t have an account ? <a href="#"> Sign up </a></p>
            </div>
        </li>
    </ul>
</li>
<?php
$script = <<<JS
$(document).on('click','.')
JS;
$this->registerJs($script);
