<?php
 $response = $webservice->GetMemberDetails(array("Code"=>$_GET['Code']));
    $Member=$response['data'];    
?>
<form method="post" action="" onsubmit="">
<div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Manage Members</h4>  
                      <h4 class="card-title">View Member Information</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Member Code:</small> </div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberCode'];?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Member Name:</small> </div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MemberName'];?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Mobile Number:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;">+<?php echo $Member['CountryCode'];?>-<?php echo $Member['MobileNumber'];?></small></div>
                          <div class="col-sm-2"><small>Email ID:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  $Member['EmailID'];?></small></div>
                          </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Created on:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  putDateTime($Member['CreatedOn']);?></small></div>
                          <div class="col-sm-2"><small>Status:</small></div>
                        <div class="col-sm-3"><small style="color:#737373;">
                              <?php if($Member['IsActive']==1){
                                  echo "Active";
                              }                                  
                              else{
                                  echo "Deactive";
                              }
                              ?>
                              </small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-3"><small>Franchisee Name:</small></div>
                        <div class="col-sm-3"><span class="<?php echo ($Member['FIsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;&nbsp;<small style="color:#737373;"><?php echo  $Member['FranchiseName'];?> (<?php echo  $Member['FranchiseeCode'];?>)</small></div>                                                         
                </div>                                                                                                        
              </div>                                      
</div>    
</div>                                                                                                    
<div class="col-12 grid-margin">
                  <div class="card">                                                            
                    <div class="card-body">                                                                            
                      <h4 class="card-title">Profiles</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-2"><small>Drafted</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Posted</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Published</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Unpublished</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Expired</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                          <div class="col-sm-2"><small>Rejected</small><br><small style="color:#737373;"><?php echo  "0";?></small></div>
                      </div>
                </div>
              </div>
</div>
<div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Wallet</h4>   
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-6"><small style="color:#737373;"><?php echo "RS 500"?></small></div>
                           <div class="col-sm-2"><small>Mails:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo "30";?></small></div>
                      </div>
                      <div class="form-group row">
                           <div class="col-sm-6"><a href="<?php echo GetUrl("Franchisees/Wallet/RefillWallet");?>"><small>Refill Wallet</small></a></div>
                           <div class="col-sm-2"><small>Notification:</small></div>
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo  "35";?></small></div>
                      </div>
                </div>
              </div>
</div>
<div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title"></h4>   
                      <form class="forms-sample">
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Total Contact Downloaded:</small></div>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo "0";?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Saved Fav:</small></div>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo "0";?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3"><small>Remain Later:</small></div>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo "0";?></small></div>
                      </div> 
                </div>
              </div>
</div>                                                                                     
<div class="col-sm-12 grid-margin" style="text-align: center; padding-top:5px;color:skyblue;">
                        <a href="../ManageMembers"><small style="font-weight:bold;text-decoration:underline">List of Members</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/EditMember/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">Edit Member</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/BlockMember/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Block Member</small></a>&nbsp;|&nbsp;
                        <a href="<?php echo GetUrl("Members/ResetPassword/".$_REQUEST['Code'].".html"); ?>"><small style="font-weight:bold;text-decoration:underline">Reset Password</small></a>
</div>         
</form>
  