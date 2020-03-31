<?php $page="Payu";?>
<?php include_once("settings_header.php");?>

<script>
$(document).ready(function () {
   $("#PayBi2Name").blur(function () {
        IsNonEmpty("PayBi2Name","ErrPayBi2Name","Please Enter Pay Biz Name");
   });
   $("#MarchantID").blur(function () {
        if(IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID")){
           IsAlphaNumeric("MarchantID","ErrMarchantID","Please Enter Marchant ID"); 
        }
   });
   $("#PayuKey").blur(function () {
        if(IsNonEmpty("PayuKey","ErrPayuKey","Please Enter Key")){
           IsAlphaNumeric("PayuKey","ErrPayuKey","Please Enter Key"); 
        }
   }); 
   $("#SaltID").blur(function () {
        if(IsNonEmpty("SaltID","ErrSaltID","Please Enter Salt ID")){
           IsAlphaNumeric("SaltID","ErrSaltID","Please Enter Salt ID"); 
        }
   });
   $("#SuccessUrl").blur(function () {
        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
   });
   $("#FailureUrl").blur(function () {
        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
   });
});       
function SubmitPayu() {
                         $('#ErrPayBi2Name').html("");
                         $('#ErrMarchantID').html("");
                         $('#ErrPayuKey').html("");
                         $('#ErrSaltID').html("");
                         $('#ErrSuccessUrl').html("");
                         $('#ErrFailureUrl').html("");
                         //$('#ErrPayuRemarks').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("PayBi2Name","ErrPayBi2Name","Please Enter Pay Biz Name");
                        
                        if(IsNonEmpty("MarchantID","ErrMarchantID","Please Enter Marchant ID")){
                           IsAlphaNumeric("MarchantID","ErrMarchantID","Please Enter Marchant ID"); 
                        }
                        if(IsNonEmpty("PayuKey","ErrPayuKey","Please Enter Key")){
                           IsAlphaNumeric("PayuKey","ErrPayuKey","Please Enter Key"); 
                        }
                        if(IsNonEmpty("SaltID","ErrSaltID","Please Enter Salt ID")){
                           IsAlphaNumeric("SaltID","ErrSaltID","Please Enter Salt ID"); 
                        }
                      //  if(IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url")){
                       //    IsUrl("SuccessUrl","ErrSuccessUrl","Please Enter Success Url"); 
                        //}
                        IsNonEmpty("SuccessUrl","ErrSuccessUrl","Please Enter Success Url");
                        IsNonEmpty("FailureUrl","ErrFailureUrl","Please Enter Failure Url");
                     //   IsNonEmpty("PayuRemarks","ErrPayuRemarks","Please Enter Remarks");
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<?php
                if (isset($_POST['CreatePayu'])) {
                    $target_dir = "uploads/Payu";
                    if (!is_dir('uploads/Payu')) {
                        mkdir('uploads/Payu', 0777, true);
                    }
                    $err=0;
                    $acceptable = array('image/jpeg','image/jpg','image/png');
                    
                    if (isset($_FILES['File']['name']) && strlen(trim($_FILES['File']['name']))>0) {
                        
                        if(($_FILES['File']['size'] >= 5000000)) {
                            $err++;
                            echo "Please upload file. File must be less than 5 megabytes.";
                        }
                            
                        if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
                            $err++;
                            echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                        }
                        
                        $Payu = time().$_FILES["File"]["name"];
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"],'uploads/Payu/' . $Payu))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file.";
                        } else {
                            $_POST['File']= $Payu;
                        }
                        
                    }
                    if ($err==0) {
                       
                        $res =$webservice->getData("Admin","CreatePayu",$_POST);   
                       if ($res['status']=="success") {
                             $successmessage = $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                       
                    }
                }
              
            ?>
