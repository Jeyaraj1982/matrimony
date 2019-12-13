<?php
        $response = $webservice->getData("Member","GetFeatureGroom"); 
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
        <div class="col-md-9" style="color:Black;">
            <h4 style="margin-top: 24px;">Featured Grooms</h4>
        </div>
		<?php if(sizeof($response['data'])>3){ ?>
        <div class="col-md-3" style="margin-top: 20px;margin-bottom: 10px;">
            <div class="controls pull-right hidden-xs">
                <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-groom" data-slide="prev"></a>
                <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-groom" data-slide="next"></a>
            </div>
        </div>
		<?php } ?>
    </div>
	<div id="carousel-groom" class="carousel slide hidden-xs" data-ride="carousel">
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
                          <div class="col-sm-4" >
                            <div class="col-item">
                                <div class="photo" >
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
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    <?php 
                    if ($i==3) { 
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
		<a href="<?php echo JFrame::getAppSetting('siteurl')."/ListofFeaturedGrooms";?>">View All Featured Grooms</a>
	</div>
	</div>
</div>

 
 