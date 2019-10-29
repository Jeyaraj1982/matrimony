 <body style="margin:0px;">
    <div style='font-family:arial;font-size:13px;border:1px solid #ccc;background:#ccc;padding:3px;font-weight:bold;color:#444;'>Manage Customize</div>
 <style>
 .mytr:hover{background:#f1f1f1;cursor:pointer}
 </style>
<?php 
    error_reporting(0);
        include_once("../../config.php");
             if (!(CommonController::isLogin())){
                    echo CommonController::printError("Login Session Expired. Please Login Again");
                    exit;
             }
        
        if(isset($_POST{"cdeletebtn"})){
            $slider = new JCustomize();
            echo $slider->deleteCustomize($_POST['rowid']); 
         ?>
            <script>
                alert("Customize Deleted");
                location.href='managecustomize.php';
            </script>
         <?php
      }
       
    if (isset($_POST{"deletebtn"}))
         {
             $slider= new JCustomize();
             $pageContent =$slider->getCustomize($_POST['rowid']);
       
       ?>
      
      <form action='' method="post">
       <table>
        <tr>
            <td style="width:150px">Event Date</td>
            <td><?php echo $pageContent[0]['edate'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Description Tamil</td>
            <td><?php echo $pageContent[0]['descT'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Description English</td>
            <td><?php echo $pageContent[0]['descE'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Description Malayalam</td>
            <td><?php echo $pageContent[0]['descM'];?></td>
        </tr>
        <tr>
            <td style="width:150px">Event Category</td>
            <td><?php echo $pageContent[0]['eventcate'];?></td>
        </tr>
       </table>
            <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['eventid'];?>"> 
            <input type="submit" value="Delete" name="cdeletebtn">
            <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managecustomize.php'"> 
      </form>
        <?php
       exit;
      }
    
       
    if (isset($_POST{"updatebtn"}))
         {
            $slider= new JCustomize();
            echo $slider->updateCustomize($_POST['datepicker'],$_POST['desctamil'],$_POST['descenglish'],$_POST['descmal'],$_POST['eventcate'],$_POST['rowid']);
            ?>
            <script>
                alert("Updated Successfully");
                location.href='managecustomize.php';
            </script>
            <?php
            exit;
         }
          echo "<table cellpadding='3' cellspacing='0' width='100%' style='font-size:12px;font-family:arial;color:#444'>";
          echo "<tr><td>Event Date</td><td>Description Tamil</td><td>Description English</td><td>Description Malayalam</td><td>Event Category </td><td>&nbsp;</td></tr>";

    $result=$mysql->select("select * from _jdayevent");
   
    foreach ($result as $r)
    {
    ?>
    <tr class="mytr">
        <td colspan='5' style="border:1px solid #f1f1f1">
            <form action='' method='post'  >
                <table cellpadding="3" cellspacing="0" width="100%" style="font-size:12px;font-family:arial;color:#444"> 
                    <tr>
                        <tr valign="top">
                        <td style='width:150px;' >
                            <input type="text" value="<?php echo $r["edate"];?>" name="datepicker"> 
                        </td>
                        <td style='width:150px;' >
                            <input type="text" value="<?php echo $r["descT"];?>" name="desctamil"> 
                        </td>
                        <td style='width:150px;'>
                            <input type="text" value="<?php echo $r["descE"];?>" name="descenglish"> 
                        </td>
                        <td style='width:150px;'>
                            <input type="text" value="<?php echo $r["descM"];?>" name="descmal"> 
                        </td>
                        <td style='width:150px;'> 
                            <select name="eventcate">
                                <option value='1' <?php echo ($r["eventcate"]) ? 'selected="selected"' : '';?>>X</option>
                                <option value='2' <?php echo ($r["eventcate"]!=1) ? 'selected="selected"' : '';?>>Y</option>
                            </select>
                        </td>
                        <td style='width:150px;'>
                            <input type='hidden' value='<?php echo $r["eventid"];?>' name='rowid' id='rowid' >
                            <input type='submit' name='updatebtn' value='Update'>
                            <input type='submit' name='deletebtn' value='Delete'>
                        </td>
                    </tr>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
    <?php
        
    
    }
  
?>
</body>
