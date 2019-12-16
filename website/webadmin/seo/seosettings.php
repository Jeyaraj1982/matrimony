<?php include_once("../header.php"); ?>

<div class="title_Bar">Search Engine Option (SEO)</div> 

<?php

    $obj = new CommonController();
    
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    }
    
    if (isset($_POST{"update"})) { 
       
       foreach($_POST['param'] as $key=>$value)  {
           $sql = "update _jsitesettings set paramvalue='".$value."' where settingsid=".$key;
           $mysql->execute($sql);
       }
       
       if($obj->err==0) {   
           echo $obj->printSuccess("Updated Successfully");
       }
    }      
    
    $data=$mysql->select("select * from _jsitesettings"); 
?>

<div style="padding:10px;font-family:arial;font-size:14px;color:#333;font-family:'Trebuchet MS';">
    SEO has become widely adopted as an online marketing strategy because of its effectiveness.<br><br>
    
    <form action="" method="post"  enctype="multipart/form-data">
        <table style="width:100%;font-size:14px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
            <tr>
                <td style="width:100px;vertical-align:top;padding-left:0px">Description</td>
                <td style="font-size:12px;color:#666">
                    <textarea style="height:60px;width:100%;" name="param[52]"><?php echo $data[51]['paramvalue'];?></textarea>
                    <b>Note:</b> recommand Maximum length 250 Charactors to get best results on search engines.
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;padding-left:0px">Keywords</td>
                <td style="font-size:12px;color:#666">
                    <textarea style="height:60px;width:100%;" name="param[53]"><?php echo $data[52]['paramvalue'];?></textarea>
                    <b>Note:</b> Seperated By Commas (,)
                </td> 
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;padding-right:6px"><input type="submit" name="update" value="Update" class="submitbtnblue"></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:13px"><br>
                    &nbsp;&nbsp;<b>Search Engline Result looks like bellow</b><bR><br>
                    <div style="background:#fff;padding:5px;border:1px solid #ccc">
                        <div style="padding:10px;width:630px">
                            <div style="color:#1a0dab;font-family:arial;font-weight:bold;font-size:17px"><?php echo JFrame::getAppSetting('sitetitle');?></div>
                            <div style="color:#006621;font-family:arial;font-size:13px"><?php echo $_SITEPATH;?>&nbsp;&nbsp;<span class='arrow-down'></span></div>
                            <div style="color:#545454;font-family:arial;font-size:small"><?php echo substr($data[51]['paramvalue'],0,255);?></div>
                        </div>
                    </div> 
                </td>
            </tr>
        </table>
    </form> 
</div>