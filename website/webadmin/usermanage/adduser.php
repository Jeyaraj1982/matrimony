<?php 
    include_once("../../config.php");
    
                if (!(CommonController::isLogin())){
                echo CommonController::printError("Login Session Expired. Please Login Again");
                exit;
            }
  
   if(isset($_POST{"save"})) { 
        
              if(CommonController::isEmptyField($_POST['personname']) || CommonController::isEmptyField($_POST['username'])||CommonController::isEmptyField($_POST['pwd'])) {
                       echo CommonController::printError ("All Fields are Required"); 
                } 
                 
              else if(JUsertable::addUser($_POST['personname'],$_POST['username'],$_POST['pwd'],$_POST['isactive'])>0){
                        echo  CommonController::printSuccess("User added successfully");        
                } else {
                        echo CommonController::printError("Error Adding User"); 
                }                 
  } 
?>                              
<body style="margin:0px;">
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
    <div class="titleBar">New User</div> 
        <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
            <table cellpadding="5" cellspacing="0" align="center">
                <tr>
                    <td style="width:100px">Person Name</td> 
                    <td><input type="text" name="personname" size="40" style="width:250px;"></td> 
                </tr>
                <tr>
                    <td>User Name</td> 
                    <td><input type="text" name="username" size="40" style="width:250px;"></td> 
                </tr>
                 <tr>
                    <td>Password</td> 
                    <td><input type="password" name="pwd" size="40" style="width:250px;"></td> 
                </tr>
                <tr>
                    <td>Is Active</td>
                    <td><select name="isactive"><option value="1">Yes</option><option value="0">No</option></select></td> 
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="save" value="Save" bgcolor="grey">
                    <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='viewuser.php'"></td>
               </tr> 
            </table>
        </form>
</body>
