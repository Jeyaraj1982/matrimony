<html>    
    <body style="margin:0px;">
        <div style='font-family:arial;font-size:13px;border:1px solid #ccc;background:#ccc;padding:3px;font-weight:bold;color:#444;'>Add Contact</div>
<?php 
    
        
          $obj = new CommonController();
            
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
        <table  style="margin:10px;width:100%;font-size:12px;font-family:arial;color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                     <td style="width:150px;">Name</td>
                     <td><input type="text" name="personname" style="width:250px;"></td> 
               </tr>
               <tr>
                     <td style="width:150px;">Mobile No.</td>
                     <td><input type="text" name="mobileno" style="width:250px;"></td> 
               </tr>
               <tr>
                     <td style="width:150px;">Email Id.</td>
                     <td><input type="text" name="email" style="width:250px;"></td> 
               </tr>
               <tr>
                     <td style="width:150px;">Subject</td>
                     <td><input type="text" name="subject" style="width:250px;"></td> 
               </tr>
               <tr>
                    <td style="width:150px;">Content</td>
                    <td><input type="text" name="content" style="width:250px;"></td>
               </tr>
                <tr>
                    <td style="width:150px;">Convenient Time</td>
                    <td><input type="text" name="convtime" style="width:250px;"></td>
               </tr>
               <tr>
                    <td align="left"><input type="submit" name="save" value="Save" bgcolor="grey">  
              </tr> 
        </table>
    </form>
    <script>$('#success').hide(3000);</script>  
</body>