<!DOCTYPE html>
    <html lang="en">
    <?php
        include_once("config.php");
        if (isset($_POST['btnsubmit'])) {
            $response = $webservice->FLogin($_POST);
            if ($response['status']=="success")  {
                $_SESSION['UserDetails'] = $response['data'];
                echo "<script>location.href='".SiteUrl."';</script>";
            } else {
                $loginError=$response['message'];
            }
        }
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Franchisee Login :: <?php echo SITE_TITLE; ?></title>
        <link rel="stylesheet" href="<?php echo SiteUrl?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="<?php echo SiteUrl?>assets/css/style.css">
        <script src="<?php echo SiteUrl?>assets/vendors/js/vendor.bundle.base.js"></script>
        <script src="<?php echo SiteUrl?>assets/js/misc.js"></script>
        <script src="<?php echo SiteUrl?>assets/js/app.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
        <script>
        
            function SubmitLogin() {     
                
                ErrorCount=0;
                $('#ErrUserName').html("");
                $('#ErrPassword').html("");
                $('#server_error').html("");

                IsNonEmpty("UserName","ErrUserName","Please Enter Valid Login Name");
                IsNonEmpty("Password","ErrPassword","Please Enter Valid Password");
                
                return (ErrorCount==0) ? true : false;
            }
        </script>
        <style>
            .errorstring {font-size:10px;color:red}
        </style>
    </head>
    
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form method="POST" action="" onsubmit="return SubmitLogin();">
                <div class="form-group">
                <div align="center"><h5>Franchisee Login</h5></div>
                  <label class="label">Login Name</label>
                    <input type="text" class="form-control" placeholder="Login Name" name="UserName" id="UserName" value="<?php echo isset($_POST['UserName']) ? $_POST['UserName'] : '';?>">
                     <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span>
                  </div>
                <div class="form-group">
                  <label class="label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="Password" id="Password"  value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : '';?>">
                    <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?></span>
                  </div>
                <div class="form-group">
                  <button ttype="submit" class="btn btn-primary submit-btn btn-block" name="btnsubmit">Login</button>
                  <?php
                      if (isset($status)) {
                          echo'<span class="errorstring" id="server_error">'.$status.'</span>';
                      }
                  ?>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" > Keep me signedin
                    </label>
                  </div>
                  <a href="views/Franchisee/ForgetPassword.php" class="text-small forgot-password text-black">Forgot Password</a>
                </div>
               </form>
            </div>
          </div>
        </div>
      </div>
      </div>
     </div>
  </body>
</html>