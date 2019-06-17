<?php
  $response = $webservice->ResetPassword($_POST); 
  $Member=$response['data'];
                    ?> 
<div class="col-12 stretch-card">                                         
                  <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Franchisee Information</h4>
                    <h4 class="card-title">Reset Password</h4>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Member Name:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MemberName'];?></small></div>
                          <div class="col-sm-3"><small>Mobile Number:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['MobileNumber'];?></small></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-3"><small>Email ID:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member[0]['EmailID'];?></small></div>
                          <div class="col-sm-3"><small>Status:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"> 
                          <?php if($Member[0]['IsActive']==1){
                                  echo "Active";
                              }
                              else{
                                  echo "Deactive";
                              }
                              ?></small></div>
                        </div>
                        <?php if($Member[0]['IsActive']==1){      ?>
                            <div class="form-group row">
                            <div class="col-sm-3"><small>Reason for Reset Password</small></div>
                            <div class="9"><textarea rows="2" cols="33" id="ResetPassword" name="ResetPassword"></textarea></div>
                            </div>
                            <div class="form-group row">
                            <button type="submit" name="SendMail" class="btn btn-success mr-2">Send Mail</button>
                        </div>
                        <?php } ?>
                        <?php  if($Member[0]['IsActive']==0){
                          echo "Please Active Franchisee try again";
                        }   
                        ?> 
                                    
                    
  </div>
 </div>
</div>                                        
                      