        <footer class="footer">
            <div class="container-fluid clearfix">
                <!--<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright &copy; 2018
               <a href="http://www.bootstrapdash.com/" target="_blank">XXXXXXXX</a>. All rights reserved.</span>-->
            </div>
        </footer>
        <script src="<?php echo SiteUrl?>assets/vendors/js/vendor.bundle.base.js"></script> 
        <script src="<?php echo SiteUrl?>assets/vendors/js/vendor.bundle.addons.js"></script>
        <script src="<?php echo SiteUrl?>assets/js/off-canvas.js"></script>    
        <script src="<?php echo SiteUrl?>assets/js/misc.js"></script>
        <script src="<?php echo SiteUrl?>assets/simpletoast/simply-toast.js"></script>                                       
        
        <!-- Member --->
        <?php if (isset($_Member['LoginID']) && $_Member['LoginID']>0) { ?>
        <script>
            var API_URL = "<?php echo WebServiceUrl;?>webservice.php?LoginID=<?php echo $_Member['LoginID'];?>&";
            var preloader = "<div style='text-align:center;padding-top: 35%;'><img src='<?php echo ImageUrl;?>loader.gif'></div>";
        </script>     
        <script src="<?php echo SiteUrl?>assets/js/mcontroller.js?rand=<?php echo rand(3000,3300000);?>"></script>
        
      <!--  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="Mobile_VerificationBody" style="">
                            <img src='../../../images/loader.gif'> Loading ....
                        </div>
                    </div>
                </div>
            </div>
        </div>   -->
        <div class="modal" id="myModal" data-backdrop="static" >
            <div class="modal-dialog" >
                <div class="modal-content" id="Mobile_VerificationBody"  style="/*max-height: 300px;min-height: 300px;*/" >
                    <img src='../../../images/loader.gif'> Loading ....
                </div>
            </div>
        </div>
        
        <?php } ?>                  
        
        <?php if (isset($_Franchisee['LoginID']) && $_Franchisee['LoginID']>0) { ?>
         <script>
            var API_URL = "<?php echo WebServiceUrl;?>webservice.php?LoginID=<?php echo $_Franchisee['LoginID'];?>&";
            var preloader = "<div style='text-align:center;padding-top: 35%;'><img src='<?php echo ImageUrl;?>loader.gif'></div>";
        </script>
        <script src="<?php echo SiteUrl?>assets/js/fcontroller.js?rand=<?php echo rand(3000,3300000);?>"></script>
        
       
        <?php } ?>
<?php if (isset($_Admin['LoginID']) && $_Admin['LoginID']>0) { ?>
         <script>
            var API_URL = "<?php echo WebServiceUrl;?>webservice.php?LoginID=<?php echo $_Admin['LoginID'];?>&";
            var preloader = "<div style='text-align:center;padding-top: 35%;'><img src='<?php echo ImageUrl;?>loader.gif'></div>";
        </script>
        <script src="<?php echo SiteUrl?>assets/js/Admincontroller.js?rand=<?php echo rand(3000,3300000);?>"></script>
        
        
        <?php } ?>
         
    </body>
</html>
<script>


function RequestToshowUpgrades(PProfileID) {
        
        $('#Upgrades_body').html(preloader);
        $('#Upgrades').modal('show'); 
        $.ajax({
            url: API_URL + "m=Member&a=RequestToshowUpgrades&ProfileID="+PProfileID, 
            success: function(result){
               $('#Upgrades_body').html(result); 
            }});
    }
    
    function RequestToDownload(PProfileID) {
        
        $('#OverAll_body').html(preloader);
        $('#OverAll').modal('show'); 
        var html_design="";
        $.ajax({
            url: API_URL + "m=Member&a=RequestToDownload&PProfileID="+PProfileID, 
            success: function(result){
                
                var obj = JSON.parse(result); 
                if (obj.status=="success") {
                    var objdata =obj.data;
                    if (parseInt(objdata.balancecredits)>0) {
                        html_design = '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">'
                                        + '<form method="post" id="frm_'+PProfileID+'" name="frm_'+PProfileID+'" action="" >'
                                        + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                        + '<h4 class="modal-title">Download Profile</h4>'
                                        + '<input type="hidden" value="'+PProfileID+'" name="PProfileCode">'
                                        + '<div align="center" style="padding-top: 33px;">'
                                            + '<table>'
                                                + '<tr>'
                                                    + '<td>You have remainig profiles to download &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+objdata.balancecredits+'</td>'
                                                + '</tr>'
                                            + '</table>'
                                            + '<br>'
                                            + '<button type="button" class="btn btn-primary" name="Continue"  onclick="OverallSendOTP(\''+PProfileID+'\')">Continue</button>&nbsp;'
                                            + '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                                        + '</div>'
                                        + '<br>'
                                        + '</form>'
                                    + '</div>';
                        
                    } else {
                        html_design = '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">'
                                        + '<form method="post" id="frm_'+PProfileID+'" name="frm_'+PProfileID+'" action="" >' 
                                            + '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                                            + '<h4 class="modal-title">Download Profile</h4>'
                                            + '<input type="hidden" value="'+PProfileID+'" name="PProfileCode">'
                                            + '<div style="text-align:center">'
                                                + 'You don\'t have credits to download profile in your account<br>'
                                                + 'Please upgrade your membership.'
                                                + '<br><br>'
                                                + '<a href="'+AppUrl+'Matches/Search/ViewPlans/'+PProfileID+'.htm " class="btn btn-primary" name="Continue">Upgrade Membership</a>&nbsp;'
                                                + '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                                            + '</div><br>'
                                        + '</form>'
                                    + '</div>';
                }
                } else {
                   html_design = obj.message; 
                }
               $('#OverAll_body').html(html_design); 
            }});
    }
 //ReqToDownloadOTP 
function OverallSendOTP(formid) {
        
        var param = $("#frm_"+formid).serialize();
        $('#OverAll_body').html(preloader);
        $.post(API_URL + "m=Member&a=OverallSendOtp",param,function(result2) {$('#OverAll_body').html(result2);});
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