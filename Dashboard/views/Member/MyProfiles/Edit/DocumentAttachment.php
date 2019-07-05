<?php
    $page="DocumentAttachment";       
        if (isset($_POST['BtnSave'])) {
        
        $response = $webservice->getData("Member","AttachDocuments",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->GetDraftProfileInformation(array("ProfileID"=>$_GET['Code']));
   ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" onsubmit="">
    <h4 class="card-title">Document Attachments</h4>
    <div class="form-group row">
        <label for="Documents" class="col-sm-3 col-form-label">Document Type<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Documents" name="Documents">
                <option>Choose Documents</option>
                <?php foreach($response['data']['DocumentType'] as $Document) { ?>
                 <option value="<?php echo $Document['SoftCode'];?>" <?php echo ($_POST['Documents']==$Document['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Document['CodeValue'];?></option>
                    <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="Attachment" class="col-sm-3 col-form-label">Attachment<span id="star">*</span></label>
        <div class="col-sm-3">
            <input type="File" class="form-control" id="File" name="File" Placeholder="File">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
           <?php echo $errormessage;?><?php echo $successmessage;?>
        </div>
    </div>
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <button type="submit" name="BtnSave" class="btn btn-primary mr-2" style="font-family:roboto">Save</button>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PutDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
    </div>
    </form>
</div>
<?php include_once("settings_footer.php");?>                    