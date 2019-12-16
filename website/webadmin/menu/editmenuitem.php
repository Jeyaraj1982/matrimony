<?php include_once(__DIR__."/../header.php"); ?>

 
<div class="title_Bar">Edit Menu Page</div>
  <?php 
        
             $obj = new CommonController(); 
        
             if (!($obj->isLogin())){
                    echo $obj->printError("Login Session Expired. Please Login Again");
                    exit;
             } 
             if(isset($_POST{"cdeletebtn"})) {
                 MenuItems::deleteMenu($_POST['rowid']);
                 echo CommonController::printSuccess("deleted Successfully");
                 echo "<script>setTimeout(\"window.open('editmenuitem.php','rpanel')\",1500);</script>";  
             }
       
            if (isset($_POST{"deletebtn"})){
                $pageContent = MenuItems::getMenu($_POST['rowid']);
       
       ?>
     
       <form action='' method="post">
       <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
       <tr> 
            <td style="width:150px">Menu Name</td>
            <td><?php echo $pageContent[0]['menuname'];?></td>
        </tr>
        <tr>
            <td>Linked Page To</td>
            <td><?php echo $pageContent[0]['pageid'];?></td> 
        </tr>
        <tr> 
            <td>Menu Position</td>
            <td><?php echo $pageContent[0]['isheader'];?></td>
        </tr>
        <tr> 
           <td> 
                <select name="target">
                    <option value='1' <?php echo ($pageContent[0]["target"]) ? 'selected="selected"' : '';?>>New Page</option>
                    <option value='0' <?php echo ($pageContent[0]["target"]!=1) ? 'selected="selected"' : '';?>>Self</option>
                </select>
            </td>
        </tr>
        <tr> 
            <td>Custom Page Link</td>
            <td><?php echo $pageContent[0]['customurl'];?></td>
        </tr>
       </table>
       <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['menuid'];?>"> 
       <input type="submit" value="Delete" name="cdeletebtn">
       <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='editmenuitem.php'"> 
      </form>
       <?php
       exit;  
        }    ?>
             <table>
             <tr>
             <td style="vertical-align:top;">
             <div style="border:1px solid #e5e5e5"> 
        <?php
         
          echo "<table  cellspacing='3' cellspadding='0' style='font-family:Trebuchet MS;font-size:13px;'>";
          echo "<tr><td>Menu Name</td><td>Menu Type</td><td>Menu Order</td><td>Linked To</td><td>&nbsp;</td></tr>";

  $result=$mysql->select("select * from _jmenu");
  //$r["isheader"]
  ?>
     <tr>
    <td colspan="5" style="background:#ccc;text-align:center">Header</td>
   </tr>

  <?php
   
    foreach ($result as $r) {
        if ($r["isheader"]) {
    ?>
                    <tr class="mytr">
                        <td style='width:150px;'><?php echo $r["menuname"];?></td>
                        <td style='width:150px;'>
                        <?php if ($r['pageid']==0) {
                            echo  $r["customurl"];
                        } else {
                            echo $r['pageid'];
                        }
                        ?>
                        </td>
                        <td style='width:150px;'><?php echo $r["orderf"];?></td>
                        <td style='width:150px;'><?php echo $r["linkedto"];?></td> 
                        <td>
                            <form action='managemenu.php' method='post' target="mrFrame"> 
                                <input type='hidden' value='<?php echo $r["menuid"];?>' name='rowid' id='rowid' >
                                <input type='submit' name='editbtn' id='editbtn' value='Edit'>
                            </form>
                           <!-- <input type='submit' name='deletebtn' value='Delete'> -->
                        </td>
                    </tr>
    <?php }
    }
?>  
   <tr>
    <td colspan="5" style="background:#ccc;text-align:center">Footer</td>
   </tr>
   <?php 
       foreach ($result as $r) {
        if (!($r["isheader"])) {
    ?>
 
                    <tr class="mytr">
                        <td style='width:150px;'><?php echo $r["menuname"];?></td>
                        <td style='width:150px;'>
                        <?php if ($r['pageid']==0) {
                            echo  $r["customurl"];
                        } else {
                            echo $r['pageid'];
                        }
                        ?>
                        </td>
                        <td style='width:150px;'><?php echo $r["orderf"];?></td>
                        <td style='width:150px;'><?php echo $r["linkedto"];?></td>
                        <td>
                            <form action='managemenu.php' method='post' target="mrFrame"> 
                                <input type='hidden' value='<?php echo $r["menuid"];?>' name='rowid' id='rowid' >
                                <input type='submit' name='editbtn' id='editbtn' value='Edit'>
                            </form>
                           <!-- <input type='submit' name='deletebtn' value='Delete'> -->
                        </td>
                    </tr>
 <?php }
    }
?>  
     </table>
     </div>
</td>
<td style="vertical-align:top;">
<!-- mrFrame Menu Right Frame -->
    <iframe src="" name="mrFrame" style="width:450px;height:180px;border:1px solid #e5e5e5;" scrolling="no">
    </iframe>
</td>
</tr>
</table>
</body>