<?php include_once("header.php");?>
<style>
    .navbar-inverse {

    background-color: transparent;
    border-color: transparent;
         color:#fff;
}
.navbar-inverse .navbar-nav > li > a {

    color: white;

}

</style>

         <nav class="navbar dashboard-menu">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="navbar-header">
                            <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar top-bar"></span>
                                <span class="icon-bar middle-bar"></span>
                                <span class="icon-bar bottom-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-inverse side-collapse in">
                            <div role="navigation" class="navbar-collapse" id="scroll-submenu1" style="height: auto;">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a class="hidden-xs visible-sm visible-md visible-lg disabled dropdown-toggle" data-toggle="dropdown" href="my_matrimony.php">My Home</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-home.png"></span> My Home <span class="fa fa-angle-down"></span></a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="hidden-xs visible-sm disabled visible-md visible-lg dropdown-toggle " data-toggle="dropdown" href="recommended_matches.php">Matches</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle " data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-matches2.png"></span> Matches <span class="fa fa-angle-down"></span></a>
                                    </li>

                                    <li class="dropdown">
                                        <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="search_index.php">Search</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="javascript:;"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-search.png"></span> Search <span class="fa fa-angle-down"></span></a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="disabled hidden-xs visible-sm visible-md visible-lg dropdown-toggle" data-toggle="dropdown" href="interest_recieved.php">Messages</a>
                                        <a class="visible-xs hidden-sm hidden-md hidden-lg dropdown-toggle" data-toggle="dropdown" href="interest_recieved.php"><span class="am-mmenu-icon"><img src="images/kv-mmenu-icon-messages.png"></span> Messages <span class="fa fa-angle-down"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav navbar-nav navbar-right user-profile">
                        <li class="dropdown hidden-xs">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="help.php">Help</a>
                        </li>
                        <li class="dropdown drpprofile">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">

                                <img class="img-circle" src="">
                                <span class="fa fa-angle-down"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
         </nav> 
         
         <div class="page-container" style="margin-top: -19px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                        <div class="page-main">
                            <div style="background:white ;height: 350px;width: 361px;margin-top: 50px;margin-bottom: 110px;padding-top:34px;border-radius: 10px;margin-left: 373px;padding-left:35px;padding-right:35px">
                                  <p style="text-align: center;margin-top: 15px;margin-bottom: 30px;"><img src="assets/images/greentickcircle.png" width="25%"> </p>
                                  <h3 style="text-align: center;margin-top:0px">Password Updated!</h3>
                                  <div style="text-align: center;">Your password has been changed successfully. Use your new password to login</div><br><br><br>
                                  <p style="text-align:center;margin-top:-20px"><a href="index.php" class="btn btn-primary">Login here</a></p>
            <br><br>  
                        </div>
                    </div>
                    </div>
                    
                    </div>
                </div>
        </div>
         <?php include_once("footer.php");?>