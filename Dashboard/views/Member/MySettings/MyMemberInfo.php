<?php
$page="MyMemberInfo";
 $response = $webservice->GetMemberInfo();
    $Member=$response['data'];    
?>

<div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="font-size: 22px;">My Settings</h4>
                <h5 style="color:#666">Control, protect and secure your account, all in one place.</h5>
                <h6 style="color:#999">This page gives you quick access to settings and tools that let you safeguard your data, protect your privacy and decide how your information can make us.</h6>
            </div>
        </div>
</div>
<form method="post" action="">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
            <div class="form-group-row">
            <div class="col-sm-12">
            <div class="col-sm-3" style="width: 21%;">
            <div class="sidemenu" style="width: 200px;margin-left: -58px;margin-bottom: -41px;margin-top: -30px;border-right: 1px solid #eee;">
                <?php include_once("sidemenu.php");?>
            </div>
            </div>
            <div class="col-sm-9" style="margin-top: -8px;">
              <h4 class="card-title">My Member Info</h4>
              <div class="form-group row">
                          <div class="col-sm-3" style="margin-right: -47px;"><small>Member ID</small> </div>
                          <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo $Member['MemberCode'];?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3" style="margin-right: -47px;"><small>Member Name</small> </div>
                          <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo $Member['MemberName'];?></small></div>
                          <div class="col-sm-2" style="margin-right: -47px;"><small>Sex</small> </div>
                          <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo $Member['Sex'];?></small></div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-3" style="margin-right: -47px;"><small>Mobile Number</small></div>
                          <div class="col-sm-3">:&nbsp;<small style="color:#737373;">
                          <?php if($Member['IsMobileVerified']==0){ ?><?php echo $Member['CountryCode'];?>-<?php echo $Member['MobileNumber'];?><?php } else {?><?php echo $Member['CountryCode'];?>-<?php echo $Member['MobileNumber'];?><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" width="15%" style="margin-top: -12px;margin-left: 9px;"><?php }?></small>
                          </div>
                          <div class="col-sm-2" style="margin-right: -47px;"><small>Email ID</small></div>
                          <div class="col-sm-5">:&nbsp;<small style="color:#737373;">
                           <?php if($Member['IsEmailVerified']==0){ ?><?php echo  $Member['EmailID'];?><?php } else{ ?><?php echo  $Member['EmailID'];?><img src="<?php echo SiteUrl?>assets/images/Green-Tick-PNG-Picture.png" width="10%" style="margin-top: -11px;margin-left:10px;"><?php }?></small></div>
                          </div>
                      <div class="form-group row">
                          <div class="col-sm-3" style="margin-right: -47px;"><small>Created on</small></div>
                          <div class="col-sm-3">:&nbsp;<small style="color:#737373;"><?php echo  putDateTime($Member['CreatedOn']);?></small></div>
                          <div class="col-sm-2" style="margin-right: -47px;"><small>Status</small></div>
                        <div class="col-sm-3">:&nbsp;<small style="color:#737373;">
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
                   </div>
                   <div class="col-sm-12" style="text-align:center;margin-top: -20px;color:blue">
                    <a href="<?php echo GetUrl("MySettings/EditMemberInfo/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">Edit</small></a>
                   </div>
              </div>
            </div>                               
          </div>
        </div>
      </div>
   </div>
  </div>
</form>                
                  