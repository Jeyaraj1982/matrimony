<?php
    if (isset($_POST['BtnSaveHeight'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='HEIGHTS' and CodeValue='".trim($_POST['Height'])."'");
        if (sizeof($duplicate)>0) {
             $ErrHeight="Height Alreay Exists";    
             echo $ErrHeight;
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_master_codemaster where HardCode='HEIGHTS' and SoftCode='".trim($_POST['HeightCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrHeightCode="Height Code Alreay Exists";    
             echo $ErrHeightCode;
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {
        $HeightID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "HEIGHTS",
                                                                  "SoftCode"   => trim($_POST['HeightCode']),
                                                                  "CodeValue"  => trim($_POST['Height'])));
                                                                  
        if ($HeightID>0) {
            echo "Successfully Added";
            unset($_POST);
        } else {
            echo "Error occured. Couldn't save Height";
        }
    
    }
    
    
    }  
    
?>
<script>
 function SubmitHeight() {
                         $('#ErrHeightCode').html("");
                         $('#ErrHeight').html("");
                         
                         ErrorCount=0;
        
                        IsNonEmpty("HeightCode","ErrHeightCode","Please Enter Valid Height Code");
                        IsNonEmpty("Height","ErrHeight","Please Enter Valid Height");
                        
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>

<form method="post" action="" onsubmit="return SubmitHeight();">
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Masters</h4>
                      <h4 class="card-title">Create Height</h4>
                      <form class="forms-sample">
                      <div class="form-group row">
                          <label for="Height Code" class="col-sm-3 col-form-label"><small>Height Code<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="HeightCode" name="HeightCode" maxlength="10" value="<?php echo isset($_POST['HeightCode']) ? $_POST['HeightCode'] : GetNextNumber('HEIGHTS');?>" placeholder="Height Code">
                            <span class="errorstring" id="ErrHeightCode"><?php echo isset($ErrHeightCode)? $ErrHeightCode : "";?></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="Height" class="col-sm-3 col-form-label"><small>Height<span id="star">*</span></small></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="Height" name="Height" maxlength="100" value="<?php echo (isset($_POST['Height']) ? $_POST['Height'] : "");?>" placeholder="Height">
                            <span class="errorstring" id="ErrHeight"><?php echo isset($ErrHeight)? $ErrHeight : "";?></span>
                          </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-sm-6">
                                <button type="submit" name="BtnSaveHeight" id="BtnSaveHeight"  class="btn btn-success mr-2">Save Height</button> </div>
                            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageHeights"><small>List of Heights</small> </a>  </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</form>