
<?php
          
            if (isset($_POST['btnResetPassword'])) {
                include_once(application_config_path);
                $response = $webservice->getData("Member","forgotPassword",$_POST);
                if ($response['status']=="success") {
                    ?>
                    <form action="forget-password-otp" id="reqFrm" method="post">
                        <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
                        <input type="hidden" value="<?php echo $response['data']['email'];?>" name="reqEmail">
                    </form>
                    <script>document.getElementById("reqFrm").submit();</script>
                <?php
                    }
                    else{
                        $errormessage = $response['message']; 
                    } 
            }              
             $isShowSlider = false;
             $layout=0;
            include_once("includes/header.php");
            ?>
  <br><br><br> 
  <script>
function submitMemberForgetPswd() {
        $('#ErrFpUserName').html("");
        ErrorCount=0;
        
        IsNonEmpty("FpUserName","ErrFpUserName","Please Enter Member ID / Registered Email");
         return  (ErrorCount==0) ? true : false;
    }    
</script>
  <div class="row">
	<div class="col-sm-3"></div>
        <div class="col-sm-6">
			<div style="min-width: 400px;max-width:400px;margin:0px auto;">
            <div style="text-align:center">
                <h2>Forget password</h2>
            </div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm" onsubmit="return submitMemberForgetPswd();">
            <div class="form-group" style="text-align:center">
              Please provide your Member ID or Registered Email, we'll send a verification code to your email to reset your password
            </div>
            <div class="form-group">
              <input type="text" class="form-control"  name="FpUserName" id="FpUserName" placeholder="Member ID / Registered Email" value="<?php echo isset($_POST['FpUserName']) ? $_POST['FpUserName'] : '';?>" />
			  <span class="errorstring" id="ErrFpUserName"><?php echo isset($ErrFpUserName)? $ErrFpUserName : "";?>&nbsp;</span>
			 <div class="validation"></div>
            </div>
            <div class="form-group" style="color:red">
                <?php echo $errormessage;?>
            </div>
                <div class="form-group">
                    <a href="login.php">Back to login</a>
                    <div style="float: right;">
                        <button type="submit" name="btnResetPassword" class="btn btn-primary" required="required">Continue</button>
                    </div>
                </div>
            </form>
        </div>
		</div>
        <div class="col-sm-3"></div>
    </div>                                                                                
  <br><br><br>
 <?php include_once("includes/footer.php");?>