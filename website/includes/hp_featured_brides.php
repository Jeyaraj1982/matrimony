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
  <div >
    <div class="form-group row" style="width:100%">
        <div class="col-md-9" style="text-align:center;color:blue;">
            <h2>Featured Brides</h2>
        </div>
        <div class="col-md-3" style="margin-top: 20px;margin-bottom: 10px;">
            <div class="controls pull-right hidden-xs">
                <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-bride" data-slide="prev"></a>
                <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-bride" data-slide="next"></a>
            </div>
        </div>
    </div>
    <div id="carousel-bride" class="carousel slide hidden-xs " data-ride="carousel">
        <div class="carousel-inner ">
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
                                    <img src="<?php echo $p['ProfileThumb'];?>" class="img-responsive" alt="a">
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>
                                                <?php echo $Profile['ProfileName'];?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $Profile['Age'];?></h5>
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
    </div>
  </div>  