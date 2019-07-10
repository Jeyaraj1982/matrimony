<div class="content-wrapper">
    <div class="col-12 stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="form-group row">
               <div class="col-sm-6">
                <h4 class="card-title">Requests</h4>
                <h4 class="card-title">Report</h4>
               </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="ListOfAllBankRequests" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ListOfPendingBankRequests"><small style="font-weight:bold;text-decoration:underline">Pending</small></a>&nbsp;|&nbsp;
                    <a href="ListOfApprovedBankRequests"><small style="font-weight:bold;text-decoration:underline">Approved</small></a>&nbsp;|&nbsp;
                    <a href="ListOfRejectedBankRequests"><small style="font-weight:bold;text-decoration:underline">Rejected</small></a>&nbsp;|&nbsp;
                    <a href="BankRequestReport"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                </div>
            </div>
                <form method="post" action="">
                    <div class="form-group row">
                        <label for="FromDate" class="col-sm-2 col-form-label">From<span id="star">*</span></label>
                        <div class="col-sm-4">
                            <input type="date" name="FromDate" id="FromDate" class="form-control">
                            <span class="errorstring" id="ErrFromDate"><?php echo isset($ErrFromDate)? $ErrFromDate : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ToDate" class="col-sm-2 col-form-label">To<span id="star">*</span></label>
                        <div class="col-sm-4">
                            <input type="date" name="ToDate" id="ToDate" class="form-control">
                            <span class="errorstring" id="ErrToDate"><?php echo isset($ErrToDate)? $ErrToDate : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Type" class="col-sm-2 col-form-label">Type<span id="star">*</span></label>
                        <div class="col-sm-4">
                            <select class="form-control" name="filter" id="filter">
                                <option value="All">All</option>
                                <option value="Pending">Pending</option>
                                <option value="Success">Success</option>
                                <option value="Failure">Failure</option>
                            </select>
                            <span class="errorstring" id="ErrType"><?php echo isset($ErrType)? $ErrType : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Type" class="col-sm-2 col-form-label">Member Code<span id="star">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="MemberCode" id="MemberCode">
                            <span class="errorstring" id="ErrMember"><?php echo isset($ErrMember)? $ErrMember : "";?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4" align="left"> 
                            <button type="submit" name="BtnSearch" name="Report" class="btn btn-primary mr-2">View</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['BtnSearch'])) {
        $response = $webservice->getData("Admin","BankRequests",array("Request"    => "Report",
                                                                      "FromDate"   => $_POST['FromDate'],
                                                                      "ToDate"     => $_POST['ToDate'],
                                                                      "filter"     => $_POST['filter'],
                                                                      "MemberCode" => $_POST['MemberCode']));
?>
<div class="content-wrapper">
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Report</h4>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                          <th>Req Id</th> 
                          <th>Req Date</th> 
                          <th>Bank Name</th> 
                          <th>Txn Amount</th>  
                          <th>Txn Date</th>
                          <th>Txn Mode</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>  
                        <?php foreach($response['data'] as $Request) { ?>
                <tr>
                    <td><?php echo $Request['ReqID'];?></td>
                    <td><?php echo $Request['RequestedOn'];?></td>
                    <td><?php echo $Request['BankName'];?></td>
                    <td><?php echo $Request['RefillAmount'];?></td>
                    <td><?php echo $Request['TransferedOn'];?></td>
                    <td><?php echo $Request['TransferMode'];?></td>
                     <td><?php echo $Request['TxnStatus'];?> </td>
                     <td><a href="<?php echo GetUrl("Requests/Member/ViewBankRequests/". $Request['ReqID'].".htm");?>">View</a></td>
                </tr>
            <?php } ?> 
                       </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
        setTimeout("DataTableStyleUpdate()",500);
    });
</script>
<?php } ?>
