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
<?php
    $planinfo = $webservice->getData("Admin","GetNextFranchiseePlanNumber"); 
     $PlanCode="";
        if ($planinfo['status']=="success") {
            $PlanCode  =$planinfo['data']['PlanCode'];
            $Currency  =$planinfo['data']['Currency'];
        }
        {
?>
<form method="post" id="frmfrn">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
             <div class="col-12 stretch-card">
             <div class="col-sm-9">
             <div style="max-width:770px !important;">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Franchisees</h4>
                             <h4 class="card-title">Create Plan</h4>
                                <div class="form-group row">
                                    <label for="FAQ Code" class="col-sm-3 col-form-label">Plan Code<span id="star">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" maxlength="7" id="PlanCode" name="PlanCode" value="<?php echo isset($_POST['PlanCode']) ? $_POST['PlanCode'] : $PlanCode ;?>" placeholder="Plan Code">
                                        <span class="errorstring" id="ErrPlanCode"><?php echo isset($ErrPlanCode) ? $ErrPlanCode : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="PlanName" class="col-sm-3 col-form-label">Plan Name<span id="star">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="PlanName" name="PlanName" value="<?php echo (isset($_POST['PlanName']) ? $_POST['PlanName'] : "");?>" placeholder="Plan Name">
                                        <span class="errorstring" id="ErrPlanName"><?php echo isset($ErrPlanName) ? $ErrPlanName : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Profile Commission" class="col-sm-3 col-form-label">Duration<span id="star">*</span></label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Duration" name="Duration" value="<?php echo (isset($_POST['Duration']) ? $_POST['Duration'] : "");?>" placeholder="Duration">
                                            <div class="input-group-addon">days</div>
                                        </div>
                                        <span class="errorstring" id="ErrDuration"><?php echo isset($ErrDuration) ? $ErrDuration : "";?></span>
                                    </div>
                                    <label for="Amount" class="col-sm-3 col-form-label">Franchisee<br>Activation Amount<span id="star">*</span></label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="padding: 0px 10px;">
                                                <select name="ActivationAmount" id="ActivationAmount">
                                                    <option value="<?php echo $Currency;?>"><?php echo $Currency;?></option>
                                                </select> 
                                            </div>
                                            <input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo (isset($_POST['Amount']) ? $_POST['Amount'] : "");?>" placeholder="Amount">
                                        </div>
                                        <span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount) ? $ErrAmount : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Profile Commission" class="col-sm-3 col-form-label">Profile Active<br>Commission<span id="star">*</span></label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                        <div class="input-group-addon" style="padding: 0px 10px;">
                                            <select name="ProfileActiveCommissionType" id="ProfileActiveCommissionType">
                                                <option value="<?php echo $Currency;?>"><?php echo $Currency;?></option>
                                                <option value="Percentage">%</option>
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" id="ProfileActiveCommission" name="ProfileActiveCommission" value="<?php echo (isset($_POST['ProfileActiveCommission']) ? $_POST['ProfileActiveCommission'] : "");?>" style="text-align: right;" placeholder="0">
                                        </div>
                                        <span class="errorstring" id="ErrProfileActiveCommission"><?php echo isset($ErrProfileActiveCommission) ? $ErrProfileActiveCommission : "";?></span>
                                    </div>
                                    <label for="Profile Renewal Commission" class="col-sm-3 col-form-label">Profile Renewal Commission<span id="star">*</span></label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="padding: 0px 10px;">
                                                <select name="ProfileRenewalCommissionType" id="ProfileRenewalCommissionType">
                                                    <option value="<?php echo $Currency;?>"><?php echo $Currency;?></option>
                                                    <option value="Percentage">%</option>
                                                </select>
                                            </div>
                                            <input type="text" class="form-control" id="ProfileRenewalCommission" name="ProfileRenewalCommission" style="text-align: right;" placeholder="0" value="<?php echo (isset($_POST['ProfileRenewalCommission']) ? $_POST['ProfileRenewalCommission'] : "");?>">
                                        </div>
                                        <span class="errorstring" id="ErrProfileRenewalCommission"><?php echo isset($ErrProfileRenewalCommission) ? $ErrProfileRenewalCommission : "";?></span>
                                    </div>
                                </div>
                                        <div class="form-group row">
                                            <label for="Refill Commission" class="col-sm-3 col-form-label">Wallet Refill<br>Commission<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <div class="input-group-addon" style="padding: 0px 10px;">
                                                        <select name="WalletRefillCommissionType" id="WalletRefillCommissionType">
                                                            <option value="<?php echo $Currency;?>"><?php echo $Currency;?></option>
                                                            <option value="Percentage">%</option>
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control" id="WalletRefillCommission" name="WalletRefillCommission" style="text-align: right;" placeholder="0" value="<?php echo (isset($_POST['WalletRefillCommission']) ? $_POST['WalletRefillCommission'] : "");?>">
                                                </div>
                                                <span class="errorstring" id="ErrWalletRefillCommission"><?php echo isset($ErrWalletRefillCommission) ? $ErrWalletRefillCommission : "";?></span>
                                            </div>
                                            <label for="ProfileDownload" class="col-sm-3 col-form-label">Profile download Commission<span id="star">*</span></label>
                                             <div class="col-sm-3">
                                                <div class="input-group">
                                                    <div class="input-group-addon" style="padding: 0px 10px;">
                                                        <select name="ProfiledownloadCommissionType" id="ProfiledownloadCommissionType">
                                                            <option value="<?php echo $Currency;?>"><?php echo $Currency;?></option>
                                                            <option value="Percentage">%</option>
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control" id="ProfiledownloadCommission" style="text-align: right;" placeholder="0" name="ProfiledownloadCommission" value="<?php echo (isset($_POST['ProfiledownloadCommission']) ? $_POST['ProfiledownloadCommission'] : "");?>">
                                                </div>
                                                <span class="errorstring" id="ErrProfiledownloadCommission"><?php echo isset($ErrProfiledownloadCommission) ? $ErrProfiledownloadCommission : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Remarks" class="col-sm-3 col-form-label">Remarks<span id="star">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea  rows="2" class="form-control" id="Remarks" name="Remarks" ><?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : "");?></textarea>
                                                <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks) ? $ErrRemarks : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">                           
                                            <div class="col-sm-12">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" id="IsDefault" name="IsDefault" <?php echo ($_POST['IsDefault']==1) ? ' checked="checked" ' :'';?>>
                                                    <label class="custom-control-label" for="IsDefault" style="vertical-align: middle;">Make as Default Plan</label>
                                                </div>
                                            </div>
                                        </div>
                                     <div class="col-sm-12"><?php echo $errormessage ?><?php echo $successmessage?></div>
                       </div>
                  </div>
                  <br>
                <div class="col-12 grid-margin" style="padding-right:0px;text-align: right;">
                        &nbsp;<a href="javascript:void(0)" onclick="Franchisee.ConfirmGotoBackFromCreatePlan()" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                        <a href="javascript:void(0)" onclick="Franchisee.ConfirmCreateFranchiseePlan()" class="btn btn-primary" name="BtnSaveCreate">Create Plan</a>
                </div>                                        
             </div>
             </div>
    </div>
</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Publish_body"  style="max-height: 350px;min-height: 350px;" >
            
                </div>
            </div>
        </div>
<?php } ?> 
