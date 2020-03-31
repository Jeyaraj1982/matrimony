<?php 
    $response = $webservice->getData("Admin","GetManageBackup");
    if($response['data'][0]['Status']=="Processing"){      ?>
 
 <div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <div style="max-width:770px !important;">
                 <h4 class="card-title">Backup</h4>
                 <div style="text-align: center;">
                    <Span>Your previous request still in process</span><br>
                     <label class="col-form-label" style="font-weight: normal"><?php echo $response['data'][0]['BackupTitle'];?></label><br>
                     <label class="col-form-label" style="font-weight: normal"><?php echo $response['data'][0]['BackupFor'];?></label><br>
                     <label class="col-form-label" style="font-weight: normal">Backup On&nbsp;:&nbsp;<?php echo putDateTime($response['data'][0]['BackupOn']);?></label><br>
                    <a href="<?php echo GetUrl("Staffs/ListofBackup");?>" class="btn btn-default" style="padding:7px 20px" >Continue</a>
                 </div>
                 </div>
            </div>
        </div>
     </div>
 </div>
    
    
    
<?php } else {  ?>
<script>
$(document).ready(function () {
  $("#BackupTitle").blur(function () {
        IsNonEmpty("BackupTitle","ErrBackupTitle","Please Enter Backup Title");
   });
   $("#EmailID").blur(function () {
        if(IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID")){
            IsEmail("EmailID","ErrEmailID","Please Enter Valid Email ID");
        }
   });
});       


function SubmitBackup() {
                         $('#ErrBackupTitle').html("");
                         $('#ErrEmailID').html("");
                         ErrorCount=0;
                        IsNonEmpty("BackupTitle","ErrBackupTitle","Please Enter Backup Title");
                        if(IsNonEmpty("EmailID","ErrEmailID","Please Enter Email ID")){
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid Email ID");
                        }
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
}
</script>
<form method="post" id="frmfrn" onsubmit="return SubmitBackup();">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
	    <div class="row">
		    <div class="col-sm-9">
                <div class="card">
				    <div class="card-body">
					    <div style="max-width:770px !important;">
						    <h4 class="card-title">Backup</h4>    
                            <Span>A full backup will create an archive of all the files and configurations on your website. You can only use this to move your account to another server, or to keep a local copy of your files. You cannot restore full backups through your cPannel interface. </span>                
						    <br><div class="form-group row">
						        <label class="col-sm-3 col-form-label">Backup Title<span id="star">*</span></label>
						        <div class="col-sm-9">
							        <input type="text" class="form-control" id="BackupTitle" name="BackupTitle" placeholder="Backup Title" maxlength="15" value="<?php echo isset($_POST['BackupTitle']) ? $_POST['BackupTitle'] : "";?>">
							        <span class="errorstring" id="ErrBackupTitle"><?php echo isset($ErrBackupTitle)? $ErrBackupTitle : "";?></span>
						        </div>
					        </div>
				            <div class="form-group row">
				                <label class="col-sm-3 col-form-label">Backup Includes<span id="star">*</span></label>
				                <div class="col-sm-3">
				                  <select class="form-control" id="BackupFor"  name="BackupFor" value="<?php echo (isset($_POST['BackupFor']) ? $_POST['BackupFor'] : "");?>">
                                    <option value="Assets & Database" <?php echo ($_POST['BackupFor']=="Assets & Database") ? " selected='selected' " : "";?>>Assets & Database</option>
                                    <option value="Assets only" <?php echo ($_POST['BackupFor']=="Assets only") ? " selected='selected' " : "";?>>Assets only</option>
                                    <option value="Database only" <?php echo ($_POST['BackupFor']=="Database only") ? " selected='selected' " : "";?>>Database only</option>
				                  </select>
				                  <span class="errorstring" id="ErrBackupFor"><?php echo isset($ErrBackupFor)? $ErrBackupFor: "";?></span>
				                </div>
				            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email Address<span id="star">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="EmailID" name="EmailID" placeholder="EmailID" value="<?php echo isset($_POST['EmailID']) ? $_POST['EmailID'] : "";?>">
                                    <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" >
                                <div class="col-sm-12" style="text-align:left">
                                    <a href="javascript:void(0)" onclick="ConfirmCreateBackup()" class="btn btn-primary" name="BtnupdateStaff">Start Backup</a>&nbsp;&nbsp;
                                    <a href="<?php echo GetUrl("Staffs/ListofBackup");?>" class="btn btn-default" style="padding:7px 20px" >Previous Backup</a>
                                </div>
                            </div>
			            </div>
                    </div>
	            </div>
	        </div>
        </div>
    </form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 344px;min-height: 344px;" >
		
			</div>
		</div>
	</div>
<script>
function ConfirmCreateBackup() {
    if(SubmitBackup()) {
            $('#PubplishNow').modal('show'); 
            var content = '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation of backup</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                           + '</div>'
                           + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="'+ImgUrl+'icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to backup<br>'
                                            +'</div>'
                                        +'</div>'
                                    + '</div>'
                                + '</div>'
                            +'</div>'                                                                                                                                                                             
                           + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="Create" onclick="GetTxnPasswordFrBackup()" style="font-family:roboto">Backup</button>'
                           + '</div>';
            $('#Publish_body').html(content);
       } else {
          return false;
       }
     } 
     function GetTxnPasswordFrBackup() {
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation of backup</h4>'
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
                            + '<button type="button" onclick="Backup()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#Publish_body').html(content);            
    }
    function Backup() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }    
        $("#txnPassword").val($("#TransactionPassword").val());
        var param = $("#frmfrn").serialize();
        $('#Publish_body').html(preloading_withText("Loading ...","123"));
        $.post(getAppUrl() + "m=Admin&a=Backup",param,function(result) {
            if (!(isJson(result.trim()))) {
                $('#Publish_body').html(result);
                return ;
            }
            var obj = JSON.parse(result.trim());
            if (obj.status=="success") {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/verifiedtickicon.jpg" width="100px"></p>'
                                    + '<h4 style="text-align:center;">Full Backup in Progress <br> Once the full backup of your account has been completed, you will receive an email at the address you specified, '+data.EmailID+'</h4>'
                                    + '<p style="text-align:center;"><a href="'+AppUrl+'Staffs/ListofBackup" style="cursor:pointer">Continue</a></p>'
                                +'</div>' 
                            +'</div>';
                $('#Publish_body').html(content);
            } else {
                var data = obj.data; 
                var content = '<div  style="height: 300px;">'                                                                              
                                +'<div class="modal-header">'
                                    +'<h4 class="modal-title">Backup</h4>'
                                    +'<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>'
                                +'</div>'
                                +'<div class="modal-body" style="min-height:175px;max-height:175px;">'
                                    + '<p style="text-align:center;margin-top: 40px;"><img src="'+AppUrl+'assets/images/exclamationmark.jpg" width="10%"><p>'
                                        + '<h5 style="text-align:center;color:#ada9a9">'+ obj.message+'</h5><br><br>'
                                        +'<div style="text-align:center"><a class="btn btn-primary" data-dismiss="modal" style="padding-top:5pxtext-align:center;color:white">Continue</a></div>'
                                +'</div>' 
                            +'</div>';
            $('#Publish_body').html(content);
            }
        });
    }
</script>
<?php } ?>