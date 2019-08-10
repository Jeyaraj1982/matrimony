<?php 
    $page="ReligionWise";
    include_once("browse_topmenu.php");
    $response = $webservice->getData("Matches","MatchesReligion",array()); 
?>
<?php if (sizeof($response['data'])>0) {  ?>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
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
        <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px"><Br>
            No profiles found in your account<br><Br><br><Br><br><Br>
            <span style="color:#555">You must be create an profile and activate.</span><br>  
            <a style="font-weight:Bold;font-family:'Roboto';" href="<?php echo GetUrl("MyProfiles/ManageProfile");?>">Create Profile</a>
            <br>
        </div>
    </div>
</div>
<?php } ?>

             
             
             