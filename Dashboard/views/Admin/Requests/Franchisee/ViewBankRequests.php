<?php
    $response = $webservice->getData("Admin","GetFranchiseeViewBankRequests",array());
    $BankRequest          = $response['data'];
?>
 <?php 
     if (isset($_POST['Approve'])) {  
        $res = $webservice->getData("Admin","ApproveFranchiseeBankWalletRequest",$_POST);
        if ($res['status']=="success") {  
            echo "<script>location.href='../ViewBankRequests/".$BankRequest['ReqID'].".htm'</script>";   
         } else {
            $errormessage = $res['message']; 
            echo $errormessage;
        }
    }
    if (isset($_POST['Reject'])) {  
        $res = $webservice->getData("Admin","RejectFranchiseeBankWalletRequest",$_POST);
        if ($res['status']=="success") {  
            echo "<script>location.href='../ViewBankRequests/".$BankRequest['ReqID'].".htm'</script>";   
         } else {
            $errormessage = $res['message']; 
            echo $errormessage;
        }
    } 
 ?>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <form method="post" action="">
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">View Bank Requests</h4></div>
         </div>
       <div class="form-group row">
            <label class="col-sm-2 col-form-label">Franchisee Name</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['PersonName'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Amount</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo number_format($BankRequest['RefillAmount'],2);?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Bank Name</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['BankName'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Account Number</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['AccountNumber'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">IFSCode</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['IFSCode'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mode</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['TransferMode'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Transaction ID</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['TransactionID'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Transaction Date</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['TransferedOn'];?></label>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Requested On</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['RequestedOn'];?></label>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
             <?php if($BankRequest['IsApproved']=="0" && $BankRequest['IsRejected']=="0"){ ?>
                <button type="submit" name="Approve" id="Approve" class="btn btn-success" >Approve</button>&nbsp;&nbsp;
                <button type="submit" name="Reject" id="Reject" class="btn btn-danger" >Reject</button>
            <?php }?>
            <?php if($BankRequest['IsApproved']=="1" && $BankRequest['IsRejected']=="0"){ ?>
                 <label class=" col-form-label"><?php echo "Approved";?><br><?php echo $BankRequest['ApprovedOn'];?></label>
            <?php }?>
            <?php if($BankRequest['IsApproved']=="0" && $BankRequest['IsRejected']=="1"){ ?>
                 <label class="col-form-label"><?php echo "Rejected";?><br><?php echo $BankRequest['RejectedOn'];?></label>
            <?php }?>     
        </div>
       </div> 
    </form>
    </div>
  </div>
</div>


            
               
 
            
 