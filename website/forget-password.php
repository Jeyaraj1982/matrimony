
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
            include_once("includes/header.php");
            ?>
 
  <section id="contact-page">
    <div class="container">
      <div class="center">
        <h2>Forget password</h2>
      </div>
      <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-md-6 col-md-offset-3">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-group">
              Please provide your Login Name or Registered Email Address, we'll send a verification code to your email address to reset your password
            </div>
            <div class="form-group">
              <input type="email" class="form-control"  name="FpUserName" id="FpUserName" placeholder="Login Name / Registered Email Address" data-rule="email" data-msg="Please enter a valid email" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
                <?php echo $errormessage;?>
            </div>
            <div class="text-center"><button type="submit" name="btnResetPassword" class="btn btn-primary btn-lg" required="required">Submit</button></div>
            </form>
        </div>
      </div>
    </div>                                                                               
  </section>
 <?php include_once("includes/footer.php");?>