<script>
$(document).ready(function () {
    
$("#CasteCode").blur(function () {
    
    IsNonEmpty("CasteCode","ErrCasteCode","Please Enter Valid CasteCode");
    
   });
   $("#CasteName").blur(function () {
       
        IsNonEmpty("CasteName","ErrCasteName","Please Enter Valid Caste Name");
        
   });
});
 function SubmitNewCasteName() {
                         $('#ErrCasteCode').html("");
                         $('#ErrCasteName').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("CasteCode","ErrCasteCode","Please Enter Valid Caste Code")){
                        IsAlphaNumeric("CasteCode","ErrCasteCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("CasteName","ErrCasteName","Please Enter Valid Caste Name")){
                        IsAlphabet("CasteName","ErrCasteName","Please Enter Alphabets Charactors only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script> 
<?php   
    if (isset($_POST['BtnUpdateCasteName'])) {
        
        $response = $webservice->EditCasteName($_POST);
        if ($response['status']=="success") {
            echo $response['message'];
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response     = $webservice->GetMasterAllViewInfo();
    $CasteName = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="return SubmitNewCasteName();">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">Edit Caste Name</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="ReligionCode" class="col-sm-3 col-form-label">Caste Name Code</label>
                          <div class="col-sm-2">
                            <input type="text" disabled="disabled" style="width:100px;background:#f1f1f1" maxlength="10" class="form-control" id="CasteCode" name="CasteCode" value="<?php echo $CasteName['SoftCode'];?>" placeholder="Caste Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="CasteName" class="col-sm-3 col-form-label">Caste Name<span id="star">*</span></label>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" id="CasteName" name="CasteName" maxlength="100" value="<?php echo (isset($_POST['CasteName']) ? $_POST['CasteName'] : $CasteName['CodeValue']);?>" placeholder="Caste Name">
                            <span class="errorstring" id="ErrCasteName"><?php echo isset($ErrCasteName)? $ErrCasteName : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                                <select name="IsActive" class="form-control" style="width:80px">
                                    <option value="1" <?php echo ($CasteName['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                    <option value="0" <?php echo ($CasteName['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                                        <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3">
                       <button type="submit" name="BtnUpdateCasteName" id="BtnReligionName"  class="btn btn-primary mr-2"><small>Update Caste Name</small></button> </div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageCaste"><small>List of Caste Names</small> </a>  </div>
                       </div>
                      </form>
                    </div>
                  </div>
                </div>
</form>