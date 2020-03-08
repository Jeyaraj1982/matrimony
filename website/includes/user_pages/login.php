<?php
    if (isset($_POST['login'])) {
        include_once(application_config_path);
        $response = $webservice->getData("Member","Login",$_POST); 
        if ($response['status']=="success")  {
            $_SESSION['MemberDetails'] = $response['data'];
            echo "<script>location.href='".SiteUrl."';</script>";
        } else {
            $loginError=$response['message'];
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
  function FacebookSignup() {
            location.href = 'lib/services/signup/fb3/fblogin.php';
    }

  
    function GoogleSignup() {
        window.open('lib/services/signup/google/googlelogin.php', "_self");
    }
  $(document).ready(function () {
      $("#UserName").blur(function () {
        var IsUserName= IsNonEmpty("UserName","ErrUserName","Please Enter Member ID / Registered Email"); 
        if (IsUserName) {
             $("#UserName").removeClass("is-invalid"); 
        } else {
            $("#UserName").addClass("is-invalid"); 
        }
      });  
      $("#Password").blur(function () {
        var IsPassword= IsNonEmpty("Password","ErrPassword","Please Enter Password"); 
        if (IsPassword) {
             $("#Password").removeClass("is-invalid"); 
        } else {
            $("#Password").addClass("is-invalid"); 
        }
      }); 
   });
    function MemberLogin() {
        
        $('#ErrUserName').html("");
        $('#ErrPassword').html("");
        $("#UserName").removeClass("is-invalid"); 
        $("#Password").removeClass("is-invalid"); 
        ErrorCount=0;
        
        var IsUserName= IsNonEmpty("UserName","ErrUserName","Please Enter Member ID / Registered Email");
        if (IsUserName) {
             $("#UserName").removeClass("is-invalid"); 
        } else {
            $("#UserName").addClass("is-invalid"); 
        }
        
        var IsPassword= IsNonEmpty("Password","ErrPassword","Please Enter Password"); 
        if (IsPassword) {
             $("#Password").removeClass("is-invalid"); 
        } else {
            $("#Password").addClass("is-invalid"); 
        }
        
        return  (ErrorCount==0) ? true : false;
    }    
</script>
<script type="text/javascript">
        window.onbeforeunload = function () {
            var inputs = document.getElementsByTagName("button");
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type == "button" || inputs[i].type == "submit") {
                    inputs[i].disabled = true;
                }
            }
        };
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
                                    <!-- left section-login -->
                                        <div class="col-md-6 col-12 px-0">
                                            <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                                <div class="card-header pb-1">
                                                    <div class="card-title">
                                                        <h4 class="text-center mb-2">Member Login</h4>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="d-flex flex-md-row flex-column justify-content-around">
                                                        <?php if(WebConfig::GOOGLE_SIGN_IN_REQUIRED == 1) { ?>                                          
                                                            <a href="javascript:GoogleSignup()" class="btn btn-social btn-google btn-block font-small-3  mb-md-0 mb-1 <?php echo (WebConfig::FACEBOOK_SIGN_IN_REQUIRED == 1) ? "mr-md-1 " : ""; ?>">
                                                                <i class="bx bxl-google font-medium-3"></i><span class="pl-50 d-block text-center">Google</span></a>
                                                        <?php } if (WebConfig::FACEBOOK_SIGN_IN_REQUIRED == 1) {?>
                                                            <a href="javascript:FacebookSignup()" class="btn btn-social btn-block mt-0 btn-facebook font-small-3">
                                                                <i class="bx bxl-facebook-square font-medium-3"></i><span class="pl-50 d-block text-center">Facebook</span></a>
                                                        <?php } ?>
                                                        </div>
                                                        <?php if(WebConfig::GOOGLE_SIGN_IN_REQUIRED == 1 || WebConfig::FACEBOOK_SIGN_IN_REQUIRED == 1) { ?>
                                                        <div class="divider">
                                                            <div class="divider-text text-uppercase text-muted"><small>or login with
                                                                    email</small>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <form action="" method="post" onsubmit="return MemberLogin();">     
                                                        <input type="hidden" value="<?php echo isset($_GET['email']) ? $_GET['email'] : "";?>" name="email">
                                                            <div class="form-group mb-50">
                                                                <label class="text-bold-600" for="UserName">Member ID / Registered Email</label>
                                                                <input type="text" class="form-control <?php echo isset($loginError) ? 'is-invalid' : '';?>" id="UserName" name="UserName" placeholder="Member ID / Registered Email" value="<?php echo isset($_POST['UserName']) ? $_POST['UserName'] : '';?>">
                                                                <span class="invalid-feedback" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-bold-600" for="Password">Password</label>
                                                                <input type="password" class="form-control <?php echo isset($loginError) ? 'is-invalid' : '';?>" id="Password" name="Password" placeholder="Password" value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : '';?>">
                                                                <span class="invalid-feedback" id="ErrPassword"><?php echo $loginError;?></span>
                                                            </div>  
                                                            <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                                <div class="text-left">
                                                                    <div class="checkbox checkbox-sm">
                                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                                        <label class="checkboxsmall" for="exampleCheck1"><small>Keep me logged in</small></label>
                                                                    </div>
                                                                </div>
                                                                <div class="text-right"><a href="forget-password" class="card-link"><small>Forgot Password?</small></a></div>
                                                            </div>
                                                            
                                                            <button type="submit" class="btn btn-primary glow w-100 position-relative" name="login">Sign in<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                        </form >
                                                        <hr>
                                                        <div  class="text-center"><small class="mr-25">Don't have an account?</small><a href="register"><small>Sign up</small></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- right section image -->
                                        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                            <div class="card-content">
                                                <img class="img-fluid" src="<?php echo BaseUrl;?>assets/images/pages/login.png" alt="branding logo">
                                            </div>
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