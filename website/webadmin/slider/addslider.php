<?php include_once(__DIR__."/../header.php"); ?>
 
       <div class="titleBar">Add Slider</div>
        <?php  
            
            
            $obj = new CommonController();
            
            if (!($obj->isLogin())){
              echo $obj->printError("Login Session Expired. Please Login Again");
              exit;
            }
                               
            $obj->err = 0;
            
            if (isset($_POST{"save"})) {
                
                 $param = array("slidertitle"=>$_POST['slidertitle'],"sliderdescription"=>str_replace("'","\\'",$_POST['sliderdescription']),"filename"=>$filename,"ispublished"=>$_POST['ispublished']);
                
                if ($obj->isEmptyField($_POST['slidertitle'])) {
                    echo $obj->printError("Slider Title Shouldn't be blank");
                }
                
                if (isset($_FILES['filepath']['name'])&& (strlen(trim($_FILES["filepath"]["name"])))) {
                        
                    $obj->fileUpload($_FILES['filepath'],__DIR__."/../../assets/".$config['slider'],$config['imageArray'],$config['imgMaxSize'],$param["filename"]);
                } else {
                       echo $obj->printError("Please Attach Slider Image");     
                }
                if ($obj->err==0) {
                    echo ( (JSlider::addSlider($param)>0) ?   $obj->printSuccess("Slider added successfully") : $obj->printError("error adding Slider") );
                    unset($_POST); 
                }else {
                    echo $obj->printErrors();
                }
            } 
        ?>
<script src="<?php echo BaseUrl;?>/../assets/js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="<?php echo BaseUrl;?>/./../../assets/css/demo.css">
<style>
table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
</style>

        <form action="" method="post"  enctype="multipart/form-data">
            <table cellpadding="5" cellspacing="0" align="center">
                <tr>
                    <td style="width:70px;">Slider Title</td>
                    <td><input type="text" name="slidertitle" size="40" style="width:100%;" value="<?php echo isset($_POST['slidertitle']) ? $_POST['slidertitle'] : ""; ?>"></td> 
                </tr>
                <tr>
                    <td colspan="2"><textarea name="sliderdescription" style="height: 100px;width:100%"><?php echo isset($_POST['sliderdescription']) ? $_POST['sliderdescription'] : ""; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>Slider File Upload: <input type="file" class="input" name="filepath"/></td>
                                <td rowspan="2"> 
                                  Is Publish? <select name="ispublished"><option value='1'>Yes</option><option value='0'>No</option></select>
                                </td>
                            </tr>
                        </table>
                   </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="save" value="Save" bgcolor="grey"><input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='viewslider.php'"></td>
                </tr> 
            </table>
        </form>
        <script>$('#success').hide(3000);</script>
 