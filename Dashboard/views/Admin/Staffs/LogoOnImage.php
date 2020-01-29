
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
                        <h4 class="card-title">Logo On Image</h4>
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
                        <label class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-sm-10"><input type="file" name="file" id="file"></div>
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


           
          
