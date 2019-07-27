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
        <a href="<?php echo GetUrl("MyProfiles/View/".$_GET['Code'].".htm ");?>" class="btn btn-primary" name="Preview" style="font-family:roboto">Preview</a>&nbsp;
        <a href="javascript:void(0)" onclick="showConfirmPublish('<?php echo $_GET['Code'];?>')" class="btn btn-success" name="Publish" style="font-family:roboto">Publish Now</a>
     </div>    
        
        
        <div class="modal" id="PubplishNow" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
                <div class="modal-content" id="Publish_body" style="height:315px">
            
                </div>
            </div>
        </div>

<script>
function showConfirmPublish(ProfileID) {
      $('#PubplishNow').modal('show'); 
      var content = '<div class="Publish_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    +  '<form method="post" id="frm_'+ProfileID+'" name="frm_'+ProfileID+'" action="" >'
                     + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                       +  '<div style="text-align:center">Are you sure want to Publish?  <br><br>'
                        +  '<button type="button" class="btn btn-primary" name="Publish"  onclick="SendOtpForProfileforPublish(\''+ProfileID+'\')">Yes</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">No</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';
            $('#Publish_body').html(content);
}
function SendOtpForProfileforPublish(formid) {
     var param = $("#frm_"+formid).serialize();
     $('#Publish_body').html(preloader);
        $.post(API_URL + "m=Member&a=SendOtpForProfileforPublish",param,function(result2) {$('#Publish_body').html(result2);});
}

function ProfilePublishOTPVerification(frmid) {
         var param = $( "#"+frmid).serialize();
         $('#Publish_body').html(preloader);
                    $.post( API_URL + "m=Member&a=ProfilePublishOTPVerification", 
                            param,
                            function(result2) {
                                $('#Publish_body').html(result2);   
                            }
                    );
              
    } 

</script>
   

