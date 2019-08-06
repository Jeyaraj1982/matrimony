<?php                   
  if (isset($_POST['BtnSaveProfile'])) {   
    $response = $webservice->getData("Franchisee","CreateProfile",$_POST);
    if ($response['status']=="success") {
        echo "<script>location.href='MemberProfileEdit/GeneralInformation/".$response['data']['Code'].".htm?msg=1';</script>";
        ?>
        <?php
    } else {
        $errormessage = $response['message']; 
    }
    }
?>  
<?php 
     $fInfo = $webservice->getData("Franchisee","GetCodeMasterDatas"); 
     
?>
<script>

function submitprofile() {
                         $('#ErrProfileName').html("");
                         $('#ErrDateofBirth').html("");
                         
                         ErrorCount=0;
                       
                        if (IsNonEmpty("ProfileName","ErrProfileName","Please enter your profile name")) {
                            IsAlphabet("ProfileName","ErrProfileName","Please enter alpha numeric characters only");
                         }
                         
                         if($("#Sex").val()=="0"){
                            document.getElementById("ErrSex").innerHTML="Please select sex"; 
                         }
                         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
}
</script>
 
<form method="post" action="" name="form" onsubmit="return submitprofile();">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile Information</h4>  
                <div class="form-group row">
                    <label for="Name" class="col-sm-2 col-form-label">Name<span id="star">*</span></label>
                    <div class="col-sm-8"><input type="text" class="form-control" id="ProfileName" name="ProfileName"  value="<?php echo (isset($_POST['ProfileName']) ? $_POST['ProfileName'] : "");?>" placeholder="Name">
                    <span class="errorstring" id="ErrProfileName"><?php echo isset($ErrProfileName)? $ErrProfileName : "";?></span></div>
                </div>
                <div class="form-group row">
                     <label for="Date of birth" class="col-sm-2 col-form-label">Date of birth<span id="star">*</span></label>
                     <div class="col-sm-3">
                          <input type="date" class="form-control" id="DateofBirth" name="DateofBirth"  value="<?php echo (isset($_POST['DateofBirth']) ? $_POST['DateofBirth'] : "");?>" style="line-height:15px !important" placeholder="Date of Birth">
                          <span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth : "";?></span></div>
                     <label for="Sex" class="col-sm-2 col-form-label">Sex<span id="star">*</span></label>
                     <div class="col-sm-3">
                        <select class="selectpicker form-control" data-live-search="true" id="Sex"  name="Sex">
                            <option value="0">Choose Sex</option>
                            <?php foreach($fInfo['data']['Gender'] as $Sex) { ?>
                            <option value="<?php echo $Sex['SoftCode'];?>" <?php echo ($_POST['Sex']==$Sex['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Sex['CodeValue'];?></option>
                            <?php } ?>
                        </select>
                       <span class="errorstring" id="ErrSex"><?php echo isset($ErrSex)? $ErrSex : "";?></span>
                     </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12"><?php echo $errormessage;?> <?php echo $successmessage;?></div>
                </div>
                   <div class="form-group row">
                    <div class="col-sm-3">
                    <button type="submit" name="BtnSaveProfile" class="btn btn-primary" style="font-family:roboto">Save &amp; Continue</button></div>
                </div>
            </div>
        </div>
    </div>
</form>



