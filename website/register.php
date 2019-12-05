<?php 
    if (isset($_POST['BtnRegister'])) {         
        include_once(application_config_path);
        $response = $webservice->getData("Member","Register",$_POST);
        if ($response['status']=="success") {
            $_SESSION['MemberDetails']=$response['data'];
            echo "<script>location.href='Dashboard';</script>";
        } else {
            $errormessage = $response['message']; 
        }
    }
    
    $rand=substr(rand(),0,4); 
    $isShowSlider = false;
    $layout=0;
    include_once("includes/header.php");
?>
<script>
    $(document).ready(function () {
        $("#MobileNumber").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrMobileNumber").html("Digits Only").fadeIn("fast");
                return false;
            }
        });
        $("#Name").blur(function () {IsNonEmpty("Name","ErrName","Please Enter Name");});
        $("#MobileNumber").blur(function () {IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");});
        $("#Email").blur(function () {IsNonEmpty("Email","ErrEmail","Please Enter Email ID");});
        $("#Captchatext").blur(function () {IsNonEmpty("Captchatext","ErrCaptchatext","Please enter what you see in image");}); 
        $("#LoginPassword").blur(function () {
            if (IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password")) {
                IsPassword("LoginPassword","ErrLoginPassword","Please Enter Alpha Numeric Characters and More than 8 characters");
            } 
        });
    });
 
    function submitMemberRegistrationform() {
        $('#ErrName').html("");
        $('#ErrMobileNumber').html("");
        $('#ErrEmail').html("");
        $('#ErrLoginPassword').html("");
        $('#ErrCaptchatext').html("");
        
        ErrorCount=0;
        
        if (IsNonEmpty("Name","ErrName","Please enter your name")) {
            IsAlphabet("Name","ErrName","Please enter alpha numeric characters only");
        }
        
        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please enter your mobile number")) {
            IsMobileNumber("MobileNumber","ErrMobileNumber","Please enter valid Mobile Number");
        }
        
        if (IsNonEmpty("Email","ErrEmail","Please enter email")) {
            IsEmail("Email","ErrEmail","Please enter valid email id");    
        }
        
        if (IsNonEmpty("LoginPassword","ErrLoginPassword","Please enter login password")) {
            IsPassword("LoginPassword","ErrLoginPassword","Please Enter alpha numeric characters and more than 8 characters");  
        }
        
        if(document.form1.Captchatext.value==""){
            document.getElementById("ErrCaptchatext").innerHTML="Please enter what you see in image";
            return false;
        }
        
        if(document.form1.ran.value!=document.form1.Captchatext.value){
            document.getElementById("ErrCaptchatext").innerHTML="Captcha Not Matched!";
            return false;
        }
        
        return  (ErrorCount==0) ? true : false;
    }                                                
</script>
<br><br><br>
    <div class="container">
         <div class="row">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-sm-3"></div>    
        <div class="col-sm-6" style="text-align: center;">
                <div style="text-align: center;">
                    <h2>Registration</h2>
                    <p>Registration Free.</p>
                </div>
                    <div id="sendmessage"></div>
                    <div id="errormessage"></div>
                    <form action="<?php $_SERVER['PHP_SELF']?>" name="form1" onsubmit="return submitMemberRegistrationform();" method="post" role="form" class="contactForm"> 
                    <table style="margin: 0px auto;line-height: 28px;color: #333;min-width: 250px;">
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                Name<br>
                                    <input type="text" name="Name" class="form-control" id="Name" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : '';?>" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <span class="errorstring" id="ErrName"><?php echo isset($ErrName)? $ErrName : "";?></span>
                                    <div class="validation"></div> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                Gender<br>
                                    <select name="Gender" class="form-control" id="Gender" style="padding: 4px;">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select> 
                                    <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrGender)? $ErrGender : "";?></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    Mobile Number<br>
                                    <select name="CountryCode" class="form-control" id="CountryCode" style="width:70px;float:left">
                                        <option value="+91">+91</option>
                                    </select>
                                    <input type="text" class="form-control" name="MobileNumber" id="MobileNumber" maxlength="10" placeholder="Mobile Number" value="<?php echo isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : '';?>" style="width:75%">
                                </div>
                                <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                            </td>
                        </tr>
                        <tr>                                                                     
                            <td colspan="2"> 
                                <div class="form-group">
                                    Email<br>
                                    <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" value="<?php echo isset($_POST['Email']) ? $_POST['Email'] : '';?>" >
                                </div>
                                <span class="errorstring" id="ErrEmail"><?php echo isset($ErrEmail)? $ErrEmail : "";?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                Login Password<br>
                                    <input type="password" class="form-control" name="LoginPassword" id="LoginPassword" placeholder="Login Password" value="<?php echo isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : '';?>" >
                                </div>
                                <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword : "";?></span>
                            </td>
                        </tr>
                        <tr>
                             <td colspan="2">
                                <div class="form-group" style="text-align: center;">
                                    <input type="text"  value="<?=$rand?>" id="ran" readonly="readonly" class="captcha" style="background-image: url(assets/images/captcha_background.png);margin-bottom: 6px;border: none;width: 160px;height: 60px;text-align: center;font-size: 49px;"><br>
                                    <input type="text" maxlength="4" class="form-control c-square c-theme input-lg" style=""  name="Captchatext" id="Captchatext" placeholder="Enter Code" value="<?php echo isset($_POST['Captchatext']) ? $_POST['Captchatext'] : '';?>">
                                </div>
                                <span class="errorstring" id="ErrCaptchatext"><?php echo isset($ErrCaptchatext)? $ErrCaptchatext : "";?></span>
                            </td>
                        </tr>
                        <?php if (isset($errormessage)) { ?>
                        <tr>
                            <td style="text-align:center;color:red" colspan="2">
                                <div class="form-group"><?php echo $errormessage; ?></div>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    
                    <div class="text-center"><button type="submit" name="BtnRegister" class="btn btn-primary" required="required">Register &amp; Continue</button></div>
                </form>
                <div class="form-group" style="text-align:center">
                    Already a member? <a href="login">Login Now</a>
                </div>
            </div>                                                                                                                      
          </div>
    </div>
    <br><br><br>
<?php include_once("includes/footer.php");?>