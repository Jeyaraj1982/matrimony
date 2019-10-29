<?php 
    
    include_once("../../config.php");
    $obj = new CommonController(); 
    
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    }
  
    if (isset($_POST['rmimage'])) {
        
        if (sizeof($mysql->select("select * from _jphotos where groupid=".$_POST['rowid']))>0) {
            echo $obj->printError("Remove Gallery has been failed. Gallery is Non-Empty.");
        } else {
            $mysql->execute("delete from  _jphotogallery where groupid=".$_POST['rowid']);            
            echo $obj->printSuccess("Gallery Removed Successfully");
        }
    }  
?> 
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">    
 <body style="margin:0px;">
  <div class="titleBar">Manage Photos Group Wise</div>
        <form action="managephotos.php" method="POST" style="height: 20px;" name="managephotoalbums" id="managephotoalbums">
            <table style="margin:10px;width:100%;font-size:12px;font-family:arial;color:#333" cellpadding="3" cellspacing="0" align="center">              
                <tr>
                    <td>Gallery Name</td>
                    <td>
                        <select style="width:250px;" name="groupname" id="groupname" onchange="javascript:window.open('viewphotos.php?groupname='+(this).value,'viewPhotos')">
                            <option value="0">Select Gallery Name</option>
                            <?php foreach(JPhotogallery::getPhotoGalleries() as $gallery) {?>
                            <option value="<?php echo $gallery['groupid'];?>"><?php echo $gallery['groupname'];?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <input type='hidden' value='<?php echo $gallery["groupid"];?>' name='rowid' id='rowid'>
                        <input type="submit" value="Remove Gallery" name="rmimage" id="rmimage">
                    </td> 
                </tr>
            </table>
        </form>
        <script>$('#success').hide(3000);</script> 
        <iframe style="width:100%;height:600px;border:0px;" name="viewPhotos"></iframe>
 </body>

