<html>    
    <body style="margin:0px;">
        <div style='font-family:arial;font-size:13px;border:1px solid #ccc;background:#ccc;padding:3px;font-weight:bold;color:#444;'>Add Slider</div>
        <?php  
            include_once("../../config.php");

            if (isset($_POST{"save"})) {
                
                if (CommonController::isEmptyField($_POST['slidertitle']) || CommonController::isEmptyField($_POST['sliderdescription'])) {
                   
                    echo CommonController::printError("All Fields are Required");
                    
                } elseif (in_array($_FILES["filepath"]["type"],$imageArray)) {
                    
                    if ($_FILES["filepath"]["size"]<=$imgMaxSize) {
                        $filename = CommonController::formatFileName(basename($_FILES['filepath']['name']));
                        echo (move_uploaded_file($_FILES['filepath']['tmp_name'],strtolower("../../assets/cms/".$filename))) ? ( (JSlider::addSlider($_POST['slidertitle'],$_POST['sliderdescription'],$filename,$_POST['ispublished'])>0) ?   CommonController::printSuccess("Slider added successfully") : CommonController::printError("error adding Slider") ) : CommonController::printError("There was an error uploading the file, please try again!");
                    } else {
                        echo CommonController::printError("File Size should have lessthan ".number_format($imgMaxSize/8/1024/1024,2)." MB"); 
                    }                                            
                }
            } 
        ?>
        <form action="" method="post"  enctype="multipart/form-data">
            <table style="margin:10px;width:100%;font-size:12px;font-family:arial;color:#333" cellpadding="3" cellspacing="0" align="center">
                <tr>
                    <td style="width:150px;">Slider Title</td>
                    <td><input type="text" name="slidertitle" size="40" style="width:250px;"></td> 
                </tr>
                <tr>
                    <td style="vertical-align: top;">Slider Description</td>
                    <td><textarea cols="28" rows="4" name="sliderdescription"></textarea></td> 
                </tr>
                <tr>
                    <td style="width:180px;height:40px;">Slider File Upload</td>
                    <td><input type="file" class="input" size="30" name="filepath"/></td>
                </tr>
                <tr>
                    <td style="width:150px;">Published</td>
                    <td><select name="ispublished"><option value="1">Yes</option><option value="0">No</option></select></td> 
                </tr>
                <tr>
                    <td align="left"><input type="submit" name="save" value="Save" bgcolor="grey"><input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='manageslider.php'"></td>
                </tr> 
            </table>
        </form>
    </body>
</html>