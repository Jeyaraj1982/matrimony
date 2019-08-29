 <style>
        div, label,a,h1,h2,h3,h4,h5,h6 {font-family:'Roboto' !important;}
 #resCon_a0 {float:left;width:143px;background:white;margin-left:6px;margin-top: -19px;padding: 25px;text-align:center;cursor:pointer;}
 #resCon_a0:hover {background:#f1f1f1;}
    </style>                                                 
   
    <div class="row">
    <div class="col-7 grid-margin" style="flex: 0 0 64.333%;max-width: 1000px;">                                                                     
            <div style="width:139px;background:#dee9ea;padding:10px;padding-bottom:0px;padding-left:12px;padding-top:7px">Latest Updates</div>
             <div class="card"  style="background:#dee9ea">
                <div class="card-body" style="padding-left: 4px;padding-right: 0px;">
                    <div id="resCon_a0" style="background:white;width:97%;text-align:left;padding:0px;">
                    <?php
                        $latestupdates = $webservice->getData("Member","GetAllLatestUpdates");
                        foreach($latestupdates['data'] as $Row) { 
                    ?>   
                    <div id="UpdatesDiv_<?php echo $Row['LatestID'];?>" name="UpdatesDiv_<?php echo $Row['LatestID'];?>" style="border-bottom:1px solid #c3d1d2;padding: 5px;">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width:64px;padding-right: 15px;">
                                    <img src="<?php  echo $Row['ProfilePhoto']?>" style="border-radius: 50%;width: 64px;border: 1px solid #ddd !important;height: 64px;padding: 5px;background: #fff;">
                                </td>
                                <td>
                                    <?php echo $Row['VisterProfileCode'];?> &nbsp;<?php echo $Row['Subject'];?><br>
                                     <a href="<?php echo GetUrl("view/".$Row['VisterProfileCode'].".htm");?>">View Profile</a>
                                     <span style="float:right;font-size: 12px;color: #514444cc;"><?php echo putDateTime($Row['ViewedOn']);?></span>
                                </td>
                            </tr>                                                 
                        </table>                                                      
                    </div>                                       
                   <?php }?>                                                   
                  </div>
             </div>                                                             
        </div>
        </div>
        <div class="col-5 grid-margin" style="max-width: 35.667%;">
         </div> 
        </div>
         
  