<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css"> 
<body style="margin:0px;">   
<?php 
include_once("../../config.php");

    $obj = new CommonController();  
            if (!($obj->isLogin())){
                echo $obj->printError("Login Session Expired. Please Login Again");
                exit;
            }
     
      if (isset($_POST{"viewbtn"})){
           
      $pageContent = JContactus::getContactus($_POST['rowid']);
       ?> 
      <div class="titleBar">View Contact</div>
       <table  style="width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
        <tr>
            <td style="width:150px">Person Name</td> 
            <td><?php echo $pageContent[0]['personname'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Mobile Number</td> 
            <td><?php echo $pageContent[0]['contmob'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Email Address</td> 
            <td><?php echo $pageContent[0]['contemail'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Subject</td> 
            <td><?php echo $pageContent[0]['subject'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Content</td> 
            <td><?php echo $pageContent[0]['content'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Convenient Time</td> 
            <td><?php echo $pageContent[0]['convtime'];?></td>
        </tr>
        <tr>
            <td>PostedOn</td>
            <td><?php echo $pageContent[0]['postedon'];?></td>
        </tr>
       </table>
                <form action='managecontact.php' method='post' style='height:0px;'>
                    <input type='hidden' value='<?php echo $pageContent[0]['contid'];?>' name='rowid' id='rowid' >
                    <input style='font-size:11px;' type='submit' name='editbtn' value='Edit'>
                    <input style='font-size:11px;' type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewcontact.php'"> 
                </form>     
       <?php
       exit;
      }
      if(isset($_POST{"cdeletebtn"})){
          
       $pageContent = JContactus::deleteContactus($_POST['rowid']); 
       echo CommonController::printSuccess("Deleted Successfully");
       echo "<script>setTimeout(\"window.open('viewcontact.php','rpanel')\",1500);</script>"; 
      }
      
      if (isset($_POST{"deletebtn"})){
          
       $pageContent = JContactus::getContactus($_POST['rowid']);
       ?>
      <div class="titleBar">Delete Contact</div>
       <form action='' method="post" >
       <table  style="width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
         <tr>
            <td style="width:150px">Person Name</td> 
            <td><?php echo $pageContent[0]['personname'];?></td>
        </tr>
         <tr>
            <td>Mobile Number</td> 
            <td><?php echo $pageContent[0]['contmob'];?></td>
        </tr>
         <tr>
            <td>Email Address</td> 
            <td><?php echo $pageContent[0]['contemail'];?></td>
        </tr>
         <tr>
            <td>Subject</td> 
            <td><?php echo $pageContent[0]['subject'];?></td>
        </tr>
         <tr>
            <td>Content</td> 
            <td><?php echo $pageContent[0]['content'];?></td>
        </tr>
         <tr>
            <td>Convenient Time</td> 
            <td><?php echo $pageContent[0]['convtime'];?></td>
        </tr>
        <tr>
            <td>PostedOn</td>
            <td><?php echo $pageContent[0]['postedon'];?></td>
        </tr>
       </table>
       <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['contid'];?>"> 
       <input type="submit" value="Delete" name="cdeletebtn">
       <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewcontact.php'"> 
       </form>
       <?php } ?>
</body>
