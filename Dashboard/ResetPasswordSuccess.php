<!DOCTYPE html>
<?php include_once("config.php");?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Reset Password</title>
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/app.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form action="" method="post">
                <h3 class="card-title" style="text-align:center;font-size: 21px;">Reset Password</h3>
                <div style="padding:30px;border:1px solid #888;border-radius:10px;margin-bottom:30px">
                <div class="form-group row">
                    <div class="col-sm-12">Your reset password changed successfuly</div>
                </div>
                <div class="form-group row">                                                               
                    <div class="col-sm-12" style="text-align:center"><a href="<?php echo SiteUrl;?>?action=logout&redirect=AdminLogin" class="btn btn-primary mr-2" style="font-family: roboto;background: transparent;width: 110px;color:blue">Login Now</a></div>
                </div>
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
                      