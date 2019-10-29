  <?php 
        include_once("../../config.php");
        
                if (!(CommonController::isLogin())){
                    echo CommonController::printError("Login Session Expired. Please Login Again");
                    exit;
                } 

            if (isset($_POST{"save"})) {
                 if(CommonController::isEmptyField($_POST['maincatename'])) {
                    echo  CommonController::printError("Product Fields are Required"); 
                    
                 }                          
                 else if(JProductMainCategory::addProductMaincategory($_POST['maincatename'])>0){
                    echo CommonController::printSuccess("Items Added successfully");       
                 } else {
                    echo CommonController::printError("Error Adding Items");
                 }        
            }

?>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<body style="margin:0px;">
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>
<div class="titleBar">Add Main Products</div> 
    <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
        <table cellpadding="5" cellspacing="0" align="center">
                <tr>
                     <td style="width:150px;">Main Category Name</td>
                     <td><input type="text" name="maincatename"  size="40" style="width:250px;"><br></td> 
               </tr>
                <tr>
                    <td align="left"><input type="submit" name="save" value="Save" bgcolor="grey">  
                    <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='managemainproducts.php'"></td>
              </tr> 
        </table>
    </form>
    <script>$('#success').hide(3000);</script>  
</body>