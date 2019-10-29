<?php error_reporting(0);
     include_once("../../config.php");

     $obj = new CommonController();
    
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    } 

   if (isset($_POST{"update"})) {
       
        /* for Background Image */
        if ((isset($_FILES['backgroundimage']['tmp_name'])) && (strlen(trim($_FILES['backgroundimage']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['backgroundimage']['name']));
            $target_path  = strtolower("../../assets/cms/".$filename); 
                
            if(move_uploaded_file($_FILES['backgroundimage']['tmp_name'], $target_path)) {
                 $_POST['param'][3] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload");
            }
        }  
        
       if ((isset($_FILES['favoriteicon']['tmp_name'])) && (strlen(trim($_FILES['favoriteicon']['tmp_name']))>0)) {
    
           if (in_array($_FILES["favoriteicon"]["type"],$iconimgArray)) {
              
            $filename    = strtolower("_".time()."_".basename($_FILES['favoriteicon']['name']));
            $target_path  = strtolower("../../assets/cms/".$filename); 
                
                if(move_uploaded_file($_FILES['favoriteicon']['tmp_name'], $target_path)) {
                     $_POST['param'][5] = $filename;
                } else {
                    echo $obj->printError("Error: Background File upload"); 
                }
             }else{
                 echo $obj->printError("Please upload .ico Format Image"); 
             }
        }  
        
       if ((isset($_FILES['menubackgroundimage']['tmp_name'])) && (strlen(trim($_FILES['menubackgroundimage']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['menubackgroundimage']['name']));
            $target_path  = strtolower("../../assets/cms/".$filename); 
                
            if(move_uploaded_file($_FILES['menubackgroundimage']['tmp_name'], $target_path)) {
                 $_POST['param'][24] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload"); 
            }
        }  
        
       if ((isset($_FILES['logo']['tmp_name'])) && (strlen(trim($_FILES['logo']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['logo']['name']));
            $target_path  = strtolower("website/data/".$filename); 
                
            if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_path)) {
                 $_POST['param'][25] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload"); 
            }
        }  
        
        if ((isset($_FILES['noimg']['tmp_name'])) && (strlen(trim($_FILES['noimg']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['noimg']['name']));
            $target_path  = strtolower("../../assets/cms/".$filename); 
                
            if(move_uploaded_file($_FILES['noimg']['tmp_name'], $target_path)) {
                 $_POST['param'][30] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload"); 
            }
        }
        
        if ((isset($_FILES['footerbgimage']['tmp_name'])) && (strlen(trim($_FILES['footerbgimage']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['footerbgimage']['name']));
            $target_path  = strtolower("../../assets/cms/".$filename); 
                
            if(move_uploaded_file($_FILES['footerbgimage']['tmp_name'], $target_path)) {
                 $_POST['param'][38] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload"); 
            }
        }
        
         if ((isset($_FILES['headerbgimg']['tmp_name'])) && (strlen(trim($_FILES['headerbgimg']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['headerbgimg']['name']));
            $target_path  = strtolower("../../assets/cms/".$filename); 
                
            if(move_uploaded_file($_FILES['headerbgimg']['tmp_name'], $target_path)) {
                 $_POST['param'][58] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload"); 
            }
        }

                             
       foreach($_POST['param'] as $key=>$value)  {
           
           if(trim($_POST['param'][57])>0){
               
               $h=str_replace("'","\\'",$_POST['param'][57]);
               $tsql = "update _jsitesettings set paramvalue='".$h."' where settingsid=".$key; 
               $mysql->execute($tsql); 
           }else{
                $sql = "update _jsitesettings set paramvalue='".$value."' where settingsid=".$key;
                $mysql->execute($sql);  
           }
                      
       }
        if($obj->err==0){
            echo $obj->printSuccess("Updated Successfully");
        }
          
      } 
      
      if (isset($_POST['rmimage'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='backgroundimage'");
             echo $obj->printSuccess("Image Removed Successfully");
      }
        
      if (isset($_POST['rmimageicon'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='favoriteicon'");
             echo $obj->printSuccess("Image Removed Successfully");
      }
        
      if (isset($_POST['rmimagemenu'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='menubackgroundimage'");
             echo $obj->printSuccess("Image Removed Successfully");
      }
        
      if (isset($_POST['rmimagelogo'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='logo'");
             echo $obj->printSuccess("Image Removed Successfully");
      } 

      if (isset($_POST['rmimagenoimg'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='noimg'");
             echo $obj->printSuccess("Image Removed Successfully");
      }
        
      if (isset($_POST['rmimagefooter'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='footerbgimage'");
             echo $obj->printSuccess("Image Removed Successfully");
      }
      
       if (isset($_POST['rmimageheader'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='headerbgimg'");
             echo $obj->printSuccess("Image Removed Successfully");
      }   
 

    
    $data=$mysql->select("select * from _jsitesettings");
?>
<script src="./../../assets/js/tiny_mce/tiny_mce.js"></script> 
<script type="text/javascript">tinyMCE.init({mode : "specific_textareas",editor_selector : "mceEditor",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
<script type="text/javascript" src="../../assets/js/jscolor.js"></script>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css"> 
<body style="margin:0px;">
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>

    <div class="titleBar">Site Settings</div> 
        <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
            <table cellpadding="3" cellspacing="0" align="center">
                <tr>
                    <td>Site Title</td>
                    <td><input type="text" name="param[1]" value="<?php echo $data[0]['paramvalue'];?>" style="width:154px;"></td> 
                </tr>
                 <tr>
                    <td>Site Name</td>
                    <td><input type="text" name="param[2]" value="<?php echo $data[1]['paramvalue'];?>" style="width:154px;"></td> 
                </tr>
                <tr>
                    <td>Site Url</td>
                    <td><input type="text" name="param[51]" value="<?php echo $data[50]['paramvalue'];?>" style="width:154px;">(Ex:http://localhost/abc)</td> 
                </tr>
                <tr>
                    <td>Logo</td>
                    <td>
                    <?php if (strlen(trim($data[24]['paramvalue']))>0) {?>
                    <img src="../../assets/cms/<?php echo $data[24]['paramvalue'];?>" height="100"><br>
                    <input type="submit" value="Remove" name="rmimagelogo">
                    <?php } ?>
                    <input type="file" class="input" size="30" name="logo"/>
                    </td>

                </tr>
                <tr>
                    <td>Favorite Icon</td>
                    <td>
                    <?php if (strlen(trim($data[4]['paramvalue']))>0) {?>  
                    <img src="../../assets/cms/<?php echo $data[4]['paramvalue'];?>" width="20">
                    <input type="submit" value="Remove" name="rmimageicon">
                    <?php } ?>
                    <input type="file" class="input" name="favoriteicon" size="30"/>
                    </td>
                </tr>
                <tr>
                    <td>Header Background Image</td>
                    <td>
                    <?php if (strlen(trim($data[57]['paramvalue']))>0) {?>
                    <img src="../../assets/cms/<?php echo $data[57]['paramvalue'];?>" height="100"> <br>
                    <input type="submit" value="Remove" name="rmimageheader">
                    <?php } ?>
                    <input type="file" class="input" size="30" name="headerbgimg"/><br>
                    </td>
                  </tr>
                  <tr>
                    <td>Header Background Color</td>
                    <td><input name="param[59]" class="color" value="<?php echo $data[58]['paramvalue'];?>" style="width:60px;"></td> 
                  </tr>
                  <tr>
                     <td>Display Slider Prev/Next Icon</td>
                     <td>
                        <select name="param[60]">
                                <option value='none' <?php echo ($data[59]['paramvalue']=='none') ? 'selected="selected"' : '';?>>none</option>
                                <option value='block' <?php echo ($data[59]['paramvalue']=='block') ? 'selected="selected"' : '';?>>block</option>
                        </select>
                     </td>
                  </tr>
                <tr>
                    <td colspan="4"><hr style="border:none;border-bottom:1px solid #e5e5e5"</td>
               </tr>
                
                <tr>
                    <td> Background Image</td>
                    <td>
                    <?php if (strlen(trim($data[2]['paramvalue']))>0) {?>
                    <img src="../../assets/cms/<?php echo $data[2]['paramvalue'];?>" height="100"> <br>
                    <input type="submit" value="Remove" name="rmimage">
                    <?php } ?>
                    <input type="file" class="input" size="30" name="backgroundimage"/><br>
                    </td>
               </tr>
               <tr>
                     <td>Background Position</td>
                     <td>
                            <select name="param[49]">
                                    <option value='no-repeat' <?php echo ($data[48]['paramvalue']=='no-repeat') ? 'selected="selected"' : '';?>>no-repeat</option>
                                    <option value='repeat-x' <?php echo ($data[48]['paramvalue']=='repeat-x') ? 'selected="selected"' : '';?>>repeat-x</option>
                                    <option value='repeat-y' <?php echo ($data[48]['paramvalue']=='repeat-y') ? 'selected="selected"' : '';?>>repeat-y</option>
                                    <option value='repeat' <?php echo ($data[48]['paramvalue']=='repeat') ? 'selected="selected"' : '';?>>repeat</option>
                            </select>
                     </td>
               </tr>
                <tr>
                    <td> BackgroundColor</td>
                    <td><input name="param[4]" class="color" value="<?php echo $data[3]['paramvalue'];?>" style="width:60px;"></td> 
                </tr>
               
                <tr>   
                    <td colspan="4"><hr style="border:none;border-bottom:1px solid #e5e5e5"</td>
               </tr>
               <tr>
                    <td>Menu Background Image</td>
                    <td>
                    <?php if (strlen(trim($data[23]['paramvalue']))>0) {?>
                    <img src="../../assets/cms/<?php echo $data[23]['paramvalue'];?>" height="100"><br>
                    <input type="submit" value="Remove" name="rmimagemenu">
                    <?php } ?> 
                    <input type="file" class="input" size="30" name="menubackgroundimage"/>
                    </td>
               </tr>
                <tr>
                    <td>Menu BackgroundColor</td>
                    <td><input name="param[43]" class="color" value="<?php echo $data[42]['paramvalue'];?>" style="width:60px;"></td> 
                </tr>
                <tr>
                    <td>Menu Font Family</td>
                    <td>
                        <select id="param[36]" name="param[36]" onchange="window.open('loadfont.php?fontid='+this.value,'loadfont')">
                        <?php foreach($mysql->select("select * from _jfonts") as $font) { ?>
                                <option value="<?php echo $font['fontid'];?>" <?php echo ($font['fontid']==$data[35]['paramvalue'])? 'selected="selected"' : '';?>><?php echo $font['fontname'];?></option>
                        <?php } ?>
                            
                        </select>
                        <br>
                        <iframe src="loadfont.php?fontid=<?php echo $data[35]['paramvalue']; ?>" id="loadfont" name="loadfont" style="height: 100px;width:500px;border:none;" scrolling="no">
                        </iframe>
                    </td>  
                </tr>
                <tr>
                    <td >Menu Font Color</td>
                    <td><input name="param[35]" class="color" value="<?php echo $data[34]['paramvalue'];?>" style="width:60px;"></td> 
                </tr>
                <tr>
                    <td>Menu-Hover</td>
                    <td><input name="param[45]" class="color" value="<?php echo $data[44]['paramvalue'];?>" style="width:60px;"></td>
                    
                </tr>
                <tr>
                    <td>Menu Font Size</td>
                    <td><select name="param[37]" value="<?php echo $data[36]['paramvalue'];?>">
                            <?php for ($i=8;$i<=70;$i++){ ?>
                            <option value="<?php echo $i;?>"<?php echo ($i==$data[36]['paramvalue']) ? 'selected="selected"' :'';?>><?php echo $i;?></option>
                             <?php  } ?> 
                         </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><hr style="border:none;border-bottom:1px solid #e5e5e5"</td>
               </tr>
               <tr>
                    <td>Footer Background Image</td>
                    <td>
                    <?php if (strlen(trim($data[37]['paramvalue']))>0) {?>
                    <img src="../../assets/cms/<?php echo $data[37]['paramvalue'];?>" height="100"><br>
                    <input type="submit" value="Remove" name="rmimagefooter">
                    <?php } ?> 
                    <input type="file" class="input" size="30" name="footerbgimage"/>
                    </td>
               </tr>
                <tr>
                    <td>Footer BackgroundColor</td>
                    <td><input name="param[39]" class="color" value="<?php echo $data[38]['paramvalue'];?>" style="width:60px;"></td> 
                </tr>
                <tr>
                    <td>Footer Font Family</td>
                    <td>
                     
                        <select id="param[41]" name="param[41]" onchange="window.open('loadfont.php?fontid='+this.value,'loadfont1')">
                            <?php foreach($mysql->select("select * from _jfonts") as $font) { ?>
                                    
                                    <option value="<?php echo $font['fontid'];?>" <?php echo ($font['fontid']==$data[40]['paramvalue']) ? 'selected="selected"' : '';?>><?php echo $font['fontname'] ;?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <iframe src="loadfont.php?fontid=<?php echo $data[40]['paramvalue']; ?>" id="loadfont1" name="loadfont1" style="height: 100px;width:500px;border:none;" scrolling="no">
                        </iframe>
                    </td> 
                </tr>
                <tr>
                    <td >Footer Font Color</td>
                    <td><input name="param[40]" class="color" value="<?php echo $data[39]['paramvalue'];?>" style="width:60px;"></td>
                </tr>
                <tr>
                    <td>Footer-Hover</td>
                    <td><input name="param[46]" class="color" value="<?php echo $data[45]['paramvalue'];?>" style="width:60px;"></td> 
                </tr>
                <tr>
                    <td>Footer Font Size</td>
                    <td><select name="param[42]" value="<?php echo $data[41]['paramvalue'];?>">
                    <?php for ($i=8;$i<=70;$i++){ ?>
                     <option value="<?php echo $i;?>" <?php echo ($i==$data[41]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?></option>
                     <?php   }      ?> 
                     </select>
                     </td>
                    
                </tr>
                <tr>
                    <td >Footer Banner</td>
                    <td><input name="param[55]" class="color" value="<?php echo $data[54]['paramvalue'];?>" style="width:60px;"></td>
                </tr>
                <tr>
                    <td colspan="4"><hr style="border:none;border-bottom:1px solid #e5e5e5"</td>
               </tr>

                <tr>
                    <td>Default No Image</td>
                    <td>
                    <?php if (strlen(trim($data[29]['paramvalue']))>0) {?> 
                    <img src="../../assets/cms/<?php echo $data[29]['paramvalue'];?>" height="100"><br>
                    <input type="submit" value="Remove" name="rmimagenoimg">
                    <?php } ?>
                    <input type="file" class="input" size="30" name="noimg"/>
                    </td>
                    
               </tr>
               <tr>
                    <td colspan="4"><hr style="border:none;border-bottom:1px solid #e5e5e5"</td>
               </tr>
               <tr>
                     <td>Is Enable Contact</td>
                     <td>
                            <select name="param[27]">
                                    <option value='1' <?php echo $data[26]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                    <option value='0' <?php echo ($data[26]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                            </select>
                     </td>
               </tr>
               <tr>
                    <td>Linked Page To</td>
                    <td>
                        <select style="width:250px;" name="param[47]">
                            <?php foreach(JPages::getPages() as $page) {?>
                            <option value="<?php echo $page['pageid'];?>" <?php echo ($page['pageid']==$data[46]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $page['pagetitle'];?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Email To</td>
                    <td><input type="text" name="param[48]" id="emailto" value="<?php echo $data[47]['paramvalue'];?>" style="width:100px;"></td> 
                </tr>
               <tr>
                    <td colspan="4"><hr style="border:none;border-bottom:1px solid #e5e5e5"></td>
               </tr>
               
                <tr>
                     <td>Is Enable Video</td>
                     <td>
                     <select name="param[6]">
                                <option value='1' <?php echo $data[5]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[5]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
                     <td>Is Enable Subscribers</td>
                     <td>
                      <select name="param[13]">
                                <option value='1' <?php echo $data[12]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[12]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
               </tr>
               <tr>
                     <td>Is Enable Photo</td>
                     <td>
                     <select name="param[7]">
                                <option value='1' <?php echo $data[6]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[6]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
                     <td>Is Enable News</td>
                     <td>
                      <select name="param[14]">
                                <option value='1' <?php echo $data[13]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[13]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td>  
               </tr>
               <tr>
                     <td>Is Enable Music</td>
                     <td>
                     <select name="param[8]">
                                <option value='1' <?php echo $data[7]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[7]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td>
                     <td>Is Enable Events</td>
                     <td>
                      <select name="param[15]">
                                <option value='1' <?php echo $data[14]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[14]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td>  
               </tr>
               <tr>
                     <td>Is Enable Downloads</td>
                     <td>
                     <select name="param[9]">
                                <option value='1' <?php echo $data[8]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[8]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
                     <td>Is Enable Product</td>
                     <td>
                     <select name="param[26]">
                                <option value='1' <?php echo $data[25]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[25]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
               </tr>
               </tr>
               <tr>
                     <td>Is Enable Faq</td>
                     <td>
                      <select name="param[10]">
                                <option value='1' <?php echo $data[9]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[9]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td>
                     <td>Is Enable Map</td>
                     <td>
                     <select name="param[28]">
                                <option value='1' <?php echo $data[27]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[27]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
                      
               </tr>
               <tr>
                     <td style="width:150px;">Is Enable SuccessStory</td>
                     <td>
                     <select name="param[11]">
                                <option value='1' <?php echo $data[10]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[10]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td>
                     <td>Is Enable Testimonials</td>
                     <td>
                     <select name="param[12]">
                                <option value='1' <?php echo $data[11]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[11]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
               </tr>
               
               <tr>
                    <td>Facebook Url</td>
                    <td><input type="text" name="param[16]" size="40" style="width:150px;" value="<?php echo $data[15]['paramvalue'];?>"></td> 
               </tr>
                <tr>
                    <td>Twitter Url</td>
                    <td><input type="text" name="param[17]" size="40" style="width:150px;" value="<?php echo $data[16]['paramvalue'];?>"></td> 
                </tr>
                <tr>
                    <td>Youtube Url</td>
                    <td><input type="text" name="param[18]" size="40" style="width:150px;" value="<?php echo $data[17]['paramvalue'];?>"></td> 
                </tr>
                <tr>
                    <td>GooglePlus Url</td>
                    <td><input type="text" name="param[19]" size="40" style="width:150px;" value="<?php echo $data[18]['paramvalue'];?>"></td> 
                </tr>
                <tr>
                     <td>Share page</td>
                     <td>
                     <select name="param[20]">
                                <option value='1' <?php echo $data[19]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[19]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
               </tr>
                <tr>
                     <td>Share page Size</td>
                     <td>
                     <select name="param[50]">
                                <option value='large' <?php echo $data[49]['paramvalue'] ? 'selected="selected"' : '';?>>large</option>
                                <option value='small' <?php echo ($data[49]['paramvalue']!=1) ? 'selected="selected"' : '';?>>small</option>
                     </select>
                     </td> 
               </tr>
               <tr>
                     <td>Google Translator</td>
                     <td>
                     <select name="param[21]">
                                <option value='1' <?php echo $data[20]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                <option value='0' <?php echo ($data[20]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                     </select>
                     </td> 
               </tr>
               <tr>
                    <td>Meta Tag</td>
                    <td><input type="text" name="param[22]" size="40" style="width:154px;" value="<?php echo $data[21]['paramvalue'];?>"></td> 
               </tr>
               <tr>
                     <td>Meta Description</td>
                     <td><textarea cols="28" rows="7" name="param[23]"><?php echo $data[22]['paramvalue'];?></textarea></td> 
               </tr>
               
                
               <tr>
                     <td>Map Coding</td>
                     <td><textarea cols="28" rows="7" name="param[29]"><?php echo $data[28]['paramvalue'];?></textarea></td> 
               </tr>

               <tr>
                    <td>No.of News per Page</td>
                    <td><select name="param[31]" value="<?php echo $data[30]['paramvalue'];?>">
                            <?php for ($i=1;$i<=50;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[30]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?></option>
                             <?php   } ?> 
                        </select>
                     </td>
               </tr>
               <tr>
                    <td>No.of Events per Page</td>
                    <td><select name="param[32]" value="<?php echo $data[31]['paramvalue'];?>">
                            <?php for ($i=1;$i<=50;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[31]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?></option>
                             <?php   } ?> 
                        </select>
                     </td> 
               </tr>
               <tr>
                    <td>No.of Success Story per Page</td>
                    <td><select name="param[33]" value="<?php echo $data[32]['paramvalue'];?>">
                            <?php for ($i=1;$i<=50;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[32]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?></option>
                             <?php   } ?> 
                        </select>
                     </td> 
               </tr>
               <tr>
                    <td>No.of Testimonial per Page</td>
                    <td><select name="param[34]" value="<?php echo $data[33]['paramvalue'];?>">
                            <?php for ($i=1;$i<=50;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[33]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?></option>
                             <?php   } ?> 
                        </select>
                     </td> 
               </tr>
               <tr>
                    <td>Layout</td>
                    <td>
                        <table>
                            <tr>
                                <td><input type="radio" name="param[44]"  value="1" <?php echo ($data[43]['paramvalue']==1) ? 'checked="checked"' : '';?>></td>
                                <td><input type="radio" name="param[44]"  value="2" <?php echo ($data[43]['paramvalue']==2) ? 'checked="checked"' : '';?>></td>
                                <td><input type="radio" name="param[44]"  value="3" <?php echo ($data[43]['paramvalue']==3) ? 'checked="checked"' : '';?>></td>
                            </tr>
                            <tr>
                                <td><img src="../../assets/images/layout_right.png"></td>
                                <td><img src="../../assets/images/layout_left.png"></td>
                                <td><img src="../../assets/images/layout_full.png"></td>
                            </tr>
                        </table>
                    </td>
               </tr>
               <tr>
                     <td>Display ContactUs On Homepage</td>
                     <td>
                            <select name="param[56]">
                                    <option value='1' <?php echo $data[55]['paramvalue'] ? 'selected="selected"' : '';?>>Yes</option>
                                    <option value='0' <?php echo ($data[55]['paramvalue']!=1) ? 'selected="selected"' : '';?>>No</option>
                            </select>
                     </td>
               </tr>
               <tr>
                    <td>Display ContactUs</td>
                    <td><textarea class="mceEditor" style="height: 350px;width:100%" name="param[57]"><?php echo $data[56]['paramvalue'];?></textarea></td> 
               </tr>
               <tr>
                    <td align="left">
                        <input type="submit" name="update" value="Update" bgcolor="grey"> 
                    </td>
               </tr>
            </table>

        </form>
        
</body>