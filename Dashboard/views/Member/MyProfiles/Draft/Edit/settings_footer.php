              </div>
            </div>                               
          </div>
        </div>
      </div>
   </div>
  </div>
  <?php
   /* if (isset($_POST['Publish'])) {
        
        $response = $webservice->getData("Member","MemberProfilePublishNow",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    } */
    ?>
    <div style="text-align: right" id="">
        <a href="<?php echo GetUrl("MyProfiles/Draft/View/".$_GET['Code'].".htm ");?>" class="btn btn-primary" name="Preview" style="font-family:roboto">Preview Profile</a>&nbsp;
        <a href="javascript:void(0)" onclick="showConfirmPublish('<?php echo $_GET['Code'];?>')" class="btn btn-success" name="Publish" style="font-family:roboto">Submit Profile</a>&nbsp;
        <a href="javascript:void(0)" onclick="showConfirmDelete('<?php echo $_GET['Code'];?>')" class="btn btn-danger" name="Delete" style="font-family:roboto">Delete Profile</a>
     </div>    
        
        
        <div class="modal" id="PubplishNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="Publish_body" style="height:315px">
            
                </div>
            </div>
        </div>
                                                                                                                       
<script>                                                                                                                              

/* CheckUploadAllDeatils(\''+ProfileID+'\')*/


function showConfirmPublish(ProfileID) {
      $('#PubplishNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'                                                                              
                    +  '<form method="post" id="frm_'+ProfileID+'" name="frm_'+ProfileID+'" action="" >'
                     + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                          + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                        + '<h4 class="modal-title">Submit profile to publish</h4> <br>'
                        +'<div style="text-align:left"> Dear ,<br>'
                        +'<div style="text-align:left">You have selected to "submit now", In this action, your details will send to our Document Authentication Team (DAT). DAT has approved your profile, the profile will pubhlish immediately, so please verify all data before publish.<br><br>'
                        + '<input type="checkbox" name="check" id="agreetopublish" onclick="agreeToPublish();" value="1">&nbsp;<label for="agreetopublish" style="font-weight:normal"> I agree the terms and conditions  </label><br><br>'
                        +  '<button type="button" disabled="disabled" class="btn btn-primary" name="Publish" id="PublishBtn"  onclick="SendOtpForProfileforPublish(\''+ProfileID+'\')" style="font-family:roboto">Yes, send request</button>&nbsp;&nbsp;&nbsp;'
                        +  '<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">No, i will do later</a>'
                       +  '</div><br>'
                    +  '</form>'                                                                                                          
                +  '</div>'
            +  '</div>';
            $('#Publish_body').html(content);
}

function agreeToPublish() {
    
    if($("#agreetopublish").prop("checked") == true){ 
        $('#PublishBtn').removeAttr("Disabled");
    }
    
    if($("#agreetopublish").prop("checked") == false){
        $('#PublishBtn').attr("Disabled","Disabled");
    }
}

    function SendOtpForProfileforPublish(formid) {
        
        var param = $("#frm_"+formid).serialize();
        $('#Publish_body').html(preloader);
        $.post(API_URL + "m=Member&a=SendOtpForProfileforPublish",param).done(function(result2) {
                            $('#Publish_body').html(result2);
                        }).fail(function(xhr, status, error) {
                            $('#Publish_body').html(error_htmlText);
                        });
    }

    function ProfilePublishOTPVerification(frmid) {
        var param = $( "#"+frmid).serialize();
        $('#Publish_body').html(preloader);
        $.post( API_URL + "m=Member&a=ProfilePublishOTPVerification",param).done(function(result2) {
                                $('#Publish_body').html(result2);   
                            }).fail(function(xhr, status, error) {
                                $('#Publish_body').html(error_htmlText);
                            });
    }
    
function ResendSendOtpForProfileforPublish(frmid) {
     var param = $("#"+frmid).serialize();
     $('#Publish_body').html(preloader);
        $.post(API_URL + "m=Member&a=ResendSendOtpForProfileforPublish",param,function(result2) {$('#Publish_body').html(result2);});
}

function showConfirmDelete(ProfileID) {
      $('#PubplishNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'                                                                              
                    +  '<form method="post" id="frm_'+ProfileID+'" name="frm_'+ProfileID+'" action="" >'
                     + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                          + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                        + '<h4 class="modal-title">Delete Profile</h4> <br>'
                        +'<div style="text-align:left"> Dear ,<br><div>'
                        +'<div style="text-align:center">Are you sure want to delete?<br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Delete" id="Delete"  onclick="DeleteProfile(\''+ProfileID+'\')" style="font-family:roboto">Yes</button>&nbsp;&nbsp;&nbsp;'
                        +  '<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">No, i will do later</a>'
                       +  '</div><br>'
                    +  '</form>'                                                                                                          
                +  '</div>'
            +  '</div>';
            $('#Publish_body').html(content);
}
function DeleteProfile(frmid) {
     var param = $("#"+frmid).serialize();
     $('#Publish_body').html(preloader);
        $.post(API_URL + "m=Member&a=DeleteProfile",param,function(result2) {
			$('#Publish_body').html(result2);
		});
} 

</script>
   
                                                                 
