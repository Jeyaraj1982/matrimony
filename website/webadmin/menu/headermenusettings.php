<?php include_once(__DIR__."/../header.php"); ?>
<?php 
    //include_once("../../config.php");
    $obj = new CommonController();  
    
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    }
    
    if (isset($_POST['rmimagemenu'])) {
        $mysql->execute("update _jsitesettings set paramvalue='' where param='menubackgroundimage'");
        echo $obj->printSuccess("Image Removed Successfully");
    }
      
    if (isset($_POST['btnSaveSettings']))  {
        
        if ((isset($_FILES['menubackgroundimage']['tmp_name'])) && (strlen(trim($_FILES['menubackgroundimage']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['menubackgroundimage']['name']));
            $target_path  = strtolower("../../assets/".$config['thumb'].$filename); 
                
            if(move_uploaded_file($_FILES['menubackgroundimage']['tmp_name'], $target_path)) {
                 $_POST['param'][24] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload"); 
            }
        }  

        foreach($_POST['param'] as $key=>$value)  {
            
            if(trim($_POST['param'][57])>0) {
                $h=str_replace("'","\\'",$_POST['param'][57]);
                $mysql->execute("update _jsitesettings set paramvalue='".$h."' where settingsid=".$key); 
           } else {
                $sql = "update _jsitesettings set paramvalue='".$value."' where settingsid=".$key;
                $mysql->execute($sql);  
           }
                      
        }
    }
       
    $data=$mysql->select("select * from _jsitesettings");
?>

    <script type="text/javascript" src="<?php echo BaseUrl;?>/../assets/js/jscolor.js"></script>
    <script src="<?php echo BaseUrl;?>/../assets/js/jquery-1.7.2.js"></script>
    <link rel="stylesheet" href="<?php echo BaseUrl;?>/../assets/css/demo.css">
    <link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(" ","+",JFrame::getAppSetting('menufont'));?>' rel='stylesheet' type='text/css'> 
    <style>
        .subMenu {
            
            clear:both;   
            height:<?php echo JFrame::getAppSetting('menu_height');?>px;

            border-left: <?php echo JFrame::getAppSetting('menu_border_left_size');?>px <?php echo JFrame::getAppSetting('menu_border_left_style');?> #<?php echo JFrame::getAppSetting('menu_border_left_color');?>;
            border-right: <?php echo JFrame::getAppSetting('menu_border_right_size');?>px <?php echo JFrame::getAppSetting('menu_border_right_style');?> #<?php echo JFrame::getAppSetting('menu_border_right_color');?>;
            border-top: <?php echo JFrame::getAppSetting('menu_border_top_size');?>px <?php echo JFrame::getAppSetting('menu_border_top_style');?> #<?php echo JFrame::getAppSetting('menu_border_top_color');?>;
            border-bottom: <?php echo JFrame::getAppSetting('menu_border_bottom_size');?>px <?php echo JFrame::getAppSetting('menu_border_bottom_style');?> #<?php echo JFrame::getAppSetting('menu_border_bottom_color');?>;
            border-radius: <?php echo JFrame::getAppSetting('menu_radius_left_top');?><?php echo JFrame::getAppSetting('menu_radius_left_top_scale');?> <?php echo JFrame::getAppSetting('menu_radius_right_top');?><?php echo JFrame::getAppSetting('menu_radius_right_top_scale');?> <?php echo JFrame::getAppSetting('menu_radius_right_bottom');?><?php echo JFrame::getAppSetting('menu_radius_right_bottom_scale');?> <?php echo JFrame::getAppSetting('menu_radius_left_bottom');?><?php echo JFrame::getAppSetting('menu_radius_left_bottom_scale');?>;
            
         
              <?php if (JFrame::getAppSetting('menu_background_image_color_noneed')==0) { ?> 
                    <?php if (strlen(trim(JFrame::getAppSetting('menubackgroundimage')))>0) {?>                 
                        background:url('../../assets/<?php echo $config['thumb'].JFrame::getAppSetting('menubackgroundimage');?>');
                    <?php } ?>
                background-color:#<?php echo JFrame::getAppSetting('menubgcolor');?>;
                <?php } ?>
        }
            
        .sub_Menu {
            
            text-transform: <?php echo JFrame::getAppSetting('menu_text_transform');?>;
            cursor: pointer;
            float: left;
            text-align: left;
            
            color:#<?php echo JFrame::getAppSetting('menufontcolor');?>;
            font-family: '<?php echo JFrame::getAppSetting('menufont');?>';
            font-size:<?php echo JFrame::getAppSetting('menufontsize');?>px;
                
            font-weight:<?php echo JFrame::getAppSetting('menu_font_bold')==1 ? 'bold' : 'none';?>;
            font-style: <?php echo JFrame::getAppSetting('menu_font_italic')==1 ? 'italic' : 'none';?>;
            text-decoration: <?php echo JFrame::getAppSetting('menu_font_underline')==1 ? 'underline' : 'none';?>;
            
            padding-left:<?php echo JFrame::getAppSetting('menu_text_padding_left');?>px;
            padding-right:<?php echo JFrame::getAppSetting('menu_text_padding_right');?>px;
            padding-top:<?php echo JFrame::getAppSetting('menu_text_padding_top');?>px;
            padding-bottom:<?php echo JFrame::getAppSetting('menu_text_padding_bottom');?>px;
                
            <?php if (JFrame::getAppSetting('menu_seperator_need')==1) {?>
                border-right:<?php echo JFrame::getAppSetting('menu_seperator_size'); ?>px solid  #<?php echo JFrame::getAppSetting('menu_seperator_color'); ?>;
            <?php } ?>
        }       
            
        .sub_Menu:hover{
            
             text-transform: <?php echo JFrame::getAppSetting('menu_text_hover_transform');?>;
             
            color:#<?php echo JFrame::getAppSetting('menu_hover_font_color');?>;
            font-family:'<?php echo JFrame::getAppSetting('menufont');?>';
            font-size:'<?php echo JFrame::getAppSetting('menufontsize');?>px';
                
            font-weight:<?php echo JFrame::getAppSetting('menu_hover_font_bold')==1 ? 'bold' : 'none';?>;
            font-style: <?php echo JFrame::getAppSetting('menu_hover_font_italic')==1 ? 'italic' : 'none';?>;
            text-decoration: <?php echo JFrame::getAppSetting('menu_hover_font_underline')==1 ? 'underline' : 'none';?>;
                                
            <?php if (JFrame::getAppSetting('need_menu_hover_backgroundcolor')==1) {?>
                background: #<?php echo JFrame::getAppSetting('menu_hover_backgroundcolor'); ?>;
            <?php } ?>
        }
            
        .title_Bar {background:url(../images/blue/titlebackground.png);padding:5px;color:#6db2bc;font-family:'Trebuchet MS';font-size:13px !important;font-weight: bold;padding:11px !important;}   
        input[type=text],select {border:1px solid #b3d7e2;font-family:'Trebuchet MS';font-size:12px !important;color:#444}
        .color {border:1px solid #b3d7e2;font-family:'Trebuchet MS';font-size:12px !important;color:#444;width:48px;text-align:center}
        table {font-family:'Trebuchet MS';font-size:12px !important;color:#666;width:100%;}
    </style>
    <script>
        function fun_menusperator(v) {
            if (v=="1") {
                $("#param99").removeAttr("disabled"); 
                $("#param100").removeAttr("disabled"); 
                $("#seperatormenu").css("color", "#666");
            } else {
                document.getElementById("param99").setAttribute("disabled", true);
                document.getElementById("param100").setAttribute("disabled", true);
                $("#seperatormenu").css("color", "#999"); 
            }
        }
    </script>
    
    <body style="margin:0px;background:#e3f3f7">
        
        <div class="title_Bar">Header Menu Settings</div> 
        <div style="padding:8px;font-size:13px;font-family:'Trebuchet MS';color:#777;text-align:center;font-weight: bold;">Preview Header Menu</div>
        
        <div style="padding:20px;background:#fff;border:1px solid #b3d7e2;margin: 0px auto;width:90%;">
            <div id="subMenu" class="subMenu">
                <a class="sub_Menu" href='<?php echo JFrame::getAppSetting('siteurl');?>/index.php'>Home</a>
                    <?php foreach(MenuItems::getHeaderMenuItems() as $m) { ?>
                        <a class="sub_Menu" href='javascript:void(0)'><?php echo $m['menuname'];?></a>
                    <?php } ?>
            </div>
        </div>  
    
     <div style="padding:10px">
    
   
        <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
            <table cellpadding="5" cellspacing="0" border="0"> 
            <tr>
                <td><input type="submit" value="Save" name="btnSaveSettings"></td>
                <td colspan="5">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>                
                <td>Menu Height</td>
                <td>
                    <select name="param[91]" style="width:55px">
                       <?php for($i=0;$i<=200;$i++) { ?>
                           <option value="<?php echo $i;?>"  <?php echo ($data[90]['paramvalue']==$i)  ? " selected='selected' " : ""; ?> ><?php echo $i;?>px</option>
                       <?php } ?>
                   </select>
                </td>
                <td>Need Seperator</td>                                
                <td colspan="3">
                    <div id="seperatormenu">
                        <select name="param[98]" onchange="fun_menusperator($(this).val())" style="width:55px">
                            <option value="1" <?php echo ($data[97]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                            <option value="0" <?php echo ($data[97]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Size 
                        <select name="param[99]" id="param99">
                        <?php for ($i=0;$i<=10;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[98]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                        <?php } ?> 
                        </select>
                        Color  <input name="param[100]" id="param100" class="color" value="<?php echo $data[99]['paramvalue'];?>">
                    </div>
                <?php
                       if ($data[97]['paramvalue']==1) {
                           echo "<script>fun_menusperator('1');</script>";
                       }
                ?>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="width:100px">Border Left </td>
                <td style="width:190px"> <!--menu_border_left_size-->
                    <select name="param[71]" style="width:55px">
                    <?php for ($i=0;$i<=10;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[70]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                    </select>&nbsp;
                    <!-- menu_border_left_style-->
                    <select name="param[75]">
                        <option <?php echo ($data[74]['paramvalue']=="solid")  ? " selected='selected' " : ""; ?> >solid</option>
                        <option <?php echo ($data[74]['paramvalue']=="dashed")  ? " selected='selected' " : ""; ?> >dashed</option>
                        <option <?php echo ($data[74]['paramvalue']=="dotted")  ? " selected='selected' " : ""; ?> >dotted</option>
                    </select>&nbsp; 
                    <!-- menu_border_left_color -->
                    <input name="param[79]" class="color" value="<?php echo $data[78]['paramvalue'];?>">
                </td>
                <td style="width:195px">
                    Border Radius [Left Top]
                </td>
                <td style="width:100px">
                    <!-- menu_radius_left_top -->
                    <select name="param[83]" style="width:55px">
                    <?php for ($i=0;$i<=30;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[82]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                    </select>
                    <!-- menu_radius_left_top_scale -->
                     <select name="param[87]">
                        <option value="px" <?php echo ($data[86]['paramvalue']=="px") ? " selected='selected' " : ""; ?> >px</option>
                        <option value="%"  <?php echo ($data[86]['paramvalue']=="%")  ? " selected='selected' " : ""; ?> >%</option>
                    </select>
                </td>
                <td style="width:140px">Text Paddging Left</td>
                <td style="width:100px"> 
                <!-- menu_text_padding_left -->
                                   <select name="param[93]" style="width:55px">
                       <?php for($i=0;$i<=40;$i++) { ?>
                           <option value="<?php echo $i;?>"  <?php echo ($data[92]['paramvalue']==$i)  ? " selected='selected' " : ""; ?> ><?php echo $i;?>px</option>
                       <?php } ?>
                   </select>
                   
                
                </td>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td>Border Right </td>
                <td> <!--menu_border_right_size-->
                    <select name="param[72]" style="width:55px">
                    <?php for ($i=0;$i<=10;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[71]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                       
                    </select>&nbsp;
                    <!-- menu_border_right_style-->
                    <select name="param[76]">
                        <option <?php echo ($data[75]['paramvalue']=="solid")  ? " selected='selected' " : ""; ?> >solid</option>
                        <option <?php echo ($data[75]['paramvalue']=="dashed")  ? " selected='selected' " : ""; ?> >dashed</option>
                        <option <?php echo ($data[75]['paramvalue']=="dotted")  ? " selected='selected' " : ""; ?> >dotted</option>
                    </select>&nbsp;  
                    <!-- menu_border_right_color -->
                    <input name="param[80]" class="color" value="<?php echo $data[79]['paramvalue'];?>">
                </td>
                <td>
                    Border Radius [Right Top]
                </td>
                <td><!-- menu_radius_right_top -->
                    <select name="param[84]" style="width:55px">
                    <?php for ($i=0;$i<=30;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[83]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                        
                    </select>
                    <!-- menu_radius_right_top_scale -->
                     <select name="param[88]">
                        <option value="px" <?php echo ($data[87]['paramvalue']=="px") ? " selected='selected' " : ""; ?> >px</option>
                        <option value="%"  <?php echo ($data[87]['paramvalue']=="%")  ? " selected='selected' " : ""; ?> >%</option>
                    </select>
                </td>
                <td>Text Paddging Right</td>
                <td> <!-- menu_text_padding_right -->
                 
                      <select name="param[94]" style="width:55px">
                       <?php for($i=0;$i<=40;$i++) { ?>
                           <option value="<?php echo $i;?>"  <?php echo ($data[93]['paramvalue']==$i)  ? " selected='selected' " : ""; ?> ><?php echo $i;?>px</option>
                       <?php } ?>
                   </select>
                </td>
                 <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td>Border Top </td>
                <td> <!--menu_border_top_size-->
                    <select name="param[73]" style="width:55px">
                    <?php for ($i=0;$i<=10;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[72]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                       
                    </select>&nbsp;
                    <!-- menu_border_top_style-->
                    <select name="param[77]">
                        <option <?php echo ($data[76]['paramvalue']=="solid")  ? " selected='selected' " : ""; ?> >solid</option>
                        <option <?php echo ($data[76]['paramvalue']=="dashed")  ? " selected='selected' " : ""; ?> >dashed</option>
                        <option <?php echo ($data[76]['paramvalue']=="dotted")  ? " selected='selected' " : ""; ?> >dotted</option>
                    </select>&nbsp;  <!-- menu_border_top_color -->
                    <input name="param[81]" class="color" value="<?php echo $data[80]['paramvalue'];?>">
                </td>
                <td>
                    Border Radius [Left Bottom]
                </td>
                <td><!-- menu_radius_left_bottom -->
                    <select name="param[85]" style="width:55px">
                    <?php for ($i=0;$i<=30;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[84]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                        
                    </select>
                    <!-- menu_radius_left_bottom_scale -->
                     <select name="param[89]">
                        <option value="px" <?php echo ($data[88]['paramvalue']=="px") ? " selected='selected' " : ""; ?> >px</option>
                        <option value="%"  <?php echo ($data[88]['paramvalue']=="%")  ? " selected='selected' " : ""; ?> >%</option>
                    </select>
                </td>
                <td>Text Paddging Top</td>
                <td>
                   <!-- menu_text_padding_top -->
                   <select name="param[95]" style="width:55px">
                       <?php for($i=0;$i<=40;$i++) { ?>
                           <option value="<?php echo $i;?>"  <?php echo ($data[94]['paramvalue']==$i)  ? " selected='selected' " : ""; ?> ><?php echo $i;?>px</option>
                       <?php } ?>
                   </select>
                </td>
                 <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td>Border Bottom </td>
                <td> <!--menu_border_bottom_size-->
                    <select name="param[74]" style="width:55px">
                    <?php for ($i=0;$i<=10;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[73]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                        
                    </select>&nbsp;
                    <!-- menu_border_bottom_style-->
                    <select name="param[78]">
                        <option <?php echo ($data[77]['paramvalue']=="solid")  ? " selected='selected' " : ""; ?> >solid</option>
                        <option <?php echo ($data[77]['paramvalue']=="dashed")  ? " selected='selected' " : ""; ?> >dashed</option>
                        <option <?php echo ($data[77]['paramvalue']=="dotted")  ? " selected='selected' " : ""; ?> >dotted</option>
                    </select>&nbsp;  <!-- menu_border_bottom_color -->
                    <input name="param[82]" class="color" value="<?php echo $data[81]['paramvalue'];?>">
                </td>
                <td>
                    Border Radius [Right Bottom]
                </td>
                <td><!-- menu_radius_right_bottom -->
                    <select name="param[86]" style="width:55px">
                    <?php for ($i=0;$i<=30;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[85]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                         
                    </select>
                    <!-- menu_radius_right_bottom_scale -->
                     <select name="param[90]">
                        <option value="px" <?php echo ($data[89]['paramvalue']=="px") ? " selected='selected' " : ""; ?> >px</option>
                        <option value="%"  <?php echo ($data[89]['paramvalue']=="%")  ? " selected='selected' " : ""; ?> >%</option>
                    </select>
                </td>
                <td>Text Paddging Bottom</td>
                <td> <!-- menu_text_padding_bottom -->
          
                                <select name="param[96]" style="width:55px">
                       <?php for($i=0;$i<=40;$i++) { ?>
                           <option value="<?php echo $i;?>"  <?php echo ($data[95]['paramvalue']==$i)  ? " selected='selected' " : ""; ?> ><?php echo $i;?>px</option>
                       <?php } ?>
                   </select>
                </td>
                 <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                   <td>&nbsp;</td>
                  <td>Remove Background Color & Image</td>
                   
                   <td>    
                    <select name="param[97]" style="width:55px">
                        <option value="0" <?php echo ($data[96]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                        <option value="1" <?php echo ($data[96]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                    </select>
                   
                   </td>
                   <td>&nbsp;</td>
            </tr> 
            
            <tr>
                  <td>BackgroundColor</td>
                  <td><input name="param[43]" class="color" value="<?php echo $data[42]['paramvalue'];?>"></td> 
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
            </tr>   
            <tr>
                    <td style="vertical-align: top;">Background Image</td>
                    <td colspan="5">
                    <?php if (strlen(trim($data[23]['paramvalue']))>0) {?>
                    <img src="../../assets/<?php echo $config['thumb'].$data[23]['paramvalue'];?>" height="100"><br>
                    <input type="submit" value="Remove" name="rmimagemenu">
                    <?php } ?> 
                    <input type="file" class="input" size="30" name="menubackgroundimage"/><br>
                    
                    </td>
                     <td>&nbsp;</td>
                    
                
               </tr>
                
            <tr>
                    <td style="vertical-align: top;">Interface</td>
                    <td style="vertical-align: top;" colspan="2">
                    <table>
                        <tr>
                        <td>
                        <select id="param[36]" name="param[36]" onchange="window.open('loadfont.php?fontid='+this.value,'loadfont')">
                        <?php foreach($mysql->select("select * from _jfonts") as $font) { ?>
                                <option value="<?php echo $font['fontid'];?>" <?php echo ($font['fontid']==$data[35]['paramvalue'])? 'selected="selected"' : '';?>><?php echo $font['fontname'];?></option>
                        <?php } ?>
                            
                        </select>
                        -
                            <select name="param[37]" value="<?php echo $data[36]['paramvalue'];?>">
                            <?php for ($i=8;$i<=30;$i++){ ?>
                            <option value="<?php echo $i;?>"<?php echo ($i==$data[36]['paramvalue']) ? 'selected="selected"' :'';?>><?php echo $i;?></option>
                             <?php  } ?> 
                         </select>
                       -   <input name="param[35]" class="color" value="<?php echo $data[34]['paramvalue'];?>">
                 </td>
                 </tr>
                 <tr>
                 <td>
                    Bold 
                    <select name="param[64]" style="width:55px">
                        <option value="1" <?php echo ($data[63]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                        <option value="0" <?php echo ($data[63]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                    </select>
                    
                     Italic 
                    <select name="param[65]" style="width:55px">
                        <option value="1" <?php echo ($data[64]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                        <option value="0" <?php echo ($data[64]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                    </select>
                    
                    Under-Line 
                    <select name="param[66]" style="width:55px">
                        <option value="1" <?php echo ($data[65]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                        <option value="0" <?php echo ($data[65]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                    </select>
                    
                          
                     </td>
                  
                     </tr>
                     <tr>
                        <td>
                     Transform
                     <select name="param[111]" style="width:112px">
                        <option value="none" <?php echo ($data[110]['paramvalue']=='none') ? " selected='selected' " : ""; ?> >None</option>
                        <option value="uppercase" <?php echo ($data[110]['paramvalue']=='uppercase') ? " selected='selected' " : ""; ?> >Uppercase</option>
                        <option value="lowercase" <?php echo ($data[110]['paramvalue']=='lowercase') ? " selected='selected' " : ""; ?> >Lowercase</option>
                        <option value="capitalize" <?php echo ($data[110]['paramvalue']=='capitalize') ? " selected='selected' " : ""; ?> >Capitalize</option>
                        
                    </select>
                     </td>
                     </tr>
                     </table>
                        
                    </td>
                    <td colspan="3">
                      <iframe src="loadfont.php?fontid=<?php echo $data[35]['paramvalue']; ?>" id="loadfont" name="loadfont" style="height: 80px;width:300px;border:1px solid #f1f1f1;" scrolling="no">
                        </iframe>
                    </td> 
                     <td>&nbsp;</td>
                      
                </tr>
           
                <tr>
                    <td style="vertical-align:top;">Interface Hover</td>
                    <td colspan="2" style="padding-left:0px">
                    <table>
                        <tr>
                            <td width="58px">Text Color</td>
                            <td width="50px"><!-- menu_hover_font_color--><input name="param[45]" class="color" value="<?php echo $data[44]['paramvalue'];?>"></td>
                            <td width="100px">Background Color</td>
                            <td>
                                <select name="param[92]" style="width:55px">
                                    <option value="1" <?php echo ($data[91]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                                    <option value="0" <?php echo ($data[91]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                                </select>
                                <!-- menu_hover_backgroundcolor -->
                                <input name="param[70]" class="color" value="<?php echo $data[69]['paramvalue'];?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                Bold 
                                <select name="param[67]" style="width:55px">
                                    <option value="1" <?php echo ($data[66]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                                    <option value="0" <?php echo ($data[66]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                                </select>
                    
                                Italic 
                                <select name="param[68]" style="width:55px">
                                    <option value="1" <?php echo ($data[67]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                                    <option value="0" <?php echo ($data[67]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                                </select>
                    
                                Under-Line 
                                <select name="param[69]" style="width:55px">
                                    <option value="1" <?php echo ($data[68]['paramvalue']==1) ? " selected='selected' " : ""; ?> >Yes</option>
                                    <option value="0" <?php echo ($data[68]['paramvalue']==0) ? " selected='selected' " : ""; ?> >No</option>
                                </select>
                             </td>
                        </tr>
                        <tr>
                             <td colspan="5">
                                Transform 
                                <select name="param[112]" style="width:112px">
                                    <option value="none" <?php echo ($data[111]['paramvalue']=='none') ? " selected='selected' " : ""; ?> >None</option>
                                    <option value="uppercase" <?php echo ($data[111]['paramvalue']=='uppercase') ? " selected='selected' " : ""; ?> >Uppercase</option>
                                    <option value="lowercase" <?php echo ($data[111]['paramvalue']=='lowercase') ? " selected='selected' " : ""; ?> >Lowercase</option>
                                    <option value="capitalize" <?php echo ($data[111]['paramvalue']=='capitalize') ? " selected='selected' " : ""; ?> >Capitalize</option>
                                </select>
                             </td> 
                        </tr>
                    </table>
                    </td>
                      <td colspan="3">&nbsp;</td>
                     <td>&nbsp;</td>
                </tr>
    </table>
    </form>
    </div>
    
</body>
 