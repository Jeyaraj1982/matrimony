<?php
$page="MyMemberInfo";
 $response = $webservice->GetMemberInfo();
    $Member=$response['data'];    
?>
<form method="post" action="">
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
            <div class="form-group-row">
            <div class="col-sm-12">
            <div class="col-sm-3">
            <div class="sidemenu" style="width: 200px;margin-left: -58px;margin-bottom: -41px;margin-top: -30px;border-right: 1px solid #eee;">
                <?php include_once("sidemenu.php");?>
            </div>
            </div>
            <div class="col-sm-9">
              <h4 class="card-title">My Info</h4>
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
                          <div class="col-sm-3"><small style="color:#737373;"><?php echo $Member['MobileNumber'];?></small></div>
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
                   </div>
                   <div class="col-sm-12" style="text-align:center">
                    <a href="<?php echo GetUrl("MySettings/EditMemberInfo/".$_REQUEST['Code'].".html");?>"><small style="font-weight:bold;text-decoration:underline">Edit Member</small></a>
                   </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
  </div>
</form>                
                 