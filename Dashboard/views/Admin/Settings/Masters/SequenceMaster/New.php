<?php 
$page="ManageSequenceMaster";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
 <script>
$(document).ready(function () {
   $("#SequenceFor").blur(function () {  
    IsNonEmpty("SequenceFor","ErrSequenceFor","Please Enter Valid Sequence For");
   });
   $("#Prefix").blur(function () {
        IsNonEmpty("Prefix","ErrPrefix","Please Enter Valid Prefix");
   });
   $("#StringLength").blur(function () {
        IsNonEmpty("StringLength","ErrStringLength","Please Enter Valid String Length");
   });
   $("#LastNumber").blur(function () {
        IsNonEmpty("LastNumber","ErrLastNumber","Please Enter Valid Last Number");
   });
});

 function SubmitNewSequence() {
                         $('#ErrSequenceFor').html("");
                         $('#ErrPrefix').html("");
                         $('#ErrStringLength').html("");
                         $('#ErrLastNumber').html("");
                         
                         ErrorCount=0;
        
                        if(IsNonEmpty("SequenceFor","ErrSequenceFor","Please Enter Sequence For")){
                        IsAlphaNumeric("SequenceFor","ErrSequenceFor","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("Prefix","ErrPrefix","Please Enter Prefix")){
                        IsAlphaNumeric("Prefix","ErrPrefix","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("StringLength","ErrStringLength","Please Enter String Length")){
                        IsAlphaNumeric("StringLength","ErrStringLength","Please Enter Alphanumeric Charactors only");
                        }
                        if(IsNonEmpty("LastNumber","ErrLastNumber","Please Enter LastNumber")){
                        IsAlphaNumeric("LastNumber","ErrLastNumber","Please Enter Alphanumeric Charactors only");
                        }
         
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 }
    
</script>
<div class="col-sm-10 rightwidget">
 <div class="row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <h4 class="card-title">Create Sequence</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
        
<?php                   
  if (isset($_POST['BtnSequence'])) {   
    $response = $webservice->getData("Admin","CreateSequence",$_POST);
    if ($response['status']=="success") {
      $successmessage = $response['message']; 
       unset($_POST);                                                                       
    } else { 
      $errormessage = $response['message']; 
    }
    } 
  ?>
<form method="post" action="" onsubmit="return SubmitNewSequence();">
        <div class="form-group row">
          <label for="SequenceFor" class="col-sm-3 col-form-label">Sequence For<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="SequenceFor" name="SequenceFor" value="<?php echo (isset($_POST['SequenceFor']) ? $_POST['SequenceFor'] : "");?>" placeholder="Sequence For">
            <span class="errorstring" id="ErrSequenceFor"><?php echo isset($ErrSequenceFor)? $ErrSequenceFor : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="Prefix" class="col-sm-3 col-form-label">Prefix<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="Prefix" name="Prefix" value="<?php echo (isset($_POST['Prefix']) ? $_POST['Prefix'] : "");?>" placeholder="Prefix">
            <span class="errorstring" id="ErrPrefix"><?php echo isset($ErrPrefix)? $ErrPrefix : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="StringLength" class="col-sm-3 col-form-label">String Length<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="StringLength" name="StringLength" value="<?php echo (isset($_POST['StringLength']) ? $_POST['StringLength'] : "");?>" placeholder="String Length">
            <span class="errorstring" id="ErrStringLength"><?php echo isset($ErrStringLength)? $ErrStringLength : "";?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="LastNumber" class="col-sm-3 col-form-label">Last Number<span id="star">*</span></label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="LastNumber" name="LastNumber" value="<?php echo (isset($_POST['LastNumber']) ? $_POST['LastNumber'] : "");?>" placeholder="Last Number">
            <span class="errorstring" id="ErrLastNumber"><?php echo isset($ErrLastNumber)? $ErrLastNumber : "";?></span>
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><?php if(sizeof($successmessage)>0){ echo  $successmessage ; } else {echo  $errormessage;}?></div>
        </div>
        <div class="form-group row">
        <div class="col-sm-3">
       <button type="submit" name="BtnSequence" id="BtnSequence"  class="btn btn-primary mr-2">Save Sequence For</button> </div>
       <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="ManageSequenceMaster"><small>List of Sequence For</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    