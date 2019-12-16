<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php 
    include_once("../../config.php");
    
    if (!(CommonController::isLogin())){
        echo CommonController::printError("Login Session Expired. Please Login Again");
        exit;
    }
    
    
    
    if (isset($_POST['deletebtn'])) {
        
        JListing::DeleteItem($_REQUEST['id']);
        JListing::deleteItemImages($_REQUEST['id']);
        echo "<script>alert('Deleted Successfully');location.href='manageitems.php';</script>";  
    }
              
    if (isset($_POST['updatebtn'])) {
        
        $obj = new CommonController();
        
        $param = array("categoryid"         => $_POST['categoryid'],
                       "itemname"           => $_POST['itemname'],
                       "itemdesc"           => $_POST['itemdescription'],
                       "ispublished"        => $_POST['ispublished'],
                       "shortdescription"   => $_POST['shortdescription'],
                       "keywords"           => $_POST['keywords'],
                       "itemid"             => $_REQUEST['id'],
                       "itemprice"          => $_POST['itemprice']); 
                                   
        if (isset($_FILES['filepath']['name'])&& (strlen(trim($_FILES["filepath"]["name"]))>0)) {
            $obj->fileUpload($_FILES['filepath'],"../../assets/".$config['thumb'],$config['imageArray'],$config['imgMaxSize'],$filename);
            $param["filename"] = $filename;
        } 
        
        if ($obj->err==0) {
        
            if(CommonController::isEmptyField($_POST['itemname']) || CommonController::isEmptyField($_POST['itemdescription'])||CommonController::isEmptyField($_POST['itemprice'])) {
                echo CommonController::printError ("All Product Fields are Required"); 
            } else {
                JListing::updateItem($param);
                echo CommonController::printSuccess("Item Items Updated successfully");       
            //} else {
              //  echo CommonController::printError("Error Adding Items");
            }
        }
        
    }

    if (isset($_REQUEST['sid'])) {
        echo "<script>location.href='edititem.php?id=".$_REQUEST['id']."';</script>";
    }        
    
    $itemResult= JListing::getItem($_REQUEST['id']); 
?>

