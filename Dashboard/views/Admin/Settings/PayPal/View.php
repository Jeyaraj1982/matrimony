<?php
    $response = $webservice->getData("Admin","PaypalDetailsForView");
    $Paypal= $response['data']['ViewPaypalDetails'];
?>                                                        
<form method="post" action="" onsubmit="return SubmitNewPaypal();">            
<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Paypal</h4>
                  <form class="form-sample">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Paypal Name</label>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Paypal['PaypalName'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Paypal Email ID</label>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Paypal['PaypalEmailID'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Remarks</label>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Paypal['Remarks'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-3"><span class="<?php echo ($Paypal['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<small style="color:#737373;">
                              <?php if($Paypal['IsActive']==1){
                                  echo "Active";
                              }                                  
                              else{
                                  echo "Deactive";
                              }
                              ?>
                              </small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Created On</label>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo putDateTime($Paypal['CreatedOn']);?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">No of Transaction</label>
                          <div class="col-sm-8"><small style="color:#737373;"><?php echo $Paypal['NoofTransaction'];?></small></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"><a href="../Paypal" style="text-decoration: underline;">List of Paypal</a></div>
                   </div>
                </form>
             </div>                                        
          </div>
</div>
</form>                                                  
