 <?php
    if (isset($_POST['btnVerifyCode'])) {
        include_once(application_config_path);
        $response = $webservice->getData("Member","forgotPasswordOTPvalidation",$_POST);
        if ($response['status']=="success") {
        ?>
        <form action="forget-password-save" id="reqFrm" method="post">
            <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
            <input type="hidden" value="<?php echo $response['data']['email'];?>" name="reqEmail">
        </form>
        <script>document.getElementById("reqFrm").submit();</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }  
    } 
    $layout=0;
    $isShowSlider = false;                              
    include_once("includes/header.php");
 ?>

   <br><br><br> 
   <div class="container">
    <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div style="text-align:center">
                <h2>Forget password</h2>
            </div>
            <form action="" method="post" role="form" class="contactForm">
                <div class="form-group" style="text-align: center;">We have sent a verification code to your registered email. Please check your email and  enter the verification code bellow box</div>
                <input type="hidden"  value="<?php echo $_POST['reqEmail'];?>" name="reqEmail">
                <input type="hidden"  value="<?php echo $_POST['reqID'];?>" name="reqID">
                <div class="form-group">
                    <input type="text" class="form-control"  name="scode" id="scode" placeholder="Verification code here ..." style="height:32px !important" value="<?php echo isset($_POST['scode']) ? $_POST['scode'] : '';?>" required="required">
                    <div class="validation"></div>
                </div>
                <?php if (isset($errormessage)) { ?>
                    <div class="form-group" style="color: red"><?php echo $errormessage; ?></div>
                <?php } ?>
                <div class="text-center"><button type="submit" name="btnVerifyCode" class="btn btn-primary" required="required">Verify your code</button></div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>    
    </div>
    <br><br><br>                                                                               
<?php include_once("includes/footer.php");?>