<style>
    .content-wrapper {
        padding: 0px !important;
        padding-left: 2px !important;
    }
</style>
<?php $page="WhoFavorited";?>
<?php  
     $response = $webservice->getData("Franchisee","GetPublishProfileInfo",array("ProfileCode"=>$_GET['Code'], "request"=>"WhoFavorited"));      
        $ProfileInfo = $response['data']['ProfileInfo'];
        ?>
<div class="col-12 grid-margin">
    <div class="row">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div style="max-width:770px !important;">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div style="border: 1px solid #e6e6e6;;padding: 0px;width: 318px;height: 378px;"> 
                                    <div class="form-group row">                                                       
                                        <div class="col-sm-12">
                                            <div class="photoview" style="float:left;width: 316px;height:280px">
                                                <img src="<?php echo $response['data']['ProfileThumb'];?>" style="height: 100%;width: 100%;">
                                            </div>
                                        </div> 
                                    </div>
                                    <div style="padding-left: 10px;padding-right: 10px;">
                                        <div class="col-sm-1" style="padding-left: 0px;padding-top: 26px;"><img src="<?php echo SiteUrl?>assets/images/nextarrow.jpg" style="width:30px"></div>
                                        <div class="col-sm-10">
                                        <?php foreach($response['data']['ProfilePhotos'] as $ProfileP) {?>
                                            <div class="photoview" style="float: left;">
                                                <img src="<?php echo $ProfileP['ProfilePhoto'];?>" style="height: 62px;width: 44px;">
                                            </div>
                                        <?php }?>
                                        </div>
                                        <div class="col-sm-1" style="padding-left: 0px;padding-top: 26px;"><img src="<?php echo SiteUrl?>assets/images/rightarrow.jpg" style="width:30px"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">                                       
                                    <label class="col-sm-12 col-form-label" style="color: #1e1e1e;font-size: 17px;"><?php echo strlen(trim($ProfileInfo['ProfileName']))> 0 ? trim($ProfileInfo['ProfileName']) : "N/A "; ?>&nbsp;<?php if((strlen(trim($ProfileInfo['Age'])))>0){ echo "("." ".trim($ProfileInfo['Age'])." "."yrs".")";  }?>&nbsp;</label>
                                </div>
                                <div class="form-group row">                                       
                                    <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['Height'])))>0){ echo trim($ProfileInfo['Height']);?>&nbsp;&nbsp;<span style="color: #ccc;">(approximate)</span><?php }?></label>
                                </div>
                                <div class="form-group row">
                                     <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['MaritalStatus']);?></label> 
                                </div>
                                <?php if($ProfileInfo['MaritalStatusCode']!= "MST001"){?>
                                    <?php if(trim($ProfileInfo['Children'])>0) {?>
                                        <div class="form-group row">
                                                <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if(trim($ProfileInfo['Children'])=="1") { echo "Child"; } else { echo "Children";} ?>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?>&nbsp;&nbsp;
                                                    <?php if(trim($ProfileInfo['IsChildrenWithYou'])=="1") {
                                                        if(trim($ProfileInfo['Children'])=="1") { echo "( Child with me )"; } else { echo "( Children with me )";} 
                                                        } else { 
                                                        if(trim($ProfileInfo['Children'])=="1") { echo "( Child not with me )"; } else { echo "( Children not with me )";} 
                                                        }
                                                    ?> 
                                                </label> 
                                        </div>
                                    <?php } else {    ?>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-form-label" style="color:#737373;">Children&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo trim($ProfileInfo['Children']);?></label>
                                        </div>
                                    <?php } ?>
                                <?php }?>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;">
                                    <?php if($ProfileInfo['ReligionCode']== "RN009"){?>
                                        <?php echo trim($ProfileInfo['OtherReligion']);?>
                                    <?php } else { ?>
                                         <?php echo trim($ProfileInfo['Religion']);?>  
                                    <?php } ?> 
                                    </label>
                                </div>
                               <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;">
                                    <?php if($ProfileInfo['CasteCode']== "CSTN248"){?>
                                        <?php echo trim($ProfileInfo['OtherCaste']);?>
                                    <?php } else { ?>
                                         <?php echo trim($ProfileInfo['Caste']);?>  
                                    <?php } ?> 
                                    <?php if((strlen(trim($ProfileInfo['SubCaste'])))>0){   ?>&nbsp;&nbsp; , &nbsp;&nbsp;
                                    <?php   echo "Sub caste :" . trim($ProfileInfo['SubCaste']);    }   ?>
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['Community']);?></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['Nationality']);?></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;"><?php echo trim($ProfileInfo['MotherTongue']);?></label>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-12 col-form-label" style="color:#737373;"><?php if((strlen(trim($ProfileInfo['City'])))>0){ echo trim($ProfileInfo['City']);?>,&nbsp;&nbsp;<?php }?><?php if((strlen(trim($ProfileInfo['State'])))>0){ echo trim($ProfileInfo['State']);?>,&nbsp;&nbsp;<?php }?><?php echo trim($ProfileInfo['Country']);?></label>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <?php include_once("ProfileDetailsTopMenu.php");?>
             <?php foreach($response['data']['results']   as $result) { 
                    $Profile = $result['ProfileInfo'];  ?>
                    <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                                        <div class="form-group row">
                                            <div class="col-sm-3" style="text-align:center;max-width: 182px;">
                                                <div style="line-height: 25px;color: #867c7c;font-size:14px;font-weight:bold;">Profile ID:&nbsp;&nbsp;
                                                    <?php echo $Profile['ProfileCode'];?>
                                                </div>
                                                <img src="<?php echo $result['ProfileThumb'];?>" style="height: 200px;width:150px;border:1px solid #ccc;background:#fff;padding:6px">
                                                <div style="line-height: 25px;color: #867c7c;font-size:14px;">
                                                    <?php echo $Profile['Position'];?>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;width:105%;height: 80px;font-size: 21px;color: #514444cc;">
                                                    <div class="form-group row">
                                                        <div class="col-sm-8">
                                                            <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp; (
                                                                <?php echo $Profile['Age'];?> Yrs) 
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-7">
                                                            <div style="line-height: 25px;color: #867c7c;font-size:14px">
                                                                <?php echo $Profile['City'];?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1"><span id="favourite_<?php echo $Profile['ProfileCode'];?>"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left:27px;"></span></div>
                                                        <div class="col-sm-4" style="float:right;font-size: 12px;">
                                                            <?php  echo "Created On: ".time_elapsed_string($Profile['CreatedOn']); ?>
                                                                <br>
                                                                <?php  echo "Published: ".time_elapsed_string($Profile['IsApprovedOn']); ?>
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
                                                <div class="col-sm-12" style="border-bottom:1px solid #d7d7d7;color: #867c7c;padding-bottom: 5px;">
                                                    <?php echo $Profile['AboutMe'];?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                    <div style="float:right;line-height: 1px;">
                                        <a href="<?php echo GetUrl("ViewPublishedProfile/". $Profile['ProfileCode'].".htm");?>">View</a>
                                    </div>
                            </div>
                                    </div>
                    <br>  
            <?php } ?>
        </div>
    </div>
</div>

