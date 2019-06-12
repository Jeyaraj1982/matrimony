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
$Profiles = $mysql->select("select * from _tbl_Profile_Draft where ReferBy = '".$_Member['MemberID']."'");
 if (sizeof($Profiles)>0) {
?>

<form method="post" action="<?php echo GetUrl("Profile/CreateProfile");?>" onsubmit="">      
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
               <?php foreach($Profiles as $Profile) { ?>
                <div style="min-height:110px;width:100%;background:#f6f6f6;padding:14px 0px" class="box-shadow">
                    <div class="col-sm-2" style="height:79px"><img src="<?php echo SiteUrl?>images/pic1.jpg" width="100%" height="100%"></div>
                    <div class="col-sm-1" >Name</div>
                    <div class="col-sm-7">:<?php echo $Profile['ProfileName'];?></div>
                    <div class="col-sm-2"><a href="<?php echo GetUrl("Profile/View/". $Profile['ProfileID'].".htm?msg=1");?>"><span>View</span></a></div>      
                    <div class="col-sm-1">Age</div>
                    <div class="col-sm-9">: <?php echo $Profile['Age'];?></div> 
                    <div class="col-sm-1">sex</div>
                    <div class="col-sm-2">: <?php echo $Profile['sex'];?></div>
                    <div class="col-sm-1">DOB</div>
                    <div class="col-sm-6">: <?php echo $Profile['DateofBirth'];?></div>
                    <div class="col-sm-2">Education</div>
                    <div class="col-sm-8">: <?php echo $Profile['Education'];?></div>
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
                <img src="http://nahami.online/sl/Dashboard/images/noprofile.jpg"><Br>
               <div style="padding:30px;padding-top:10px;font-size:20px;color:#ccc;font-family:'Roboto'">There are no profiles</div> 
                
                
                <a style="font-weight:Bold;font-family:'Roboto'" href="javascript:void(0)" onclick="CheckVerification()">Create Profile</a>
                <!-- <?php echo GetUrl("Profile/CreateProfile");?>-->
            </div>
            </div>
            </div>

<?php } ?>
                                            
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" style="padding-top:350px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body">
                    <div id="Mobile_VerificationBody">
                  <img src='../../images/loader.gif'> Loading ....
                </div>
            </div>
        </div>
    </div>
</div>

 
<script>
var API_URL = "http://nahami.online/sl/Dashboard/Webservice/webservice.php?LoginID=<?php echo $_Member['LoginID'];?>&";
   /* function MobileNumberVerificationForm() {
        $('#Mobile_VerificationBody').html("loging....");
         $('#myModal').modal('show');  
        $.ajax({
            url: API_URL + "m=Member&a=IsMobileVerified", 
            success: function(result){
                alert(result);
              if (!(result)) {
                    $.ajax({
                        url: API_URL + "m=Views&a=MobileNumberVerificationForm", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
               } 
            }
        });
    }*/
    
    function MobileNumberVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html("<div style='text-align:center;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
        $('#myModal').modal('show'); 
        
        $.post(API_URL + "m=Views&a=MobileNumberVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
    function ChangeMobileNumber() {
        $('#Mobile_VerificationBody').html("<div style='text-align:center;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Views&a=ChangeMobileNumber", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    } 
    function EmailVerificationForm(frmid1) {
        
        var param = $( "#"+frmid1).serialize();
        
        $('#Mobile_VerificationBody').html("<div style='text-align:center;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
        $('#myModal').modal('show'); 
        
        $.post(API_URL + "m=Views&a=EmailVerificationForm", 
                            param,
                            function(result2) {
                                 $('#Mobile_VerificationBody').html(result2);  
                            }
                    );
    }
    function ChangeEmailID() {
        $('#Mobile_VerificationBody').html("<div style='text-align:center;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Views&a=ChangeEmailID", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    } 
    function CheckVerification() {
        $('#Mobile_VerificationBody').html("<div style='text-align:center;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
         $('#myModal').modal('show'); 
        $.ajax({
                        url: API_URL + "m=Member&a=CheckVerification", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
    }
     function MobileNumberOTPVerification(frmid) {
         var param = $( "#"+frmid).serialize();
         $('#Mobile_VerificationBody').html("<div style='text-align:center;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
                    $.post("http://nahami.online/sl/Dashboard/Webservice/webservice.php?m=Views&a=MobileNumberOTPVerification", 
                            param,
                            function(result2) {
                                $('#Mobile_VerificationBody').html(result2);   
                            }
                    );
              
    } 
   /* function EmailVerificationForm() {
        $('#Mobile_VerificationBody').html("loging....");
         $('#myModal').modal('show');  
        $.ajax({
            url: API_URL + "m=Member&a=IsMobileVerified", 
            success: function(result){
                
              if (!(result)) {
                    $.ajax({
                        url: API_URL + "m=Views&a=EmailVerificationForm", 
                        success: function(result2){
                            $('#Mobile_VerificationBody').html(result2);
                               
                        }
                    });
               } 
            }
        });
              
    }*/
    function EmailOTPVerification(frmid1) {
         var param = $( "#"+frmid1).serialize();
         $('#Mobile_VerificationBody').html("<div style='text-align:center;'><img src='//nahami.online/sl/Dashboard/images/loader.gif'>");
                    $.post("http://nahami.online/sl/Dashboard/Webservice/webservice.php?m=Views&a=EmailOTPVerification", 
                            param,
                            function(result2) {
                                $('#Mobile_VerificationBody').html(result2);   
                            }
                    );
              
    }
    //var obj = jQuery.parseJSON(result);
    //$('#myModal').modal('show');
</script>