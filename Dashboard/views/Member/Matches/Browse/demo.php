<style>
.card-profile {
    color: #2A2F5B;
}
.card, .card-light {
    border-radius: 5px;
    background-color: #ffffff;
    margin-bottom: 30px;
    -webkit-box-shadow: 2px 6px 15px 0px rgba(69, 65, 78, 0.1);
    -moz-box-shadow: 2px 6px 15px 0px rgba(69, 65, 78, 0.1);
    box-shadow: 2px 6px 15px 0px rgba(69, 65, 78, 0.1);
    border: 0px;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
}
.card .card-header:first-child, .card-light .card-header:first-child {
    border-radius: 0px;
}
.card-profile .card-header {
    border-bottom: 0px;
    height: 100px;
    position: relative;
}
.card .card-header, .card-light .card-header {
    padding: 1rem 1.25rem;
    background-color: transparent;
    border-bottom: 1px solid #ebecec !important;
}
.card-profile .profile-picture {
    text-align: center;
    position: absolute;                                                                                                
    margin: 0 auto;
    left: 0;
    right: 0;
    bottom: -41px;
    width: 100%;
    box-sizing: border-box;
}
.card-profile .user-profile .name {
    font-size: 20px;
    font-weight: 400;
    margin-bottom: 5px;
}
.avatar-xl {
    width: 5rem;
    height: 5rem;
}
.avatar {
    position: relative;
    display: inline-block;
}
.avatar-img {
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}
.rounded-circle {
    border-radius: 50% !important;
}
img {
    vertical-align: middle;
    border-style: none;
}
.card-profile .card-body {
    padding-top: 60px;
}
.card .card-body, .card-light .card-body {
    padding: 1.25rem;
        padding-top: 1.25rem;
}
.card-profile .user-profile .desc {
    color: #bbb;
    margin-bottom: 15px;
}
.card .card-footer, .card-light .card-footer {
    background-color: transparent;
    line-height: 30px;
    border-top: 1px solid #ebecec !important;
    font-size: 13px;
}
.card-footer:last-child {
    border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px);
}
.card-profile .user-stats {
    margin-bottom: 10px;
}
.text-center {
    text-align: center !important;
}
.card-profile .user-stats [class^="col"] {
    border-right: 1px solid #ebebeb;
}
.card-profile .user-stats .number {
    font-weight: 400;
    font-size: 15px;
}
.card-profile .user-stats .title {
    color: #7d7b7b;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.btn-secondary {
    background: #6861CE !important;
    border-color: #6861CE !important;
    color: #fff;
}
.btn {
    padding: .65rem 1.4rem;
    font-size: 14px;
    opacity: 1;                                                                                                          
    border-radius: 3px;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle
    user-select: none;
    border: 1px solid transparent;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.btn-block {
    display: block;
    width: 100%;
}

</style>
<?php 
    $page="BrowseMatches";
    include_once("browse_topmenu.php");
    $response = $webservice->getData("Matches","MatchedMyExpectation",array());
?>
<?php if ($response['status']=="failed") {?>
<div style="margin:25px;margin-top:5px;padding:0px !important">
    <div class="card" style="padding:15px;">
        <div class="card-body" style="text-align:center;color:#aaa;padding-top:80px;padding-bottom:80px">
            <?php if($response['data']['param']=="mobile") {?>
                <img src="<?php echo ImageUrl;?>mobile_number_not_verfied.png"><br><br><br>
                <?php echo $response['message'];?><br><br><a href="javascript:void(0)" onclick="MobileNumberVerification()"  style="font-weight:Bold;font-family:'Roboto';">Verify now</a>
            <?php }?>
            <?php if($response['data']['param']=="email") {?>
                <img src="<?php echo ImageUrl;?>email_address_not_verified.png"><br><br><br>
                <?php echo $response['message'];?><br><br><a href="javascript:void(0)" onclick="EmailVerification()"  style="font-weight:Bold;font-family:'Roboto';">Verify now</a>
            <?php }?>
            <?php if($response['data']['param']=="profile") {?>
                <img src="<?php echo ImageUrl;?>profile_informations.png" style="width:128px"><br><br><br>
                <?php echo $response['message'];?><br><br><a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a>
            <?php }?>
            <br>
        </div>                       
    </div>
</div>
<?php }  else { ?>
    <?php if (sizeof($response['data'])>0) { ?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php 
                        foreach($response['data'] as $Profiles) {   
                            $Profile = $Profiles['ProfileInfo'];
                            $IsDownload = $Profiles['IsDownload'];
                      $rnd = rand(3000,3000000);
                          //  echo DisplayBrowseMatchesProfileShortInformation($Profile);  
                          
                       //     echo DisplayProfileShortInformation($Profile); ?><br>  
                       <div class="col-md-4">
                            <div class="card card-profile">
                                <div class="card-header" style="background-image: url('../../assets/images/blogpost.jpg')">
                                    <div class="profile-picture">
                                        <div class="avatar avatar-xl">
                                            <img src="<?php echo $Profiles['ProfileThumb'];?>" alt="..." class="avatar-img rounded-circle">  <br><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="user-profile text-center">
                                        <div class="name"><?php echo $Profile['ProfileName'];?>, <?php echo $Profile['Age'];?> Yrs</div>
                                        <div class="job"><?php echo $Profile['OccupationType'];?></div>
                                        <div class="desc"><?php echo $Profile['AnnualIncome'];?></div>
                                        <div class="social-media">
                                            <?php  if ($Profile['isShortList']==0) { ?>                                                                                                                    
                                                <a href="javascript:void(0)" rel="publisher" onclick="AddToShortList('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" style="cursor:pointer !important;">Add to Shortlist</a>
                                            <?php } else { ?>
                                                <a href="javascript:void(0)" rel="publisher" onclick="RemoveFromShortList('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" style="cursor:pointer !important;">Shortlisted</a>
                                            <?php }?>
                                            <?php if ($Profile['isFavouriteds']==1) {?>
                                                <img src="<?php echo SiteUrl?>assets/images/favhearticon.png" rel="publisher" style="cursor:pointer !important;">
                                            <?php } ?>
                                            <?php  if ($Profile['isFavourited']==0) { ?>                                                                                                                    
                                                <img onclick="AddtoFavourite('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>"  src="<?php echo SiteUrl?>assets/images/like_gray.png" src_a="<?php echo SiteUrl?>assets/images/like_red.png" style="cursor:pointer !important;">  
                                            <?php } else { ?>
                                                <img onclick="removeFavourited('<?php echo $Profile['ProfileCode'];?>','<?php echo $rnd;?>')" id="img_<?php echo $rnd; ?>" src="<?php echo SiteUrl?>assets/images/like_red.png" src_a="<?php echo SiteUrl?>assets/images/like_gray.png" style="cursor:pointer !important;">
                                            <?php }?>
                                            <?php if(sizeof($IsDownload)>0) {?>
                                                <span style="color: #867c7c;color: #867c7c;">Viewed Contact On : <?php echo putDateTime($IsDownload[0]['DownloadOn']);?></span>
                                            <?php } else { ?>
                                                <a href="javascript:void(0)" onclick="RequestToDownload('<?php echo $Profile['ProfileCode'];?>')">View Contact</a>
                                            <?php } ?>
                                        </div>
                                        <div class="view-profile">
                                            <a href="<?php echo GetUrl("ViewProfile/".$Profile['ProfileCode'].".htm?source=RecentlyWhoViewed");?>" class="btn btn-secondary btn-block">View Full Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row user-stats text-center">
                                        <div class="col">
                                            <div class="number"><?php echo $response['data']['MyFavoritedCount'];?></div>
                                            <div class="title">Liked</div>
                                        </div>
                                        <div class="col">
                                            <div class="number"><?php echo $response['data']['MyRecentlyViewedCount'];?></div>
                                            <div class="title">Viewed</div>
                                        </div>
                                        <div class="col">
                                            <div class="number"><?php echo $response['data']['MyShortListedcount'];?></div>
                                            <div class="title">Short Listed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <?php    }
                    ?>
                </div>
            </div>
        </div>
        <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:335px"></div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="OverAll_body"  style="max-height: 400px;min-height: 400px;" >
            
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div style="margin:25px;margin-top:5px;padding:0px !important">
            <div class="card" style="padding:15px;">
                <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
                    <img src="<?php // echo ImageUrl;?>noprofile.svg" style="height:128px"><Br>
                    No profiles found, for matched your expectations<br><Br><br><Br><br><Br>
                    <br>
                </div>
            </div>
        </div>       
    <?php } ?>
<?php } ?>

             