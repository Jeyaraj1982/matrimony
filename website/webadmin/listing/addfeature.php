<?php 
 include_once("../header.php") ;

    if (isset($_POST{"save"})) {
        if(CommonController::isEmptyField($_POST['maincatename'])) {
            echo  CommonController::printError("Fields are Required"); 
        } else {
            echo (JListing::addFeatures($_POST['maincatename'],$string)>0) ? CommonController::printSuccess($string) :  CommonController::printError($string);
        }
    }
?>
    <div class="title_Bar">Manage Feature</div> 
    
    <form action="" method="post"  enctype="multipart/form-data">
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td style="width:150px;" class="label">Feature Name</td>
                <td><input type="text" name="maincatename"  size="40" style="width:250px;"><br></td> 
            </tr>
            <tr>
                <td align="left"><input type="submit" name="save" value="Save" bgcolor="grey">  
                <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='managemainproducts.php'"></td>
            </tr> 
        </table>
    </form>
<hr>
  <?php
    
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
    <script>$('#success').hide(3000);</script>  