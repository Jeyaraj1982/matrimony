<?php

if (isset($_POST['savparam'])) {
                         print_r($_POST);
        $response = $webservice->getData("Admin","UpdateAllowDuplicateDetails",$_POST);
        if ($response['status']=="success") {
            echo $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $response = $webservice->getData("Admin","GetAllowDuplicateDetails");
     
?>

<form method="post" action="" >      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title" style="margin-bottom:5px">App Param</h4><br>
            <div class="form-group row" style="margin-bottom:0px;">
                <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="IsAllowDuplicateMobile" name="IsAllowDuplicateMobile" <?php echo ($response['data']['Mobile']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Is Allow Duplicate Mobile Number</label>
            </div>
            <div class="form-group row" style="margin-bottom:0px;">
                <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="IsAllowDuplicateEmail" name="IsAllowDuplicateEmail" <?php echo ($response['data']['Email']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Is Allow Duplicate Emai ID</label>
            </div>
            <div class="form-group row" style="margin-bottom:0px;">
                <div class="col-sm-1" style="margin-right: -23px;"><input type="checkbox"  id="IsAllowDuplicateWhatsapp" name="IsAllowDuplicateWhatsapp" <?php echo ($response['data']['Whatsapp']['ParamA']==1) ? ' checked="checked" ' :'';?> style="margin-top: 0px;"></div>
                <label for="Sms" class="col-sm-11" style="margin-top: 2px;padding-left: 3px;color:#444">Is Allow Duplicate Whatsapp Number</label>
            </div>
            <br><div class="form-group row">
                <div class="col-sm-3"><button type="submit" name="savparam" id="savparam" class="btn btn-primary" style="font-family:roboto">Update</button></div>
            </div>
        </div>
    </form>            
        