<div class="col-sm-10 rightwidget">
<form method="post" id="frmfrPaymentGateway" enctype="multipart/form-data">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="VT0001" name="PayuSoftCode" id="PayuSoftCode">
    <input type="hidden" value="Payu" name="PayuCodeValue" id="PayuCodeValue">
    <h4 class="card-title">Create Payu</h4>                    
    <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Payu Biz Name<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PayBi2Name" name="PayBi2Name" value="<?php echo isset($_POST['PayBi2Name']) ? $_POST['PayBi2Name'] : "";?>" Placeholder="Payu Biz Name">
                                <span class="errorstring" id="ErrPayBi2Name"><?php echo isset($ErrPayBi2Name)? $ErrPayBi2Name : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Payu Biz Logo<span id="star">*</span></label>
                          <div class="col-sm-9">
                            <input type="file" id="File" name="File">
                            <span class="errorstring" id="ErrPayBi2Logo"><?php echo isset($ErrPayBi2Logo)? $ErrPayBi2Logo : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Marchant ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="MarchantID" name="MarchantID" value="<?php echo isset($_POST['MarchantID']) ? $_POST['MarchantID'] : "";?>" Placeholder="Marchant ID">
                                <span class="errorstring" id="ErrMarchantID"><?php echo isset($ErrMarchantID)? $ErrMarchantID : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Key<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PayuKey" name="PayuKey" value="<?php echo isset($_POST['PayuKey']) ? $_POST['PayuKey'] : "";?>" Placeholder="Key">
                                <span class="errorstring" id="ErrPayuKey"><?php echo isset($ErrPayuKey)? $ErrPayuKey : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Salt ID<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="SaltID" name="SaltID" value="<?php echo isset($_POST['SaltID']) ? $_POST['SaltID'] : "";?>" Placeholder="Salt ID">
                                <span class="errorstring" id="ErrSaltID"><?php echo isset($ErrSaltID)? $ErrSaltID : "";?></span>
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
                                <input type="text" class="form-control" id="SuccessUrl" name="SuccessUrl" value="<?php echo isset($_POST['SuccessUrl']) ? $_POST['SuccessUrl'] : "";?>" Placeholder="Success Url">
                                <span class="errorstring" id="ErrSuccessUrl"><?php echo isset($ErrSuccessUrl)? $ErrSuccessUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Failure Url<span id="star">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="FailureUrl" name="FailureUrl" value="<?php echo isset($_POST['FailureUrl']) ? $_POST['FailureUrl'] : "";?>" Placeholder="Failure Url">
                                <span class="errorstring" id="ErrFailureUrl"><?php echo isset($ErrFailureUrl)? $ErrFailureUrl : "";?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="PayuRemarks" name="PayuRemarks" Placeholder="Remarks"><?php echo isset($_POST['PayuRemarks']) ? $_POST['PayuRemarks'] : "";?></textarea>
                                <span class="errorstring" id="ErrPayuRemarks"><?php echo isset($ErrPayuRemarks)? $ErrPayuRemarks : "";?></span>
                            </div>
                        </div> 
		           
		<div class="form-group row" >
			<div class="col-sm-12" style="text-align:right">
				&nbsp;<a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayu?Filter=Payu&Status=All");?>" class="btn btn-default" style="padding:7px 20px">Cancel</a>&nbsp;
                <a href="javascript:void(0)" onclick="ConfirmCreatePayu()" class="btn btn-primary mr-2" style="font-family:roboto">Create </a>
                <input type="submit" name="CreatePayu" id="CreatePayu" style="display: none;">
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
function ConfirmCreatePayu() {
     
    if(SubmitPayu()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of create payu</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to create payu<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="GetTxnPasswordFrCreatePayu()" style="font-family:roboto">Create</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     }
function GetTxnPasswordFrCreatePayu() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for create payu</h4>'
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
                            + '<button type="button" onclick="CreatePayu()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    }
function CreatePayu() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());   
        $( "#CreatePayu" ).trigger( "click");
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
                    <h4 style="text-align:center;">Payu</h4>             
                    <p style="text-align:center;"><a href="<?php  echo GetUrl("Settings/PaymentGateway/ManagePayu?Filter=Payu&Status=All");?>" style="cursor:pointer;color:#489bae">Continue</a></p>
                </div> 
            <?php } ?>
      </div>
  </div>
</div>
<?php include_once("settings_footer.php");?>
                    