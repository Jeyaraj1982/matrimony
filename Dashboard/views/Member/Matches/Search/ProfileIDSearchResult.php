<?php 
    $mainlink="Search";
    $page="ByProfileID";
    include_once("topmenu.php");
    $response = $webservice->getData("Matches","SearchByProfileID",array()); 
?>
<?php  if (sizeof($response['data'])>0) { ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6"><h4 class="card-title">Search Result</h4></div>
                        <div class="col-sm-6" style="text-align:right;"><h4 class="card-title"><a href="AdvancedSearch">Modify Search</a></h4></div>
                    </div>
                    <?php 
                foreach($response['data'] as $Profile) {   
                    echo DisplayProfileShortInformation($Profile); ?><br>
             <?php    }
            ?>
                </div>
            </div>
        </div>
    <?php     } else   { ?>
    <div style="margin:25px;margin-top:5px;padding:0px !important">
    <div class="card" style="padding:15px;">
        <h4 class="card-title">Search Result</h4>
        <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px"><Br>
            No profiles found 
            <br>
        </div>
    </div>
</div>
        <?php } ?>
