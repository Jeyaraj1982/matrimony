<?php
  $response = $webservice->getData("Admin","GetMemberInfo"); 
  $Member          = $response['data']['MemberInfo'];
  if (isset($_POST['SendMail'])) {
        
        $response = $webservice->getData("Admin","MemberResetPasswordSendMail",array("GUID"=>$_GET['Code']));
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
?>
<script>
    function SubmitSearch() {
        
        $('#ErrMemberDetails').html("");
        
        ErrorCount=0;
        
        if(IsNonEmpty("MemberDetails","ErrMemberDetails","Please Enter Valid Name or Mobile Number or Email")){
           IsSearch("MemberDetails","ErrMemberDetails","Please Enter more than 3 characters"); 
        }
        
        if (ErrorCount==0) {
            return true;
        } else{
            return false;
        }
    }
</script>
<div class="col-12 stretch-card">                                         
                  <div class="card">
                    <div class="card-body">
                    <form action="" method="post">
                    <h4 class="card-title">Member Information</h4>
                    <h4 class="card-title">Reset Password</h4>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Member Name:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberName'];?></small></div>
                          <div class="col-sm-3"><small>Mobile Number:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MobileNumber'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Email ID:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['EmailID'];?></small></div>
                          <div class="col-sm-3"><small>Status:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"> 
                          <?php if($Member['IsActive']==1){
                                  echo "Active";
                              }
                              else{
                                  echo "Deactive";
                              }
                              ?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Franchisee Name:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  $Member['FranchiseName'];?></small></div>
                        </div>
                        <?php if($Member['IsActive']==1){      ?>
                            <div class="form-group row">
                            <div class="col-sm-3"><small>Reason for Reset Password</small></div>
                            <div class="9"><textarea rows="2" cols="33" id="ResetPassword" name="ResetPassword"></textarea></div>
                            </div>
                            <?php echo $successmessage;?><?php echo $errormessage;?>
                            <div class="form-group row">
                            <button type="submit" name="SendMail" class="btn btn-success mr-2">Send Mail</button>
                        </div>
                        <?php } ?>
                        <?php  if($Member['IsActive']==0){
                          echo "Please Active Member try again";
                        }   
                        ?> 
                                    
      </form>              
  </div>
 </div>
</div>                                        
                      