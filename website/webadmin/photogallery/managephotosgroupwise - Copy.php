<body style="margin:0px;">
 <div style='border:1px solid #ccc;background:#ccc;padding:3px;font-weight:bold;color:#444;font-family:arial;font-size:12px;'>Edit PhotoGallery</div>
 <style>
 .mytr:hover{background:#f1f1f1;cursor:pointer}
 </style>
<?php error_reporting(0);
include_once("../../config.php");


     
        if(isset($_POST{"cdeletebtn"}))
      {
       $photogallery = new JPhotogallery();
       echo $photogallery->deletePhoto($_POST['rowid']); 
         ?>
            <script>
                alert("Photo Deleted");
                location.href='managephotos.php';
            </script>
            <?php
      }
       
    if (isset($_POST{"deletebtn"}))
         {
             $photogallery= new JPhotogallery();
             echo $photogallery->viewPhoto($_POST['rowid']);
             exit;
           
         }
       
    if (isset($_POST{"updatebtn"}))
         {
            $photogallery= new JPhotogallery();
            echo $photogallery->updatePhoto($_POST['phototitle'],$_POST['photodescription'],$_POST['ispublished'],$_POST['groupid'],$_POST['rowid']);
            ?>
            <script>
                alert("Updated Successfully");
                location.href='managephotos.php';
            </script>
            <?php
            exit;
         }
          echo "<table  cellspacing='3' cellspadding='0' width='100%'>";
          echo "<tr><td>Group Name</td><td>Photos </td><td>&nbsp;</td></tr>";

    $result=$mysql->select("select * from _jphotogallery where groupid='".$groupid."'");
   
    foreach ($result as $r)
    {
    ?>
    <tr class="mytr">
        <td colspan='5' style="border:1px solid #f1f1f1">
            <form action='' method='post'  >
                <table cellpadding="3" cellspacing="0" width="100%" style="font-size:12px;font-family:arial;color:#444"> 
                    <tr>
                        <td style='width:150px;'> 
                            <select style="width:250px;" name="groupid" id="groupid">
                                <?php foreach(JGroup::getGroupname() as $group) {?>
                                <option value="<?php echo $group['groupid'];?>" <?php echo($group['groupid']==$r['photoid']) ? 'selected="selected"':'';?> ><?php echo $group['groupid'];?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td style='width:350px;'>
                           <img src="../../assets/cms/<?php echo $r["photofilepath"];?>" height="120">
                        </td>
                        
                        <td>
                            <input type='hidden' value='<?php echo $r["photoid"];?>' name='rowid' id='rowid' >
                            <input type='submit' name='updatebtn' value='Update'>
                            <input type='submit' name='deletebtn' value='Delete'>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
    <?php
        
    
    }
    
   
   
       
    
    
?>
</body>
