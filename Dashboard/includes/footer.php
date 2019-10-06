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
        
        <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="Mobile_VerificationBody" style="height: 315px;">
                            <img src='../../../images/loader.gif'> Loading ....
                        </div>
                    </div>
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
        
        <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" style="padding-top:200px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-body">
                    <div id="Mobile_VerificationBody" style="height: 315px;">
                   Loading ....
                </div>
            </div>
        </div>
    </div>
</div>
        <?php } ?>
<?php if (isset($_Admin['LoginID']) && $_Admin['LoginID']>0) { ?>
         <script>
            var API_URL = "<?php echo WebServiceUrl;?>webservice.php?LoginID=<?php echo $_Admin['LoginID'];?>&";
            var preloader = "<div style='text-align:center;padding-top: 35%;'><img src='<?php echo ImageUrl;?>loader.gif'></div>";
        </script>
        <script src="<?php echo SiteUrl?>assets/js/Admincontroller.js?rand=<?php echo rand(3000,3300000);?>"></script>
        
        <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" style="padding-top:200px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-body">
                    <div id="Mobile_VerificationBody" style="height: 315px;">
                   Loading ....
                </div>
            </div>
        </div>
    </div>
</div>
        <?php } ?>
         
    </body>
</html>
<script>


function RequestToshowUpgrades(ProfileID) {
        
        $('#Upgrades_body').html(preloader);
        $('#Upgrades').modal('show'); 
        $.ajax({
            url: API_URL + "m=Member&a=RequestToshowUpgrades&ProfileID="+ProfileID, 
            success: function(result){
               $('#Upgrades_body').html(result); 
            }});
    }
    
function RequestToDownload(PProfileID) {
        
        $('#OverAll_body').html(preloader);
        $('#OverAll').modal('show'); 
        $.ajax({
            url: API_URL + "m=Member&a=RequestToDownload&PProfileID="+PProfileID, 
            success: function(result){
               $('#OverAll_body').html(result); 
            }});
    }

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