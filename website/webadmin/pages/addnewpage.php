<?php include_once(__DIR__."/../header.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php //include_once("../header.php"); ?>
<div class="title_Bar">New Page</div> 
<?php 
    $obj   = new CommonController();
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    }  
  
    if (isset($_POST{"save"})) {
          
        $param = array("pagetitle"       => $_POST['pagetitle'],
                       "pagedescription" => $_POST['pagedescription'], 
                       "ispublish"       => $_POST['ispublish'],
                       "pagetype"        => 'P',
                       "ishomepage"      =>$_POST['ishomepage'],
                       "keywords"        =>$_POST['keywords'],
                       "description"     =>$_POST['desc']);
          
        if ($obj->isEmptyField($_POST['pagetitle'])) {
            echo $obj->printError("Page Title Shouldn't be blank");
        }
   
        if ($obj->err==0) {
            echo ( (JPages::addPage($param)>0) ? $obj->printSuccess("Page added successfully") : $obj->printError("Error adding Page") );
            unset($_POST); 
        } else {
            echo $obj->printErrors();
        }
    }
?>
<script src="<?php echo BaseUrl;?>assets/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({entity_encoding : "raw", mode : "specific_textareas",editor_selector : "mceEditor",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,preview,|,forecolor,backcolor",theme_advanced_buttons2 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});
</script>
<body style="margin:0px;">
  
    <form action="" method="post" enctype="multipart/form-data">
        <table cellpadding="5" cellspacing="0" align="center" style="width: 100%;font-size:14px;font-family:'Trebuchet MS';color:#333">
            <tr>
                <td style="width:111px">Page Title</td> 
                <td><input type="text" name="pagetitle" style="width:100%;"></td> 
            </tr>
            <tr>
                <td colspan="2"><textarea class="mceEditor" name="pagedescription" style="height: 350px;width:100%"></textarea></td>
            </tr>
            <tr>
                <td style="vertical-align:top;">Short Description</td>
                <td><textarea  style="height:60px;width:100%;" name="desc"></textarea></td>
            </tr>
            <tr>
                <td style="vertical-align:top;">Search Keywords</td>
                <td><textarea  style="height:60px;width:100%;" name="keywords"></textarea></td>
            </tr>
            <tr>
                <td>Is Publish?</td>
                <td>
                <select name="ispublish"><option value='1'>Publish</option><option value='0'>Unpublish</option></select>
                Make as HomePage? <select name="ishomepage"><option value='1'>Yes</option><option value='0' selected="selected">No</option></select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;" colspan="2"><input type="submit" name="save" value="Save" bgcolor="grey" class="submitbtnblue"></td>
            </tr>
        </table>
    </form>
    <script>$('#success').hide(3000);</script>
</body>