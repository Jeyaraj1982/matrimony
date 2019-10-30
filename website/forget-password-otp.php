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
    $isShowSlider = false;                              
    include_once("includes/header.php");
 ?>

 <div class="container">
    <div class="center">
        <h2>Forget password</h2>
    </div>
    <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-md-6 col-md-offset-3">
            <form action="" method="post" role="form" class="contactForm">
                <div class="form-group">Have sent a verification code to your email. Please enter the code bellow box</div>
                <input type="hidden"  value="<?php echo $_POST['reqEmail'];?>" name="reqEmail">
                <input type="hidden"  value="<?php echo $_POST['reqID'];?>" name="reqID">
                <div class="form-group">
                    <input type="text" class="form-control"  name="scode" id="scode" placeholder="Verification code here ..." style="height:32px !important" value="<?php echo isset($_POST['scode']) ? $_POST['scode'] : '';?>">
                    <div class="validation"></div>
                </div>
                <?php if (isset($errormessage)) { ?>
                    <div class="form-group"><?php echo $errormessage; ?></div>
                <?php } ?>
                <div class="text-center"><button type="submit" name="btnVerifyCode" class="btn btn-primary btn-lg" required="required">Verify your code</button></div>
            </form>
        </div>
    </div>                                                                               
</div>
<?php include_once("includes/footer.php");?>