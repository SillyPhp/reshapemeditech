<?php
/*
*  Component  : User
*  View       : Change Email  
*  Engine     : CommonUserEngine.js  
*  File       : change-email.blade.php  
*  Controller : UserChangeEmailController 
----------------------------------------------------------------------------- */ 
?>
<div ng-controller="UserChangeEmailController as changeEmailCtrl">


    <!-- /error notification -->
    <div class="col-md-6 col-xs-12 offset-md-3 lw-login-form-box shadow p-4 border">
        <div class="lw-section-heading-block">
        <!--  main heading  -->
            <h3 class="lw-section-heading"> 
            <div class="lw-heading"><?=  __tr( 'Update Email' )  ?></div></h3>
        <!--  /main heading  -->
    </div>
    
	<div ng-if="!changeEmailCtrl.activationRequired && changeEmailCtrl.requestSuccess">
    	<div class="alert alert-success" role="alert"><strong><?=  __tr( 'Well done!' )  ?></strong> 
    	[[ changeEmailCtrl.successMessage ]]</div>
    </div>

    <div ng-if="publicCtrl.isEmptyUserEmail" class="lw-form alert alert-info">
        <?= __tr("You didn't set your email address") ?>
    </div>

	<!--  /note  -->

	<!--  form action  -->
    <form class="lw-form lw-ng-form" 
        name="changeEmailCtrl.[[ changeEmailCtrl.ngFormName ]]" 
        ng-submit="changeEmailCtrl.submit()" 
        novalidate>

			<div class="form-group" ng-if="!publicCtrl.isEmptyUserEmail">
				<label class="control-label"> <?=  __tr( 'Current Email' )  ?></label>
				<input readonly="" type="text" class="form-control" ng-model="changeEmailCtrl.current_email">
			</div>
			<!--  /Current Email  -->

        <div class="form-row">
            <div class="col" ng-if="!publicCtrl.isEmptyUserEmail">
                <!--  Current Password  -->
                <lw-form-field field-for="current_password" label="<?=  __tr( 'Current Password' )  ?>"> 
                    <input type="password" 
                          class="lw-form-field form-control"
                          name="current_password"
                          min-length="6"
                          max-length="30"
                          ng-required="true"
                          autofocus 
                          ng-model="changeEmailCtrl.userData.current_password" autofocus />
                </lw-form-field>
                <!--  /Current Password  -->
            </div>
            <div class="col">
                <!--  New Email  -->
                <lw-form-field field-for="new_email" label="<?=  __tr( 'New Email' )  ?>"> 
                    <input type="email" 
                          class="lw-form-field form-control"
                          name="new_email"
                          ng-required="true" 
                          ng-model="changeEmailCtrl.userData.new_email" />
                </lw-form-field>
                <!--  /New Email  -->
            </div>
        </div>
		
		<!--  update button  -->
        <div class="form-group">
            <button type="submit" class="lw-btn btn btn-primary" title="<?=  __tr('Update Request')  ?>"><?=  __tr('Update Email')  ?> </button>
        </div>
		<!--  /update button  -->
    </form>
	<!--  /form action  -->
	
</div>