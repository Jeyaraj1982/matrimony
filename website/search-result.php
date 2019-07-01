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
                        <li class="dropdown">

                            <a class="dropdown-toggle disabled up-btn-upgrade hidden-xs visible-sm visible-md visible-lg" data-toggle="dropdown" href="upgrade_membership.php">Upgrade</a>
                        </li>
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
         
         <section class="page-container" style="margin-top: -19px">
            <div class="container">
                <div class="page-title breadcrumb-top">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-left">
                                <h2>About Best Matrimony</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                        <div class="page-main">
                            <div class="article-detail">
                                <p>More than XX Profile</p>
                                <a href="Register" class="btn btn-primary">Register</a>&nbsp;or&nbsp;<a href="SignIn" class="btn btn-primary">SignIn</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 container-sidebar">
                        <aside id="sidebar">
                            <div class="widget widget-categories">
                                <div class="widget-top">
                                    <h3 class="widget-title">General Search</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="search_index.php">Best Search</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtcHJvZmVzc2lvbmFs">Professional Search</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtZWR1Y2F0aW9u">Education Search</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtc3Rhcg">Star Search</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtc3BsY2FzZXM">Special Cases</a></li>
                                        <li><a href="search_index.php?type=dGFiLXNyY2gtYWR2">Advanced Search</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget widget-categories" style="display:none">
                                <div class="widget-top">
                                    <h3 class="widget-title">Astro Search</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="javascript:;">Generate Horoscope</a></li>
                                        <li><a href="javascript:;">Horoscope Match</a></li>
                                        <li><a href="javascript:;">Horoscope Product</a></li>
                                        <li><a href="javascript:;">Full Horoscope</a></li>
                                        <li><a href="javascript:;">Gem Finder</a></li>
                                        <li><a href="javascript:;">Numerology</a></li>
                                        <li><a href="javascript:;">Super Horoscope</a></li>
                                        <li><a href="javascript:;">Daily Prediction</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget widget-categories">
                                <div class="widget-top">
                                    <h3 class="widget-title">Matrimony Service</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="javascript:;">Wedding Directory</a></li>
                                        <li><a href="javascript:;">Branches</a></li>
                                        <li><a href="javascript:;">Branches Search</a></li>
                                        <li><a href="compare-pricing-plan.php">Payment Option</a></li>
                                        <li><a href="index.php">Member Login</a></li>
                                        <li><a href="index.php">Register Free</a></li>
                                        <li><a href="contact-us.php">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
         
           <?php include_once("footer.php");?>