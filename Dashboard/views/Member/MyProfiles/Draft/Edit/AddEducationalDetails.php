<?php
    $page="EducationDetails";
    if (isset($_POST['BtnSave'])) {
        
        $response = $webservice->getData("Member","AddEducationalDetails",$_POST);
        //print_r($response);
        if ($response['status']=="success") {                
             echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm'</script>";
        } else {
            $errormessage = $response['message']; 
        }
    }
   ?> 
                   
   <?php                 
            $response = $webservice->getData("Member","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
            $Education=$response['data']['Attachments'];
             ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
<form method="post" action="" onsubmit="">
                               <div style="height: 315px;">
                     <h4 class="card-title">Educational Details</h4>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Education<span id="star">*</span></label> 
                           <div class="col-sm-8">
                            <select class="selectpicker form-control" data-live-search="true" name="Educationdetails">
                                <option value="0">Choose Education</option>
                                    <?php foreach($response['data']['EducationDetail'] as $EducationDetail) { ?>
                                    <option value="<?php echo $EducationDetail['CodeValue'];?>" <?php echo ($_POST['Educationdetails']==$EducationDetail['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $EducationDetail['CodeValue'];?></option>
                            <?php } ?> 
                            </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Education Details<span id="star">*</span></label> 
                           <div class="col-sm-8">
                            <select class="selectpicker form-control" data-live-search="true" name="EducationDegree">
                                <option value="0">Choose Education Degree</option>
                                    <?php foreach($response['data']['EducationDegree'] as $EducationDegree) { ?>
                                    <option value="<?php echo $EducationDegree['CodeValue'];?>" <?php echo ($_POST['EducationDegree']==$EducationDegree['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $EducationDegree['CodeValue'];?></option>
                            <?php } ?>   
                            </select>
                           </div>                                                
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-8"><input type="text" class="form-control" name="EducationRemarks" id="EducationRemarks" value="<?php echo (isset($_POST['EducationRemarks']) ? $_POST['EducationRemarks'] : $response['data']['EducationRemarks']);?>"></div>
                        </div>
                       <!-- <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Attachment</label>
                            <div class="col-sm-8"><input type="file" name="EducationAttachment"></div>
                        </div> -->
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:center;color:red">
                                <span style="color:red"><?php echo $errormessage;?><?php echo $successmessage;?></span> 
                            </div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:left">
                                <button type="submit" name="BtnSave" class="btn btn-primary mr-2" style="font-family:roboto">Save Education Details</button>
                            </div>
                        </div>
                </div>
                </form>
                

</div>
<?php include_once("settings_footer.php");?>      
             