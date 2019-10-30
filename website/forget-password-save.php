<?php
    if (isset($_POST['btnResetPassword'])) {
        include_once(application_config_path);
        $response = $webservice->getData("Member","forgotPasswordchangePassword",$_POST);    
        if ($response['status']=="success") {
        ?>
        <form action="password-changed" id="reqFrm" method="post">
            <input type="hidden" value="<?php echo $response['data']['reqID'];?>" name="reqID">
            <input type="hidden" value="<?php echo $response['data']['reqEmail'];?>" name="reqEmail">
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
        <h2>Change Password</h2>
    </div>
    <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-md-6 col-md-offset-3">
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
                <input type="hidden"  value="<?php echo $_POST['reqEmail'];?>" name="reqEmail">
                <input type="hidden"  value="<?php echo $_POST['reqID'];?>" name="reqID">
                <div class="form-group">
                    <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password" value="<?php echo isset($_POST['newpassword']) ? $_POST['newpassword'] : '';?>">
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirmnewpassword" id="confirmnewpassword" placeholder="Confrim New Password" value="<?php echo isset($_POST['confirmnewpassword']) ? $_POST['confirmnewpassword'] : '';?>">
                    <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit" name="btnResetPassword" class="btn btn-primary btn-lg" required="required">Submit Message</button></div>
            </form>
        </div>
    </div>
</div>
<?php include_once("includes/footer.php");?>