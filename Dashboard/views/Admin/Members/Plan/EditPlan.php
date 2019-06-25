<?php  
    $Plan = $mysql->select("select * from _tbl_member_plan where PlanCode='".$_GET['Code']."'");
                          
   if (isset($_POST['BtnSavePlan'])) {
    $mysql->execute("update _tbl_member_plan set PlanName='".$_POST['PlanName']."',
                                                 Decreation='".$_POST['Decreation']."',
                                                 Amount='".$_POST['Amount']."',
                                                 FranchiseeCommissionWithPercentage='".$_POST['FranchiseeCommissionWithPercentage']."',
                                                 FranchiseeCommissionWithRupees='".$_POST['FranchiseeCommissionWithRupees']."',
                                                 Photos='".$_POST['Photos']."',
                                                 Videos='".$_POST['Videos']."',
                                                 FreeProfiles='".$_POST['Freeprofiles']."',
                                                 ShortDescription='".$_POST['ShortDescription']."',
                                                 DetailDescription='".$_POST['DetailDescription']."',
                                                 Remarks='".$_POST['Remarks']."'
                                                 where  PlanCode='".$_GET['Code']."'");
                                                   
                                       
             unset($_POST);
             echo "Successfully Updated";   
    
    }
   
    $Plan = $mysql->select("select * from _tbl_member_plan where PlanCode='".$_GET['Code']."'");
?>
  


<script>

$(document).ready(function () {
  $("#FranchiseeCommission").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrFranchiseeCommission").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
   
   $("#Amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAmount").html("Digits Only").show().fadeIn("fast");
               return false;
    }
   });
    
   $("#PlanCode").blur(function () {
    
        IsNonEmpty("PlanCode","ErrPlanCode","Please Enter Plan Code");
                        
   });
   $("#PlanName").blur(function () {
    
        IsNonEmpty("PlanName","ErrPlanName","Please Enter Plan Name");
                        
   });
   $("#Decreation").blur(function () {
    
        IsNonEmpty("Decreation","ErrDecreation","Please Enter Decreation");
                        
   });
   $("#Amount").blur(function () {
    
        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        
   });
   $("#FranchiseeCommissionWithPercentage").blur(function () {
    
        IsNonEmpty("FranchiseeCommissionWithPercentage","ErrFranchiseeCommissionWithPercentage","Please Enter Franchisee Commission");
                        
   });
   $("#FranchiseeCommissionWithRupees").blur(function () {
    
        IsNonEmpty("FranchiseeCommissionWithRupees","ErrFranchiseeCommissionWithRupees","Please Enter Franchisee Commission");
                        
   });
   $("#Photos").blur(function () {
    
        IsNonEmpty("Photos","ErrPhotos","Please Upload photos");
                        
   });
   $("#Videos").blur(function () {
    
        IsNonEmpty("Videos","ErrVideos","Please Upload Videos");
                        
   });
   $("#Freeprofiles").blur(function () {
    
        IsNonEmpty("Freeprofiles","ErrFreeprofiles","Please Enter Free profiles");
                        
   });
   $("#ShortDescription").blur(function () {
    
        IsNonEmpty("ShortDescription","ErrShortDescription","Please Enter Short Description");
                        
   });
   $("#DetailDescription").blur(function () {
    
        IsNonEmpty("DetailDescription","ErrDetailDescription","Please Enter Detail Description");
                        
   });
   $("#Remarks").blur(function () {
    
        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
   });
   });

