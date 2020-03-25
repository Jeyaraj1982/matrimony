<style>
.jmatri_box {min-height: 200px;width:100%;background:#fff;padding:10px 15px;max-width:770px !important;border:1px solid #d5ecf2;cursor:pointer}
.jmatri_box:hover {border:1px solid #bee1ea;background:#edf5f7}
</style>
<form method="post" action="" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                        <div class="col-sm-6">
                        <h4 class="card-title">Submitted To Review</h4>
                        </div>                                                    
                        <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                            <a href="<?php  echo GetUrl("DraftedProfiles?Filter=Draft&Gender=All");?>"><small >Drafted</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("PostedProfiles?Filter=Post&Gender=All");?>"><small style="font-weight:bold;text-decoration:underline">Submitted to review</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("PublishedProfiles?Filter=Publish&Gender=All");?>"><small>Published</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("PublishedProfiles?Filter=Rejected&Gender=All");?>"><small>Rejected</small></a>
                        </div>
                    </div>
                    <?php $res = $webservice->getData("Franchisee","ProfilesBrideGroomCount",array("Request"=>"Post"));   ?>
                    <div class="form-group row">
                        <div class="col-sm-6" style="padding-top:5px;">
                            <a href="<?php  echo GetUrl("PostedProfiles?Filter=Post&Gender=Bride");?>"><?php if($_GET['Gender']=="Bride") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Brides (<?php echo $res['data']['Bride']['cnt'];?>)</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("PostedProfiles?Filter=Post&Gender=Groom");?>"><?php if($_GET['Gender']=="Groom") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Grooms (<?php echo $res['data']['Groom']['cnt'];?>)</small></a>
                        </div>
                    </div>
                    <?php 
    if($_GET['Filter']=="Post"){ 
        if( $_GET['Gender']=="All"){
            $response = $webservice->getData("Franchisee","GetMyProfiles",array("ProfileFrom"=>"Posted"));
        }
        if( $_GET['Gender']=="Bride"){
           $response = $webservice->getData("Franchisee","GetMyProfiles",array("ProfileFrom"=>"PostedBride")); 
        }
        if( $_GET['Gender']=="Groom"){
           $response = $webservice->getData("Franchisee","GetMyProfiles",array("ProfileFrom"=>"PostedGroom")); 
        }                                                                                                      
    }
?>
                  <?php 
                         if (sizeof($response['data'])>0) {                                                                 
                         ?>
                        <?php foreach($response['data']as $P) { 
                            $Profile = $P['ProfileInfo'];
                        ?>
                        <div class="jmatri_box box-shaddow">
                            <div class="form-group row">
                                <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                                    <img src="<?php echo $P['ProfileThumb'];?>" style="width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                                    <div style="line-height: 25px;color: #867c7c;font-size:14px;"><?php echo $P['Position'];?></div>    
                                </div>
                                <div class="col-sm-9" style="padding:0px;">
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;padding-bottom:10px;font-size: 21px;color: #514444cc;">
                                        <div class="form-group row" style="margin-bottom:0px">                                                                                     
                                            <div class="col-sm-12"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs)</div>
                                        </div>
                                        <div class="form-group row" style="margin-bottom:0px">
                                            <div class="col-sm-6">
                                                <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                            </div>
                                            <div class="col-sm-6" style="float:right;font-size: 12px;text-align:right">
                                                <img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;">&nbsp;<?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br> 
                                                <?php  echo "Submited On: ".time_elapsed_string($Profile['RequestVerifyOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".putDateTime($Profile['LastSeen']) : ""; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['Height'];?></div>
                                        <div><?php echo $Profile['Religion'];?></div>
                                        <div><?php echo $Profile['Caste'];?></div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $Profile['MaritalStatus'];?></div>
                                        <div><?php echo $Profile['OccupationType'];?></div>
                                        <div><?php echo $Profile['AnnualIncome'];?></div>
                                    </div>
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom:0px">
                                <div class="col-sm-10">
                                    <div style="line-height: 25px;color: #867c7c;font-size:11px;">Member ID:&nbsp;<?php echo $P['Members']['MemberCode'];?>&nbsp;|&nbsp;
                                    Doc attached:<?php echo sizeof($P['Documents']);?></div>
                                </div>
                                <div class="col-sm-2" style="text-align: right;font-size:12px;">
                                    <a href="<?php echo GetUrl("ViewPostedProfile/". $Profile['ProfileCode'].".htm");?>">View</a>
                                </div>
                            </div>
                        </div>  
                        <br> 
                  <?php }} else {?>   
                  <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
                        <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px">
                        <Br> No profiles found
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                    </div>
                  <?php }?>                                             
                </div>
              </div>
            </div>
        </form>   
 <script>
$(document).ready(function(){
    $('#myTable').dataTable();
    setTimeout("DataTableStyleUpdate()",500);
});
</script>