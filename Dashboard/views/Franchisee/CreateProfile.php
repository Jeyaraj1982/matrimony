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
                        $('#ErrProfileFor').html("");
                        $('#ErrProfileName').html("");
                        $('#Errdate').html("");
                        $('#Errmonth').html("");
                        $('#Erryear').html("");
                        $('#ErrSex').html("");
                         
                         ErrorCount=0;
                       
                        if($("#ProfileFor").val()=="0"){
                            document.getElementById("ErrProfileFor").innerHTML="Please select profile for"; 
                        }
                        if (IsNonEmpty("ProfileName","ErrProfileName","Please enter your profile name")) {
                            IsAlphabet("ProfileName","ErrProfileName","Please enter alpha numeric characters only");
                         }
                         if($("#date").val()=="0" || $("#month").val()=="0" || $("#year").val()=="0"){
                            document.getElementById("ErrDateofBirth").innerHTML="Please select date of birth"; 
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
            <div style="padding:15px !important;max-width:770px !important;">
                <h4 class="card-title">Profile Information</h4>
                <div class="form-group row">
                    <label for="Community" class="col-sm-2 col-form-label">Profile create for<span id="star">*</span></label>
                    <div class="col-sm-4" style="max-width:284px !important;">
                        <select class="selectpicker form-control" data-live-search="true" id="ProfileFor" name="ProfileFor">
                            <option value="0">Choose Profile Sign In</option>
                            <?php foreach($fInfo['data']['ProfileFor'] as $ProfileFor) { ?>
                            <?php  if($ProfileFor['CodeValue']!= "Father" && $ProfileFor['CodeValue']!= "Mother"){     ?>
                            <option value="<?php echo $ProfileFor['SoftCode'];?>" <?php echo ($_POST['ProfileFor']==$ProfileFor['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $ProfileFor['CodeValue'];?></option>
                            <?php } } ?>
                        </select>
                        <span class="errorstring" id="ErrProfileFor"><?php echo isset($ErrProfileFor)? $ErrProfileFor : "";?></span>
                    </div>
                </div>  
                <div class="form-group row">
                    <label for="Name" class="col-sm-2 col-form-label">Name<span id="star">*</span></label>
                    <div class="col-sm-10"><input type="text" class="form-control" id="ProfileName" name="ProfileName"  value="<?php echo (isset($_POST['ProfileName']) ? $_POST['ProfileName'] : "");?>" placeholder="Name">
                    <span class="errorstring" id="ErrProfileName"><?php echo isset($ErrProfileName)? $ErrProfileName : "";?></span></div>
                </div>
                <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label">Date of birth<span id="star">*</span></label>
            <div class="col-sm-4" >
                <div class="col-sm-4" style="max-width:60px !important;padding:0px !important;">
                    <?php $dob=strtotime($ProfileInfo['DateofBirth'])  ; ?>
                    <select class="selectpicker form-control" data-live-search="true" id="date" name="date" style="width:56px">
                        <option value="0">Day</option>
                        <?php for($i=1;$i<=31;$i++) {?>
                        <option value="<?php echo $i; ?>" <?php echo ($_POST[ 'date']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4" style="max-width:90px !important;padding:0px !important;margin-right:6px;margin-left:6px;">        
                    <select class="selectpicker form-control" data-live-search="true" id="month" name="month" style="width:56px">
                        <option value="0">Month</option>
                        <?php foreach($_Month as $key=>$value) {?>
                        <option value="<?php echo $key+1; ?>" <?php echo ($_POST[ 'month']==$key+1) ? " selected='selected' " : "";?>><?php echo $value;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4" style="max-width:110px !important;padding:0px !important;">
                    <select class="selectpicker form-control" data-live-search="true" id="year" name="year" style="width:56px">
                        <option value="0">Year</option>
                        <?php for($i=$_DOB_Year_Start;$i>=$_DOB_Year_End;$i--) {?>
                        <option value="<?php echo $i; ?>" <?php echo ($_POST['year']==$i) ? " selected='selected' " : "";?>><?php echo $i;?></option>                             
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12"><span class="errorstring" id="ErrDateofBirth"><?php echo isset($ErrDateofBirth)? $ErrDateofBirth : "";?></span></div>
            </div>
            <label for="Sex" class="col-sm-2 col-form-label" style="text-align: right;padding-left:0px;padding-right:0px;">Sex<span id="star">*</span></label>
            <div class="col-sm-4" >
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
                    <div class="col-sm-12" style="color:red"><?php echo $errormessage;?> <?php echo $successmessage;?></div>
                </div>
                   <div class="form-group row">
                    <div class="col-sm-3">
                    <button type="submit" name="BtnSaveProfile" class="btn btn-primary" style="font-family:roboto">Save &amp; Continue</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>



