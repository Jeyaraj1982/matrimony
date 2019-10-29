 <body style="margin:0px;">
 <script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<div class="titleBar">Manage Sub ProductCategory</div> 
 <style>
 .mytr:hover{background:#f1f1f1;cursor:pointer}
 </style>
<?php   
        include_once("../../config.php");
        
            if (!(CommonController::isLogin())){
                echo CommonController::printError("Login Session Expired. Please Login Again");
                exit;
            }
            
        if(isset($_POST{"viewbtn"})){
            $pageContent =JProductSubCategory::getProductSubcategory($_POST['rowid']);  
           ?>
            <form action='' method="post">
                <table style="width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                    <tr>
                        <td style="width:150px">SubCategory Name</td>
                        <td><?php echo $pageContent[0]['subcatename'];?></td>
                    </tr>
                </table>
                    <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['subcateid'];?>"> 
                    <input type="submit" value="Delete" name="cdeletebtn">
                    <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managesubproducts.php'"> 
            </form>
        <?php
       exit;
        }
     
      if(isset($_POST{"cdeletebtn"})){
        
        JProductSubCategory::deleteProductSubcategory($_POST['rowid']); 
         ?>
            <script>
                alert("Items Deleted");
                location.href='managesubproducts.php';
            </script>
            <?php
      }
       
      if(isset($_POST{"deletebtn"})){
            $pageContent =JProductSubCategory::getProductSubcategory($_POST['rowid']);  
            ?>
      
           <form action='' method="post">
            <table style="width:100%;font-size:12px;font-family:'Trebuchet MS';color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                    <td style="width:150px">SubCategory Name</td>
                    <td><?php echo $pageContent[0]['subcatename'];?></td>
                </tr>
            </table>
       <input type="hidden" name="rowid" value="<?php echo $pageContent[0]['subcateid'];?>"> 
       <input type="submit" value="Delete" name="cdeletebtn">
       <input type="button" name="cancelbtn" value="Cancel" bgcolor="grey" onclick="location.href='managesubproducts.php'"> 
         </form>
        <?php
       exit;
        }
       
    if (isset($_POST{"updatebtn"})){
            JProductSubCategory::updateProductSubcategory($_POST['subcategoryname'],$_POST['rowid']);
            ?>
            <script>
                alert("Updated Successfully");
                location.href='managesubproducts.php';
            </script>
            <?php
            exit;
         }
          echo "<table  cellspacing='3' cellspadding='0' width='100%'>";
          echo "<tr><td>Item Name</td></tr>";

    $result=$mysql->select("select * from _jsubcategoryproduct");
   
    foreach ($result as $r)
    {
    ?>
    <tr class="mytr">
        <td colspan='5' style="border:1px solid #f1f1f1">
            <form action='' method='post'  >
                <table cellpadding="3" cellspacing="0" width="100%" style="font-size:12px;font-family:'Trebuchet MS';color:#444"> 
                    <tr valign="top">
                        <td style='width:150px;'>
                            <input type="text" value="<?php echo $r["subcatename"];?>" name="subcategoryname">
                        </td>
                        <td>
                            <input type='hidden' value='<?php echo $r["subcateid"];?>' name='rowid' id='rowid' >
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