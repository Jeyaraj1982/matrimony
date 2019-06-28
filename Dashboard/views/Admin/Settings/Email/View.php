<?php
    $response = $webservice->GetEmailApiInfo();
    $Api          = $response['data']['Api'];
?>
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Email Api</h4>
                </div>
              </div>
</div>
<form method="post" action="" >            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Api</h4>
                  <form class="form-sample">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Api Code</div>
                          <div class="col-sm-2"><small style="color:#737373;"><?php echo $Api['ApiCode'];?></small></div>
                        </div>
                      </div>
                      </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Api Name</div>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Api['ApiName'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Host Name</div>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Api['HostName'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Port No</div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Api['PortNumber'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Secure</div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Api['Secure'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">User Name</div>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Api['SMTPUserName'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Password</div>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Api['SMTPPassword'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Sender's Name</div>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Api['SendersName'];?></small></div>
                        </div>
                      </div>                                          
                    </div> 
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Remarks</div>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Api['Remarks'];?></small></div>
                        </div>
                      </div>
                    </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">Status</div>
                          <div class="col-sm-3"><small style="color:#737373;">
                              <?php if($Api['IsActive']==1){
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
                          <div class="col-sm-2" >Created On</div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Api['CreatedOn']);?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-8"><a href="#" >Transaction Report</a></div>
                        </div>
                      </div>
                    </div>
                   <div class="form-group row">
                        <div class="col-sm-2"><a href="../EmailApi" style="text-decoration: underline;">List of Api</a></div>
                   </div>
                </form>
             </div>                                        
          </div>                                             
</div>
</form>                                                  
