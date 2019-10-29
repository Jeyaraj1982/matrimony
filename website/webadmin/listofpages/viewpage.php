<?php error_reporting(0);
include_once("../../config.php");


  class Busbookingpage  
  {
     
     
        function viewPage($rowid)
      {
          global $mysql;
          $record= $mysql->select("select * from _jpagedetails where pageid='".$rowid."'");
          
         
        return "<table border=1; cellspacing='0'; cellspadding='0'; width:1000px;>
              <tr style='width:1000px;'><td style='width:300px;'>Page Title</td><td style='width:300px;'>".$record[0]['pagetitle']."</td> </tr>
              <tr><td></td><td align='left'><form action='' method='post' style='height:10px;'>
              <input type='hidden' value='".$record[0]["pageid"]."' name='rowid' id='rowid' ><input type='submit' name='deletebtn' value='delete' style='height:28px;'>
              </form></td></tr>
              <tr><td><form action='addpage.php' method='post' style='height:10px;'><input type='submit' name='save' value='Addnew' style='height:28px;'/></form></td></td></table>";
     }
    
        function deletePage($rowid)
      {
          global $mysql;
          $record=$mysql->execute("delete from _jpagedetails where pageid='".$rowid."'");
         
         
     }
  }
       
     
      if (isset($_POST{"viewbtn"}))
      {
       $page=new Busbookingpage();
       echo $page->viewPage($_POST['rowid']);
       exit;
      }
      if (isset($_POST{"deletebtn"}))
      {
       $page=new Busbookingpage();
       echo $page->deletePage($_POST['rowid']);
       
      }
     
    $result=$mysql->select("select * from _jpagedetails");
    echo "<table border='1' cellspacing='0' cellspadding='0'>";
    foreach ($result as $r)
    {
    echo "<tr ><td>".$r["pagetitle"]."</td><td><form action='' method='post' style='height:20px;'>
    <input type='hidden' value='".$r["pageid"]."' name='rowid' id='rowid' ><input type='submit' name='deletebtn' value='delete' style='width:70px; height:40px;'>
    <input type='submit' name='viewbtn' value='view' style='width:70px; height:40px;'></form></td></tr>";
    
    }
     echo"</table>"
              
?>
  

