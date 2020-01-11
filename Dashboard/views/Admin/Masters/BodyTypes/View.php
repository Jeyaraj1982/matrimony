<?php
    $response     = $webservice->getData("Admin","GetMasterAllViewInfo");
    $BodyType = $response['data']['ViewInfo'];
?>

<form method="post" action="" onsubmit="">
  <div class="col-12 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Masters</h4>  
              <h4 class="card-title">Body Type Details</h4>  
              <form class="forms-sample">
              <div class="form-group row">
                  <label for="BodyTypeCode" class="col-sm-3 col-form-label">Body Type Code</label>
                  <label for="BodyTypeCode" class="col-sm-3 col-form-label"><?php echo $BodyType['SoftCode'];?></label>
                </div>
                <div class="form-group row">                                             
                  <label for="BodyType" class="col-sm-3 col-form-label">Body Type</label>
                  <label for="BodyType" class="col-sm-3 col-form-label"><?php echo  $BodyType['CodeValue'];?></label>
                </div>
                 <div class="form-group row">
                  <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                  <label for="IsActive" class="col-sm-3 col-form-label"><?php echo  ($BodyType['IsActive']) ? "Active" : "DeActive";?></label>
                </div>
               <div class="form-group row">
                <div class="col-sm-3" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageBodyTypes"><small>List of Body Types</small></a>  </div>
               <div class="col-sm-6" align="left"><a href="../../New" class="btn btn-primary mr-2"><i class="mdi mdi-plus"></i>Add Body Type</a> </div>
               </div>
                
            </div>
          </div>
        </div>
</form>