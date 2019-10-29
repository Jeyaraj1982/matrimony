Welcome
<?php 

    //include_once("../config.php");
    
 
     $msg = "";
    if (isset($_POST['loginbtn'])) {
    
          $record = $mysql->select("select * from _jusertable where uname='".trim($_POST['uname'])."' and pwd='".trim($_POST['upass'])."' and isactive=1");
          if (sizeof($record)>0) {
            $_SESSION['USER'] = $record[0];
            echo "<script>location.href='dashboard.php';</script>";
          } else {
              $msg = "Invalid Login Details";
          }
    }  
?>
<body style="margin:0px;"> 
 <form action="" method="post">
 <div style="margin:0px auto;margin-top:250px;border:1px solid #ccc;border-radius:5px;width:400px;padding:10px;">
 <table align="center" cellpadding="5" cellspacing="0" style="font-size:12px;color:#666;font-family:'Trebuchet MS';width:100%">
    <tr>
        <td colspan="2" style="font-size:16px;color:orange;font-family:'Trebuchet MS';font-weight: bold;;">
            <b>JFrame</b> <span style="color:#666;font-size:14px;">Login</span>
            <hr style="border:none;border-bottom:1px solid #e5e5e5">
        </td>
    </tr>
    <tr>
        <td><img src="http://milanacademy.org/images/login_icon.gif" style="width: 120px;"></td>
        <td>
         <table align="center" cellpadding="5" cellspacing="0" style="font-size:12px;color:#666;font-family:'Trebuchet MS'">
    <tr>
        <td>User Name</td>
        <td><input type="text" name="uname" id="uname" style="font-size:11px;color:#666;font-family:'Trebuchet MS';border:1px solid #e5e5e5;padding:2px;"></td>
    </tr>                                   
    <tr>
        <td>Password</td>
        <td><input type="password" name="upass" id="upass" style="font-size:11px;color:#666;font-family:'Trebuchet MS';border:1px solid #e5e5e5;padding:2px;"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value=" " name="loginbtn" style="cursor:pointer;border: medium none; background: url('http://png-3.findicons.com/files/icons/2017/free_button/40/login.png') repeat scroll 0px 0px transparent; width: 40px; height: 19px;" id="loginbtn"></td>
    </tr>
    <?php if (strlen(trim($msg))>0) { ?>
    <tr>
        <td colspan="2">
            <?php //echo CommonController::printError($msg);
        ?></td>
    </tr>        
    <?php } ?>
 </table>
        </td>
       
    </tr>                                   
  
 </table>
 </div>
 </form>
 <div style="font-size:10px;color:#666;font-family:'Trebuchet MS';text-align:center;">
 
 </div>
</body>  
