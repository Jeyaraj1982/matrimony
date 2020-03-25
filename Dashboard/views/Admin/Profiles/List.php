<form method="post" action="" onsubmit="">  
<?php   
    if($_GET['Filter']=="Drafted"){ 
        $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"Draft"));
        $res = $webservice->getData("Admin","ProfilesBrideGroomCount",array("Request"=>"Draft"));
        $Filter = "Drafted";
    }
    if($_GET['Filter']=="Requested"){ 
        $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"Request"));
        $res = $webservice->getData("Admin","ProfilesBrideGroomCount",array("Request"=>"Request"));
        $Filter = "Drafted";
    }
    if($_GET['Filter']=="Published"){ 
        $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"Publish"));
        $res = $webservice->getData("Admin","ProfilesBrideGroomCount",array("Request"=>"Publish"));
        $Filter = "Published";
    }
?>    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6"><h4 class="card-title">Profiles</h4></div>
                    <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                        <a href="<?php  echo GetUrl("Profiles/List?Filter=Drafted&View=Grid&Gender=All");?>"><?php if($_GET['Filter']=="Drafted") { ?><small style="font-weight:bold;text-decoration:underline"><?php } else{ ?><small><?php } ?>Drafted</small></a>&nbsp;|&nbsp;
                        <a href="<?php  echo GetUrl("Profiles/List?Filter=Requested&View=Grid&Gender=All");?>"><?php if($_GET['Filter']=="Requested") { ?><small style="font-weight:bold;text-decoration:underline"><?php } else{ ?><small><?php } ?>Submitted to review</small></a>&nbsp;|&nbsp;
                        <a href="<?php  echo GetUrl("Profiles/List?Filter=Published&View=Grid&Gender=All");?>"><?php if($_GET['Filter']=="Published") { ?><small style="font-weight:bold;text-decoration:underline"><?php } else{ ?><small><?php } ?>Published</small></a>&nbsp;|&nbsp;
                        <a href="<?php  echo GetUrl("Profiles/List?Filter=UnPublished&View=Grid&Gender=All");?>"><?php if($_GET['Filter']=="UnPublished") { ?> <small style="font-weight:bold;text-decoration:underline"><?php } else{ ?><small><?php } ?>UnPublished</small></a>&nbsp;|&nbsp;
                        <a href="<?php  echo GetUrl("Profiles/List?Filter=Rejected&View=Grid&Gender=All");?>"><?php if($_GET['Filter']=="Rejected") { ?><small style="font-weight:bold;text-decoration:underline"><?php } else{ ?><small><?php } ?>Rejected</small></a>
                    </div>
                </div>
                    <div class="form-group row">
                        <div class="col-sm-6" style="padding-top:5px;">
                        <?php if($_GET['Filter']=="Drafted"){  ?>
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=Drafted&View=Grid&Gender=Bride");?>"><?php if($_GET['Gender']=="Bride") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Brides (<?php echo $res['data']['Bride']['cnt'];?>)</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=Drafted&View=Grid&Gender=Groom");?>"><?php if($_GET['Gender']=="Groom") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Grooms (<?php echo $res['data']['Groom']['cnt'];?>)</small></a>
                        <?php } ?>
                        <?php if($_GET['Filter']=="Requested"){  ?>
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=Requested&View=Grid&Gender=Bride");?>"><?php if($_GET['Gender']=="Bride") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Brides (<?php echo $res['data']['Bride']['cnt'];?>)</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=Requested&View=Grid&Gender=Groom");?>"><?php if($_GET['Gender']=="Groom") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Grooms (<?php echo $res['data']['Groom']['cnt'];?>)</small></a>
                        <?php } ?>
                        <?php if($_GET['Filter']=="Published"){  ?>
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=Published&View=Grid&Gender=Bride");?>"><?php if($_GET['Gender']=="Bride") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Brides (<?php echo $res['data']['Bride']['cnt'];?>)</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=Published&View=Grid&Gender=Groom");?>"><?php if($_GET['Gender']=="Groom") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Grooms (<?php echo $res['data']['Groom']['cnt'];?>)</small></a>
                        <?php } ?>
                        <?php if($_GET['Filter']=="UnPublished"){  ?>
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=UnPublished&View=Grid&Gender=Bride");?>"><?php if($_GET['Gender']=="Bride") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Brides (<?php echo $res['data']['Bride']['cnt'];?>)</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=UnPublished&View=Grid&Gender=Groom");?>"><?php if($_GET['Gender']=="Groom") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Grooms (<?php echo $res['data']['Groom']['cnt'];?>)</small></a>
                        <?php } ?>
                        <?php if($_GET['Filter']=="Rejected"){  ?>
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=Rejected&View=Grid&Gender=Bride");?>"><?php if($_GET['Gender']=="Bride") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Brides (<?php echo $res['data']['Bride']['cnt'];?>)</small></a>&nbsp;|&nbsp;
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=Rejected&View=Grid&Gender=Groom");?>"><?php if($_GET['Gender']=="Groom") { ?><small style="font-weight:bold;text-decoration:underline;color:#3da4ce;"><?php } else{ ?><small style="color:#9b9b9b;"><?php } ?>Grooms (<?php echo $res['data']['Groom']['cnt'];?>)</small></a>
                        <?php } ?>
                        </div>
                    </div>
                
                    <?php   
                        if($_GET['Filter']=="Drafted"){ 
                            if( $_GET['Gender']=="All"){
                                $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"Draft"));
                            }
                            if( $_GET['Gender']=="Bride"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"DraftBride")); 
                            }
                            if( $_GET['Gender']=="Groom"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"DraftGroom")); 
                            }
                            $Filter = "Drafted";
                        }
                        if($_GET['Filter']=="Requested"){ 
                            if( $_GET['Gender']=="All"){
                                $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"Request"));
                            }
                            if( $_GET['Gender']=="Bride"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"RequestBride")); 
                            }
                            if( $_GET['Gender']=="Groom"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"RequestGroom")); 
                            }
                            $Filter = "Requested";
                        }
                        if($_GET['Filter']=="Published"){
                            if( $_GET['Gender']=="All"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"Publish")); 
                            }
                            if( $_GET['Gender']=="Bride"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"PublishBride")); 
                            }
                            if( $_GET['Gender']=="Groom"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"PublishGroom")); 
                            } 
                            $Filter = "Published";
                        }
                        if($_GET['Filter']=="UnPublished"){
                            if( $_GET['Gender']=="All"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"UnPublish")); 
                            }
                            if( $_GET['Gender']=="Bride"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"UnPublishBride")); 
                            }
                            if( $_GET['Gender']=="Groom"){
                               $response = $webservice->getData("Admin","GetProfilesDetatils",array("Request"=>"UnPublishGroom")); 
                            } 
                            $Filter = "UnPublished";
                        }
                    ?>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <h4 class="card-title"><?php echo $Filter;?></h4>
                        </div>
                        <div class="col-sm-6">
                        <select id="SearchProfile" class="form-control" style="width:100px;float:right">
                            <option value="All" <?php echo $_GET['Gender']=="All" ? " selected='selected'": "";?>>All</option>
                            <option value="Bride" <?php echo $_GET['Gender']=="Bride" ? " selected='selected'": "";?>>Bride</option>
                            <option value="Groom" <?php echo $_GET['Gender']=="Groom" ? " selected='selected'": "";?>>Groom</option>
                        </select>

                        <script></script>
                        <script>
                        $('#SearchProfile').change(function() {
                            location.href= location.href+'&Gender='+ $(this).val();
                        });
                        </script>
                        </div>
                        <div class="col-sm-3" style="text-align:right">
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=".$Filter."&View=Grid&Gender=All");?>"><img src="<?php echo SiteUrl?>assets/images/listicon.svg" style="width:30px"></a>&nbsp;&nbsp;
                            <a href="<?php  echo GetUrl("Profiles/List?Filter=".$Filter."&View=Thumb&Gender=All");?>"><img src="<?php echo SiteUrl?>assets/images/rectangleListicon.svg" style="width:30px"></a>
                        </div>
                    </div>
                    <?php if($_GET['View']=="Grid" ){   ?>
                    <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>  
                        <tr>                                                     
                        <th style="width:50px">Member Code</th> 
                        <th>Member Name</th>
                        <th>Profile Code</th>
                        <th>Profile Name</th>
                        <th>Created On</th>
                        <?php if($Filter=="Published"){ ?><th>Published On</th> <?php } ?>
                        <th>Plan</th>   
                        <th>Expire On</th>
                        <th></th>
                        </tr>                                      
                    </thead>
                     <tbody>  
                        <?php 
                         if (sizeof($response['data'])>0) {                                                                 
                         ?>
                        <?php foreach($response['data']as $P) { 
                              $Profile = $P['ProfileInfo'];
                        ?>
                                <tr>
                                <td>
                                    <?php 
                                         if ($Profile['Sex']=="Male") {
                                            echo '&nbsp;<i class="fa fa-male" data-toggle="tooltip" title="Gender: Male" aria-hidden="true"></i>';
                                        } else {
                                            echo '&nbsp;<i class="fa fa-female" data-toggle="tooltip" title="Gender: Female" aria-hidden="true"></i>';
                                        }
                                     ?>&nbsp;<?php echo $Profile['MemberCode'];?>
                                </td>
                                <td><?php echo $P['Members']['MemberName'];?></td>
                                <td><?php echo $Profile['ProfileCode'];?></td>
                                <td><?php echo $Profile['ProfileName'];?></td> 
                                <td><?php echo $Profile['CreatedOn'];?></td>
                                <?php if($Filter=="Published"){ ?><td><?php echo $Profile['IsApprovedOn'];?></td><?php } ?>
								<td><?php echo $P['Plan']['PlanName'];?></td>								
                                <td><?php echo putDate($P['Plan']['EndingDate']);?></td>
                                <td>
                                    <?php if($_GET['Filter']=="Drafted"){ ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewDraftProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a>
                                    <?php } ?>
                                    <?php if($_GET['Filter']=="Requested"){ ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewRequestProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a>
                                    <?php } ?>
                                    <?php if($_GET['Filter']=="Published"){ ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewPublishProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a>
                                    <?php } ?>
                                </td>
                                </tr>
                        <?php }} ?>                                                                                    
                      </tbody>                                                                                                    
                     </table>
                  </div>  
                    <?php } ?> 
                    <?php if($_GET['View']=="Thumb" ){   ?>
                        <?php 
                         if (sizeof($response['data'])>0) {                                                                 
                         ?>
                        <?php foreach($response['data']as $P) { 
                            $Profile = $P['ProfileInfo'];
                            ?>
               <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                <div class="form-group row">
                    <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                    <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;<?php echo $Profile['ProfileCode'];?></div>
                        <img src="<?php echo $P['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                    <div style="line-height: 25px;color: #867c7c;font-size:11px;">Member ID:&nbsp;<?php echo $P['Members']['MemberCode'];?></div>    
                    </div>
                    <div class="col-sm-9">
                        <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                <div class="form-group row">                                                                                     
                                       <div class="col-sm-8"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (<?php echo $Profile['Age'];?> Yrs) </div>
                                </div>
                                <div class="form-group row">
                                       <div class="col-sm-7">
                                            <div style="line-height: 25px;color: #867c7c;font-size:14px"><?php echo $Profile['City'];?></div> 
                                       </div>
                                       <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>" ><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div> 
                                       <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?><br> 
                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?><br>
                                                <?php echo ($Profile['LastSeen']!=0) ? "My last seen: ".putDateTime($Profile['LastSeen']) : ""; ?>
                                                <br>
                                                <br>
                                       </div>
                                </div>
                                </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['Height'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Religion'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['Caste'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div>
                                            <?php echo $Profile['MaritalStatus'];?>
                                        </div>
                                        <div>
                                            <?php echo $Profile['OccupationType'];?>                                               
                                        </div>
                                        <div>
                                            <?php echo $Profile['AnnualIncome'];?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="line-height: 25px;color: #867c7c;color: #867c7c;margin-top: 10px;margin-bottom:15px;">
                                        <div><?php echo $P['Plan']['PlanName'];?>&nbsp;<span data-toggle="popover" data-content="<?php echo "Plan Name :". $P['Plan']['PlanName']; echo"<br>"; echo " Starting Date :". putDate($P['Plan']['StartingDate']); echo"<br>"; echo " Ending Date :". putDate($P['Plan']['EndingDate']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span></div>
                                    </div> 
                                    <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                        <?php echo $Profile['AboutMe'];?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-10">
                                <?php  if($_GET['Filter']=="Published"){ ?>
                                    <div style="line-height: 1px;"><a href="<?php echo GetUrl("ListOfProfile/".$Profile['ProfileCode'].".htm?source=RecentlyViewedCount");?>">Recently Viewed (<?php echo $P['RecentlyViewed'];?>)</a> &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo GetUrl("MyFavoritedProfiles/".$Profile['ProfileCode'].".htm?source=MyFavorited");?>">My Liked (<?php echo $P['MyFavorited'];?>)</a> &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo GetUrl("RecentlyWhoViewed/".$Profile['ProfileCode'].".htm?source=RecentlyWhoViewed");?>">Who Viewed (<?php echo $P['RecentlyWhoViwed'];?>)</a> &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo GetUrl("WhoFavorited/".$Profile['ProfileCode'].".htm?source=WhoFavorited");?>">Who Liked(<?php echo $P['WhoFavorited'];?>)</a> &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo GetUrl("Mutual/".$Profile['ProfileCode'].".htm?source=Mutual");?>">Mutual(<?php echo $P['MutualCount'];?>)</a></div>
                                <?php } ?>    
                                </div>
                                <div class="col-sm-1">
                                    <div style="float:right;line-height: 1px;">
                                        <?php if($_GET['Filter']=="Drafted"){ ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewDraftProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a>
                                    <?php } ?>
                                    <?php if($_GET['Filter']=="Requested"){ ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewRequestProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a>
                                    <?php } ?>
                                    <?php if($_GET['Filter']=="Published"){ ?>
                                    <a href="<?php echo GetUrl("Profiles/ViewPublishProfile/". $Profile['ProfileCode'].".htm");?>"><span>View</span></a>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <br> 
                <?php }} else {?>   
                  <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
                        <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px">
                        <Br> No profiles found in your account
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                        <Br>
                        <br>
                    </div>
                  <?php }?> 
                    <?php } ?>                                                
                </div>
              </div>
            </div>
        </form>   
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
    $('[data-toggle="tooltip"]').tooltip({ container: 'body' }); 
    $('#myTable_filter input').addClass('form-control'); 
    $('#myTable_length select').addClass('form-control'); 
    setTimeout("DataTableStyleUpdate()",500);
});
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        placement : 'top',
        trigger : 'hover'
    });
});
// title="Popover title"
</script>