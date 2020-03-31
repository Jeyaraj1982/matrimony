<?php $page="instamajo";?>
<?php include_once("settings_header.php");?>
<?php 
    $res =$webservice->getData("Admin","GetPaymentGatewayDetails");
    $InstaMajo = $res['data']['InstaMajo'];  
?>
<script>
$(document).ready(function () {
   $("#InstamajoName").blur(function () {
        IsNonEmpty("InstamajoName","ErrInstamajoName","Please Enter Instamajo Name");
   });
   $("#ActionUrl").blur(function () {
        IsNonEmpty("ActionUrl","ErrActionUrl","Please Enter Action Url");
   });
   $("#ClientID").blur(function () {
        if(IsNonEmpty("ClientID","ErrClientID","Please Enter Client ID")){
            IsAlphaNumeric("ClientID","ErrClientID","Please Enter Alpha Numeric Characters");
        }
   }); 
   $("#SecretKey").blur(function () {
        if(IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key")){
            IsAlphaNumeric("SecretKey","ErrSecretKey","Please Enter Alpha Numeric Characters");
        }
   });
   $("#SuccessUrl").blur(function () {
        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
   });
   $("#FailureUrl").blur(function () {
        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
   });
   
});       
function SubmitInstamajo() {
                         $('#ErrInstamajoName').html("");
                         $('#ErrActionUrl').html("");
                         $('#ErrClientID').html("");
                         $('#ErrSecretKey').html("");
                         $('#ErrSuccessUrl').html("");
                         $('#ErrFailureUrl').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("InstamajoName","ErrInstamajoName","Please Enter Instamajo Name");
                        IsNonEmpty("ActionUrl","ErrActionUrl","Please Enter Action Url");
                        if(IsNonEmpty("ClientID","ErrClientID","Please Enter Client ID")){
                            IsAlphaNumeric("ClientID","ErrClientID","Please Enter Alpha Numeric Characters");
                        }
                         if(IsNonEmpty("SecretKey","ErrSecretKey","Please Enter Secret Key")){                                         
                            IsAlphaNumeric("SecretKey","ErrSecretKey","Please Enter Alpha Numeric Characters");
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
                if (isset($_POST['UpdateInstamajoo'])) {
                    $target_dir = "uploads/Instamajo";
                    if (!is_dir('uploads/Instamajo')) {
                        mkdir('uploads/Instamajo', 0777, true);
                    }
                    $err=0;
                    $acceptable = array('image/jpeg','image/jpg','image/png');
                    
                    if (isset($_FILES['InstamajoLogo']['name']) && strlen(trim($_FILES['InstamajoLogo']['name']))>0) {
                        
                        if(($_FILES['File']['size'] >= 5000000)) {
                            $err++;
                            echo "Please upload file. File must be less than 5 megabytes.";
                        }
                            
                        if((!in_array($_FILES['InstamajoLogo']['type'], $acceptable)) && (!empty($_FILES["InstamajoLogo"]["type"]))) {
                            $err++;
                            echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                        }
                        
                        $Instamajo = time().$_FILES["InstamajoLogo"]["name"];
                        if (!(move_uploaded_file($_FILES["InstamajoLogo"]["tmp_name"],'uploads/Instamajo/' . $Instamajo))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file.";
                        } else {
                            $_POST['InstamajoLogo']= $Instamajo;
                        }
                        
                    }
                    if ($err==0) {
                       
                        $res =$webservice->getData("Admin","EditInstamajo",$_POST);   
                       if ($res['status']=="success") {
                           unset($_POST);
                             $successmessage = $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                       
                    }
                  $res =$webservice->getData("Admin","GetPaymentGatewayDetails");
                  $InstaMajo = $res['data']['InstaMajo'];    
               }
              
            ?>
<div class="col-sm-10 rightwidget" >
<form method="post" id="frmfrPaymentGateway" enctype="multipart/form-data">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="VT0002" name="InstamajoSoftCode" id="InstamajoSoftCode">
    <input type="hidden" value="instamajo" name="InstamajoCodeValue" id="InstamajoCodeValue">
    <input type="hidden" value="<?php echo $InstaMajo['PaymentGatewayVendorCode'];?>" name="PaymentGatewayVendorCode" id="PaymentGatewayVendorCode">
    <h4 class="card-title">Edit Instamajo</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Instamajo Name<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="InstamajoName" name="InstamajoName" placeholder="Instamajo Name" value="<?php echo isset($_POST['InstamajoName']) ? $_POST['InstamajoName'] : $InstaMajo['VenderName'];?>">
                                <span class="errorstring" id="ErrInstamajoName"><?php echo isset($ErrInstamajoName)? $ErrInstamajoName : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Logo<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <?php if(strlen($InstaMajo['VendorLogo'])>0) {?>
                            <img src="<?php echo AppUrl;?>uploads/Instamajo/<?php echo $InstaMajo['VendorLogo'];?>" style="height:200px;width:150px">
                          <?php } ?>
                            <input type="file" id="InstamajoLogo" name="InstamajoLogo">
                            <span class="errorstring" id="ErrInstamajoLogo"><?php echo isset($ErrInstamajoLogo)? $ErrInstamajoLogo : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Action Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ActionUrl" name="ActionUrl" placeholder="Instamajo Name" value="<?php echo isset($_POST['ActionUrl']) ? $_POST['ActionUrl'] : $InstaMajo['ActionUrl'];?>" >
                                <span class="errorstring" id="ErrActionUrl"><?php echo isset($ErrActionUrl)? $ErrActionUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Client ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ClientID" name="ClientID" placeholder="Client ID" value="<?php echo isset($_POST['ClientID']) ? $_POST['ClientID'] :  $InstaMajo['ClientID'];?>">
                                <span class="errorstring" id="ErrClientID"><?php echo isset($ErrClientID)? $ErrClientID : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SecretKey" name="SecretKey" placeholder="Secret Key" value="<?php echo isset($_POST['SecretKey']) ? $_POST['SecretKey'] :  $InstaMajo['Secretky'];?>">
                                <span class="errorstring" id="ErrSecretKey"><?php echo isset($ErrSecretKey)? $ErrSecretKey : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mode<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="Mode"  name="Mode" >
                                    <option value="Live" <?php echo (isset($_POST[ 'Mode'])) ? (($_POST[ 'Mode']=="Live") ? " selected='selected' " : "") : (($InstaMajo[ 'VendorMode']=="Live") ? " selected='selected' " : "");?>>Live</option>
                                    <option value="Test" <?php echo (isset($_POST[ 'Mode'])) ? (($_POST[ 'Mode']=="Test") ? " selected='selected' " : "") : (($InstaMajo[ 'VendorMode']=="Live") ? " selected='selected' " : "");?>>Test</option>
                                </select>
                              <span class="errorstring" id="ErrMode"><?php echo isset($ErrMode)? $ErrMode : "";?></span>
                            </div>
							<label class="col-sm-2 col-form-label">Status<span id="star">*</span></label>
							<div class="col-sm-3">
							    <select class="form-control" id="Status"  name="Status" >
                                    <option value="1" <?php echo (isset($_POST[ 'Status'])) ? (($_POST[ 'Status']=="1") ? " selected='selected' " : "") : (($InstaMajo[ 'VendorStatus']==1) ? " selected='selected' " : "");?>>Active</option>
                                    <option value="0" <?php echo (isset($_POST[ 'Status'])) ? (($_POST[ 'Status']=="0") ? " selected='selected' " : "") : (($InstaMajo[ 'VendorStatus']==0) ? " selected='selected' " : "");?>>Deactive</option>
                                </select>
							</div>
						</div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SuccessUrl" name="SuccessUrl" placeholder="Success Url" value="<?php echo isset($_POST['SuccessUrl']) ? $_POST['SuccessUrl'] :  $InstaMajo['SuccessUrl'];?>">
                                <span class="errorstring" id="ErrSuccessUrl"><?php echo isset($ErrSuccessUrl)? $ErrSuccessUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="FailureUrl" name="FailureUrl" placeholder="Failure Url" value="<?php echo isset($_POST['FailureUrl']) ? $_POST['FailureUrl'] :  $InstaMajo['FailureUrl'];?>">
                                <span class="errorstring" id="ErrFailureUrl"><?php echo isset($ErrFailureUrl)? $ErrFailureUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="InstaRemarks" name="InstaRemarks" placeholder="Remarks"><?php echo isset($_POST['InstaRemarks']) ? $_POST['InstaRemarks'] :  $InstaMajo['Remarks'];?></textarea>
                                <span class="errorstring" id="ErrInstaRemarks"><?php echo isset($ErrInstaRemarks)? $ErrInstaRemarks : "";?></span>
                            </div>
                        </div>                                                                                                                                                                                                                            
		           
		                <div class="form-group row" >
                            <div class="col-sm-12" style="text-align:right">
                                &nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageInstaMajo?Filter=InstaMajo&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                                <a href="javascript:void(0)" onclick="ConfirmEditInstamajo()" class="btn btn-primary mr-2" style="font-family:roboto">Update </a>
                                <input type="submit" name="UpdateInstamajoo" id="UpdateInstamajoo" style="display: none;">
                            </div>
                        </div>
</form>
</div>
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
		
			</div>
		</div>
	</div>
<script>
function ConfirmEditInstamajo() {
     
    if(SubmitInstamajo()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of edit instamajo</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to edit instamajo<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Update" onclick="GetTxnPasswordFrEditInstamajo()" style="font-family:roboto">Update</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } 
     function GetTxnPasswordFrEditInstamajo() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for edit instamajo</h4>'
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
                            + '<button type="button" onclick="EditInstamajo()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    }
    function EditInstamajo() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        $( "#UpdateInstamajoo" ).trigger( "click");
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
<!-- Modal -->

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
                    <h3 style="text-align:center;">Updated</h3>             
                    <h4 style="text-align:center;">Instamajo</h4>             
                    <p style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer;color:#489bae">Continue</a></p>
                </div> 
            <?php } ?>
      </div>
  </div>
</div>


<?php include_once("settings_footer.php");?>                    