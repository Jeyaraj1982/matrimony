<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<body style="margin:0px;">
<?php 
include_once("../../config.php");

    $obj = new CommonController();  
            if (!($obj->isLogin())){
                echo $obj->printError("Login Session Expired. Please Login Again");
                exit;
            }
    
     if(isset($_POST{"updatebtn"})) {
         
         $param = array("readingid"=>$_POST['rowid'],"title"=>$_POST['title'],"details"=>str_replace("'","\\'",$_POST['details']),"title_t"=>$_POST['title_t'],"details_t"=>str_replace("'","\\'",$_POST['details_t']),"date"=>$_POST['datepicker']);
         
         if ($obj->isEmptyField($_POST['title'])) {
             echo $obj->printError("Title Shouldn't be blank");
         }     
         if ($obj->err==0) {
             echo (JReading::updateReading($param)>0) ? $obj->printSuccess("Readings Updated  Successfully") : $obj->printError("Error Updating Readings");
         }
          $_POST{"editbtn"}="editbtn";      
     } 
     if (isset($_POST{"editbtn"})){
          
       $pageContent = JReading::getReading($_POST['rowid']);
   
       ?>
       
<script src="./../../assets/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">tinyMCE.init({mode : "textareas",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>                              
$(function() {
       $( "#datepicker" ).datepicker({
       showOn: 'button',
       
       buttonImage:'http://theonlytutorials.com/demo/x_office_calendar.png',
       width:20,
       height:20,
       buttonImageOnly: true,
       changeMonth: true,
       changeYear: true,
       showAnim: 'slideDown',
       duration: 'fast',
       dateFormat: 'yy-mm-dd'});
 
});
</script>
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
     <div class="titleBar">Edit Readings</div>
    <form action="" method="post"enctype="multipart/form-data">
        
        <table cellpadding="5" cellspacing="0" align="center">
            <tr>
                <td>Date:</td>
                <td> <input id="datepicker" class="datepicker" type="text" value="<?php echo $pageContent[0]['date'];?>" name="datepicker"/></td>
            </tr>
           <tr>
                <td style="width:72px">English Title</td> 
                <td><input type="text" name="title" style="width:100%;" value="<?php echo $pageContent[0]['title'];?>"></td> 
            </tr>
            <tr>
                <td colspan="2"><textarea name="details" style="height: 350px;width:100%"><?php echo $pageContent[0]['details'];?></textarea></td>
            </tr>
            <tr>
                <td>Tamil Title</td> 
                <td><input type="text" name="title_t" style="width:100%;" value="<?php echo $pageContent[0]['title_t'];?>"></td> 
            </tr>
            <tr>
                <td colspan="2"><textarea name="details_t" style="height: 350px;width:100%"><?php echo $pageContent[0]['details_t'];?></textarea></td>
            </tr> 
            <tr>
                <td colspan="2"><input type="submit" name="updatebtn" value="Update" bgcolor="grey">
                    <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewreadings.php'"> 
                    <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['readingid'];?>"> 
                </td>
            </tr>
        </table>
    </form>
    
       <?php
       exit;
      }
     
      if (isset($_POST{"viewbtn"})){
           
      $pageContent = JReading::getReading($_POST['rowid']);
        
       ?>
       
       <div class="titleBar">View Readings</div> 
       <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
        <tr>
            <td style="width:150px">English Title</td> 
            <td><?php echo $pageContent[0]['title'];?></td>
        </tr>
        <tr>
            <td>Details</td>
            <td>
                <?php echo $pageContent[0]['details'];?>
            </td>
        </tr>
        <tr>
            <td style="width:150px">Tamil Title</td> 
            <td><?php echo $pageContent[0]['title_t'];?></td>
        </tr>
        <tr>
            <td>Details</td>
            <td>
                <?php echo $pageContent[0]['details_t'];?>
            </td>
        </tr>
        <tr>
             <td>Date</td>
             <td><?php echo $pageContent[0]['date'];?></td>
        </tr>
       </table>
                <form action='managereadings.php' method='post' style='height:0px;'>
                    <input type='hidden' value='<?php echo $pageContent[0]['readingid'];?>' name='rowid' id='rowid' >
                    <input style='font-size:11px;' type='submit' name='editbtn' value='Edit'>
                    <input style='font-size:11px;' type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewreadings.php'"> 
                </form>  
       <?php
       exit;
      }
      if(isset($_POST{"cdeletebtn"})){
           $pageContent = JReading::deleteReading($_POST['rowid']); 
           echo CommonController::printSuccess("Deleted Successfully");
           echo "<script>setTimeout(\"window.open('viewreadings.php','rpanel')\",1500);</script>"; 
      
      }
      if (isset($_POST{"deletebtn"})){
          
       $pageContent = JReading::getReading($_POST['rowid']);
       ?>
       <div class="titleBar">Delete Readings</div> 
       <form action='' method="post">
           <table  style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
             <tr>
                <td style="width:150px">English Title</td> 
                <td><?php echo $pageContent[0]['title'];?></td>
            </tr>
            <tr>
                <td>Details</td>
                <td>
                    <?php echo $pageContent[0]['details'];?>
                </td>
            </tr>
            <tr>
                <td style="width:150px">Tamil Title</td> 
                <td><?php echo $pageContent[0]['title_t'];?></td>
            </tr>
            <tr>
                <td>Details</td>
                <td>
                    <?php echo $pageContent[0]['details_t'];?>
                </td>
            </tr>
            <tr>
                 <td>Date</td>
                 <td><?php echo $pageContent[0]['date'];?></td>
            </tr>
           </table>
               <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['readingid'];?>"> 
               <input type="submit" value="Delete" name="cdeletebtn">
               <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewreadings.php'"> 
      </form>
       <?php
       }                 
?>
</body>
