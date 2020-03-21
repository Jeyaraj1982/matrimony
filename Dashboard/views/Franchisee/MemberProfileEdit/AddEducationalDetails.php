<?php
    $page="EducationDetails";
 /*   if (isset($_POST['BtnSave'])) {
        
        $response = $webservice->getData("Franchisee","AddEducationalDetails",$_POST);
        if ($response['status']=="success") {
              echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm'</script>";
        } else {
            $errormessage = $response['message']; 
        }  
    }*/
   ?>
   <?php
                if (isset($_POST['BtnSave'])) {
                    
                    $target_dir = "uploads/";
					if (!is_dir('uploads/profiles/'.$_GET['Code'].'/edudoc')) {
						mkdir('uploads/profiles/'.$_GET['Code'].'/edudoc', 0777, true);
					}
                    $err=0;
                    $_POST['File']= "";
                    $acceptable = array('image/jpeg',
                                        'image/jpg',
                                        'image/png'
                                    );
                     
                  if(($_FILES['File']['size'] >= 5000000)) {
                    $err++;
                           echo "File must be less than 5 megabytes.";
                    }
                            
                    if((!in_array($_FILES['File']['type'], $acceptable)) && (!empty($_FILES["File"]["type"]))) {
                        $err++;
                           echo "Invalid file type. Only JPG,PNG,JPEG types are accepted.";
                    }

                    
                    if (isset($_FILES["File"]["name"]) && strlen(trim($_FILES["File"]["name"]))>0 ) {
                        $EducationDetails = time().$_FILES["File"]["name"];
                        if (!(move_uploaded_file($_FILES["File"]["tmp_name"],'uploads/profiles/'.$_GET['Code'].'/edudoc/' . $EducationDetails))) {
                           $err++;
                           echo "Sorry, there was an error uploading your file.";
                        }
                    }
                    
                    if ($err==0) {
                        $_POST['File']= $EducationDetails;
                        $res =$webservice->getData("Franchisee","AddEducationalDetails",$_POST);
                       /* echo  ($res['status']=="success") ? $dashboard->showSuccessMsg($res['message'])
                                                           : $dashboard->showErrorMsg($res['message']);   */
                        if ($res['status']=="success") {                
                             echo "<script>location.href='../EducationDetails/".$_GET['Code'].".htm?msg=success'</script>";   
                        } else {
                           $errormessage = $res['message']; 
                        }
                    } 
                }
              
            ?>
   <?php                 
            $response = $webservice->getData("Franchisee","GetViewAttachments",(array("ProfileCode"=>$_GET['Code'])));
$Education=$response['data']['Attachments'];
             ?>
<?php include_once("settings_header.php");?>

<script>
$(document).ready(function() {
    $("#Educationdetails").change(function() {
        if ($("#Educationdetails").val()=="0") {
            $("#ErrEducationdetails").html("Please select education");  
        }else{
            $("#ErrEducationdetails").html("");  
        }
    });
    $("#EducationDegree").change(function() {
        if ($("#EducationDegree").val()=="0") {
            $("#ErrEducationDegree").html("Please select education details");  
        }else{
            $("#ErrEducationDegree").html("");  
        }
    });
    $("#EducationDegree").change(function() {
        if ($("#EducationDegree").val()=="0") {
            $("#ErrEducationDegree").html("Please select education details");  
        }else{
            $("#ErrEducationDegree").html("");  
        }
    });
        $("#OtherEducationDegree").change(function() {
            if(IsNonEmpty("OtherEducationDegree","ErrOtherEducationDegree","Please enter your education details")){
                     OtherEducationDegree("OtherEducationDegree","ErrOtherEducationDegree","Please enter alphabet characters only");
                }
        });
});
function submitEducation()  {
            
            $('#ErrEducationdetails').html("");
            $('#ErrEducationDegree').html("");
            $('#ErrOtherEducationDegree').html("");
            
            ErrorCount=0;
            
            if($("#Educationdetails").val()=="0"){
                ErrorCount++;
                document.getElementById("ErrEducationdetails").innerHTML="Please select education"; 
            } 
            
            if($("#EducationDegree").val()=="0"){
                ErrorCount++;
                document.getElementById("ErrEducationDegree").innerHTML="Please select education details"; 
            }
            
            if ($('#EducationDegree').val()=="Others") {
                if(IsNonEmpty("OtherEducationDegree","ErrOtherEducationDegree","Please enter your education details")){
                     OtherEducationDegree("OtherEducationDegree","ErrOtherEducationDegree","Please enter alphabet characters only");
                }
            }
              
            
            return (ErrorCount==0) ? true : false;
         
        }


