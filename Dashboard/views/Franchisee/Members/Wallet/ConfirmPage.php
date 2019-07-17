<?php
  $response = $webservice->RefillWallet($_POST); 
  $Member=$response['data'];
                    ?> 

<form method="post" action="<?php echo GetUrl("Members/Wallet/TransferedSuccessfully");?>" onsubmit="return SubmitDetails();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">                                         
                  <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Transfer Page</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Member Code" class="col-sm-3 col-form-label"><small>Member Code :</small></label>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Member[0]['MemberCode'];?></small>
                          </div>
                        </div>                                                                                                       
                        <div class="form-group row">
                          <label for="Member Name" class="col-sm-3 col-form-label"><small>Member Name :</small></label>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Member[0]['MemberName'];?></small>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="MemberPhoneNumber" class="col-sm-3 col-form-label"><small>Member MobileNo:</small></label>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Member[0]['MobileNumber'];?></small>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="MemberEmail" class="col-sm-3 col-form-label"><small>Member Email  :</small></label>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Member[0]['EmailID'];?></small>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="AmountToTransfer" class="col-sm-3 col-form-label"><small>Amount :</small></label>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Member[0]['Amount'];?></small>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                        <div class="col-sm-4">
                       <button type="submit" name="BtnNext" class="btn btn-success mr-2">Transfer Now</button></div>
                       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="SearchMemberDetails"><small>Cancel</small> </a></div>
                         </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form> 