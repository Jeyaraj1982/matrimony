<?php
   $response = $webservice->getData("Admin","MemberRequestFromFranchiseeInfo");
   $Request        = $response['data']['Request'];
   $Member         = $response['data']['Member'];
   $Franchisee     = $response['data']['Franchisee'];
?>
 <?php 
 if (isset($_POST['InProccess'])) {
         $response =$webservice->getData("Admin","MemberRequestAddToInProccessMode",$_POST);
        if ($response['status']=="success") {   ?>
           <script>location.href=location.href;</script>
        <?php
        } else {
            $errormessage = $response['message']; 
        }
    }
 ?>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <div style="padding:15px !important;max-width:770px !important;">
                 <h4 class="card-title">Open Request</h4>  
                        <form method="post" id="frmfrn_<?php echo $Request['ReqID'];?>" action="">
                            <input type="hidden" value="" name="txnPassword" id="txnPassword_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="" name="ApproveReason" id="ApproveReason_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="" name="RejectReason" id="RejectReason_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="" name="IsApproved" id="IsApproved_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="" name="IsRejected" id="IsRejected_<?php echo $Request['ReqID'];?>">
                            <input type="hidden" value="<?php echo $_GET['Code'];?>" name="ReqID" id="ReqID">
                            <input type="hidden" value="<?php echo $Request['MemberCode'];?>" name="MemberCode" id="MemberCode">
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Request For Code:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['RequestForCode'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Request For:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['RequestFor'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Request By:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['RequestBy'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Request By Code:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['RequestByCode'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Member Code:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['MemberCode'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Member Name:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['MemberName'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Subject:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo $Request['Subject'];?></small></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Request On:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Request['RequestOn']);?></small></div>
                            </div>
                            
                            <?php if($Request['Status']=="1") {?>
                                <button type="submit" name="InProccess" id="InProccess" class="btn btn-primary">In Proccess</button>
                            <?php } if($Request['Status']=="2") {?>
                            <div class="form-group row">
                                <div class="col-sm-3"><small>Proccess On:</small> </div>
                                <div class="col-sm-3"><small style="color:#737373;"><?php echo putDateTime($Request['ProccessedOn']);?></small></div>
                            </div>
                                <button type="submit" name="Close" id="Close" class="btn btn-primary">Close</button>
                            <?php } ?>
                       
                   </form>   
                  </div>
                 
                </div>
           
            </div>
        </div> 
    <div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>