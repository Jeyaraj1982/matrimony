<?php
     if (isset($_POST['BtnRegister'])) {
    
        include_once(application_config_path);
        $response = $webservice->getData("Member","Register",$_POST);
        if ($response['status']=="success") {
            $response = $webservice->getData("Member","Login",array("UserName"=>$_POST['Email'],"Password"=>$_POST[LoginPassword],"login"=>"")); 
            $_SESSION['MemberDetails']=$response['data'];
            echo "<script>location.href='Dashboard';</script>";
        } else {
            $errormessage = $response['message'];                           
        }
    }
    
    $rand=substr(rand(),0,4); 
    $isShowSlider = false;
    $layout=0;
?>                                                          
  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">             
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page</title>
    <link rel="apple-touch-icon" href="../../../assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/themes/semi-dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/core/menu/menu-types/vertical-menu.min.css">
     <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/plugins/forms/validation/form-validation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>assets/css/pages/authentication.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BaseUrl;?>/assets/css/style.css">
    <script src="<?php echo BaseUrl;?>assets/js/app.js" type="text/javascript"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <script>
    $(document).ready(function () {
        $("#MobileNumber").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#ErrMobileNumber").html("Digits Only").fadeIn("fast");
                return false;
            }
        });
        $("#Name").blur(function () {
             var IsName= IsNonEmpty("Name","ErrName","Please enter your name"); 
            if(IsName) {
                $("#Name").removeClass("is-invalid"); 
                var IsNameAlpha= IsAlphabet("Name","ErrName","Please enter alphabet characters only"); 
                    if (IsNameAlpha) {
                        $("#Name").removeClass("is-invalid"); 
                    } else {
                        $("#Name").addClass("is-invalid"); 
                    } 
            } else {
                $("#Name").addClass("is-invalid"); 
            }
        });
        $("#MobileNumber").blur(function () {
            var IsmobileNumber= IsNonEmpty("MobileNumber","ErrMobileNumber","Please enter your mobile number"); 
            if(IsmobileNumber) {
                $("#MobileNumber").removeClass("is-invalid"); 
                    var IsMobileNumberFormate = IsMobileNumber("MobileNumber","ErrMobileNumber","Please enter valid Mobile Number"); 
                        if (IsMobileNumberFormate) {
                            $("#MobileNumber").removeClass("is-invalid"); 
                        } else {
                            $("#MobileNumber").addClass("is-invalid"); 
                        }
            } else {
                $("#MobileNumber").addClass("is-invalid"); 
            }
        });
        $("#Email").blur(function () {
           var Isemail= IsNonEmpty("Email","ErrEmail","Please enter email"); 
            if(Isemail) {
                $("#Email").removeClass("is-invalid"); 
                    var IsEmailFormate = IsEmail("Email","ErrEmail","Please enter valid email id"); 
                        if (IsEmailFormate) {
                            $("#Email").removeClass("is-invalid"); 
                        } else {
                            $("#Email").addClass("is-invalid"); 
                        }
            } else {
                $("#Email").addClass("is-invalid"); 
            }
        });
       // $("#Captchatext").blur(function () {IsNonEmpty("Captchatext","ErrCaptchatext","Please enter what you see in image");
    }); 
 
    function MemberRegistration() {
        $('#ErrName').html("");
        $('#ErrMobileNumber').html("");
        $('#ErrEmail').html("");
        $('#ErrCaptchatext').html("");
        $("#ErrName").removeClass("is-invalid"); 
        $("#ErrMobileNumber").removeClass("is-invalid"); 
        $("#ErrEmail").removeClass("is-invalid"); 
        
        ErrorCount=0;
        
        var IsName= IsNonEmpty("Name","ErrName","Please enter your name"); 
            if(IsName) {
                $("#Name").removeClass("is-invalid"); 
                var IsNameAlpha= IsAlphabet("Name","ErrName","Please enter alphabet characters only"); 
                    if (IsNameAlpha) {
                        $("#Name").removeClass("is-invalid"); 
                    } else {
                        $("#Name").addClass("is-invalid"); 
                    } 
            } else {
                $("#Name").addClass("is-invalid"); 
            }
        
        var IsmobileNumber= IsNonEmpty("MobileNumber","ErrMobileNumber","Please enter your mobile number"); 
            if(IsmobileNumber) {
                $("#MobileNumber").removeClass("is-invalid"); 
                    var IsMobileNumberFormate = IsMobileNumber("MobileNumber","ErrMobileNumber","Please enter valid Mobile Number"); 
                        if (IsMobileNumberFormate) {
                            $("#MobileNumber").removeClass("is-invalid"); 
                        } else {
                            $("#MobileNumber").addClass("is-invalid"); 
                        }
            } else {
                $("#MobileNumber").addClass("is-invalid"); 
            }
        
        var Isemail= IsNonEmpty("Email","ErrEmail","Please enter email"); 
            if(Isemail) {
                $("#Email").removeClass("is-invalid"); 
                    var IsEmailFormate = IsEmail("Email","ErrEmail","Please enter valid email id"); 
                        if (IsEmailFormate) {
                            $("#Email").removeClass("is-invalid"); 
                        } else {
                            $("#Email").addClass("is-invalid"); 
                        }
            } else {
                $("#Email").addClass("is-invalid"); 
            }
        
       /* if(document.form1.Captchatext.value==""){
            document.getElementById("ErrCaptchatext").innerHTML="Please enter what you see in image";
            return false;
        }
        
        if(document.form1.ran.value!=document.form1.Captchatext.value){
            document.getElementById("ErrCaptchatext").innerHTML="Captcha Not Matched!";
            return false;
        }
        */

        return  (ErrorCount==0) ? true : false;
    }                                                
