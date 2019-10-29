<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<body style="margin:0px;">
 <div class="titleBar">Edit Subscribers</div> 
 <style>
 .mytr:hover{background:#f1f1f1;cursor:pointer}
 </style>
<?php 
include_once("../../config.php");
    if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    }

        
        if (isset($_POST{"viewbtn"}))
        {
            $subscriber= new JSubscriber();
            $pageContent = $subscriber->getSubscriber($_POST['rowid']);
       
       ?>
       <table  cellpadding="3" cellspacing="0" width="100%" style="font-size:12px;font-family:'Trebuchet MS';color:#444">
        <tr>
            <td style="width:100px">Subscriber Name</td> 
            <td><?php echo $pageContent[0]['subscribername'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Subscriber Email</td>
            <td><?php echo $pageContent[0]['subscriberemail'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Subscriber Mobile</td>
            <td><?php echo $pageContent[0]['subscribermobile'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Others</td>
            <td><?php echo $pageContent[0]['others'];?></td>
        </tr>
       
       </table>
                <form action='managesubscribers.php' method='post' style='height:0px;'>
                    <input type='hidden' value='<?php echo $pageContent[0]['subscriberid'];?>' name='rowid' id='rowid' >
                    <input type="submit" value="Delete" name="cdeletebtn">  
                    <input style='font-size:11px;' type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managesubscribers.php'"> 
                </form>
                
        
       <?php
       exit;
      }
     
        if(isset($_POST{"cdeletebtn"}))
      {
       $subscriber= new JSubscriber();
       echo $subscriber->deleteSubscriber($_POST['rowid']); 
         ?>
            <script>
                alert("Subscriber Deleted");
                location.href='managesubscribers.php';
            </script>
            <?php
      }
       
    if (isset($_POST{"deletebtn"}))
         {
             $subscriber= new JSubscriber();
             $pageContent =$subscriber->getSubscriber($_POST['rowid']);
       
       ?>
      
       <form action='' method="post">
       <table cellpadding="3" cellspacing="0" width="100%" style="font-size:12px;font-family:'Trebuchet MS';color:#444">
       
        <tr>
            <td style="width:150px">Subscriber Name</td>
            <td><?php echo $pageContent[0]['subscribername'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Subscriber Email</td>
            <td><?php echo $pageContent[0]['subscriberemail'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Subscriber Mobile</td>
            <td><?php echo $pageContent[0]['subscribermobile'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Others</td>
            <td><?php echo $pageContent[0]['others'];?></td>
        </tr>
       </table>
       <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['subscriberid'];?>"> 
       <input type="submit" value="Delete" name="cdeletebtn">
       <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managesubscribers.php'"> 
         </form>
        <?php
       exit;
      }
       
    if (isset($_POST{"updatebtn"}))
         {
            $subscriber= new JSubscriber();
            echo $subscriber->updateSubscriber($_POST['subscribername'],$_POST['subscriberemail'],$_POST['subscribermobile'],$_POST['others'],$_POST['rowid']);
            ?>
            <script>
                alert("Updated Successfully");
                location.href='managesubscribers.php';
            </script>
            <?php
            exit;
         }
          echo "<table  cellspacing='3' cellspadding='0' width='100%' style='font-size:12px;font-family:Trebuchet MS;'>";
          echo "<tr><td>Subscriber Name</td><td>Subscriber Email</td><td>Subscriber Mobile</td></tr>";

    $result=$mysql->select("select * from _jsubscriber");
   
    foreach ($result as $r)
    {
    ?>
    <tr class="mytr">
        <td colspan='5' style="border:1px solid #f1f1f1">
            <form action='' method='post'  >
                <table cellpadding="3" cellspacing="0" width="100%" style="font-size:12px;font-family:'Trebuchet MS';color:#444"> 
                    <tr valign="top">
                        <td style='width:150px;' >
                            <input type="text" value="<?php echo $r["subscribername"];?>" name="subscribername">
                        </td>
                        <td style='width:150px;'>
                            <input type="text" value="<?php echo $r["subscriberemail"];?>" name="subscriberemail">
                        </td>
                        <td style='width:150px;'>
                            <input type="text" value="<?php echo $r["subscribermobile"];?>" name="subscribermobile">
                        </td>
                        <td style='width:150px;'>
                            <input type="text" value="<?php echo $r["others"];?>" name="others">
                        </td>
                        <td>
                            <input type='hidden' value='<?php echo $r["subscriberid"];?>' name='rowid' id='rowid' >
                            <input type='submit' name='viewbtn' value='View'>
                            <input type='submit' name='updatebtn' value='Update'>
                            <input type='submit' name='deletebtn' value='Delete'>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
    <?php
        
    
    }

    
?>
</body>
