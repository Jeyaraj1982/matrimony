 <script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css"> 
  <body style="margin:0px;">
    <?php 
        include_once("../../config.php");
            if (!(CommonController::isLogin())){
                echo CommonController::printError("Login Session Expired. Please Login Again");
                exit;
            }

            if (isset($_POST{"updatebtn"})) {
             $user= new JUsertable();
                 echo $user->updateUser($_POST['personname'],$_POST['username'],$_POST['pwd'],$_POST['isactive'],$_POST['rowid']);
             ?>
                <script>
                    alert("Updated Successfully");
                    location.href='viewuser.php';
                </script>
            <?php
            exit;
         }

      if (isset($_POST{"editbtn"})) {
           $user = new JUsertable();
           $pageContent = $user->getUser($_POST['rowid']);

       ?>
   <div class="titleBar">Edit User</div>
    <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
    <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['userid'];?>">
        <table cellpadding="5" cellspacing="0" align="center" style="font-family:'Trebuchet MS';font-size:12px;color:#222;width:100%">
            <tr>
                <td style="width:100px">Person Name</td> 
                <td><input type="text" name="personname" size="40" style="width:250px;" value="<?php echo $pageContent[0]['personname'];?>"><br></td> 
            </tr>
            <tr>
                <td>User Name</td> 
                <td><input type="text" name="username" size="40" style="width:250px;" value="<?php echo $pageContent[0]['uname'];?>"><br></td> 
            </tr>
            <tr>
                <td>Password</td> 
                <td><input type="password" name="pwd" size="40" style="width:250px;" value="<?php echo $pageContent[0]['pwd'];?>"><br></td> 
            </tr>
            <tr>
                <td>Is Active</td>  
                <td> <select name="isactive">
                <option value='1' <?php echo ($pageContent[0]['isactive']==1) ? "selected='selected'" : "";?>>Active</option>
                <option value='0' <?php echo ($pageContent[0]['isactive']==0) ? "selected='selected'" : "";?>>In Active</option>
                </select>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="updatebtn" value="Update" bgcolor="grey">
                <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewuser.php'"> 
                </td>
            </tr>
        </table>
    </form>
     <?php
       exit;
      }
      
      if (isset($_POST{"viewbtn"})){
       $pageContent = JUsertable::getUser($_POST['rowid']);
       
       ?>
       
     <div class="titleBar">View User</div>
       <table cellpadding="5" cellspacing="0" align="center" style="font-family:'Trebuchet MS';font-size:12px;color:#222;width:100%">
       <tr>
            <td style="width:150px">User Transcation Id</td>
            <td><?php echo $pageContent[0]['userid'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Person Name</td>
            <td><?php echo $pageContent[0]['personname'];?></td>
        </tr>
        <tr>
            <td style="width:150px">User Name</td>
            <td><?php echo $pageContent[0]['uname'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Password</td>
            <td><?php echo $pageContent[0]['pwd'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Created On</td>
            <td><?php echo $pageContent[0]['createdon'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Is Active</td>  
            <td> <?php if ($pageContent[0]["isactive"]==1) {?>
                    <span style='color:#08912A;font-weight:bold;'>Active</span> 
                <?php } else { ?>
                    <span style='color:#FF090D;font-weight:bold;'>In Active</span> 
                <?php } ?>
            </td>
        </tr>
       
       </table>
                <form action='viewuser.php' method='post' style='height:0px;'>
                    <input type='hidden' value='<?php echo $pageContent[0]['userid'];?>' name='rowid' id='rowid' >
                    <input style='font-size:11px;' type='submit' name='editbtn' value='Edit'>
                    <input style='font-size:11px;' type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewuser.php'"> 
                </form>
                
        
       <?php
       exit;
      }
                   
?>
</body>
