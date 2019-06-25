 <?php   
    if (isset($_POST['BtnSavePlan'])) {
        
        $response = $webservice->EditFranchiseePlan($_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }

    $response = $webservice->GetFranchiseePlanInfo();
    $Plan     = $response['data'];
?>   
<script>

$(document).ready(function () {
  $("#ProfileActiveCommission").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrProfileActiveCommission").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
  $("#ProfileRenewalCommission").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrProfileRenewalCommission").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   
  $("#WalletRefillCommission").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrWalletRefillCommission").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   }); 
   $("#ProfiledownloadCommission").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrProfiledownloadCommission").html("Digits Only").show().fadeIn("fast");
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
   $("#ProfileActiveCommission").blur(function () {
    
        IsNonEmpty("ProfileActiveCommission","ErrProfileActiveCommission","Please Enter Profile Commission");
                        
   });
   $("#ProfileRenewalCommission").blur(function () {
    
        IsNonEmpty("ProfileRenewalCommission","ErrProfileRenewalCommission","Please Enter Profile Renewal Commission");
                        
   });
   $("#WalletRefillCommission").blur(function () {
    
        IsNonEmpty("WalletRefillCommission","ErrWalletRefillCommission","Please Enter Wallet Refill Commission");
                        
   });
   $("#ProfiledownloadCommission").blur(function () {
    
        IsNonEmpty("ProfiledownloadCommission","ErrProfiledownloadCommission","Please Enter Profile download Commission");
                        
   });
   
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
   });

function SubmitNewPlan() {
                         $('#ErrPlanCode').html("");
                         $('#ErrPlanName').html("");
                         $('#ErrDuration').html("");
                         $('#ErrAmount').html("");
                         $('#ErrProfileActiveCommission').html("");
                         $('#ErrProfileRenewalCommission').html("");
                         $('#ErrWalletRefillCommission').html("");
                         $('#ErrProfiledownloadCommission').html("");
                         $('#ErrRemarks').html("");
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
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");    
                        
                        if (IsNonEmpty("ProfileActiveCommission","ErrProfileActiveCommission","Please Enter Profile Commission")) {
                            if ($('#Amount').val()==0) {
                                $("#ErrProfileActiveCommission").html("You must enter amount:") ;}
                                if ($('#Amount').val()>0) {
                                if ($('#ProfileActiveCommissionType').val()=="Rs") {
                                    if (!( parseInt($('#ProfileActiveCommission').val())>=0 && parseInt($('#ProfileActiveCommission').val())<=parseInt($('#Amount').val())))    {
                                       $("#ErrProfileActiveCommission").html("Please enter less than amount") ;
                                    }
                                }
                               if ($('#ProfileActiveCommissionType').val()=="Percentage") {
                                    if (!( parseInt($('#ProfileActiveCommission').val())>=0 && parseInt($('#ProfileActiveCommission').val())<=100))    {
                                       $("#ErrProfileActiveCommission").html("Please enter below 100") ;
                                    }
                                } 
                            } else {
                            }
                        }
                        if (IsNonEmpty("ProfileRenewalCommission","ErrProfileRenewalCommission","Please Enter Renewal Commission")) {
                             if ($('#Amount').val()==0) {
                                $("#ErrProfileRenewalCommission").html("You must enter amount") ;}
                                if ($('#Amount').val()>0) {
                                if ($('#ProfileRenewalCommissionType').val()=="Rs") {
                                    if (!( parseInt($('#ProfileRenewalCommission').val())>=0 && parseInt($('#ProfileRenewalCommission').val())<=parseInt($('#Amount').val())))    {
                                       $("#ErrProfileRenewalCommission").html("Please enter less than amount:") ;
                                    }
                                }
                               if ($('#ProfileRenewalCommissionType').val()=="Percentage") {
                                    if (!( parseInt($('#ProfileRenewalCommission').val())>=0 && parseInt($('#ProfileRenewalCommission').val())<=100))    {
                                       $("#ErrProfileRenewalCommission").html("Please enter below 100") ;
                                    }
                                } 
                            } else {
                            }
                        }
                        if (IsNonEmpty("WalletRefillCommission","ErrWalletRefillCommission","Please Enter Refill Commission")) {
                            if ($('#Amount').val()==0) {
                                $("#ErrWalletRefillCommission").html("You must enter amount") ;}
                                if ($('#Amount').val()>0) {
                                if ($('#WalletRefillCommissionType').val()=="Rs") {
                                    if (!( parseInt($('#WalletRefillCommission').val())>=0 && parseInt($('#WalletRefillCommission').val())<=parseInt($('#Amount').val())))    {
                                       $("#ErrWalletRefillCommission").html("Please enter less than amount:") ;
                                    }
                                }
                               if ($('#WalletRefillCommissionType').val()=="Percentage") {
                                    if (!( parseInt($('#WalletRefillCommission').val())>=0 && parseInt($('#WalletRefillCommission').val())<=100))    {
                                       $("#ErrWalletRefillCommission").html("Please enter below 100") ;
                                    }
                                } 
                            } else {
                            }
                        }
                        if (IsNonEmpty("ProfiledownloadCommission","ErrProfiledownloadCommission","Please Enter Profile Download")) {
                            if ($('#Amount').val()==0) {
                                $("#ErrProfiledownloadCommission").html("You must enter amount") ;}
                                if ($('#Amount').val()>0) {
                                if ($('#ProfiledownloadCommissionType').val()=="Rs") {
                                    if (!( parseInt($('#ProfiledownloadCommission').val())>=0 && parseInt($('#ProfiledownloadCommission').val())<=parseInt($('#Amount').val())))    {
                                       $("#ErrProfiledownloadCommission").html("Please enter less than amount:") ;
                                    }
                                }
                               if ($('#ProfiledownloadCommissionType').val()=="Percentage") {
                                    if (!( parseInt($('#ProfiledownloadCommission').val())>=0 && parseInt($('#ProfiledownloadCommission').val())<=100))    {
                                       $("#ErrProfiledownloadCommission").html("Please enter below 100") ;
                                    }
                                } 
                            } else {
                            }
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
                                            <label for="FAQ Code" class="col-sm-2 col-form-label">Plan Code<span id="star">*</span></label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" maxlength="7" id="PlanCode" name="PlanCode" value="<?php echo (isset($_POST['PlanCode']) ? $_POST['PlanCode'] : $Plan['PlanCode']);?>" placeholder="Plan Code">
                                                <span class="errorstring" id="ErrPlanCode"><?php echo isset($ErrPlanCode) ? $ErrPlanCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="PlanName" class="col-sm-2 col-form-label">Plan Name<span id="star">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="PlanName" name="PlanName" value="<?php echo (isset($_POST['PlanName']) ? $_POST['PlanName'] : $Plan['PlanName']);?>" placeholder="Plan Name">
                                                <span class="errorstring" id="ErrPlanName"><?php echo isset($ErrPlanName) ? $ErrPlanName : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Profile Commission" class="col-sm-2 col-form-label">Duration<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <input type="text" class="form-control" id="Duration" name="Duration" value="<?php echo (isset($_POST['Duration']) ? $_POST['Duration'] : $Plan['Duration']);?>" placeholder="Duration">
                                                <div class="input-group-addon">days</div>
                                                </div>
                                                <span class="errorstring" id="ErrDuration"><?php echo isset($ErrDuration) ? $ErrDuration : "";?></span>
                                            </div>
                                            <label for="Amount" class="col-sm-2 col-form-label">Amount<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">Rs</div>
                                                <input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo (isset($_POST['Amount']) ? $_POST['Amount'] : $Plan['Amount']);?>" placeholder="Amount">
                                                </div>
                                                <span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount) ? $ErrAmount : "";?></span>
                                            </div>
                                        </div>
                                       <div class="form-group row">
                                            <label for="Profile Commission" class="col-sm-2 col-form-label">Profile<br> Active Commission<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">
                                                <select name="ProfileActiveCommissionType" id="ProfileActiveCommissionType">
                                                    <option value="Rs" <?php echo ($Plan['ProfileCommissionWithRupees']>0) ? " selected='selected' " : "";?>>Rs</option>
                                                    <option value="Percentage" <?php echo ($Plan['ProfileCommissionWithPercentage']>0) ? " selected='selected' " : "";?>>%</option>
                                                </select>
                                                </div>
                                                <input type="text" class="form-control" id="ProfileActiveCommission" name="ProfileActiveCommission" value="<?php if($Plan['ProfileCommissionWithPercentage']>0){
                                                echo $Plan['ProfileCommissionWithPercentage'];
                                                 }                                  
                                                 else{
                                                 echo $Plan['ProfileCommissionWithRupees'];
                                                  }
                                                  ?> ">
                                                </div>
                                                <span class="errorstring" id="ErrProfileActiveCommission"><?php echo isset($ErrProfileActiveCommission) ? $ErrProfileActiveCommission : "";?></span>
                                            </div>
                                            <label for="Profile Renewal Commission" class="col-sm-2 col-form-label">Profile Renewal Commission<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">
                                                <select name="ProfileRenewalCommissionType" id="ProfileRenewalCommissionType">
                                                    <option value="Rs" <?php echo ($Plan['RenewalCommissionWithRupees']>0) ? " selected='selected' " : "";?>>Rs</option>
                                                    <option value="Percentage" <?php echo ($Plan['RenewalCommissionWithPercentage']>0) ? " selected='selected' " : "";?>>%</option>
                                                </select>
                                                </div>
                                                <input type="text" class="form-control" id="ProfileRenewalCommission" name="ProfileRenewalCommission" value="<?php if($Plan['RenewalCommissionWithPercentage']>0){
                                                echo $Plan['RenewalCommissionWithPercentage'];
                                                 }                                  
                                                 else{
                                                 echo $Plan['RenewalCommissionWithRupees']; 
                                                  }
                                                  ?>">
                                                </div>
                                                <span class="errorstring" id="ErrProfileRenewalCommission"><?php echo isset($ErrProfileRenewalCommission) ? $ErrProfileRenewalCommission : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Refill Commission" class="col-sm-2 col-form-label">Wallet<br>Refill Commission<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">
                                                    <select name="WalletRefillCommissionType" id="WalletRefillCommissionType">
                                                        <option value="Rs" <?php echo ($Plan['RefillCommissionWithRupees']>0) ? " selected='selected' " : "";?>>Rs</option>
                                                        <option value="Percentage" <?php echo ($Plan['RefillCommissionWithPercentage']>0) ? " selected='selected' " : "";?>>%</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control" id="WalletRefillCommission" name="WalletRefillCommission" value="<?php if($Plan['RefillCommissionWithPercentage']>0){
                                                echo $Plan['RefillCommissionWithPercentage'];
                                                 }                                  
                                                 else{
                                                 echo $Plan['RefillCommissionWithRupees'];  
                                                  }
                                                  ?>">
                                                </div>
                                                <span class="errorstring" id="ErrWalletRefillCommission"><?php echo isset($ErrWalletRefillCommission) ? $ErrWalletRefillCommission : "";?></span>
                                            </div>
                                            <label for="ProfileDownload" class="col-sm-2 col-form-label">Profile download Commission<span id="star">*</span></label>
                                             <div class="col-sm-3">
                                                <div class="input-group">
                                                <div class="input-group-addon">
                                                <select name="ProfiledownloadCommissionType" id="ProfiledownloadCommissionType">
                                                    <option value="Rs" <?php echo ($Plan['ProfileDownloadCommissionWithRupees']>0) ? " selected='selected' " : "";?>>Rs</option>
                                                    <option value="Percentage" <?php echo ($Plan['ProfileDownloadCommissionWithPercentage']>0) ? " selected='selected' " : "";?>>%</option>
                                                </select>
                                                </div>
                                                <input type="text" class="form-control" id="ProfiledownloadCommission" name="ProfiledownloadCommission" value="<?php if($Plan['ProfileDownloadCommissionWithPercentage']>0){
                                                echo $Plan['ProfileDownloadCommissionWithPercentage'];
                                                 }                                  
                                                 else{
                                                 echo $Plan['ProfileDownloadCommissionWithRupees'];
                                                  }
                                                  ?> ">
                                                </div>
                                                <span class="errorstring" id="ErrProfiledownloadCommission"><?php echo isset($ErrProfiledownloadCommission) ? $ErrProfiledownloadCommission : "";?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12"><?php echo $errormessage?></div>
                                        <button type="submit" name="BtnSavePlan" class="btn btn-primary mr-2">Create Plan</button>
                                        <a href="../ManagePlan" style="text-decoration: underline;"><small>List of Plans</small> </a>
                                 </form>
                       </div>
                  </div>
             </div>
</form>