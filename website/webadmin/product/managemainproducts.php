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
            $pageContent =JProductMainCategory::getProductMaincategory($_POST['rowid']);
       ?>
       <form action='' method="post">
            <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                    <td style="width:150px">Main Category Name</td>
                    <td><?php echo $pageContent[0]['maincatename'];?></td>
                </tr>
            </table>
                <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['maincateid'];?>"> 
                 <input type="submit" value="Delete" name="cdeletebtn">
                 <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managemainproducts.php'"> 
       </form>
        <?php
            exit;
        }
     
        if(isset($_POST{"cdeletebtn"})){
            JProductMainCategory::deleteProductMaincategory($_POST['rowid']); 
            
            echo CommonController::printSuccess("Deleted Successfully");
            echo "<script>setTimeout(\"window.open('managemainproducts.php','rpanel')\",1500);</script>";
      }
       
    if (isset($_POST{"deletebtn"})) {
              $pageContent =JProductMainCategory::getProductMaincategory($_POST['rowid']);  
       ?>
         <form action='' method="post">
            <table style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                    <td style="width:150px">Main Category Name</td>
                    <td><?php echo $pageContent[0]['maincatename'];?></td>
                </tr>
            </table>
                <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['maincateid'];?>"> 
                 <input type="submit" value="Delete" name="cdeletebtn">
                 <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managemainproducts.php'"> 
       </form>
        <?php
       exit;
           
         }
       
    if (isset($_POST{"updatebtn"})){
             JProductMainCategory::updateProductMaincategory($_POST['maincatename'],$_POST['rowid']);
              echo CommonController::printSuccess("Deleted Successfully");
              echo "<script>setTimeout(\"window.open('managemainproducts.php','rpanel')\",1500);</script>";
              
         }
          echo "<table  cellspacing='3' cellspadding='0' style='font-family:Trebuchet MS;' width='100%'>";
          echo "<tr><td>Item Name</td></tr>";

    $result=$mysql->select("select * from _jmaincateproduct");
   
    foreach ($result as $r)
    {
    ?>
    <tr class="mytr">
        <td colspan='5' style="border:1px solid #f1f1f1">
            <form action='' method='post'  >
                <table  style="margin:10px;width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center"> 
                    <tr valign="top">
                        <td style='width:150px;' >
                            <input type="text" value="<?php echo $r["maincatename"];?>" name="maincatename">
                        </td>
                        <td>
                            <input type='hidden' value='<?php echo $r["maincateid"];?>' name='rowid' id='rowid' >
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
