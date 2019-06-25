<?php
    if (isset($_POST['BtnSaveDistrictName'])) {
                
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DISTNAMES' and CodeValue='".trim($_POST['DistrictName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrDistrictName="District Name Alreay Exists";    
             echo $ErrDistrictName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DISTNAMES' and SoftCode='".trim($_POST['DistrictCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrDistrictCode="District Code Alreay Exists";    
             echo $ErrDistrictCode;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DISTNAMES' and SoftCode='".trim($_POST['StateName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrStateName="State Name Alreay Exists";    
             echo $ErrStateName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DISTNAMES' and SoftCode='".trim($_POST['CountryName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrCountryName="Country Name Alreay Exists";    
             echo $ErrCountryName;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $DistrictID = $mysql->insert("_tbl_master_codemaster",array("HardCode"    => "DISTNAMES",
                                                                    "SoftCode"    => trim($_POST['DistrictCode']),
                                                                    "CodeValue"   => trim($_POST['DistrictName']),
                                                                    "ParamA"      => trim($_POST['StateName']),
                                                                    "ParamB"      => trim($_POST['CountryName'])));
        if ($DistrictID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save District Name";
        }
    
    }
    }
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
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Masters</h4>
                  <h4 class="card-title">Create District Name</h4>
                  <form class="form-sample">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">District Name Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="DistrictCode" name="DistrictCode"  maxlength="6" value="<?php echo (isset($_POST['DistrictCode']) ? $_POST['DistrictCode'] : GetNextNumber('DISTNAMES'));?>">
                            <span class="errorstring" id="ErrDistrictCode"><?php echo isset($ErrDistrictCode)? $ErrDistrictCode : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">District Name<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="DistrictName" name="DistrictName"  maxlength="100" value="<?php echo (isset($_POST['DistrictName']) ? $_POST['DistrictName'] : "");?>">
                            <span class="errorstring" id="ErrDistrictName"><?php echo isset($ErrDistrictName)? $ErrDistrictName : "";?></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country Name</label>
                          <div class="col-sm-9">
                          <?php $CountryNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES'"); ?>
                           <select class="form-control" id="CountryName"  name="CountryName" >
                         <?php foreach($CountryNames as $CountryName) { ?>
                         <option value="<?php echo $CountryName['CodeValue'];?>">
                         <?php echo $CountryName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          <span class="errorstring" id="ErrCountryName"><?php echo isset($ErrCountryName)? $ErrCountryName : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State Name</label>
                          <div class="col-sm-9">
                          <?php $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES'"); ?>
                          <select class="form-control" id="StateName"  name="StateName" >
                         <?php foreach($StateNames as $StateName) { ?>
                         <option value="<?php echo $StateName['CodeValue'];?>">
                         <?php echo $StateName['CodeValue'];?></option>
                          <?php } ?>
                          </select>
                          <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnSaveDistrictName" id="BtnSaveDistrictName"  class="btn btn-primary mr-2">Save District Name</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageDistrict"><small>List of District Names</small> </a>  </div>
                       </div>
                   </div>
                 </div>
              </div>
              
</form>   
         
