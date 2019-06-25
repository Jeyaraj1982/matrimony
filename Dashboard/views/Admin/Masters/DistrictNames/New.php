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
<?php                   
  if (isset($_POST['BtnSaveDistrictName'])) {   
    $response = $webservice->CreateDistrictName($_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $DistrictCode = $webservice->GetMastersManageDetails(); 
     $GetNextDistrictCode="";
        if ($DistrictCode['status']=="success") {
            $GetNextDistrictCode  =$DistrictCode['data']['DistrictCode'];
        }
        {     
?>
<?php 
 $info    = $webservice->GetMastersManageDetails();
 ?>
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
                                    <input type="text" class="form-control" id="DistrictCode" name="DistrictCode" maxlength="6" value="<?php echo (isset($_POST['DistrictCode']) ? $_POST['DistrictCode'] : $GetNextDistrictCode);?>">
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
                                    <input type="text" class="form-control" id="DistrictName" name="DistrictName" maxlength="100" value="<?php echo (isset($_POST['DistrictName']) ? $_POST['DistrictName'] : " ");?>">
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
                                    <select class="form-control" id="CountryName" name="CountryName">
                                        <?php foreach($info['data']['CountryName'] as $CountryName) { ?>
                                             <option value="<?php echo $CountryName['CodeValue'];?>"
                                                <?php echo ($CountryName[ 'CodeValue']==$_POST[ 'CountryName']) ? ' selected="selected" ' : '';?>><?php echo $CountryName['CodeValue'];?>
                                             </option>
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
                                    <select class="form-control" id="StateName" name="StateName">
                                        <?php foreach($info['data']['StateName'] as $StateName) { ?>
                                            <option value="<?php echo $StateName['CodeValue'];?>"<?php echo ($StateName[ 'CodeValue']==$_POST[ 'StateName']) ? ' selected="selected" ' : '';?>>
                                                <?php echo $StateName['CodeValue'];?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                    <span class="errorstring" id="ErrStateName"><?php echo isset($ErrStateName)? $ErrStateName : "";?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <button type="submit" name="BtnSaveDistrictName" id="BtnSaveDistrictName" class="btn btn-primary mr-2">Save District Name</button>
                        </div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageDistrict"><small>List of District Names</small> </a> </div>
                    </div>
            </div>
        </div>
    </div>

    </form>
    <?php }?>
         
