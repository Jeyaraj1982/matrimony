 <script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
 <body style="margin:0px;">
 <div class="titleBar">Manage Main Products</div>
 <style>
 .mytr:hover{background:#f1f1f1;cursor:pointer}
 </style>
<?php 
    include_once("../../config.php");
        
        if (!(CommonController::isLogin())){
            echo CommonController::printError("Login Session Expired. Please Login Again");
            exit;
        }
            
        if (isset($_POST{"viewbtn"})){
            $pageContent =JListing::getFeatures($_POST['rowid']);
       ?>
       <form action='' method="post">
            <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                    <td style="width:150px">Category Name</td>
                    <td><?php echo $pageContent[0]['categoryname'];?></td>
                </tr>
            </table>
                <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['categoryid'];?>"> 
                 <input type="submit" value="Delete" name="cdeletebtn">
                 <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managecategory.php'"> 
       </form>
        <?php
            exit;
        }
     
        if(isset($_POST{"cdeletebtn"})){
            JListing::deleteCategory($_POST['rowid']); 
            
            echo CommonController::printSuccess("Deleted Successfully");
            echo "<script>setTimeout(\"window.open('managecategory.php','rpanel')\",1500);</script>";
      }
       
    if (isset($_POST{"deletebtn"})) {
              $pageContent =JListing::getCategories($_POST['rowid']);  
       ?>
         <form action='' method="post">
            <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                    <td style="width:150px">Category Name</td>
                    <td><?php echo $pageContent[0]['categoryname'];?></td>
                </tr>
            </table>
                <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['categoryid'];?>"> 
                 <input type="submit" value="Delete" name="cdeletebtn">
                 <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managecategory.php'"> 
       </form>
        <?php
       exit;
           
         }
       
    if (isset($_POST{"updatebtn"})){
             JListing::updateCategory($_POST['categoryname'],$_POST['rowid']);
              echo CommonController::printSuccess("Updated Successfully");
              echo "<script>setTimeout(\"window.open('managecategory.php','rpanel')\",1500);</script>";
              
         }
          echo "<table  cellspacing='3' cellspadding='0' style='font-family:Trebuchet MS;' width='100%'>";
          echo "<tr><td>Item Name</td></tr>";

    
   $result = JListing::getFeatures();
    foreach ($result as $r)
    {
    ?>
    <tr class="mytr">
        <td colspan='5' style="border:1px solid #f1f1f1">
            <form action='' method='post'  >
                <table  style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center"> 
                    <tr valign="top">
                        <td style='width:150px;' >
                            <input type="text" value="<?php echo $r["featurename"];?>" name="categoryname">
                        </td>
                        <td>
                            <input type='hidden' value='<?php echo $r["featureid"];?>' name='rowid' id='rowid' >
                            <input type='submit' name='viewbtn' value='View'>
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