</script>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body"><!-- login page start -->
                    <section id="auth-login" class="row flexbox-container">
                        <div class="col-xl-8 col-11">
                            <div class="card bg-authentication mb-0">
                                <div class="row m-0">
                                    <div class="col-md-6 col-12 px-0">
                                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                            <div class="card-header pb-1">
                                                <div class="card-title">
                                                    <h4 class="text-center mb-2">Sign Up</h4>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                <div class="d-flex flex-md-row flex-column justify-content-around">
                                                            <a href="#"
                                                                class="btn btn-social btn-google btn-block font-small-3 mr-md-1 mb-md-0 mb-1">
                                                                <i class="bx bxl-google font-medium-3"></i><span
                                                                    class="pl-50 d-block text-center">Google</span></a>
                                                            <a href="#" class="btn btn-social btn-block mt-0 btn-facebook font-small-3">
                                                                <i class="bx bxl-facebook-square font-medium-3"></i><span
                                                                    class="pl-50 d-block text-center">Facebook</span></a>
                                                        </div>
                                                        <div class="divider">
                                                            <div class="divider-text text-uppercase text-muted"><small>or register with
                                                                    email</small>
                                                            </div>
                                                        </div>
                                                    <form action="<?php $_SERVER['PHP_SELF']?>" name="form1" onsubmit="return MemberRegistration();" method="post" >
                                                        <div class="form-group mb-50">
                                                            <label class="text-bold-600" for="Name">Name</label>
                                                            <input type="text" class="form-control" id="Name" name="Name" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : '';?>" placeholder="Your Name">
                                                            <span class="invalid-feedback" id="ErrName"><?php echo isset($ErrName)? $ErrName : "";?></span>
                                                        </div>
                                                        <div class="form-group mb-50">
                                                            <label class="text-bold-600" for="Gender">Gender</label>
                                                            <select name="Gender" class="form-control" id="Gender" style="padding: 4px;">
                                                                <option value="SX001" <?php echo ($_POST[ 'Gender']=="SX001") ? " selected='selected' " : "";?>>Male</option>
                                                                <option value="SX002" <?php echo ($_POST[ 'Gender']=="SX002") ? " selected='selected' " : "";?>>Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-row"> 
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label class="text-bold-600" for="CountryCode">Mobile Number</label>
                                                                <select name="CountryCode" class="form-control" id="CountryCode" style="padding: 4px;">
                                                                    <option value="91" <?php echo ($_POST[ 'CountryCode']=="91") ? " selected='selected' " : "";?>>+91</option>
                                                                </select>   
                                                            </div>
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label  for="MobileNumber">&nbsp;</label>
                                                                <input type="text" class="form-control" name="MobileNumber" id="MobileNumber" maxlength="10" placeholder="Mobile Number" value="<?php echo isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : '';?>">
                                                            </div>
                                                            <span class="invalid-feedback" id="ErrMobileNumber" style="display: block;text-align: right"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>            
                                                        </div>
                                                        <div class="form-group mb-50">
                                                            <label class="text-bold-600" for="Email">Email</label>
                                                            <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" value="<?php echo isset($_POST['Email']) ? $_POST['Email'] : '';?>" >
                                                            <span class="invalid-feedback" id="ErrEmail"><?php echo isset($ErrEmail)? $ErrEmail : "";?></span>
                                                        </div>
                                                        <input type="hidden" value="<?php echo rand(11111111,99999999);?>" name="LoginPassword" id="LoginPassword">
                                                        <!--<div class="form-group mb-50">
                                                            <label class="text-bold-600" for="LoginPassword">Login Password</label>
                                                            <fieldset class="form-group position-relative">
                                                                <input type="password" class="form-control pwd"  maxlength="8" id="LoginPassword" name="LoginPassword" Placeholder="Login Password" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : "");?>">
                                                                <div class="form-control-position" style="top:11px;height: 1rem;">
                                                                    <a href="javascript:void(0)"  onclick="showHidePwd('LoginPassword',$(this))"><i class="glyphicon glyphicon-eye-close"></i></a>
                                                                </div>
                                                            </fieldset>
                                                            <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword : "";?></span>
                                                        </div> -->
                                                        <!--<div class="form-group mb-50" style="text-align: center;">
                                                            <input type="text"  value="<?=$rand?>" id="ran" readonly="readonly" class="captcha" style="background-image: url(assets/images/captcha_background.png);margin-bottom: 6px;border: none;width: 160px;height: 60px;text-align: center;font-size: 49px;"><br>
                                                            <input type="text" maxlength="4" class="form-control c-square c-theme input-lg" style=""  name="Captchatext" id="Captchatext" placeholder="Enter Code" value="<?php echo isset($_POST['Captchatext']) ? $_POST['Captchatext'] : '';?>">
                                                            <span class="errorstring" id="ErrCaptchatext"><?php echo isset($ErrCaptchatext)? $ErrCaptchatext : "";?></span>
                                                        </div> -->
                                                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                            <span class="invalid-feedback" style="text-align: center;display: block"><?php echo $errormessage;?></span>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary glow position-relative w-100" name="BtnRegister">SIGN UP<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                    </form>
                                                    <hr>
                                                    <div class="text-center"><small class="mr-25">Already have an account?</small><a href="login"><small>Sign in</small> </a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- image section right -->
                                    <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                        <img class="img-fluid" src="<?php echo BaseUrl;?>assets/images/pages/register.png" alt="branding logo">
                                    </div>                                        
                                </div>
                            </div>                                             
                        </div>
                    </section>
                </div><!-- login page ends -->
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo BaseUrl;?>assets/vendors/js/vendors.min.js"></script>
    <script src="<?php echo BaseUrl;?>assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js"></script>
    <script src="<?php echo BaseUrl;?>assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js"></script>
    <script src="<?php echo BaseUrl;?>assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo BaseUrl;?>assets/js/scripts/configs/vertical-menu-light.min.js"></script>
    <script src="<?php echo BaseUrl;?>assets/js/core/app-menu.min.js"></script>
    <script src="<?php echo BaseUrl;?>assets/js/core/app.min.js"></script>
    <script src="<?php echo BaseUrl;?>assets/js/scripts/components.min.js"></script>
    <script src="<?php echo BaseUrl;?>assets/js/scripts/footer.min.js"></script>
     <script src="<?php echo BaseUrl;?>assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
     <script src="<?php echo BaseUrl;?>assets/js/scripts/forms/validation/form-validation.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->
</html>
<?php //include_once("includes/footer.php");?>