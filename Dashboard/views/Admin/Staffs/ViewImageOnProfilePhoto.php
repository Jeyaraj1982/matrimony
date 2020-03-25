<?php        
$response = $webservice->getData("Admin","GetImageOnProfilePhotoInformation");
$data  = $response['data']['ImageOnProfilePhoto'];
?>
<form method="post" id="frmfrn" >
    <div class="col-12 grid-margin">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div style="max-width:770px !important;">
                        <h4 class="card-title">Image On Profile Photo</h4>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Browse Image</label>
                            <div class="col-sm-10"><img src="<?php echo AppUrl;?>uploads/ImageOnProfilePhoto/<?php echo $data['ParamA'];?>" style="height:150px;width:200px;border:2px solid #666"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Horizontal Align</label>
                            <label class="col-sm-10 col-form-label"><?php echo $data['ParamB'];?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vertical Align</label>
                            <label class="col-sm-10 col-form-label"><?php echo $data['ParamC'];?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Padding</label>
                            <label class="col-sm-10 col-form-label"><?php echo $data['ParamD'];?>&nbsp;</label>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <a href="<?php echo AppUrl;?>Staffs/ImageOnProfilePhoto">Edit</a>
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


           
          
