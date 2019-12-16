<?php error_reporting(0);
include_once("../../config.php");
    if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    }
    
$font = $mysql->select("select * from _jfonts where fontid=".$_REQUEST['fontid']);
?>
 <link href='<?php echo $font[0]['fontpath'];?>' rel='stylesheet' type='text/css'>
 <div style="font-family:'<?php echo $font[0]['fontname'];?>'">
 ABCDEFGHIJKLMNOPQRSTUVWXYZ<br>
 abcdefghijklmnopqrstuvwxyz<br>
 0123456789<br>
 </div>
 
        