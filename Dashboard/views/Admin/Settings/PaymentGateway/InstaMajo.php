<?php $page="instamajo";?>
<?php include_once("settings_header.php");?>

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
                if (isset($_POST['CreateInstamajoo'])) {
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
                       
                        $res =$webservice->getData("Admin","CreateInstamajo",$_POST);   
                       if ($res['status']=="success") {
                           unset($_POST);
                             $successmessage = $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                       
                    }
               }
              
            ?>
<div class="col-sm-10 rightwidget" >
<form method="post" id="frmfrPaymentGateway" enctype="multipart/form-data">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="VT0002" name="InstamajoSoftCode" id="InstamajoSoftCode">
    <input type="hidden" value="instamajo" name="InstamajoCodeValue" id="InstamajoCodeValue">
    <h4 class="card-title">Create Instamajo</h4>                    
						<div class="form-group row">
                            <label class="col-sm-3 col-form-label">Instamajo Name<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="InstamajoName" name="InstamajoName" value="<?php echo isset($_POST['InstamajoName']) ? $_POST['InstamajoName'] : "";?>" placeholder="Instamajo Name">
                                <span class="errorstring" id="ErrInstamajoName"><?php echo isset($ErrInstamajoName)? $ErrInstamajoName : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Logo<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="file" id="InstamajoLogo" name="InstamajoLogo">
                            <span class="errorstring" id="ErrInstamajoLogo"><?php echo isset($ErrInstamajoLogo)? $ErrInstamajoLogo : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Action Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ActionUrl" name="ActionUrl" value="<?php echo isset($_POST['ActionUrl']) ? $_POST['ActionUrl'] : "";?>" placeholder="Action Url">
                                <span class="errorstring" id="ErrActionUrl"><?php echo isset($ErrActionUrl)? $ErrActionUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Client ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ClientID" name="ClientID" value="<?php echo isset($_POST['ClientID']) ? $_POST['ClientID'] : "";?>" placeholder="Client ID">
                                <span class="errorstring" id="ErrClientID"><?php echo isset($ErrClientID)? $ErrClientID : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Secret Key<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SecretKey" name="SecretKey" value="<?php echo isset($_POST['SecretKey']) ? $_POST['SecretKey'] : "";?>" placeholder="Secret Key">
                                <span class="errorstring" id="ErrSecretKey"><?php echo isset($ErrSecretKey)? $ErrSecretKey : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mode<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="Mode"  name="Mode" >
                                    <option value="Live" <?php echo ($_POST['Mode']=="Live") ? " selected='selected' " : "";?>>Live</option>
                                    <option value="Test" <?php echo ($_POST['Mode']=="Test") ? " selected='selected' " : "";?>>Test</option>
                                </select>
                              <span class="errorstring" id="ErrMode"><?php echo isset($ErrMode)? $ErrMode : "";?></span>
                            </div>
							<label class="col-sm-2 col-form-label">Status<span id="star">*</span></label>
							<div class="col-sm-3">
							    <select class="form-control" id="Status"  name="Status" >
                                    <option value="1" <?php echo ($_POST['Status']=="1") ? " selected='selected' " : "";?>>Active</option>
							        <option value="0" <?php echo ($_POST['Status']=="0") ? " selected='selected' " : "";?>>Deactive</option>
						        </select>
							</div>
						</div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Success Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SuccessUrl" name="SuccessUrl" value="<?php echo isset($_POST['SuccessUrl']) ? $_POST['SuccessUrl'] : "";?>" placeholder="Success Url">
                                <span class="errorstring" id="ErrSuccessUrl"><?php echo isset($ErrSuccessUrl)? $ErrSuccessUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="FailureUrl" name="FailureUrl" value="<?php echo isset($_POST['FailureUrl']) ? $_POST['FailureUrl'] : "";?>" placeholder="Failure Url">
                                <span class="errorstring" id="ErrFailureUrl"><?php echo isset($ErrFailureUrl)? $ErrFailureUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="InstaRemarks" name="InstaRemarks" placeholder="Remarks"><?php echo isset($_POST['InstaRemarks']) ? $_POST['InstaRemarks'] : "";?></textarea>
                                <span class="errorstring" id="ErrInstaRemarks"><?php echo isset($ErrInstaRemarks)? $ErrInstaRemarks : "";?></span>
                            </div>
                        </div> 
		           
		                <div class="form-group row" >
                            <div class="col-sm-12" style="text-align:right">
                                &nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageInstaMajo?Filter=InstaMajo&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                                <a href="javascript:void(0)" onclick="ConfirmCreateInstamajo()" class="btn btn-primary mr-2" style="font-family:roboto">Create </a>
                                <input type="submit" name="CreateInstamajoo" id="CreateInstamajoo" style="display: none;">
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
function ConfirmCreateInstamajo() {
     
    if(SubmitInstamajo()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create instamajo</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create instamajo<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="GetTxnPasswordFrCreateInstamajo()" style="font-family:roboto">Create</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } 
     function GetTxnPasswordFrCreateInstamajo() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create instamajo</h4>'
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
                            + '<button type="button" onclick="CreateInstamajo()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    }
    function CreateInstamajo() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        $( "#CreateInstamajoo" ).trigger( "click");
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
                    <h3 style="text-align:center;">Created</h3>             
                    <h4 style="text-align:center;">Instamajo</h4>             
                    <p style="text-align:center;"><a href="<?php  echo GetUrl("Settings/PaymentGateway/ManageInstaMajo?Filter=InstaMajo&Status=All");?>" style="cursor:pointer;color:#489bae">Continue</a></p>
                </div> 
            <?php } ?>
      </div>
  </div>
</div>


<?php include_once("settings_footer.php");?>                    