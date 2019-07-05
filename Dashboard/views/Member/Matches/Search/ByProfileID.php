<?php
$mainlink="Search";
$page="ByProfileID";
 ?>
  <style>
div, label,a {font-family:'Roboto' !important;}
</style>
 <?php include_once("topmenu.php");?>
<div class="col-lg-12 grid-margin stretch-card" >
    <div class="card">
        <div class="card-body">
          <form method="post" action="SearchResult.php" onsubmit="">
            <div class="container"  id="sp">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <div class="col-sm-2">Profile ID</div>
                        <div class="col-sm-6"><input type="text" class="form-control" name="profileid" id="profileid"><br>
                        <button type="submit" class="btn btn-primary">Go</button></div>
                    </div>
                 </div>
              </div>
        </form>
    </div>
</div>
</div>
