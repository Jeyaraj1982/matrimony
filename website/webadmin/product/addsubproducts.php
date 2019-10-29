<?php 

        include_once("../../config.php");
                if (!(CommonController::isLogin())){
                echo CommonController::printError("Login Session Expired. Please Login Again");
                exit;
            }
             if(isset($_POST{"save"})) {
                 
                 if(CommonController::isEmptyField($_POST['subcategoryname']) ) {    
                     echo  CommonController::printError("Product Fields are Required"); 
                 }                          
               else if(JProductSubCategory::addProductSubcategory($_POST['subcategoryname'])>0){
                        echo CommonController::PrintSuccess("Items Added successfully");       
               } else {
                        echo CommonController::PrintError("Error Adding Items");
                }        
}
?>
<body style="margin:0px;">
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
<div class="titleBar">Add Product Subcategory</div>
    <form action="" method="post">
        <table cellpadding="5" cellspacing="0" align="center">
                <tr>
                     <td style="width:150px;">Sub Category Name</td>
                     <td><input type="text" name="subcategoryname" style="width:200px;"><br></td> 
               </tr>
                <tr>
                    <td align="left"><input type="submit" name="save" value="Save" bgcolor="grey"> 
                    <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='managesubproducts.php'"></td></td> </td>
              </tr> 
        </table>
    </form>
</body>