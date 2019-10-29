<html>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">    
    <body style="margin:0px;">
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
       <div class="titleBar">Add Contact</div>
<?php  
        include_once("../../config.php");
          $obj = new CommonController();
            
            if (!($obj->isLogin())){
                echo $obj->printError("Login Session Expired. Please Login Again");
                exit;
            }  
            if(isset($_POST{"save"})) {
                
                $param=array("mobileno"=>$_POST['mobileno'],"email"=>$_POST['email'],"personname"=>$_POST['personname'],"subject"=>$_POST['subject'],"content"=>$_POST['content'],"convtime"=>$_POST['convtime']);
                
                if ($obj->isEmptyField($_POST['personname'])) {
                echo $obj->printError("Name Shouldn't be blank");
                }
                if ($obj->isEmptyField($_POST['mobileno'])) {
                echo $obj->printError("Mobileno Shouldn't be blank");
                } 
                if ($obj->isEmptyField($_POST['email'])) {
                echo $obj->printError("Mobileno Shouldn't be blank");
                } 
                if ($obj->isEmptyField($_POST['subject'])) {
                echo $obj->printError("Subject Shouldn't be blank");
                } 
                if ($obj->isEmptyField($_POST['content'])) {
                echo $obj->printError("Content Shouldn't be blank");
                }  
                if ($obj->isEmptyField($_POST['convtime'])) {
                echo $obj->printError("Convenient Time Shouldn't be blank");
                } 
                
               if ($obj->err==0) {
               echo (JContactus::addContactus($param)>0) ? $obj->printSuccess("Contacts added successfully") : $obj->printError("Error adding Contacts");
          
               }
            }
?>
    <form action="" method="post">
        <table cellpadding="5" cellspacing="0" align="center">
                <tr>
                     <td style="width:150px;">Name</td>
                     <td><input type="text" name="personname" style="width:250px;"></td> 
               </tr>
               <tr>
                     <td>Mobile No.</td>
                     <td><input type="text" name="mobileno" maxlength="10" style="width:250px;"></td> 
               </tr>
               <tr>
                     <td>Email Id.</td>
                     <td><input type="text" name="email" style="width:250px;"></td> 
               </tr>
               <tr>
                     <td>Subject</td>
                     <td><input type="text" name="subject" style="width:250px;"></td> 
               </tr>
               <tr>
                    <td>Content</td>
                    <td><input type="text" name="content" style="width:250px;"></td>
               </tr>
                <tr>
                    <td>Convenient Time</td>
                    <td><input type="text" name="convtime" style="width:250px;"></td>
               </tr>
               <tr>
                    <td align="left"><input type="submit" name="save" value="Save" bgcolor="grey">  
                     <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='viewcontact.php'"></td></td>
              </tr> 
        </table>
    </form>
    <script>$('#success').hide(3000);</script> 
</body>