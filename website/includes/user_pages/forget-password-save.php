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
    $layout=0;                                    
    include_once("includes/header.php");   
?>   <br><br><br>
    <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div style="text-align:center">
                <h2>Change Password</h2>
            </div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
                <input type="hidden"  value="<?php echo $_POST['reqEmail'];?>" name="reqEmail">
                <input type="hidden"  value="<?php echo $_POST['reqID'];?>" name="reqID">
                <table style="margin: 0px auto;line-height: 28px;color: #333;min-width: 250px;">
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                New Password <br>
                                <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password" value="<?php echo isset($_POST['newpassword']) ? $_POST['newpassword'] : '';?>" required="reuired">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                               Confirm Password <br>
                                <input type="password" class="form-control" name="confirmnewpassword" id="confirmnewpassword" placeholder="Confrim New Password" value="<?php echo isset($_POST['confirmnewpassword']) ? $_POST['confirmnewpassword'] : '';?>" required="reuired">
                            </div>
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="2" style="color:red;text-align:center">
                            <div class="form-group"><button type="submit" name="btnResetPassword" class="btn btn-primary" required="required">Save Your Password</button></div>
                        </td>
                    </tr>
             </table>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div><br><br><br>
<?php include_once("includes/footer.php");?>