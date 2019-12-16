<?php
$mainlink="Search";
$page="ByProfileID";
 ?>
  <style>
div, label,a {font-family:'Roboto' !important;}
</style>
<script>
function searchsubmit() {
                         $('#Errprofileid').html("");
                         ErrorCount=0;
        
                        if (IsNonEmpty("profileid","Errprofileid","Please Enter Valid profile id")) {
                        IsAlphaNumeric("profileid","Errprofileid","Please Enter Alpha Numeric characters only");
                        }
                        if (ErrorCount==0) {
                           
                            return true;
                        } else{
                            return false;
                        }

}

</script>
<?php                   
  if (isset($_POST['searchBtn'])) {  
   
  $response = $webservice->getData("Franchisee","AddFranchiseeProfileSearchByProfileID",$_POST);
        if ($response['status']=="success") {
            echo "<script>location.href='ProfileIDSearchResult/".$response['data']['ReqID'].".htm?Req=ProfileIDSearchResult'</script>";
            // $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
  
?> 
 <?php include_once("topmenu.php");?>
<div class="col-lg-12 grid-margin stretch-card" >
    <div class="card">
        <div class="card-body">
          <form method="post" action="" onsubmit="return searchsubmit()">
            <div class="container"  id="sp">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-2">Profile ID</div>
                        <div class="col-sm-6"><input type="text" class="form-control" placeholder="Eg:Profile Id" name="profileid" id="profileid"><br>
                        <span class="errorstring" id="Errprofileid"><?php echo isset($Errprofileid)? $Errprofileid : "";?></span><br>
                        <button type="submit" class="btn btn-primary" name="searchBtn">Go</button></div>
                    </div>
                 </div>
              </div>
        </form>
    </div>
</div>
</div>
