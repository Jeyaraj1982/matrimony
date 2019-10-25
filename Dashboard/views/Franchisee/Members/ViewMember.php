<?php
 $response = $webservice->GetMemberDetails(array("Code"=>$_GET['Code']));
    $Member=$response['data'];    
?>   
<style>
    .ft-left-nav li a{color:#333}
    .ft-left-nav li:hover{background: #dee7fc;} 
    .ft-left-nav li {color:black;}
    .linkactive1{color:#fff  !important;cursor:pointer;border-bottom:transparent;background:#5983e8;}
    .linkactive1:hover{background:#5983e8;color:#333}
    .linkactive1 a{color:#fff !important;font-weight: bold;} 
</style>
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
                <div class="form-group row">
                    <div class="col-sm-6">
                    </div>
                </div>
                  <?php 
                         $response = $webservice->getData("Franchisee","GetMemberProfileforView",array("ProfileFrom"=>"All"));   
                         if (sizeof($response['data'])>0) {                                                                 
                         ?>
                        <?php foreach($response['data']as $P) { 
                            $Profile = $P['ProfileInfo'];
                   ?>
               <div style="min-height: 200px;background:white;padding:20px" class="box-shaddow">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                        <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                            <img src="<?php echo $P['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                        <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $P['Position'];?></div>    
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br> 
                                                <?php  echo "Last Saved: ".time_elapsed_string($Profile['LastUpdatedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".putDateTime($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['Height'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Religion'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Caste'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['MaritalStatus'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['OccupationType'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['AnnualIncome'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                           <div style="float:right;line-height: 1px;">
                                <?php if($Profile['RequestToVerify']==1 && $Profile['IsApproved']==0){ ?>
                                    <a href="<?php echo GetUrl("ViewPostedProfile/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php } elseif($Profile['IsApproved']==1){  ?>
                                    <a href="<?php echo GetUrl("ViewPublishedProfile/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                    <?php } else {?>
                                        <a href="<?php echo GetUrl("MyProfiles/Draft/Edit/GeneralInformation/".$Profile['ProfileCode'].".htm ");?>">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("ViewDraftProfile/".$Profile['ProfileCode'].".htm ");?>">View</a>
                                        <?php  }    ?>     
                            </div>
                        </div>  
                        <br> 
                  <?php }} else {?>  
                  <div style="padding:80px;text-align:center;color:#aaa">
                        <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px">
                        <Br> No profiles found in your account
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                    </div> 
                  <?php } ?>
                </div>
              </div>
            </div>
<div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Wallet</h4>   
                      <form class="forms-sample">
                      <?php $res = $webservice->getData("Franchisee","GetMemberWalletBalance"); ?>
                      <div class="form-group row">
                           <div class="col-sm-2"><small>Balance:</small></div>
                           <div class="col-sm-3"><small style="color:#737373;"><?php echo $res['data']['WalletBalance'];?></small></div>
                      </div>
                </div>
              </div>
</div>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <div class="form-group-row">
                <div class="col-sm-12">
                    <div class="col-sm-3" style="width: 15%;">
                        <div class="sidemenu" style="width: 170px;margin-left: -58px;margin-bottom: -41px;margin-top: -30px;border-right: 1px solid #eee;">
                            <ul class="ft-left-nav fusmyacc_leftnav" style="padding: 0px;list-style: none;">
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="WalletRequests") ? ' linkactive1 ':'';?>" id="WalletRequests" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('WalletRequests')" class="Notification" style="text-decoration:none"><span>Wallet Requests</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="WalletTransactions") ? ' linkactive1 ':'';?>" id="WalletTransactions" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('WalletTransactions')" class="Notification" style="text-decoration:none"><span>Wallet Transactions</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Orders") ? ' linkactive1 ':'';?>" id="Orders" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Orders')" class="Notification" style="text-decoration:none"><span>Orders</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Invoice") ? ' linkactive1 ':'';?>" id="Invoice" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Invoice')" class="Notification" style="text-decoration:none"><span>Invoice</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="RecentlyViewed") ? ' linkactive1 ':'';?>" id="RecentlyViewed" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('RecentlyViewed')" class="Notification" style="text-decoration:none"><span>Recently Viewed</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="RecentlyWhoViewed") ? ' linkactive1 ':'';?>" id="RecentlyWhoViewed" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('RecentlyWhoViewed')" class="Notification" style="text-decoration:none"><span>Recently Who Viewed</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Favorited") ? ' linkactive1 ':'';?>" id="Favorited" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Favorited')" class="Notification" style="text-decoration:none"><span>Favorited</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Mutual") ? ' linkactive1 ':'';?>" id="Mutual" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Mutual')" class="Notification" style="text-decoration:none"><span>Mutual</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="WhoLiked") ? ' linkactive1 ':'';?>" id="WhoLiked" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('WhoLiked')" class="Notification" style="text-decoration:none"><span>Who Liked</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="LoginLogs") ? ' linkactive1 ':'';?>" id="LoginLogs" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('LoginLogs')" class="Notification" style="text-decoration:none"><span>Login Logs</span></a>
                                </li>
                                <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Activities") ? ' linkactive1 ':'';?>" id="Activities" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                    <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Activities')" class="Notification" style="text-decoration:none"><span>Activities</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>  
                    <div class="col-sm-9" style="margin-top: -8px;" >
                        <div class="Col-sm-12" id="resdiv" style="width: 100%;">    

                         </div>
                         <div style="display:none">
                            <div class="WalletRequests" id="WalletRequestsdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Wallet Requests</h4>
                                <?php $response = $webservice->getData("Franchisee","GetMemberWalletAndProfileDetails",array("DetailFor"=>"WalletRequests")); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                            <thead>  
                                                <tr>
                                                    <th>Req Id</th> 
                                                    <th>Req Date</th> 
                                                    <th>Bank Name</th> 
                                                    <th>A/C Number</th> 
                                                    <th>Txn Amount</th>  
                                                    <th>Txn Date</th>
                                                    <th>Txn Mode</th>
                                                    <th>Txn ID</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>  
                                            </thead>
                                            <tbody>  
                                            <?php foreach($response['data'] as $Requests) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $Requests['ReqID'];?></td>
                                                    <td><?php echo PutDateTime($Requests['RequestedOn']);?></td>
                                                    <td><?php echo $Requests['BankName'];?></td>
                                                    <td><?php echo $Requests['AccountNumber'];?></td>
                                                    <td style="text-align:right"><?php echo number_format($Requests['RefillAmount'],2);?></td>
                                                    <td><?php echo PutDate($Requests['TransferedOn']);?></td>
                                                    <td><?php echo $Requests['TransferMode'];?></td>
                                                    <td><?php echo $Requests['TransactionID'];?></td>
                                                    <td><?php if($Requests['IsApproved']==0 && $Requests['IsRejected']==0){
                                                        echo "Pending";
                                                        }if($Requests['IsApproved']==1 && $Requests['IsRejected']==0){
                                                            echo "Approved";
                                                        }if($Requests['IsApproved']==0 && $Requests['IsRejected']==1){
                                                            echo "Rejected";}
                                                    ?></td>
                                                    <td><a href="<?php echo GetUrl("MyAccounts/ViewBankRequest/". $Requests['ReqID'].".htm");?>">View</a></td>
                                                </tr>
                                            <?php } ?>            
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No Requests found at this time<br><br>
                                </div>     
                              <?php } ?>                                   
                            </div>
                            
                            <div class="WalletTransactions" id="WalletTransactionsdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Wallet Transactions</h4>
                                  <?php $response = $webservice->getData("Franchisee","GetMemberWalletAndProfileDetails",array("DetailFor"=>"WalletTransactions")); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                            <thead>  
                                               <tr>
                                                    <th>Transaction Date</th> 
                                                    <th>Particulars</th> 
                                                    <th style="text-align:right">Credits</th> 
                                                    <th style="text-align:right">Debits</th>  
                                                    <th style="text-align:right">Available Balance</th>
                                                </tr> 
                                            </thead>
                                            <tbody>  
                                            <?php foreach($response['data'] as $Requests) {
                                            ?>
                                                <tr>
                                                    <td><?php echo PutDateTime($Requests['TxnDate']);?></td>
                                                    <td><?php echo $Requests['Particulars'];?></td>
                                                    <td style="text-align:right"><?php echo number_format($Requests['Credits'],2);?></td>
                                                    <td style="text-align:right"><?php echo number_format($Requests['Debits'],2);?></td>
                                                    <td style="text-align:right"><?php echo number_format($Requests['AvailableBalance'],2);?></td>
                                                </tr>
                                            <?php } ?>            
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No transactions found at this time<br><br>
                                </div>     
                              <?php } ?>   
                            </div>
                            
                            <div class="Orders" id="Ordersdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                         <h4>Orders</h4>
                                         <?php $response = $webservice->getData("Franchisee","GetMemberWalletAndProfileDetails",array("DetailFor"=>"Order")); ?>
                                 <?php if (sizeof($response['data'])>0) {   ?>
                                    <div class="table-responsive">
                                    <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                        <thead>  
                                            <tr>
                                                <th>Order Number</th> 
                                                <th>Order Date</th> 
                                                <th style="text-align:right">Order Value</th> 
                                                <th>Invoice Number</th> 
                                                <th></th> 
                                            </tr>  
                                        </thead>
                                        <tbody>  
                                        <?php foreach($response['data'] as $Orders) {
                                        ?>
                                            <tr>
                                                <td><?php echo $Orders['OrderNumber'];?></td>
                                                <td><?php echo PutDateTime($Orders['OrderDate']);?></td>
                                                <td style="text-align:right"><?php echo number_format($Orders['OrderValue'],2);?></td>
                                                <td>
                                                    <?php if($Orders['IsPaid']==1){ 
                                                         echo $Orders['InvoiceNumber'];
                                                    } else{ ?>
                                                       <button type="submit" name="Paynow" class="btn btn-primary" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Pay Now</button>&nbsp;&nbsp; 
                                                       <button type="submit" name="Cancel" class="btn btn-danger" style="font-family: roboto;padding-top: 1px;padding-bottom: 1px;">Cancel</button> 
                                                  <?php }  ?>
                                                    
                                                </td>
                                                <td><a href="#">View</a></td>
                                            </tr>
                                        <?php } ?>            
                                        </tbody>                        
                                    </table>
                                </div>
                                <?php } else {?>
                                    <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                        <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                        No orders found at this time<br><br>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="Invoice" id="Invoicediv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                         <h4>Invoice</h4>
                                         <?php $response = $webservice->getData("Franchisee","GetMemberWalletAndProfileDetails",array("DetailFor"=>"Invoice")); ?>
                                         <?php if (sizeof($response['data'])>0) {   ?>
                                    <div class="table-responsive">
                                    <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                        <thead>  
                                            <tr>
                                                <th>Invoice Number</th> 
                                                <th>Invoice Date</th> 
                                                <th>Order Number</th> 
                                                <th>Order Date</th> 
                                                <th style="text-align:right">Invoice Value</th> 
                                                <th></th>
                                            </tr>  
                                        </thead>
                                        <tbody>  
                                        <?php foreach($response['data'] as $Invoice) {
                                        ?>
                                            <tr>
                                                <td><?php echo $Invoice['InvoiceNumber'];?></td>
                                                <td><?php echo PutDateTime($Invoice['InvoiceDate']);?></td>
                                                <td><?php echo $Invoice['OrderNumber'];?></td>
                                                <td><?php echo PutDateTime($Invoice['OrderDate']);?></td>
                                                <td style="text-align:right"><?php echo number_format($Invoice['InvoiceValue'],2);?></td>
                                                <td><a href="#">View</a></td>
                                            </tr>
                                        <?php } ?>            
                                        </tbody>                        
                                    </table>
                                </div>
                                <?php } else {?>
                                    <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                        <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                        No invoices found at this time<br><br>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="RecentlyViewed" id="RecentlyVieweddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Recently Viewed</h4>
                                   <?php $response = $webservice->getData("Franchisee","GetMemberWalletAndProfileDetails",array("DetailFor"=>"Recentlyviewed")); 
                                   print_R($response);
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                      <?php foreach($response['data']as $P) { 
                                            $Profile = $P['ProfileInfo'];
                                            ?>
                                        <div class="profile_horizontal_row" id="div_<?php echo $Profile['ProfileCode']; ?>">
                                            <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $P['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    </div>
                    <div class="col-sm-9">
                            <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                       <div class="col-sm-4">
                                       <div style="text-align:right;">
                        <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <span style="font-size: 12px;cursor:ponter;color:#fff" id="span_<?php echo $Profile['ProfileCode']; ?>">&nbsp;&nbsp;&nbsp;</span>
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;float:right">  
                                            <?php } else if ($Profile['isMutured']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" style="cursor:pointer !important;">&nbsp;&nbsp;<img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php } else{?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                        </div>
                        </div> 
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:35px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".time_elapsed_string($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>                                                                                      
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                                            <div style="float:right;line-height: 1px;">
                                <a href="javascript:void(0)" onclick="RequestToshowUpgrades('<?php echo $Profile['ProfileID'];?>')">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php if ($Profile['IsDownloaded']==0) { ?>
                                    <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">Download</a>
                                <?php } else { ?>
                                    Alredy Downloaded
                                <?php } ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=MyRecentViewed");?>">view</a>
                            </div>
                                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                </div>
                            </div>
                                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px"></div>
                                </div>
                            </div>
                                        </div>
                                 <?php } } else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No profiles found at this time<br><br>
                                </div>     
                              <?php } ?> 
                                
                            </div>
                            <div class="RecentlyWhoViewed" id="RecentlyWhoVieweddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Recently Who Viewed</h4>
                                
                                
                            </div>
                            <div class="Favorited" id="Favoriteddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                         <h4>Favorited</h4>
                            </div> 
                            <div class="WhoLiked" id="WhoLikeddiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                         <h4>Who Liked</h4>
                            </div>
                            <div class="Mutual" id="Mutualdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                         <h4>Mutual</h4>
                            </div>
                            <div class="LoginLogs" id="LoginLogsdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Login Logs</h4>
                                       <?php $response = $webservice->getData("Franchisee","GetMemberWalletAndProfileDetails",array("DetailFor"=>"LoginLogs")); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                             <thead>  
                                                <tr>
                                                    <th></th> 
                                                    <th></th> 
                                                    <th></th> 
                                                    <th>Loggedin</th>  
                                                    <th>Last accessed</th>  
                                                    <th>Loggedout</th>
                                                    <th>IP Address</th>
                                                    <th>Country</th>
                                                </tr>  
                                            </thead>
                                            <tbody>  
                                           <?php foreach($response['data'] as $History) {
                    
                                                if ($History['LoginFrom']=="Web") {
                                                    $LoginFrom   = "domain.svg";
                                                    $accessTitle ="Web Browser";
                                                } 
                                                
                                                if ($History['Device']=="Desktop") {
                                                    $device      = "desktop.svg";
                                                    $deviceTitle = "Desktop";
                                                }
                                                
                                                if ($History['Device']=="Mobile") {
                                                    $device      = "smartphone.svg";
                                                    $deviceTitle = "Smart Phone";
                                                }
                                        ?>
                                        <tr>
                                            <td style="width:16px">
                                                <?php if ($History['LoginStatus']==1){?>
                                                    <img src="<?php echo ImagePath?>tick.gif" tilte="Successed Login" style="border-radius:0px !important;width: 16px;height: 16px;">
                                                <?php }else{ ?>
                                                    <img src="<?php echo ImagePath?>Red-Cross-Mark-PNG-Pic.png" tilte="Failed Login"  style="border-radius:0px !important;width: 10px;height: 10px;">
                                                <?php } ?>
                                            </td>
                                            <td style="width:16px"><img src="<?php echo ImagePath.$LoginFrom?>" title="<?php echo $accessTitle;?>" style="border-radius:0px !important;width: 16px;height: 16px;"></td>
                                            <td style="width:16px"><img src="<?php echo ImagePath.$device?>" title="<?php echo $deviceTitle;?>" style="border-radius:0px !important;width: 16px;height: 16px;"></td>
                                            <td style="width:110px"><?php echo putDateTime($History['LoginOn']);?></td>                         
                                            <td style="width:110px"><?php echo (strlen(trim($History['LastAccessOn']))>0) ? putDateTime($History['LastAccessOn']) : "";?></td>
                                            <td style="width:110px"><?php echo (strlen(trim($History['UserLogout']))>0) ? putDateTime($History['UserLogout']) : "";?></td>
                                            <td style="width:80px"><?php echo $History['BrowserIp'];?></td>
                                            <td><?php echo $History['CountryName'];?></td>
                                        </tr>
                                            <?php } ?>            
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No transactions found at this time<br><br>
                                </div>     
                              <?php } ?> 
                            </div>
                            <div class="Activities" id="Activitiesdiv" style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                <h4>Activities</h4>
                                  <?php $response = $webservice->getData("Franchisee","GetMemberWalletAndProfileDetails",array("DetailFor"=>"Activities")); 
                                ?>
                                    <?php if (sizeof($response['data'])>0) {   ?>
                                        <div class="table-responsive">
                                        <table id="myTable" class="table table-striped" style="width:100%;border-bottom:1px solid #ccc;">
                                            <thead>  
                                               <tr>
                                                    <th style="width: 110px;;">Activity On</th>
                                                    <th>Activity</th> 
                                                </tr>
                                            </thead>
                                            <tbody>  
                                           <?php foreach($response['data'] as $History) { ?>
                                                <tr>
                                                    <td><?php echo putDateTime($History['ActivityOn']);?></td>
                                                    <td><?php echo $History['ActivityString'];?></td>
                                                </tr>
                                            <?php } ?>          
                                            </tbody>                        
                                        </table>
                                    </div>
                                 <?php }else { ?>
                                   <div style="padding:40px;padding-bottom:100px;text-align:center;color:#aaa">
                                    <img src="<?php echo ImageUrl;?>receipt.svg" style="height:128px"><Br><Br>
                                    No Activities found at this time<br><br>
                                </div>     
                              <?php } ?>  
                            </div>
                         </div>
                     </div>
                   </div>
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
<script>
 function loadPaymentOption(pOption){
     $("#resdiv").html("WalletRequestsdiv");
     if (pOption=="WalletRequests") {                  
        $("#resdiv").html($('#WalletRequestsdiv').html());
        $('#WalletRequests').css({"background":"#95abfb"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="WalletTransactions") {                  
        $("#resdiv").html($('#WalletTransactionsdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"#95abfb"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="Orders") {                  
        $("#resdiv").html($('#Ordersdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"#95abfb"});
        $('#Invoice').css({"background":"Transparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="Invoice") {                  
        $("#resdiv").html($('#Invoicediv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"#95abfb"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="RecentlyViewed") {                  
        $("#resdiv").html($('#RecentlyVieweddiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transparent"});
        $('#RecentlyViewed').css({"background":"#95abfb"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="RecentlyWhoViewed") {                  
        $("#resdiv").html($('#RecentlyWhoVieweddiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"#95abfb"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="Favorited") {                  
        $("#resdiv").html($('#Favoriteddiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"#95abfb"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="Mutual") {                  
        $("#resdiv").html($('#Mutualdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"#95abfb"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="WhoLiked") {                  
        $("#resdiv").html($('#WhoLikeddiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparent"});
        $('#WhoLiked').css({"background":"#95abfb"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="LoginLogs") {                  
        $("#resdiv").html($('#LoginLogsdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparennt"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"#95abfb"});
        $('#Activities').css({"background":"Transparent"});
     }
     if (pOption=="Activities") {                  
        $("#resdiv").html($('#Activitiesdiv').html());
        $('#WalletRequests').css({"background":"Transparent"});
        $('#WalletTransactions').css({"background":"Transparent"});
        $('#Orders').css({"background":"Transparent"});
        $('#Invoice').css({"background":"Transaparent"});
        $('#RecentlyViewed').css({"background":"Transparent"});
        $('#RecentlyWhoViewed').css({"background":"Transparent"});
        $('#Favorited').css({"background":"Transparent"});
        $('#Mutual').css({"background":"Transparennt"});
        $('#WhoLiked').css({"background":"Transparent"});
        $('#LoginLogs').css({"background":"Transparent"});
        $('#Activities').css({"background":"#95abfb"});
     }
 }
</script>
  