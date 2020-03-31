<?php $page="ccavenue";?>
<?php include_once("settings_header.php");?>
<?php 
    $res =$webservice->getData("Admin","GetPaymentGatewayDetails");
    $Ccavenue = $res['data']['CCavenue']; 
?>
<script>
$(document).ready(function () {
   $("#Name").blur(function () {
        IsNonEmpty("Name","ErrName","Please Enter Name");
   });
   $("#MarchantID").blur(function () {
        if(IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID")){
            IsAlphaNumeric("MarchantID","ErrMarchantID","Please Enter Alpha Numeic Chaacters Only");
        }
   }); 
   $("#SecretKey").blur(function () {
         if(IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key")){
            IsAlphaNumeric("SecretKey","ErrSecretKey","Please Enter Alpha Numeic Chaacters Only");
        }
   });
   $("#SuccessUrl").blur(function () {
        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
   });
   $("#FailureUrl").blur(function () {
        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
   });
   
});       
function SubmitCCavenue() {
                         $('#ErrName').html("");
                         $('#ErrMatchantID').html("");
                         $('#ErrSecretKey').html("");
                         $('#ErrSuccessUrl').html("");
                         $('#ErrFailureUrl').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("Name","ErrName","Please Enter Name");
                        if(IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID")){
                            IsAlphaNumeric("MarchantID","ErrMarchantID","Please Enter Alpha Numeic Chaacters Only");
                        }
                        if(IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key")){
                            IsAlphaNumeric("SecretKey","ErrSecretKey","Please Enter Alpha Numeic Chaacters Only");
                        }
                        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
                        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<?php
                if (isset($_POST['UpdateCCavenuee'])) {
                    $target_dir = "uploads/CCavenue";
                    if (!is_dir('uploads/CCavenue')) {
                        mkdir('uploads/CCavenue', 0777, true);
                    }
                    $err=0;
                    $acceptable = array('image/jpeg','image/jpg','image/png');
                    
                    if (isset($_FILES['CCavenueLogo']['name']) && strlen(trim($_FILES['CCavenueLogo']['name']))>0) {
                        
                        if(($_FILES['CCavenueLogo']['size'] >= 5000000)) {
                            $err++;
                            echo "Please upload file. File must be less than 5 megabytes.";
                        }
                            
                        if((!in_array($_FILES['CCavenueLogo']['type'], $acceptable)) && (!empty($_FILES["CCavenueLogo"]["type"]))) {
                            $err++;
                            echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                        }
                        
                        $CCavenueLogo = time().$_FILES["CCavenueLogo"]["name"];
                        if (!(move_uploaded_file($_FILES["CCavenueLogo"]["tmp_name"],'uploads/CCavenue/' . $CCavenueLogo))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file.";
                        } else {
                            $_POST['CCavenueLogo']= $CCavenueLogo;
                        }
                        
                    }
                    if ($err==0) {
                       
                        $res =$webservice->getData("Admin","EditCCavenue",$_POST);   
                       if ($res['status']=="success") {
                             $successmessage = $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                       
                    }
                    $res =$webservice->getData("Admin","GetPaymentGatewayDetails");
                    $Ccavenue = $res['data']['CCavenue']; 
                }
              
            ?>
<div class="col-sm-10 rightwidget">
<form method="post" id="frmfrPaymentGateway" enctype="multipart/form-data">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="VT0003" name="CcavenueSoftCode" id="CcavenueSoftCode">
    <input type="hidden" value="ccavenue" name="CcavenueCodeValue" id="CcavenueCodeValue">
    <input type="hidden" value="<?php echo $Ccavenue['PaymentGatewayVendorCode'];?>" name="PaymentGatewayVendorCode" id="PaymentGatewayVendorCode">
    <h4 class="card-title">Edit CCavenue</h4>                    
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Name" name="Name" Placeholder="Name" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : $Ccavenue['VenderName'];?>" >
                                <span class="errorstring" id="ErrName"><?php echo isset($ErrName)? $ErrName : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Logo<span id="star">*</span></label>
                          <div class="col-sm-9">
                          <?php if(isset($Ccavenue['VendorLogo'])){?>
                            <img src="<?php echo AppUrl;?>uploads/CCavenue/<?php echo $Ccavenue['VendorLogo'];?>" style="height:200px;width:150px">
                          <?php } ?>
                            <input type="file" id="CCavenueLogo" name="CCavenueLogo">
                            <span class="errorstring" id="ErrCCavenueLogo"><?php echo isset($ErrCCavenueLogo)? $ErrCCavenueLogo : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Marchant ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="MarchantID" name="MarchantID" Placeholder="Marchant ID" value="<?php echo isset($_POST['MarchantID']) ? $_POST['MarchantID'] : $Ccavenue['MarchantID'];?>">
                                <span class="errorstring" id="ErrMarchantID"><?php echo isset($ErrMarchantID)? $ErrMarchantID : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SecretKey" name="SecretKey" Placeholder="Secret Key" value="<?php echo isset($_POST['SecretKey']) ? $_POST['SecretKey'] : $Ccavenue['Secretky'];?>">
                                <span class="errorstring" id="ErrSecretKey"><?php echo isset($ErrSecretKey)? $ErrSecretKey : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mode<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="Mode"  name="Mode" >
                                    <option value="Live" <?php echo (isset($_POST[ 'Mode'])) ? (($_POST[ 'Mode']=="Live") ? " selected='selected' " : "") : (($Ccavenue[ 'VendorMode']=="Live") ? " selected='selected' " : "");?>>Live</option>
                                    <option value="Test" <?php echo (isset($_POST[ 'Mode'])) ? (($_POST[ 'Mode']=="Test") ? " selected='selected' " : "") : (($Ccavenue[ 'VendorMode']=="Live") ? " selected='selected' " : "");?>>Test</option>
                                </select>
                              <span class="errorstring" id="ErrMode"><?php echo isset($ErrMode)? $ErrMode : "";?></span>
                            </div>
                            <label class="col-sm-2 col-form-label">Status<span id="star">*</span></label>
                            <div class="col-sm-3">
                                <select class="form-control" id="Status"  name="Status" >
                                    <option value="1" <?php echo (isset($_POST[ 'Status'])) ? (($_POST[ 'Status']=="1") ? " selected='selected' " : "") : (($Ccavenue[ 'VendorStatus']==1) ? " selected='selected' " : "");?>>Active</option>
                                    <option value="0" <?php echo (isset($_POST[ 'Status'])) ? (($_POST[ 'Status']=="0") ? " selected='selected' " : "") : (($Ccavenue[ 'VendorStatus']==0) ? " selected='selected' " : "");?>>Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SuccessUrl" name="SuccessUrl" Placeholder="Success Url" value="<?php echo isset($_POST['SuccessUrl']) ? $_POST['SuccessUrl'] : $Ccavenue['SuccessUrl'];?>">
                                <span class="errorstring" id="ErrSuccessUrl"><?php echo isset($ErrSuccessUrl)? $ErrSuccessUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="FailureUrl" name="FailureUrl" Placeholder="Failure Url" value="<?php echo isset($_POST['FailureUrl']) ? $_POST['FailureUrl'] : $Ccavenue['FailureUrl'];?>">
                                <span class="errorstring" id="ErrFailureUrl"><?php echo isset($ErrFailureUrl)? $ErrFailureUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="CCAvenueRemarks" name="CCAvenueRemarks" Placeholder="Remarks"><?php echo isset($_POST['CCAvenueRemarks']) ? $_POST['CCAvenueRemarks'] : $Ccavenue['Remarks'];?></textarea>
                                <span class="errorstring" id="ErrCCAvenueRemarks"><?php echo isset($ErrCCAvenueRemarks)? $ErrCCAvenueRemarks : "";?></span>
                            </div>
                        </div>
                       <div class="form-group row" >
                            <div class="col-sm-12" style="text-align:right">
                                &nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageCCavenue?Filter=CCavenue&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                                <a href="javascript:void(0)" onclick="ConfirmEditCcavenue()" class="btn btn-primary mr-2" style="font-family:roboto">Update </a>
                                <input type="submit" name="UpdateCCavenuee" id="UpdateCCavenuee" style="display: none;">
                            </div>
                        </div>
</form>

<div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>
</div>
<script>
function ConfirmEditCcavenue() {
    if(SubmitCCavenue()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of edit ccavenue</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create ccavenue<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="GetTxnPasswordFrEditCcavenue()" style="font-family:roboto">Update</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     }
     function GetTxnPasswordFrEditCcavenue() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for edit ccavenue</h4>'
                            + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                      + '</div>'
                      + '<div class="modal-body">'
                        + '<div class="form-group" style="text-align:center">'
                            + '<img src="'+ImgUrl+'icons/transaction_password.png" width="128px">' 
                            + '<h4 style="text-align:center;color:#ada9a9;margin-bottom: -13px;">Please Enter Your Transaction Password</h4>'
                        + '</div>'
                         + '<div class="form-group">'
                            + '<div class="input-group">'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-8">'
                                    + '<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                                + '<div class="col-sm-12" id="frmTxnPass_error" style="color:red;text-align:center"></div>'
                            + '</div>'
                        + '</div>'
                    + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="EditCcavenue()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    }
    function EditCcavenue() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        $( "#UpdateCCavenuee" ).trigger( "click");
    } 
    <?php if (isset($errormessage) && strlen($errormessage)>0) { ?>
        setTimeout(function(){
            $('#responsemodal').modal("show");
        },1000);
    <?php }    ?>
    <?php if (isset($successmessage) && strlen($successmessage)>0) { ?>
        setTimeout(function(){
            $('#responsemodal').modal("show");
        },1000);
    <?php }    ?>
</script>
<div class="modal" id="responsemodal" data-backdrop="static">
  <div class="modal-dialog">
        <div class="modal-content" style="max-width:500px;min-height:300px;overflow:hidden">
            <?php if (isset($errormessage) && strlen($errormessage)>0) { ?>
                <div class="modal-body" id="response_message" style="min-height:175px;max-height:175px;">'
                    <p style="text-align:center;margin-top: 40px;"><img src="<?php echo ImageUrl;?>exclamationmark.jpg" width="10%"></p>
                    <h3 style="text-align:center;"><?php echo $errormessage;?></h3>             
                    <p style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer;color:#489bae">Continue</a></p>
                </div>
            <?php } ?>
            <?php if (isset($successmessage) && strlen($successmessage)>0) { ?>
                <div class="modal-body" id="response_message" style="min-height:175px;max-height:175px;">
                    <p style="text-align:center;margin-top: 40px;"><img src="<?php echo ImageUrl;?>verifiedtickicon.jpg" width="100px"></p>
                    <h3 style="text-align:center;">Upadted</h3>             
                    <h4 style="text-align:center;">CCavenue</h4>             
                    <p style="text-align:center;"><a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageCCavenue?Filter=CCavenue&Status=All");?>" style="cursor:pointer;color:#489bae">Continue</a></p>
                </div> 
            <?php } ?>
      </div>
  </div>
</div>
<?php include_once("settings_footer.php");?>                    