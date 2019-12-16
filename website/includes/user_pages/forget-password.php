
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
  <section id="contact-page">
    <div class="container">
      <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div style="text-align:center">
                <h2>Forget password</h2>
            </div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-group" style="text-align:center">
              Please provide your Member ID or Registered Email, we'll send a verification code to your email to reset your password
            </div>
            <div class="form-group">
              <input type="text" class="form-control"  name="FpUserName" id="FpUserName" placeholder="Member ID / Registered Email" value="<?php echo isset($_POST['FpUserName']) ? $_POST['FpUserName'] : '';?>" required="Please enter a valid email" data-rule="email" data-error="Please enter a valid email" />
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
        <div class="col-sm-3"></div>
      </div>
    </div>                                                                               
  </section>
  <br><br><br>
 <?php include_once("includes/footer.php");?>