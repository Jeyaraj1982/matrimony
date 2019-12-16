<?php include_once(__DIR__."/../header.php"); ?>

<div class="title_Bar">Edit Page</div> 
<?php 
//include_once("../../config.php");



      if(isset($_POST{"deletebtn"})){
          
       $pageContent = JPages::deletePage($_POST['rowid']); 
       echo CommonController::printSuccess("Deleted Successfully");
       echo "<script>setTimeout(\"window.open('viewpages.php','rpanel')\",1500);</script>"; 
      
      }

    $obj = new CommonController();  
            if (!($obj->isLogin())){
                echo $obj->printError("Login Session Expired. Please Login Again");
                exit;
            }
    
    if (isset($_POST['rmimage'])) {
        $mysql->execute("update _jpages set filepath='' where pageid=".$_POST['rowid']);
        echo $obj->printSuccess("Image Removed Successfully");
        $_POST{"editbtn"}="editbtn";
    }

     if(isset($_POST{"updatebtn"})) {
         
         $param = array("pageid"=>$_POST['rowid'],
         "pagetitle"=>$_POST['pagetitle'],
         "pagedescription"=>$_POST['pagedescription'],
         "ispublish"=>$_POST['ispublished'],"ishomepage"=>
         $_POST['ishomepage'],""=>$_POST['noofvisit'],
         "keywords"=>$_POST['keywords'],
         "description"=>$_POST['desc']);
         
         if ($obj->isEmptyField($_POST['pagetitle'])) {
             echo $obj->printError("Page Title Shouldn't be blank");
         }
       //  if ( (isset($_FILES["filepath"]["tmp_name"])) && (strlen(trim($_FILES["filepath"]["tmp_name"]))>0)) {
        //    $obj->fileUpload($_FILES['filepath'],"../../assets/".$config['thumb'],$config['imageArray'],$config['imgMaxSize'],$param["filename"]);
       //  }   
           
         if ($obj->err==0) {
             JPages::updatePage($param);
            echo  $obj->printSuccess("Page Updated  Successfully");
             //echo (JPages::updatePage($param)>0) ? $obj->printSuccess("Page Updated  Successfully") : $obj->printError("Error Updating Page");
         }else {
            echo $obj->printErrors();
        }
        
         $_POST{"editbtn"}="editbtn";       
      
     } 
     
     $pageContent = JPages::getPages($_POST['rowid']);
     
     $purl =  $_SITEPATH."pages/".$pageContent[0]['pagefilename'].".html";
    // $purl =  $_SITEPATH."/index.php?page=".$pageContent[0]['pageid'];
    
    ?>
       
<script src="<?php echo BaseUrl;?>assets/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">tinyMCE.init({mode : "specific_textareas",editor_selector : "mceEditor",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
 
 
    <form action="" method="post" style="height: 20px;"  enctype="multipart/form-data">
        <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['pageid'];?>">
        <table cellpadding="5" cellspacing="0" align="center" style="width:100%;font-size:14px;font-family:'Trebuchet MS';color:#333">
            <tr>
                <td style="width:80px">Page Url</td>
                 
                <td><?php echo $purl;?></td> 
            </tr>
            <tr>
                <td style="width:60px">Page Title</td> 
                <td><input type="text" name="pagetitle" style="width:100%;" value="<?php echo $pageContent[0]['pagetitle'];?>"><br></td> 
            </tr>
            <tr>
                <td colspan="2"><textarea class="mceEditor" name="pagedescription" style="height: 350px;width:100%"><?php echo $pageContent[0]['pagedescription'];?></textarea></td>
            </tr> 
              <tr>
                <td>Short Description</td>
                <td><textarea  style="height:60px;width:100%;" name="desc"><?php echo $pageContent[0]['description'];?></textarea></td>
            </tr>
            <tr>
                <td>Search Keywords</td>
                <td><textarea  style="height:60px;width:100%;" name="keywords"><?php echo $pageContent[0]['keywords'];?></textarea></td>
            </tr>
            <tr>
                <td>Is Publish?</td> 
                <td>
                   <select name="ispublished">
                        <option value='1' <?php echo ($pageContent[0]["ispublish"]) ? 'selected="selected"' : '';?>>Yes</option>
                        <option value='0' <?php echo ($pageContent[0]["ispublish"]!=1) ? 'selected="selected"' : '';?>>No</option>
                   </select>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                   Is HomePage? 
                   <select name="ishomepage">
                        <option value='1' <?php echo ($pageContent[0]["ishomepage"]) ? 'selected="selected"' : '';?>>Yes</option>
                        <option value='0' <?php echo ($pageContent[0]["ishomepage"]!=1) ? 'selected="selected"' : '';?>>No</option>
                   </select>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                   No.of Visit: <?php echo $pageContent[0]['noofvisit'];?>
                   &nbsp;&nbsp;&nbsp;&nbsp;
                   PostedOn: <?php echo $pageContent[0]['postedon'];?>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table>
                      <!--  <tr>
                            <td style="font-size:12px;"><b>Thumb Image:</b></td>
                        </tr>-->
                        <tr>
                            <!--<td style="text-align:left;">
                                <?php if (strlen(trim($pageContent[0]['filepath']))>0) {?> 
                                    <img src="../../assets/<?php echo $config['thumb'].$pageContent[0]['filepath'];?>" align="left" style="margin:5px;border:1px solid #ccc;padding:3px;margin-right:0px;" height="120"><br>
                                <?php }?>
                            </td>-->
                            <td rowspan="2"> 
                                  
                            </td>
                       </tr>
                     <!--  <tr>
                            <td><input type="submit" value="Remove Image" name="rmimage" id="rmimage">&nbsp;&nbsp;<input type="file" class="input" name="filepath"/></td>                        
                       </tr> -->
                    </table>
                </td>   
            </tr>
        
            <tr>
                <td colspan="2">
                    <input type="submit" name="updatebtn" value="Update" bgcolor="grey">
                    <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewpages.php'"> 
                    <input type="submit" name="deletebtn" value="Delete" bgcolor="grey">
                    <input type="button" name="button" value="Refresh" bgcolor="grey" onclick="location.href=location.href"> 
                </td>
            </tr>
              <tr>
                <td colspan="2" style="font-size:13px"><br>
                    &nbsp;&nbsp;<b>Search Engline Result looks like bellow</b><bR><br>
                    <div style="background:#fff;padding:5px;border:1px solid #ccc">
                        <div style="padding:10px;width:630px">
                            <div style="color:#1a0dab;font-family:arial;font-weight:bold;font-size:17px"><?php echo $pageContent[0]['pagetitle'];?></div>
                            <div style="color:#006621;font-family:arial;font-size:13px"><?php echo $purl;?>&nbsp;&nbsp;<span class='arrow-down'></span></div>
                            <div style="color:#545454;font-family:arial;font-size:small"><?php echo substr($pageContent[0]['description'],0,255);?></div>
                        </div>
                    </div> 
                </td>
            </tr>
        </table>
    </form>
        <script>$('#success').hide(3000);</script>
 
 
</body>