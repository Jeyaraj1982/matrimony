<?php
    if (isset($_POST['BtnStateName'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STATNAMES' and CodeValue='".trim($_POST['StateName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrStateName="State Name Alreay Exists";    
             echo $ErrStateName;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STATNAMES' and SoftCode='".trim($_POST['StateCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrStateCode="State Code Alreay Exists";    
             echo $ErrStateCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
            $StateNamesID = $mysql->insert("_tbl_master_codemaster",array("HardCode"     => "STATNAMES",
                                                                          "SoftCode"  => trim($_POST['StateCode']),
                                                                          "CodeValue" => trim($_POST['StateName']),
                                                                          "ParamA"    => trim($_POST['CountryName'])));
            if ($StateNamesID>0) {
                echo "Successfully Added";
                unset($_POST);
            } else {
                echo "Error occured. Couldn't save State  Name";
            }
        }
    }
?>
<script>
$(document).ready(function () {
   $("#StateCode").blur(function () {  
    IsNonEmpty("StateCode","ErrStateCode","Please Enter Valid State Code");
   });
   $("#StateName").blur(function () {
        IsNonEmpty("StateName","ErrStateName","Please Enter Valid State Name");
   });
});


 function SubmitNewStateName() {
                         $('#ErrStateCode').html("");
                         $('#ErrStateName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("StateCode","ErrStateCode","Please Enter Valid State Code")){
                        IsAlphaNumeric("StateCode","ErrStateCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("StateName","ErrStateName","Please Enter Valid State Name")){
                        IsAlphabet("StateName","ErrStateName","Please Enter Alphabet Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<form method="post" action="" onsubmit="return SubmitNewStateName();">            
<div class="col-12 grid-margin">
    <div class="card">
     <div class="card-body">
     <h4 class="card-title">Masters</h4>
     <h4 class="card-title">Create State Name</h4>
     <form class="form-sample">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">State Name Code<span id="star">*</span></label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="StateCode" maxlength="6" name="StateCode" value="<?php echo (isset($_POST['StateCode']) ? $_POST['StateCode'] : GetNextNumber('STATNAMES'));?>">
                  <span class="errorstring" id="ErrStateCode"><?php echo isset($ErrStateCode)? $ErrStateCode : "";?></span>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">State Name<span id="star">*</span></label>
              <div class="col-sm-9">
               <input type="text" class="form-control" id="StateName" maxlength="100" name="StateName" value="<?php echo (isset($_POST['StateName']) ? $_POST['StateName'] : "");?>">
               <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
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
                   <option value="<?php echo $CountryName['CodeValue'];?>"><?php echo $CountryName['CodeValue'];?></option>
                    <?php } ?>
              </select>
              <span class="errorstring" id="ErrCountryName"><?php echo isset($ErrCountryName)? $ErrCountryName : "";?></span>
              </div>
            </div>
          </div>
        </div>
         <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnStateName" id="BtnStateName"  class="btn btn-primary mr-2">Create State Name</button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageState"><small>List of State Names</small> </a>  </div>
                       </div>
             </div>
                 </div>
              </div>
              
</form>