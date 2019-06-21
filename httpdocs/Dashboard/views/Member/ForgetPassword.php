<!DOCTYPE html>
<html lang="en">
<?php
        include_once("../../config.php");
     
        if (isset($_POST['UserName']))  {
            //echo "select * from _tbl_franchisees_staffs where LoginName='".trim($_POST['UserName'])."' or EmailID='".trim($_POST['UserName'])."'";
            $res = $mysql->select("select * from _tbl_members where MemberLogin='".trim($_POST['UserName'])."' or EmailID='".trim($_POST['UserName'])."'");
            if(sizeof($res)>0) {
                if ($res[0]['IsActive']==1) {
                    $resDetails = $mysql->select("select * from _tbl_members where MemberID='".$res[0]['MemberID']."'");
                    $_SESSION['rDetails'] = $res[0];
                    $_SESSION['OTP']=rand(1000,9999);
                    $mail2 = new MailController();
                     $mail2->MemberForgetPassword(array("mailTo"     => $res[0]['EmailID'] ,
                                                        "MemberName" => $res[0]['MemberName'],
                                                        "code"       => $_SESSION['OTP']));
                    header("Location:http://nahami.online/sl/Dashboard/views/Member/FpwdOTP.php");
                } else {
                     $status = "Couldn't process. account may be suspended";
                }
            } else {
                $status = "Invaild Login Name or Registered Email Address";
            }
        }                                     
    ?>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Franchisee Login</title>
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/assets/vendors/iconfonts/puse-icons-feather/feather.css">
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/assets/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="http://nahami.online/sl/Dashboard/assets/css/style.css">
  <link rel="shortcut icon" href="http://nahami.online/sl/Dashboard/assets/images/favicon.png" />
  <script src="http://nahami.online/sl/Dashboard/assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="http://nahami.online/sl/Dashboard/assets/vendors/js/vendor.bundle.addons.js"></script>
  <script src="http://nahami.online/sl/Dashboard/assets/js/off-canvas.js"></script>
  <script src="http://nahami.online/sl/Dashboard/assets/js/hoverable-collapse.html"></script>
  <script src="http://nahami.online/sl/Dashboard/assets/js/misc.js"></script>
  <script src="http://nahami.online/sl/Dashboard/assets/js/settings.html"></script>
  <script src="http://nahami.online/sl/Dashboard/assets/js/todolist.html"></script>
  <script src="http://nahami.online/sl/Dashboard/assets/js/app.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
</head>
<script>
$(document).ready(function () {
   $("#UserName").blur(function () {
        IsNonEmpty("UserName","ErrUserName","Please Enter Email ID");
   });
});

function SubmitEmail() {
                         $('#ErrUserName').html("");
                         
                         ErrorCount=0;
        
                        if (IsNonEmpty("UserName","ErrUserName","Please Enter Login Name or Email Address")){
                            //IsEmail("UserName","ErrUserName","Please Enter Valid Email Ar");
                        }
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;                           
                        }
                 
  }
</script>
<style>
.errorstring {font-size:10px;color:red}
</style>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
             <form method="POST" action="" onsubmit="return SubmitEmail();">
                <div class="form-group">
                <div align="center"><h5>Forget Password</h5></div>
                  <div class="input-group">
                    <small>Please provide your Login Name or Registered Email Address, we'll send an security code to your email address for reset your password.</small>
                  </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Login Name / Registered Email Address" id="UserName" name="UserName" value="<?php echo isset($_POST['UserName']) ? $_POST['UserName'] : '';?>" >
                 <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary submit-btn btn-block">Submit</button>
                  <?php
                      if (isset($status)) {
                          echo'<span class="errorstring" id="server_error">'.$status.'</span>';
                      }
                  ?> 
                </div>
                <hr>
                <div class="form-group d-flex justify-content-between">
                  <a href="../../FranchiseeLogin.php" class="text-small forgot-password text-black">Back to SignIn</a>
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
         

