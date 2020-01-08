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

<script>
    $(document).ready(function () {
        $("#newpassword").blur(function () {    
            IsNonEmpty("newpassword","Errnewpassword","Please Enter New Password");
        });
        $("#confirmnewpassword").blur(function () { 
            IsNonEmpty("confirmnewpassword","Errconfirmnewpassword","Please Confirm New Password");
        });
    });
    
    function SubmitChangePassword() {
        $('#Errnewpassword').html("");
        $('#Errconfirmnewpassword').html("");
        
        ErrorCount=0;
        
        if(IsNonEmpty("newpassword","Errnewpassword","Please Enter New Password")){
            IsPassword("newpassword","Errnewpassword","Please Enter more than 6 characters");
        }
         if(IsNonEmpty("confirmnewpassword","Errconfirmnewpassword","Please Enter Confirm New Password")){
        IsNonEmpty("confirmnewpassword","Errconfirmnewpassword","Please Enter more than 6 characters");
         }
       
        var password = document.getElementById("newpassword").value;
        var confirmPassword = document.getElementById("confirmnewpassword").value;
        if (password != confirmPassword) {
            ErrorCount++;
            $('#Errconfirmnewpassword').html("Passwords do not match.");
        }

        return (ErrorCount==0) ? true : false;
    }
</script>
    <div class="row contact-wrap">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div style="text-align:center">
                <h2>Change Password</h2>
            </div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm"  onsubmit="return SubmitChangePassword();">
                <input type="hidden"  value="<?php echo $_POST['reqEmail'];?>" name="reqEmail">
                <input type="hidden"  value="<?php echo $_POST['reqID'];?>" name="reqID">
                <table style="margin: 0px auto;line-height: 28px;color: #333;min-width: 250px;">
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                                New Password <br>
								<div class="input-group">
										<input type="password" class="form-control pwd"  maxlength="8" id="newpassword" name="newpassword" Placeholder="New Password" value="<?php echo isset($_POST['newpassword']) ? $_POST['newpassword'] : '';?>">
											<span class="input-group-btn">
												<button  onclick="showHidePwd('newpassword',$(this))" class="btn btn-default reveal" type="button" style="padding: 9px;"><i class="glyphicon glyphicon-eye-close"></i></button>
											</span>          
									</div>
									<span class="errorstring" id="Errnewpassword"><?php echo isset($Errnewpassword)? $Errnewpassword : "";?>&nbsp;</span>
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-group">
                               Confirm Password <br>
								<div class="input-group">
										<input type="password" class="form-control pwd"  maxlength="8" id="confirmnewpassword" name="confirmnewpassword" Placeholder="Confirm New Password" value="<?php echo isset($_POST['confirmnewpassword']) ? $_POST['confirmnewpassword'] : '';?>">
											<span class="input-group-btn">
												<button  onclick="showHidePwd('confirmnewpassword',$(this))" class="btn btn-default reveal" type="button" style="padding: 9px;"><i class="glyphicon glyphicon-eye-close"></i></button>
											</span>          
									</div>
									<span class="errorstring" id="Errconfirmnewpassword"><?php echo isset($Errconfirmnewpassword)? $Errconfirmnewpassword : "";?>&nbsp;</span>
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