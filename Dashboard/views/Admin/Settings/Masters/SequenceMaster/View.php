<?php 
$page="ManageSequenceMaster";
include_once("views/Admin/Settings/Masters/settings_header.php");
?>
<div class="col-sm-10 rightwidget">
 <div class="row" style="margin-bottom:0px;">
        <div class="col-sm-6">
            <h4 class="card-title">View Sequence</h4>                   
        </div>
        <div class="cols-sm-6">
        </div>
 </div>
<?php                   
   $response     = $webservice->getData("Admin","GetSequenceMasterViewInfo");
    $Sequence     = $response['data']['Sequence']; 
  ?>
<form method="post" action="">
        <div class="form-group row">
          <label for="SequenceFor" class="col-sm-3 col-form-label">Sequence For<span id="star">*</span></label>
          <label for="SequenceFor" class="col-sm-9 col-form-label"><?php echo $Sequence['SequenceFor'];?></label>
        </div>
        <div class="form-group row">
          <label for="Prefix" class="col-sm-3 col-form-label">Prefix<span id="star">*</span></label>
          <label for="Prefix" class="col-sm-9 col-form-label"><?php echo $Sequence['Prefix'];?></label>
        </div>
        <div class="form-group row">
          <label for="StringLength" class="col-sm-3 col-form-label">String Length<span id="star">*</span></label>
           <label for="StringLength" class="col-sm-9 col-form-label"><?php echo $Sequence['StringLength'];?></label>
        </div>
        <div class="form-group row">
          <label for="LastNumber" class="col-sm-3 col-form-label">Last Number<span id="star">*</span></label>
          <label for="LastNumber" class="col-sm-3 col-form-label"><?php echo $Sequence['LastNumber'];?></label>
        </div>
        <div class="form-group row">
            <div class="col-sm-6" align="left" style="padding-top:5px;text-decoration: underline; color: skyblue;"><a href="../../ManageSequenceMaster"><small>List of Sequence For</small> </a>  </div>
       </div>
</form>
</div>
<?php include_once("views/Admin/Settings/Masters/settings_footer.php");?>                    