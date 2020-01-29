<?php 
$page="ManageBloodGroups";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<script>
 function SubmitBloodGroup() {
                         $('#ErrBloodGroupCode').html("");
                         $('#ErrBloodGroupName').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("BloodGroupCode","ErrBloodGroupCode","Please Enter Valid Blood Group Code");
                        IsNonEmpty("BloodGroupName","ErrBloodGroupName","Please Enter Valid BloodGroupName");
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnSaveBloodGroup'])) {   
    $response = $webservice->getData("Admin","CreateBloodGroup",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $BloodGroupCode = $webservice->getData("Admin","GetMastersManageDetails"); 
     $GetNextBloodGroupCode="";
        if ($BloodGroupCode['status']=="success") {
            $GetNextBloodGroupCode  =$BloodGroupCode['data']['BloodGroupCode'];
        }
?>
<div class="col-sm-10 rightwidget">
<form method="post" action="" onsubmit="return SubmitBloodGroup();">
 <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <h4 class="card-title">Masters</h4>
               <h4 class="card-title">Create Blood Group</h4>
               <div class="form-group row">
                        <label for="Blood Group Code" class="col-sm-3 col-form-label">Blood Group Code<span id="star">*</span></label>
                    <div class="col-sm-9">                                                                                      
                        <input type="text" class="form-control" id="BloodGroupCode" name="BloodGroupCode" maxlength="10"  value="<?php echo (isset($_POST['BloodGroupCode']) ? $_POST['BloodGroupCode'] : $GetNextBloodGroupCode);?>" placeholder="Blood Group Code">
                        <span class="errorstring" id="ErrBloodGroupCode"><?php echo isset($ErrBloodGroupCode)? $ErrBloodGroupCode : "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                        <label for="Blood Group Name" class="col-sm-3 col-form-label">Blood Group Name<span id="star">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="BloodGroupName" name="BloodGroupName" maxlength="100" value="<?php echo (isset($_POST['BloodGroupName']) ? $_POST['BloodGroupName'] : "");?>" placeholder="Blood Group Name">
                        <span class="errorstring" id="ErrBloodGroupName"><?php echo isset($ErrBloodGroupName)? $ErrBloodGroupName : "";?></span>
                    </div>
                </div>
                <div class="form-group row"><div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div></div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <button type="submit" name="BtnSaveBloodGroup" id="BtnSaveBloodGroup"  class="btn btn-primary mr-2">Save Blood Group</button> </div>
                    <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageBloodGroups"><small>List of Blood Groups</small> </a>  </div>
                </div>
                </div>
              </div>
            </div>
        </form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    