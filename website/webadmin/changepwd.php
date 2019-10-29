  <html>    
    <body style="margin:0px;">
        <div style='font-family:arial;font-size:13px;border:1px solid #ccc;background:#ccc;padding:3px;font-weight:bold;color:#444;'>Change Password</div>
<?php  
        include_once("../config.php");
         $obj = new CommonController();
             
         if (!($obj->isLogin())){
         echo $obj->printError("Login Session Expired. Please Login Again");
         exit;
         }
           
        if(isset($_POST{"save"})) {
                                          
          if ($obj->isEmptyField($_POST['currpwd']) || $obj->isEmptyField($_POST['newpwd']) || $obj->isEmptyField($_POST['confirmpwd'])) {  
              
              echo $obj->printError("All Fields are Required :");
                                       
          } else {
                if ($_SESSION['USER']['pwd']==trim($_POST['currpwd'])) {
                    
                    if ((trim($_POST['newpwd'])==trim($_POST['confirmpwd'])) && (strlen(trim($_POST['newpwd']))>8) ) {
                        
                       $mysql->execute("update _jusertable set pwd='".trim($_POST['newpwd'])."' where userid=".$_SESSION['USER']['userid']);
                        $_SESSION['USER']['pwd']= trim($_POST['newpwd']);
                        echo $obj->printSuccess("Successfully Changed Password");
                        
                    } else {
                        echo $obj->printError("New Password & Confirm Password should be same and length greather than 8 Characters");
                    }
                    
                } else {
                    echo $obj->printError("Invalid Current Password");
                }
        }                   
}
?>
    <form action="" method="post">
        <table  style="margin:10px;width:100%;font-size:12px;font-family:arial;color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                     <td style="width:150px;">Current Password</td>
                     <td><input type="password" name="currpwd" style="width:200px;"></td> 
               </tr>
               <tr>   
                    <td>New Password</td>
                    <td><input type="password" name="newpwd" style="width:200px;"></td> 
               </tr>
               <tr> 
                    <td>Confirm password</td>
                    <td><input type="password" name="confirmpwd" style="width:200px;"></td> 
               </tr>
               <tr>
                    <td align="left"><input type="submit" name="save" value="Change Password" bgcolor="grey">  
              </tr> 
        </table>
    </form>
</body>
