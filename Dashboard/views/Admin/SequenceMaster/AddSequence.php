<?php                   
  if (isset($_POST['SequenceFor'])) {    
  $response = $webservice->getData("Admin","AddSequenceMaster",$_POST);   
  print_r($response);  
    if ($response['status']=="success") {
        $successmessage = $response['message'];
    } else {
        $errormessage = $response['message']; 
    }
    }
?>  
<script>
function SubmitNewSequence() {
                         $('#ErrSequenceForName').html("");
                         $('#ErrPrefix').html("");
                         $('#ErrSLength').html("");
                         $('#ErrLastNumber').html("");
                       
                         
                         ErrorCount=0;
                        
                        if(IsNonEmpty("SequenceForName","ErrSequenceForName","Please Enter Sequence For")) {
                        IsAlphaNumeric("SequenceForName","ErrSequenceForName","Please Enter Alphabets characters only");
                        }
                        if(IsNonEmpty("Prefix","ErrPrefix","Please Enter Prefix")) {
                        IsAlphaNumeric("Prefix","ErrPrefix","Please Enter Alphabets characters only");
                        }
                        if(IsNonEmpty("SLength","ErrSLength","Please Enter String Length")) {
                        IsNumeric("SLength","ErrSLength","Please Enter Alphabets characters only");
                        }
                        if(IsNonEmpty("LastNumber","ErrLastNumber","Please Enter Last Number")) {
                        IsNumeric("LastNumber","ErrLastNumber","Please Enter Alphabets characters only");
                        }
                        
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<form method="post" onsubmit="return SubmitNewSequence();">
        <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Add Sequence</h4>
                      <div class="form-group row">
                          <label for="SequenceFor" class="col-sm-2 col-form-label">Sequence For<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="SequenceForName" name="SequenceForName" value="<?php echo (isset($_POST['SequenceForName']) ? $_POST['SequenceForName'] : "");?>" placeholder="Sequence For">
                            <span class="errorstring" id="ErrSequenceForName"><?php echo isset($ErrSequenceForName)? $ErrSequenceForName : "";?></span>
                          </div>
                       </div>
                       <div class="form-group row">
                          <label for="Prefix" class="col-sm-2 col-form-label">Prefix<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="Prefix" name="Prefix" value="<?php echo (isset($_POST['Prefix']) ? $_POST['Prefix'] : "");?>" placeholder="Prefix">
                            <span class="errorstring" id="ErrPrefix"><?php echo isset($ErrPrefix)? $ErrPrefix : "";?></span>
                          </div>
                       </div>
                       <div class="form-group row">
                          <label for="Prefix" class="col-sm-2 col-form-label">String Length<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="SLength" name="SLength" value="<?php echo (isset($_POST['SLength']) ? $_POST['SLength'] : "");?>" placeholder="String Length">
                            <span class="errorstring" id="ErrSLength"><?php echo isset($ErrSLength)? $ErrSLength : "";?></span>
                          </div>
                       </div>
                       <div class="form-group row">
                          <label for="LastNumber" class="col-sm-2 col-form-label">Last Number<span id="star">*</span></label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="LastNumber" name="LastNumber" value="<?php echo (isset($_POST['LastNumber']) ? $_POST['LastNumber'] : "");?>" placeholder="Last Number">
                            <span class="errorstring" id="ErrLastNumber"><?php echo isset($ErrLastNumber)? $ErrLastNumber : "";?></span>
                          </div>
                       </div>
                       <div class="form-group row">
                        <div class="col-sm-2">
                        <button type="submit" name="SequenceFor" class="btn btn-primary mr-2" style="font-family:roboto">Add Sequence</button></div>
                        <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"> <a href="ManageSequenceMaster">List of Sequence </a></div>
                        </div> 
                        <div class="col-sm-12" style="text-align: center;color:red"><?php echo $errormessage ;?></div>                  
                    </div>
                  </div>                              
                </div>
</form>  