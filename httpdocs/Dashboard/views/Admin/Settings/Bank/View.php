<?php   
    $Bank =$mysql->select("select * from _tbl_settings_bankdetails where BankID='".$_REQUEST['Code']."'");
?>

<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bank Account Details</h4>
                </div>
              </div>
</div>                                                                        
<form method="post" action="" onsubmit="return SubmitNewBank();">
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> View Bank Account Details</h4>
                   <form class="form-sample">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-3">Bank Name</div>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Bank[0]['BankName'];?></small></div>                                                                
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-3">Account Name</div>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Bank[0]['AccountName'];?></small></div>
                        </div>
                      </div>
                      </div> 
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-3">Account Number</div>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Bank[0]['AccountNumber'];?></small></div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-3">IFS Code</div>
                          <div class="col-sm-9"><small style="color:#737373;"><?php echo $Bank[0]['IFSCode'];?></small></div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-3">Status</div>
                          <div class="col-sm-3"><small style="color:#737373;">
                              <?php if($Bank[0]['IsActive']==1){
                                  echo "Active";
                              }                                  
                              else{
                                  echo "Deactive";
                              }
                              ?>
                              </small>
                        </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-sm-2"><a href="../ListofBanks" style="text-decoration: underline;">List of Bank</a></div>
                      </div>
                      </div>
                   </div>
                  </form>
              </div>
       </div>
</div>
</form>