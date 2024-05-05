<?php
/*
*  Component  : User
*  View       : Login
*  Engine     : UserEngine.js
*  File       : login.blade.php
*  Controller : UserLoginController
----------------------------------------------------------------------------- */
?>
<div ng-controller="UserLoginController as loginCtrl" ng-show="loginCtrl.request_completed == true">
     @if(!empty(Session::get('invalidUserMessage')))
          <div class="alert alert-danger">
          <!--  invalid user message  -->
               <?= Session::get('invalidUserMessage') ?>
          <!--  /invalid user message  -->
          </div>
     @endif

    <!-- error notification -->
	<div ng-show="loginCtrl.errorMessage && loginCtrl.accountDeleted" class="alert alert-danger" role="alert">
		<div class="ui bottom error message animated fadeIn">
			<i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;<span ng-bind="loginCtrl.errorMessage"></span>
		</div>
	</div>
	<!-- /error notification -->
    <div class="col-md-6 col-xs-12 offset-md-3 lw-login-form-box shadow p-4 border">
        <div class="lw-section-heading-block">
        <!--  main heading  -->
            <h3 class="lw-section-heading">@section('page-title',  __tr( 'Account Access' )) 
            <div class="lw-heading"><?=  __tr( 'Account Access' )  ?></div></h3>
        <!--  /main heading  -->
    </div>
     <!--  form action  -->
     <form class="lw-form lw-ng-form form-horizontal omb_login"
          name="loginCtrl.[[ loginCtrl.ngFormName ]]"
          ng-submit="loginCtrl.submit()"
          novalidate>

          <!--  Email  -->
          <lw-form-field field-for="emailOrUsername" label="<?=  __tr( 'Username / Email' )  ?>">
               <input type="text"
               class="lw-form-field form-control"
               name="emailOrUsername"
               ng-required="true"
               placeholder="<?= __tr('Enter username / email') ?>" 
               ng-model="loginCtrl.loginData.emailOrUsername" />
          </lw-form-field>
          <!--  Email  -->

          <!--  Password  -->
          <lw-form-field field-for="password" label="<?=  __tr( 'Password' )  ?>">
                <div class="input-group">
                    <input type="password"
                        class="lw-form-field form-control"
                        name="password"
                        ng-minlength="6"
                        ng-required="true"
                        ng-maxlength="30"
                        placeholder="<?= __tr('Enter password') ?>" 
                        ng-model="loginCtrl.loginData.password" />
                    <div class="input-group-append">
                         <a class="input-group-text" ui-sref="forgot_password" title="<?=  __tr('Forgot Password?')  ?>"><?=  __tr('Forgot Password?')  ?></a>
                    </div>
               </div>
          </lw-form-field>
          <!--  Password  -->
          
		<div ng-if="loginCtrl.show_captcha == true">
    		<lw-form-field class="lw-recaptcha" field-for="recaptcha" v-label="Captcha" label="<?= __tr('Verify you are not robot') ?>">
                <lw-recaptcha class="lw-form-field g-recaptcha" 
                    ng-model='loginCtrl.loginData.recaptcha' 
                    name="recaptcha" 
                    sitekey="[[loginCtrl.site_key]]" ng-required="loginCtrl.show_captcha == true">
                </lw-recaptcha>
            </lw-form-field>
        </div>

         <!--  Remember me  -->
          <div class="lw-form-inline-elements">
               <lw-form-checkbox-field
                    field-for="remember_me"
                    label="<?=  __tr( 'Remember Me' )  ?>"
                    class="lw-margin-link lw-contain-remember-me-link">
                    <input type="checkbox"
                         class="lw-form-field"
                         name="remember_me"
                         ng-model="loginCtrl.loginData.remember_me" />
               </lw-form-checkbox-field>
          </div>
        	<div class="form-group">
               <button type="submit" class="lw-btn btn btn-primary lw-responsive-btn" title="<?=  __tr('Login')  ?>"><?=  __tr('Let me in')  ?> </button>
          	</div>
     </form>
     <!--  /form action  -->
     </div>
</div>
