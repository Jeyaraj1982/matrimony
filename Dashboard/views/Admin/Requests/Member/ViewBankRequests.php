<?php
    $response = $webservice->getData("Admin","GetMemberViewBankRequests",array());
    $BankRequest          = $response['data'];
?>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
    <form method="post" id="frmmBnk_<?php echo $BankRequest['ReqID'];?>"  >
        <input type="hidden" value="" name="txnPassword" id="txnPassword_<?php echo $BankRequest['ReqID'];?>">
        <input type="hidden" value="" name="ApproveReason" id="ApproveReason_<?php echo $BankRequest['ReqID'];?>">
        <input type="hidden" value="" name="RejectReason" id="RejectReason_<?php echo $BankRequest['ReqID'];?>">  
        <input type="hidden" value="" name="IsApproved" id="IsApproved_<?php echo $BankRequest['ReqID'];?>">
        <input type="hidden" value="" name="IsRejected" id="IsRejected_<?php echo $BankRequest['ReqID'];?>">
        <input type="hidden" value="<?php echo $BankRequest['ReqID'];?>" name="ReqID" >
        <div class="form-group row">
            <div class="col-sm-6"><h4 class="card-title">View Bank Requests</h4></div>
         </div>
       <div class="form-group row">
            <label class="col-sm-2 col-form-label">Member Name</label>                 
            <label class="col-sm-3 col-form-label" style="color:#737373;">:&nbsp;&nbsp;<?php echo $BankRequest['MemberName'];?></label>
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
                <a href="javascript:void(0)" onclick="Member.showConfirmApproveMemBankReq('<?php echo $BankRequest['ReqID'];?>')" class="btn btn-success" style="font-family:roboto">Approve</a>
                &nbsp;&nbsp;<a href="javascript:void(0)" onclick="Member.showConfirmRejectMemBankReq('<?php echo $BankRequest['ReqID'];?>')" class="btn btn-danger" style="font-family:roboto">Reject</a>
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
<div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>

            
               
 
            
 