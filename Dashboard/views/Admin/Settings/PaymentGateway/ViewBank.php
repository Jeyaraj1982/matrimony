<?php $page="Bank Details";?>
<?php include_once("settings_header.php");?>
<?php   
    $response = $webservice->getData("Admin","BankDetailsForView");
    $Bank= $response['data']['ViewBankDetails'];

?>
<div class="col-sm-10 rightwidget">   
<form method="post" action="" onsubmit="return SubmitNewBank();">
 <h4 class="card-title">Bank Account Details</h4>
 <h4 class="card-title">View Bank Account Details</h4>                    
     <div class="form-group row">
        <div class="col-sm-3">Bank Name</div>
        <div class="col-sm-9"><small style="color:#737373;"><?php echo $Bank['BankName'];?></small></div>                                                                
     </div>
    <div class="form-group row">
      <div class="col-sm-3">Account Name</div>
      <div class="col-sm-9"><small style="color:#737373;"><?php echo $Bank['AccountName'];?></small></div>
    </div>
    <div class="form-group row">
      <div class="col-sm-3">Account Number</div>
      <div class="col-sm-9"><small style="color:#737373;"><?php echo $Bank['AccountNumber'];?></small></div>
    </div>
    <div class="form-group row">
      <div class="col-sm-3">IFS Code</div>
      <div class="col-sm-9"><small style="color:#737373;"><?php echo $Bank['IFSCode'];?></small></div>
    </div>
    <div class="form-group row">
      <div class="col-sm-3">Status</div>
      <div class="col-sm-3"><small style="color:#737373;">
          <?php if($Bank['IsActive']==1){
              echo "Active";
          }                                  
          else{
              echo "Deactive";
          }
          ?>
          </small>
    </div>
    </div>
    <div class="form-group row" >
            <div class="col-sm-6" style="text-align:left">
                <a href="<?php  echo GetUrl("Settings/PaymentGateway/ListofBanks?Filter=Banks&Status=All");?>" class="btn btn-default" style="padding:7px 20px" >Cancel</a>&nbsp;
            </div>
        </div>
</form>


<?php include_once("settings_footer.php");?>                    