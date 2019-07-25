<?php $mainlink="Search";
$page="BasicSearch";?>
<?php include_once("topmenu.php");?>
<style>
    .bshadow {
        -webkit-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
        -moz-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
        box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
    }
    
    .box-shaddow {
        box-shadow: 0 0 5px #e9e9e9 !important;
        -moz-box-shadow: 0 0 5px #e9e9e9 !important;                         
        -webkit-box-shadow: 0 0 24px #e9e9e9 !important;
    }                                                                           
</style> 
                        <style>
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc;
}

.accordion:after {
  color: #777;
  font-weight: bold;
  float: left;
  margin-left: 5px;
}

.active:after {
}

.panel {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
</style>
<?php
  if (isset($_POST['continue'])) {
        
        $response = $webservice->getData("Member","SelectPlanAndContinue",$_POST);
        if ($response['status']=="success") {
            echo "<script>location.href='../ChoosePaymentMode';</script>";
            // $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
    $response = $webservice->getData("Member","BasicSearchViewMemberPlan",array()); 
    if (sizeof($response['data'])>0) {
?>
  <form method="post" action="" onsubmit="">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Plans</h4>
                    <?php echo $errormessage;?><?php echo $successmessage;?>
                    <?php 
                    $i=1;
                    foreach($response['data'] as $plans) { ?>
                    
                    <button  type="button"  class="accordion">
                     <div class="form-group row">
                        <div class="col-sm-6"><h4><?php echo $plans['PlanName']?></h4></div>
                         <div class="col-sm-6"><h4>&#x20b9;&nbsp;<?php echo $plans['Amount']?></h4></div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6"><h5><?php echo $plans['Duration']?></h5></div>
                     </div>
                     </button>
<div class="panel">
<form method="post" action="" onsubmit="">
    <input type="hidden"  value=<?php echo $plans['PlanID'];?> name="PlanID" >
  <button type="Submit" name="continue" class="btn btn-primary">Continue</button>
</form>
</div>

<?php  $i++; } ?>

                         
                        <br>   
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
                        <?php }?>
                </div>
            </div>
        </div>
    </form>

  
     