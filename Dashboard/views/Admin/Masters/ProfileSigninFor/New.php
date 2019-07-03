<script>
$(document).ready(function () {
   $("#ProfileSigninForCode").blur(function () {  
    IsNonEmpty("ProfileSigninForCode","ErrProfileSigninForCode","Please Enter Valid Profile SigninFor Code");
   });
   $("#ProfileSigninFor").blur(function () {
        IsNonEmpty("ProfileSigninFor","ErrProfileSigninFor","Please Enter Valid Profile Signin For");
   });
});
 function SubmitProfileSignIn() {
                         $('#ErrProfileSigninForCode').html("");
                         $('#ErrProfileSigninFor').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("ProfileSigninForCode","ErrProfileSigninForCode","Please Enter Valid Profile SigninFor Code")){
                        IsAlphaNumeric("ProfileSigninForCode","ErrProfileSigninForCode","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("ProfileSigninFor","ErrProfileSigninFor","Please Enter Valid Profile Signin For")){
                        IsAlphabet("ProfileSigninFor","ErrProfileSigninFor","Please Enter Alphabets Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<?php                   
  if (isset($_POST['BtnProfileSigninFor'])) {   
    $response = $webservice->getData("Admin","CreateProfileSignInFor",$_POST);
    if ($response['status']=="success") {
       $successmessage = $response['message']; 
       unset($_POST);
    } else {
        $errormessage = $response['message']; 
    }
    } 
  $ProfileSignInCode = $webservice->GetMastersManageDetails(); 
     $GetNextProfileSignInCode="";
        if ($ProfileSignInCode['status']=="success") {
            $GetNextProfileSignInCode  =$ProfileSignInCode['data']['ProfileSignInForCode'];
        }
        {     
?> 
<form method="post" action="" onsubmit="return SubmitProfileSignIn();">
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Masters</h4>
                <h4 class="card-title">Create Profile Signin For</h4>
                <form class="forms-sample">
                    <div class="form-group row">
                        <label for="ProfileSigninForCode" class="col-sm-3 col-form-label">Code<span id="star">*</span></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="ProfileSigninForCode" name="ProfileSigninForCode" maxlength="6" value="<?php echo isset($_POST['ProfileSigninForCode']) ? $_POST['ProfileSigninForCode'] : $GetNextProfileSignInCode;?>" placeholder="ProfileSigninForCode">
                            <span class="errorstring" id="ErrProfileSigninForCode"><?php echo isset($ErrProfileSigninForCode)? $ErrProfileSigninForCode : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ProfileSigninFor" class="col-sm-3 col-form-label">Profile SigninFor<span id="star">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="ProfileSigninFor" name="ProfileSigninFor" maxlength="100" value="<?php echo (isset($_POST['ProfileSigninFor']) ? $_POST['ProfileSigninFor'] : " ");?>" placeholder="Profile SigninFor">
                            <span class="errorstring" id="ErrProfileSigninFor"><?php echo isset($ErrProfileSigninFor)? $ErrProfileSigninFor : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <button type="submit" name="BtnProfileSigninFor" id="BtnProfileSigninFor" class="btn btn-primary mr-2">Save Profile SigninFor</button>
                        </div>
                        <div class="col-sm-6" align="left" style="padding-top:5px; text-decoration: underline;color: skyblue;"><a href="ManageProfileSigninFor"><small>List of Profile Signin For</small> </a> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
<?php }?>