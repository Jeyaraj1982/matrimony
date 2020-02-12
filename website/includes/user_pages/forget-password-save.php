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
    //include_once("includes/header.php");
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
      $("#newpassword").blur(function () {
        var Isnewpassword= IsNonEmpty("newpassword","Errnewpassword","Please Please Enter New Password"); 
            if(Isnewpassword) {
                $("#newpassword").removeClass("is-invalid"); 
                var IsIsPassword= IsPassword("newpassword","Errnewpassword","Please Enter more than 6 characters"); 
                    if (IsIsPassword) {
                        $("#newpassword").removeClass("is-invalid"); 
                    } else {
                        $("#newpassword").addClass("is-invalid"); 
                    } 
            } else {
                $("#newpassword").addClass("is-invalid"); 
            }  
      });
      $("#confirmnewpassword").blur(function () {
        var Isconfirmnewpassword= IsNonEmpty("confirmnewpassword","Errconfirmnewpassword","Please Confirm New Password"); 
            if(Isconfirmnewpassword) {
                $("#confirmnewpassword").removeClass("is-invalid"); 
                var IsConmfirmPassword= IsPassword("confirmnewpassword","Errconfirmnewpassword","Please Enter more than 6 characters"); 
                    if (IsConmfirmPassword) {
                        $("#confirmnewpassword").removeClass("is-invalid"); 
                    } else {
                        $("#confirmnewpassword").addClass("is-invalid"); 
                    } 
            } else {
                $("#confirmnewpassword").addClass("is-invalid"); 
            }  
      });
   });
function MemberChangePassword() {
        $('#Errnewpassword').html("");
        $('#Errconfirmnewpassword').html("");
        $("#newpassword").removeClass("is-invalid"); 
        $("#confirmnewpassword").removeClass("is-invalid"); 
        ErrorCount=0;
        
         var Isnewpassword= IsNonEmpty("newpassword","Errnewpassword","Please Please Enter New Password"); 
            if(Isnewpassword) {
                $("#newpassword").removeClass("is-invalid"); 
                var IsIsPassword= IsPassword("newpassword","Errnewpassword","Please Enter more than 6 characters"); 
                    if (IsIsPassword) {
                        $("#newpassword").removeClass("is-invalid"); 
                    } else {
                        $("#newpassword").addClass("is-invalid"); 
                    } 
            } else {
                $("#newpassword").addClass("is-invalid"); 
            }
            var Isconfirmnewpassword= IsNonEmpty("confirmnewpassword","Errconfirmnewpassword","Please Confirm New Password");
            if(Isconfirmnewpassword) {
                $("#confirmnewpassword").removeClass("is-invalid"); 
                var IsIsConmfirmPassword= IsPassword("confirmnewpassword","Errconfirmnewpassword","Please Enter more than 6 characters"); 
                    if (IsIsConmfirmPassword) {
                        $("#confirmnewpassword").removeClass("is-invalid"); 
                    } else {
                        $("#confirmnewpassword").addClass("is-invalid"); 
                    } 
            } else {
                $("#confirmnewpassword").addClass("is-invalid"); 
            }  
        
         return  (ErrorCount==0) ? true : false;
    }    
</script>
<style>

</style>
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
                                            <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
                                                <div class="card-header pb-1">
                                                    <div class="card-title">
                                                        <h4 class="text-center mb-2">Change Password</h4>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <form action="" method="post" onsubmit="return MemberChangePassword();">
                                                        <input type="hidden"  value="<?php echo $_POST['reqEmail'];?>" name="reqEmail">
                                                        <input type="hidden"  value="<?php echo $_POST['reqID'];?>" name="reqID">
                                                            <div class="form-group mb-50">
                                                                <label class="text-bold-600" for="newpassword">New Password</label>
                                                                <input type="password" class="form-control" name="newpassword" id="newpassword" maxlength="8" placeholder="Enter a new password" value="<?php echo isset($_POST['newpassword']) ? $_POST['newpassword'] : '';?>">
                                                              <!--  <fieldset class="form-group position-relative">
                                                                    <input type="password" class="form-control pwd"  maxlength="8" id="newpassword" name="newpassword" Placeholder="Enter a new password" value="<?php echo (isset($_POST['newpassword']) ? $_POST['newpassword'] : "");?>">
                                                                    <div class="form-control-position" style="top:11px;height: 1rem;">
                                                                        <a href="javascript:void(0)"  onclick="showHidePwd('newpassword',$(this))"><i class="glyphicon glyphicon-eye-close"></i></a>
                                                                    </div>
                                                                </fieldset>-->
                                                                <span class="invalid-feedback" id="Errnewpassword" style="display: block"><?php echo isset($Errnewpassword)? $Errnewpassword : "";?></span>
                                                            </div>
                                                            <div class="form-group mb-50">
                                                                <label class="text-bold-600" for="confirmnewpassword">Confirm New Password</label>
                                                                <input type="password" class="form-control <?php echo isset($errormessage) ? 'is-invalid' : '';?>" name="confirmnewpassword" id="confirmnewpassword" maxlength="8" placeholder="Confirm your new password" value="<?php echo isset($_POST['confirmnewpassword']) ? $_POST['confirmnewpassword'] : '';?>">
                                                               <!-- <fieldset class="form-group position-relative">
                                                                    <input type="password" class="form-control pwd <?php echo isset($errormessage) ? 'is-invalid' : '';?>"  maxlength="8" id="confirmnewpassword" name="confirmnewpassword" Placeholder="Confirm your new password" value="<?php echo (isset($_POST['confirmnewpassword']) ? $_POST['confirmnewpassword'] : "");?>">
                                                                    <div class="form-control-position" style="top:11px;height: 1rem;">
                                                                        <a href="javascript:void(0)"  onclick="showHidePwd('confirmnewpassword',$(this))"><i class="glyphicon glyphicon-eye-close"></i></a>
                                                                    </div>
                                                                </fieldset> -->
                                                                <span class="invalid-feedback" id="Errconfirmnewpassword" style="display: block"><?php echo $errormessage;?></span>
                                                            </div> <br>
                                                            <button type="submit" name="btnResetPassword" class="btn btn-primary glow position-relative w-100">Save my password<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                        </form>
                                                    </div>                                
                                                </div>
                                            </div>
                                        </div>
                                        <!-- right section image -->
                                        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                            <img class="img-fluid" src="<?php echo BaseUrl;?>assets/images/pages/reset-password.png"
                                                alt="branding logo">
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