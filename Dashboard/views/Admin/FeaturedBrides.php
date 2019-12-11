
<?php
    $response = $webservice->getData("Admin","GetFeatuerdBrides",array("Request"=>"All"));
    if(sizeof($response)>0){
?>
           <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-4"><h4 class="card-title">Landing Page Profiles</h4></div>
                    <div class="col-sm-8" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="FeaturedBrides" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                        <a href="ActiveFeaturedBrides"><small>Active</small></a>&nbsp;|&nbsp;
                        <a href="ExpiredFeaturedBrides"><small>Expired</small></a>
                    </div>
                </div>                          
                                                                            
                    <?php foreach($response['data'] as $p){ 
                       $Profile=$p['ProfileInfo'];     echo  Admin_Landing_page_Profiles($Profile,$p); ?> <br> <?php    }?>                                                                    
                        
                </div>
            </div>
        </div>
    <?php     } else   { ?>

        <div class="col-lg-12 grid-margin stretch-card bshadow" style="background:#fff;padding:90px;">
            <div class="card">
                <div class="card-body" style="text-align:center;font-family:'Roboto'">
                    <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px"><Br> 
            No profiles found at this time<br><br>
                </div>
            </div>                                                       
        </div>
                                                                                      
        <?php } ?>