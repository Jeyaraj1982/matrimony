<?php
   // $BankName = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_GET['Code']."'");
?>
<form method="post" action="" onsubmit="">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">View Member Requests</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="MemberId" class="col-sm-3 col-form-label"><small>Member Id</small></label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#fff;border:1px solid #fff" class="form-control" id="MemberId" name="MemberId" value="" placeholder="Member Id">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="MemberName" class="col-sm-3 col-form-label"><small>Member Name</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="MemberName" readonly="readonly" name="MemberName" value="" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                          <div class="form-group row">
                          <label for="CurrentBalance" class="col-sm-3 col-form-label"><small>Current Balance</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="CurrentBalance" readonly="readonly" name="CurrentBalance" value="" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="TransferTo" class="col-sm-3 col-form-label"><small>Transfer To</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="TransferTo" readonly="readonly" name="TransferTo" value="" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="TransferDate" class="col-sm-3 col-form-label"><small>Transfer Date</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="TransferDate" readonly="readonly" name="TransferDate" value="" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="TransferMode" class="col-sm-3 col-form-label"><small>Transfer Mode</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="TransferMode" readonly="readonly" name="TransferMode" value="" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Remarks" class="col-sm-3 col-form-label"><small>Remarks</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Remarks" readonly="readonly" name="Remarks" value="" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="RefillAmount" class="col-sm-3 col-form-label"><small>Refill Amount</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="RefillAmount" readonly="readonly" name="RefillAmount" value="" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="AdminRemarks" class="col-sm-3 col-form-label"><small>Admin Remarks</small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="AdminRemarks" readonly="readonly" name="AdminRemarks" value="" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <a href="#" class="btn btn-success">Aprove</a>&nbsp;
                        <a href="#" class="btn btn-success">Reject</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>