<?php 
    include_once("../../config.php");
    $obj = new CommonController();  
    
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    }
    
    if (isset($_POST['btnSaveSettings']))  {

        foreach($_POST['param'] as $key=>$value)  {
            $mysql->execute("update _jsitesettings set paramvalue='".$value."' where settingsid=".$key);  
        }
    }
       
    $data=$mysql->select("select * from _jsitesettings");
?>

    <script type="text/javascript" src="../../assets/js/jscolor.js"></script>
    <script src="./../../assets/js/jquery-1.7.2.js"></script>
    <link rel="stylesheet" href="./../../assets/css/demo.css">
    <style>
        .title_Bar {background:url(../images/blue/titlebackground.png);padding:5px;color:#6db2bc;font-family:'Trebuchet MS';font-size:13px !important;font-weight: bold;padding:11px !important;}   
        input[type=text],select {border:1px solid #b3d7e2;font-family:'Trebuchet MS';font-size:12px !important;color:#444}
        .color {border:1px solid #b3d7e2;font-family:'Trebuchet MS';font-size:12px !important;color:#444;width:48px;text-align:center}
        table {font-family:'Trebuchet MS';font-size:12px !important;color:#666;width:100%;}
    </style>

    <body style="margin:0px;background:#e3f3f7">
        <div class="title_Bar">Video Page Settings</div> 
        <div style="padding:10px">
            <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
                <table cellpadding="5" cellspacing="0" border="0" style="width:auto"> 
                    <tr>
                        <td><input type="submit" value="Save" name="btnSaveSettings"></td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Video Height </td>
                        <td>
                            <!-- video_page_video_height -->
                            <input type="text" style="width:60px" maxlength="3" name="param[123]" value="<?php echo $data[122]['paramvalue'];?>"><select><option>px</option></select>
                        </td>
                        <td>Video Width</td>
                        <td><input type="text" style="width:60px" maxlength="3" name="param[124]"  value="<?php echo $data[123]['paramvalue'];?>"><select><option>px</option></select> </td>
                    </tr>
                    <tr>
                        <td>Click To Play</td>
                        <td>
                            <!-- video_page_clicktoplay -->
                            <select name="param[126]" style="width:55px">
                                <option value="1" <?php echo ($data[125]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                                <option value="0" <?php echo ($data[125]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                            </select>
                        </td>
                        <td>Link Open For</td>
                        <td>
                            <!-- video_page_clicktoplay -->
                            <select name="param[127]" style="width:55px">
                                <option value="1" <?php echo ($data[126]['paramvalue']==1) ? " selected='selected' " : ""; ?> >New Tab</option>
                                <option value="0" <?php echo ($data[126]['paramvalue']==0) ? " selected='selected' " : ""; ?> >Self Page</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                    </tr>
                    <tr>
                        <td colspan="4"><textarea cols="" rows=""></textarea></td>
                    </tr>
                </table>
            </form>
        </div>
    </body> 