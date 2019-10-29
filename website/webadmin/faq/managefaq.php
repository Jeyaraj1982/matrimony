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
         
         if ($obj->isEmptyField($_POST['faqquestion'])) {
             echo $obj->printError("FAQ Question Shouldn't be blank");
         }
         
         if ($obj->isEmptyField($_POST['faqanswer'])) {
             echo $obj->printError("FAQ Answer Shouldn't be blank");
         }
         $param = array("faqid"=>$_POST['rowid'],"faqquestion"=>$_POST['faqquestion'],"faqanswer"=>str_replace("'","\\'",$_POST['faqanswer']),"ispublished"=>$_POST['ispublished']);
               
         if ($obj->err==0) {
             echo (JFaq::updateFaq($param)>0) ? $obj->printSuccess("FAQ Updated  Successfully") : $obj->printError("Error Updating FAQs");
         }else {
            echo $obj->printErrors();
         }
         $_POST{"editbtn"}="editbtn";       
      
     } 
      
      if (isset($_POST{"editbtn"})){
          
       $pageContent = JFaq::getFaq($_POST['rowid']);
   
       ?>
      
<script src="./../../assets/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">tinyMCE.init({mode : "textareas",theme : "advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
   <div class="titleBar">Edit FAQs</div>
    <form action="" method="post">
        <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['faqid'];?>">
        <table cellpadding="5" cellspacing="0" align="center">
            <tr>
                <td style="width:72px">Question</td> 
                <td><input type="text" name="faqquestion" style="width:100%;" value="<?php echo $pageContent[0]['faqquestion'];?>"></td> 
            </tr>
            <tr>
                <td colspan="2"><textarea name="faqanswer" style="height: 350px;width:100%"><?php echo $pageContent[0]['faqanswer'];?></textarea></td>
            </tr> 
            <tr>
                <td colspan="2">
                    <table>
                        <tr>
                            <td rowspan="2"> 
                                Is Publish?  <select name="ispublished"><option value='1' <?php echo ($pageContent[0]["ispublished"]) ? 'selected="selected"' : '';?>>Yes</option><option value='0' <?php echo ($pageContent[0]["ispublished"]!=1) ? 'selected="selected"' : '';?>>No</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
                                PostedOn:<?php echo $pageContent[0]['postedon'];?>  
                            </td>
                       </tr>
                    </table>
                </td>   
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="updatebtn" value="Update" bgcolor="grey">
                    <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewfaq.php'"> 
                </td>
            </tr>
        </table>
    </form>
      <script>$('#success').hide(3000);</script>
       <?php
       exit;
      }
     
      if (isset($_POST{"viewbtn"})){
           
      $pageContent = JFaq::getFaq($_POST['rowid']);
       ?> 
      <div class="titleBar">View FAQs</div>
       <table  style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
        <tr>
            <td style="width:150px">Faq Question</td> 
            <td><?php echo $pageContent[0]['faqquestion'];?></td>
        </tr>
        <tr>
            <td>Faq Answer</td>
            <td style="text-align:justify;font-family:arial;font-size:12px;">
                <?php echo $pageContent[0]['faqanswer'];?>
            </td>
        </tr>
        <tr>
            <td>Is Published</td>  
            <td> 
                <?php echo ($pageContent[0]["ispublished"])  ? "<span style='color:#08912A;font-weight:bold;'>Published</span>" : "<span style='color:#FF090D;font-weight:bold;'>Un Published</span>"; ?>
            </td>
        </tr>
        <tr>
            <td>PostedOn</td>
            <td><?php echo $pageContent[0]['postedon'];?></td>
        </tr>
       </table>
                <form action='managefaq.php' method='post' style='height:0px;'>
                    <input type='hidden' value='<?php echo $pageContent[0]['faqid'];?>' name='rowid' id='rowid' >
                    <input style='font-size:11px;' type='submit' name='editbtn' value='Edit'>
                    <input style='font-size:11px;' type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewfaq.php'"> 
                </form>     
       <?php
       exit;
      }
      if(isset($_POST{"cdeletebtn"})){
          
       $pageContent = JFaq::deleteFaq($_POST['rowid']); 
       echo CommonController::printSuccess("Deleted Successfully");
       echo "<script>setTimeout(\"window.open('viewfaq.php','rpanel')\",1500);</script>"; 
      }
      
      if (isset($_POST{"deletebtn"})){
          
       $pageContent = JFaq::getFaq($_POST['rowid']);
       ?>
      <div class="titleBar">Delete FAQs</div>
       <form action='' method="post" >
       <table  style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
         <tr>
            <td style="width:150px">Faq Question</td> 
            <td><?php echo $pageContent[0]['faqquestion'];?></td>
        </tr>
        <tr>
            <td>Faq Answer</td>
            <td style="text-align:justify;font-family:arial;font-size:12px;">
                <?php echo $pageContent[0]['faqanswer'];?>
            </td>
        </tr>
        <tr>
            <td>Is Published</td>  
            <td> 
                <?php echo ($pageContent[0]["ispublished"])  ? "<span style='color:#08912A;font-weight:bold;'>Published</span>" : "<span style='color:#FF090D;font-weight:bold;'>Un Published</span>"; ?>
            </td>
        </tr>
        <tr>
            <td>PostedOn</td>
            <td><?php echo $pageContent[0]['postedon'];?></td>
        </tr>
       </table>
       <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['faqid'];?>"> 
       <input type="submit" value="Delete" name="cdeletebtn">
       <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='viewfaq.php'"> 
       </form>
       <?php } ?>
</body>
