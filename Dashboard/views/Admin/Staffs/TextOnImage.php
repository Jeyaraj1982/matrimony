
<?php 
if (isset($_POST['savparam'])) {
        $response = $webservice->getData("Admin","UpdateTextOnImageSettings",$_POST);
        if ($response['status']=="success") {
            echo $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
?>
<form method="post" id="frmfrn">
    <div class="col-12 grid-margin">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div style="max-width:770px !important;">
                        <h4 class="card-title">Text On Image</h4>
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Text</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="TextonImage" id="TextonImage" value="<?php echo (isset($_POST['TextonImage']) ? $_POST['TextonImage'] : "");?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Font</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Font" id="Font" value="<?php echo (isset($_POST['Font']) ? $_POST['Font'] : "");?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Size</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Size" id="Size" value="<?php echo (isset($_POST['Size']) ? $_POST['Size'] : "");?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Color</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Color" id="Color" value="<?php echo (isset($_POST['Color']) ? $_POST['Color'] : "");?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">H Postition</label>
                        <div class="col-sm-10">
                            <select name="HPosition" id="HPosition" class="form-control">
                                <option value="Left" <?php echo ($_POST[ 'HPosition']=="Left") ? ' selected="selected" ' : '';?>>Left</option>   
                                <option value="Center" <?php echo ($_POST[ 'HPosition']=="Center") ? ' selected="selected" ' : '';?>>Center</option>   
                                <option value="Right" <?php echo ($_POST[ 'HPosition']=="Right") ? ' selected="selected" ' : '';?>>Right</option>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">V Postition</label>
                        <div class="col-sm-10">
                            <select name="VPosition" id="VPosition" class="form-control">
                                <option value="Left" <?php echo ($_POST[ 'VPosition']=="Left") ? ' selected="selected" ' : '';?>>Left</option>   
                                <option value="Center" <?php echo ($_POST[ 'VPosition']=="Center") ? ' selected="selected" ' : '';?>>Center</option>   
                                <option value="Right" <?php echo ($_POST[ 'VPosition']=="Right") ? ' selected="selected" ' : '';?>>Right</option>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Text Orientation</label>
                        <div class="col-sm-10">
                            <select name="TextOrientation" id="TextOrientation" class="form-control">
                                <option value="Horizontal" <?php echo ($_POST[ 'TextOrientation']=="Horizontal") ? ' selected="selected" ' : '';?>>Horizontal</option>   
                                <option value="Vertical" <?php echo ($_POST[ 'TextOrientation']=="Vertical") ? ' selected="selected" ' : '';?>>Vertical</option>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <button type="submit" name="BtnSave" id="BtnSave" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
        </div>
</div>
<br>
 
</form> 


           
          
