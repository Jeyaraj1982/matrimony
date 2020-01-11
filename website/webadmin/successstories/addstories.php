<?php include_once(__DIR__."/../header.php"); ?>
<?php
 

        $obj = new CommonController();
    
        if (!($obj->isLogin())){
            echo $obj->printError("Login Session Expired. Please Login Again");
            exit;
        }

   if (isset($_POST{"save"})) {
        
                $param = array("storytitle"         =>$_POST['storytitle'],
                               "storydescription"   =>str_replace("'","\\'",$_POST['storydescription']),
                               "storyname"          =>$_POST['storyname'],
                               "email"              =>$_POST['storyemail'],
                               "mobileno"           =>$_POST['storymobile'],
                               "storytype"          =>'S',
                               "ispublish"          =>$_POST['ispublish']);
       
               if ($obj->isEmptyField($_POST['storyname'])) {
                    echo $obj->printError("Name Shouldn't be blank");
                }
                
               if ($obj->isEmptyField($_POST['storytitle'])) {
                    echo $obj->printError("Title Shouldn't be blank");
                }
                
               if ($obj->isEmptyField($_POST['storyemail'])) {
                    echo $obj->printError("Email Shouldn't be blank");
                }
                
               if ($obj->isEmptyField($_POST['storymobile'])) {
                    echo $obj->printError("Mobile No Shouldn't be blank");
                }
       
               if ( (isset($_FILES["filepath"]["tmp_name"])) && (strlen(trim($_FILES["filepath"]["tmp_name"]))>0)) { 
                    $obj->fileUpload($_FILES['filepath'],"../../assets/".$config['thumb'],$config['imageArray'],$config['imgMaxSize'],$param["filename"]);  
               } 
             
           if ($obj->err==0) {
                echo (JSuccessStory::addStory($param)>0) ? $obj->printSuccess("New Success Story Added Successfully") : $obj->printError("Error Adding Page");
                unset($_POST); 
            }else {
            echo $obj->printErrors();
           }                       
   }                 
?>

<script src="<?php echo BaseUrl;?>assets/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">tinyMCE.init({mode : "textareas",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
<body style="margin:0px;">
        <div class="titleBar">New Success Stories</div>
        <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
            <table cellpadding="5" cellspacing="0" align="center">
                <tr>
                    <td style="width:70px">Title</td> 
                    <td><input type="text" name="storytitle" style="width:100%;" value="<?php echo isset($_POST['storytitle']) ? $_POST['storytitle'] : ""; ?>" autocomplete="off"></td> 
                </tr>
                <tr>
                    <td colspan="2"><textarea name="storydescription" style="height: 350px;width:100%"><?php echo isset($_POST['storydescription']) ? $_POST['storydescription'] : ""; ?></textarea></td>
                </tr>
                <tr>
                    <td>Name</td> 
                    <td><input type="text" name="storyname" style="width:100%;" value="<?php echo isset($_POST['storyname']) ? $_POST['storyname'] : ""; ?>" autocomplete="off"></td> 
                </tr>
                <tr>
                    <td>Email</td> 
                    <td><input type="text" name="storyemail" style="width:100%;" value="<?php echo isset($_POST['storyemail']) ? $_POST['storyemail'] : ""; ?>" autocomplete="off"></td> 
                </tr>
                <tr>
                    <td>Mobile No.</td> 
                    <td><input type="text" name="storymobile" maxlength="10" value="<?php echo isset($_POST['storymobile']) ? $_POST['storymobile'] : ""; ?>" style="width:100%;" autocomplete="off"></td> 
                </tr>
                <tr>
                  <td colspan="2">
                    <table>
                        <tr>
                            <td>Thumb Image: <input type="file" class="input" name="filepath"/></td>
                            <td rowspan="2"> 
                              Is Publish? <select name="ispublish"><option value='1'>Publish</option><option value='0'>Unpublish</option></select>
                            </td>
                        </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                    <td><input type="submit" name="save" value="Save" bgcolor="grey"></td>
               </tr>   
         </table>
        </form>
        <script>$('#success').hide(3000);</script>    
</body>
