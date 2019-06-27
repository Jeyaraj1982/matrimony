<?php
$page="KYC";
?>
<form method="post" action="">
<h4>My Settings</h4>
  <div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
            <div class="form-group-row">
            <div class="col-sm-12">
            <div class="col-sm-3">
            <div class="sidemenu" style="width: 200px;margin-left: -58px;margin-bottom: -41px;margin-top: -30px;border-right: 1px solid #eee;">
                <?php include_once("sidemenu.php");?>
            </div>
            </div>
            <div class="col-sm-9">
              <h4 class="card-title">KYC</h4>
                <div class="form-group row">
                     <div class="col-sm-3"><small>ID Proof</small> </div>
                     <div class="col-sm-3"><input type="file"></div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-3"><small>Address Proof</small> </div>
                     <div class="col-sm-3"><input type="file"></div>
                  </div>
                  <div class="col-sm-12" style="text-align:center"><button type="submit" class="btn btn-primary">Update</button></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
</form>                
                