<?php
    $response     = $webservice->GetMasterAllViewInfo();
    $LanguageNames = $response['data']['ViewInfo'];
?>
<form method="post" action="" onsubmit="">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>  
                      <h4 class="card-title">LanguageName Details</h4>  
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="LanguageCode" class="col-sm-3 col-form-label">Language Code</label>
                          <div class="col-sm-9">
                            <input type="text" readonly="readonly" style="width:80px;background:#fff;border:1px solid #fff" class="form-control" id="LanguageCode" name="LanguageCode" value="<?php echo $LanguageNames['SoftCode'];?>" placeholder="Language Code">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="LanguageName" class="col-sm-3 col-form-label">Language Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LanguageName" readonly="readonly" name="LanguageName" value="<?php echo  $LanguageNames['CodeValue'];?>" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                         <div class="form-group row">
                          <label for="IsActive" class="col-sm-3 col-form-label">Is Active</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="LanguageName" name="LanguageName" value="<?php echo  ($LanguageNames['IsActive']) ? "Active" : "DeActive";?>" style="background:#fff;border:1px solid #fff">
                          </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageLanguage" ><small>List of Language Names</small></a></div>
                        <div class="col-sm-6"><a href="../../New" class="btn btn-success mr-2"><i class="mdi mdi-plus"></i>Add Language Name</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>