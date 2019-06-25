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
                 <div class="col-sm-6">
                    <div style="width:200px;height:315px;border:2px solid #d2d2d2;padding:10px">
                        <p style="font-size: 15px;border-bottom:2px solid #d1d1d1;width:97px">Saved Search</p>
                            <?php for($i=1;$i<4;$i++) {?>
                            <p style="font-size: 15px;padding-left:10px;">25to35 christian brides</p>
                            <?php } ?> 
                        <p style="color:#ccc;text-align: center;font-size:15px;margin-top:25px">No records found</p>   
                    </div> 
                 </div>
            </div>
        </form>
    </div>
</div>
</div>
