 
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
        <div class="title_Bar">Slider Settings</div> 
        <div style="padding:10px">
            <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
                <table cellpadding="5" cellspacing="0" border="0" style="width:auto"> 
                    <tr>
                        <td><input type="submit" value="Save" name="btnSaveSettings"></td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Show Slider</td>
                        <td>
                            <!-- showslider -->
                            <select name="param[117]" style="width:55px">
                                <option value="1" <?php echo ($data[116]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                                <option value="0" <?php echo ($data[116]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                            </select>
                        </td>
                        <td>Slider Height</td>
                        <td>
                            <!-- slider_height -->
                            <input type="text" name="param[118]" value="<?php echo $data[117]['paramvalue'];?>" style="width:55px">px
                        </td>
                    </tr>
                    <tr>
                        <td style="width:150px">Border Left </td>
                        <td style="width:150px"> 
                            <!--slider_border_left_size-->
                            <select name="param[103]" style="width:55px">
                                <?php for ($i=0;$i<=10;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[102]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                                <?php } ?> 
                            </select>  
                            <!-- slider_border_left_color -->
                            <input name="param[107]" class="color" value="<?php echo $data[106]['paramvalue'];?>">
                        </td>
                        <td style="width:175px">Border Radius [Left Top]</td>
                        <td style="width:190px">
                            <!-- slider_border_radius_left -->
                            <select name="param[113]" style="width:55px">
                            <?php for ($i=0;$i<=100;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[112]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                            <?php } ?> 
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Border Right </td>
                        <td> 
                            <!--slider_border_right_size-->
                            <select name="param[104]" style="width:55px">
                                <?php for ($i=0;$i<=10;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[103]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                                <?php } ?> 
                            </select> 
                            <!-- slider_border_right_color -->
                            <input name="param[108]" class="color" value="<?php echo $data[107]['paramvalue'];?>">
                        </td>
                        <td>Border Radius [Right Top]</td>
                        <td>
                            <!-- slider_border_radius_right_top -->
                            <select name="param[114]" style="width:55px">
                                <?php for ($i=0;$i<=100;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[113]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                                <?php } ?> 
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Border Top </td>
                        <td> 
                            <!--slider_border_top_size-->
                            <select name="param[101]" style="width:55px">
                                <?php for ($i=0;$i<=10;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[100]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                                <?php } ?> 
                            </select> 
                            <!-- slider_border_top_color -->
                            <input name="param[105]" class="color" value="<?php echo $data[104]['paramvalue'];?>">
                        </td>
                        <td>Border Radius [Left Bottom]</td>
                        <td>
                            <!-- slider_border_radius_left_bottom -->                    
                            <select name="param[115]" style="width:55px">
                                <?php for ($i=0;$i<=100;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[114]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                                <?php } ?> 
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Border Bottom </td>
                        <td> 
                            <!--slider_border_bottom_size-->
                            <select name="param[102]" style="width:55px">
                                <?php for ($i=0;$i<=10;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[101]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                                <?php } ?> 
                            </select>
                            <!-- slider_border_bottom_color -->
                            <input name="param[106]" class="color" value="<?php echo $data[105]['paramvalue'];?>">
                        </td>
                        <td>Border Radius [Right Bottom]</td>
                        <td>
                            <!-- slider_border_radius_right_bottom -->
                            <select name="param[116]" style="width:55px">
                                <?php for ($i=0;$i<=100;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[115]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                                <?php } ?> 
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Slider Top Space</td>
                        <td>
                            <!-- slider_top_space -->
                            <select name="param[109]" style="width:55px">
                                <?php for ($i=0;$i<=50;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[108]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                                <?php } ?> 
                            </select>
                        </td>
                        <td>Slider Bottom Space</td>
                        <td>
                            <!-- slider_bottom_space -->
                            <select name="param[110]" style="width:55px">
                            <?php for ($i=0;$i<=50;$i++){ ?>
                                <option value="<?php echo $i;?>" <?php echo ($i==$data[109]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                            <?php } ?> 
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Top Space Background</td>
                        <td>
                            <!-- slider_top_space_need_color -->
                            <select name="param[119]" style="width:55px">
                                <option value="1" <?php echo ($data[118]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                                <option value="0" <?php echo ($data[118]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                            </select>
                            <!-- slider_top_space_color -->
                            <input name="param[120]" class="color" value="<?php echo $data[119]['paramvalue'];?>">
                        </td>
                        <td>Bottom Space Background</td>
                        <td>
                            <!-- slider_bottom_space_need_color -->
                            <select name="param[121]" style="width:55px">
                                <option value="1" <?php echo ($data[120]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                                <option value="0" <?php echo ($data[120]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                            </select>
                            <!-- slider_bottom_space_color -->
                            <input name="param[122]" class="color" value="<?php echo $data[121]['paramvalue'];?>">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body> 