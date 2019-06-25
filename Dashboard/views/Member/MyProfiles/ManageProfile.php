<style>
.bshadow {-webkit-box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);
-moz-box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);
box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);}
</style> 
<style>
    #verifybtn{
        background: #0eb1db;
        border:1px#32cbf3;
        box-shadow: 0px 9px 36px -10px rgba(156,154,156,0.64);
    }
    #verifybtn:hover{
         background:#149dc9;
    }
    input:focus{
        border:1px solid #ccc;
        }
    #errormsg{
        text-align:center;
        color:red;
        padding-bottom:5px;
        padding-top:5px;
    }
</style>
<?php
//$Profiles = $mysql->select("select * from _tbl_Profile_Draft where CreatedBy = '".$_Member['MemberID']."'");
 //if (sizeof($Profiles)>0) {
    $response = $webservice->GetProfiles(); 
    if (sizeof($response['data'])>0) {
?>

<form method="post" action="<?php echo GetUrl("MyProfile/CreateProfile");?>" onsubmit="">      
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Profiles</h4>
                <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary "><i class="mdi mdi-plus"></i>Create Profile</button>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-top:5px;color:skyblue;">
                    <a href="All" ><small style="font-weight:bold;text-decoration:underline">All</small></a>&nbsp;|&nbsp;
                    <a href="Posted"><small style="font-weight:bold;text-decoration:underline">Posted</small></a>&nbsp;|&nbsp;
                    <a href="Published"><small style="font-weight:bold;text-decoration:underline">Published</small></a>&nbsp;|&nbsp;
                    <a href="Expired"><small style="font-weight:bold;text-decoration:underline">Expired</small></a>&nbsp;|&nbsp;
                    <a href="#"><small style="font-weight:bold;text-decoration:underline">Rejected</small></a>
                </div>
                </div>
                <br><br>
               <?php foreach($response['data'] as $Profile) { ?>
                <div style="min-height:110px;width:100%;background:#f6f6f6;padding:14px 0px" class="box-shadow">
                    <div class="col-sm-2" style="height:79px"><img src="<?php echo SiteUrl?>assets/images/pic1.jpg" width="100%" height="100%"></div>
                    <div class="col-sm-1" >Name</div>
                    <div class="col-sm-7">:&nbsp;<?php echo $Profile['ProfileName'];?></div>
                    <div class="col-sm-1"><a href="<?php echo GetUrl("MyProfile/View/". $Profile['ProfileID'].".htm?msg=1");?>"><span>View</span></a></div>      
                    <div class="col-sm-1"><a href="<?php echo GetUrl("MyProfile/Edit/". $Profile['ProfileID'].".htm?msg=1");?>"><span>Edit</span></a></div>      
                    <div class="col-sm-1">Age</div>
                    <div class="col-sm-9">:&nbsp;<?php echo $Profile['Age'];?></div> 
                    <div class="col-sm-1">sex</div>
                    <?php //$Sex = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX' and SoftCode='".$Profiles[0]['Sex']."'"); ?>
                    <div class="col-sm-2">:&nbsp;<?php //echo $Sex[0]['CodeValue'];?></div>
                    <div class="col-sm-1">DOB</div>
                    <div class="col-sm-6">:&nbsp;<?php echo putDate($Profile['DateofBirth']);?></div>
                    <div class="col-sm-2">Education&nbsp;&nbsp;&nbsp;:</div>
                    <div class="col-sm-8">&nbsp;<?php echo $Profile['Education'];?></div>
                </div> 
                 <br>              
                        <?php } ?> 
                </div>
              </div>
            </div>
        </form>   
<?php } else   { ?>
                 
                  <div class="col-lg-12 grid-margin stretch-card bshadow" style="background:#fff;padding:90px;">
        <div class="card">
            <div class="card-body" style="text-align:center;font-family:'Roboto'">
                <img src="http://nahami.online/sl/Dashboard/assets/images/noprofile.jpg"><Br>
               <div style="padding:30px;padding-top:10px;font-size:20px;color:#ccc;font-family:'Roboto'">There are no profiles</div> 
                
                <a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a>
                <!-- <?php echo GetUrl("Profile/CreateProfile");?>-->
            </div>
            </div>
            </div>

<?php } ?>
                                            
