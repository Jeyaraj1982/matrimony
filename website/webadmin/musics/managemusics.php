 <?php
 
    include_once("../../config.php");
    $obj = new CommonController();
     
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    }
     
    if(isset($_POST['rmimage'])){
        
        if(sizeof($mysql->select("select * from _jmusics where albumid=".$_POST['rowid']))>0){
                echo $obj->printError("Remove Album has been failed. Album is Non-Empty.");
        }else{
            $mysql->execute("delete from _jalbum where albumid=".$_POST['rowid']);            
            echo $obj->printSuccess("Albums Removed Successfully");  
        }
    }
?>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css"> 
 <body style="margin:0px;">
 <div class="titleBar">Manage Musics Album Wise</div>   
    <form action="managemusics.php" method="POST" name="managemusicalbum" id="managemusicalbum">
            <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                 <tr>
                    <td>Album Name</td>
                    <td><select style="width:250px;" name="albumid" id="albumid" onchange="javascript:window.open('viewmusics.php?albumid='+(this).value,'viewPhotos')">
                        <option value="0">Select Album Name</option>
                        <?php foreach(JMusics::getMusicAlbum() as $album) {?>
                        <option value="<?php echo $album['albumid'];?>"><?php echo $album['albumtit'];?></option>
                        <?php }?></select>
                    </td> 
                    <td>
                        <input type='hidden' value='<?php echo $album["albumid"];?>' name='rowid' id='rowid'>
                        <input type="submit" value="Remove Album" name="rmimage" id="rmimage">
                    </td>
                 </tr>
            </table>
        </form>
        <script>$('#success').hide(3000);</script> 
         <iframe style="width:100%;height:600px;border:0px;" name="viewPhotos">
        
        </iframe>
</body>

