<?php 
if (isset($_POST['savparam'])) {
        $response = $webservice->getData("Admin","UpdateGeneralSettings",$_POST);
        if ($response['status']=="success") {
            echo $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
$response = $webservice->getData("Admin","GetGeneralSettingsDetails");
?>

 <form method="post">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Settings</h4>
                  <div class="table-responsive">
                    <table class="table table-borderless" style="width:400px;">
                      <thead>
                        <tr>
                          <th style="width:100px"></th>
                          <th style="width:10px">SMS</th>
                          <th style="width:10px">Email</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>First time profile view</td>
                          <td><input type="checkbox"  id="FirstTimeProfileViewSMS" name="FirstTimeProfileViewSMS" <?php echo ($response['data']['FirstTimeProfileView']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="FirstTimeProfileViewEmail" id="FirstTimeProfileViewEmail" <?php echo ($response['data']['FirstTimeProfileView']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr> 
                        <tr>
                          <td>First time profile favorite</td>
                          <td><input type="checkbox"  id="FirstTimeProfileFavoriteSMS" name="FirstTimeProfileFavoriteSMS" <?php echo ($response['data']['FirstTimeProfileFavorite']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="FirstTimeProfileFavoriteEmail" id="FirstTimeProfileFavoriteEmail" <?php echo ($response['data']['FirstTimeProfileFavorite']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>First time profile unfavorite</td>
                          <td><input type="checkbox"  id="FirstTimeProfileUnFavoriteSMS" name="FirstTimeProfileUnFavoriteSMS" <?php echo ($response['data']['FirstTimeProfileUnFavorite']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="FirstTimeProfileUnFavoriteEmail" id="FirstTimeProfileUnFavoriteEmail" <?php echo ($response['data']['FirstTimeProfileUnFavorite']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Every time profile view</td>
                          <td><input type="checkbox"  id="EveryTimeProfileViewSMS" name="EveryTimeProfileViewSMS" <?php echo ($response['data']['EveryTimeProfileView']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="EveryTimeProfileViewEmail" id="EveryTimeProfileViewEmail" <?php echo ($response['data']['EveryTimeProfileView']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                         <tr>
                          <td>Every time profile favorite</td>
                          <td><input type="checkbox"  id="EveryTimeProfileFavoriteSMS" name="EveryTimeProfileFavoriteSMS" <?php echo ($response['data']['EveryTimeProfileFavorite']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="EveryTimeProfileFavoriteEmail" id="EveryTimeProfileFavoriteEmail" <?php echo ($response['data']['EveryTimeProfileFavorite']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Every time profile unfavorite</td>
                          <td><input type="checkbox"  id="EveryTimeProfileUnFavoriteSMS" name="EveryTimeProfileUnFavoriteSMS" <?php echo ($response['data']['EveryTimeProfileUnFavorite']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="EveryTimeProfileUnFavoriteEmail" id="EveryTimeProfileUnFavoriteEmail" <?php echo ($response['data']['EveryTimeProfileUnFavorite']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Change password notification</td>
                          <td><input type="checkbox"  id="ChangePasswordNotificationSMS" name="ChangePasswordNotificationSMS" <?php echo ($response['data']['ChangePasswordNotification']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="ChangePasswordNotificationEmail" id="ChangePasswordNotificationEmail" <?php echo ($response['data']['ChangePasswordNotification']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Email Verification Status</td>
                          <td><input type="checkbox"  id="EmailVerificationStatusSMS" name="EmailVerificationStatusSMS" <?php echo ($response['data']['EmailVerificationStatus']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="EmailVerificationStatusEmail" id="EmailVerificationStatusEmail" <?php echo ($response['data']['EmailVerificationStatus']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                         <tr>
                          <td>Mobile Verification Status</td>
                          <td><input type="checkbox"  id="MobileVerificationStatusSMS" name="MobileVerificationStatusSMS" <?php echo ($response['data']['MobileVerificationStatus']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="MobileVerificationStatusEmail" id="MobileVerificationStatusEmail" <?php echo ($response['data']['MobileVerificationStatus']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Invalid Login Notification</td>
                          <td><input type="checkbox"  id="InvalidLoginNotificationSMS" name="InvalidLoginNotificationSMS" <?php echo ($response['data']['InvalidLoginNotification']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="InvalidLoginNotificationEmail" id="InvalidLoginNotificationEmail" <?php echo ($response['data']['InvalidLoginNotification']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Approve KYC</td>
                          <td><input type="checkbox"  id="ApproveKYCSMS" name="ApproveKYCSMS" <?php echo ($response['data']['ApproveKYC']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="ApproveKYCEmail" id="ApproveKYCEmail" <?php echo ($response['data']['ApproveKYC']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Reject KYC</td>
                          <td><input type="checkbox"  id="RejectKYCSMS" name="RejectKYCSMS" <?php echo ($response['data']['RejectKYC']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="RejectKYCEmail" id="RejectKYCEmail" <?php echo ($response['data']['RejectKYC']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Approve Profile</td>
                          <td><input type="checkbox"  id="ApproveProfileSMS" name="ApproveProfileSMS" <?php echo ($response['data']['ApproveProfile']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="ApproveProfileEmail" id="ApproveProfileEmail" <?php echo ($response['data']['ApproveProfile']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Reject Profile</td>
                          <td><input type="checkbox"  id="RejectProfileSMS" name="RejectProfileSMS" <?php echo ($response['data']['RejectProfile']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="RejectProfileEmail" id="RejectProfileEmail" <?php echo ($response['data']['RejectProfile']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                        <tr>
                          <td>Remodification Request</td>
                          <td><input type="checkbox"  id="RemodificationRequestSMS" name="RemodificationRequestSMS" <?php echo ($response['data']['RemodificationRequest']['SMS']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></td>
                          <td><input type="checkbox" name="RemodificationRequestEmail" id="RemodificationRequestEmail" <?php echo ($response['data']['RemodificationRequest']['Email']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;" ></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-1"><button type="submit" name="savparam" class="btn btn-primary mr-2">Save</button></div>
                    </div>
                </div>
              </div>
            </div>
</form>