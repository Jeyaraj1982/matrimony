<?php error_reporting(0);
include_once("../../config.php");

 class Busticketbookingpage 
   {
     function addPage($pagetitle,$pagedescription)
       {
          global $mysql; 
          return $mysql->insert("_jpagedetails",array("pagetitle"=>$pagetitle,"pagedescription"=>$pagedescription)); 
       }
     
  }
  
   if (isset($_POST{"save"}))
   {
      //echo User::updateUser($_POST['username'],$_POST['address']);
     $page= new Busticketbookingpage();
     if($page->addPage($_POST['pagetitle'],$_POST['pagedescription'])>0)
     {
     echo "page added successfully";       
        } else {
            echo "error adding page";
        }
   } 
   
          
?>
<script src="./../../assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>


<form action="" method="post" style="height: 20px;">
<table border="1" style="width:100%" cellpadding="0" cellspacing="0" align="center">
<tr>
<td>Page Title</td>
<td style="width:1150;"><input type="text" name="pagetitle" maxlength="100" size="40" style="width:1150;"><br></td> 
</tr>
<tr>
 
<td colspan="2"><textarea name="pagedescription"  style="width: 270px; height: 150px;"></textarea><br></td></tr>

<tr>
 <td align="left"><input type="submit" name="save" value="save" bgcolor="grey">  </td>
</tr>
</table>


</form>
