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
        <!-- Member -->
    </body>
</html>