<?php                   
  if (isset($_POST['BtnSaveProfile'])) {   
    $response = $webservice->getData("Franchisee","CreateProfile",$_POST);
    if ($response['status']=="success") {
        echo "<script>location.href='../MemberProfileEdit/GeneralInformation/".$response['data']['Code'].".htm?msg=1';</script>";
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
<input type="hidden" value="<?php echo $_GET['Code'];?>" name="MemberCode">
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
                            <label for="Name" class="col-sm-2 col-form-label">Date of Birth<span id="star">*</span></label>
                            <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">
                                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                                        <?php for($i=1;$i<=31;$i++) {?>
                                            <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>><?php echo $i;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-1" style="max-width:100px !important;margin-right: -25px;">        
                                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                                        <?php foreach($_Month as $key=>$value) {?>
                                            <option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>><?php echo $value;?>
                                            </option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-sm-2">
                                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                                            <option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?>
                                            </option>
                                        <?php } ?>                                 
                                    </select>
                            </div>
                           <label for="Sex" class="col-sm-1 col-form-label" style="text-align: right;">Sex<span id="star">*</span></label>
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



