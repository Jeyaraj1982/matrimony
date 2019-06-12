<!DOCTYPE html>
<html lang="en">
<?php
   define("SiteUrl","http://nahami.online/sl/Dashboard/");
   define("UserRole","Member");
   
   
   function GetUrl($Param) {
       return SiteUrl.$Param;
       return SiteUrl.UserRole."/".$Param;
   }
?>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MemberForget password</title>
  <link rel="stylesheet" href="<?php echo SiteUrl?>vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo SiteUrl?>vendors/iconfonts/puse-icons-feather/feather.css">
  <link rel="stylesheet" href="<?php echo SiteUrl?>vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo SiteUrl?>vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?php echo SiteUrl?>css/style.css">
  <link rel="shortcut icon" href="<?php echo SiteUrl?>images/favicon.png" />
</head>
<style>
                  .otpbox{
                   width:50px;
                   float:Right;
                   text-align: center;
                  
                   border-radius:0px;
               }
</style>
<body>
