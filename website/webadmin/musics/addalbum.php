<?php
        include_once("../../config.php");
        
         $obj = new CommonController();  
            if (!($obj->isLogin())){
                echo $obj->printError("Login Session Expired. Please Login Again");
                exit;
            }
             if (isset($_POST{"save"})) {
                 
                $param = array("albumtitle"=>$_POST['albumtitle'],"albumdescription"=>str_replace("'","\\'",$_POST['albumdescription']),"filename"=>$filename,"ispublished"=>$_POST['ispublished']);
                 
                if ($obj->isEmptyField($_POST['albumtitle'])) {
                    echo $obj->printError("Music Album Title Shouldn't be blank");
                }  
                if ((isset($_FILES["filepath"]["name"])) && (strlen(trim($_FILES["filepath"]["name"]))>0)){
                    
                   $obj->fileUpload($_FILES['filepath'],"../../assets/".$config['thumb'],$config['imageArray'],$config['imgMaxSize'],$param["filename"]);
                
                }else{
                echo $obj->printError("Please Attach Gallery Image");     
             }
           
             if ($obj->err==0) {
                echo ( (JMusics::addMusicAlbum($param)>0) ?   $obj->printSuccess("Albums added successfully") : $obj->printError("Error Adding Albums") );
             }else {
              echo $obj->printErrors();
            } 
    } 
?>
<script src="./../../assets/js/tiny_mce/tiny_mce.js"></script>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<script type="text/javascript">tinyMCE.init({mode : "textareas",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
<body style="margin:0px;">
        <div class="titleBar">Add Albums</div>  
        <form action="" method="post" enctype="multipart/form-data">
            <table cellpadding="5" cellspacing="0" align="center">
                <tr>
                     <td style="width:72px;">Album Title</td>
                     <td><input type="text" name="albumtitle" size="40" style="width:100%;" value="<?php echo isset($_POST['albumtitle']) ? $_POST['albumtitle'] : ""; ?>"></td> 
               </tr>
               <tr>
                    <td colspan="2"><textarea name="albumdescription" style="height: 350px;width:100%"><?php echo isset($_POST['albumdescription']) ? $_POST['albumdescription'] : ""; ?></textarea></td>
               </tr>
               <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td style="width:300px;font-size:12px;"><b>Upload:</b></td>
                                <td rowspan="2"> 
                                      Is Publish? <select name="ispublished"><option value='1'>Yes</option><option value='0'>No</option></select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="file" class="input" name="filepath"/></td>                                               
                            </tr>
                        </table>
                    </td>
              </tr>
               <tr>
                    <td colspan="2"><input type="submit" name="save" value="Save" bgcolor="grey">
                    <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='viewalbum.php'"></td>
              </tr> 
            </table>
        </form>
        <script>$('#success').hide(3000);</script> 
</body>
