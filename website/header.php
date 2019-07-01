<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Matrimony Software</title>
            <link rel="stylesheet" href="http://nahami.online/sl/assets/css/style.css">
            <script src="http://nahami.online/sl/assets/vendors/jquery-3.1.1.min.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
            <link href='http://nahami.online/sl/assets/vendors/bootstrap/css/bootstrap.min.css?rnd=<?php echo rand(10,1000);?>' rel='stylesheet' type='text/css'>
           <script src="http://nahami.online/sl/assets/js/app.js?rnd=<?php echo rand(10,1000);?>" type='text/javascript'></script>
        </head>
     <style>
      .navbar{
          border-radius:0px;
      }
     </style>                                                                                                                                                             
    <body>
    <?php
include_once("config.php");
if (isset($_POST['btnsubmit'])) {
   $response = $webservice->Login($_POST);
   if ($response['status']=="success")  {
       $_SESSION['MemberDetails'] = $response['data'];
       ?>
       
        <script>
            location.href='http://nahami.online/sl/Dashboard/';
         </script>
         
       <?php
   } else {
       $loginError=$response['message'];
   }
       ?>
            
       <?php
   }
    
?>
<script>
    function Submitlogin() {
        $('#ErrUserName').html("");
        $('#ErrPassword').html("");
        return IsNonEmpty("UserName","ErrUserName","Please enter login name");
        return IsNonEmpty("Password","ErrPassword","Please enter login password");
    }
</script>
    <div style="height:80px;padding-top:8px;padding-bottom: 15px;padding-left:67px;padding-right:25px">
    <form method="POST" action="" onsubmit="return Submitlogin();">
    <div class="col-sm-12">
           <div class="col-sm-2"><img src=""></div>
           <div class="col-sm-5"></div>
           <div class="col-sm-2" style="margin-right: -42px;margin-left: -10px;">
                <input type="text" id="UserName" name="UserName" placeholder="Login Name" value="<?php echo isset($_POST['UserName']) ? $_POST['UserName'] : '';?>" style="font-size: 15px;line-height: 30px;width: 88%;padding-left:19px;padding-right: 20px;border: 1px solid #ccc;border-radius: 3px;">
                <span class="errorstring" id="ErrUserName"><?php echo isset($ErrUserName)? $ErrUserName : "";?></span>
           </div>
           <div class="col-sm-2" style="margin-right: -42px;">
                <input type="password" name="Password" id="Password" placeholder="Password" value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : '';?>" style="width: 88%;padding-left: 20px;font-size: 15px;line-height: 30px;padding-right: 20px;border: 1px solid #ccc;border-radius: 3px;">
                <span class="errorstring" id="ErrPassword"><?php echo isset($ErrPassword)? $ErrPassword : "";?></span>
           </div>
           <div class="col-sm-1"><button type="submit" class="btn btn-primary" name="btnsubmit" style="background: linear-gradient(to right, rgba(191,50,128,1) 0%, rgba(227,66,90,1) 100%);height: 35px;padding-left: 25px;padding-right: 25px;border: none;" >LOGIN</button></div>
    </div>
    <div class="colo-sm-12">
        <div class="col-sm-7"></div>
        <div class="col-sm-5" style="color:red;margin-left: -11px;"><?php echo $loginError ;?></div>
    </div>
           <div style="float:right;margin-top: 10px;margin-right: 95px;"><a href="forget-password.php">Forgot Password?</a></div>      
       </form>
        </div> 