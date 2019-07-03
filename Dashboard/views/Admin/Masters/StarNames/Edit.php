<script>
$(document).ready(function () {
   $("#StarCode").blur(function () {  
    IsNonEmpty("StarCode","ErrStarCode","Please Enter Valid Star Code");
   });
   $("#StarName").blur(function () {
        IsNonEmpty("StarName","ErrStarName","Please Enter Valid Star Name");
   });
});

 function SubmitNewStarName() {
                         $('#ErrStarCode').html("");
                         $('#ErrStarName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("StarCode","ErrStarCode","Please Enter Valid Star Code")){
                        IsAlphaNumeric("StarCode","ErrStarCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("StarName","ErrStarName","Please Enter Valid Star Name")){
                        IsAlphabet("StarName","ErrStarName","Please Enter Alphabets Charactors only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php   
    if (isset($_POST['BtnUpdateStarName'])) {
        
        $response = $webservice->getData("Admin","EditStarName",$_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $StarName = $response['data']['ViewInfo'];
?>   
<form method="post" action="" onsubmit="return SubmitNewStarName();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Star Name</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="StarCode" class="col-sm-3 col-form-label">Star Code<span id="star">*</span></label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:80px;background:#f1f1f1" class="form-control" id="StarCode" name="StarCode" value="<?php echo $StarName['SoftCode'];?>" placeholder="Star Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="StarName" class="col-sm-3 col-form-label">Star Name<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="StarName" name="StarName" value="<?php echo (isset($_POST['StarName']) ? $_POST['StarName'] : $StarName['CodeValue']);?>" placeholder="Star Name">
                             <span class="errorstring" id="ErrStarName"><?php echo isset($ErrStarName)? $ErrStarName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($StarName['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($StarName['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                        <button type="submit" name="BtnUpdateStarName" class="btn btn-primary mr-2"><small>Update Star Name</small></button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageStar"><small>List of Star Names</small></a></div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
</form>