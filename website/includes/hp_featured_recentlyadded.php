<?php
        $response = $webservice->getData("Member","GetAllRecentlyAdded",array("ProfileFrom"=>"HomePage")); 
		
        if ((sizeof($response['data'])%6)==1) {
            $s = sizeof ($response['data']);
            $response['data'][$s]=$response['data'][0];
            $response['data'][($s+1)]=$response['data'][0];
            $response['data'][($s+2)]=$response['data'][0];
            $response['data'][($s+3)]=$response['data'][0];
            $response['data'][($s+4)]=$response['data'][0];
        }
        if ((sizeof($response['data'])%3)==2) {
            $s = sizeof ($response['data']);
            $response['data'][$s]=$response['data'][0];
             $response['data'][($s+1)]=$response['data'][0];
            $response['data'][($s+2)]=$response['data'][0];
            $response['data'][($s+3)]=$response['data'][0];
        }
         if ((sizeof($response['data'])%3)==3) {
            $s = sizeof ($response['data']);
            $response['data'][$s]=$response['data'][0];
             $response['data'][($s+1)]=$response['data'][0];
            $response['data'][($s+2)]=$response['data'][0];
        }
         if ((sizeof($response['data'])%3)==4) {
            $s = sizeof ($response['data']);
            $response['data'][$s]=$response['data'][0];
             $response['data'][($s+1)]=$response['data'][0];
        }
          if ((sizeof($response['data'])%3)==5) { 
            $s = sizeof ($response['data']);
            $response['data'][$s]=$response['data'][0];
        }
        $i=1;
        $j=1;
?>
 <div >
    <div class="form-group row">
        <div class="col-md-9">
            <h4 style="margin-top: 24px;">Recently Added Profiles</h4>
        </div>
		<?php if(sizeof($response['data'])>6){ ?>
        <div class="col-md-3" style="margin-top: 20px;margin-bottom: 10px;">
            <div class="controls pull-right hidden-xs">
                <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-recent" data-slide="prev"></a>
                <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-recent" data-slide="next"></a>
            </div>
        </div>
		<?php } ?>
    </div>
    <div id="carousel-recent" class="carousel slide hidden-xs " data-ride="carousel">
        <div class="carousel-inner ">
            <?php
                foreach($response['data'] as $p) { 
                    $Profile=$p['ProfileInfo'];
                    if ($i==1) {
                        if ($j==1) {
                            echo '<div class="item active"><div class="row">';
                        } else { 
                            echo '<div class="item"><div class="row">';
                        }
                    }
                    ?>        
                          <div class="col-sm-2">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $p['ProfileThumb'];?>" class="img-responsive" alt="a">
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="col-md-12" style="text-align:center">
											<span style="color:#f03caa;font-weight: bold;">
												[ <?php echo $Profile['ProfileCode'];?> ]
											</span><br>
											<span>
												<span style="font-weight: bold;"><?php echo $Profile['ProfileName'];?>&nbsp; ( <?php echo $Profile['Age'];?>&nbsp;yrs ) </span><br>
												<?php if($Profile['Religion']=="Others"){ echo $Profile['OtherReligion']; } else { echo $Profile['Religion']; } ?>&nbsp;-&nbsp;
												<?php if($Profile['Caste']=="Others"){ echo $Profile['OtherCaste']; } else { echo $Profile['Caste']; } ?>
											</span>
										</div>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                    if ($i==6) { 
                         echo '</div></div>';
                        $i=1;
                    } else {
                        $i++;
                    }
                    $j++;
                } 
            ?>
        </div>
		<hr style="border-top: 1px solid white;">
		<div style="text-align:right;">
			<a href="<?php echo JFrame::getAppSetting('siteurl')."/ListofRecentlyAddedProfiles";?>">View All Recently Added Profiles</a>
		</div>
    </div>
 </div>
 