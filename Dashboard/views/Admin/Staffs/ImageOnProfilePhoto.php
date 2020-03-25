<?php 
$page="LogoOnProfilePhoto";     
include_once("views/Admin/Settings/ApplicationSettings/settings_header.php");  
//$response = $webservice->getData("Admin","GetImageOnProfilePhotoInformation");
//$data  = $response['data']['ImageOnProfilePhoto'];
$target_dir = "uploads/";
if (!is_dir($target_dir.'/ImageOnProfilePhoto/')) {
                        mkdir($target_dir.'/ImageOnProfilePhoto/', 0777, true);
                    }
                    
   $target_dir = "uploads/ImageOnProfilePhoto/";
                if (isset($_POST['BtnSave'])) {
                    
                 
                    
                    $err=0;
                    $acceptable = array('image/jpeg','image/jpg','image/png');
                    $acceptable = array('image/png');
                    
                    if (isset($_FILES['File']['name']) && strlen(trim($_FILES['File']['name']))>0) {
                        
                        if(($_FILES['File']['size'] >= 5000000)) {                                                                  
                            $err++;
                            echo "Please upload file. File must be less than 5 megabytes.";
                        }
                            
                        if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
                            $err++;
                            echo "Invalid file type. Only PNG types are accepted.";
                        }
                                                      
                        $ImageOnProfilePhoto = time().$_FILES["File"]["name"];
                       
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"],$target_dir. $ImageOnProfilePhoto))) {
                            $err++;
                            echo "Sorry, there was an error uploading your file.";
                        } else {
                            $_POST['File']= $ImageOnProfilePhoto;
                        }
                        
                    }
                     
                    if ($err==0) {
                        
                        
                        
                        $res =$webservice->getData("Admin","UpdateImageOnProfilePhoto",$_POST);   
                       if ($res['status']=="success") { 
                            $successmessage = $res['message']; 
                        } else {
                            $errormessage = $res['message']; 
                        }
                         
                         
                    }
                }
$response = $webservice->getData("Admin","GetImageOnProfilePhotoInformation");
$data  = $response['data']['ImageOnProfilePhoto'];              
            ?>
