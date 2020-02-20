<?php 
$page="WebsiteSettings";
include_once("views/Admin/Settings/ApplicationSettings/settings_header.php");
?>
<?php

if (isset($_POST['savparam'])) {
        $response = $webservice->getData("Admin","UpdateWebConfiguration",$_POST);
        if ($response['status']=="success") {
            echo $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    //$response = $webservice->getData("Admin","GetAllowDuplicateDetails");    
     
?>
<div class="col-sm-10 rightwidget" style="padding: 0px;">
<form method="post" action="" >      
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                <div class="col-sm-6"><h4 class="card-title">Website Settings</h4></div>
                <div class="col-sm-6" style="text-align: right;"><a href="<?php echo GetUrl("Settings/ApplicationSettings/AddWebsiteSettings");?>" class="btn btn-primary">Add</a></div>
            </div>
                   <!-- <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="IsAllowDuplicateMobile" name="IsAllowDuplicateMobile" <?php echo ($response['data']['Mobile']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                        <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Is Allow Duplicate Mobile Number</label>
                    </div>
                    <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="IsAllowDuplicateEmail" name="IsAllowDuplicateEmail" <?php echo ($response['data']['Email']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                        <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Is Allow Duplicate Email ID</label>
                    </div>
                    <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="IsAllowDuplicateWhatsapp" name="IsAllowDuplicateWhatsapp" <?php echo ($response['data']['Whatsapp']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                        <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Is Allow Duplicate Whatsapp Number</label>
                    </div>
                    <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="AllowToPasswordCaseSensitive" name="AllowToPasswordCaseSensitive" <?php echo ($response['data']['PasswordCaseSensitive']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                        <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Is Allow To Password Case Sensitive</label>
                    </div>
                    <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="ChangePasswordNotificationSendToMember" name="ChangePasswordNotificationSendToMember" <?php echo ($response['data']['ChangePasswordNotification']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                        <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Change Password Notification Send To Member</label>
                    </div>
                    <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="DisplayLastLoginInDashboard" name="DisplayLastLoginInDashboard" <?php echo ($response['data']['DisplayLastLogin']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                        <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Display Last Login In Dashboard</label>
                    </div>
                    <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-1" style="margin-right: -23px;"></div>
                       <label for="MaximumAllowSizeProfileImages" class="col-sm-3" style="margin-top: 2px;padding-left: 3px;color:#444;">Maximum Allow Size Profile Images</label>
                       <div class="col-sm-2"><input type="text" name="MaximumAllowSizeProfileImages" id="MaximumAllowSizeProfileImages" class="form-control" value="<?php echo (isset($_POST['MaximumAllowSizeProfileImages']) ? $_POST['MaximumAllowSizeProfileImages'] : $response['data']['MaximumSizeProfileImage']['ParamA']);?>"></div>
                    </div>
                    <br>
                    <div class="form-group row" style="margin-bottom:0px;">
                        <div class="col-sm-1" style="margin-right: -23px;"></div>
                       <label for="InvalidLoginNotification" class="col-sm-3" style="margin-top: 2px;padding-left: 3px;color:#444;">Invalid Login Notification on</label>
                       <div class="col-sm-2"><input type="text" name="InvalidLoginNotification" id="InvalidLoginNotification" class="form-control" value="<?php echo (isset($_POST['InvalidLoginNotification']) ? $_POST['InvalidLoginNotification'] : $response['data']['InvalidLoginNotification']['ParamA']);?>"></div>
                    </div>
                    <br><div class="form-group row">
                        <div class="col-sm-3"><button type="submit" name="savparam" id="savparam" class="btn btn-primary" style="font-family:roboto">Update</button></div>
                    </div> -->
                    <div class="table-responsive">   
                <table id="myTable" class="table table-striped">
                  <thead>  
                    <tr> 
                        <th>Parameter</th>                          
                        <th style="text-align: right;">Value</th>                          
                    </tr>  
                </thead>
                <tbody> 
                    <?php $response = $webservice->getData("Admin","GetWebConfigurationSettingsList"); ?>  
                    <?php foreach($response['data'] as $Config) { 
                        if(strlen(trim($Config['CodeValue']))>0) { 
                        ?>
                    
                        <tr>
                            <td style="padding: 1px;font-size:12px"><?php echo $Config['CodeValue'];?>
                            </td>    
                            <td style="text-align:right;padding: 1px">
                                <?php if($Config['ParamB']=="boolean") {?>
                                    <select style="width:150px" name="app_<?php echo $Config['CodeValue'];?>">
                                        <option value="1" <?php echo $Config['ParamA']==1 ? " selected='selected' ":"";?>>Yes</option>
                                        <option value="0" <?php echo $Config['ParamA']==0 ? " selected='selected' ":"";?>>No</option>
                                    </select>
                                <?php } ?>
                                 <?php if($Config['ParamB']=="integer") {?>
                                    <input tyep="text" name="app_<?php echo $Config['CodeValue'];?>" style="width:150px;text-align:right;border:1px solid #888;" value="<?php echo $Config['ParamA'];?>">
                                <?php } ?>
                                <?php if($Config['ParamB']=="string") {?>
                                    <?php if(sizeof($Config['ParamC'])>0) {  ?>
                                        <select  name="app_<?php echo $Config['CodeValue'];?>" style="width: 150px;">
                                            <?php foreach($Config['ParamC'] as $c) {?>
                                                <option value="<?php echo $c['SoftCode'];?>" <?php echo $Config['ParamD']==$c['SoftCode'] ? " selected='selected' ":"";?>><?php echo $c['CodeValue'];?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                    <input tyep="text" name="app_<?php echo $Config['CodeValue'];?>" style="width:150px;border:1px solid #888;" value="<?php echo $Config['ParamA'];?>">
                                    <?php } ?>
                                <?php } ?>
                            </td>    
                        </tr>                                              
                    <?php } }?>            
                  </tbody>                        
                 </table>
              </div> 
              <div class="form-group row">
                <div class="col-sm-12" style="text-align: right;">
                    <button type="submit" name="savparam" id="savparam" class="btn btn-primary" style="font-family:roboto">Update</button>
                </div>
              </div>
                </div>
              </div>
            </div>
        </form>
</div>

<?php include_once("views/Admin/Settings/ApplicationSettings/settings_footer.php");?>                    
          
