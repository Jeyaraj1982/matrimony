  <?php 
    include_once("../../config.php");
    
    $obj = new CommonController();
    
    if (!($obj->isLogin())){
        echo $obj->printError("Login Session Expired. Please Login Again");
        exit;
    }  
  
    if (isset($_POST{"save"})) {
        
        $param = array("date"       => $_POST['datepicker'],
                       "title"      => $_POST['title'],
                       "details"    => str_replace("'","\\'",$_POST['details']),
                       "title_t"    => $_POST['title_t'],
                       "details_t"  => str_replace("'","\\'",$_POST['details_t']
                       ));
        
        if ($obj->isEmptyField($_POST['title'])) {
            echo $obj->printError("Title Shouldn't be blank");
        }       
        if ($obj->err==0) {
            echo (JReading::addReading($param)>0) ? $obj->printSuccess("Readings added successfully") : $obj->printError("Error adding Readings"); 
        }
    }
?>
<script src="./../../assets/js/tiny_mce/tiny_mce.js"></script>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<script type="text/javascript">tinyMCE.init({mode : "textareas",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>                              
$(function() {
       $( "#datepicker" ).datepicker({showOn: 'button', buttonImage:'http://theonlytutorials.com/demo/x_office_calendar.png',width:20,height:20,buttonImageOnly: true,changeMonth: true,changeYear: true,showAnim: 'slideDown',duration: 'fast',dateFormat: 'yy-mm-dd'});
});
</script>
 <style type="text/css">
.ui-datepicker {font-size:9pt;font-family:Verdana; background-color:grey;}
.datepicker{color:black;text-decoration: none;font-size:inherit;font-size:12px;position: relative; top: 1px;}
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
<body style="margin:0px;">
    <div class="titleBar">Add Readings</div>
    <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
        <table cellpadding="5" cellspacing="0" align="center">
            <tr>
                <td>Date:</td>
                <td> <input id="datepicker" class="datepicker" type="text" name="datepicker"/></td>
            </tr>
            <tr>
                <td style="width:72px">English Title</td> 
                <td><input type="text" name="title" style="width:100%;"></td> 
            </tr>
            <tr>
                <td colspan="2"><textarea name="details" style="height: 350px;width:100%"></textarea></td>
            </tr>
            <tr>
                <td>Tamil Title</td> 
                <td><input type="text" name="title_t" style="width:100%;"></td> 
            </tr>
            <tr>
                <td colspan="2"><textarea name="details_t" style="height: 350px;width:100%"></textarea></td>
            </tr>            
            <tr>
                <td colspan="2">
                   <input type="submit" name="save" value="Save" bgcolor="grey">
                   <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewreadings.php'">
                </td>
            </tr>
        </table>
    </form>
    <script>$('#success').hide(3000);</script> 
</body>
