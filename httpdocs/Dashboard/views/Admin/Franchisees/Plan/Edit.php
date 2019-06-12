<?php  
    $Plan = $mysql->select("select * from _tbl_franchisees_plans where PlanCode='".$_GET['Code']."'");
                          
   if (isset($_POST['BtnSavePlan'])) {
    $mysql->execute("update _tbl_franchisees_plans set PlanName='".$_POST['PlanName']."',
                                                 Duration='".$_POST['Duration']."',
                                                 Amount='".$_POST['Amount']."',
                                                 ProfileCommissionWithPercentage='".$_POST['ProfileCommissionWithPercentage']."',
                                                 ProfileCommissionWithRupees='".$_POST['ProfileCommissionWithRupees']."',
                                                 RefillCommissionWithPercentage='".$_POST['RefillCommissionWithPercentage']."',
                                                 RefillCommissionWithRupees='".$_POST['RefillCommissionWithRupees']."',
                                                 ProfileDownloadCommissionWithPercentage='".$_POST['ProfileDownloadCommissionWithPercentage']."',
                                                 ProfileDownloadCommissionWithRupees='".$_POST['ProfileDownloadCommissionWithRupees']."',
                                                 RenewalCommissionWithPercentage='".$_POST['RenewalCommissionWithPercentage']."',
                                                 RenewalCommissionWithRupees='".$_POST['RenewalCommissionWithRupees']."'
                                                 where  PlanCode='".$_GET['Code']."'");
                                                   
                                       
       unset($_POST);
       echo "Updated Successfully";       
    
    }
   
    $Plan = $mysql->select("select * from _tbl_franchisees_plans where PlanCode='".$_GET['Code']."'");
?>
    
<script>

$(document).ready(function () {
  $("#ProfileCommissionWithPercentage").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrProfileCommissionWithPercentage").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   }); 
   $("#Amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAmount").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   $("#Duration").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrDuration").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });                                                       
   
   $("#ProfileCommissionWithRupees").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrProfileCommissionWithRupees").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
    
   $("#RefillCommissionWithPercentage").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrRefillCommissionWithPercentage").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
      
   $("#RefillCommissionWithRupees").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrRefillCommissionWithRupees").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   $("#ProfileDownloadCommissionWithPercentage").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrProfileDownloadCommissionWithPercentage").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   $("#ProfileDownloadCommissionWithRupees").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrProfileDownloadCommissionWithRupees").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   $("#RenewalCommissionWithPercentage").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrRenewalCommissionWithPercentage").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   $("#RenewalCommissionWithRupees").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrRenewalCommissionWithRupees").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   
   $("#PlanCode").blur(function () {
    
        IsNonEmpty("PlanCode","ErrPlanCode","Please Enter Plan Code");
                        
   });
   $("#PlanName").blur(function () {
    
        IsNonEmpty("PlanName","ErrPlanName","Please Enter Plan Name");
                        
   });
   $("#Duration").blur(function () {
    
        IsNonEmpty("Duration","ErrDuration","Please Enter Duration");
                        
   });
   $("#Amount").blur(function () {
    
        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        
   });
   $("#ProfileCommissionWithPercentage").blur(function () {
    
        IsNonEmpty("ProfileCommissionWithPercentage","ErrProfileCommissionWithPercentage","Please Enter Profile Commission");
                        
   });
   $("#ProfileCommissionWithRupees").blur(function () {
    
        IsNonEmpty("ProfileCommissionWithRupees","ErrProfileCommissionWithRupees","Please Enter Profile Amount");
                        
   });
   $("#RefillCommissionWithPercentage").blur(function () {
    
        IsNonEmpty("RefillCommissionWithPercentage","ErrRefillCommissionWithPercentage","Please Enter Refill Commission");
                        
   });
   $("#RefillCommissionWithRupees").blur(function () {
    
        IsNonEmpty("RefillCommissionWithRupees","ErrRefillCommissionWithRupees","Please Enter Refill Amount");
                        
   });
   $("#ProfileDownloadCommissionWithPercentage").blur(function () {
    
        IsNonEmpty("ProfileDownloadCommissionWithPercentage","ErrProfileDownloadCommissionWithPercentage","Please Enter Profile Download Commission");
                        
   });
   $("#ProfileDownloadCommissionWithRupees").blur(function () {
    
        IsNonEmpty("ProfileDownloadCommissionWithRupees","ErrProfileDownloadCommissionWithRupees","Please Enter Profile Download Amount");
                        
   });
   $("#RenewalCommissionWithPercentage").blur(function () {
    
        IsNonEmpty("RenewalCommissionWithPercentage","ErrRenewalCommissionWithPercentage","Please Enter Profile Renewal Commision");
                        
   });
   $("#RenewalCommissionWithRupees").blur(function () {
    
        IsNonEmpty("RenewalCommissionWithRupees","ErrRenewalCommissionWithRupees","Please Enter Profile Renewal Amount");
                        
   });
   });

function SubmitNewPlan() {
                         $('#ErrPlanCode').html("");
                         $('#ErrPlanName').html("");
                         $('#ErrDuration').html("");
                         $('#ErrAmount').html("");
                         $('#ErrProfileCommissionWithPercentage').html("");
                         $('#ErrProfileCommissionWithRupees').html("");
                         $('#ErrRefillCommissionWithPercentage').html("");
                         $('#ErrRefillCommissionWithRupees').html("");
                         $('#ErrProfileDownloadCommissionWithPercentage').html("");
                         $('#ErrProfileDownloadCommissionWithRupees').html("");
                         $('#ErrRenewalCommissionWithPercentage').html("");
                         $('#ErrRenewalCommissionWithRupees').html("");
                         ErrorCount=0;
                         
                         
                        if (IsNonEmpty("PlanCode","ErrPlanCode","Please Enter Plan Code")) {
                            IsAlphaNumerics("PlanCode","ErrPlanCode","Please Enter Alpha Numeric characters only");    
                        }
                        if (IsNonEmpty("PlanName","ErrPlanName","Please Enter Plan Name")) {
                            IsAlphabet("PlanName","ErrPlanName","Please Enter Alpha Numeric characters only");    
                        }
                        
                        if (IsNonEmpty("Duration","ErrDuration","Please Enter Duration")) {
                            IsAlphaNumerics("Duration","ErrDuration","Please Enter Alpha Numeric characters only");    
                        }
                        
                       
                            IsNonEmpty("Amount","ErrAmount","Please Enter Amount");    
                       
                        
                        if (IsNonEmpty("ProfileCommissionWithPercentage","ErrProfileCommissionWithPercentage","Please Enter Profile Commission")) {
                            IsNumber("ProfileCommissionWithPercentage","ErrProfileCommissionWithPercentage","Please Enter the number between 0 to 100");
                        }
                        if (IsNonEmpty("ProfileCommissionWithRupees","ErrProfileCommissionWithRupees","Please Enter Profile Commission")) {
                            IsNumbers("ProfileCommissionWithRupees","ErrProfileCommissionWithRupees","Please Enter the number between 0 to 1000");
                        }
                        if (IsNonEmpty("RefillCommissionWithPercentage","ErrRefillCommissionWithPercentage","Please Enter Refill Commission")) {
                            IsNumber("RefillCommissionWithPercentage","ErrRefillCommissionWithPercentage","Please Enter the number between 0 to 100");
                        }
                        if (IsNonEmpty("RefillCommissionWithRupees","ErrRefillCommissionWithRupees","Please Enter Refill Commission")) {
                            IsNumbers("RefillCommissionWithRupees","ErrRefillCommissionWithRupees","Please Enter the number between 0 to 1000");
                        }
                        if (IsNonEmpty("ProfileDownloadCommissionWithPercentage","ErrProfileDownloadCommissionWithPercentage","Please Enter Profile Download")) {
                            IsNumber("ProfileDownloadCommissionWithPercentage","ErrProfileDownloadCommissionWithPercentage","Please Enter the number between 0 to 100");
                        }
                        if (IsNonEmpty("ProfileDownloadCommissionWithRupees","ErrProfileDownloadCommissionWithRupees","Please Enter Profile Download")) {
                            IsNumbers("ProfileDownloadCommissionWithRupees","ErrProfileDownloadCommissionWithRupees","Please Enter the number between 0 to 1000");
                        }
                        if (IsNonEmpty("RenewalCommissionWithPercentage","ErrRenewalCommissionWithPercentage","Please Enter Renewal Commission")) {
                            IsNumber("RenewalCommissionWithPercentage","ErrRenewalCommissionWithPercentage","Please Enter the number between 0 to 100");
                        }
                        if (IsNonEmpty("RenewalCommissionWithRupees","ErrRenewalCommissionWithRupees","Please Enter Renewal Commission")) {
                            IsNumbers("RenewalCommissionWithRupees","ErrRenewalCommissionWithRupees","Please Enter the number between 0 to 1000");
                        }
                        
                        if (parseInt($('#ProfileCommissionWithPercentage').val())>0 && parseInt($('#ProfileCommissionWithRupees').val())==0) {
                           
                        } else if (parseInt($('#ProfileCommissionWithPercentage').val())==0 && parseInt($('#ProfileCommissionWithRupees').val())>0) {
                             
                        } else {
                            $('#ErrProfileCommissionWithRupees').html("Either % or Rs Must be Zero");
                        }
                        
                        if (parseInt($('#RefillCommissionWithPercentage').val())>0 && parseInt($('#RefillCommissionWithRupees').val())==0) {
                           
                        } else if (parseInt($('#RefillCommissionWithPercentage').val())==0 && parseInt($('#RefillCommissionWithRupees').val())>0) {
                             
                        } else {
                            $('#ErrRefillCommissionWithRupees').html("Either % or Rs Must be Zero");
                        } 
                        
                        if (parseInt($('#ProfileDownloadCommissionWithPercentage').val())>0 && parseInt($('#ProfileDownloadCommissionWithRupees').val())==0) {
                           
                        } else if (parseInt($('#ProfileDownloadCommissionWithPercentage').val())==0 && parseInt($('#ProfileDownloadCommissionWithRupees').val())>0) {
                             
                        } else {
                            $('#ErrProfileDownloadCommissionWithRupees').html("Either % or Rs Must be Zero");
                        }
                        
                        if (parseInt($('#RenewalCommissionWithPercentage').val())>0 && parseInt($('#RenewalCommissionWithRupees').val())==0) {
                           
                        } else if (parseInt($('#RenewalCommissionWithPercentage').val())==0 && parseInt($('#RenewalCommissionWithRupees').val())>0) {
                             
                        } else {
                            $('#ErrRenewalCommissionWithRupees').html("Either % or Rs Must be Zero");
                        }
                        
                         if (ErrorCount==0) {
                            return true;
                        } else{                                                    
                            return false;
                        }
                 }
    
</script> 
<form method="post" action="" onsubmit="return SubmitNewPlan();">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Franchisees</h4>                                                                                          
                             <h4 class="card-title">Edit Plan</h4>                                                                                          
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                            <label for="FAQ Code" class="col-sm-3 col-form-label">Plan Code<span id="star">*</span></label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" maxlength="7" id="PlanCode" name="PlanCode" value="<?php echo (isset($_POST['PlanCode']) ? $_POST['PlanCode'] : $Plan[0]['PlanCode']);?>" placeholder="Plan Code">
                                                <span class="errorstring" id="ErrPlanCode"><?php echo isset($ErrPlanCode) ? $ErrPlanCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="PlanName" class="col-sm-3 col-form-label">Plan Name<span id="star">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="PlanName" name="PlanName" value="<?php echo (isset($_POST['PlanName']) ? $_POST['PlanName'] : $Plan[0]['PlanName']);?>" placeholder="Plan Name">
                                                <span class="errorstring" id="ErrPlanName"><?php echo isset($ErrPlanName) ? $ErrPlanName : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Profile Commission" class="col-sm-3 col-form-label">Duration<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <input type="text" class="form-control" id="Duration" name="Duration" value="<?php echo (isset($_POST['Duration']) ? $_POST['Duration'] : $Plan[0]['Duration']);?>" placeholder="Duration">
                                                <div class="input-group-addon">days</div>
                                                </div>
                                                <span class="errorstring" id="ErrDuration"><?php echo isset($ErrDuration) ? $ErrDuration : "";?></span>
                                            </div>
                                            <label for="Amount" class="col-sm-2 col-form-label">Amount<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">Rs</div>
                                                <input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo (isset($_POST['Amount']) ? $_POST['Amount'] : $Plan[0]['Amount']);?>" placeholder="Amount">
                                                </div>
                                                <span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount) ? $ErrAmount : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Profile Commission" class="col-sm-3 col-form-label">Profile Active Commission<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <input type="text" class="form-control" id="ProfileCommissionWithPercentage" name="ProfileCommissionWithPercentage" value="<?php echo (isset($_POST['ProfileCommissionWithPercentage']) ? $_POST['ProfileCommissionWithPercentage'] : $Plan[0]['ProfileCommissionWithPercentage']);?>" placeholder="Commission">
                                                <div class="input-group-addon">%</div>
                                                </div>
                                                <span class="errorstring" id="ErrProfileCommissionWithPercentage"><?php echo isset($ErrProfileCommissionWithPercentage) ? $ErrProfileCommissionWithPercentage : "";?></span>
                                            </div>
                                            <div class="col-sm-2" align="center">OR</div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">Rs</div>
                                                <input type="text" class="form-control" id="ProfileCommissionWithRupees" name="ProfileCommissionWithRupees" value="<?php echo (isset($_POST['ProfileCommissionWithRupees']) ? $_POST['ProfileCommissionWithRupees'] : $Plan[0]['ProfileCommissionWithRupees']);?>" placeholder="Amount">
                                                </div>
                                                <span class="errorstring" id="ErrProfileCommissionWithRupees"><?php echo isset($ErrProfileCommissionWithRupees) ? $ErrProfileCommissionWithRupees : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Refill Commission" class="col-sm-3 col-form-label">Wallet Refill Commission<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <input type="text" class="form-control" id="RefillCommissionWithPercentage" name="RefillCommissionWithPercentage" value="<?php echo (isset($_POST['RefillCommissionWithPercentage']) ? $_POST['RefillCommissionWithPercentage'] : $Plan[0]['RefillCommissionWithPercentage']);?>" placeholder="Commission">
                                                <div class="input-group-addon">%</div>
                                                </div>
                                                <span class="errorstring" id="ErrRefillCommissionWithPercentage"><?php echo isset($ErrRefillCommissionWithPercentage) ? $ErrRefillCommissionWithPercentage : "";?></span>
                                            </div>
                                            <div class="col-sm-2" align="center">OR</div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">Rs</div>
                                                <input type="text" class="form-control" id="RefillCommissionWithRupees" name="RefillCommissionWithRupees" value="<?php echo (isset($_POST['RefillCommissionWithRupees']) ? $_POST['RefillCommissionWithRupees'] : $Plan[0]['RefillCommissionWithRupees']);?>" placeholder="Amount">
                                                </div>
                                                <span class="errorstring" id="ErrRefillCommissionWithRupees"><?php echo isset($ErrRefillCommissionWithRupees) ? $ErrRefillCommissionWithRupees : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ProfileDowncode" class="col-sm-3 col-form-label">Profile download Commission<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <input type="text" class="form-control" id="ProfileDownloadCommissionWithPercentage" name="ProfileDownloadCommissionWithPercentage" value="<?php echo (isset($_POST['ProfileDownloadCommissionWithPercentage']) ? $_POST['ProfileDownloadCommissionWithPercentage'] : $Plan[0]['ProfileDownloadCommissionWithPercentage']);?>" placeholder="Commission">
                                                <div class="input-group-addon">%</div>
                                                </div>
                                                <span class="errorstring" id="ErrProfileDownloadCommissionWithPercentage"><?php echo isset($ErrProfileDownloadCommissionWithPercentage) ? $ErrProfileDownloadCommissionWithPercentage : "";?></span>
                                            </div>
                                            <div class="col-sm-2" align="center">OR</div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">Rs</div>
                                                <input type="text" class="form-control" id="ProfileDownloadCommissionWithRupees" name="ProfileDownloadCommissionWithRupees" value="<?php echo (isset($_POST['ProfileDownloadCommissionWithRupees']) ? $_POST['ProfileDownloadCommissionWithRupees'] : $Plan[0]['ProfileDownloadCommissionWithRupees']);?>" placeholder="Amount">
                                                </div>
                                                <span class="errorstring" id="ErrProfileDownloadCommissionWithRupees"><?php echo isset($ErrProfileDownloadCommissionWithRupees) ? $ErrProfileDownloadCommissionWithRupees : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Refill Commission" class="col-sm-3 col-form-label">Profile Renewal Commission<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">                         
                                                <input type="text" class="form-control" id="RenewalCommissionWithPercentage" name="RenewalCommissionWithPercentage" value="<?php echo (isset($_POST['RenewalCommissionWithPercentage']) ? $_POST['RenewalCommissionWithPercentage'] : $Plan[0]['RenewalCommissionWithPercentage']);?>" placeholder="Commission">
                                                <div class="input-group-addon">%</div>
                                                </div>
                                                <span class="errorstring" id="ErrRenewalCommissionWithPercentage"><?php echo isset($ErrRenewalCommissionWithPercentage) ? $ErrRenewalCommissionWithPercentage : "";?></span>
                                            </div>
                                            <div class="col-sm-2" align="center">OR</div>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                    <div class="input-group-addon">Rs</div>
                                                    <input type="text" class="form-control" id="RenewalCommissionWithRupees" name="RenewalCommissionWithRupees" value="<?php echo (isset($_POST['RenewalCommissionWithRupees']) ? $_POST['RenewalCommissionWithRupees'] : $Plan[0]['RenewalCommissionWithRupees']);?>" placeholder="Amount">
                                                    </div>
                                                   <span class="errorstring" id="ErrRenewalCommissionWithRupees"><?php echo isset($ErrRenewalCommissionWithRupees) ? $ErrRenewalCommissionWithRupees : "";?></span>
                                                </div>
                                        </div>
                                        <button type="submit" name="BtnSavePlan" class="btn btn-primary mr-2">Create Plan</button>
                                        <a href="../ManagePlan" style="text-decoration: underline;"><small>List of Plans</small> </a>
                                 </form>
                       </div>
                  </div>
             </div>
</form>