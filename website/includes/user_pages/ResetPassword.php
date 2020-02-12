<?php
 $res = $webservice->getData("Member","CheckResetPasswordDetails",array("link"=>$_GET['link']));
 $reset = $res['data']['Reset'];
    if (isset($_POST['btnResetPassword'])) {
        include_once(application_config_path);
        $response = $webservice->getData("Member","ResetPsswordSavePassword",$_POST);    
        if ($response['status']=="success") {
        ?>
        <form action="password-changed" id="reqFrm" method="post">
            <input type="hidden" value="<?php echo $_GET['link'];?>" name="link">
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
                <h2>Reset Password</h2>
            </div>
            <?php if($reset[0]['ExpiredOn'] < date("Y-m-d H:i:s")) { ?>
                <div style="text-align:center">
                    <h4>Your reset password request link has been expired</h4>
                </div>
            <?php }else if($reset[0]['IsUsed']==1) { ?>
                   <div style="text-align:center">
                    <h4>Your reset password request link already used</h4>
                </div>
            <?php } ?>
            <div id="errormessage"></div>
            <?php if($reset[0]['ExpiredOn'] > date("Y-m-d H:i:s")  && $reset[0]['IsUsed']==0) { ?>
            <form action="" method="post" role="form" class="contactForm"  onsubmit="return SubmitChangePassword();">
            <input type="hidden" value="<?php echo $_GET['link'];?>" name="link">
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
            <?php } ?>
        </div>
        <div class="col-sm-3"></div>
    </div><br><br><br>
<?php include_once("includes/footer.php");?>