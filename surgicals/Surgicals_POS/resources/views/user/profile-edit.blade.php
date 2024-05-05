<?php
/*
*  Component  : User
*  View       : Profile  
*  Engine     : CommonUserEngine.js  
*  File       : profile-edit.blade.php  
*  Controller : UserProfileEditController 
----------------------------------------------------------------------------- */ 
?>


<div ng-controller="UserProfileEditController as profileEditCtrl">
    
    <!-- /error notification -->
    <div class="col-md-6 col-xs-12 offset-md-3 lw-login-form-box shadow p-4 border">
        <div class="lw-section-heading-block">
        <!--  main heading  -->
            <h3 class="lw-section-heading"> 
            <div class="lw-heading"><?=  __tr( 'Profile Update' )  ?></div></h3>
        <!--  /main heading  -->
    </div>

    <form ng-if="profileEditCtrl.request_completed"  
        name="profileEditCtrl.[[ profileEditCtrl.ngFormName ]]" 
        ng-submit="profileEditCtrl.submit()" 
        novalidate>

        <input type="hidden" id="lwUserProfileEditTxtMsg" loading-text="<?= __tr( 'Upload in Process') ?>" file-uploaded-text="<?= __tr('File Uploaded') ?>">
        
        <!-- thumbnail -->
        <div class="form-group">
            <div class="lw-thumb-logo">
                <a href="[[ profileEditCtrl.existingProfilePictureURL ]]" lw-ng-colorbox class="lw-thumb-logo"><img  ng-src="[[ profileEditCtrl.existingProfilePictureURL ]]" alt=""></a>
            </div>
        </div>
        <!-- /thumbnail -->
        
        <!-- Profile Picture -->
        <lw-form-selectize-field field-for="profile_picture" label="<?= __tr( 'Profile Picture' ) ?>" class="lw-selectize">
            <span class="badge lw-badge">[[ profileEditCtrl.profileFilesCount ]]</span>
            <selectize config='profileEditCtrl.imagesSelectConfig' class="lw-form-field" name="profile_picture" ng-model="profileEditCtrl.profileData.profile_picture" options='profileEditCtrl.profileFiles' placeholder="<?= __tr( 'Select Uploaded Image' ) ?>" ></selectize>
            <!-- Upload Images -->

            <!-- Upload image -->
                @include('media.upload-button')
            <!-- / Upload image -->

        </lw-form-selectize-field>
        <!-- /Profile Picture -->

        <div class="form-row">
            <!--  First Name  -->
            <div class="col">
                <lw-form-field field-for="first_name" label="<?=  __tr( 'First Name' )  ?>"> 
                    <input type="text" 
                      class="lw-form-field form-control"
                      name="first_name"
                      ng-required="true" 
                      ng-model="profileEditCtrl.profileData.first_name" />
                </lw-form-field>
            </div>
            <!--  First Name  -->

            <!--  Last Name  -->
            <div class="col">
                <lw-form-field field-for="last_name" label="<?=  __tr( 'Last Name' )  ?>"> 
                    <input type="text" 
                      class="lw-form-field form-control"
                      name="last_name"
                      ng-required="true" 
                      ng-model="profileEditCtrl.profileData.last_name" />
                </lw-form-field>
            </div>
            <!--  Last Name  -->

            <!--  User Role  -->
            <div class="col">
                <lw-form-field field-for="userRole" label="<?=  __tr( 'User Role' )  ?>"> 
                    <input type="text" 
                      class="lw-form-field form-control"
                      name="userRole"
                      ng-required="true" 
                      readonly="true" 
                      ng-model="profileEditCtrl.profileData.userRole" />
                </lw-form-field>
            </div>
            <!--  User Role  -->
        </div>

        <div class="form-row">
            <!-- Address 1-->
            <div class="col">
                <lw-form-field field-for="address_line_1" label="{!! __tr('Address Line 1') !!}"> 
                  <input type="text" class=" form-control lw-form-field" name="address_line_1" ng-model="profileEditCtrl.profileData.address_line_1" />
                </lw-form-field>
            </div>
            <!-- /Address 1-->

            <!-- Address 2 -->
            <div class="col">
                <lw-form-field field-for="address_line_2" label="{!! __tr('Address Line 2') !!}"> 
                  <input type="text" class=" form-control lw-form-field" name="address_line_2" ng-model="profileEditCtrl.profileData.address_line_2" />
                </lw-form-field>
            </div>
            <!-- /Address 2 -->

            <!-- Country -->
            <div class="col">
                <lw-form-selectize-field field-for="country" label="<?= __tr( 'Country' ) ?>" class="lw-selectize">
                    <selectize config='profileEditCtrl.countrySelectConfig' class=" form-control lw-form-field" name="country" ng-model="profileEditCtrl.profileData.country" ng-required="true" options='profileEditCtrl.countries' placeholder="<?= __tr( 'Select Country' ) ?>" ></selectize>
                </lw-form-selectize-field>
            </div>
            <!-- /Country -->
        </div>
        <div class="form-group">

            <button type="submit" class="lw-btn btn btn-primary" title="<?=  __tr('Update')  ?>"><?=  __tr('Update')  ?> <span></span> </button>

            <a ui-sref="profile" title="<?= __tr('Back') ?>" class="btn btn-secondary mt-1"><?= __tr('Back') ?></a>
        </div>

    </form>




    <!-- image path and name -->
    <script type="text/_template" id="imageListItemTemplate">
        <div class="lw-selectize-item lw-selectize-item-selected">
            <span class="lw-selectize-item-thumb">
               <img src="<%= __tData.path %>"/> 
            </span> 
            <span class="lw-selectize-item-label"><%= __tData.name%></span>
        </div>
    </script>
    <!-- /image path and name -->

    <!-- image path and name -->
    <script type="text/_template" id="imageListOptionTemplate">
    
        <div class="lw-selectize-item">
            <span class="lw-selectize-item-thumb">
                <img src="<%= __tData.path %>" />
            </span> 
        <span class="lw-selectize-item-label"><%= __tData.name%></span></div>
    </script>
    <!-- /image path and name -->

</div>