function SubmitNewPlan() {
                         $('#ErrPlanName').html("");
                         $('#ErrDecreation').html("");
                         $('#ErrAmount').html("");
                         $('#ErrFranchiseeCommissionWithPercentage').html("");
                         $('#ErrFranchiseeCommissionWithRupees').html("");
                         $('#ErrPhotos').html("");
                         $('#ErrVideos').html("");
                         $('#ErrFreeprofiles').html("");
                         $('#ErrShortDescription').html("");
                         $('#ErrDetailDescription').html("");
                         $('#ErrRemarks').html("");
                         ErrorCount=0;
                         
                         
                        if (IsNonEmpty("PlanName","ErrPlanName","Please Enter Plan Name")) {
                            IsAlphabets("PlanName","ErrPlanName","Please Enter Alphabets characters only");    
                        }
                        IsNonEmpty("Decreation","ErrDecreation","Please Enter Decreation");
                        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        if (parseInt($('#FranchiseeCommissionWithPercentage').val())>0 && parseInt($('#FranchiseeCommissionWithPercentage').val())==0) {
                           
                        } else if (parseInt($('#FranchiseeCommissionWithPercentage').val())==0 && parseInt($('#FranchiseeCommissionWithPercentage').val())>0) {
                             
                        } else {
                            $('#ErrFranchiseeCommissionWithPercentage').html("Either % or Rs Must be Zero");
                        }
                        IsNonEmpty("Photos","ErrPhotos","Please upload Photos");
                        IsNonEmpty("Videos","ErrVideos","Please upload Videos");
                        IsNonEmpty("Freeprofiles","ErrFreeprofiles","Please Enter Freeprofiles");
                        IsNonEmpty("ShortDescription","ErrShortDescription","Please Enter Short Description");
                        IsNonEmpty("DetailDescription","ErrDetailDescription","Please Enter Detail Description");
                        IsNonEmpty("Remarks","ErrRemarks","Please Enter Remarks");
                        
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
                             <h4 class="card-title">Edit Plan</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Plan Code" class="col-sm-3 col-form-label">Plan Code<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="PlanCode" disabled="disabled" name="PlanCode" value="<?php echo (isset($_POST['PlanCode']) ? $_POST['PlanCode'] : $Plan[0]['PlanCode']);?>" placeholder="Plan Code">
                                                <span class="errorstring" id="ErrPlanCode"><?php echo isset($ErrPlanCode) ? $ErrPlanCode : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="PlanName" class="col-sm-3 col-form-label">Plan Name<span id="star">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="PlanName" name="PlanName" value="<?php echo (isset($_POST['PlanName']) ? $_POST['PlanName'] : $Plan[0]['PlanName']);?>" placeholder="Plan Name">
                                                <span class="errorstring" id="ErrPlanName"><?php echo isset($ErrPlanName) ? $ErrPlanName : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Decreation" class="col-sm-3 col-form-label">Duration<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="Decreation" name="Decreation" value="<?php echo (isset($_POST['Decreation']) ? $_POST['Decreation'] : $Plan[0]['Decreation']);?>" placeholder="Duration">
                                                <div class="input-group-addon">days</div>
                                            </div>
                                                <span class="errorstring" id="ErrDecreation"><?php echo isset($ErrDecreation) ? $ErrDecreation : "";?></span>
                                            </div>                                                                                     
                                        </div>
                                        <div class="form-group row">
                                                <label for="Amount" class="col-sm-3 col-form-label">Amount<span id="star">*</span></label>
                                            <div class="col-sm-3">
                                            <div class="input-group">
                                            <div class="input-group-addon">RS</div>
                                                <input type="text" class="form-control" id="Amount" name="Amount" value="<?php echo (isset($_POST['Amount']) ? $_POST['Amount'] : $Plan[0]['Amount']);?>" placeholder="Amount"></div> 
                                                <span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount) ? $ErrAmount : "";?></span>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Benefits" class="col-sm-3 col-form-label">Benefits<span id="star">*</span></label>
                                            <label for="Photos" class="col-sm-2 col-form-label">Photos<span id="star">*</span></label>   
                                            <div class="col-sm-1"><input type="text" class="form-control" id="Photos" name="Photos" value="<?php echo (isset($_POST['Photos']) ? $_POST['Photos'] : $Plan[0]['Photos']);?>" placeholder="0">
                                            <span class="errorstring" id="ErrPhotos"><?php echo isset($ErrPhotos) ? $ErrPhotos : "";?></span></div>   
                                            <label for="Videos" class="col-sm-2 col-form-label">Videos<span id="star">*</span></label>  
                                            <div class="col-sm-1"><input type="text" class="form-control" id="Videos" name="Videos" value="<?php echo (isset($_POST['Videos']) ? $_POST['Videos'] : $Plan[0]['Videos']);?>" placeholder="0">
                                            <span class="errorstring" id="ErrVideos"><?php echo isset($ErrVideos) ? $ErrVideos : "";?></span></div>    
                                            <label for="Free Profiles" class="col-sm-2 col-form-label">Free Profiles<span id="star">*</span></label>   
                                            <div class="col-sm-1"><input type="text" class="form-control" id="Freeprofiles" name="Freeprofiles" value="<?php echo (isset($_POST['Freeprofiles']) ? $_POST['Freeprofiles'] : $Plan[0]['FreeProfiles']);?>" placeholder="0">
                                            <span class="errorstring" id="ErrFreeprofiles"><?php echo isset($ErrFreeprofiles) ? $ErrFreeprofiles : "";?></span></div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="ShortDescription" class="col-sm-3 col-form-label">Short Description<span id="star">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="ShortDescription" name="ShortDescription" value="<?php echo (isset($_POST['ShortDescription']) ? $_POST['ShortDescription'] : $Plan[0]['ShortDescription']);?>" placeholder="Short Description">
                                                <span class="errorstring" id="ErrShortDescription"><?php echo isset($ErrShortDescription) ? $ErrShortDescription : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="DetailDescription" class="col-sm-3 col-form-label">Detail Description<span id="star">*</span></label>
                                            <div class="col-sm-7">
                                                <textarea rows="5" class="form-control" id="DetailDescription" name="DetailDescription"><?php echo (isset($_POST['DetailDescription']) ? $_POST['DetailDescription'] : $Plan[0]['DetailDescription']);?> </textarea>
                                                <span class="errorstring" id="ErrDetailDescription"><?php echo isset($ErrDetailDescription) ? $ErrDetailDescription : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Remarks" class="col-sm-3 col-form-label">Remarks<span id="star">*</span></label>
                                            <div class="col-sm-7">
                                                <textarea rows="5" class="form-control" id="Remarks" name="Remarks"><?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : $Plan[0]['Remarks']);?> </textarea>
                                                <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks) ? $ErrRemarks : "";?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Status" class="col-sm-3 col-form-label">Status<span id="star">*</span></label>
                                              <div class="col-sm-3">
                                                    <select name="Status" class="form-control" style="width: 140px;" >
                                                        <option value="1" <?php echo ($Plan[0]['Published']==1) ? " selected='selected' " : "";?>>Published</option>
                                                        <option value="0" <?php echo ($Plan[0]['Published']==0) ? " selected='selected' " : "";?>>Unpublished</option>
                                                    </select>
                                              </div>
                                        </div>
                                        <button type="submit" name="BtnSavePlan" class="btn btn-success mr-2">Update Plan</button>
                                        <a href="../ManagePlan" style="text-decoration: underline;"><small>List of Plans</small> </a>
                                 </form>
                       </div>
                  </div>
             </div>
</form>