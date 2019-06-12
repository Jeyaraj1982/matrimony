<?php
    if (isset($_POST['BtnUpdateDistrictName'])) {
         
        $duplicateDistrictName = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['DistrictName']."' and  HardCode='DISTNAMES' and SoftCode<>'".$_GET['Code']."'");
        
        if (sizeof($duplicateDistrictName)==0) { 
        $DistrictNamesID = $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['DistrictName']."',ParamA='".$_POST['StateName']."',IsActive='".$_POST['IsActive']."' where HardCode='DISTNAMES' and SoftCode= '".$_GET['Code']."'");
        echo "Successfully Updated";
        } else {
            $ErrDistrictName = "District Name already exists";
            echo "$ErrDistrictName ";

        }
    }
    $DistrictName = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
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

<form method="post" action="" onsubmit="return SubmitNewDistrictName();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit District Name</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="DistrictCode" class="col-sm-3 col-form-label">District Code<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" maxlength="10" class="form-control" id="DistrictCode" name="DistrictCode" value="<?php echo $DistrictName[0]['SoftCode'];?>" placeholder="District Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="DistrictName" class="col-sm-3 col-form-label">District Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="DistrictName" maxlength="100" name="DistrictName" value="<?php echo (isset($_POST['DistrictName']) ? $_POST['DistrictName'] : $DistrictName[0]['CodeValue']);?>" placeholder="District Name">
                            <span class="errorstring" id="ErrDistrictName"><?php echo isset($ErrDistrictName)? $ErrDistrictName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="StateName" class="col-sm-3 col-form-label">State Name</label>
                          <div class="col-sm-9">
                            <?php $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES'"); ?>
                           <select class="form-control" id="StateName"  name="StateName" >
                         <?php foreach($StateNames as $StateName) { ?>
                         <option value="<?php echo $StateName['CodeValue'];?>" <?php echo ($StateName['StateName']==$StateName[0]['ParamA']) ? " selected='selected'" :""; ?>><?php echo $StateName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                            <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="CountryName" class="col-sm-3 col-form-label">Country Name</label>
                          <div class="col-sm-9">
                            <?php $CountryNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES'"); ?>
                          <select class="form-control" id="CountryName"  name="CountryName" >
                          <?php foreach($CountryNames as $CountryName) { ?>                                         
                         <option value="<?php echo $CountryName['CodeValue'];?>" <?php echo ($CountryName['ParamB']==$CountryName[0]['CountryName']) ? " selected='selected'" :""; ?>><?php echo $CountryName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                            <span class="errorstring" id="ErrCountryName"><?php echo isset($ErrCountryName)? $ErrCountryName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($DistrictName[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($DistrictName[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateDistrictName" class="btn btn-primary mr-2"><small>Update District Name</small></button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageDistrict"><small>List of District Names</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>