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


<?php 
    if (isset($_POST['SavePasswordBtn'])) {
        $response = $webservice->getData("Admin","MemberResetPasswordSave",$_POST);
        if ($response['status']=="success") {
             echo "<script>location.href='http://nahami.online/demo/matrimony/Dashboard/ResetPasswordSuccess';</script>";  
        } else {
            echo $response['message']; 
            GetForm();
        }
    } else {
        $response = $webservice->getData("Admin","MemberResetPasswordCheck",array("GUID"=>$_GET['uid'])); 
        if ($response['status']=="success") {
            GetForm();
        } else {
            echo "Invalid access";
        }
    }
      
      
      function GetForm() {
          
          ?>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form action="" method="post">
                <input type="hidden" value="<?php echo $_GET['uid']; ?>" name="uid">
                <h3 class="card-title" style="text-align:center;font-size: 21px;">Reset Password</h3>
                <div style="padding:30px;border:1px solid #888;border-radius:10px;margin-bottom:30px">
                <div class="form-group row">
                    <div class="col-sm-12">Your reset link expired after 24 hours or has already been used</div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12"><small>New Password</small></div>
                    <div class="12"><input class="form-control" type="password" id="NewPassword" name="NewPassword"></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6"><small>Confrim Password</small></div>
                    <div class="12"><input class="form-control" type="password" id="ConfirmNewPassword" name="ConfirmNewPassword"></div>
                </div>
                <?php echo $errormessage;?>
                <div class="form-group row">                                                               
                    <div class="col-sm-6"><button type="submit" name="Cancel" class="btn btn-primary mr-2" style="font-family: roboto;background: transparent;width: 110px;color:blue">Cancel</button></div>
                    <div class="col-sm-6"><button type="submit" name="SavePasswordBtn" class="btn btn-primary mr-2" style="font-family: roboto;width: 110px;" >Reset</button></div>
                </div>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      </div>
     </div>
     <?php }?>
  </body>
</html>
                      