<?php $mainlink="Search";
$page="BasicSearch";?>
<?php include_once("topmenu.php");?>
<style>
    .bshadow {
        -webkit-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
        -moz-box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
        box-shadow: 0px 9px 36px -10px rgba(156, 154, 156, 0.64);
    }
    
    .box-shaddow {
        box-shadow: 0 0 5px #e9e9e9 !important;
        -moz-box-shadow: 0 0 5px #e9e9e9 !important;                         
        -webkit-box-shadow: 0 0 24px #e9e9e9 !important;
    }                                                                           
</style>
<?php
    $response = $webservice->getData("Member","BasicSearchProfile",array()); 
    if (sizeof($response['data'])>0) {
?>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6"><h4 class="card-title">Search Result</h4></div>
                        <div class="col-sm-6" style="text-align:right;"><h4 class="card-title"><a href="BasicSearch">Modify Search</a></h4></div>
                    </div>
                    <?php foreach($response['data'] as $Profile) { ?>
                        <div style="min-height: 200px;width:100%;background:white;padding:20px" class="box-shaddow">
                            <div class="form-group row">
                                <div class="col-sm-3" style="text-align:center">
                                    <img src="<?php echo SiteUrl.$Profile['profileImage'];?>" style="height: 159px;margin-bottom: -18px;">
                                </div>
                                 <div class="col-sm-9">
                                    <div class="colo-sm-12" style="border-bottom:1px solid #d7d7d7;width:100%;padding-bottom: 42px;font-size: 21px;color: #514444cc;">
                                       <div class="col-sm-7"> <?php echo $Profile['ProfileName'];?>&nbsp;&nbsp;<span style="line-height: 25px;color: #867c7c;font-size:14px">Profile ID:&nbsp;&nbsp; <?php echo $Profile['ProfileID'];?></span></div>
                                        <div class="col-sm-1"><img src="<?php echo SiteUrl?>assets/images/clock_icon.png" style="height:16px;width:16px;margin-left: 70px;"></div><div style="float:right;font-size: 12px;">Published:&nbsp;&nbsp;<?php echo putDateTime($Profile['IsApprovedOn']);?><br>Last Seen:</div> 
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
                                        <?php echo $Profile['AboutMe'];?><a href="<?php echo GetUrl("MyProfiles/View/".$Profile['ProfileID'].".htm ");?>">More</a>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right;line-height: 1px;">
                                <a href="javascript:void(0)" onclick="showUpgrades()">View2</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="showOverAll()";>view1</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo GetUrl("Matches/Search/ViewPlans/".$Profile['ProfileID'].".htm ");?>">view</a>
                            </div>
                            <div class="modal" id="Upgrades" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="Upgrades_body" style="height:200px">
            
                                    </div>
                                </div>
                            </div>
                            <div class="modal" id="OverAll" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
                                <div class="modal-dialog" style="width: 367px;">
                                    <div class="modal-content" id="OverAll_body" style="height:335px">
            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
<script>
function showUpgrades() {
      $('#Upgrades').modal('show'); 
      var content = '<div class="Upgrades_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    +  '<form method="post" action="" > '
                     + '<input type="hidden" value="<?php echo $Profile['ProfileID'];?>" name="ProfileID">'
                       +  '<div style="text-align:center">Please Upgrade<br><br>No credits &nbsp;:&nbsp;0<br><br>' 
                        +  '<button type="button" class="btn btn-primary" name="Continue"  onclick="Continue()">Continue</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';
            $('#Upgrades_body').html(content);
}

function showOverAll() {
      $('#OverAll').modal('show'); 
      var content = '<div class="OverAll_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                       +  '<div style="text-align:center">Overall Profile&nbsp;:&nbsp;0<br><br>Viewed&nbsp;:&nbsp;0<br><br>Remail&nbsp;:&nbsp;0<br><br>' 
                        +  '<button type="button" class="btn btn-primary" name="Continue"  onclick="OverallSendOTP()">Continue</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                       +  '</div><br>'
                +  '</div>'
            +  '</div>';
            $('#OverAll_body').html(content);
}

function OverallSendOTP() {
        
       // var param = $("#"+frmid1).serialize();
        $('#OverAll_body').html(preloader);
        $.post(API_URL + "m=Member&a=OverallSendOtp","",function(result2) {$('#OverAll_body').html(result2);});
    }
function ViewProfileOTPVerification(frmid) {
         var param = $( "#"+frmid).serialize();
         $('#OverAll_body').html(preloader);
                    $.post( API_URL + "m=Member&a=ViewProfileOTPVerification", 
                            param,
                            function(result2) {
                                $('#OverAll_body').html(result2);   
                            }
                    );
              
    } 
</script>
                        <?php }?>
                </div>
            </div>
        </div>

  
    <?php     } else   { ?>
    <div style="margin:25px;margin-top:5px;padding:0px !important">
    <div class="card" style="padding:15px;">
        <h4 class="card-title">Published Profiles</h4>
        <div class="card-body" style="padding:80px;text-align:center;color:#aaa">
            <img src="<?php echo ImageUrl;?>noprofile.svg" style="height:128px"><Br>
            No profiles found 
            <br>
        </div>
    </div>
</div>
        <?php } ?>