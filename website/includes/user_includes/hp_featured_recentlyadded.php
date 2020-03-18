<?php
$response = $webservice->getData("Member","GetAllRecentlyAdded",array("ProfileFrom"=>"HomePage")); 
    $i=1;
    $j=1;
    $c=1;
?>
   <div class="row" style="padding:10px;;">
          <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
      <div class="controls-top" style="border-bottom: 3px solid #BD181F;height: 27px;">
        <span style="float:left;font-size:13px;background: #BD181F;padding: 3px 20px;color: #fff;font-weight: bold;">Recently Added</span>  
        <span style="float:right">
        <a href="<?php echo JFrame::getAppSetting('siteurl')."/ListofRecentlyAddedProfiles";?>" style="font-size:12px;">View All</a>&nbsp;&nbsp;
        <a class="btn-floating" href="#multi-item-example" data-slide="prev" style="font-size:12px;"><i class="fa fa-chevron-left"></i></a>
        <a class="btn-floating" href="#multi-item-example" data-slide="next" style="font-size:12px;"><i class="fa fa-chevron-right"></i></a>
        </span>
        
      </div>
      <ol class="carousel-indicators">
        <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
        <li data-target="#multi-item-example" data-slide-to="1"></li>
        <li data-target="#multi-item-example" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
         <?php
                foreach($response['data'] as $p) { 
                   
                    $Profile=$p['ProfileInfo'];
                    if ($i==1) {
                        if ($j==1) {
                            echo ' <div class="carousel-item active">  <div class="row">';
                        } else { 
                            echo ' <div class="carousel-item">  <div class="row">';
                        }
                    }
         ?>  
         <div class="col">
            <div class="card mb-2">
                <img class="card-img-top" src="<?php echo $p['ProfileThumb'];?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-size:15px;"> <?php echo $Profile['ProfileCode'];?> (<?php echo $Profile['Age'];?>&nbsp;yrs)</h5>
                    <p class="card-text">
                        <span style="font-size:12px;"><?php if($Profile['Religion']=="Others"){ echo $Profile['OtherReligion']; } else { echo $Profile['Religion']; } ?>&nbsp;-&nbsp;
                        <?php if($Profile['Caste']=="Others"){ echo $Profile['OtherCaste']; } else { echo $Profile['Caste']; } ?>
                        <!--<?php  echo $Profile['State'].", ".$Profile['Country'];   ?></span><br><br>-->
                    </p>
                    <a href="Profile.php?Code=<?php echo $Profile['ProfileCode'];?>" class="btn btn-warning  btn-sm">View Profile</a>
                </div>
            </div>
         </div>
         <?php
            if ($i==5) {
                echo '</div></div>';
                $i=1;
            } else {
                $i++;
            }
            $j++;
                } 
                
                
                
                 
                
         ?>
        <!--/.First slide-->
             </div>
       
    </div>
    <!--/.Carousel Wrapper-->
  </div>
  <hr style="border-top: 1px solid white;;margin-bottom:0px">
    <div style="text-align:right;;padding:5px;">
    
  </div>