    <?php
        $response = $webservice->getData("Member","GetFeatureBride"); 
        if ((sizeof($response['data'])%3)==1) {
            $s = sizeof ($response['data']);
            $response['data'][$s]=$response['data'][0];
            $response['data'][($s+1)]=$response['data'][0];
        }
        if ((sizeof($response['data'])%3)==2) {
            $s = sizeof ($response['data']);
            $response['data'][$s]=$response['data'][0];
        }
        $i=1;
        $j=1;
        
    ?>
  <div>
    <div class="form-group row">
        <div class="col-md-9">
            <h4 style="margin-top: 24px;">Featured Brides</h4>
        </div>
		<?php if(sizeof($response['data'])>3){ ?>
        <div class="col-md-3" style="margin-top: 20px;margin-bottom: 10px;">
            <div class="controls pull-right hidden-xs">
                <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-bride" data-slide="prev"></a>
                <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-bride" data-slide="next"></a>
            </div>
        </div>
		<?php } ?>
    </div>
    <div id="carousel-bride" class="carousel slide hidden-xs" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            
                foreach($response['data'] as $p) { 
                    $Profile=$p['ProfileInfo'] ;
                    if ($i==1) {
                        if ($j==1) {
                            echo '<div class="item active"><div class="row">';
                        } else { 
                            echo '<div class="item"><div class="row">';
                        }
                    }
                    ?>        
                          <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $p['ProfileThumb'];?>" class="img-responsive" alt="a"  style="width:150px;height:150px;border:1px solid #e0dede">
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="col-md-12" style="text-align:center">
											<span style="color:#f03caa;font-weight: bold;">
												[ <?php echo $Profile['ProfileCode'];?> ]
											</span><br>
											<span>
												<span style="font-weight: bold;"><!--<?php echo $Profile['ProfileName'];?>&nbsp; -->( <?php echo $Profile['Age'];?>&nbsp;yrs ) </span><br>
												<span style="font-size:12px;"><?php if($Profile['Religion']=="Others"){ echo $Profile['OtherReligion']; } else { echo $Profile['Religion']; } ?>&nbsp;-&nbsp;
                                                <?php if($Profile['Caste']=="Others"){ echo $Profile['OtherCaste']; } else { echo $Profile['Caste']; } ?><br>
                                                <?php  echo $Profile['State'].", ".$Profile['Country'];   ?></span><br><br>
                                                <a href="Profile.php?Code=<?php echo $Profile['ProfileCode'];?>" class="btn btn-success btn-sm">View Profile</a>
											</span>
										</div>
                                    </div>
									<div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    <?php 
                } 
            ?>
        </div>
	</div>
	<hr style="border-top: 1px solid white;;margin-bottom:0px">  
	<div style="text-align:right;padding:5px;">
	<a href="<?php echo JFrame::getAppSetting('siteurl')."/ListofFeaturedBrides";?>">View All Featured Brides</a>
		</div>
  </div>  