</script>
<div class="col-sm-10 rightwidget">
    <form method="post" action="" name="form1" id="form1" onsubmit="return submitEducation()" enctype="multipart/form-data">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value='<?php echo $_GET['Code'];?>' name="Code">
                     <h4 class="card-title">Education Details</h4>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Education<span id="star">*</span></label> 
                           <div class="col-sm-10">
                            <select class="selectpicker form-control" data-live-search="true" name="Educationdetails" id="Educationdetails">
                                <option value="0">Choose Education</option>
                                    <?php foreach($response['data']['EducationDetail'] as $EducationDetail) { ?>
                                    <option value="<?php echo $EducationDetail['CodeValue'];?>" <?php echo ($_POST['Educationdetails']==$EducationDetail['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $EducationDetail['CodeValue'];?></option>
                            <?php } ?> 
                            </select>
                            <span class="errorstring" id="ErrEducationdetails"></span>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Education details<span id="star">*</span></label> 
                           <div class="col-sm-10">
                            <select class="selectpicker form-control" data-live-search="true" name="EducationDegree" id="EducationDegree" onchange="addOtherEducationDetails();">
                                <option value="0">Choose Education Degree</option>
                                    <?php foreach($response['data']['EducationDegree'] as $EducationDegree) { ?>
                                    <option value="<?php echo $EducationDegree['CodeValue'];?>" <?php echo ($_POST['EducationDegree']==$EducationDegree['CodeValue']) ? " selected='selected' " : "";?>> <?php echo $EducationDegree['CodeValue'];?></option>
                            <?php } ?>   
                            </select>
                            <span class="errorstring" id="ErrEducationDegree"></span>
                           </div>
                        </div>
                        <div class="form-group row" id="Education_additionalinfo">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10" ><input type="text" class="form-control" maxlength="50" id="OtherEducationDegree" placeholder="Education details" name="OtherEducationDegree" value="<?php echo (isset($_POST['OtherEducationDegree']) ? $_POST['OtherEducationDegree'] : $ProfileInfo['OtherEducationDegree']);?>">
                            <span class="errorstring" id="ErrOtherEducationDegree"><?php echo isset($ErrOtherEducationDegree)? $ErrOtherEducationDegree : "";?></span></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">                                                        
                                <input type="text" class="form-control" maxlength="50" name="EducationDescription" placeholder="Education Description" id="EducationDescription" value="<?php echo (isset($_POST['EducationDescription']) ? $_POST['EducationDescription'] : $response['data']['EducationDescription']);?>" style="margin-bottom:5px">
                                <label class="col-form-label" style="padding-top:0px;">Max 50 characters&nbsp;&nbsp;|&nbsp;&nbsp;<span id="textarea_feedback"></span></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Attachment</label>
                            <div class="col-sm-10"><input type="File" id="File" name="File" Placeholder="File"><span class="errorstring" id="ErrFile"></span></div>
                        </div>
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-12" style="text-align:left">
                                <a href="javascript:void(0)" onclick="ConfirmSaveEducationDetails()" class="btn btn-primary mr-2" style="font-family:roboto">Save Education Details </a>
                                <input type="submit" name="BtnSave" id="BtnSave" style="display: none;">
                            </div>
                        </div>
                </form>
</div>
  <div class="modal" id="DeleteNow" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="DeleteNow_body" style="max-width:500px;min-height:300px;overflow:hidden"></div>
    </div>
</div>

<script>
$(document).ready(function() {
    var text_max = 50;
    var text_length = $('#EducationDescription').val().length;
    $('#textarea_feedback').html(text_length + ' characters typed');
    $('#EducationDescription').keyup(function() {
        var text_length = $('#EducationDescription').val().length;
        var text_remaining = text_max - text_length;
        $('#textarea_feedback').html(text_length + ' characters typed');
    });
});
function addOtherEducationDetails () {
            if ($('#EducationDegree').val()=="Others") {
                $('#Education_additionalinfo').show();
            } else {
                $('#Education_additionalinfo').hide();
            }
        }
        addOtherEducationDetails();
function ConfirmSaveEducationDetails(){
            if (submitEducation()) {
            $('#DeleteNow').modal('show'); 
            var content =   '<div class="modal-header">'
                                + '<h4 class="modal-title">Confirmation for save education details</h4>'
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
                                + '<button type="button" class="btn btn-primary" name="BtnSaveProfile" class="btn btn-primary" onclick="GetTxnPasswordSaveEducationDetails()" style="font-family:roboto">Continue</button>'
                            + '</div>';                                                                                               
            $('#DeleteNow_body').html(content);
            } else {
            return false;
        }
    }
    
    function GetTxnPasswordSaveEducationDetails () {
        
        var content =  '<div class="modal-header">'
                            + '<h4 class="modal-title">Confirmation for save education details</h4>'
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
                            + '<button type="button" onclick="SaveEducationDetails()" class="btn btn-primary" >Continue</button>'
                        + '</div>';
        $('#DeleteNow_body').html(content);            
    }
    
    function SaveEducationDetails() {
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
    
</script>
<div class="modal" id="responsemodal" data-backdrop="static">
  <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Save education details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top:5px;"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body" id="response_message" style="min-height:175px;max-height:175px;">   
            <?php if (isset($errormessage) && strlen($errormessage)>0) { ?>
                <p style="text-align:center;margin-top: 40px;"><img src="<?php echo ImageUrl;?>exclamationmark.jpg" width="10%"><p>
                <h5 style="text-align:center;color:#ada9a9"><?php echo $errormessage;?></h5><br><br>
            <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button>
            </div>
      </div>
  </div>
</div>
<?php include_once("settings_footer.php");?>      
             