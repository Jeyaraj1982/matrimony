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
        <!-- Member --->
        <?php if (isset($_Member['LoginID']) && $_Member['LoginID']>0) { ?>
        <script>
            var API_URL = "<?php echo WebServiceUrl;?>webservice.php?LoginID=<?php echo $_Member['LoginID'];?>&";
            var preloader = "<div style='text-align:center;padding-top: 35%;'><img src='<?php echo ImageUrl;?>loader.gif'></div>";
        </script>     
        <script src="<?php echo SiteUrl?>assets/js/mcontroller.js?rand=<?php echo rand(3000,3300000);?>"></script>
        
        <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
            <div class="modal-dialog" style="width: 367px;">
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
    <div class="modal-dialog" style="width: 367px;">
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
 function showUpgrades(ProfileID) {
      $('#Upgrades').modal('show'); 
      var content = '<div class="Upgrades_body" style="padding:20px">'
                    +   '<div  style="height: 315px;">'
                    
                     + '<input type="hidden" value="'+ProfileID+'" name="ProfileID">'
                       +  '<div style="text-align:center">Please Upgrade<br><br>No credits &nbsp;:&nbsp;0<br><br>' 
                        +  '<button type="button" class="btn btn-primary" name="Continue"  onclick="Continue()">Continue</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                       +  '</div><br>'
                    +  '</form>'
                +  '</div>'
            +  '</div>';
            $('#Upgrades_body').html(content);
}
   
function showOverAll(PProfileCode) {
      $('#OverAll').modal('show'); 
      var content = '<div class="OverAll_body" style="padding:20px">'
                    + '<div  style="height: 315px;">'
                    +  '<form method="post" id="frm_'+PProfileCode+'" name="frm_'+PProfileCode+'" action="" > '
                    + '<input type="hidden" value="'+PProfileCode+'" name="PProfileCode">'
                       +  '<div style="text-align:center">Overall Profile&nbsp;:&nbsp;0<br><br>Viewed&nbsp;:&nbsp;0<br><br>Remail&nbsp;:&nbsp;0<br><br>' 
                        +  '<button type="button" class="btn btn-primary" name="Continue"  onclick="OverallSendOTP(\''+PProfileCode+'\')">Continue</button>&nbsp;'
                        +  '<button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>'
                       +  '</div><br>'
                    + '</form>';
                +  '</div>'
            +  '</div>';
            $('#OverAll_body').html(content);
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