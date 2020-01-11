<?php include_once(__DIR__."/../header.php");
     

     $obj = new CommonController();
    
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    } 

   if (isset($_POST{"update"})) {
       
        /* for Background Image */
        if ((isset($_FILES['backgroundimage']['tmp_name'])) && (strlen(trim($_FILES['backgroundimage']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['backgroundimage']['name']));
            $target_path  = strtolower(__DIR__."/../../assets/".$config['thumb'].$filename); 
                
            if(move_uploaded_file($_FILES['backgroundimage']['tmp_name'], $target_path)) {
                 $_POST['param'][3] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload");
            }
        }  
        
       if ((isset($_FILES['favoriteicon']['tmp_name'])) && (strlen(trim($_FILES['favoriteicon']['tmp_name']))>0)) {
    
           if (in_array($_FILES["favoriteicon"]["type"],$iconimgArray)) {
              
            $filename    = strtolower("_".time()."_".basename($_FILES['favoriteicon']['name']));
            $target_path  = strtolower(__DIR__."/../../assets/".$config['thumb'].$filename); 
                
                if(move_uploaded_file($_FILES['favoriteicon']['tmp_name'], $target_path)) {
                     $_POST['param'][5] = $filename;
                } else {
                    echo $obj->printError("Error: Background File upload"); 
                }
             }else{
                 echo $obj->printError("Please upload .ico Format Image"); 
             }
        }  
 
        
       if ((isset($_FILES['logo']['tmp_name'])) && (strlen(trim($_FILES['logo']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['logo']['name']));
            $target_path  = strtolower(__DIR__."/../../assets/".$config['thumb'].$filename); 
                
            if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_path)) {
                 $_POST['param'][25] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload"); 
            }
        }  
        
        if ((isset($_FILES['noimg']['tmp_name'])) && (strlen(trim($_FILES['noimg']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['noimg']['name']));
            $target_path  = strtolower(__DIR__."/../../assets/".$config['thumb'].$filename); 
                
            if(move_uploaded_file($_FILES['noimg']['tmp_name'], $target_path)) {
                 $_POST['param'][30] = $filename;
            } else {
                echo $obj->printError("Error: Background File upload"); 
            }
        }
        
   
        
         if ((isset($_FILES['headerbgimg']['tmp_name'])) && (strlen(trim($_FILES['headerbgimg']['tmp_name']))>0)) {
            
            $filename    = strtolower("_".time()."_".basename($_FILES['headerbgimg']['name']));
            $target_path  = strtolower(__DIR__."/../../assets/".$config['thumb'].$filename); 
                
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
        
     
 
        
      if (isset($_POST['rmimagelogo'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='logo'");
             echo $obj->printSuccess("Image Removed Successfully");
      } 

      if (isset($_POST['rmimagenoimg'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='noimg'");
             echo $obj->printSuccess("Image Removed Successfully");
      }
        
   
      
       if (isset($_POST['rmimageheader'])) {
             $mysql->execute("update _jsitesettings set paramvalue='' where param='headerbgimg'");
             echo $obj->printSuccess("Image Removed Successfully");
      }   
 

    
    $data=$mysql->select("select * from _jsitesettings");
?>
 
 
<script type="text/javascript" src="<?php echo BaseUrl;?>//assets/js/jscolor.js"></script>
<script src="<?php echo BaseUrl;?>/assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="<?php echo BaseUrl;?>//assets/css/demo.css"> 
<body style="margin:0px;">
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>

    <div class="titleBar">Header Settings</div> 
        <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
            <table cellpadding="3" cellspacing="0" align="center">
                 
                <tr>
                    <td>Logo</td>
                    <td>
                    <?php if (strlen(trim($data[24]['paramvalue']))>0) {?>
                    <img src="<?php echo BaseUrl;?>/<?php echo $config['thumb'].$data[24]['paramvalue'];?>"><br>
                    <input type="submit" value="Remove" name="rmimagelogo">
                    <?php } ?>
                    <input type="file" class="input" size="30" name="logo"/>
                    </td>
                </tr>
                <tr>
                    <td>Padding</td>
                    <td >
                        Right
                        <!-- header_logo_padding_right -->
                       <select name="param[129]" style="width:55px">
                    <?php for ($i=0;$i<=50;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[128]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                    </select>&nbsp;
                        Left
                        <!-- header_logo_padding_left -->
                       <select name="param[130]" style="width:55px">
                    <?php for ($i=0;$i<=50;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[129]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                    </select>&nbsp;
                    <!-- header_logo_padding_top -->
                       Top
                    <select name="param[131]" style="width:55px">
                    <?php for ($i=0;$i<=50;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[130]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                    </select>&nbsp;
                       Bottom
                       <!-- header_logo_padding_bottom-->
                     <select name="param[132]" style="width:55px">
                    <?php for ($i=0;$i<=50;$i++){ ?>
                             <option value="<?php echo $i;?>" <?php echo ($i==$data[131]['paramvalue'])? 'selected="selected"' :'';?>><?php echo $i;?>px</option>
                     <?php } ?> 
                    </select> 
                        
                    </td>
                </tr>    
                <tr>
                    <td>Header Background Image</td>
                    <td>
                    <?php if (strlen(trim($data[57]['paramvalue']))>0) {?>
                    <img src="../../assets/<?php echo $config['thumb'].$data[57]['paramvalue'];?>" height="100"> <br>
                    <input type="submit" value="Remove" name="rmimageheader">
                    <?php } ?>
                    <input type="file" class="input" size="30" name="headerbgimg"/><br>
                    </td>
                  </tr>
                   <tr>
                    <td>Header Background Image</td>
                    <td>
                    <!-- header_background_repeat-->
                       <select name="param[133]"   >
                            <option value="no-repeat" <?php echo ($data[132]['paramvalue']=="no-repeat") ? " selected='selected' " : ""; ?> >no-repeat</option>
                            <option value="repeat" <?php echo ($data[132]['paramvalue']=="repeat") ? " selected='selected' " : ""; ?> >repeat</option>
                            <option value="repeat-x" <?php echo ($data[132]['paramvalue']=="repeat-x") ? " selected='selected' " : ""; ?> >repeat-x</option>
                            <option value="repeat-y" <?php echo ($data[132]['paramvalue']=="repeat-y") ? " selected='selected' " : ""; ?> >repeat-y</option>
                        </select>
                    </td>
                    </tr>
                  <tr>
                  
                    <td>Header Background Color</td>
                    <td><input name="param[59]" class="color" value="<?php echo $data[58]['paramvalue'];?>" style="width:60px;"></td> 
                  </tr>
                  <tr>
                    <td>Hide Header Background Image & Color</td>
                    <td>
                        <select name="param[61]">
                            <option value="0" <?php echo ($data[60]['paramvalue']==0) ? "selected='selected'" : ""; ?>>No</option>
                            <option value="1" <?php echo ($data[60]['paramvalue']==1) ? "selected='selected'" : ""; ?>>Yes</option>
                        </select> 
                        
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Header Height</td>
                    <td><input name="param[62]"  value="<?php echo $data[61]['paramvalue'];?>" style="width:60px;">px</td> 
                  </tr>
                  
                          <tr>
                    <td>Show Header </td>
                    <td>
                        <select name="param[63]">
                            <option value="0" <?php echo ($data[62]['paramvalue']==0) ? "selected='selected'" : ""; ?>>No</option>
                            <option value="1" <?php echo ($data[62]['paramvalue']==1) ? "selected='selected'" : ""; ?>>Yes</option>
                        </select> 
                        
                    </td>
                  </tr>
                  
                  
                
                <tr>
                    <td colspan="4"><hr style="border:none;border-bottom:1px solid #e5e5e5"</td>
               </tr>
                
                    
               <tr>
                    <td align="left">
                        <input type="submit" name="update" value="Update" bgcolor="grey"> 
                    </td>
               </tr>
            </table>

        </form>
        
</body>