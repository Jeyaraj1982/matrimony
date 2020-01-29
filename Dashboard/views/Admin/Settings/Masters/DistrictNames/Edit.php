<?php 
$page="ManageDistrict";           
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
<script>
$(document).ready(function () {
    $("#DistrictCode").blur(function () {
    
        IsNonEmpty("DistrictCode","ErrDistrictCode","Please Enter Valid District Code");
                        
   });
   $("#DistrictName").blur(function () {
    
        IsNonEmpty("DistrictName","ErrDistrictName","Please Enter Valid District Name");
                        
   });
});
   
 function SubmitNewDistrictName() {
                         $('#ErrDistrictCode').html("");
                         $('#ErrDistrictName').html("");
                         $('#ErrCountryName').html("");
                         $('#ErrStateName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("DistrictCode","ErrDistrictCode","Please Enter Valid District Code")){
                        IsAlphaNumeric("DistrictCode","ErrDistrictCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("DistrictName","ErrDistrictName","Please Enter Valid District Name")){
                        IsAlphabet("DistrictName","ErrDistrictName","Please Enter Alphabet Charactors only");
                        }
                        IsNonEmpty("CountryName","ErrCountryName","Please Enter Valid Country Name");
                        IsNonEmpty("StateName","ErrStateName","Please Enter Valid State Name");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php   
    if (isset($_POST['BtnUpdateDistrictName'])) {
        
        $response = $webservice->getData("Admin","EditDistrictName",$_POST); 
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");            
    $DistrictName = $response['data']['ViewInfo'];
    $response     = $webservice->getData("Admin","GetMastersManageDetails");
    $CountryNames = $response['data']['CountryName'];
    $StateNames   = $response['data']['StateName'];
?>
<form method="post" action="" onsubmit="return SubmitNewCountryName();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit District Name</h4>  
                      <div class="form-group row">
                        <label for="DistrictCode" class="col-sm-3 col-form-label">District Code<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="DistrictCode" name="DistrictCode" value="<?php echo $DistrictName['SoftCode'];?>" placeholder="District Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="DistrictName" class="col-sm-3 col-form-label">District Name<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="DistrictName" maxlength="100" name="DistrictName" value="<?php echo (isset($_POST['DistrictName']) ? $_POST['DistrictName'] : $DistrictName['CodeValue']);?>" placeholder="District Name">
                            <span class="errorstring" id="ErrDistrictName"><?php echo isset($ErrDistrictName)? $ErrDistrictName : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="StateName" class="col-sm-3 col-form-label">State Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="StateName" name="StateName">
                                <?php foreach($StateNames as $StateName) { ?>
                                    <option value="<?php echo $StateName['CodeValue'];?>" <?php echo (isset($_POST[ 'StateName'])) ? (($_POST[ 'StateName']==$StateName[ 'CodeValue']) ? " selected='selected' " : "") : (($DistrictName[ 'StateName']==$StateName[ 'CodeValue']) ? " selected='selected' " : "");?> >
                                        <?php echo $StateName['CodeValue'];?>
                                    </option>
                                    <?php } ?>
                            </select>
                            <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="CountryName" class="col-sm-3 col-form-label">Country Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="CountryName" name="CountryName">
                                <?php foreach($CountryNames as $CountryName) { ?>
                                    <option value="<?php echo $CountryName['CodeValue'];?>" <?php echo (isset($_POST[ 'CountryName'])) ? (($_POST[ 'CountryName']==$CountryName[ 'CodeValue']) ? " selected='selected' " : "") : (($DistrictName[ 'CountryName']==$CountryName[ 'CodeValue']) ? " selected='selected' " : "");?>>
                                        <?php echo $CountryName['CodeValue'];?>
                                    </option>
                                    <?php } ?>
                            </select>
                            <span class="errorstring" id="ErrCountryName"><?php echo isset($ErrCountryName)? $ErrCountryName : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                        <div class="col-sm-9">
                            <select name="IsActive" class="form-control" style="width:80px">
                                <option value="1" <?php echo ($DistrictName[ 'IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                <option value="0" <?php echo ($DistrictName[ 'IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <button type="submit" name="BtnUpdateDistrictName" class="btn btn-primary mr-2"><small>Update District Name</small></button>
                        </div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageDistrict"><small>List of District Names</small></a></div>
                    </div>
                    </div>
                  </div>
                </div>
</form>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    