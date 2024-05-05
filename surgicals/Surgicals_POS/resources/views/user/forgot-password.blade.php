<?php
/*
*  Component  : User
*  View       : Forgot Password  
*  Engine     : UserEngine.js  
*  File       : forgot-password.blade.php  
*  Controller : UserForgotPasswordController 
----------------------------------------------------------------------------- */ 
?>
<div ng-controller="UserForgotPasswordController as forgotPasswordCtrl">
	<!--  form action  -->
    <form class="lw-form lw-ng-form col-md-6 col-xs-12 offset-md-3 shadow p-4 border" 
        name="forgotPasswordCtrl.[[ forgotPasswordCtrl.ngFormName ]]" 
        ng-submit="forgotPasswordCtrl.submit()" 
        novalidate>

        <div class="lw-section-heading-block">
        <!--  main heading  -->
        <h3 class="lw-section-heading">@section('page-title',  __tr( 'Forgot Password' )) <div class="lw-heading"><?=  __tr( 'Forgot Password' ) ?></div></h3>
        <!--  /main heading  -->
    </div>

        
        <!--  Email  -->
        <lw-form-field field-for="usernameOrEmail" label="<?=  __tr( 'Enter your username / email address' ) ?>" v-label="<?=  __tr( 'Username / Email' ) ?>"> 
            <input type="test" 
              class="lw-form-field form-control"
              name="usernameOrEmail"
              ng-required="true" 
              ng-model="forgotPasswordCtrl.userData.usernameOrEmail" />
        </lw-form-field>
        <!--  /Email  -->

		<!--  submit button  -->
        <div class="form-group lw-form-actions">
            <button type="submit" class="lw-btn btn btn-primary" title="<?=  __tr('Submit Request') ?>"><?=  __tr('Submit Request') ?></button>
        </div>
		<!--  /submit button  -->
    </form>
	<!--  /form action  -->
</div>