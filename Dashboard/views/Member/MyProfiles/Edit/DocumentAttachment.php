<?php
    $page="DocumentAttachment";
   ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
    <h4 class="card-title">Document Attachments</h4>
    <div class="form-group row">
        <label for="Documents" class="col-sm-3 col-form-label">Document Type<span id="star">*</span></label>
        <div class="col-sm-3">
            <select class="selectpicker form-control" data-live-search="true" id="Documents" name="Documents">
                <option>Choose Documents</option>
                <?php foreach($response['data']['DocumentType'] as $Document) { ?>
                    <option value="<?php echo $Document['SoftCode'];?>">
                        <?php echo $Document['CodeValue'];?>
                    </option>
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
    <div class="form-group row" style="margin-bottom:0px;">
        <div class="col-sm-3">
            <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save</button>
            <br>
            <small style="font-size:11px;"> Last saved:</small><small style="color:#888;font-size:11px;"> <?php echo PrintDateTime($ProfileInfo['LastUpdatedOn']);?></small>
        </div>
    </div>
</div>
<?php include_once("settings_footer.php");?>                    