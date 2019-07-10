<?php $response = $webservice->getData("Admin","GetViewPaypalRequests");
     $Requests = $response['data'] ;?>
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
                    <a href="ListOfAllPaypalRequests" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="ListOfPendingPaypalRequests"><small style="font-weight:bold;text-decoration:underline">Pending</small></a>&nbsp;|&nbsp;
                    <a href="ListOfApprovedPaypalRequests"><small style="font-weight:bold;text-decoration:underline">Approved</small></a>&nbsp;|&nbsp;
                    <a href="ListOfRejectedPaypalRequests"><small style="font-weight:bold;text-decoration:underline">Rejected</small></a>&nbsp;|&nbsp;
                    <a href="PaypalReport"><small style="font-weight:bold;text-decoration:underline">Report</small></a>
                </div>
            </div>
            <form method="post" action="" name="form1" id="form1">
            <div class="form-group row">
                <div class="col-sm-3">Paypal Name</div>
                <div class="col-sm-4"><?php echo $Requests['PayPalName'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Paypal Amout</div>
                <div class="col-sm-4"><?php echo $Requests['Amount'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Paypal Account</div>
                <div class="col-sm-4"><?php echo $Requests['PaypalAccountEmail'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">Transaction On</div>
                <div class="col-sm-4"><?php echo $Requests['TransactionOn'];?></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4"><a href="../ListOfPayPalRequests" >List of Requests</a></div>
            </div> 
    </form>
</div>
</div>
</div>
</div>