<script>
$(document).ready(function () {
    $("#Padding").blur(function () {
        if ($("#Padding").val()<= 0 && $("#File").val()>= 50) {                                                                 
            $("#ErrPadding").html("Please Enter Padding");  
        }else{
            $("#ErrPadding").html("");  
        }
   });
});
function SubmitProfile() { 
     ErrorCount=0;                                                                                                               
     $('#ErrPadding').html(""); 
      
      //IsNonEmpty("Padding","ErrPadding","Please Enter Padding");
      if(IsNonEmpty("Padding","ErrPadding","Please Enter Padding")){
        if (!( parseInt($('#Padding').val())>=0 && parseInt($('#Padding').val())<=50))    {
           $("#ErrPadding").html("Please enter below 50px") ;
           ErrorCount++;
        }
      }
    return (ErrorCount==0) ? true : false;
}     
</script>
<div class="col-sm-10 rightwidget">
    <form method="post" action="" onsubmit="return SubmitProfile();" enctype="multipart/form-data"> 
    <div class="col-lg-12 grid-margin stretch-card">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div >
                        <h4 class="card-title">Image On Profile Photo</h4>
                        <div class="form-group row">                           
                                <div class="col-sm-12">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" onclick="ShowPreview()" class="custom-control-input" id="IsActive" name="IsActive" <?php echo ($data['ParamE']==1) ? ' checked="checked" ' :'';?>>
                                        <label class="custom-control-label" for="IsActive" style="vertical-align: middle;">Enable Image On Profile Photo</label>
                                    </div>
                                </div>
                            </div>
                        <div id="formpreview">
                        <?php //if($data['ParamE']==1){   ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Logo<span style="color:red">*</span></label>
                            <div class="col-sm-9">
                            <img src="<?php echo AppUrl;?>uploads/ImageOnProfilePhoto/<?php echo $data['ParamA'];?>"><br>
                            <?php if (strlen(trim($data['ParamA']))>2) {?>                                                     
                            <input type="file" name="File"  id="File" >
                            <?php } else { ?>                                                                              
                            <input type="file" required name="File"  id="File" >
                            <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">H Position<span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <select required name="HorizontalAlign" id="HorizontalAlign" class="form-control">
                                    <option value="Left" <?php echo (isset($_POST[ 'HorizontalAlign'])) ? (($_POST[ 'HorizontalAlign']=="Left") ? " selected='selected' " : "") : (($data['ParamB']=="Left") ? " selected='selected' " : "");?>>Left</option>
                                    <option value="Middle" <?php echo (isset($_POST[ 'HorizontalAlign'])) ? (($_POST[ 'HorizontalAlign']=="Middle") ? " selected='selected' " : "") : (($data['ParamB']=="Middle") ? " selected='selected' " : "");?>>Middle</option>
                                    <option value="Right" <?php echo (isset($_POST[ 'HorizontalAlign'])) ? (($_POST[ 'HorizontalAlign']=="Right") ? " selected='selected' " : "") : (($data['ParamB']=="Right") ? " selected='selected' " : "");?>>Right</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">V Position<span style="color:red">*</span></label>
                            <div class="col-sm-9">
                                <select required name="VerticalAlign" id="VerticalAlign" class="form-control">
                                    <option value="Top" <?php echo (isset($_POST['VerticalAlign'])) ? (($_POST['VerticalAlign']=="Top") ? " selected='selected' " : "") : (($data['ParamC']=="Top") ? " selected='selected' " : "");?>>Top</option>
                                    <option value="Middle" <?php echo (isset($_POST['VerticalAlign'])) ? (($_POST['VerticalAlign']=="Middle") ? " selected='selected' " : "") : (($data['ParamC']=="Middle") ? " selected='selected' " : "");?>>Middle</option>
                                    <option value="Bottom" <?php echo (isset($_POST['VerticalAlign'])) ? (($_POST['VerticalAlign']=="Bottom") ? " selected='selected' " : "") : (($data['ParamC']=="Bottom") ? " selected='selected' " : "");?>>Bottom</option>   
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Padding<span id="star">*</span></label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" required class="form-control" id="Padding" name="Padding" Placeholder="0" value="<?php echo (isset($_POST['Padding']) ? $_POST['Padding'] : $data['ParamD']);?>">
                                    <div class="input-group-addon">Px</div>
                                </div>
                                <span class="errorstring" id="ErrPadding"><?php echo isset($ErrPadding)? $ErrPadding : "";?></span>
                            </div>
                        </div>
                        <?php// } ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <a href="javascript:void(0)" onclick="ConfirmSaveImageOnProfilePhoto()" class="btn btn-primary mr-2" style="font-family:roboto">Save </a>
                                <input type="submit" name="BtnSave" id="BtnSave" style="display: none;">
                            </div>
                            <!--<div class="col-sm-3">
                                <a href="<?php echo AppUrl;?>Staffs/ViewImageOnProfilePhoto">View</a>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php // if($data['ParamE']=="1") {?>
        <div class="col-4" id="PreviewDiv">
             <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Preview</h4>
                    <img src="../../im.php?p=<?php echo $data['ParamD'];?>&stamp=uploads/ImageOnProfilePhoto/<?php echo $data['ParamA'];?>&src=assets/images/sample_photo.png&h=<?php echo $data['ParamB'];?>&v=<?php echo $data['ParamC'];?>" style="width: 100%;">
                </div>
             </div>
        </div>
        <?php // } ?>
</div>
<br>
</div>
</form>
</div>
<div class="modal" id="DeleteNow" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="DeleteNow_body" style="max-width:500px;min-height:300px;overflow:hidden"></div>
    </div>
</div>
<script>
function ConfirmSaveImageOnProfilePhoto(){
            if (SubmitProfile()) {
            $('#DeleteNow').modal('show'); 
            var content =   '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for save</h4>'
                                + '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>'
                            + '</div>'
                            + '<div class="modal-body">'
                                + '<div class="form-group row" style="margin:0px;padding-top:10px;">'
                                    + '<div class="col-sm-4">'
                                        + '<img src="<?php echo ImageUrl;?>icons/confirmation_profile.png" width="128px">' 
                                    + '</div>'
                                    + '<div class="col-sm-8"><br>'
                                        + '<div class="form-group row">'
                                            +'<div class="col-sm-12">Are you sure want to save this information?</div>'
                                        + '</div>'                                                     
                                    + '</div>'
                                +  '</div>'                    
                            + '</div>' 
                            + '<div class="modal-footer">'
                                + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                                + '<button type="button" class="btn btn-primary" name="BtnSaveProfile" class="btn btn-primary" onclick="GetTxnPasswordSaveImageOnProfilePhoto()" style="font-family:roboto">Continue</button>'
                            + '</div>';                                                                                               
            $('#DeleteNow_body').html(content);
            } else {
            return false;
        }
    }
    function GetTxnPasswordSaveImageOnProfilePhoto () {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for save</h4>'
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
                                    + '<div id="frmTxnPass_error" style="color:red;text-align:center"><br></div>'
                                + '</div>'
                                + '<div class="col-sm-2"></div>'
                            + '</div>'
                        + '</div>'
                      + '</div>'
                        + '<div class="modal-footer">'
                            + '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;'
                            + '<button type="button" onclick="SaveImageOnProfilePhoto()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#DeleteNow_body').html(content);            
    }
    function SaveImageOnProfilePhoto() {
        if ($("#TransactionPassword").val().trim()=="") {
             $("#frmTxnPass_error").html("Please enter transaction password");
             return false;
         }
        $("#txnPassword").val($("#TransactionPassword").val());
        $( "#BtnSave" ).trigger( "click");
        
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
    function ShowPreview() {
         if ($('#IsActive').is(":checked")){
            $('#formpreview').show();
            $('#PreviewDiv').show();
        } else {
            $('#formpreview').hide();
            $('#PreviewDiv').hide();
        }
    }
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
                    <h3 style="text-align:center;">Updated</h3>             
                    <p style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer;color:#489bae">Continue</a></p>
                </div> 
            <?php } ?>
      </div>
  </div>
</div>
           
          
<?php if (($data['ParamE']!=1)) { ?>
<script>
    $('#formpreview').hide();
    $('#PreviewDiv').hide();
</script>
<?php } ?>
<?php include_once("views/Admin/Settings/ApplicationSettings/settings_footer.php");?>                    