<script src="./../../assets/js/tiny_mce/tiny_mce.js"></script>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<script type="text/javascript">tinyMCE.init({ entity_encoding : "raw", mode:"specific_textareas",editor_selector:"mceEditor",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
 
<style>
    table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
    textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
    .title_Bar {background:url(../images/blue/titlebackground.png);padding:5px;color:#6db2bc;font-family:'Trebuchet MS';font-size:13px !important;font-weight: bold;padding:11px !important;}   
    input[type=text],select {border:1px solid #b3d7e2;font-family:'Trebuchet MS';font-size:12px !important;color:#444}
</style>

    <body style="margin:0px;background:#e3f3f7">
        
        <div class="title_Bar">Manage Item</div> 
        <div >
<table style="width:100%">
   <tr>
    <td>
   
        <form action="" method="post"  enctype="multipart/form-data">
            <table cellpadding="5" cellspacing="0" align="center" style="width:100%">
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="categoryid">
                            <?php
                                  $result = JListing::getCategories();                                        
    foreach ($result as $r)
    {
    ?>
        <option value="<?php echo $r['categoryid'];?>" <?php echo ($r['categoryid']==$itemResult[0]['categoryid']) ? " selected='selected' ": "";?> ><?php echo $r['categoryname'];?></option>
    <?php
    }
    ?>
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                     <td style="width:70px;">Item Name</td>
                     <td><input type="text" name="itemname"  value="<?php echo $itemResult[0]['itemname'];?>" size="40" style="width:100%;"><br></td> 
               </tr>
                 <tr>
                            <td>Short Description</td>
                            <td><textarea name="shortdescription" style="height:60px;width:100%"><?php echo $itemResult[0]['shortdescription'];?></textarea></td> 
                        </tr>
                <tr>
                    <td colspan="2"><textarea name="itemdescription" style="height: 356px;width:100%" class="mceEditor"><?php echo $itemResult[0]['itemdesc'];?></textarea></td>
               </tr>
           
               <tr>
                <td>Thumb </td>
                <td>
                 <img src="../../assets/<?php echo $config['thumb']; ?>/<?php echo $itemResult[0]['filename'];?>" style="height:99px;width:132px;">
                <input type="file" class="input" name="filepath"/><br>
                [Size: Width:236px & Height:177px or 4:3 Ratio (H:W)]</td>
                        
               </tr>
                <tr>
                            <td style="width:80px;">Item Price</td>
                            <td><select><option><?php echo JFrame::getAppSetting("currencysymbol");?></option></select><input type="text" name="itemprice" value="<?php echo $itemResult[0]['itemprice'];?>"  size="40" style="width:150px;"></td> 
                        </tr>
                        <tr>
                            <td>Is Published</td>
                            <td><select name="ispublished"><option value="1">Yes</option><option value="0">No</option></select></td> 
                        </tr>
                       
                        <tr>
                            <td>Keywords</td>
                            <td><textarea name="keywords" style="height:60px;width:100%"><?php echo $itemResult[0]['keywords'];?></textarea></td> 
                        </tr>
                         
               <tr>
                    <td colspan="2"><input type="submit" name="updatebtn" value="Update" bgcolor="grey">  
                   
                    <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='manageitems.php'">
                    
                    <input type="submit" name="deletebtn" value="Delete" bgcolor="grey"> 
                    
                      </td>
              </tr> 
        </table>
    </form> 
 
    
    </td>
    <?php
        
         
             
  if (isset($_REQUEST['did'])) {
    $tmp = $mysql->select("select * from _jlistingimg where itemimgid=".$_REQUEST['did']) ;
    if (sizeof($tmp)>0) {
        $mysql->execute("delete from _jlistingimg where itemimgid=".$_REQUEST['did']) ;
        $msg =  $obj->printSuccess("Deleted successfully");
        //echo "<script>location.href='edititem.php?id=".$_REQUEST['id']."';</script>";
    }
} 

if (isset($_REQUEST['pid'])) {
    $tmp = $mysql->select("select * from _jlistingimg where ispublished=0 and itemimgid=".$_REQUEST['pid']) ;
    if (sizeof($tmp)>0) {
        $mysql->execute("update  _jlistingimg set ispublished=1 where itemimgid=".$_REQUEST['pid']) ;
        $msg =   $obj->printSuccess("Published successfully");
    } 
}   

if (isset($_REQUEST['upid'])) {
   
    $tmp = $mysql->select("select * from _jlistingimg where ispublished=1 and itemimgid=".$_REQUEST['upid']) ;
    if (sizeof($tmp)>0) {
         
        $mysql->execute("update  _jlistingimg set ispublished=0 where itemimgid=".$_REQUEST['upid']) ;
     $msg =      $obj->printSuccess("Unpublished successfully");
    } 
} 

 $images = JListing::getItemImages($_REQUEST['id']);
    ?>
    
    <td style="width:<?php echo sizeof($images)>=12 ? "344" : "327"  ;?>px;vertical-align: top;">
    
    <table>
        <tr>
            <td><div style="padding:8px 4px">Additional Images</div></td>
            <td><?php echo $msg;?></td>
        </tr>
    </table>
            <div style="clear:both;height:385px;overflow:auto;background:#fff;border:1px solid #b3d7e2;padding:7px;padding-right:0px">
     <?php
        if (isset($_POST['addImageBtn'])) {
                  
            $obj = new CommonController();
            $param = array("itemid"=>$_REQUEST['id'],"filename"=>"");
            
            if (isset($_FILES['filepath']['name'])&& (strlen(trim($_FILES["filepath"]["name"])))) {
                $obj->fileUpload($_FILES['filepath'],"../../assets/".$config['thumb'],$config['imageArray'],$config['imgMaxSize'],$param["filename"]);
            } else {
                echo $obj->printError("Please Attach Thumb Image");     
            }
            
            if ($obj->err==0) {
                echo ( (JListing::addItemImage($param)>0) ?   $obj->printSuccess("Thumb added successfully") : $obj->printError("error adding Imae") );
                unset($_POST); 
            }else {
                echo $obj->printErrors();
            }
        }
    ?>
    

 
      <div >
        <?php
    
      
            $images = JListing::getItemImages($_REQUEST['id']);
            foreach($images as $i) {
                ?>
                    <div style="border-radius:0px 0px 5px 5px;<?php echo ($i['ispublished']==1 ) ? "background:#84ff98;border:1px solid green;" : "background:#ffb7b7;border:1px solid red;";?>;width:96px;height:90px;float:left;margin-bottom:6px;margin-right:7px;font-size:11px;text-align:center;font-family:arial;line-height:18px;">
                        <img src="../../assets/<?php echo $config['thumb']; ?>/<?php echo $i['filename'];?>" style="height:72px;width:96px;"><Br>
                        <a  style="color:#333" href="edititem.php?id=<?php echo $_REQUEST['id'];?>&did=<?php echo $i['itemimgid'];?>">Delete</a> | 
                        <?php if ($i['ispublished']==1 ) { ?>
                        <a  style="color:#333" href="edititem.php?id=<?php echo $_REQUEST['id'];?>&upid=<?php echo $i['itemimgid'];?>">Unpublish</a> 
                        <?php } else { ?>
                        <a style="color:#333" href="edititem.php?id=<?php echo $_REQUEST['id'];?>&pid=<?php echo $i['itemimgid'];?>">Publish</a> 
                        <?php } ?>                                                                                            
                        
                    </div>
                <?php
            }
        ?>
      
      </div>
      
      </div>
      
      
      <div>
          <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
    <table>
        <tr>
            
            <td><input type="file" class="input" name="filepath"/><input type="submit" value="Add Image" name="addImageBtn"></td>
             
        </tr>
    </table>
    </form>
      </div>
      
      <div> 
            <div style="padding:8px 4px">Features</div>
            <div><?php echo $fmsg;?></div>
            
            <div style="clear:both;height:285px;overflow:auto;background:#fff;border:1px solid #b3d7e2;padding:7px;padding-right:0px">
                <?php $features = $mysql->select("SELECT * FROM _jlistingfeature AS listfeature, _jfeature AS jfeature WHERE jfeature.featureid=listfeature.featureid AND listfeature.itemid=".$_REQUEST['id']); ?>
                <table style="font-family:arial;font-size:12px;color:#444">
                    <?php foreach($features as $f) { ?>
                    <tr>
                        <td><?php echo $f['featurename'];?></td>
                        <td>:</td>
                        <td><?php echo $f['itemvalue'];?></td>
                        <td>x</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
      </div>
      <div>
                      <?php
                    $features = $mysql->select("select * from  _jfeature where featureid not in (SELECT listfeature.featureid  FROM _jlistingfeature AS listfeature, _jfeature AS jfeature WHERE jfeature.featureid=listfeature.featureid AND listfeature.itemid=".$_REQUEST['id'].")");
                    if (sizeof($features)>0)                     {
                ?>

        <table>
            <tr>
                <td>
                <select>
                    <?php foreach($features as $f) {?>
                        <option value="<?php echo $f['featureid'];?>"><?php echo $f['featurename'];?></option>
                    <?php } ?>
                </select>
                </td>
                <td>
                    <input type="text" name="">
                </td>
                <td>
                    <input type="submit" Value="ADD">
                </td>
            </tr>
        </table>
        <?php } ?>
      </div>
      
      
 
      
      <div> 
            <div style="padding:8px 4px">Related Items</div>
           
             
      </div>
       
 </td>
    <td>
    </td>
   </tr>
</table>
  
 
   
         </div>
</body>
