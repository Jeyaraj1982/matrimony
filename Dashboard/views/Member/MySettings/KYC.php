<?php
$page="KYC";
?>
<?php include_once("settings_header.php");?>
<form method="post" action="">
    <div class="col-sm-9"  style="margin-top: -8px;">
        <h4 class="card-title">KYC</h4>
        <div class="form-group row">
            <div class="col-sm-3"><small>ID Proof</small> </div>
            <div class="col-sm-3"><input type="file"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3"><small>Address Proof</small> </div>
            <div class="col-sm-3"><input type="file"></div>
        </div>
        <div class="col-sm-12" style="text-align:center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
<?php include_once("settings_footer.php");?>                                